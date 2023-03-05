<?php

use App\Http\Controllers\ConnexionController;
use App\Http\Controllers\ProductsController;
use App\Http\Controllers\RegisterController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

//Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//    return $request->user();
//});

Route::post('register', [RegisterController::class, "store"]);

Route::post('/login', [ConnexionController::class, "authentification"]);

Route::get('/products=bubble/id={id}',[ProductsController::class,"show"]);

Route::get('/products=menu',[ProductsController::class,"indexMenu"]);

//Route::middleware('')post('/products=command/id={id}',[ProductsController::class,"store"]);
Route::group(['prefix' => '/products=command', 'middleware' => ['auth:sanctum']], function () {
Route::post('',[ProductsController::class,"store"]);
});
Route::get('/test', function () {
    return response()->json(["message" => true]);
})->middleware(['auth:sanctum']);

URL::forceScheme('https');