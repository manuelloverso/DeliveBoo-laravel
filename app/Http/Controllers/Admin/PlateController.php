<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\StorePlateRequest;
use App\Http\Requests\UpdatePlateRequest;
use App\Models\Plate;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\Controller;
use Illuminate\Support\Str;

class PlateController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = auth()->user();

        $restaurant = $user->restaurant;

        $plates = $restaurant->plates->sortByDesc('id');
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
        $plates = $restaurant->plates;
        $name_plates = [];

        foreach ($plates as $plate) {
            //dd($plate->name);
            array_push($name_plates, $plate->name);
        }

        //dd($name_plates);

        if (!in_array($request->name, $name_plates)) {
            $val_data = $request->validated();
            $val_data['restaurant_id'] = $restaurant->id;
            /* dd($val_data); */
            if ($request->has('image')) {
                $img_path = Storage::put('uploads', $val_data['image']);
                $val_data['image'] = $img_path;
            }

            $slug = Str::slug($request->name, '-');
            $slugRestaurant = Str::slug($restaurant->restaurant_name, '-');
            $slug = $slug . '-' . $slugRestaurant;
            $val_data['slug'] = $slug;

            $plate = Plate::create($val_data);
        } else {
            return to_route('admin.plates.create')->with('message', "il nome del piatto già presente");
        }

        return to_route('admin.plates.index')->with('message', "Piatto creato correttamente.");
    }

    /**
     * Display the specified resource.
     */
    public function show(Plate $plate)
    {
        abort(404);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Plate $plate)
    {
        //dd($plate);
        $user = auth()->user();
        $restaurant = $user->restaurant;
        //dd($restaurant->plates);
        if ($restaurant->plates->contains($plate)) {
            return view('admin.plates.edit', compact('plate'));
        } else {
            abort(404);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePlateRequest $request, Plate $plate)
    {
        $user = auth()->user();
        $restaurant = $user->restaurant;
        $plates = $restaurant->plates;
        $name_plates = [];

        foreach ($plates as $plate) {
            //dd($plate->name);
            array_push($name_plates, $plate->name);
        }

        $val_data = $request->validated();
        if (!$request->has('is_visible')) {
            $val_data['is_visible'] = 0;
        }

        if (!in_array($request->name, $name_plates)) {


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


            $slug = Str::slug($request->name, '-');
            $slugRestaurant = Str::slug($restaurant->restaurant_name, '-');
            $slug = $slug . '-' . $slugRestaurant;
            $val_data['slug'] = $slug;


            $plate->update($val_data);
        } else {
            return to_route('admin.plates.edit', compact('plate'))->with('message', "il nome del piatto già presente");
        }

        return to_route('admin.plates.index')->with('message', 'Piatto aggiornato correttamente.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $plate = Plate::find($id);
        if ($plate->image) {
            Storage::delete($plate->image);
        }
        $plate->delete();
        return to_route('admin.plates.index')->with('message', "$plate->name è stato cancellato.");
    }
}
