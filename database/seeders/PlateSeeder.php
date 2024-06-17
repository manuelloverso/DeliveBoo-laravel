<?php

namespace Database\Seeders;

use App\Models\Admin\Plate;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PlateSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $plates = config('plates_db.plates');
        foreach($plates as $plate){
            $newPlates = new Plate();
            $newPlates->restaurant_id = $plate['restaurant_id'];
            $newPlates->name = $plate['name'];
            $newPlates->image = $plate['image'];
            $newPlates->description = $plate['description'];
            $newPlates->price = $plate['price'];
            $newPlates->is_visible = $plate['is_visible'];

            $newPlates->save();




        }

        
    }
}
