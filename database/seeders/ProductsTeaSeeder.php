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
                'name' => 'vert avec jasmin',
                'image_url' => 'images/teas/the-jasmin.png',
                'stock' => 100
            ],
            [
                'name' => 'vert',
                'image_url' => 'images/teas/the-vert.png',
                'stock' => 100
            ],
            [
                'name' => 'noir',
                'image_url' => 'images/teas/the-noir.png',
                'stock' => 100
            ],
        ];
        foreach ($teas as $tea){
            ProductsTea::create($tea);
        }
    }
}
