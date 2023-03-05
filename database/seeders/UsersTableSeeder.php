<?php

namespace Database\Seeders;

use App\Models\User;
use DateTime;
use DateTimeZone;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     * @throws \Exception
     */
    public function run()
    {
        $dateTimeZone = new DateTimeZone('Europe/Paris');
        $dt = new DateTime('now', $dateTimeZone);

        $user = [
            "lastname" => "Doe",
            "firstname" =>"John",
            "birthdays" => "11/05/1989",
            "phone" => "+52 998 153 5154",
            "email" => "john@gmail.com",
            "password" => \Hash::make("azertyuiopP@1"),
            "email_verified_at" => $dt->format('Y-m-d H:i:s')
        ];
        User::create($user);
    }
}
