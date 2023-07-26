<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductsSyrupRequest;
use App\Models\ProductsSyrup;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;

class ProductsSyrupController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        $productsSyrups = ProductsSyrup::all();
        return response()->json([
            "productsSyrups" => $productsSyrups
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param ProductsSyrupRequest $request
     * @return JsonResponse
     */
    public function store(ProductsSyrupRequest $request): JsonResponse
    {
        try {
            $validated = $request->validated();
            $syrup = ProductsSyrup::create($validated);
            return response()->json($syrup);
        } catch (\Exception $e) {
            dd($e);
        }

    }

    /**
     * Display the specified resource.
     *
     * @param ProductsSyrup $productsSyrup
     * @return Response
     */
    public function show(ProductsSyrup $syrup)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param ProductsSyrupRequest $request
     * @param ProductsSyrup $syrup
     * @return JsonResponse|void
     */
    public function update(ProductsSyrupRequest $request, ProductsSyrup $syrup)
    {
        try {
            $productsPearl = $request->validated();
            $syrup->name = $productsPearl['name'];
            $syrup->stock = $productsPearl['stock'];
            $syrup->color = $productsPearl['color'];
            $syrup->save();

            return response()->json("success");
        } catch (\Exception $e) {
            dd($e);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param ProductsSyrup $syrup
     * @return JsonResponse|void
     */
    public function destroy(ProductsSyrup $syrup)
    {
        try {
            $syrup->delete();
            return response()->json("success");
        } catch (\Exception $e) {
            dd($e);
        }
    }
}
