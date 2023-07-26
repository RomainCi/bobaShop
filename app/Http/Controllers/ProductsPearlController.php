<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductsPearlRequest;
use App\Models\ProductsPearl;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;

class ProductsPearlController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param ProductsPearlRequest $request
     * @return JsonResponse|void
     */
    public function store(ProductsPearlRequest $request)
    {
        try {
            $validated = $request->validated();
            $pearl = ProductsPearl::create($validated);
            return response()->json($pearl);
        } catch (\Exception $e) {
            dd($e);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param ProductsPearl $productsPearl
     * @return Response
     */
    public function show(ProductsPearl $productsPearl)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param ProductsPearlRequest $request
     * @param ProductsPearl $pearl
     * @return JsonResponse
     */
    public function update(ProductsPearlRequest $request, ProductsPearl $pearl): JsonResponse
    {
        try {
            $productsPearl = $request->validated();
            $pearl->name = $productsPearl['name'];
            $pearl->stock = $productsPearl['stock'];
            $pearl->color = $productsPearl['color'];
            $pearl->save();

            return response()->json("success");
        } catch (\Exception $e) {
            dd($e);
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param ProductsPearl $pearl
     * @return JsonResponse|void
     */
    public function destroy(ProductsPearl $pearl)
    {
        try {
            $pearl->delete();
            return response()->json("success");
        } catch (\Exception $e) {
            dd($e);
        }

    }
}
