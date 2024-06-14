<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\StorePlateRequest;
use App\Http\Requests\UpdatePlateRequest;
use App\Models\Admin\Plate;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\Controller;

class PlateController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $plates = Plate::orderByDesc('id')->get();
        return view('admin.plates.index', compact('plates'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.plates.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePlateRequest $request)
    {
        $user = auth()->user();
        $restaurant = $user->restaurant;
        $val_data = $request->validated();
        $val_data['restaurant_id'] = $restaurant->id;


        if ($request->has('image')) {
            $img_path = Storage::put('uploads', $val_data['image']);
            $val_data['image'] = $img_path;
        }

        Plate::create($val_data);
        return to_route('admin.plates.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Plate $plate)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Plate $plate)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePlateRequest $request, Plate $plate)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Plate $plate)
    {
        //
    }
}
