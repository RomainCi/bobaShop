<?php

namespace Database\Seeders;

use App\Models\ProductsSide;
use Illuminate\Database\Seeder;

class ProductsSideSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $sides = [
            [
                "name" => "humitas",
                'description' => 'Galette de maïs, oignons et basilic enveloppés dans une feuille de bananier cuite à la vapeur.',
                "quantity" => 1,
                "stock" => 100,
                "image_url" => "images/sides/bobashopresize-humitasMais.jpg",
                "price" => 4.40,
            ],
            [
                "name" => "empanadas",
                'description' => 'Chausson de viande hachée, oignons, oeuf, olive et raisin sec',
                "quantity" => 1,
                "stock" => 100,
                "image_url" => "images/sides/bobashopresize-empanadas.jpg",
                "price" => 4.40,
            ],
            [
                "name" => "dim sums",
                'description' => 'Raviole asiatique de choux chinois, oignons, carottes, shiitake et vermicelle de riz.',
                "quantity" => 1,
                "stock" => 100,
                "image_url" => "images/sides/bobashopresize-dimSums.jpg",
                "price" => 4.40,
            ],
            [
                "name" => "onigiri",
                'description' => 'Boule de riz farci au thon et mayonnaise maison.',
                "quantity" => 1,
                "stock" => 100,
                "image_url" => "images/sides/bobashopresize-omigiri.jpg",
                "price" => 4.40,
            ],
            [
                "name" => "mochis",
                'description' => 'Dessert asiatique réalisé avec une pâte de riz gluant farci de glace ou confiture de lait',
                "quantity" => 1,
                "stock" => 100,
                "image_url" => "images/sides/boba-shop-mochis.jpg",
                "price" => 4.40,
            ]
        ];
        foreach ($sides as $side) {
            ProductsSide::create($side);
        }
    }
}
