<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserInformationRequest;
use App\Models\User;
use App\Models\UsersInformations;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use PHPUnit\Exception;

class UserInformationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param UserInformationRequest $request
     */
    public function store(UserInformationRequest $request): void
    {
//        try {
//            $informations = $request->validated();
//            $informations['users_id'] = Auth::user()->id;
//            UsersInformations::create($informations);
//            return response()->json("success");
//        }catch (\Exception $e){
//            dd($e);
//        }
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
     * @param UserInformationRequest $request
     * @param UsersInformations $information
     * @return JsonResponse
     */
    public function update(UserInformationRequest $request, UsersInformations $information): JsonResponse
    {

        if (!Gate::allows('information', $information->users_id)) {
            abort(403);
        }
        $userInformation = $request->validated();
        $information->update($userInformation['address']);
        $user = User::find(Auth::user()->id);
        $user->lastname = $userInformation['user']['lastname'];
        $user->firstname = $userInformation['user']['firstname'];
        $user->phone = $userInformation['user']['phone'];
        $user->save();
        return response()->json('success');

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
