<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\MessageController;

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

Route::group(['prefix' => 'customers','middleware' => 'auth:api'], function () {
    Route::get('/', [CustomerController::class, 'index'])->middleware('scope:see-customers');
    Route::delete('/delete/{id}', [CustomerController::class, 'destroy'])->middleware('scope:delete-customers');
});

Route::post('/reports', [ReportController::class, 'store'])->middleware('auth:api');

// TODO TESTING
Route::group(['prefix' => 'messages','middleware' => 'auth:api'], function () {
    Route::get('/', [MessagesController::class, 'index']);
    Route::post('/', [MessagesController::class, 'store']);
    Route::get('/{messages}', [MessagesController::class, 'show']);
    Route::get('/all', [MessagesController::class, 'all'])->middleware('scope:view-all-chat');
});

