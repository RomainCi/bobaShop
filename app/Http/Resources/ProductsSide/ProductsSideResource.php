<?php

namespace App\Http\Resources\ProductsSide;

use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use JsonSerializable;

class ProductsSideResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param Request $request
     * @return array|Arrayable|JsonSerializable
     */
    public function toArray($request): array|JsonSerializable|Arrayable
    {
        return [
            "id" => $this->id,
            "name" => $this->name,
            "description" => $this->when($this->show, $this->description),
            "price" => $this->when($this->show, $this->price),
            "quantity" => $this->quantity,
            "image_url" => $this->when($this->show, $this->image_url),
            "stock" => $this->stock,
        ];
    }
}
