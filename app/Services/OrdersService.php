<?php

namespace App\Services;


use App\Models\Orders;
use App\Models\OrdersMenu;
use App\Models\OrdersSides;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class OrdersService
{
    public function storeOrders(array $price): Orders
    {
        $price = collect($price)->sum();
        return Orders::create([
            "users_id" => Auth::user()->id,
            "total_price" => $price
        ]);
    }
    public function storeOrdersMenus(int $orders_id, array $price, array $orders): Collection
    {
        $chunkSize = 1000;

        foreach (array_chunk($orders, $chunkSize) as $chunk) {
            $chunkOrdersMenu = [];

            foreach ($chunk as $key => $value) {
                $chunkOrdersMenu[] = [
                    "pearl_id" => $value['pearls']["id"],
                    "syrup_id" => $value['syrups']["id"],
                    "tea_id" => $value['teas']["id"],
                    "menu_id" => $value['menus']["id"],
                    "price" => $price[$key],
                    "orders_id" => $orders_id,
                ];
            }

            OrdersMenu::insert($chunkOrdersMenu);


        }
        $ordersMenu = DB::table('orders_menus')
            ->where('orders_id', $orders_id)
            ->select('id')
            ->get()
            ->toArray();

        return collect($ordersMenu);


    }


    public function storeOrdersSides($ordersMenu, $sides)
    {
        $orderSides = [];

        foreach ($sides as $key => $side) {
            if ($side !== null) {
                foreach ($side as $sid) {
                    $orderSides[] = [
                        "orders_menus_id" => $ordersMenu[$key]->id,
                        "side_id" => $sid["id"],
                    ];
                }
            }
        }

        if (!empty($orderSides)) {
            $chunks = array_chunk($orderSides, 2000); // Modifier la taille des chunks en fonction de la taille de la table
            foreach ($chunks as $chunk) {
                OrdersSides::insert($chunk);
            }
        }

    }
}
