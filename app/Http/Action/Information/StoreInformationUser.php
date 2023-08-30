<?php

namespace App\Http\Action\Information;

use App\Models\User;
use App\Models\UsersInformations;
use JetBrains\PhpStorm\NoReturn;

class StoreInformationUser
{
    public function handle(Array $information,User $user): void
    {
        $information['address']['users_id']= $user->id;
        UsersInformations::insert($information['address']);
    }
}
