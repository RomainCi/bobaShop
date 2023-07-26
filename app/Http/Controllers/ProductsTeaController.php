<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductsTeaRequest;
use App\Http\Responses\ProductsTea\ProductsTeaCollectionResponse;
use App\Models\ProductsTea;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Storage;

class ProductsTeaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return ProductsTeaCollectionResponse
     */
    public function index(): ProductsTeaCollectionResponse
    {
        $productsTeas = ProductsTea::all();
        $productsTeas->map(function ($value, $key) {
            if (Storage::disk('s3')->exists($value->image_url)) {
                $value->image_url = Storage::temporaryUrl($value->image_url, now()->addRealMinutes(1));
            }
            return $value;
        });
        return new ProductsTeaCollectionResponse($productsTeas);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param ProductsTeaRequest $request
     * @return JsonResponse|void
     */
    public function store(ProductsTeaRequest $request)
    {
        try {
            $productsTea = $request->validated();
            if (!$productsTea['image']) {
                return response()->json("manque une image", 400);
            }
            $file = $productsTea['image'];
            $name = time() . $file->getClientOriginalName();
            $file->move(public_path('images/teas'), $name);
            $productsTea['image_url'] = 'images/teas/' . $name;
            unset($productsTea['image']);
            $tea = ProductsTea::create($productsTea);
            $tea->image_url = asset($tea->image_url);
            return response()->json($tea);
        } catch (\Exception $e) {
            dd($e);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\ProductsTea $productsTea
     * @return Response
     */
    public function show(ProductsTea $tea)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param ProductsTeaRequest $request
     * @param ProductsTea $tea
     * @return JsonResponse
     */
    public function update(ProductsTeaRequest $request, ProductsTea $tea): JsonResponse
    {
        $productsTea = $request->validated();
        if ($productsTea['image'] !== null) {
            $file = $productsTea['image'];
            $name = time() . $file->getClientOriginalName();
            $file->move(public_path('images/teas'), $name);
            $tea->image_url = 'images/teas/' . $name;
        }
        $tea->name = $productsTea['name'];
        $tea->stock = $productsTea['stock'];
        $tea->save();
        $tea->image_url = asset($tea->image_url);
        return response()->json($tea);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param ProductsTea $tea
     * @return JsonResponse
     */
    public function destroy(ProductsTea $tea): JsonResponse
    {
        try {
            $tea->delete();
            return response()->json("success");
        } catch (\Exception $e) {
            dd($e);
        }
    }
}
