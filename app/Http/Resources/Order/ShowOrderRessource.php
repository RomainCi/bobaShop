<?php

namespace App\Http\Resources\Order;


use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ShowOrderRessource extends JsonResource
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
            "user" => ShowUserRessource::make($this->whenLoaded("user")),
            "products" => ShowOrderMenuRessource::collection($this->whenLoaded('ordersMenu')),
            "order" => [
                "total_price" => $this->total_price,
                "hours" => $this->hours,
                "id" => $this->id,
            ],

            "status" => "success",
        ];
    }
}
