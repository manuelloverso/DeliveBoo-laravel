<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Braintree\Gateway;


class OrderController extends Controller
{
    public function processOrder(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'customer_name' => 'required|min:2|max:50',
            'customer_lastname' => 'required|min:2|max:50',
            'customer_address' => 'required|min:3|max:255',
            'customer_phone' => 'required|min_digits:5|max_digits:15',
            'total' => 'required|numeric|min:0|max:1000|decimal:2',
            'customer_email' => 'required|email|max:100',
            'restaurant_id' => 'required|exists:restaurants,id',
        ]);



        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validation has failed',
                'errors' => $validator->errors()
            ]);
        } else {
            //handle payment
            $gateway = new Gateway([
                'environment' => 'sandbox',
                'merchantId' => '55mrb2n9b6hnddxt',
                'publicKey' => 'r4yn4xhwkjd5szyg',
                'privateKey' => '1699468aebc9ae859b317856a3988031'
            ]);

            $result = $gateway->transaction()->sale([
                'amount' => $request->total,
                'paymentMethodNonce' => $request->reqPayload['nonce'],
                'deviceData' => $request->reqPayload['deviceData'],
                'options' => [
                    'submitForSettlement' => True
                ]
            ]);

            if ($result->success) {
                $newOrder = new Order();
                $newOrder->customer_name = $request->customer_name;
                $newOrder->customer_lastname = $request->customer_lastname;
                $newOrder->customer_address = $request->customer_address;
                $newOrder->customer_phone = $request->customer_phone;
                $newOrder->status = 'accettato';
                $newOrder->total = $request->total;
                $newOrder->customer_email = $request->customer_email;
                $newOrder->restaurant_id = $request->restaurant_id;
                $newOrder->save();

                //popolo la pivot
                foreach ($request->cart as $plate) {
                    $newOrder->plates()->attach($plate['plateObj']['id'], [
                        'plate_price' => $plate['plateObj']['price'],
                        'plate_quantity' => $plate['quantity'],
                    ]);
                }

                return response()->json([
                    'success' => true,
                    'message' => 'order received successfully',
                ]);
            } else {
                return response()->json([
                    'success' => false,
                    'message' => 'transaction has failed',
                ]);
            }
        }
    }
}
