<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use App\Models\ProductsTea;
use App\Models\ProductsSyrup;
use App\Models\ProductsPearl;
use App\Models\ProductsSide;

class StockRule implements Rule
{
    protected $stockErrors = [];

    public function passes($attribute, $value)
    {
        $teaIds = [];
        $syrupIds = [];
        $pearlIds = [];
        $sideIds = [];
//dd($value,"la value");
        foreach ($value as $item) {
            if ($item['tea']) {
                $teaIds[] = $item['tea']['id'];
            }

            if ($item['syrup']) {
                $syrupIds[] = $item['syrup']['id'];
            }

            if ($item['pearl']) {
                $pearlIds[] = $item['pearl']['id'];
            }

            if ($item['sides']) {
                foreach ($item['sides'] as $side) {
                    $sideIds[] = $side['id'];
                }
            }
        }

        // Vérifier les stocks de tous les produits en une seule requête
        $insufficientTeas = ProductsTea::whereIn('id', $teaIds)->where('stock', '<', 1)->pluck('id')->toArray();
        $insufficientSyrups = ProductsSyrup::whereIn('id', $syrupIds)->where('stock', '<', 1)->pluck('id')->toArray();
        $insufficientPearls = ProductsPearl::whereIn('id', $pearlIds)->where('stock', '<', 1)->pluck('id')->toArray();

        // Vérifier le stock des sides
        $sideQuantities = [];

        foreach ($sideIds as $sideId) {
            if (!isset($sideQuantities[$sideId])) {
                $sideQuantities[$sideId] = 1;
            } else {
                $sideQuantities[$sideId]++;
            }

            $side = ProductsSide::find($sideId);

            if ($side && $side->stock < $sideQuantities[$sideId]) {
                $insufficientSides[] = $side->name;
            }
        }

        // Générer les messages d'erreur
        if (!empty($insufficientTeas)) {
            $this->stockErrors['tea'] = 'Le stock de thé sélectionné est insuffisant ';
        }
        if (!empty($insufficientSyrups)) {
            $this->stockErrors['syrup'] = 'Le stock de sirop sélectionné est insuffisant';
        }
        if (!empty($insufficientPearls)) {
            $this->stockErrors['pearl'] = 'Le stock de perles sélectionné est insuffisant';
        }
        if (!empty($insufficientSides)) {
            $this->stockErrors['side'] = 'Le stock de sides suivants est insuffisant: ' . implode(', ', $insufficientSides);
        }

        // Retourner true si tous les produits ont un stock suffisant
        return empty($this->stockErrors);
    }

    public function message()
    {
        return $this->stockErrors;
    }
}
