<?php

use App\Http\Controllers\RegisterController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
//Route::get('/login', function () {
//    return view('welcome');
//})->name('login');

Route::get('/admin/panel', function () {
    return view('welcome');
})->middleware(['admin']);

Route::get('confirmation/email/id={id}&token={token}', [RegisterController::class, 'show']);

Route::group(['middleware' => 'web'], function () {
    Route::view('/', 'welcome');
    Route::view('/contact', 'welcome');
    Route::view('/qui-sommes-nous', 'welcome');
    Route::view('/FAQ', 'welcome');
//    Route::view('/commandes', 'welcome');
//    Route::view('/authentification', 'welcome')->name('login');
//    Route::view('/inscription', 'welcome');
//    Route::view('/panier', 'welcome');
});
URL::forceScheme('https');
