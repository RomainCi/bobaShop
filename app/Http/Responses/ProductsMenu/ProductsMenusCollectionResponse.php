<?php

namespace App\Http\Responses\ProductsMenu;

use App\Http\Resources\ProductsMenu\ProductsMenuCollection;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Collection;
use Symfony\Component\HttpFoundation\Response;

class ProductsMenusCollectionResponse implements \Illuminate\Contracts\Support\Responsable
{

    public function __construct(private readonly Collection $collection, private readonly int $status = 200)
    {}
    /**
     * @inheritDoc
     */
    public function toResponse($request): JsonResponse|Response
    {
        return response()->json(new ProductsMenuCollection($this->collection), $this->status);
    }
}