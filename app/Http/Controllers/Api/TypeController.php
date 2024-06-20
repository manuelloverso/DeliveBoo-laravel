<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Filter;
use App\Models\Restaurant;
use Illuminate\Http\Request;
use App\Models\Type;

class TypeController extends Controller
{
    public function index()
    {
        $types = Type::all();
        return response()->json([
            'success' => true,
            'results' => $types
        ]);
    }

    public function filter($type_ids)
    {
        /* get an array of types based on the array received by the api call */
        $remove_first = str_replace('[', '', $type_ids);
        $remove_second = str_replace(']', '', $remove_first);
        $final_array = explode(',', $remove_second);
        $types = [];
        foreach ($final_array as $type_id) {
            $type = Type::find($type_id);
            array_push($types, $type);
        }

        /* function checker($restaurantTypes, $types)
        {
            dd($types);
            foreach ($types as $type) {
                if (in_array($type, $restaurantTypes)) {
                    return true;
                } else {
                    return false;
                }
            }
        }; */

        /* get the right restaurants */
        $restaurants = Restaurant::with('types')->get();
        $filteredRestaurants = [];
        foreach ($restaurants as $restaurant) {

            $restTypes = [];
            dd($types, $restaurant->types);
            foreach ($types as $type) {
                if ($restaurant->types->contains($type) && count(array_intersect($types, $restaurant->types->toArray())) == count($types)) {
                    array_push($filteredRestaurants, $restaurant);
                }
            }
        }

        return response()->json([
            'success' => true,
            'results' => $filteredRestaurants
        ]);
    }
}
