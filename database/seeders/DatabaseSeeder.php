<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Database\Seeders\RestaurantSeeder;
use Database\Seeders\UserSeeder;
use Database\Seeders\PlateSeeder;
use Database\Seeders\OrderSeeder;
use Database\Seeders\OrderPlateSeeder;





use Database\Seeders\TypeSeeder;


class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            UserSeeder::class,
            TypeSeeder::class,
            RestaurantSeeder::class,
            PlateSeeder::class,
            OrderSeeder::class,
            OrderPlateSeeder::class,

        ]);
    }
}
