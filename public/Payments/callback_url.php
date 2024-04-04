<?php

session_start();
function db_conn(){
	$db_username = $_ENV['DB_USERNAME'];
	$db_password = $_ENV['DB_PASSWORD'];

	$conn = new PDO( 'mysql:host=localhost;dbname=sheacom_db', $db_username, $db_password );
	if(!$conn){
		die("Fatal Error: Connection Failed!");
	}
	return $conn;
}

$conn = db_conn();

$invoice = $_GET['orderid'];

$callbackJSONData=file_get_contents('php://input');
$callbackData=json_decode($callbackJSONData);

$resultCode=$callbackData->Body->stkCallback->ResultCode;
$resultDesc=$callbackData->Body->stkCallback->ResultDesc;
$merchantRequestID=$callbackData->Body->stkCallback->MerchantRequestID;
$checkoutRequestID=$callbackData->Body->stkCallback->CheckoutRequestID;
$pesa=$callbackData->stkCallback->Body->CallbackMetadata->Item[0]->Name;
$amount=$callbackData->Body->stkCallback->CallbackMetadata->Item[0]->Value;
$mpesaReceiptNumber=$callbackData->Body->stkCallback->CallbackMetadata->Item[1]->Value; //create field for this
$balance=$callbackData->stkCallback->Body->CallbackMetadata->Item[2]->Value;
$b2CUtilityAccountAvailableFunds=$callbackData->Body->stkCallback->CallbackMetadata->Item[3]->Value;
$transactionDate=$callbackData->Body->stkCallback->CallbackMetadata->Item[3]->Value;
$phoneNumber=$callbackData->Body->stkCallback->CallbackMetadata->Item[4]->Value;

$orderid = strval($orderid);
$amount = strval($amount);
$payment_reference = strval($mpesaReceiptNumber);
$payment_method = 'M-Pesa';

if($resultCode == 0){
	try {
		$sql = "UPDATE sales SET payment_status = 1, amount_paid = :amount, payment_reference = :payment_reference, payment_method = :payment_method WHERE order_number = :orderid";
		$stmt = $conn->prepare($sql);
		$stmt->bindParam(':orderid', $orderid, PDO::PARAM_STR);
		$stmt->bindParam(':amount', $amount, PDO::PARAM_STR);
		$stmt->bindParam(':payment_reference', $payment_reference, PDO::PARAM_STR);
		$stmt->bindParam(':payment_method', $payment_method, PDO::PARAM_STR);
		$stmt->execute();
		$stmt = null;
	} catch (PDOException $e) {
		die("Fatal Error: Failed to update sales table! " . $e->getMessage());
	}
}

$conn = null;
