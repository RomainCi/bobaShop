<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductsSideRequest;
use App\Models\ProductsSide;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Storage;

class ProductsSideController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        $productsSides = ProductsSide::all();
        foreach ($productsSides as $key => $value) {
            if (Storage::disk('s3')->exists($value->image_url)) {
                $value->image_url = Storage::temporaryUrl($value->image_url, now()->addRealMinutes(1));
            }
        }

        return response()->json([
            "productsSides" => $productsSides
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param ProductsSideRequest $request
     * @return JsonResponse|void
     */
    public function store(ProductsSideRequest $request)
    {
        try {
            $productsSide = $request->validated();
            if (!$productsSide['image']) {
                return response()->json("manque une image", 400);
            }
            $file = $productsSide['image'];
            $name = time() . $file->getClientOriginalName();
            $file->move(public_path('images/sides'), $name);
            $productsSide['image_url'] = 'images/sides/' . $name;
            unset($productsSide['image']);
            $side = ProductsSide::create($productsSide);
            $side->image_url = asset($side->image_url);
            return response()->json($side);
        } catch (\Exception $e) {
            dd($e);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param ProductsSide $productsSide
     * @return Response
     */
    public function show(ProductsSide $productsSide)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param ProductsSideRequest $request
     * @param ProductsSide $side
     * @return JsonResponse
     */
    public function update(ProductsSideRequest $request, ProductsSide $side): JsonResponse
    {
        $productsSide = $request->validated();
        if ($productsSide['image'] !== null) {
            $file = $productsSide['image'];
            $name = time() . $file->getClientOriginalName();
            $file->move(public_path('images/sides'), $name);
            $side->image_url = 'images/sides/' . $name;
        }
        $side->name = $productsSide['name'];
        $side->stock = $productsSide['stock'];
        $side->price = $productsSide['price'];
        $side->quantity = $productsSide['quantity'];
        $side->save();
        $side->image_url = asset($side->image_url);
        return response()->json($side);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param ProductsSide $side
     * @return JsonResponse
     */
    public function destroy(ProductsSide $side): JsonResponse
    {
        try {
            $side->delete();
            return response()->json("success");
        } catch (\Exception $e) {
            dd($e);
        }
    }
}
