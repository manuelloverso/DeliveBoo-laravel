<?php

namespace App\Http\Controllers\Admin;

use App\Models\Restaurant;
use App\Http\Requests\StoreRestaurantRequest;
use App\Http\Requests\UpdateRestaurantRequest;
use App\Http\Controllers\Controller;
use App\Models\Type;
use Illuminate\Support\Facades\Storage;

class RestaurantController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $user = auth()->user();

        return view('admin.dashboard', compact('user'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $user = auth()->user();
        if ($user->restaurant) {
            return to_route('admin.dashboard')->with('message', 'Hai già un ristorante collegato');
        }

        $types = Type::all();

        return view('admin.restaurants.create', compact('types'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store($request)
    {

        $user = auth()->user();
        $validated = $request->validated();
        $validated['user_id'] = $user->id;

        if ($request->has('image')) {
            $img_path = Storage::put('uploads', $validated['image']);
            $validated['image'] = $img_path;
        }
        $restaurant = Restaurant::create($validated);

        if ($request->has('types')) {
            $restaurant->types()->attach($validated['types']);
        }

        return to_route('admin.dashboard', compact('user'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Restaurant $restaurant)
    {

        abort(404);
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
