<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Users_Admin;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(UsersTableSeeder::class);
//        $this->call(ProductsMenuSeeder::class);
//        $this->call(UsersAdminSeeder::class);
//        $this->call(ProductsPearlSeeder::class);
//        $this->call(ProductsSideSeeder::class);
//        $this->call(ProductsSyrupSeeder::class);
//        $this->call(ProductsTeaSeeder::class);
        $this->call(UsersInformationSeeder::class);
    }
}
