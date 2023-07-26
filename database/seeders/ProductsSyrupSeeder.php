<?php

namespace Database\Seeders;

use App\Models\ProductsSyrup;
use Illuminate\Database\Seeder;

class ProductsSyrupSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $syrups = [
            [
                'name' => 'pêche',
                'color' => '#EF9300',
                'stock' => 100
            ],
            [
                'name' => 'brown sugar',
                'color' => '#8B5900',
                'stock' => 100
            ],
            [
                'name' => 'kiwi',
                'color' => '#A9F18E',
                'stock' => 100
            ],
            [
                'name' => 'passion',
                'color' => '#FFA800',
                'stock' => 100
            ],
            [
                'name' => 'mangue',
                'color' => '#FBB201',
                'stock' => 100
            ],
            [
                'name' => 'citron',
                'color' => '#F0DE00',
                'stock' => 100
            ],
            [
                'name' => 'framboise',
                'color' => '#D85A5D',
                'stock' => 100
            ],
        ];
        foreach ($syrups as $syrup){
            ProductsSyrup::create($syrup);
        }
    }
}
