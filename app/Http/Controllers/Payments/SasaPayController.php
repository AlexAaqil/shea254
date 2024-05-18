<?php

namespace App\Http\Controllers\Payments;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;
use App\Models\Payment;

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
            // 'Amount' => $amount,
            'Amount' => 100,
            'PhoneNumber' => $phone_number,
            'Currency' => 'KES',
            'AccountReference' => $order_number,
            'TransactionDesc' => 'Payment for Order ' . $order_number,
            'TransactionFee' => 0,
            'CallBackURL' => $this->callbackUrl,
        ]);

        return json_decode($response);
    }

    public function paymentCallback(Request $request)
    {
        dd('payment callback');
        $data = json_decode($request->getContent(), true);
        Storage::append('logs/payments.log', json_encode($data));

        // Extract relevant data from the callback
        $orderId = $data['BillRefNumber'];
        $transactionStatus = $data['ResultCode'] == 0 ? 'paid' : 'failed';
        $transactionDate = $data['TransactionDate'];
        $transactionAmount = $data['TransAmount'];
        $transactionDescription = $data['ResultDesc'];

        dd($data);

        $payment = Payment::where('order_id', $orderId)->first();

        if ($payment) {
            $payment->status = $transactionStatus;
            $payment->transaction_date = $transactionDate;
            $payment->amount = $transactionAmount;
            $payment->description = $transactionDescription;
            $payment->save();
        }

        return response()->json(['message' => 'Callback received successfully.']);
    }
}
