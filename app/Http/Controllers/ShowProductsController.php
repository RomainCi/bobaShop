<?php

namespace App\Http\Controllers;


use App\Http\Responses\Products\ShowProductsCollectionResponse;
use App\Models\ProductsMenu;
use App\Models\ProductsPearl;
use App\Models\ProductsSide;
use App\Models\ProductsSyrup;
use App\Models\ProductsTea;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Log;

class ShowProductsController extends Controller
{
    /**
     * Handle the incoming request.
     *
     *
     */
    public function __invoke(ProductsMenu $menu): ShowProductsCollectionResponse|JsonResponse
    {
        try {
            $productsSyrups = ProductsSyrup::query()->get()->map(function ($productSyrup) {
                $productSyrup->show = false;
                return $productSyrup;
            });

            $productsTeas = ProductsTea::query()->get()->map(function ($productTea) {
                $productTea->show = false;

                return $productTea;
            });

            $productsSides = ProductsSide::query()->get()->map(function ($productSide) {
                $productSide->show = false;

                return $productSide;
            });


            $productPearls = ProductsPearl::query()->get()->map(function ($productPearl) {
                $productPearl->show = false;
                return $productPearl;
            });

            return new ShowProductsCollectionResponse(
                $productsTeas,
                $productsSides,
                $productPearls,
                $productsSyrups,
                $menu->sides,
            );

        } catch (Exception $e) {
            Log::error('Error dans la transaction pour showProducts' . $e->getMessage());
            return response()->json([
                "status" => "error",
                "message" => "Une erreur c'est produite"
            ], 500);
        }
    }


}
