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
            array_push($types, $type->name);
        }


        /* get the right restaurants */
        $restaurants = Restaurant::with('types')->get();
        $filteredRestaurants = [];
        foreach ($restaurants as $restaurant) {
            $rest_types = [];
            foreach ($restaurant->types as $rest_type) {
                array_push($rest_types, $rest_type->name);
            }
            if (count(array_intersect($rest_types, $types)) == count($types)) {
                array_push($filteredRestaurants, $restaurant);
            }
        }

        return response()->json([
            'success' => true,
            'results' => $filteredRestaurants
        ]);
    }
}
