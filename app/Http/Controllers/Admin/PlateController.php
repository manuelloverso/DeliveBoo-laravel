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
        $user = auth()->user();

        $restaurant = $user->restaurant;
        $plates = $restaurant->plates;
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
        /* dd($val_data); */


        if ($request->has('image')) {
            $img_path = Storage::put('uploads', $val_data['image']);
            $val_data['image'] = $img_path;
        }

        Plate::create($val_data);
        return to_route('admin.plates.index')->with('message', "Piatto creato correttamente.");
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
        return view('admin.plates.edit', compact('plate'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePlateRequest $request, Plate $plate)
    {

        $val_data = $request->validated();
        if (!$request->has('is_visible')) {
            $val_data['is_visible'] = 0;
        }

        if ($request->has('image')) {
            //check if the plate already had another image
            if ($plate->image) {
                //if so we delete it
                Storage::delete($plate->image);
            }
            $img_path = Storage::put('uploads', $val_data['image']);
            //dd($validated, $image_path);
            $val_data['image'] = $img_path;
        }
        $plate->update($val_data);
        return to_route('admin.plates.index')->with('message', 'Piatto aggiornato correttamente.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Plate $plate)
    {
        if ($plate->image) {
            Storage::delete($plate->image);
        }
        $plate->delete();
        return to_route('admin.plates.index')->with('message', "$plate->name è stato cancellato.");
    }
}
