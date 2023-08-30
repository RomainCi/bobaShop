<?php

namespace App\Http\Resources\Order;

use App\Http\Resources\User\BasketSideResource;
use App\Http\Resources\User\ProductMenuResource;
use App\Http\Resources\User\ProductPearlResource;
use App\Http\Resources\User\ProductSyrupResource;
use App\Http\Resources\User\ProductTeaResource;
use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use JsonSerializable;

class ShowOrderMenuRessource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  Request  $request
     * @return array|Arrayable|JsonSerializable
     */
    public function toArray($request): array|JsonSerializable|Arrayable
    {
        return [
            "menu" => ProductMenuResource::make($this->whenLoaded('menus')),
            "pearl" => ProductPearlResource::make($this->whenLoaded('pearls')),
            "syrup" => ProductSyrupResource::make($this->whenLoaded('syrups')),
            "tea" => ProductTeaResource::make($this->whenLoaded('teas')),
            "sides" => BasketSideResource::collection($this->whenLoaded('sides')),
        ];
    }
}
