<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductsStoreRequest;
use App\Models\Commands;
use App\Models\CommandsSides;
use App\Models\ProductsBubble;
use App\Models\ProductsMenu;
use Illuminate\Http\JsonResponse;

class ProductssController extends Controller
{


   public function store(\Request $request)
   {

   }

    public function show($id): JsonResponse
    {
        dd("oki");
        $menu = ProductsMenu::findOrFail($id);
        if ($menu->sides === 0) {
            $products = ProductsBubble::select('id', 'name', 'type')
                ->where('type', '!=', 'side')
                ->get();
        } else {
            $products = ProductsBubble::select('id', 'name', 'type')
                ->get();
        }
        return response()->json([
            "products" => $products,
            "side" => $menu->sides,
        ]);
    }




}
