<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductsMenuRequest;
use App\Models\ProductsMenu;
use App\Models\ProductsPearl;
use App\Models\ProductsSide;
use App\Models\ProductsSyrup;
use App\Models\ProductsTea;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;

class ProductsMenuController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {

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
     */
    public function store(ProductsMenuRequest $request): JsonResponse
    {

        try {
            $menu = $request->validated();
            $menu = ProductsMenu::create($menu);
            return response()->json($menu);
        } catch (\Exception $e) {
            dd($e);
        }

    }

    /**
     * Display the specified resource.
     *
     * @param ProductsMenu $menu
     * @return JsonResponse
     */
    public function show(ProductsMenu $menu): JsonResponse
    {
        try {
            $pearls = ProductsPearl::select('id', 'name', 'color')->get();
            $teas = ProductsTea::select('id', 'name')->get();
            $syrups = ProductsSyrup::select('id', 'name', 'color')->get();
            $sides = ProductsSide::select('id', 'name', 'quantity')->get();

            $response = [
                "pearls" => $pearls,
                "teas" => $teas,
                "syrups" => $syrups,
                "number_side" => $menu->sides,
            ];

            if ($menu->sides !== 0) {
                $response['sides'] = $sides;
            }

            return response()->json($response);

        } catch (\Exception $e) {
            dd($e);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param ProductsMenuRequest $request
     * @param ProductsMenu $menu
     * @return JsonResponse|void
     */
    public function update(ProductsMenuRequest $request, ProductsMenu $menu)
    {
        try {
            $validated = $request->validated();
            $menu->name = $validated['name'];
            $menu->sides = $validated['sides'];
            $menu->size = $validated['size'];
            $menu->price = $validated['price'];
            $menu->save();
            return response()->json($menu);
        } catch (\Exception $e) {
            dd($e);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param ProductsMenu $menu
     * @return Response
     */
    public function destroy(ProductsMenu $menu): Response
    {
        try {
            $menu->delete();
            return response('success');
        } catch (\Exception $e) {
            dd($e);
        }
    }
}
