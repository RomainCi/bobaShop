<?php

namespace App\Http\Controllers;

use App\Http\Requests\OrdersRequest;
use App\Http\Resources\Order\ShowOrderRessource;
use App\Jobs\DeleteOrdersJob;
use App\Models\Orders;
use App\Services\BasketService;
use App\Services\OrdersService;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Log;
use Throwable;

class OrdersController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return void
     */
    public function index(): void
    {
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param OrdersRequest $request
     * @param BasketService $basketService
     * @param OrdersService $ordersService
     * @return JsonResponse
     * @throws Throwable
     */
    public function store(OrdersRequest $request, BasketService $basketService, OrdersService $ordersService): JsonResponse
    {
        $orders = $request->validated();
        $hours = $orders['hours'];
        $token = $basketService->checkToken();
        if (!$token) {
            return response()->json([
                "status" => "error",
                "message" => "Votre panier est vide"
            ], 400);
        }

        ///RECUPERATION DES DONNES//////////////////
        $basket = $basketService->showBasket();
        if ($basket === null) {
            return new JsonResponse([
                "status" => 'expire',
                'message' => 'Votre panier a expiré'
            ], 400);
        }

        $price = $ordersService->totalPrice($basket);
        if (!$price) {
            return response()->json([
                "status" => "error",
                "message" => "Une erreur c'est produite"
            ], 400);
        }

        DB::beginTransaction();

        try {
            $order = $ordersService->storeOrders($price, $hours);
            $res = $ordersService->storeOrdersMenus($order['id'], $basket);
            if (!$res) {
                throw new Exception('Erreur dans $ordersService->storeOrdersMenus');
            }
            $res = $ordersService->storeOrdersSides($order, $basket);
            if (!$res) {
                throw new Exception('Erreur dans $ordersService->storeOrdersSides');
            }
            DB::commit();
            DeleteOrdersJob::dispatch($order['id'])->delay(now()->addRealMinutes(5));
            return response()->json([
                "id" => $order['id'],
                "status" => "success",
                "message" => "success",
            ]);
        } catch (Exception $e) {
            DB::rollBack();
            Log::error('Error dans la transaction pour storeOrder' . $e->getMessage());
            return response()->json([
                "status" => "error",
                "message" => "Une erreur c'est produite"
            ], 400);
        }


    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return ShowOrderRessource|JsonResponse
     */
    public function show(int $id): ShowOrderRessource|JsonResponse
    {
        if (!Gate::allows('payment', $id)) {
            return response()->json([
                "status" => "error",
                "message" => "Vous n'avez pas l'autorisation"
            ], 403);
        }
        try {
            $order = Orders::with(['user.information', 'ordersMenu.menus', 'ordersMenu.teas', 'ordersMenu.pearls', 'ordersMenu.syrups', 'ordersMenu.teas', 'ordersMenu.sides.side'])->findOrFail($id);
            return new ShowOrderRessource($order);
        } catch (Exception $e) {
            Log::error('Error dans la transaction pour OrdersShow' . $e->getMessage());
            return response()->json([
                "status" => "error",
                "message" => "Une erreur c'est produite"
            ], 500);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param int $id
     * @return void
     */
    public function update(Request $request, int $id): void
    {
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return void
     */
    public function destroy(int $id): void
    {
        //
    }
}
