<?php

namespace App\Http\Controllers\Payments;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;
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

    public function initiatePayment($phone_number, $amount, $order_number, $payment_gateway)
    {
        $accessToken = $this->getAuthorization();

        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . $accessToken,
            'Content-Type' => 'application/json',
        ])->post($this->baseUrl, [
            'MerchantCode' => $this->shortcode,
            'NetworkCode' => $payment_gateway,
            'Amount' => $amount,
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
        $data = json_decode($request->getContent(), true);

        // Log the raw callback data to the custom payments log file
        Log::channel('payments')->debug('Callback received: ', $data);

        // Check if data is received
        if (empty($data)) {
            Log::channel('payments')->error('Callback data is empty or invalid JSON.');
            return response()->json(['message' => 'Invalid callback data.'], 400);
        }

        Storage::append('logs/payments.log', json_encode($data));

        // Extract relevant data from the callback
        $orderId = $data['MerchantRequestID'];
        $transactionStatus = $data['ResultCode'] == 0 ? 'paid' : 'failed';
        $responseCode = $data['ResultCode'];
        $responseDescription = $data['ResultDesc'];

        $payment = Payment::where('merchant_request_id', $orderId)->first();

        // Check if orderId is available
        if (empty($orderId)) {
            Log::channel('payments')->error('Order ID (MerchantRequestID) is missing in the callback data.');
            return response()->json(['message' => 'Order ID missing.'], 400);
        }

        // Update the payments table
        $payment = Payment::where('merchant_request_id', $orderId)->first();

        if ($payment) {
            $payment->status = $transactionStatus;
            $payment->response_code = $responseCode;
            $payment->response_description = $responseDescription;
            $payment->save();

            Log::channel('payments')->info("Payment record for order_id {$orderId} updated successfully.");
        } else {
            Log::channel('payments')->warning("Payment record for order_id {$orderId} not found.");
        }

        return response()->json(['message' => 'Callback received successfully.']);
    }
}
