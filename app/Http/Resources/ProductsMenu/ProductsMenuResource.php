<?php

namespace App\Http\Resources\ProductsMenu;

use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use JsonSerializable;

class ProductsMenuResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param Request $request
     * @return array|Arrayable|JsonSerializable
     */
    public function toArray($request): JsonSerializable|array|Arrayable
    {
        return [
            "id" => $this->id,
            "name" => $this->name,
            "size" => $this->size,
            "sides" => $this->sides,
            "price" => $this->price,
        ];
    }
}
