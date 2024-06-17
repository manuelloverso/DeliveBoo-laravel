<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Restaurant;

class RestaurantSeeder extends Seeder
{

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $restaurants = config('restaurants_db.restaurants');
        foreach ($restaurants as $restaurant) {
            $newRestaurant = new Restaurant();
            $newRestaurant->address = $restaurant['address'];
            $newRestaurant->mail = $restaurant['mail'];
            $newRestaurant->phone_number = $restaurant['phone_number'];
            $newRestaurant->vat = $restaurant['vat'];
            $newRestaurant->name = $restaurant['name'];
            $newRestaurant->image = $restaurant['image'];
            $newRestaurant->user_id = $restaurant['user_id'];
            $newRestaurant->save();
            $newRestaurant->types()->attach($restaurant['types']);
        }
    }
}
