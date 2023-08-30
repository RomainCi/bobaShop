<?php

namespace App\Http\Action\VerificationIP_Address;

use Illuminate\Support\Facades\DB;

class VerificationIPAction
{
    public function handle(string $email, string $ip): bool
    {
        // Vérifier si l'adresse IP a moins de 3 enregistrements
        $ipCount = DB::table('password_resets')->where('ip_address', $ip)->count();
        if ($ipCount >= 3) {
            return false;
        }

        // Vérifier si ip et l'adresse email a déjà un enregistrement
        $emailCount = DB::table('password_resets')->where('email', $email)->where('ip_address',$ip)->count();
        if ($emailCount >= 1) {
            return false;
        }

        return true;
    }
}
