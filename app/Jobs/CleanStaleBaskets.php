<?php

namespace App\Jobs;

use App\Models\Basket;
use App\Models\ProductsPearl;
use App\Models\ProductsSide;
use App\Models\ProductsSyrup;
use App\Models\ProductsTea;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class CleanStaleBaskets implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Execute the job.
     *
     * @return void
     * @throws \Throwable
     */
    public function handle()
    {
        $cutoffTime = now()->subMinutes(1);

        try {
            $staleBaskets = Basket::with('basketMenu')->where('updated_at', '<=', $cutoffTime)->get();

            DB::transaction(function () use ($staleBaskets) {
                foreach ($staleBaskets as $staleBasket) {
                    $basketMenus = $staleBasket->basketMenu;
                    $pearlIds = $basketMenus->pluck('pearl_id')->toArray();
                    $teaIds = $basketMenus->pluck('tea_id')->toArray();
                    $syrupIds = $basketMenus->pluck('syrup_id')->toArray();

                    ProductsPearl::whereIn('id', $pearlIds)->lockForUpdate()->increment('stock', 1);
                    ProductsTea::whereIn('id', $teaIds)->lockForUpdate()->increment('stock', 1);
                    ProductsSyrup::whereIn('id', $syrupIds)->lockForUpdate()->increment('stock', 1);

                    foreach ($basketMenus as $key => $basketMenu) {
                        $basketSides = $basketMenu->basketSides;
                        $sideQuantities = $basketSides->pluck('side_id')->toArray();
                        foreach ($sideQuantities as $sideId) {
                            $productSide = ProductsSide::where('id', $sideId)->lockForUpdate()->first();
                            $productSide->stock++;
                            $productSide->save();

                        }
                    }

                    // Supprime le panier après avoir mis à jour les stocks
                    $staleBasket->delete();
                }
            });
            Log::info('CleanStaleBaskets Job completed successfully');
        } catch (\Exception $e) {
            Log::error('Error cleaning stale baskets: ' . $e->getMessage());
        }
    }
}
