<?php

use App\Domains\Auth\Controllers\AuthController;
use App\Domains\Auth\Controllers\LoginController;
use App\Domains\Auth\Controllers\RegisterController;
use App\Domains\Auth\Controllers\UpdatePasswordController;
use App\Domains\Auth\Controllers\UserController;
use App\Domains\Auth\Controllers\UserInfoController;

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

