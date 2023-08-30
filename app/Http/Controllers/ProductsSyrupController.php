<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductsSyrupRequest;
use App\Models\ProductsSyrup;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Throwable;

class ProductsSyrupController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return void
     */
    public function index(): void
    {
//        $productsSyrups = ProductsSyrup::all();
//        return response()->json([
//            "productsSyrups" => $productsSyrups
//        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param ProductsSyrupRequest $request
     * @return JsonResponse
     * @throws Throwable
     */
    public function store(ProductsSyrupRequest $request): JsonResponse
    {
        DB::beginTransaction();
        try {
            $validated = $request->validated();
            $syrup = ProductsSyrup::create($validated);
            DB::commit();
            return response()->json([
                "message" => "success",
                "status" => "success",
                "data" => $syrup,
            ]);
        } catch (Exception $e) {
            DB::rollBack();
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
     * @param ProductsSyrup $syrup
     * @return void
     */
    public function show(ProductsSyrup $syrup): void
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param ProductsSyrupRequest $request
     * @param ProductsSyrup $syrup
     * @return JsonResponse
     * @throws Throwable
     */
    public function update(ProductsSyrupRequest $request, ProductsSyrup $syrup): JsonResponse
    {
        $productsPearl = $request->validated();
        DB::beginTransaction();
        try {
            $syrup->name = $productsPearl['name'];
            $syrup->stock = $productsPearl['stock'];
            $syrup->color = $productsPearl['color'];
            $syrup->save();
            DB::commit();
            return response()->json([
                "message" => "success",
                "status" => "success",
            ]);
        } catch (Exception $e) {
            DB::rollBack();
            Log::error('Error dans la transaction pour updateProductsSyrup' . $e->getMessage());
            return response()->json([
                "status" => "error",
                "message" => "Une erreur c'est produite"
            ], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param ProductsSyrup $syrup
     * @return JsonResponse
     * @throws Throwable
     */
    public function destroy(ProductsSyrup $syrup): JsonResponse
    {
        DB::beginTransaction();
        try {
            $syrup->delete();
            DB::commit();
            return response()->json([
                "message" => "success",
                "status" => "success",
            ]);
        } catch (Exception $e) {
            DB::rollBack();
            Log::error('Error dans la transaction pour destroyProductsSyrup' . $e->getMessage());
            return response()->json([
                "status" => "error",
                "message" => "Une erreur c'est produite"
            ], 500);
        }
    }
}
