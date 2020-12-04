<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AddressController;
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
/*
Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});*/

Route::get('/', [UserController::class, 'index']);
Route::get('/user', [UserController::class, 'user'])->middleware('auth:api');
Route::post('/register', [UserController::class, 'register']);



//Route::post('/searchFormAction', [AddressController::class, 'searchFormAction']);
//Route::post('/confirmAddress', [AddressController::class, 'confirmAddress']);

Route::post('/searchFormActionApi', [AddressController::class, 'searchFormActionApi']);
Route::post('/confirmAddressApi', [AddressController::class, 'confirmAddressApi']);
Route::post('/checkCoverageApi', [AddressController::class, 'checkCoverageApi']);
