<?php

use App\Http\Controllers\Api\Auth\AuthController;
use App\Http\Controllers\Api\Product\ProductController;
use Illuminate\Support\Facades\Route;
use Link\LinkController;
use Stats\StatsController;

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

Route::get('/', static fn() => 'API influencer');

Route::get('user', [AuthController::class, 'user']);
Route::get('products', [ProductController::class, 'index']);

Route::group([
    'middleware' => 'scope.influencer'
], static function () {
    Route::post('links', [LinkController::class, 'store']);
    Route::get('stats', [StatsController::class, 'index']);
    Route::get('rankings', [StatsController::class, 'rankings']);
});

Route::fallback(static function () {
    return redirect('api');
});
