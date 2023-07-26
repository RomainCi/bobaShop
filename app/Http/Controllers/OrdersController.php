<?php

namespace App\Http\Controllers;

use App\Http\Action\Orders\ShowOrdersAction;
use App\Http\Requests\OrdersRequest;
use App\Jobs\DeleteOrdersJob;
use App\Services\OrdersService;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class OrdersController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param OrdersRequest $request
     * @return JsonResponse
     */
    public function store(OrdersRequest $request): JsonResponse
    {
        try {
            $orders = $request->validated();
            $orders = $orders['data'];

            $sidesNofilter = array_column($orders, 'sides');
            $sides = array_filter($sidesNofilter);
            $menus = array_column($orders, 'menus');
            $price = array_column($menus, 'price');


            $ordersService = new OrdersService();
            $order = $ordersService->storeOrders($price);

            $ordersMenu = $ordersService->storeOrdersMenus($order['id'], $price, $orders);

            $ordersService->storeOrdersSides($ordersMenu, $sides);

            DeleteOrdersJob::dispatch($order['id'])->delay(now()->addRealMinutes(5));

            return response()->json($order['id']);
        } catch (\Exception $e) {
            dd($e);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return JsonResponse
     */
    public function show(int $id): JsonResponse
    {
        if (!Gate::allows('payment', $id)) {
            abort(403);
        }

        $orders = (new ShowOrdersAction())->handle($id);
        $user = Auth::user();
        $userInfo = [
            'firstname' => $user->firstname,
            'lastname' => $user->lastname,
            'email' => $user->email,
            'phone' => $user->phone,
            'birthdays' => $user->birthdays,
            'id'=>$user->id,
        ];
        $userInformation = $user->information;
        return response()->json(["orders" => $orders, "user" => $userInfo, "address" => $userInformation]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return Response
     */
    public function update(Request $request, $id)
    {
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return Response
     */
    public function destroy($id)
    {
        //
    }
}
