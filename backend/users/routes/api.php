<?php

use App\Http\Controllers\Api\Auth\AuthController;
use App\Http\Controllers\Api\User\UserController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::get('/', static fn() => 'API users');

Route::post('login', [AuthController::class, 'login']);
Route::post('register', [AuthController::class, 'register']);

Route::group([
    'middleware' => 'auth:api',
], static function () {
    Route::get('user', [AuthController::class, 'user']);
    Route::put('users/info', [AuthController::class, 'updateInfo']);
    Route::put('users/password', [AuthController::class, 'updatePassword']);

    Route::apiResource('users', UserController::class);

    Route::get('admin', [AuthController::class, 'authenticated'])->middleware('scope:admin');
    Route::get('influencer', [AuthController::class, 'authenticated'])->middleware('scope:influencer');
});
