<?php

namespace App\Http\Controllers;

use App\Http\Requests\AuthentificationConnexionRequest;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;

class ConnexionController extends Controller
{
    /**
     *
     * @param AuthentificationConnexionRequest $request
     * @return JsonResponse
     */
    public function authentification(AuthentificationConnexionRequest $request): JsonResponse
    {
        $credentials = $request->safe(['email', 'password']);
        if ($credentials['email'] === "admin@boba-shop.fr") {

            if (Auth::guard('admin')->attempt($credentials)) {
                return response()->json(["message" => "admin"]);
            } else {
                return response()->json(["message" => "error"], 403);
            }
        }
        if (Auth::attempt($credentials)) {
            return response()->json(["message" => "success"]);
        } else {
            return response()->json(["message" => "error"], 403);
        }
    }
}
