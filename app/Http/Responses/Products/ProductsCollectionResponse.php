<?php

namespace App\Http\Responses\Products;

//use App\Http\Resources\Products\ProductsCollection;
use App\Http\Resources\ProductsMenu\ProductsMenuCollection;
use App\Http\Resources\ProductsPearl\ProductsPearlCollection;
use App\Http\Resources\ProductsSide\ProductsSideCollection;
use App\Http\Resources\ProductsSyrup\ProductsSyrupCollection;
use App\Http\Resources\ProductsTea\ProductsTeaCollection;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Collection;
use Symfony\Component\HttpFoundation\Response;

class ProductsCollectionResponse implements \Illuminate\Contracts\Support\Responsable
{
    public function __construct(private readonly Collection $collectionTea,
                                private readonly Collection $collectionSide,
                                private readonly Collection $collectionPearl,
                                private readonly Collection $collectionSyrup,
                                private readonly Collection $collectionMenu,
                                private readonly int $status = 200)
    {
    }

    /**
     * @inheritDoc
     */
    public function toResponse($request): JsonResponse|Response
    {
        return response()->json([
            "teas" => new ProductsTeaCollection($this->collectionTea),
            "sides" => new ProductsSideCollection($this->collectionSide),
            "pearls" => new ProductsPearlCollection($this->collectionPearl),
            "syrups"=> new ProductsSyrupCollection($this->collectionSyrup),
            "menus" => new ProductsMenuCollection($this->collectionMenu),
            "status"=> "success",
        ], $this->status);
    }
}
