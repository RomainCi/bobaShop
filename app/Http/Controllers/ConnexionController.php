<?php

namespace App\Http\Controllers;

use App\Http\Requests\AuthentificationConnexionRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;
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
        $credentials = $request->safe(['email','password']);
        return Auth::attempt($credentials)
            ? response()->json(["message" => "success"])
            : response()->json(["message" => "erreur"]);
    }
}
