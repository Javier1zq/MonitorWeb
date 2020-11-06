<?php

use Illuminate\Support\Facades\Route;
use app\Http\Controllers\IndexController;
use App\Http\Controllers\AddressController;
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
/*
Route::get('/searchAddress', function () {
    return view('searchAddress');
});*/

Route::get('searchAddress', [AddressController::class, 'searchAddress']);
Route::get('listAddress', [AddressController::class, 'index']);
Route::post('store-form', [AddressController::class, 'store']);