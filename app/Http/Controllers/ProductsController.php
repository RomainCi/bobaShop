<?php

namespace App\Http\Controllers;

use App\Http\Action\Products\IndexProductsAction;
use App\Http\Responses\Products\ProductsCollectionResponse;
use App\Models\ProductsMenu;
use App\Models\ProductsPearl;
use App\Models\ProductsSide;
use App\Models\ProductsSyrup;
use App\Models\ProductsTea;

class ProductsController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @return ProductsCollectionResponse
     *
     */
    public function __invoke(): ProductsCollectionResponse
    {
        $productsSyrups = ProductsSyrup::query()->get();
        $productsTeas = (new IndexProductsAction)->handle(ProductsTea::query()->get());
        $productsSides = (new IndexProductsAction)->handle(ProductsSide::query()->get());
        $productsMenus = ProductsMenu::query()->get();
        $productPearls = ProductsPearl::query()->get();
        return new ProductsCollectionResponse(
            $productsTeas,
            $productsSides,
            $productPearls,
            $productsSyrups,
            $productsMenus
        );

    }
}
