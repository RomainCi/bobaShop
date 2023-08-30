<?php

namespace App\Services;


use App\Http\Resources\User\BasketResource;
use App\Models\Orders;
use App\Models\OrdersMenu;
use App\Models\OrdersSides;
use Illuminate\Contracts\Auth\Authenticatable;


class OrdersService
{

    public function __construct(Authenticatable $user)
    {
        $this->user = $user;
    }

    public function totalPrice(BasketResource $resource): float|int
    {
        $price = 0;
        foreach ($resource->basketMenu as $item) {
            if (isset($item->menu)) {
                $price += (float)$item->menu->price;
            } else {
                return false;
            }

        }
        return $price;
    }

    public function storeOrders(float $price, string $hours): Orders
    {
        return Orders::create([
            "users_id" => $this->user['id'],
            "total_price" => $price,
            'hours' => $hours,
        ]);
    }

    public function storeOrdersMenus(int $orders_id, BasketResource $resource): bool
    {
        $chunkSize = 1000;
        $res = true;
        foreach (array_chunk($resource->basketMenu->toArray(), $chunkSize) as $chunk) {

            $chunkOrdersMenu = [];
            foreach ($chunk as $key => $value) {

                if (isset($value['pearl']) && isset($value['tea']) && isset($value['syrup']) && isset($value['menu'])) {
                    $chunkOrdersMenu[] = [
                        "pearl_id" => $value['pearl']['id'],
                        "syrup_id" => $value['syrup']['id'],
                        "tea_id" => $value['tea']['id'],
                        "menu_id" => $value['menu']['id'],
                        "price" => (float)$value['menu']['price'],
                        "orders_id" => $orders_id,
                        "created_at" => now(),
                        "updated_at" => now()
                    ];
                } else {
                    $res = false;
                }


            }
            OrdersMenu::insert($chunkOrdersMenu);
        }
        return $res;
    }


    public function storeOrdersSides(Orders $orders, BasketResource $resource): bool
    {
        $chunkSize = 1000;
        $res = true;
        foreach (array_chunk($resource->basketMenu->toArray(), $chunkSize) as $chunk) {
            $chunkOrdersSides = [];
            foreach ($chunk as $key => $value) {

                if (count($value["basket_sides"]) !== 0) {

                    foreach ($value['basket_sides'] as $side) {
                        if (isset($side['side'])) {
                            $chunkOrdersSides[] = [
                                "orders_menus_id" => $orders->ordersMenu[$key]->id,
                                "side_id" => $side["side"]["id"],
                                "created_at" => now(),
                                "updated_at" => now(),
                            ];

                        } else {
                            $res = false;
                        }
                    }
                }
            }
            OrdersSides::insert($chunkOrdersSides);
        }
        return $res;
    }
}
