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
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        $menuPrices = ProductsMenu::pluck('price', 'id')->toArray();
        $teaIds = ProductsTea::pluck('id')->toArray();
        $syrupIds = ProductsSyrup::pluck('id')->toArray();
        $pearlIds = ProductsPearl::pluck('id')->toArray();
        $sideIds = ProductsSide::pluck('id')->toArray();
        $menusSides = ProductsMenu::pluck('sides','id')->toArray();
//        dd($menusSides);

        foreach ($value as $item) {
            if ($item['sides'] !== null) {
                $numSides = count($item['sides']);
            } else {
                $numSides = 0;
            }
//            dd($item['menus']['id'],$menusSides[$item['menus']['id']],$numSides);
            // Vérifier que chaque élément du tableau a des clés valides
            if (!isset($item['teas'], $item['syrups'], $item['pearls'], $item['menus'])) {
                return false;
            }
            // Vérifier que les clés 'id' de chaque élément sont des entiers valides
            if (!in_array($item['teas']['id'], $teaIds)
                || !in_array($item['syrups']['id'], $syrupIds)
                || !in_array($item['pearls']['id'], $pearlIds)
                || !array_key_exists($item['menus']['id'], $menuPrices)
                || $item['menus']['price'] !== $menuPrices[$item['menus']['id']]
                || $menusSides[$item['menus']['id']] !== $numSides
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
        return 'The validation error message.';
    }
}
