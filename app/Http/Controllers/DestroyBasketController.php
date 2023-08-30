<?php

namespace App\Http\Controllers;

use App\Models\BasketMenu;
use App\Services\BasketService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Throwable;

class DestroyBasketController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param Request $request
     * @param BasketMenu $basketMenu
     * @return JsonResponse
     * @throws Throwable
     */
    public function __invoke(Request $request, BasketMenu $basketMenu, BasketService $basketService): JsonResponse
    {
        if(!$basketService->checkDestroy($basketMenu->basket->token)){
           return response()->json([
               "status" => "denied",
               "message" => "Suppression refusé"
           ], 403);
       }

        $sides = $basketMenu->basketSides->map(function ($side) {
            return ['id' => $side->side_id];
        })->toArray();

        $basketMenuArray = $basketMenu->toArray();

        try {
            DB::beginTransaction();

            $res1 = $basketService->updateStock($basketMenuArray, $sides, 1);
            $res2 = $basketService->destroyBasket($basketMenu);

            if (!$res1 || !$res2) {
                DB::rollback();
                return new JsonResponse([
                    'status' => 'error',
                    'message' => "Erreur lors du traitement de la suppression. Veuillez essayer ultérieurement. Si le problème persiste, contactez l'équipe de BobaShop"
                ], 500);
            }
            $basketMenu->basket->touch();
            DB::commit(); // Si tout s'est bien passé, confirme la transaction
        } catch (\Exception $e) {
            DB::rollback(); // En cas d'erreur, annule la transaction
            Log::error('Error during transaction: ' . $e->getMessage());
            return new JsonResponse(['status' => 'error', 'message' => 'Erreur lors du traitement de la commande.'], 500);
        }


        $response = new JsonResponse([
            "status" => 'success',
            'message' => 'Votre article a bien été supprimé'
        ], 200);
        $cookie = Cookie::make('basket_token', $basketMenu->basket->token, 300); // Crée un cookie nommé 'basket_token' avec le token
        $response->withCookie($cookie);
        return $response;
    }
}
