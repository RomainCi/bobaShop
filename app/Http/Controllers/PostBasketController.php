<?php

namespace App\Http\Controllers;

use App\Http\Requests\PostBasketRequest;
use App\Models\Basket;
use App\Models\ProductsPearl;
use App\Models\ProductsSide;
use App\Models\ProductsSyrup;
use App\Models\ProductsTea;
use App\Services\BasketService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Log;

class PostBasketController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param PostBasketRequest $request
     * @return JsonResponse
     * @throws \Throwable
     */
    public function __invoke(PostBasketRequest $request, BasketService $basketService): JsonResponse
    {
        $basket = $request->validated();
        $basket = $basket['data'][0];
        $basketData = [
            'pearl_id' => $basket['pearl']['id'],
            'syrup_id' => $basket['syrup']['id'],
            "tea_id" => $basket['tea']['id'],
            "menu_id" => $basket['menu']['id'],
        ];
        try {
            DB::beginTransaction();
            $resBasket = $basketService->storeBasket();
            $token = $resBasket->token;
            $basketData["baskets_id"] = $resBasket->id;

            $basketMenu_id = $basketService->storeBasketMenus($basketData);

            if (!empty($basket['sides'])) {
                $basketService->storeBasketSides($basketMenu_id, $basket['sides']);
            }
            $res = $basketService->updateStock($basketData, $basket['sides'], -1);
            if (!$res) {
                throw new \Exception('Error dans la transaction updateStock');
            }
            DB::commit(); // Si tout s'est bien passé, confirme la transaction
        } catch (\Exception $e) {
            DB::rollback(); // En cas d'erreur, annule la transaction
            Log::error('Error during transaction: ' . $e->getMessage());
            return new JsonResponse(['status' => 'error', 'message' => 'Erreur lors du traitement de la commande.'], 500);
        }


        $response = new JsonResponse([
            "status" => 'success',
            'message' => 'Votre article a bien été ajouté dans le panier.'
        ], 200);
        $cookie = Cookie::make('basket_token', $token, 300); // Crée un cookie nommé 'basket_token' avec le token
        $response->withCookie($cookie);
        return $response;
    }
}
