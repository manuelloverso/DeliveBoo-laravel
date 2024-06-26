<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Order;
use Faker\Generator as Faker;

class OrderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(Faker $faker): void
    {

        $orders = config('orders_db.orders');

        foreach ($orders as $order) {
            $newOrder = new Order();
            $newOrder->restaurant_id = $order['restaurant_id'];
            $newOrder->customer_name = $order['customer_name'];
            $newOrder->customer_lastname = $order['customer_lastname'];
            $newOrder->customer_address = $order['customer_address'];
            $newOrder->customer_phone = $order['customer_phone'];
            $newOrder->customer_email = $order['customer_email'];
            $newOrder->status = $order['status'];
            $newOrder->total = $order['total'];
            $newOrder->created_at = $order['date'];
            $newOrder->save();
        }

        for ($i = 0; $i < 200; $i++) {
            $newOrder = new Order();
            $newOrder->restaurant_id = $faker->numberBetween(1, 5);
            $newOrder->customer_name = $faker->firstName('male');
            $newOrder->customer_lastname = $faker->lastName();
            $newOrder->customer_address = $faker->streetAddress();
            //dd($newOrder);
            $newOrder->customer_phone = 3214213652;
            $newOrder->customer_email = $faker->freeEmail();
            $newOrder->status = 'consegnato';
            $newOrder->total = $faker->randomFloat(2, 5, 99);
            $newOrder->created_at = $faker->dateTimeBetween('-1 years', 'today');
            $newOrder->save();
        }





    }
}
