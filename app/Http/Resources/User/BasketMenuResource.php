<?php

namespace App\Http\Resources\User;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;


class BasketMenuResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param Request $request
     * @return array
     */
    public function toArray($request): array
    {
        return [
            "id" => $this->id,
            "menu" => ProductMenuResource::make($this->whenLoaded('menu')),
            "pearl" => ProductPearlResource::make($this->whenLoaded('pearl')),
            "syrup" => ProductSyrupResource::make($this->whenLoaded('syrup')),
            "tea" => ProductTeaResource::make($this->whenLoaded('tea')),
            "sides"=>BasketSideResource::collection($this->whenLoaded('basketSides')),
        ];
    }
}
