<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Plate;



class ChartController extends Controller
{
    public function index()
    {

        $user = auth()->user();
        $restaurant = $user->restaurant;
        $orders = $restaurant->orders->sortByDesc('id');
        $plates = $restaurant->plates;
        $plateData = [
            'labels' => [],
            'data' => []
        ];
        //dd($plate);


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
                if ($order->created_at->format('m-y') == $date->format('m-y')) {
                    $count = $count + 1;
                }
            }
            array_unshift($data['labels'], $date->format('m-y'));
            array_unshift($data['data'], $count);
            date_sub($date, date_interval_create_from_date_string('1 month'));
        }

        return view('admin.chart.index', compact('data', 'plates', 'plateData'));
    }



    public function show($plate)
    {
        //dd($plate);
        $plateId = intval($plate);
        //dd($plateId);
        $user = auth()->user();
        $restaurant = $user->restaurant;
        $orders = $restaurant->orders->sortByDesc('id');
        $plates = $restaurant->plates;
        //dd($plate);

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
                if ($order->created_at->format('m-y') == $date->format('m-y')) {
                    $count = $count + 1;
                }
            }
            array_unshift($data['labels'], $date->format('m-y'));
            array_unshift($data['data'], $count);
            date_sub($date, date_interval_create_from_date_string('1 month'));
        }




        // Grafico piatti per mese

        $plateData = [
            'labels' => [],
            'data' => []
        ];



        $dateTwo = date_create('now');

        for ($i = 0; $i < 12; $i++) {

            $count = 0;

            foreach ($plates as $plate) {
                foreach ($orders as $order) {
                    if ($order->created_at->format('m-y') == $dateTwo->format('m-y')) {
                        $pivot = DB::table('order_plate')->where('order_id', $order->id)->get();
                        //var_dump($pivot);
                        foreach ($pivot as $row) {
                            //dd($row->plate_quantity);
                            if ($row->order_id == $order->id && $row->plate_id == $plateId) {
                                $count = $count + $row->plate_quantity;
                                //dd($count, $row->plate_quantity);
                            }
                        }

                    }
                }
            }
            array_unshift($plateData['labels'], $dateTwo->format('m-y'));
            array_unshift($plateData['data'], $count);

            date_sub($dateTwo, date_interval_create_from_date_string('1 month'));
        }
        //dd($plateData);






        return view('admin.chart.show', compact('data', 'plates', 'plateData', 'plateId'));

    }
}
