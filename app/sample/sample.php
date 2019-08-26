<?php
session_start();
unset($_SESSION['hashing']);
include "../../server.php";
 
  $cn = $_GET['cn'];
  $ced = $_GET['ced'];
  $csc = $_GET['csc'];
  $rf = $_GET['rf'];
  $pa = $_GET['pa'];
  $idk = $_GET['idk'];
  $user = $_GET['user'];
  
 //retrieve id_jenistransaksi
 $data = mysqli_query($conn,"SELECT id_jenistransaksi FROM kod_transaksi  WHERE id_kodtransaksi ='".$idk."'") 
 or die(mysqli_error());
 $info = mysqli_fetch_array( $data );
 $id_jenistransaksi = $info['id_jenistransaksi'];

 
 $_SESSION['USER']	= $user;
 $_SESSION['IDK']	= $idk;
 $_SESSION['IDJT'] 	= $id_jenistransaksi;
 $_SESSION['RF']	= $rf;
 $_SESSION['PA']	= $pa;
 $tarikh 			=date('Y-m-d h:i:s');
 
 
//--------------------------------------------------------------------------------------------
//_______________________________[SERVER]_ADD EVENT___________________________________________
//--------------------------------------------------------------------------------------------

//$sqlP="INSERT INTO transaksi (ic_pengguna,id_kodtransaksi,id_jenistransaksi,tarikh,jumlah,daripada,kepada,statustransaction,status_dokumen) VALUES ('$user','$idk','$id_jenistransaksi','$tarikh','$pa','$user','TEST','KODMIGS','NO')";
//$resultP=mysqli_query($conn,$sqlP)or die(mysqli_error());

    require("class.vpcGenerateLink.php");
    //$byrn_array = array('0.01','0.10','0.20');
    //$vpc  = new vpcGenerateLink("prod","Payment Sample",'PC KOD SAMPLE','https://epayment.unisza.edu.my/sample/sample_finish.php',$byrn_array);
    // yg ni unkomen $vpc  = new vpcGenerateLink("prod","Payment Sample",'PC KOD SAMPLE','https://epayment.unisza.edu.my/langlit_finish.php',$byrn_array);
    //$vpc  = new vpcGenerateLink("prod","Payment Sample",'PC KOD SAMPLE','https://epayment.unisza.edu.my/sample/sample_finish.php');
    $vpc  = new vpcGenerateLink("prod","Payment Sample",'CASHLESS','https://epay.unisza.edu.my/epay/app/sample/sample_finish.php');
    //$vpc  = new vpcGenerateLink("prod","Payment Sample",'CASHLESS','https://cashless1234.000webhostapp.com/app/sample/sample_finish.php');
    //$vpc  = new vpcGenerateLink("prod","Payment Sample",'CASHLESS-APP','http://localhost/cashweb/app/sample/sample_finish.php');
    //$vpc  = new vpcGenerateLink("prod","Payment Sample",'PC KOD SAMPLE','http://myraxsoft.com/cashless/app/sample/sample_finish.php');
    $vpc->processSubmit();

    // kat kalau boleh page ni simpan user,
    // simpan apa yg disubmit untuk rujukan 

?>
<html>
<head>
    <title>UniSZA E-Payment</title>
    <meta name="robots" content="nofollow" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap-theme.min.css">
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
    <script language="javascript" type='text/javascript' src='js/jquery-2.1.4.min.js'></script>
    <link rel="stylesheet" href="css/style.css">
    
<style>
.button {
  background-color: #FF0000;
  border: none;
  color: white;
  padding: 15px 32px;
  text-align: center;
  text-decoration: none;
  display: inline-block;
  font-size: 6rem;
  margin: 4px 2px;
  cursor: pointer;
  width: 100%;
}

</style>
    
</head>
<body>

<div class="container bs-docs-container">

<center><p><h1>Proses pembayaran anda dibawa ke pelayar bank di paparan berikutnya.</h1>
<center><p><h1>Payment process will be directed to UniSZA's Bank Islam Website</h1>
<h1>Jumlah/Total Transaction:<?=$pa?></h1>
</p></center>
<form name="PayForm" id="PayForm" method="post" action="">
<input name="fee_type"      type="hidden" maxlength="15" value="<?=$pa?>" id="RegisterFeeType" />
<input name="registername"  type="hidden" 0="0" maxlength="150" value="<?=$cn?>" id="registername" />
<input name="registerid"    type="hidden" maxlength="15" value="<?=$ced?>" id="registerid" />
<input name="email"         type="hidden" maxlength="150" value="<?=$csc?>" id="email" />
<input name="rf"         	type="hidden" value="<?=$rf?>" id="rf" />
<input type='submit' value='Teruskan' name='pay' class="button"  />
</form>

</div>
</body>
</html>
