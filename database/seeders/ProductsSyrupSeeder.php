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
                'stock' => 0
            ],
            [
                'name' => 'brown sugar',
                'color' => '#8B5900',
                'stock' => 0
            ],
            [
                'name' => 'kiwi',
                'color' => '#A9F18E',
                'stock' => 0
            ],
            [
                'name' => 'passion',
                'color' => '#FFA800',
                'stock' => 0
            ],
            [
                'name' => 'mangue',
                'color' => '#FBB201',
                'stock' => 0
            ],
            [
                'name' => 'citron',
                'color' => '#F0DE00',
                'stock' => 0
            ],
            [
                'name' => 'framboise',
                'color' => '#D85A5D',
                'stock' => 0
            ],
        ];
        foreach ($syrups as $syrup){
            ProductsSyrup::create($syrup);
        }
    }
}
