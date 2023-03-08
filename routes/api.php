<?php

use App\Http\Controllers\CommandController;
use App\Http\Controllers\ConnexionController;
use App\Http\Controllers\HomeContentController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\ProductsController;
use App\Http\Controllers\RegisterController;
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

Route::get('/products=bubble/id={id}', [ProductsController::class, "show"]);

Route::get('/products=menu', [MenuController::class, "index"]);

//Route::middleware('')post('/products=command/id={id}',[ProductsController::class,"store"]);
Route::group(['prefix' => '/products=command', 'middleware' => ['auth:sanctum']], function () {
    Route::post('', [CommandController::class, "store"]);
});

Route::group(['prefix' => '/products=menu', 'middleware' => ['admin']], function () {
    Route::post('', [MenuController::class, "store"]);
    Route::put('/id={id}', [MenuController::class, 'update']);
    Route::delete('/id={id}', [MenuController::class, 'destroy']);
});


Route::get('/home/content', [HomeContentController::class, "index"]);
Route::put('/home/content={id}', [HomeContentController::class, "update"])->middleware(['admin']);
Route::delete('/home/content={id}', [HomeContentController::class, 'destroy'])->middleware(['admin']);
Route::post('/home/content', [HomeContentController::class, "store"])->middleware(['admin']);
URL::forceScheme('https');