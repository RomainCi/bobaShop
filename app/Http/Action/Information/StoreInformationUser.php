<?php

namespace App\Http\Action\Information;

use App\Models\User;
use App\Models\UsersInformations;
use JetBrains\PhpStorm\NoReturn;

class StoreInformationUser
{
    #[NoReturn] public function handle(Array $information,User $user): void
    {
        $information['address']['users_id']= $user->id;
//        $user->information->create($information);
//        dd($user->information,$user);
        UsersInformations::insert($information['address']);
//        UsersInformations::create($information['address']);
    }
}
