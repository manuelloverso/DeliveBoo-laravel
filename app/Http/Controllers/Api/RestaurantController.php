<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Restaurant;

class RestaurantController extends Controller
{
    public function index()
    {
        $restaurants = Restaurant::with('types', 'plates')->orderByDesc('id')->get();
        return response()->json([
            'success' => true,
            'results' => $restaurants
        ]);
    }

    public function show($slug)
    {
        $restaurant = Restaurant::with('types', 'plates')->where('restaurant_slug', $slug)->first();
        if ($restaurant) {
            return response()->json([
                'success' => true,
                'response' => $restaurant,
            ]);
        } else {
            //handle 404 error
            return response()->json([
                'success' => false,
                'response' => '404 - Nothing found',
            ]);
        }
    }
}
