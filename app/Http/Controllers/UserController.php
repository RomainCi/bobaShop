<?php

namespace App\Http\Controllers;

use App\Http\Action\Information\StoreInformationUser;
use App\Http\Requests\UserRequest;
use App\Jobs\BufferUsersDeleteJob;
use App\Jobs\BufferUsersJob;
use App\Models\User;
use App\Models\Users_token;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Throwable;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param UserRequest $request
     * @return Response|JsonResponse
     * @throws Throwable
     */
    public function store(UserRequest $request): Response|JsonResponse
    {

        $user = $request->safe()->except(["check", "address"]);
        $information = $request->safe()->only(['address']);
        $randomBytes = random_bytes(64);
        $token = bin2hex($randomBytes);
        $user["password"] = Hash::make($user['password']);
        DB::beginTransaction();
        try {
            $user = User::create([
                'password' => $user["password"],
                "lastname" => $user['lastname'],
                "firstname" => $user['firstname'],
                "phone" => $user['phone'],
                "email" => $user['email'],
                "birthdays" => $user['birthdays']
            ]);
            Users_token::create([
                "users_id" => $user->id,
                "token" => $token,
            ]);
            (new StoreInformationUser())->handle($information, $user);
            DB::commit();
            BufferUsersJob::dispatch($user, $token)->delay(now()->addSeconds(10));
            BufferUsersDeleteJob::dispatch($user)->delay(now()->addRealMinutes(15));

            return response()->json([
                "status" => "success",
                "message" => "Vous allez recevoir un lien de vérification dans votre boîte mail d'ici quelques minutes. Ce lien sera valable 15 min. Pensez à vérifier vos spams s'il n'apparaît pas dans votre messagerie !"

            ]);
        } catch (Exception $e) {
            DB::rollBack();
            Log::error('Error dans la transaction pour storeUser' . $e->getMessage());
            return response()->json([
                "status" => "error",
                "message" => "Une erreur c'est produite. Peut être que vous avez déjà un compte"
            ], 400);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     *
     */
    public function show(int $id): void
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     */
    public function update(Request $request, User $user)
    {
    }

    /**
     * Remove the specified resource from storage.
     *
     */
    public function destroy($id)
    {
        //
    }
}
