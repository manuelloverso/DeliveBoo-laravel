<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\Plate;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = auth()->user();
        $restaurant = $user->restaurant;
        $orders = $restaurant->orders->sortByDesc('id');

        return view('admin.orders.index', compact('orders'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Order $order)
    {
        $data = [];
        $pivot = DB::table('order_plate')->where('order_id', $order->id)->get();
        foreach ($order->plates as $plate) {
            $qty = null;
            $price = null;
            $filtPivot = $pivot->where('plate_id', $plate->id);

            foreach ($filtPivot as $el) {
                $qty = $el->plate_quantity;
                $price = $el->plate_price;
            }
            ;
            // dd($plate->name);
            array_push($data, [
                'name' => $plate->name,
                'qty' => $qty,
                'price' => $price,
            ]);
        }

        $plates = json_encode($data);

        return view('admin.orders.show', compact('plates', 'order'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
