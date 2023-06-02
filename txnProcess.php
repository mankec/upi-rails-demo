<?php
error_reporting(0);
require_once('lib/Green_Config.php');
require_once('lib/GreenCheckSum.php');

$checkSum = "";
$paramList = array();

$gateway_type = $_POST['gateway_type'];
$cust_Mobile = $_POST['cust_Mobile'];
$cust_Email = $_POST['cust_Email'];
// $orderId = "ORD".time();
$orderId = $_POST['orderId'];
$txnAmount = $_POST['txnAmount'];
$txnNote = $_POST['txnNote'];

$callback_url = "http://localhost/upi/txnResult.php";

// $AHKWEB_TXN_URL='https://payment.gctsoft.in/stage/process';
$AHKWEB_TXN_URL='https://payment.gctsoft.in/order/process';

// Create an array having all required parameters for creating checksum.
$paramList["upiuid"] = $upiuid;
$paramList["token"] = $token;
$paramList["orderId"] = $orderId ;
$paramList["txnAmount"] = $txnAmount;
$paramList["txnNote"] = $txnNote;
$paramList["callback_url"] = $callback_url;
$paramList["cust_Mobile"] = $cust_Mobile;
$paramList["cust_Email"] = $cust_Email;
$checkSum = GreenCheckSum::generateSignature($paramList,$secret);
?>
<html>
<head>
	<title>Gateway Check Out Page</title>
</head>
<body>
	<center><h1>Please do not refresh this page...</h1></center>
	<form method="post" action="<?php echo $AHKWEB_TXN_URL ?>" name="f1">
		<table border="1">
			<tbody>
				<?php
				foreach($paramList as $name => $value) {
					echo '<input type="" name="' . $name .'" value="' . $value . '">';
				}
				?>
				<input type="" name="checksum" value="<?php echo $checkSum ?>">
				<input type="submit" value="Proceed">
			</tbody>
		</table>
		<script type="text/javascript">
			// document.f1.submit();
		</script>
	</form>
</body>
</html>
