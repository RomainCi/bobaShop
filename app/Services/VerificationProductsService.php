<?php

namespace App\Services;


use App\Models\ProductsMenu;
use App\Models\ProductsPearl;
use App\Models\ProductsSide;
use App\Models\ProductsSyrup;
use App\Models\ProductsTea;
use Exception;
use Illuminate\Support\Collection;

class VerificationProductsService
{
    protected readonly array $orders;
    protected readonly int $count;

    public function __construct(array $orders, int $count)
    {
        $this->teas = array_column($orders, 'teas');
        $this->menus = array_column($orders, 'menus');
        $this->pearls = array_column($orders, 'pearls');
        $this->syrups = array_column($orders, 'syrups');
        $this->sidesNofilter = array_column($orders, 'sides');
        $this->sides = array_filter($this->sidesNofilter);
        $this->sides = array_merge(...$this->sides);
        $this->count = $count;
    }

    public function teas(): void
    {
        if (count($this->teas) !== $this->count) {
            response()->json('the number of tea is not good', 403)->send();
            exit;
        }
        try {
            foreach ($this->teas as $tea) {
                ProductsTea::findOrFail($tea['id']);
            }
        } catch (Exception $e) {
            response()->json('not found teas', 404)->send();
            exit;
        }
    }

    public function syrups(): void
    {
        if (count($this->syrups) !== $this->count) {
            response()->json('the number of syrups is not good', 403)->send();
            exit;
        }
        try {
            foreach ($this->syrups as $syrup) {
                ProductsSyrup::findOrFail($syrup['id']);
            }
        } catch (\Exception $e) {
            response()->json('not found syrups', 404)->send();
            exit;
        }
    }

    public function pearls(): void
    {
        if (count($this->pearls) !== $this->count) {
            response()->json('the number of pearls is not good', 403)->send();
            exit;
        }
        try {
            foreach ($this->pearls as $pearl) {
                ProductsPearl::findOrFail($pearl['id']);
            }
        } catch (\Exception $e) {
            response()->json('not found pearls', 404)->send();
            exit;
        }
    }

    public function sides($sidesMenu)
    {
        if (count($this->sides) !== $sidesMenu) {
            response()->json('the number of sides is not good', 403)->send();
            exit;
        }
        try {
            foreach ($this->sides as $side) {
                ProductsSide::findOrFail($side['id']);
            }
        } catch (\Exception $e) {
            response()->json('not found sides', 404)->send();
            exit;
        }

        return $this->sidesNofilter;
    }

    public function menus(): array
    {
        if (count($this->menus) !== $this->count) {
            response()->json('the number of menus is not good', 403)->send();
            exit;
        }
        $sum = new Collection();
        $totalSides = 0;
        try {
            foreach ($this->menus as $menu) {
                $product = ProductsMenu::findOrFail($menu['id']);
                $sum->push($product->price);
                $totalSides += $product->sides;
            }
        } catch (\Exception $e) {
            response()->json('not found menus', 404)->send();
            exit;
        }

        return [
            'price' => $sum,
            'total_sides' => $totalSides
        ];

    }

}
