<?php

namespace App\Http\Resources\ProductsTea;

use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;

class ProductsTeaCollection extends ResourceCollection

{
    public $collects = ProductsTeaResource::class;

    /**
     * Transform the resource collection into an array.
     *
     * @param  Request  $request
     * @return array
     */
    public function toArray($request): array
    {
        return [
          'data' => $this->collection
        ];
    }
}
