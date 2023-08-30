<?php

namespace App\Http\Controllers;

use App\Models\Orders;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class PaymentIndexController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request, int $id)
    {
        if (!Gate::allows('payment', $id)) {
            abort(403);
        }
        $orders = Orders::select('total_price','id')
            ->with(['ordersMenu' => function ($query) {
                $query->select('id', 'menu_id', 'tea_id', 'pearl_id', 'syrup_id','orders_id')
                    ->with('menus:id,name,price',
                        'teas:id,name',
                        'pearls:id,name',
                        'syrups:id,name',
                        'sides.side:id,name');
            }])->findOrFail($id);

//  $orders = Orders::with(['ordersMenu.menus', 'ordersMenu.teas', 'ordersMenu.pearls', 'ordersMenu.syrups', 'ordersMenu.sides.side'])->findOrFail($id);
        dd($orders);

    }
}
