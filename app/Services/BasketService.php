<?php

namespace App\Services;

use App\Http\Resources\User\BasketResource;
use App\Models\Basket;
use App\Models\BasketMenu;
use App\Models\BasketSides;
use App\Models\ProductsPearl;
use App\Models\ProductsSide;
use App\Models\ProductsSyrup;
use App\Models\ProductsTea;
use Exception;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Throwable;

class BasketService
{

    private string $token;

    public function __construct(string $token)
    {
        $this->token = $token;
    }

    public function checkToken(): false|string
    {
        if ($this->token === "null") {
            return false;
        }
        return $this->token;
    }


    /**
     * @throws Throwable
     */
    public function storeBasket(): Basket
    {
        if ($this->token === "null") { // Correction de la comparaison
            $randomBytes = random_bytes(64);
            $this->token = bin2hex($randomBytes);
        }

        $basket = null;

        DB::transaction(function () use (&$basket) { // Capture de $basket
            try {
                $basket = Basket::firstOrCreate(['token' => $this->token]);

                if ($basket->exists) {
                    $basket->touch();
                }

            } catch (\Exception $e) {
                Log::error('Erreur dans le service storeBasket: ' . $e->getMessage());
            }
        });

        return $basket;
    }

    /**
     * @throws Throwable
     */
    public function storeBasketMenus(array $basketData): int
    {
        $basketMenu = null;
        DB::transaction(function () use ($basketData, &$basketMenu) {
            try {
                $basketMenu = BasketMenu::Create($basketData);
                // Si tout se passe bien, la transaction sera validée
            } catch (Exception $e) {
                // En cas d'erreur, la transaction sera annulée
                Log::error('Error dans le service storeBasketMenus' . $e->getMessage());
            }
        });

        return $basketMenu->id;
    }


    /**
     * @throws Throwable
     */
    public function storeBasketSides(int $basketMenu_id, array $basketSides): void
    {
        DB::transaction(function () use ($basketMenu_id, &$basketSides) {
            try {
                foreach ($basketSides as $basketSide) {
                    BasketSides::create([
                        "basket_menus_id" => $basketMenu_id,
                        "side_id" => $basketSide['id'],
                    ]);

                }
                // Si tout se passe bien, la transaction sera validée
            } catch (Exception $e) {
                // En cas d'erreur, la transaction sera annulée
                Log::error('Error dans le service storeBasketSides' . $e->getMessage());
            }
        });
    }


    /**
     * @throws Throwable
     */
    public function updateStock(array $basket, array $basketSides, int $nbr): bool
    {

        DB::beginTransaction();
        try {
            // Mise à jour du stock pour le produit "Tea"
            $this->updateProductStock(ProductsTea::class, $basket['tea_id'], $nbr);

            // Mise à jour du stock pour le produit "Syrup"
            $this->updateProductStock(ProductsSyrup::class, $basket['syrup_id'], $nbr);

            // Mise à jour du stock pour le produit "Pearl"
            $this->updateProductStock(ProductsPearl::class, $basket['pearl_id'], $nbr);

            // Mise à jour du stock pour chaque produit "Side"
            if (!empty($basketSides)) {
                foreach ($basketSides as $side) {
                    $this->updateProductStock(ProductsSide::class, $side['id'], $nbr);
                }
            }

            DB::commit();
            return true;
        } catch (\Exception $e) {
            DB::rollback();
            // Enregistrez l'erreur dans les logs
            Log::error('Error updating stock: ' . $e->getMessage());
            return false;
        }
    }

    private function updateProductStock(string $productClass, int $productId, int $quantity): void
    {
        $product = new $productClass();
        $product = $product->find($productId);

        if ($product) {
            $product->lockForUpdate();
            $product->stock += $quantity;
            $product->save();
        } else {
            Log::warning('Product with ID ' . $productId . ' not found.');
        }
    }

    /**
     * @throws Throwable
     */
    public function showBasket()
    {
        $basket = Basket::with(['basketMenu.menu', 'basketMenu.pearl', 'basketMenu.tea', 'basketMenu.syrup', 'basketMenu.basketSides.side'])->where('token', $this->token)->first();
        if($basket){
            $basket->touch();
            return new BasketResource($basket);
        }else{
            return $basket;
        }
    }

    public function checkDestroy(string $basketToken): bool
    {
        $check = true;
        if ($this->token !== $basketToken) {
            $check = false;
        }
        return $check;
    }


    /**
     * @throws Throwable
     */
    public function DestroyBasket(BasketMenu $basketMenu): bool
    {
        $success = false;
        DB::transaction(function () use ($basketMenu, &$success) {
//            throw new \Exception('Simulated error inside the transaction');
            try {
                $basketMenu->delete();
                $success = true;
            } catch (\Exception $e) {
                Log::error('Error dans le service DestroyBasket' . $e->getMessage());
            }

        });
        return $success;
    }
}
