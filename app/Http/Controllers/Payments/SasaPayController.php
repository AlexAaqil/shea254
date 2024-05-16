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

    private function getAuthorization()
    {
        $ch = curl_init('https://sandbox.sasapay.app/oauth/v1/generate?grant_type=client_credentials');
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
        'Authorization: Basic ' . base64_encode('k78ssqi3z3tYHM3V52trTHebGNClijBWxPrLe9BF:2aj90YUwwMryPHiuYRVhjDR13Qw2dkhlgr2sBKG49shVBCuqt3i9Vb6cgufo3unbVE0M2bz2G68usMy9Zfel9L8DdNnc9QruCV54g6Ilxe3iD27IYvCBNsKIFZKQvey9')
        ]);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        $response = curl_exec($ch);
        $response = json_decode($response);
        dd($response);
        if($response['status'] == true) {
            return $response['access_token'];
        } else {
            return "Something went wrong";
        }
    }

    public function initiatePayment($phone_number, $amount, $order_number, $email)
    {
        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . $this->getAuthorization(),
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
