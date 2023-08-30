<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use App\Models\ProductsMenu;
use App\Models\ProductsTea;
use App\Models\ProductsSyrup;
use App\Models\ProductsPearl;
use App\Models\ProductsSide;

class OrdersRule implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param string $attribute
     * @param mixed $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        $menuPrices = ProductsMenu::pluck('price', 'id')->toArray();
        $teaIds = ProductsTea::pluck('id')->toArray();
        $syrupIds = ProductsSyrup::pluck('id')->toArray();
        $pearlIds = ProductsPearl::pluck('id')->toArray();
        $sideIds = ProductsSide::pluck('id')->toArray();
        $menusSides = ProductsMenu::pluck('sides', 'id')->toArray();


        foreach ($value as $item) {
            if(!empty($item['sides'])){
                $numSides = count($item['sides']);
            }else{
                $numSides = 0;
            }

            // Vérifier que chaque élément du tableau a des clés valides
            if (!isset($item['tea'], $item['syrup'], $item['pearl'], $item['menu'])) {
                return false;
            }
            // Vérifier que les clés 'id' de chaque élément sont des entiers valides
            if (!in_array($item['tea']['id'], $teaIds)
                || !in_array($item['syrup']['id'], $syrupIds)
                || !in_array($item['pearl']['id'], $pearlIds)
                || !array_key_exists($item['menu']['id'], $menuPrices)
                || $item['menu']['price'] !== $menuPrices[$item['menu']['id']]
                || $menusSides[$item['menu']['id']] !== $numSides
            ) {
                return false;
            }

            // Vérifier que le tableau 'sides' s'il existe, a des 'id' valides
            if (isset($item['sides'])) {
                foreach ($item['sides'] as $side) {
                    if (!in_array($side['id'], $sideIds)) {
                        return false;
                    }
                }
            }
        }

        return true;
    }


    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'Erreur avec la commande';
    }
}
