<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CustomerController;

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

Route::group(['prefix' => 'auth'], function () {
    Route::post('login', [AuthController::class, 'login']);
    Route::post('logout', [AuthController::class, 'logout'])->middleware('auth:api');
});

Route::group([
    'prefix' => 'customers',
    'middleware' => ['auth:api', 'scopes:see-customers,delete-customers'],
], function () {
    Route::get('/', [CustomerController::class, 'index']);
    Route::delete('/delete/{id}', [CustomerController::class, 'destroy']);
});

