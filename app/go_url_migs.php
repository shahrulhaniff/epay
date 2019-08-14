<html>
<head>
<style>
body {
  background-color: $02b7ff;
}

@media only screen and (max-width: 600px) {
  body {
    background-color: lightblue;
  }
}
</style>
</head><body>
<?php
include "../server.php";
 
  $cn = $_GET['cn'];
  $ced = $_GET['ced'];
  $csc = $_GET['csc'];
  $pa = $_GET['pa'];
  $idk = $_GET['idk'];
  $user = $_GET['user'];
  
  echo "<h1>Card number :",$cn , "<br>Card exp date :",$ced , "<br>Card Security Code :",$csc , "<br>idk :",$idk, "<br>User :",$user,"</h1>";
 
 //retrieve id_jenistransaksi
 $data = mysqli_query($conn,"SELECT id_jenistransaksi FROM kod_transaksi  WHERE id_kodtransaksi ='".$idk."'") 
 or die(mysqli_error());
 $info = mysqli_fetch_array( $data );
 $id_jenistransaksi = $info['id_jenistransaksi'];
 $tarikh =date('Y-m-d h:i:s');

//--------------------------------------------------------------------------------------------
//_______________________________[SERVER]_ADD EVENT___________________________________________
//--------------------------------------------------------------------------------------------

$sqlP="INSERT INTO transaksi (ic_pengguna,id_kodtransaksi,id_jenistransaksi,tarikh,jumlah,daripada,kepada,statustranction,statusdokumen) VALUES ('$user','$idk','$id_jenistransaksi','$tarikh','$pa','$user','TEST','KODMIGS','NO')";
$resultP=mysqli_query($conn,$sqlP);


if($resultP){
	echo "document.location.href='done.php';";
//echo"<script>alert('Successfully register new event!');document.location.href='evList.php';</script>";
}
else  { echo "tiada transaksi migs lagi"; }

?>


<!--
<br>
<a href="done.php">Done</a>
<button onclick="closeWin()">close</button>

<script>

function closeWin() {
  browser.close();
}
</script> -->

</body>
</html>