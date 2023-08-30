<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\CommandController;
use App\Http\Controllers\ConnexionController;
use App\Http\Controllers\ForgetPasswordController;
use App\Http\Controllers\HomeContentController;
use App\Http\Controllers\LogoutController;
use App\Http\Controllers\OrdersController;
use App\Http\Controllers\PaymentStoreController;
use App\Http\Controllers\ProductsController;
use App\Http\Controllers\ProductsMenuController;
use App\Http\Controllers\ProductsPearlController;
use App\Http\Controllers\ProductssController;
use App\Http\Controllers\ProductsSideController;
use App\Http\Controllers\ProductsSyrupController;
use App\Http\Controllers\ProductsTeaController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\ShowProductsController;
use App\Http\Controllers\UpdatePasswordController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\UserInformationController;
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
//HOME MESSAGE
Route::get('/home/content', [HomeContentController::class, "index"]);
Route::put('/home/content={id}', [HomeContentController::class, "update"])->middleware(['admin']);
Route::delete('/home/content={id}', [HomeContentController::class, 'destroy'])->middleware(['admin']);
Route::post('/home/content', [HomeContentController::class, "store"])->middleware(['admin']);


//BASKET
Route::post('/basket', \App\Http\Controllers\PostBasketController::class);
Route::get('/basket', \App\Http\Controllers\ShowBasketController::class);
Route::delete('/basket/{basketMenu}', \App\Http\Controllers\DestroyBasketController::class);

//PRODUCTS
Route::get('/products', ProductsController::class)->name('products.index');
Route::get('/products/{menu}', ShowProductsController::class)->name('products.show');


//PEARLS
Route::apiResource('products/pearls', ProductsPearlController::class)->except(['index'])->middleware(['admin']);
Route::get('products/pearls', [ProductsPearlController::class, "index"])->name('pearls.index');

//SYRUPS
Route::apiResource('products/syrups', ProductsSyrupController::class)->except(['index'])->middleware(['admin']);
Route::get('products/syrups', [ProductsSyrupController::class, "index"])->name('syrups.index');

//SIDES
Route::apiResource('products/sides', ProductsSideController::class)->except(['index'])->middleware(['admin']);
Route::get('products/sides', [ProductsSideController::class, "index"])->name('sides.index');

//TEAS
Route::apiResource('products/teas', ProductsTeaController::class)->except(['index'])->middleware(['admin']);
Route::get('products/teas', [ProductsTeaController::class, "index"])->name('teas.index');

//MENUS CHANGER LE SHOW
Route::apiResource('products/menus', ProductsMenuController::class)->except(['index', 'show'])->middleware(['admin']);
Route::get('products/menus', [ProductsMenuController::class, "index"])->name('menus.index');

//USERS IL MANQUE INDEX SHOW UPDATE DESTROY
Route::apiResource('user', UserController::class)->except(['store'])->middleware(["auth:sanctum"]);
Route::post('user', [UserController::class, "store"])->name('user.store');

//ORDER
Route::apiResource('orders', OrdersController::class)->middleware(["auth:sanctum"]);

//PAYMENT
Route::post('payment/{order}', PaymentStoreController::class)->middleware(['auth:sanctum'])->name('payment.store');
//Route::get('payment/{orders}', PaymentIndexController::class)->middleware(['auth:sanctum'])->name('payement.index');

//USER INFORMATION
Route::apiResource('user/information', UserInformationController::class)->middleware(["auth:sanctum"]);

//FORGET PASSWORD
Route::post('/forget', ForgetPasswordController::class)->name('forgetPassword.store');

//RESET PASSWORD
Route::put('/update/password', UpdatePasswordController::class)->name('updatePassword.update');

//LOGOUT
Route::post('/logout', LogoutController::class)->name('logout.post');

//CONNEXION
Route::post('/login', [ConnexionController::class, "authentification"]);


//Route::get('/user', [RegisterController::class, "index"])->middleware(["auth:sanctum"]);
//Route::put('/user', [RegisterController::class, 'update'])->middleware(["auth:sanctum"]);
//Route::get('/admin', [AdminController::class, "show"])->middleware(['admin']);


URL::forceScheme('https');
