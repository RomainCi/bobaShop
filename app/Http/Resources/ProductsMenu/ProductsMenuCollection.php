<?php

namespace App\Http\Resources\ProductsMenu;

use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;
use JsonSerializable;

class ProductsMenuCollection extends ResourceCollection
{
    public $collection = ProductsMenuResource::class;
    /**
     * Transform the resource collection into an array.
     *
     * @param  Request  $request
     * @return array
     */
    public function toArray($request): array
    {
        return [
            "data"=> $this->collection
        ];
    }
}
