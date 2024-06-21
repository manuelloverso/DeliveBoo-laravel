<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Order;

class OrderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
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
            $newOrder->save();
        }
    }
}
