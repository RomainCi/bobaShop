<?php

namespace App\Http\Responses\ProductsTea;

use App\Http\Resources\ProductsTea\ProductsTeaCollection;
use Illuminate\Contracts\Support\Responsable;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Collection;
use Symfony\Component\HttpFoundation\Response;

class ProductsTeaCollectionResponse implements Responsable
{
    public function __construct(private readonly Collection $collection, private readonly int $status = 200)
    {
    }

    /**
     * @inheritDocw
     */
    public function toResponse($request): JsonResponse|Response
    {
        return response()->json(new ProductsTeaCollection($this->collection), $this->status);
    }
}