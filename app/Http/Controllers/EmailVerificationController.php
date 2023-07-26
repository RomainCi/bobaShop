<?php

namespace App\Http\Controllers;

use App\Http\Action\Verification\EmailVerificationAction;
use App\Models\User;
use Exception;
use Illuminate\Contracts\View\View;

class EmailVerificationController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param User $user
     * @return View
     * @throws Exception
     */
    public function __invoke(User $user, string $token): View
    {
        (new EmailVerificationAction)->handle($user, $token);
        return view('welcome');
    }
}
