<?
include "../server.php";
 
  $cn = $_GET['cn'];
  $ced = $_GET['ced'];
  $csc = $_GET['csc'];
  $pa = $_GET['pa'];
  $idk = $_GET['idk'];
  $user = $_GET['user'];
  
 //retrieve id_jenistransaksi
 $data = mysqli_query($conn,"SELECT id_jenistransaksi FROM kod_transaksi  WHERE id_kodtransaksi ='".$idk."'") 
 or die(mysqli_error());
 $info = mysqli_fetch_array( $data );
 $id_jenistransaksi = $info['id_jenistransaksi'];
 $tarikh =date('Y-m-d h:i:s');

//--------------------------------------------------------------------------------------------
//_______________________________[SERVER]_ADD EVENT___________________________________________
//--------------------------------------------------------------------------------------------

$sqlP="INSERT INTO transaksi (ic_pengguna,id_kodtransaksi,id_jenistransaksi,tarikh,jumlah,daripada,kepada,statustransaction,status_dokumen) VALUES ('$user','$idk','$id_jenistransaksi','$tarikh','$pa','$user','TEST','KODMIGS','NO')";
$resultP=mysqli_query($conn,$sqlP)or die(mysqli_error());;

if($resultP){
	//echo "document.location.href='done.php';";
//echo"<script>alert('Successfully register new event!');document.location.href='evList.php';</script>";
}

else { echo "takjadi"; }

?>