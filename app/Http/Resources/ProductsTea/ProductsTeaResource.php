<?php

namespace App\Http\Resources\ProductsTea;

use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductsTeaResource extends JsonResource
{


    /**
     * Transform the resource into an array.
     *
     * @param Request $request
     * @return array|Arrayable|\JsonSerializable
     */
    public function toArray($request): array|\JsonSerializable|Arrayable
    {
        return [
            "id" => $this->id,
            "image_url" => $this->when($this->show, $this->image_url),
            "name" => $this->name,
            "stock" => $this->stock,
        ];
    }
}
