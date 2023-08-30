<?php

namespace App\Http\Controllers;


use App\Models\Basket;
use App\Models\BasketMenu;
use App\Services\BasketService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\DB;
use Throwable;

class ShowBasketController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param Request $request
     * @return JsonResponse
     * @throws Throwable
     */
    public function __invoke(Request $request, BasketService $basketService)
    {
        $token = $basketService->checkToken();
        if (!$token) {
            return response()->json([
                "status" => "error",
                "message" => "Votre panier est vide"
            ]);
        }

        ///RECUPERATION DES DONNES//////////////////
        $basket = $basketService->showBasket();

        if ($basket === null) {
            $response = new JsonResponse([
                "status" => 'expire',
                'data' => $basket,
                'message' => 'Votre panier a expiré'
            ], 200);
            $cookie = Cookie::forget('basket_token');
            $response->withCookie($cookie);
            return $response;
        }

        $response = new JsonResponse([
            "status" => 'success',
            'data' => $basket,
            'message' => 'Votre panier a bien était chargé'
        ], 200);
        $cookie = Cookie::make('basket_token', $token, 300); // Crée un cookie nommé 'basket_token' avec le token
        $response->withCookie($cookie);
        return $response;
//        if ($choice === null) {
//            $response = new JsonResponse([
//                "status" => 'expire',
//                'data' => $choice,
//                'message' => 'Votre panier a expiré'
//            ], 200);
//            $cookie = Cookie::forget('basket_token');
//            $response->withCookie($cookie);
//            return $response;
//        } elseif (!$choice) {
//            return response()->json([
//                "status" => "error",
//                "message" => "Une erreur s'est produite. Veuillez essayer ultérieurement. Si le problème persiste, contactez l'équipe de BobaShop"
//            ], 500);
//        }
//
//
//        /////VERIFICATION ERREUR ET TRAITEMENT DES ERREURS /////////////
//        DB::transaction(function () use ($choice, $basketService) {
//            foreach ($choice as $item) {
//                $exist = array_key_exists('error', $item);
//                if ($exist) {
//                    $basketMenu = BasketMenu::find($item['id']);
//                    $sides = $basketMenu->basketSides->map(function ($side) {
//                        return ['id' => $side->side_id];
//                    })->toArray();
//                    $basketMenuArray = $basketMenu->toArray();
//
//                    // Update stock
//                    $res = $basketService->updateStock($basketMenuArray, $sides, 1);
//                    if (!$res) {
//                        throw new \Exception('Failed to update stock');
//                    }
//
//                    // Destroy basket
//                    $res = $basketService->destroyBasket($basketMenu);
//                    if (!$res) {
//                        throw new \Exception('Failed to destroy basket');
//                    }
//                }
//            }
//        });
//
//
//        Basket::where('token', $token)->lockForUpdate()->touch();
//
//
//        if (count($choice) === 0) {
//            $response = new JsonResponse([
//                "status" => 'expire',
//                'data' => $choice,
//                'message' => 'Votre panier est vide'
//            ], 200);
//            $cookie = Cookie::make('basket_token', $token, 300); // Crée un cookie nommé 'basket_token' avec le token
//            $response->withCookie($cookie);
//            return $response;
//        }
//
//
//        $response = new JsonResponse([
//            "status" => 'success',
//            'data' => $choice,
//            'message' => 'Votre panier a bien était chargé'
//        ], 200);
//        $cookie = Cookie::make('basket_token', $token, 300); // Crée un cookie nommé 'basket_token' avec le token
//        $response->withCookie($cookie);
//        return $response;
    }
}
