<?php session_start(); include "../../server.php";?>
<html>
<head>
<title>Resit</title>
<style>
.button {
  background-color: #1b1c57;
  border: none;
  color: white;
  padding: 15px 32px;
  text-align: center;
  text-decoration: none;
  display: inline-block;
  font-size: 30px;
  margin: 4px 2px;
  cursor: pointer;
  width: 100%;
}

p,table {
	font-size:30px;
	font-family: Arial, Helvetica, sans-serif;
}

</style>
</head>
<body>
<?php
//https://epayment.unisza.edu.my/sample/sample_finish.php?Title=Payment+Sample&vpc_3DSECI=02&vpc_3DSXID=aWsZV2oQ%2BQ7Q5ngA5ltGQ1YFlYA%3D&vpc_3DSenrolled=Y&vpc_3DSstatus=Y&vpc_AVSRequestCode=Z&vpc_AVSResultCode=Unsupported&vpc_AcqAVSRespCode=Unsupported&vpc_AcqCSCRespCode=M&vpc_AcqResponseCode=00&vpc_Amount=1&vpc_AuthorizeId=727337&vpc_BatchNo=20190318&vpc_CSCResultCode=M&vpc_Card=MC&vpc_Command=pay&vpc_Currency=MYR&vpc_Locale=en&vpc_MerchTxnRef=PC+KOD+SAMPLE-1234&vpc_Merchant=10701100006&vpc_Message=Approved&vpc_OrderInfo=0&vpc_ReceiptNo=907710370666&vpc_SecureHash=0D2E5C10866166C3D02ECD8C89DC2CB9FACE2CDE6DD251C80E7EC8C2FD54994F&vpc_SecureHashType=SHA256&vpc_TransactionNo=2070000701&vpc_TxnResponseCode=0&vpc_VerSecurityLevel=05&vpc_VerStatus=Y&vpc_VerToken=jDXMJPFbWCuJCBEFkBaIARcAAAA%3D&vpc_VerType=3DS&vpc_Version=1

require_once("class.vpcVerifyPayment.php");
require_once("class.sqlLite.php");
// $si = new SimpanHash();
// $si->flush();
// $si->tambahHash('adasatu');
// $rst=$si->checkHash('test');

// ini_set('display_errors',1);
// error_reporting(E_ALL);

// set a flag to indicate if hash has been validated
$errorExists = false;

$event1 = 'Cashless';
$ch = new SimpanHash();
$vpc = new vpcVerifyPayment('prod');

$adaDalamDb = true;
if (strlen($vpc->SECURE_SECRET) > 0 && 
    @$_GET["vpc_TxnResponseCode"] != "7" && 
    @$_GET["vpc_TxnResponseCode"] != "No Value Returned") {

     $vpc->setSecureHash();
     $vpc->generateHash();

     // check hash ini sudah guna ke belum
     if ($ch->checkHash($vpc->vpc_Txn_Secure_Hash) > 0) {
        // Sudah ada yang pakai hash ini -> Gagal
        $adaDalamDb = true;
     } else {
        $adaDalamDb = false;        
        // echo $vpc->vpc_Txn_Secure_Hash;
        $ch->tambahHash($vpc->vpc_Txn_Secure_Hash);
        // bwh ni adalah apa yang dihash
        // echo "<h1>test ".$vpc->sha256HashData." </h1>";
     }


     if ($vpc->compareHash() && !$adaDalamDb) {
        // Secure Hash validation succeeded, add a data field to be displayed
        // later.
        $hashValidated = "<FONT color='#00AA00'><strong>CORRECT</strong></FONT>";
     } else {
        // Secure Hash validation failed, add a data field to be displayed
        // later.
        $hashValidated = "<FONT color='#FF0066'><strong>INVALID HASH</strong></FONT>";
        $errorExists = true;
     }

     // Standard Receipt Data
     $amount = $vpc->null2known($_GET["vpc_Amount"]);
     $locale = $vpc->null2known($_GET["vpc_Locale"]);
     $batchNo = $vpc->null2known($_GET["vpc_BatchNo"]);
     $command = $vpc->null2known($_GET["vpc_Command"]);
     $message = $vpc->null2known($_GET["vpc_Message"]);
     $version = $vpc->null2known($_GET["vpc_Version"]);
     $cardType = $vpc->null2known($_GET["vpc_Card"]);
     $orderInfo = $vpc->null2known($_GET["vpc_OrderInfo"]);
     $receiptNo = $vpc->null2known($_GET["vpc_ReceiptNo"]);
     $merchantID = $vpc->null2known($_GET["vpc_Merchant"]);
     //$authorizeID = $vpc->null2known($_GET["vpc_AuthorizeId"]);
     $authorizeID = 'none';
     $merchTxnRef = $vpc->null2known($_GET["vpc_MerchTxnRef"]);
     $transactionNo = $vpc->null2known($_GET["vpc_TransactionNo"]);
     $acqResponseCode = $vpc->null2known($_GET["vpc_AcqResponseCode"]);
     $txnResponseCode = $vpc->null2known($_GET["vpc_TxnResponseCode"]);


     // 3-D Secure Data
     $verType = array_key_exists("vpc_VerType", $_GET) ? $_GET["vpc_VerType"] : "No Value Returned";
     $verStatus = array_key_exists("vpc_VerStatus", $_GET) ? $_GET["vpc_VerStatus"] : "No Value Returned";
     $token = array_key_exists("vpc_VerToken", $_GET) ? $_GET["vpc_VerToken"] : "No Value Returned";
     $verSecurLevel = array_key_exists("vpc_VerSecurityLevel", $_GET) ? $_GET["vpc_VerSecurityLevel"] : "No Value Returned";
     $enrolled = array_key_exists("vpc_3DSenrolled", $_GET) ? $_GET["vpc_3DSenrolled"] : "No Value Returned";
     $xid = array_key_exists("vpc_3DSXID", $_GET) ? $_GET["vpc_3DSXID"] : "No Value Returned";
     $acqECI = array_key_exists("vpc_3DSECI", $_GET) ? $_GET["vpc_3DSECI"] : "No Value Returned";
     $authStatus = array_key_exists("vpc_3DSstatus", $_GET) ? $_GET["vpc_3DSstatus"] : "No Value Returned";

     $errorTxt = "";

     // Show this page as an error page if vpc_TxnResponseCode equals '7'
     if ($txnResponseCode == "7" || $txnResponseCode == "No Value Returned" || $errorExists) {
         $errorTxt = "Error ";
     }

     if ($adaDalamDb) {
         $errorTxt = "Hashing ini sudah ada sebelum ini";
     }
 
    $title = $_GET["Title"];

} else {
 // Secure Hash was not validated, add a data field to be displayed later.
 // $hashValidated = "<FONT color='orange'><strong>Not Calculated - No 'SECURE_SECRET' present.</strong></FONT>";
 $hashValidated = "<FONT color='orange'><strong>Error configuration.</strong></FONT>";
}

// Simpan dalam database
/*id version command merchTxnRef merchantID orderInfo amount txnResponseCode txnResponseCodeDesc message 
receiptNo transactionNo acqResponseCode authorizeID batchNo cardType xid token acqECI verType 
verSecurLevel enrolled authStatus verStatus verStatusDesc hashValidated title datetime */
/*
   
/*
$qInsert = "INSERT INTO `tableresponds` VALUES(null,?,?,?,?,
    ?,?,?,?,
    ?,?,?,?,?,?,?,
    ?,?,?,?,?,?,?,?,
    ?,?,?,
    ?,?,NOW())";
$stmt = $link3->prepare($qInsert);
$stmt->bind_param('issssissssssssssssssssssisis', $version,$command,$merchTxnRef,$merchantID,
    $orderInfo,$amount,$txnResponseCode,$a,
    $message,$receiptNo,$transactionNo,$acqResponseCode,$authorizeID,$batchNo,$cardType,
    $xid,$token,$acqECI,$verType,$verSecurLevel,$enrolled,$authStatus,$verStatus,
    $b,$c,$vpc->vpc_Txn_Secure_Hash,
    $adaDalamDb,$title);
$a = $vpc->getResponseDescription($txnResponseCode);
$b = $vpc->getStatusDescription($verStatus);
$c = $vpc->compareHash();


$stmt->execute();
*/

if ($vpc->compareHash() == 1 && !$adaDalamDb && $txnResponseCode==0 && $message=='Approved') { 
    //$authStatus == 'Y' && $verStatus == 'Y' <-- ada juga tak boleh
    $title = "Payment Successful";
    $title2 = "with amount $amount";
    $success = true;
    $class='blue';

    $refidExt=explode("-",$merchTxnRef);
    $refid=$refidExt[count($refidExt)-1];
    ####
    // simpan ke table bayaran -- bayaran diterima + success

    // notifikasi di sini

    ####
     
/*
    // Email kepada user
    $subj = "$event1: Thank you for your payment using credit card";
    $amountRM = $amount/100;

    $body = "
    Thank you for your payment. Here is the url for your payment details :\n\n
    https://epayment.unisza.edu.my/epayment_finish.php?receiptNo=$receiptNo";

    //get the email 
    // list($d,$d,$refid) = explode("-", $page['merchTxnRef']);
    $email = getEmail($refid);
    $emailPembayar = $email;
*/    
  

    // if ($sendtoemelsecretariat) {
    //     $subj = "$event1: A Payment using credit card";
    //     $body = "\n
    // From: $refid" . " \nEmail: " . $emailPembayar;
    //     $body .= "
    // Here is the url for the payment details :\n\n
    // https://epayment.unisza.edu.my/epayment_finish.php?receiptNo=".$receiptNo;
    //     $email = $emel_secre; 
    //     send_email($subj,$body,$email, $email);
    // }


} else {
    $title = "Payment Unsuccessful";
    $title2 = "";
    $success = false;
    $class='red';

    $receiptNo = date('dmYHis').$merchTxnRef;
    
    $subj = "$event1: epayment bayaran cancel/gagal";
    $amountRM = $amount/100;
    $body = "
    Here is the url for the payment details :\n\n
    https://epayment.unisza.edu.my/epayment_finish.php?receiptNo=$receiptNo";

    $name = "recepient";
    // if ($debug) {
        // $email = $emel_debug;
        // // send_email($subj,$body,$email, $email);
    // }
}

// data for page
$page = array();

$page['title'] = "$title - $errorTxt $event1 E-Payment Response";
$page['event'] = $event1;
$page['linkevent'] = "event.php";
$page['successtitle'] = $title;
$page['successtitle2'] = $title2;
$page['success'] = $success;
$page['class'] = $class;
$page['datetime'] = date("Y-m-d H:i:s");
$page['merchTxnRef'] = $merchTxnRef;
$page['orderInfo'] = $orderInfo;
$page['purchaseamount'] = "RM".number_format(($amount/100), 2, '.', '');
$page['grdtrc'] = $vpc->getResponseDescription($txnResponseCode);
$page['message'] = $message;
$page['txnResponseCode'] = $txnResponseCode;
$page['receiptNo'] = $receiptNo;
$page['transactionNo'] = $transactionNo;
$page['authorizeID'] = $authorizeID;
$page['batchNo'] =$batchNo;
$page['cardType'] = $cardType;
$page['authStatus'] = $authStatus;

// $qInsert = "INSERT INTO `tablepage` VALUES(null,?,?,?,?,
//     ?,?,?,?,
//     ?,?,?,?,
//     ?,?,?,?,
//     ?,?,?,?)";
// $stmt =  mysqli_stmt_init($link3);

// if (!$stmt->prepare($qInsert))
//     echo "Error" . $stmt->error;
// $stmt->bind_param('sssssissssssssssssss', $page['title'],$page['event'],$page['linkevent'],$page['successtitle'],
//     $page['successtitle2'],$page['success'],$page['class'],$page['datetime'],
//     $page['merchTxnRef'],$page['orderInfo'],$page['purchaseamount'],$page['grdtrc'],
//     $page['message'],$page['txnResponseCode'],$page['receiptNo'],$page['transactionNo'],
//     $page['authorizeID'],$page['batchNo'],$page['cardType'],$page['authStatus']);

// $stmt->execute();
//echo "<pre>";
//print_r($page);
//echo "</pre>";

//--------------------------------------------------------------------------------------------
//_______________________________[SERVER]_ADD EVENT___________________________________________
//--------------------------------------------------------------------------------------------

	$user				= $_SESSION['USER'];
 	$idk				= $_SESSION['IDK'];
  	$id_jenistransaksi	= $_SESSION['IDJT'];
 	$rf					= $_SESSION['RF'];
 	$pa					= $_SESSION['PA'];
	$tarikh 			= date('Y-m-d h:i:s');
	
	$sql = mysqli_query($conn,"SELECT description FROM kod_transaksi WHERE id_kodtransaksi='".$idk."';") or die(mysqli_error()); 
	while($info = mysqli_fetch_array( $sql )) { $description = $info['description']; }
	
	?>
	<button class="button">Resit Pembayaran Cashless UniSZA</button>
	<?php
	
	if($message=='Approved'){ $color='green'; } else { $color='red'; }
	
	echo "<table>";
	echo "<tr><td>Status</td><td>:</td>				<td><font color='".$color."'>".$message."</b></td></tr>";
	echo "<tr><td>No. Rujukan</td><td>:</td>		<td>".$transactionNo."</td></tr>";
	echo "<tr><td>Tarikh Transaksi</td><td>:</td>	<td>".$page['datetime']."</td></tr>";
	echo "<tr><td colspan='3'>&nbsp; </td></tr>";
	echo "<tr><td>Jumlah</td><td>:</td>				<td>".$pa."</td></tr>";
	echo "<tr><td colspan='3'>&nbsp; </td></tr>";
	echo "<tr><td colspan='3'>&nbsp; </td></tr>";
	echo "<tr><td>Keterangan</td><td>:</td>		<td>".$description."</td></tr>";
	echo "<tr><td colspan='3'>&nbsp; </td></tr>";
	echo "<tr><td colspan='3'>&nbsp; </td></tr>";
	echo "<tr><td>Dibayar oleh</td><td>:</td>		<td>".$user."</td></tr>";
	echo "<tr><td>ID Merchant</td><td>:</td>		<td>".$merchantID."</td></tr>";
	echo "<tr><td>Jenis Kad</td><td>:</td>			<td>".$cardType."</td></tr>";
	echo "</table>";

	echo "<p>Catatan: Resit ini dijana oleh komputer tiada tandatangan diperlukan.</p>";

$sqlP="INSERT INTO transaksi (ic_pengguna,id_kodtransaksi,id_jenistransaksi,tarikh,jumlah,daripada,kepada,statustransaction,norujukan,rf,merchantid,jeniskad,status_dokumen) VALUES ('$user','$idk','$id_jenistransaksi','$tarikh','$pa','$user','941013115436','$message','$transactionNo','$rf','$merchantID','$cardType','NO')";
$resultP=mysqli_query($conn,$sqlP)or die(mysqli_error());

unset($_SESSION['hashing']);
unset($_SESSION['USER']);
unset($_SESSION['IDK']);
unset($_SESSION['IDJT']);
unset($_SESSION['PA']);
unset($_SESSION['RF']);


echo "<br><br><p>Anda Boleh Tutup Pelayar Pembayaran ini untuk kembali ke Aplikasi Cashless UniSZA</p>";
echo "vpc_MerchTxnRef -> ". $merchTxnRef;
echo '<a href="../../extension/html2pdf/cetakResit.php?message='.$message.'&transactionNo='.$transactionNo.'&page='.$page['datetime'].'&pa='.$pa.'&user='.$user.'&merchantID='.$merchantID.'&cardType='.$cardType.'"><button type="submit" onClick="return checksemua()"><IMG SRC="../../web/imgs/print.gif" WIDTH="18" HEIGHT="18" BORDER="0" ALT=""> CETAK</button></a>';

?>
</body>
</html>