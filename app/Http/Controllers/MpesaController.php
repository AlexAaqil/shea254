<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Sale;
use Illuminate\Support\Facades\Storage;

class MpesaController extends Controller
{
    public function stkPush($phone, $amount, $ordernum){
        #Callback url
        // define('CALLBACK_URL', 'https://shea254.com/shea254/public/Payments/callback_url.php?order_id=');
        define('CALLBACK_URL', 'https://pay.shea254.com/pay/callback.php');
  
        # access token
        $consumerKey = env('MPESA_CONSUMER_KEY'); //Fill with your app Consumer Key
        $consumerSecret = env('MPESA_CONSUMER_SECRET'); // Fill with your app Secret
  
        # provide the following details, this part is found on your test credentials on the developer account
        $BusinessShortCode = '6812022'; //business short code
        $Passkey = env('MPESA_PASSKEY'); //live passkey
        $phone = preg_replace('/^0/', '254', str_replace("+", "", $phone));
        $PartyA = $phone; // This is your phone number,
        $PartyB = '4311370'; // For the buy goods, the till number. For paybill, just the paybill
        $TransactionDesc = 'Pay Order'; //Insert your own description
        # Get the timestamp, format YYYYmmddhms -> 20181004151020
        $Timestamp = date('YmdHis');    
        # Get the base64 encoded string -> $password. The passkey is the M-PESA Public Key
        $Password = base64_encode($BusinessShortCode.$Passkey.$Timestamp);
        # header for access token
        $headers = ['Content-Type:application/json; charset=utf8'];
  
        # M-PESA endpoint urls
        $access_token_url = 'https://api.safaricom.co.ke/oauth/v1/generate?grant_type=client_credentials';
        $initiate_url = 'https://api.safaricom.co.ke/mpesa/stkpush/v1/processrequest';  
  
        $curl = curl_init($access_token_url);
        curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($curl, CURLOPT_HEADER, FALSE);
        curl_setopt($curl, CURLOPT_USERPWD, $consumerKey.':'.$consumerSecret);
        $result = curl_exec($curl);
        $status = curl_getinfo($curl, CURLINFO_HTTP_CODE);
        $result = json_decode($result);
        $access_token = $result->access_token;  
  
        curl_close($curl);
  
        # header for stk push
        $stkheader = ['Content-Type:application/json','Authorization:Bearer '.$access_token];
        # initiating the transaction
  
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $initiate_url);
        curl_setopt($curl, CURLOPT_HTTPHEADER, $stkheader); //setting custom header
        
        $curl_post_data = array(
  
          //Fill in the request parameters with valid values
          'BusinessShortCode' => $BusinessShortCode,
          'Password' => $Password,
          'Timestamp' => $Timestamp,
          'TransactionType' => 'CustomerBuyGoodsOnline', // CustomerBuyGoodsOnline or CustomerPayBillOnline
          'Amount' => $amount,
          'PartyA' => $PartyA,
          'PartyB' => $PartyB,
          'PhoneNumber' => $PartyA,
          'CallBackURL' => CALLBACK_URL,
          'AccountReference' => $ordernum,
          'TransactionDesc' => $TransactionDesc
        );
  
        $data_string = json_encode($curl_post_data);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_POST, true);
        curl_setopt($curl, CURLOPT_POSTFIELDS, $data_string);
        $curl_response = curl_exec($curl);
  
        $res = (array)(json_decode($curl_response));
        $ResponseCode = $res['ResponseCode'];
        return $ResponseCode;
    }
}
