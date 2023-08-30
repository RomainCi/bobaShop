<?php

namespace Database\Seeders;

use App\Models\ProductsMenu;
use Illuminate\Database\Seeder;

class ProductsMenuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $menus = [
            [
                "name" => "petit bubble tea",
                "sides" => 0,
                "size" => 500,
                "price" => 5.50
            ],
            [
                "name" => "grand bubble tea",
                "sides" => 0,
                "size" => 700,
                "price" => 6.60
            ],
            [
                "name" => "formule petite",
                "sides" => 1,
                "size" => 500,
                "price" => 7.10
            ],
            [
                "name" => "formule moyenne",
                "sides" => 2,
                "size" => 500,
                "price" => 9.30
            ],
            [
                "name" => "formule grande",
                "sides" => 3,
                "size" => 500,
                "price" => 11.50,
            ]
        ];
        foreach ($menus as $menu) {
            ProductsMenu::create($menu);
        }
    }
}
