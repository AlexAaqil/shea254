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
            'Authorization' => 'Basic ' . base64_encode('k78ssqi3z3tYHM3V52trTHebGNClijBWxPrLe9BF:2aj90YUwwMryPHiuYRVhjDR13Qw2dkhlgr2sBKG49shVBCuqt3i9Vb6cgufo3unbVE0M2bz2G68usMy9Zfel9L8DdNnc9QruCV54g6Ilxe3iD27IYvCBNsKIFZKQvey9'),
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
            'merchantCode' => $this->shortcode,
            'amount' => $amount,
            'phoneNumber' => $phone_number,
            'accountReference' => $order_number,
            'transactionDesc' => 'Payment for Order ' . $order_number,
            'callbackUrl' => $this->callbackUrl,
        ]);

        var_dump($response);
        
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
