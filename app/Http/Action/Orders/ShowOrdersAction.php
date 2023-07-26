<?php

namespace App\Http\Action\Orders;

use App\Models\Orders;

class ShowOrdersAction
{
    public function handle(int $id): Orders
    {
        return Orders::select('total_price', 'id')
            ->with(['ordersMenu' => function ($query) {
                $query->select('id', 'menu_id', 'tea_id', 'pearl_id', 'syrup_id', 'orders_id')
                    ->with('menus:id,name,price',
                        'teas:id,name',
                        'pearls:id,name',
                        'syrups:id,name',
                        'sides.side:id,name');
            }])->findOrFail($id);
    }
}