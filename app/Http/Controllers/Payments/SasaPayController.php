<?php

namespace App\Http\Controllers\Payments;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class SasaPayController extends Controller
{
    protected $baseUrl;
    protected $apiKey;
    protected $secretKey;
    protected $shortcode;
    protected $callbackUrl;

    public function __construct()
    {
        $this->baseUrl = env('SASAPAY_BASE_URL');
        $this->apiKey = env('SASAPAY_API_KEY');
        $this->secretKey = env('SASAPAY_SECRET_KEY');
        $this->shortcode = env('SASAPAY_SHORTCODE');
        $this->callbackUrl = env('SASAPAY_CALLBACK_URL');
    }

    public function initiatePayment($phone_number, $amount, $order_number, $email)
    {
        $response = Http::withHeaders([
            'ApiKey' => $this->apiKey,
            'Content-Type' => 'application/json',
        ])->post($this->baseUrl, [
            'merchantCode' => $this->shortcode,
            'amount' => $amount,
            'phoneNumber' => $phone_number,
            'accountReference' => $order_number,
            'transactionDesc' => 'Payment for Order ' . $order_number,
            'callbackUrl' => $this->callbackUrl,
        ]);

        return $response;
    }

    public function paymentCallback(Request $request)
    {
        $data = $request->all();
        // Process the callback data

        dd($data);

        return response()->json(['message' => 'Callback received successfully.']);
    }
}
