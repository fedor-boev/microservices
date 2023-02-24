<?php

use App\Http\Controllers\LinkController;
use App\Http\Controllers\OrderController;
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

Route::get('/', static fn() => 'API checkout');

Route::get('links/{code}', [LinkController::class, 'show']);
Route::post('orders', [OrderController::class, 'store']);
Route::post('orders/confirm', [OrderController::class, 'confirm']);
