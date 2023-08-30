<?php

namespace App\Http\Responses\Products;


use App\Http\Resources\ProductsPearl\ProductsPearlCollection;
use App\Http\Resources\ProductsSide\ProductsSideCollection;
use App\Http\Resources\ProductsSyrup\ProductsSyrupCollection;
use App\Http\Resources\ProductsTea\ProductsTeaCollection;
use Illuminate\Support\Collection;

class ShowProductsCollectionResponse implements \Illuminate\Contracts\Support\Responsable
{

    public function __construct(private readonly Collection $collectionTea,
                                private readonly Collection $collectionSide,
                                private readonly Collection $collectionPearl,
                                private readonly Collection $collectionSyrup,
                                private readonly int        $numberSide,
                                private readonly int        $status = 200)
    {
    }

    /**
     * @inheritDoc
     */
    public function toResponse($request): \Illuminate\Http\JsonResponse|\Symfony\Component\HttpFoundation\Response
    {
        return response()->json([
            "teas" => new ProductsTeaCollection($this->collectionTea),
            "sides" => new ProductsSideCollection($this->collectionSide),
            "pearls" => new ProductsPearlCollection($this->collectionPearl),
            "syrups" => new ProductsSyrupCollection($this->collectionSyrup),
            "numberSide" => $this->numberSide,
            "status"=> "success",
        ], $this->status);
    }
}
