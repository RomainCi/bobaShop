<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductsSideRequest;
use App\Models\ProductsSide;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Throwable;

class ProductsSideController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return void
     */
    public function index(): void
    {

//        try {
//            $productsSides = ProductsSide::all();
//            foreach ($productsSides as $key => $value) {
//                if (Storage::disk('s3')->exists($value->image_url)) {
//                    $value->image_url = Storage::temporaryUrl($value->image_url, now()->addRealMinutes(1));
//                }
//            }
//
//            return response()->json([
//                "status" => "success",
//                "message" => "success",
//                "data" => $productsSides
//            ]);
//        } catch (Exception $e) {
//            Log::error('Error dans la transaction pour indexProductsSide' . $e->getMessage());
//            return response()->json([
//                "status" => "error",
//                "message" => "Une erreur c'est produite"
//            ], 500);
//        }

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param ProductsSideRequest $request
     * @return JsonResponse
     * @throws Throwable
     */
    public function store(ProductsSideRequest $request): JsonResponse
    {
        DB::beginTransaction();
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

            DB::commit();
            return response()->json([
                "message" => "success",
                "status" => "success",
                "data" => $side,
            ]);
        } catch (Exception $e) {
            DB::rollBack();
            Log::error('Error dans la transaction pour storeProductsSide' . $e->getMessage());
            return response()->json([
                "status" => "error",
                "message" => "Une erreur c'est produite"
            ], 500);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param ProductsSide $productsSide
     * @return void
     */
    public function show(ProductsSide $productsSide): void
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param ProductsSideRequest $request
     * @param ProductsSide $side
     * @return JsonResponse
     * @throws Throwable
     */
    public function update(ProductsSideRequest $request, ProductsSide $side): JsonResponse
    {
        $productsSide = $request->validated();
        DB::beginTransaction();
        try {
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

            DB::commit();
            return response()->json([
                "message" => "success",
                "status" => "success",
                "data" => $side
            ]);
        } catch (Exception $e) {
            DB::rollBack();
            Log::error('Error dans la transaction pour updateProductsSide' . $e->getMessage());
            return response()->json([
                "status" => "error",
                "message" => "Une erreur c'est produite"
            ], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param ProductsSide $side
     * @return JsonResponse
     * @throws Throwable
     */
    public function destroy(ProductsSide $side): JsonResponse
    {
        DB::beginTransaction();
        try {
            $side->delete();
            DB::commit();
            return response()->json([
                "message" => "success",
                "status" => "success",
            ]);

        } catch (Exception $e) {
            DB::rollBack();
            Log::error('Error dans la transaction pour destroyProductsSide' . $e->getMessage());
            return response()->json([
                "status" => "error",
                "message" => "Une erreur c'est produite"
            ], 500);
        }
    }
}
