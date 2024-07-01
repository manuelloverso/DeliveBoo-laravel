<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Type;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class DashboardController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        $restaurant = $user->restaurant;
        $orders = $restaurant->orders->sortByDesc('created_at');
        $plates = $restaurant->plates;
        $plateData = [
            'labels' => [],
            'data' => []
        ];

        $order = DB::table('orders')->where('restaurant_id', $restaurant->id)->orderByDesc('created_at')->paginate(12);
        ;
        if ($order) {
            $lastOrder = $order[0];
        } else {
            $lastOrder = null;
        }


        // Grafico ordini per mese
        $data = [
            'labels' => [],
            'data' => []
        ];
        $date = date_create('now');

        for ($i = 0; $i < 12; $i++) {
            
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

        // Grafico vendite per mese
        $dataSell = [
            'labels' => [],
            'data' => []
        ];
        $dateSell = date_create('now');

        for ($i = 0; $i < 12; $i++) {

            $count = 0;
            foreach ($orders as $order) {
                if ($order->created_at->format('m-y') == $dateSell->format('m-y')) {
                    $count = $count + intval($order->total);
                }
            }
            array_unshift($dataSell['labels'], $dateSell->format('m-y'));
            array_unshift($dataSell['data'], $count);
            date_sub($dateSell, date_interval_create_from_date_string('1 month'));
        }

        $types = Type::all();
        $user = auth()->user();
        if ($user->restaurant) {
            return view('admin.dashboard', compact('user', 'data', 'plates', 'plateData', 'lastOrder', 'dataSell', 'restaurant'));
        } else {
            return view('admin.restaurants.create', compact('types'));
        }
    }
}
