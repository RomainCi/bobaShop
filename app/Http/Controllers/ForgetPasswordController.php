<?php

namespace App\Http\Controllers;

use App\Http\Action\VerificationIP_Address\VerificationIPAction;
use App\Jobs\ForgetPasswordMailJob;
use Exception;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

use Throwable;

class ForgetPasswordController extends Controller
{
    /**
     * Handle the incoming request.
     *
     *
     * @throws Throwable
     */
    public function __invoke(Request $request): Response|JsonResponse|Application|ResponseFactory
    {
        try {
            $email = $request->validate([
                "email" => 'required|email|exists:users'
            ]);
        } catch (Exception $e) {
            Log::error('Error dans la transaction pour ForgetPasswordController' . $e->getMessage());
            return response()->json([
                "status" => "notFound",
                "message" => "Cet email est inexistant"
            ],400);
        }

        DB::beginTransaction();
        try {
            $ip = $request->ip();
            $verification = (new VerificationIPAction())->handle($email['email'], $ip);
            if (!$verification) {
                return response()->json([
                    "status" => "error",
                    "message" => "Veuillez essayer dans 15 min"
                ],403);
            }
            $randomBytes = random_bytes(64);
            $token = bin2hex($randomBytes);

            DB::table('password_resets')->insert([
                "email" => $email['email'],
                "token" => $token,
                "created_at" => now(),
                "ip_address" => $request->ip(),
            ]);

            ForgetPasswordMailJob::dispatch($token, $email['email'])->delay(now()->addRealSeconds(30));
            DB::commit();
            return response()->json([
                'status'=> "success",
                "message"=> "Vous allez recevoir un email dans quelques instants pensé à vérifier vos spams."
            ]);

        } catch (Exception $e) {
            DB::rollBack();
            Log::error('Error dans la transaction pour ForgetPasswordController' . $e->getMessage());
            return response()->json([
                "status" => "error",
                "message" => "Une erreur c'est produite"
            ],500);
        }
    }
}
