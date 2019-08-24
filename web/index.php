<?php
session_start();
include "../server.php";
$pagenow="P001";

if (empty($_SESSION['user'])) {
	header('Location:login.php'); }
	
unset($_SESSION['id']);
unset($_SESSION['jabatan']);

	/*TO CLEAR GENERATED FILE*/
	$files = glob('../extension/qr/temp/*'); // get all file names
	foreach($files as $file){ // iterate files
	  if(is_file($file))
		unlink($file); // delete file
	}
	
	
?>
<?php include "ui/header.php"; ?>
<?php include "ui/menu.php"; ?>


<!-- Overlay effect when opening sidebar on small screens -->
<div class="w3-overlay w3-hide-large w3-animate-opacity" onclick="w3_close()" style="cursor:pointer" title="close side menu" id="myOverlay"></div>

<!-- !PAGE CONTENT! -->
<div class="w3-main" style="margin-left:300px;margin-top:43px;">

  <!-- Header -->
  <header class="w3-container" style="padding-top:22px">
    <h5><b><i class="fa fa-dashboard"></i> Utama</b></h5>
  </header>
<?php 
/*To calculate participant list*/ $datacount4badge = mysqli_query($conn,"SELECT count(jenistransaksi) as myCount from kod_jenistransaksi;"); $infobadge = mysqli_fetch_array( $datacount4badge ); $countptcp = $infobadge['myCount']; 

 /*To calculate participant list*/ $cntuser = mysqli_query($conn,"SELECT count(ic_pengguna) as myCount from akaun_pengguna;") ; $infoBilUser = mysqli_fetch_array( $cntuser ); $cntuser = $infoBilUser['myCount']; 
 
 /*To calculate participant list*/ $count_document = mysqli_query($conn,"SELECT count(id_transaksi) as myCount from transaksi;"); $infoBilDoc = mysqli_fetch_array( $count_document ); $count_document = $infoBilDoc['myCount']; 
 
 /*To calculate participant list*/ $count_bayaran = mysqli_query($conn,"SELECT count(id_kodtransaksi) as myCount from kod_transaksi;"); $infoBilBayaran = mysqli_fetch_array( $count_bayaran ); $count_bayaran = $infoBilBayaran['myCount']; 
 ?>
  <div class="w3-row-padding w3-margin-bottom">
    <div class="w3-quarter">
      <div class="w3-container w3-red w3-padding-16">
        <div class="w3-left"><i class="fa fa-user w3-xxxlarge"></i></div>
        <div class="w3-right">
          <h3><?=$countptcp?></h3>
        </div>
        <div class="w3-clear"></div>
        <h4>Jenis Sub-Admin</h4>
      </div>
    </div>
    <div class="w3-quarter">
      <div class="w3-container w3-blue w3-padding-16">
        <div class="w3-left"><i class="fa fa-eye w3-xxxlarge"></i></div>
        <div class="w3-right">
          <h3><?=$cntuser?></h3>
        </div>
        <div class="w3-clear"></div>
        <h4>Jumlah Pengguna Aplikasi</h4>
      </div>
    </div>
    <div class="w3-quarter">
      <div class="w3-container w3-teal w3-padding-16">
        <div class="w3-left"><i class="fa fa-share-alt w3-xxxlarge"></i></div>
        <div class="w3-right">
          <h3><?=$count_document?></h3>
        </div>
        <div class="w3-clear"></div>
        <h4>Dokumen</h4>
      </div>
    </div>
    <div class="w3-quarter">
      <div class="w3-container w3-orange w3-text-white w3-padding-16">
        <div class="w3-left"><i class="fa fa-users w3-xxxlarge"></i></div>
        <div class="w3-right">
          <h3><?=$count_bayaran?></h3>
        </div>
        <div class="w3-clear"></div>
        <h4>Senarai Bayaran</h4>
      </div>
    </div>
  </div>

  <div class="w3-panel">
    <div class="w3-row-padding" style="margin:0 -16px">


   123<br>
   <?php echo md5("123");?><br>
   <?php echo hash('sha256',"123");   ?><br> 
  </div>
  </div>
  
<?php include "ui/footer.php"; ?>
    <!-- JAVASCRIPT FILES PLACED AT THE BOTTOM TO REDUCE THE LOADING TIME  -->
    <!-- CORE JQUERY  -->
    <script src="assets/js/jquery-1.10.2.js"></script>
    <!-- BOOTSTRAP SCRIPTS  -->
    <script src="assets/js/bootstrap.js"></script>
    <!-- DATATABLE SCRIPTS  -->
    <script src="assets/js/dataTables/jquery.dataTables.js"></script>
    <script src="assets/js/dataTables/dataTables.bootstrap.js"></script>
      <!-- CUSTOM SCRIPTS  -->
    <script src="assets/js/custom.js"></script>
	
<!-- End page content -->




  <!-- last skali paste preloader js punya sebelum tutup body -->
  <script src="pre/jquery.magnific-popup.min.min.js"></script>
  <script src="pre/main.js"></script>

</div>
</body>
</html>
