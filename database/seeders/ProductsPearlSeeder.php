<?php

namespace Database\Seeders;

use App\Models\ProductsPearl;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductsPearlSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $pearls = [
            [
                'name' => 'cerise',
                'color' => '#BB2A39',
                'stock' => 100
            ],
            [
                'name' => 'passion',
                'color' => '#FFA800',
                'stock' => 100
            ],
            [
                'name' => 'pomme verte',
                'color' => '#00F301',
                'stock' => 100
            ],
            [
                'name' => 'tapioca',
                'color' => '#453600',
                'stock' => 100
            ],
            [
                'name' => 'litchi',
                'color' => '#F5E9E9',
                'stock' => 100
            ],
            [
                'name' => 'gelée multi fruit',
                'color' => '#FEC900',
                'stock' => 100
            ],
        ];

        foreach ($pearls as $pearl) {
            ProductsPearl::create($pearl);
        }
    }
}
