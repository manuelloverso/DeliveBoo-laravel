<?php

use App\Http\Controllers\Api\RestaurantController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Models\Restaurant;
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

// Route::get('restaurants', function(){
//     $restaurants = Restaurant::with('types', 'plates')->get();
//         return response()->json([
//             'success' => true,
//             'results' => $restaurants
//         ]);
// });
