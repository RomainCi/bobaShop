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
                'stock' => 0
            ],
            [
                'name' => 'brown sugar',
                'type' => 'sirop',
                'stock' => 0
            ],
            [
                'name' => 'kiwi',
                'type' => 'sirop',
                'stock' => 0
            ],
            [
                'name' => 'passion',
                'type' => 'sirop',
                'stock' => 0
            ],
            [
                'name' => 'mangue',
                'type' => 'sirop',
                'stock' => 0
            ],
            [
                'name' => 'citron',
                'type' => 'sirop',
                'stock' => 0
            ],
            [
                'name' => 'framboise',
                'type' => 'sirop',
                'stock' => 0
            ],
            [
                'name' => 'cerise',
                'type' => 'perle',
                'stock' => 0
            ],
            [
                'name' => 'passion',
                'type' => 'perle',
                'stock' => 0
            ],
            [
                'name' => 'pomme verte',
                'type' => 'perle',
                'stock' => 0
            ],
            [
                'name' => 'tapioca',
                'type' => 'perle',
                'stock' => 0
            ],
            [
                'name' => 'litchi',
                'type' => 'perle',
                'stock' => 0
            ],
            [
                'name' => 'gelée multi fruit',
                'type' => 'perle',
                'stock' => 0
            ],
            [
                'name' => 'vert avec jasmin',
                'type' => 'thé',
                'stock' => 0
            ],
            [
                'name' => 'vert',
                'type' => 'thé',
                'stock' => 0
            ],
            [
                'name' => 'noir',
                'type' => 'thé',
                'stock' => 0
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
