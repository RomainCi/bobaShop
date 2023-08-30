<?php

namespace App\Http\Resources\Order;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ShowUserInformationRessource extends JsonResource
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
            "street" => $this->street,
            "country" => $this->country,
            "postal_code" => $this->postal_code,
            "city" => $this->city,
            "society" => $this->society,
        ];
    }
}
