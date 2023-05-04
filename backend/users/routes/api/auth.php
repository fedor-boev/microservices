<?php

declare(strict_types=1);

use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\User\UpdatePasswordController;
use App\Http\Controllers\Auth\User\UpdateUserInfoController;
use App\Http\Controllers\Auth\User\UserController;

Route::post('login', [LoginController::class, 'login'])->name('login');
Route::post('register', [RegisterController::class, 'register']);

Route::group([
    'middleware' => 'auth:api',
], static function () {
    Route::get('user', [UserController::class, 'user']);
    Route::patch('user/info', [UpdateUserInfoController::class, 'updateInfo']);
    Route::patch('user/password', [UpdatePasswordController::class, 'updatePassword']);

    Route::get('admin', [AuthController::class, 'authenticated'])->middleware('scope:admin');
    Route::get('influencer', [AuthController::class, 'authenticated'])->middleware('scope:influencer');
});

