<?php

namespace App\Http\Action\Verification;

use DateTime;
use DateTimeZone;

class EmailVerificationAction
{
    /**
     * @throws \Exception
     */
    public function handle($user, $token)
    {
        abort_if($user->token === null, 404, 'errorNull');
        abort_if($user->token->token !== $token, 404, 'error!!');
        $dateTimeZone = new DateTimeZone('Europe/Paris');
        $dt = new DateTime('now', $dateTimeZone);
        $email_verified_at = $dt->format('Y-m-d H:i:s');
        $user->email_verified_at = $email_verified_at;
        $user->save();
        $user->token->delete();
        return true;
    }
}