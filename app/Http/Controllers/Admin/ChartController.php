<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class ChartController extends Controller
{
    public function index()
    {

        $user = auth()->user();
        $restaurant = $user->restaurant;
        $orders = $restaurant->orders->sortByDesc('id');

        // Grafico ordini per mese
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
                    $count = $count +1;
                }
            }
            array_unshift($data['labels'], $date->format('m-y'));
            array_unshift($data['data'], $count);
            date_sub($date, date_interval_create_from_date_string('1 month'));
        }


        


        




        //Grafico piatto per mese
        
        $plateData = [
            'labels' => [],
            'data' => []
        ];
        $selectedPlate = $restaurant->plates->where('id', 2);
        
        
        $dateTwo = date_create('now');
        
        for ($i = 0; $i < 12; $i++) {
            
            $count = 0;
            foreach($orders as $order){
                if($order->created_at->format('m-y') == $dateTwo->format('m-y')){
                    $pivot = DB::table('order_plate')->where('order_id', $order->id)->get();
                    foreach($pivot as $row){
                        if ($row->order_id == $order->id && $row->plate_id == 2) {
                            $count = $count + $row->plate_quantity;
                        }
                    }
                    // dd($count);
                    
                }
                
            }
            array_unshift($plateData['labels'], $dateTwo->format('m-y'));
            array_unshift($plateData['data'], $count);

            date_sub($dateTwo, date_interval_create_from_date_string('1 month'));


        
        }
        dd($plateData);



        return view('admin.chart.barchart', compact('data'));
    }
}