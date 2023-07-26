<?php

use App\Http\Controllers\EmailVerificationController;
use App\Http\Controllers\OrdersController;
use App\Http\Controllers\PaymentIndexController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\VerificationEmailPasswordController;
use App\Models\Orders;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;
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

//VerificationEmail
Route::get('confirmation/email/id={user}&token={token}', EmailVerificationController::class)->name('email.check');

//RESET PASSWORD
Route::get('password/{token}', function ($token) {
    $res = DB::table('password_resets')->where('token', $token)->exists();
    return $res ? view('welcome') : abort(403);

});

Route::get('/test', function () {
    return 'Hello World!';
})->name('test');

//Route::get('/index', function () {
//    $productsSyrups = ProductsSyrup::query()->get();
//    $productsTeas = (new IndexProductsAction)->handle(ProductsTea::query()->get());
//    $productsSides = (new IndexProductsAction)->handle(ProductsSide::query()->get());
//    $productsMenus = ProductsMenu::query()->get();
//    $productPearls = ProductsPearl::query()->get();
//    return view('home.index')->with([
//        "productsMenus" => $productsMenus,
//        "productsTeas" => $productsTeas,
//    ]);
//});


/////////////////déverrouiller /////////////////////////
///
///
///
///
//
Route::get('/admin/panel', function () {
    return view('welcome');
})->middleware(['admin']);

Route::get('/facture', function () {
    $order = Orders::findOrfail(9);
    $user = \App\Models\User::findOrFail(6);
    $info = $user->information;
    $invoiceNumber = 'FACTURE-11042023-6435b5101c270';
    $dateString = substr($invoiceNumber, 8, 8); // Extraire la sous-chaîne "11042023"
    $date = date_create_from_format('dmY', $dateString); // Convertir la sous-chaîne en objet DateTime
    $formattedDate = date_format($date, 'd/m/Y'); // Reformater la date selon le format souhait
    return view('pdf.InvoicePdfView', compact('order', 'user', 'formattedDate', 'info'));
});
//Route::get('confirmation/email/id={id}&token={token}', [RegisterController::class, 'check']);
Route::get('update/email/id={id}&token={token}', [RegisterController::class, 'checkUpdate'])->middleware(["auth:sanctum"]);


Route::get('/compte', function () {
    return view('welcome');
})->middleware(['auth:sanctum']);


Route::group(['middleware' => 'web'], function () {
    Route::view('/', 'welcome');
    Route::view('/contact', 'welcome');
    Route::view('/qui-sommes-nous', 'welcome');
    Route::view('/FAQ', 'welcome');
    Route::view('/commandes', 'welcome');
    Route::view('/authentification', 'welcome')->name('login');
    Route::view('/inscription', 'welcome');
    Route::view('/panier', 'welcome');
});

//Route::get('/paiement/{id}',function ($id){
//   return view('welcome');
//});

Route::get('/commandes/{id}', function ($id) {
    if (!Gate::allows('payment', $id)) {
        abort(403);
    }
    return view('welcome');
})->middleware(['auth:sanctum']);;

//Route::get('/paiement/{id}', PaymentIndexController::class)->middleware(['auth:sanctum'])->name('paiement.index');

//URL::forceScheme('https');
