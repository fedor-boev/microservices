<?php

use App\Http\Controllers\Api\Auth\AuthController;
use App\Http\Controllers\Api\Auth\LoginController;
use App\Http\Controllers\Api\Auth\RegisterController;
use App\Http\Controllers\Api\Auth\UpdatePasswordController;
use App\Http\Controllers\Api\Auth\UserController;
use App\Http\Controllers\Api\Auth\UserInfoController;

Route::post('login', [LoginController::class, 'login'])->name('login');
Route::post('register', [RegisterController::class, 'register']);

Route::group([
    'middleware' => 'auth:api',
], static function () {
    Route::get('user', [UserController::class, 'user']);
    Route::put('users/info', [UserInfoController::class, 'updateInfo']);
    Route::put('users/password', [UpdatePasswordController::class, 'updatePassword']);

    Route::get('admin', [AuthController::class, 'authenticated'])->middleware('scope:admin');
    Route::get('influencer', [AuthController::class, 'authenticated'])->middleware('scope:influencer');
});

