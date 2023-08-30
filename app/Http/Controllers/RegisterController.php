<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use App\Jobs\BufferUpdateEmailJob;
use App\Jobs\BufferUsersDeleteJob;
use App\Jobs\BufferUsersJob;
use App\Models\BufferUpdateEmail;
use App\Models\User;
use App\Models\Users_token;
use DateTime;
use DateTimeZone;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Validation\Rules\Password;

class RegisterController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        try {
            $id = Auth::user()->id;
            $user = User::where('id', $id)->select(["email", "phone", "lastname", "firstname", "birthdays"])->first();
            return response()->json([
                "user" => $user,
            ]);
        } catch (\Exception $e) {
            dd($e);
        }
    }

    public function test(Request $request)
    {
        $user = Auth::user();
        $amount = 10000;
        $user->charge($amount,$request['paymentMethod']);
        return $request->user()->redirectToBillingPortal();
        dd("oki");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param UserRequest $request
     * @return Response
     */
    public function store(UserRequest $request): Response
    {
//        try {
//            $user = $request->safe()->except(["check"]);
//            $token = Str::random(64);
//            $user["password"] = \Hash::make($user['password']);
//            $user = User::create($user);
//            Users_token::create([
//                "users_id" => $user->id,
//                "token" => $token,
//            ]);
//            BufferUsersJob::dispatch($user, $token);
//            BufferUsersDeleteJob::dispatch($user)->delay(now()->addRealMinutes(1));
//            return \response("success");
//        } catch (\Exception $e) {
//            dd($e);
//        }

    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @param string $token
     * @return Response
     */
    public function check(int $id, string $token): Response
    {
//        try {
//            $dateTimeZone = new DateTimeZone('Europe/Paris');
//            $dt = new DateTime('now', $dateTimeZone);
//            $email_verified_at = $dt->format('Y-m-d H:i:s');
////            $user = User::findOrFail($id);
//            $user_token = User::findOrFail($id)->token;
//            abort_if($user_token === null, 404, 'errorNull');
//            abort_if($user_token->token !== $token, 404, 'error!!');
//            $user = User::findOrFail($id);
//            $user->email_verified_at = $email_verified_at;
//            $user->save();
//            $user_token->delete();
//            dd("oki");
//        } catch (\Exception $e) {
//
//            dd($e);
//        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     *
     * @return JsonResponse
     */
    public function update(Request $request): JsonResponse
    {
        try {
            $request->validate([
                "colum" => "required|string",
            ]);
//            if ($request['colum'] === 'password') {
//                $request->validate([
//                    "content.last_password" => ['required', Password::min(8)->numbers()->mixedCase()->symbols()],
//                    "content.password" => ['required', 'confirmed', Password::min(8)->numbers()->mixedCase()->symbols()],
//                    "content.password_confirmation" => 'required',
//                ]);
//            }
            $request->validate([
                "content" => $request['colum'] === 'email' ? 'required|email' : 'string|required',
                "content" => $request['colum'] === 'birthdays' ? 'date_format:d/m/Y|before:today' : '',
            ]);

            $id = Auth::user()->id;

            if ($request['colum'] === 'email') {
                $token = Str::random(64);
                $user = User::findOrFail($id)->tokenMany;
                $userEmail = User::findOrFail($id)->updateEmailMany;

                $userEmail->each->delete();
                $user->each->delete();

                Users_token::create(["users_id" => $id, "token" => $token]);
                BufferUpdateEmail::create(["users_id" => $id, "email" => $request['content']]);
                BufferUpdateEmailJob::dispatch($token, $request['content'], $id);
            } elseif ($request['colum'] === 'password') {
                $user = User::findOrFail($id);
                $last_password = $request['content.last_password'];
                if (\Hash::check($last_password, $user->password)) {
                    $user->password = \Hash::make($request['content.password']);
                    $user->save();
                } else {
                    return response()->json(["message" => "le mot de passe est différent"], 401);
                }

            } else {
                $content = User::findOrFail($id);
                $colum = $request["colum"];
                $content->$colum = $request['content'];
                $content->save();
            }

            return response()->json(["message" => "success"]);
        } catch (\Exception $e) {
            dd($e);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @param string $token
     * @return Application|Factory|\Illuminate\Contracts\View\View|JsonResponse
     */

    public function checkUpdate(int $id, string $token): \Illuminate\Contracts\View\View|Factory|JsonResponse|Application
    {
        try {
            $userId = Auth::user()->id;
            if ($userId !== $id) {
                return response()->json(["message" => "erreur"], 401);
            }

            $user = User::findOrFail($id);
            $user_token = $user->token;
            abort_if($user_token === null || $user_token->token !== $token, 404, 'error!!');

            $updateEmail = $user->updateEmail;
            $previousEmail = $user->email;

            $user->email = $updateEmail->email;
            $user->save();

            $updateEmail->email = $previousEmail;
            $updateEmail->email_verified_at = now();
            $updateEmail->save();

            $user_token->delete();

            return view('welcome');
        } catch (\Exception $e) {
            return response()->json(['message' => $e->getMessage()], 404);
        }
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
