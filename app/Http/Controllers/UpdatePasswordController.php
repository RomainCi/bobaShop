<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdatePasswordRequest;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\Rules\Password;
use PHPUnit\Exception;
use Throwable;

class UpdatePasswordController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param UpdatePasswordRequest $request
     * @return JsonResponse
     * @throws Throwable
     */
    public function __invoke(UpdatePasswordRequest $request): JsonResponse
    {
        $password = $request->safe()->except('password_confirmation');

        DB::beginTransaction();
        try {
            $token = DB::table('password_resets')->where('token', $password['token'])->first();
            User::where('email', $token->email)
                ->update(["password" => Hash::make($password['password'])]);

            DB::table('password_resets')->where('token', $password['token'])->delete();
            DB::commit();
            return response()->json([
                "status"=> "success",
                "message" => "Votre mot de passe a été modifié avec succès"
            ]);
        } catch (Exception $e) {
            DB::rollBack();
            Log::error('Error dans la transaction pour UpdatePasswordController' . $e->getMessage());
            return response()->json([
                "status" => "error",
                "message" => "Une erreur c'est produite"
            ], 500);
        }

    }
}
