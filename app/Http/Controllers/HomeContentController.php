<?php

namespace App\Http\Controllers;

use App\Http\Requests\HomeContentRequest;
use App\Models\HomeViewAdmin;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;

class HomeContentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        $admin = Auth::guard('admin')->user();
        if ($admin !== null) {
            $content = HomeViewAdmin::all();
            return response()->json([
                "content" => $content
            ]);
        }
        $content = HomeViewAdmin::select('content')->get();
        return response()->json([
            "content" => $content
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param HomeContentRequest $request
     * @return JsonResponse
     */
    public function store(HomeContentRequest $request): JsonResponse
    {

        try {
            $content["content"] = $request->safe()["content"];
            $content["usersAdmin_id"] = Auth::guard('admin')->user()['id'];
            $newContent = HomeViewAdmin::create($content);
            return response()->json([
                "content" => $newContent
            ]);
        } catch (\Exception $e) {
            dd($e);
        }

    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return Response
     */
    public function update(Request $request, int $id): Response
    {
        try {
            $request->validate([
                "content" => "string|required",
            ]);
            $content = HomeViewAdmin::findOrFail($id);
            $content->content = $request['content'];
            $content->usersAdmin_id = Auth::guard('admin')->user()['id'];
            $content->save();
            return response('success');
        } catch (\Exception $e) {
            dd($e);
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
        try {
            HomeViewAdmin::destroy($id);
            return response('success');
        } catch (\Exception $e) {
            dd($e);
        }
    }
}
