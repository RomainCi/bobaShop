<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductsMenuRequest;
use App\Models\ProductsMenu;
use App\Models\ProductsPearl;
use App\Models\ProductsSide;
use App\Models\ProductsSyrup;
use App\Models\ProductsTea;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Throwable;

class ProductsMenuController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        dd("oki");
        try {
            $admin = Auth::guard('admin')->user();
            if ($admin !== null) {
                $menus = ProductsMenu::orderBy('price', 'asc')
                    ->get();
                return response()->json([
                    "menu" => $menus
                ]);
            }
            $menus = ProductsMenu::select('id', 'name', 'sides', 'size', 'price')
                ->orderBy('price', 'asc')
                ->get();
            return response()->json([
                "menu" => $menus,
            ]);
        } catch (\Exception $e) {
            dd($e);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param ProductsMenuRequest $request
     * @return JsonResponse
     * @throws Throwable
     */
    public function store(ProductsMenuRequest $request): JsonResponse
    {
        $menu = $request->validated();
        DB::begintransaction();
        try {
            $menu = ProductsMenu::create($menu);
            DB::commit();
            return response()->json([
                "message" => "success",
                "status" => "success",
                "data" => $menu,
            ]);
        } catch (Exception $e) {
            DB::rollBack();
            Log::error('Error dans la transaction pour storeProductsMenu' . $e->getMessage());
            return response()->json([
                "status" => "error",
                "message" => "Une erreur c'est produite"
            ], 500);
        }

    }

    /**
     * Display the specified resource.
     *
     * @param ProductsMenu $menu
     * @return void
     */
    public function show(ProductsMenu $menu): void
    {

    }

    /**
     * Update the specified resource in storage.
     *
     * @param ProductsMenuRequest $request
     * @param ProductsMenu $menu
     * @return JsonResponse|void
     * @throws Throwable
     */
    public function update(ProductsMenuRequest $request, ProductsMenu $menu)
    {
        $validated = $request->validated();
        DB::beginTransaction();
        try {

            $menu->name = $validated['name'];
            $menu->sides = $validated['sides'];
            $menu->size = $validated['size'];
            $menu->price = $validated['price'];
            $menu->save();
            DB::commit();
            return response()->json([
                "status" => "success",
                "message" => "success",
            ]);
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Error dans la transaction pour updateProductsMenu' . $e->getMessage());
            return response()->json([
                "status" => "error",
                "message" => "Une erreur c'est produite"
            ], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param ProductsMenu $menu
     * @return JsonResponse
     * @throws Throwable
     */
    public function destroy(ProductsMenu $menu): JsonResponse
    {
        DB::beginTransaction();
        try {
            $menu->delete();
            DB::commit();
            return response()->json([
                "message" => "success",
                "status" => "success",
            ]);
        } catch (Exception $e) {
            DB::rollBack();
            Log::error('Error dans la transaction pour destroyProductsMenu' . $e->getMessage());
            return response()->json([
                "status" => "error",
                "message" => "Une erreur c'est produite"
            ], 500);
        }
    }
}
