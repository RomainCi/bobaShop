<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductsPearlRequest;
use App\Models\ProductsPearl;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Throwable;

class ProductsPearlController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return void
     */
    public function index(): void
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param ProductsPearlRequest $request
     * @return JsonResponse
     */
    public function store(ProductsPearlRequest $request): JsonResponse
    {
        try {
            $validated = $request->validated();
            $pearl = ProductsPearl::create($validated);
            return response()->json([
                "message" => "success",
                "status" => "success",
                "data" => $pearl,
            ]);
        } catch (Exception $e) {
            Log::error('Error dans la transaction pour storeProductsPearl' . $e->getMessage());
            return response()->json([
                "status" => "error",
                "message" => "Une erreur c'est produite"
            ], 500);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param ProductsPearl $productsPearl
     * @return void
     */
    public function show(ProductsPearl $productsPearl): void
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param ProductsPearlRequest $request
     * @param ProductsPearl $pearl
     * @return JsonResponse
     * @throws Throwable
     */
    public function update(ProductsPearlRequest $request, ProductsPearl $pearl): JsonResponse
    {
        DB::beginTransaction();
        try {
            $productsPearl = $request->validated();
            $pearl->name = $productsPearl['name'];
            $pearl->stock = $productsPearl['stock'];
            $pearl->color = $productsPearl['color'];
            $pearl->save();

            DB::commit();
            return response()->json([
                "message" => "success",
                "status" => "success",
            ]);
        } catch (Exception $e) {
            DB::rollBack();
            Log::error('Error dans la transaction pour updateProductsPearl' . $e->getMessage());
            return response()->json([
                "status" => "error",
                "message" => "Une erreur c'est produite"
            ], 500);
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param ProductsPearl $pearl
     * @return JsonResponse
     * @throws Throwable
     */
    public function destroy(ProductsPearl $pearl): JsonResponse
    {
        DB::beginTransaction();
        try {
            $pearl->delete();
            DB::commit();
            return response()->json([
                "message" => "success",
                "status" => "success",
            ]);
        } catch (Exception $e) {
            DB::rollBack();
            Log::error('Error dans la transaction pour destroyProductsPearl' . $e->getMessage());
            return response()->json([
                "status" => "error",
                "message" => "Une erreur c'est produite"
            ], 500);
        }

    }
}
