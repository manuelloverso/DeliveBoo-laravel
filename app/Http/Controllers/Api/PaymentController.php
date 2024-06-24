<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Braintree\Gateway;

class PaymentController extends Controller
{
    public function index()
    {
        $gateway = new Gateway([
            'environment' => 'sandbox',
            'merchantId' => '55mrb2n9b6hnddxt',
            'publicKey' => 'r4yn4xhwkjd5szyg',
            'privateKey' => '1699468aebc9ae859b317856a3988031'
        ]);
        $clientToken = $gateway->clientToken()->generate();

        /* dd($clientToken); */
        return response()->json([
            'success' => true,
            'response' => $clientToken,
        ]);
    }

    public function store(Request $request)
    {
        return response()->json([
            'success' => true,
            'response' => $request,
        ]);

        $gateway = new Gateway([
            'environment' => 'sandbox',
            'merchantId' => '55mrb2n9b6hnddxt',
            'publicKey' => 'r4yn4xhwkjd5szyg',
            'privateKey' => '1699468aebc9ae859b317856a3988031'
        ]);

        $result = $gateway->transaction()->sale([
            'amount' => '10.00',
            'paymentMethodNonce' => $request->nonce,
            'deviceData' => $request->deviceData,
            'options' => [
                'submitForSettlement' => True
            ]
        ]);
    }
}
