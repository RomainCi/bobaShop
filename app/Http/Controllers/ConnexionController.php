<?php

namespace App\Http\Controllers;

use App\Http\Requests\AuthentificationConnexionRequest;
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
        if ($credentials['email'] === "admin@gmail.com") {
            return Auth::guard('admin')->attempt($credentials)
                ? response()->json(["message" => "admin"])
                : response()->json(["message" => "error"],403);
        }

        return Auth::attempt($credentials)
            ? response()->json(["message" => "success"])
            : response()->json(["message" => "erreur"],403);
    }
}
