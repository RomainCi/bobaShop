<?php

use App\Http\Controllers\EmailVerificationController;
use App\Http\Controllers\OrdersController;
use App\Http\Controllers\PaymentIndexController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\ResponseRequiresActionStripeController;
use App\Http\Controllers\VerificationEmailPasswordController;
use App\Models\Orders;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Route;
use Stripe\Stripe;

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


//VerificationEmail
Route::get('confirmation/email/id={user}&token={token}', EmailVerificationController::class)->name('email.check');

//RESET PASSWORD
Route::get('password/{token}', function ($token) {
    $res = DB::table('password_resets')->where('token', $token)->exists();
    return $res ? view('welcome') : abort(403);

});




Route::get('/admin/panel', function () {
    return view('welcome');
})->middleware(['admin']);


//Route::get('confirmation/email/id={id}&token={token}', [RegisterController::class, 'check']);
Route::get('update/email/id={id}&token={token}', [RegisterController::class, 'checkUpdate'])->middleware(["auth:sanctum"]);


Route::get('/compte', function () {
    return view('welcome');
})->middleware(['auth:sanctum']);

///A EFFACER

Route::group(['middleware' => 'web'], function () {
    Route::view('/', 'welcome')->name('home');
    Route::view('/contact', 'welcome');
    Route::view('/qui-sommes-nous', 'welcome');
    Route::view('/FAQ', 'welcome');
    Route::view('/authentification', 'welcome')->name('login');
    Route::view('/inscription', 'welcome');
    Route::view('/panier', 'welcome');
});


Route::get('/commandes/{id}', function ($id) {
    if (!Gate::allows('payment', $id)) {
        abort(403);
    }
    return view('welcome');
})->middleware(['auth:sanctum'])->name('show.paiement');


Route::get('/commandes/{id}/response', ResponseRequiresActionStripeController::class)->middleware(['auth:sanctum'])->name('requires_action');


//URL::forceScheme('https');
