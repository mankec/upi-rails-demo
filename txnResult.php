<?php
error_reporting(0);
require_once('generate_signature.php'); 
//print_r($_POST);
$verifySignature = '';
$array = array();
$paramList = array();

$status = $_POST['status']; // Its Payment Status Only, Not Txn Status.
$message = $_POST['message']; // Txn Message.
$cust_Mobile = $_POST['cust_Mobile']; // Txn Message.
$cust_Email = $_POST['cust_Email']; // Txn Message.
$hash = $_POST['hash']; // Encrypted Hash / Generated Only SUCCESS Status.
$checksum = $_POST['checksum'];  // Checksum verifySignature / Generated Only SUCCESS Status.
$secret = 'fFHqfhlCMw';

// Payment Status.
if($status=="SUCCESS"){
	
	$paramList = hash_decrypt($hash,$secret);
	$verifySignature = GreenCheckSum::verifySignature($paramList, $secret, $checksum);

// Checksum verify.
	if($verifySignature){
		$array = json_decode($paramList);

// Payment Response
		echo "<pre>";
		echo "Payment Status: $status<br>";	
		echo "Payment Message: $message<br>";	
		echo "Customer Mobile: $cust_Mobile<br>";
		echo "Customer Email: $cust_Email<br>";
		echo "Payment hash: $hash<br>";
		echo "Payment Checksum: $checksum<hr>";	
		foreach ($array as $key => $value) {
			echo "<b>$key:</b> <b style='color:green'>$value</b><hr>";
		}	
		echo '<h2><b style="color:green">Checksum Verified!</b></h2>';	
		
	}else{
		
// Payment Response
		echo "<pre>";
		echo "Payment Status: $status<br>";	
		echo "Payment Message: $message<br>";		
		echo '<h2><b style="color:red">Checksum Invalid!</b></h2>';
		
	}	
	

} else {
	

	echo "<pre style='color:red; font-weight: bold'>";
	echo "Payment Status: ".$_POST['status']."<br>";	
	echo "Payment Message: ".$_POST['message']."<br>";	
	echo "Customer Mobile: ".$_POST['cust_Mobile']."<br>";
	echo "Customer Email: ".$_POST['cust_Email']."<br>";
	echo "hash: ".$_POST['hash']."<br>";
	echo "checksum: ".$_POST['checksum']."<br>";
	echo "</pre>";
}


?>