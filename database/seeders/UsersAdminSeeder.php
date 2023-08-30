<?php

namespace Database\Seeders;

use App\Models\UsersAdmin;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UsersAdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = [
            "email" => "admin@boba-shop.fr",
            "password" => \Hash::make("zqJ@zb@J@DSXyzK&RhY4whm1eprTPrVVMQJQvC5B"),
        ];
        UsersAdmin::create($user);
    }
}
