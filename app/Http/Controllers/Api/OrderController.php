<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Mail\NewMail;
use App\Models\Order;
use App\Models\Restaurant;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Braintree\Gateway;
use Illuminate\Support\Facades\Mail;

class OrderController extends Controller
{
    public function processOrder(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'customer_name' => 'required|min:2|max:50',
            'customer_lastname' => 'required|min:2|max:50',
            'customer_address' => 'required|min:3|max:255',
            'customer_phone' => 'required|min:5|max:15',
            'total' => 'required|numeric|min:0|max:1000|decimal:2',
            'customer_email' => 'required|email|max:100',
            'restaurant_id' => 'required|exists:restaurants,id',
        ]);



        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'validation',
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
                    'submitForSettlement' => True,
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
                //recupero la mail del ristorante
                $restaurant = Restaurant::find($request->restaurant_id);
                $user = User::find($restaurant->user_id);
                $restaurant_email = $user->user_email;


                //costruisco la lead del ristorante
                $restaurant_lead = [
                    'target' => 'restaurant',
                    'address' => 'noreply@deliverome.it',
                    'order_id' => $newOrder->id,
                    'order_total' => $request->total,
                    'customer_name' => $request->customer_name,
                    'customer_lastname' => $request->customer_lastname,
                    'customer_email' => $request->customer_email,
                    'customer_phone' => $request->customer_phone,
                    'customer_address' => $request->customer_address,
                    'cart' => $request->cart
                ];

                //costruisco la mail del cliente
                $customer_lead = [
                    'target' => 'customer',
                    'address' => 'noreply@deliverome.it',
                    'restaurant_name' => $restaurant->restaurant_name,
                    'restaurant_address' => $restaurant->address,
                    'restaurant_phone' => $restaurant->phone_number,
                    'order_total' => $request->total,
                    'cart' => $request->cart
                ];


                //mando la mail al ristorante
                Mail::to($restaurant_email)->send(new NewMail($restaurant_lead));

                //mando la mail al cliente
                Mail::to($request->customer_email)->send(new NewMail($customer_lead));

                return response()->json([
                    'success' => true,
                    'message' => 'order received successfully',
                ]);
            } else {
                return response()->json([
                    'success' => false,
                    'failedPayment' => 'transaction has failed',
                ]);
            }
        }
    }
}
