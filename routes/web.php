<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\URL;

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

Route::get('/', function () {
    return view('welcome');
});
Route::get('/contact', function () {
    return view('welcome');
})->where('any', '.*');

Route::get('/qui-sommes-nous', function () {
    return view('welcome');
})->where('any', '.*');

Route::get('/FAQ', function () {
    return view('welcome');
})->where('any', '.*');
URL::forceScheme('https');
