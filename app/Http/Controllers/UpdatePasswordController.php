<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdatePasswordRequest;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;

class UpdatePasswordController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param UpdatePasswordRequest $request
     * @return JsonResponse
     */
    public function __invoke(UpdatePasswordRequest $request)
    {
        $password = $request->safe()->except('password_confirmation');
        $token = DB::table('password_resets')->where('token', $password['token'])->first();
        User::where('email', $token->email)
            ->update(["password" => Hash::make($password['password'])]);

        DB::table('password_resets')->where('token', $password['token'])->delete();
        return response()->json([
            "message"=> "success"
        ]);
    }
}
