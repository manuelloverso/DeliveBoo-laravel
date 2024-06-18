<?php

namespace Database\Seeders;

use App\Models\Plate;
use App\Models\Restaurant;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class PlateSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $plates = config('plates_db.plates');
        foreach ($plates as $plate) {
            $slug = Str::slug($plate['name'], '-');
            $restaurant = Restaurant::find($plate['restaurant_id']);
            $slugRestaurant = Str::slug($restaurant->restaurant_name, '-');

            $newPlates = new Plate();
            $newPlates->restaurant_id = $plate['restaurant_id'];
            $newPlates->name = $plate['name'];
            $newPlates->slug = $slug . '-' . $slugRestaurant;
            $newPlates->image = $plate['image'];
            $newPlates->description = $plate['description'];
            $newPlates->price = $plate['price'];
            $newPlates->is_visible = $plate['is_visible'];
            $newPlates->save();
        }
    }
}
