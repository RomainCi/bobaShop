<?php

namespace App\Http\Resources\Order;


use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ShowUserRessource extends JsonResource
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
            "lastname" => $this->lastname,
            "firstname" => $this->firstname,
            "phone" => $this->phone,
            "birthdays" => $this->birthdays,
            "email" => $this->email,
            "information" => ShowUserInformationRessource::make($this->whenLoaded('information')),
        ];
    }
}
