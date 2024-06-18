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
            $newRestaurant->restaurant_email = $restaurant['restaurant_email'];
            $newRestaurant->phone_number = $restaurant['phone_number'];
            $newRestaurant->p_iva = $restaurant['p_iva'];
            $newRestaurant->restaurant_name = $restaurant['restaurant_name'];
            $newRestaurant->image = $restaurant['image'];
            $newRestaurant->user_id = $restaurant['user_id'];
            $newRestaurant->save();
            $newRestaurant->types()->attach($restaurant['types']);
        }
    }
}
