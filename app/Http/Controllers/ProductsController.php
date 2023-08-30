<?php

namespace App\Http\Controllers;

use App\Http\Action\Products\IndexProductsAction;
use App\Http\Responses\Products\ProductsCollectionResponse;
use App\Models\ProductsMenu;
use App\Models\ProductsPearl;
use App\Models\ProductsSide;
use App\Models\ProductsSyrup;
use App\Models\ProductsTea;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Log;

class ProductsController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @return ProductsCollectionResponse|JsonResponse
     */
    public function __invoke(): ProductsCollectionResponse|JsonResponse
    {
        try {
            $productsSyrups = ProductsSyrup::query()->get()->map(function ($productSyrup) {
                $productSyrup->show = true;

                return $productSyrup;
            });

            $productsTeas = (new IndexProductsAction)->handle(ProductsTea::query()->get())->map(function ($productTea) {
                $productTea->show = true;

                return $productTea;
            });

            $productsSides = (new IndexProductsAction)->handle(ProductsSide::query()->get())->map(function ($productSide) {
                $productSide->show = true;

                return $productSide;
            });
            $productsMenus = ProductsMenu::orderBy('price', 'asc')->get();


            $productPearls = ProductsPearl::query()->get()->map(function ($productPearl) {
                $productPearl->show = true;
                return $productPearl;
            });

            return new ProductsCollectionResponse(
                $productsTeas,
                $productsSides,
                $productPearls,
                $productsSyrups,
                $productsMenus,
            );
        } catch (Exception $e) {
            Log::error('Error dans la transaction pour Products' . $e->getMessage());
            return response()->json([
                "status" => "error",
                "message" => "Une erreur c'est produite"
            ], 500);
        }


    }
}
