<?php

namespace App\Http\Controllers\Admin;

use App\Models\Restaurant;
use App\Http\Requests\StoreRestaurantRequest;
use App\Http\Requests\UpdateRestaurantRequest;
use App\Http\Controllers\Controller;
use App\Models\User;

class RestaurantController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $restaurant = Restaurant::all();
        $user = auth()->user();

        return view('admin.restaurants.index', compact('restaurant', 'user'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {


        return view('admin.restaurants.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRestaurantRequest $request)
    {

        $user = auth()->user();
        $validated = $request->validated();
        $validated['user_id'] = $user->id;
        $restaurant = Restaurant::create($validated);

        return to_route('admin.restaurants.index', compact('restaurant'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Restaurant $restaurant)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Restaurant $restaurant)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRestaurantRequest $request, Restaurant $restaurant)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Restaurant $restaurant)
    {
        //
    }
}
