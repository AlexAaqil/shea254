<?php

namespace App\Http\Controllers\Payments;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class SasaPayController extends Controller
{
    protected $authorizationUrl;
    protected $baseUrl;
    protected $apiKey;
    protected $secretKey;
    protected $shortcode;
    protected $callbackUrl;

    public function __construct()
    {
        $this->authorizationUrl = env('SASAPAY_AUTHORIZATION_URL');
        $this->baseUrl = env('SASAPAY_BASE_URL');
        $this->apiKey = env('SASAPAY_API_KEY');
        $this->secretKey = env('SASAPAY_SECRET_KEY');
        $this->shortcode = env('SASAPAY_SHORTCODE');
        $this->callbackUrl = env('SASAPAY_CALLBACK_URL');
    }

    private function getAuthorization()
    {
        $response = Http::withHeaders([
            'Authorization' => 'Basic ' . base64_encode($this->apiKey .':' .$this->secretKey),
        ])->get($this->authorizationUrl);

        return $response->json('access_token');
    }

    public function initiatePayment($phone_number, $amount, $order_number, $email)
    {
        $accessToken = $this->getAuthorization();

        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . $accessToken,
            'Content-Type' => 'application/json',
        ])->post($this->baseUrl, [
            'MerchantCode' => $this->shortcode,
            'NetworkCode' => 63902,
            'Amount' => $amount,
            'PhoneNumber' => $phone_number,
            'Currency' => 'KES',
            'AccountReference' => $order_number,
            'TransactionDesc' => 'Payment for Order ' . $order_number,
            'TransactionFee' => 0,
            'CallBackURL' => $this->callbackUrl,
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
