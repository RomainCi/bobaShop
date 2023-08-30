<?php

namespace Database\Seeders;

use App\Models\ProductsTea;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductsTeaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $teas = [
            [
                'name' => 'vert au jasmin',
                'image_url' => 'images/teas/the-jasmin.png',
                'stock' => 0
            ],
            [
                'name' => 'vert',
                'image_url' => 'images/teas/the-vert.png',
                'stock' => 0
            ],
            [
                'name' => 'noir',
                'image_url' => 'images/teas/the-noir.png',
                'stock' => 0
            ],
        ];
        foreach ($teas as $tea){
            ProductsTea::create($tea);
        }
    }
}
