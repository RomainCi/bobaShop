<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreRegisterRequest;
use App\Jobs\BufferUsersDeleteJob;
use App\Jobs\BufferUsersJob;
use App\Models\BufferUsers;
use App\Models\User;
use App\Models\Users_token;
use DateTime;
use DateTimeZone;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Str;

class RegisterController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return void
     */
    public function index(): void
    {

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreRegisterRequest $request
     * @return Response
     */
    public function store(StoreRegisterRequest $request): Response
    {
        try {
            $user = $request->safe()->except(["check"]);
            $token = Str::random(64);
            $user["password"] = \Hash::make($user['password']);
            $user = User::create($user);
            Users_token::create([
                "users_id" => $user->id,
                "token" => $token,
            ]);
            BufferUsersJob::dispatch($user,$token);
            BufferUsersDeleteJob::dispatch($user)->delay(now()->addRealMinutes(1));
            return \response("success");
        } catch (\Exception $e) {
            dd($e);
        }

    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @param string $token
     * @return Response
     */
    public function show(int $id, string $token): Response
    {
        try {
            $dateTimeZone = new DateTimeZone('Europe/Paris');
            $dt = new DateTime('now', $dateTimeZone);
            $email_verified_at = $dt->format('Y-m-d H:i:s');
            $user = User::findOrFail($id);
            $user_token= User::findOrFail($id)->token;
            abort_if($user_token === null ,404,'errorNull');
            abort_if($user_token->token !== $token, 404, 'error!!');
            $user = User::findOrFail($id);
            $user->email_verified_at = $email_verified_at;
            $user->save();
            $user_token->delete();
            dd("oki");
        } catch (\Exception $e) {

            dd($e);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param int $id
     * @return Response
     */
    public function update(Request $request, int $id): Response
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return Response
     */
    public function destroy(int $id): Response
    {
        //
    }
}
