<?php

use App\Http\Controllers\Api\Order\OrderController;
use Illuminate\Support\Facades\Route;
use Link\LinkController;

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

Route::fallback(static function () {
    return redirect('api');
});
