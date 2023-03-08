<?php

namespace App\Http\Controllers;

use App\Http\Requests\MenuRequest;
use App\Models\ProductsMenu;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;

class MenuController extends Controller
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
     * @param MenuRequest $request
     * @return JsonResponse
     */
    public function store(MenuRequest $request): JsonResponse
    {
        try {
            $menu = $request->validated();
            $newMenu = ProductsMenu::create($menu);
            return response()->json([
                "menu" => $newMenu
            ]);
        } catch (\Exception $e) {
            dd($e);
        }

    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return Response
     */
    public function show($id)
    {

    }

    /**
     * Update the specified resource in storage.
     *
     * @param MenuRequest $request
     * @param int $id
     * @return JsonResponse|void
     */
    public function update(MenuRequest $request, int $id)
    {
        try {
            $menu = ProductsMenu::findOrFail($id);
            $menu->$request->validated();
            $menu['usersAdmin_id']->Auth::guard('admin')->user()['id'];
            $menu->save();
            return response()->json([
                "menus" => $menu
            ]);
        } catch (\Exception $e) {
            dd($e);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return Response
     */
    public function destroy(int $id): Response
    {
        try {
            ProductsMenu::destroy($id);
            return response('success');
        } catch (\Exception $e) {
            dd($e);
        }
    }
}
