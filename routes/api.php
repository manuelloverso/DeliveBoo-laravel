<?php

use App\Http\Controllers\Api\OrderController;
use App\Http\Controllers\Api\RestaurantController;
use App\Http\Controllers\Api\TypeController;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Models\Restaurant;
use App\Http\Controllers\Api\PaymentController;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


Route::get('restaurants', [RestaurantController::class, 'index']);
Route::get('restaurants/{restaurant}', [RestaurantController::class, 'show']);
Route::get('types', [TypeController::class, 'index']);
Route::get('types/{type}', [TypeController::class, 'filter']);

Route::get('payment', [PaymentController::class, 'index']);
Route::post('orders/process', [OrderController::class, 'processOrder']);
