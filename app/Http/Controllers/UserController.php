<?php

namespace App\Http\Controllers;

use App\Http\Action\Information\StoreInformationUser;
use App\Http\Requests\UserRequest;
use App\Jobs\BufferUsersDeleteJob;
use App\Jobs\BufferUsersJob;
use App\Models\User;
use App\Models\Users_token;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Str;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param UserRequest $request
     * @return Response
     */
    public function store(UserRequest $request): Response
    {
        try {
            $user = $request->safe()->except(["check","address"]);
            $information = $request->safe()->only(['address']);
            $randomBytes = random_bytes(64);
            $token = bin2hex($randomBytes);
            $user["password"] = \Hash::make($user['password']);
            $user = User::create($user);
            Users_token::create([
                "users_id" => $user->id,
                "token" => $token,
            ]);
            (new StoreInformationUser())->handle($information,$user);
            BufferUsersJob::dispatch($user, $token)->delay(now()->addSeconds(30));
            BufferUsersDeleteJob::dispatch($user)->delay(now()->addRealMinutes(1));
            return \response("success");
        } catch (\Exception $e) {
            return \response(403);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
