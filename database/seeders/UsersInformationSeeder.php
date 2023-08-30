<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\UsersInformations;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UsersInformationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = User::all();

        foreach ($users as $user) {
            UsersInformations::create([
                'users_id' => $user->id,
                'street' => '123 Main Street',
                'country' => 'Country',
                'postal_code' => '12345',
                'city' => 'City',
                'society' => 'My Society',
            ]);
        }
    }
}
