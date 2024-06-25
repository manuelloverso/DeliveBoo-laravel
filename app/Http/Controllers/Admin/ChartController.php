<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

class ChartController extends Controller
{
    public function index()
    {

        $user = auth()->user();
        $restaurant = $user->restaurant;
        $orders = $restaurant->orders->sortByDesc('id');

        $data = [
            'labels' => [],
            'data' => []
        ];

        

        $date = date_create('now');
        
        for ($i = 0; $i < 12; $i++) {
            // var_dump(date_format($date, 'Y-m-d h:m:s') . "\n");
            
            $count = 0;
            foreach ($orders as $order) {
            


                
                if($order->created_at->format('m-y') == $date->format('m-y')){
                    var_dump($order->created_at->format('m-y'), $date->format('m-y'));
                    $count = $count +1;
                }
                   
                
            }
            array_unshift($data['labels'], $date->format('m-y'));
            array_unshift($data['data'], $count);

            
            date_sub($date, date_interval_create_from_date_string('1 month'));
        }


        // $newdate = date("m-Y", strtotime("-1 months"));
        // dd($newdate);



        // Replace this with your actual data retrieval logic
        // $data = [
        //     'labels' => ['January', 'February', 'March', 'April', 'May'],
        //     'data' => [65, 59, 80, 81, 56],
        // ];
        return view('admin.chart.barchart', compact('data'));
    }
}