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
            "email" => "admin@gmail.com",
            "password" => \Hash::make("admin"),
        ];
        UsersAdmin::create($user);
    }
}
