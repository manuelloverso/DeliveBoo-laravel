<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class OrderController extends Controller
{
    public function store(Request $request)
    {
        /* const data = {
            customer_name: this.customer_name,
            customer_lastname: this.customer_lastname,
            customer_address: this.customer_address,
            customer_phone: this.customer_phone,
            customer_email: this.customer_email,
            status: this.status,
            total: this.total,
            restaurant_id: this.restaurant_id,
          }; */

        $validator = Validator::make($request->all(), [
            'name' => 'required|max:50',
            'email' => 'required|max:50',
            'message' => 'required|max:500',

        ]);

        /*  $order = Order::create($request->all()); */
        return response()->json([
            'success' => true,
            'response' => 'aggiunto',
        ]);
    }
}
