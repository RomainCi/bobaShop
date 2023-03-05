<?php

namespace Database\Seeders;

use App\Models\ProductsBubble;
use Illuminate\Database\Seeder;

class ProductsBubbleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        $products = [
            [
                'name' => 'pêche',
                'type' => 'sirop',
                'stock' => 100
            ],
            [
                'name' => 'brown sugar',
                'type' => 'sirop',
                'stock' => 100
            ],
            [
                'name' => 'kiwi',
                'type' => 'sirop',
                'stock' => 100
            ],
            [
                'name' => 'passion',
                'type' => 'sirop',
                'stock' => 100
            ],
            [
                'name' => 'mangue',
                'type' => 'sirop',
                'stock' => 100
            ],
            [
                'name' => 'citron',
                'type' => 'sirop',
                'stock' => 100
            ],
            [
                'name' => 'framboise',
                'type' => 'sirop',
                'stock' => 100
            ],
            [
                'name' => 'cerise',
                'type' => 'perle',
                'stock' => 100
            ],
            [
                'name' => 'passion',
                'type' => 'perle',
                'stock' => 100
            ],
            [
                'name' => 'pomme verte',
                'type' => 'perle',
                'stock' => 100
            ],
            [
                'name' => 'tapioca',
                'type' => 'perle',
                'stock' => 100
            ],
            [
                'name' => 'litchi',
                'type' => 'perle',
                'stock' => 100
            ],
            [
                'name' => 'gelée multi fruit',
                'type' => 'perle',
                'stock' => 100
            ],
            [
                'name' => 'vert avec jasmin',
                'type' => 'thé',
                'stock' => 100
            ],
            [
                'name' => 'vert',
                'type' => 'thé',
                'stock' => 100
            ],
            [
                'name' => 'noir',
                'type' => 'thé',
                'stock' => 100
            ],
            [
                "name" => "humitas",
                'type' => 'side',
                "stock" => 100
            ],
            [
                "name" => "empanadas",
                'type' => 'side',
                "stock" => 100,
            ],
            [
                "name" => "dim sums",
                'type' => 'side',
                "stock" => 100
            ],
            [
                "name" => "onigiri",
                'type' => 'side',
                "stock" => 100
            ],
            [
                "name" => "mochis",
                'type' => 'side',
                "stock" => 100
            ]
        ];

        foreach ($products as $product) {
            ProductsBubble::create($product);
        }
    }
}
