<?php
require_once('Checksum.php');

$paramList = array();

$upiuid = $argv[1];
$token = $argv[2];
$orderId = $argv[3];
$txnAmount = $argv[4];
$txnNote = $argv[5];
$callback_url = $argv[6];
$cust_Mobile = $argv[7];
$cust_Email = $argv[8];
$secret = $argv[9];

$paramList["upiuid"] = $upiuid;
$paramList["token"] = $token;
$paramList["orderId"] = $orderId;
$paramList["txnAmount"] = $txnAmount;
$paramList["txnNote"] = $txnNote;
$paramList["callback_url"] = $callback_url;
$paramList["cust_Mobile"] = $cust_Mobile;
$paramList["cust_Email"] = $cust_Email;


$checkSum = GreenCheckSum::generateSignature($paramList,$secret);
$data = GreenCheckSum::openssl_encrypt();

// $iv = "@@@@&&&&####$$$$";
// $key = 'fFHqfhlCMw';
// $input = 'H';

// $data = openssl_encrypt ( $input , "AES-128-CBC" , $key, 0, $iv );

echo $checkSum;
?>