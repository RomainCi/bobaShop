<?php

namespace App\Http\Controllers;

use App\Http\Action\VerificationIP_Address\VerificationIPAction;
use App\Jobs\DeleteTokenJob;
use App\Jobs\ForgetPasswordMailJob;
use App\Models\User;
use App\Models\Users_token;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class ForgetPasswordController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @return Application|ResponseFactory|Response
     */
    public function __invoke(Request $request)
    {
        try {
            $email = $request->validate([
                "email" => 'required|email|exists:users'
            ]);
            $ip = $request->ip();

            $verification = (new VerificationIPAction())->handle($email['email'], $ip);
            if (!$verification) {
                return response('veuillez essayer dans 15 min', 403);
            }
            $randomBytes = random_bytes(64);
            $token = bin2hex($randomBytes);

            DB::table('password_resets')->insert([
                "email" => $email['email'],
                "token" => $token,
                "created_at" => now(),
                "ip_address" => $request->ip(),
            ]);

            ForgetPasswordMailJob::dispatch($token,$email['email'])->delay(now()->addRealSeconds(1));
//            DeleteTokenJob::dispatch($user_token)->delay(now()->addRealMinutes(1));

            return response('success', 200);
        } catch (\Exception $e) {
            dd($e);
            return \response('error', 404);
        }

    }
}
