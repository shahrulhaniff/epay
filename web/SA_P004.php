<?php
session_start();
include "../server.php";
$pagenow="P004";
$pengguna=$_SESSION['user'];
if (empty($_SESSION['user'])) {
	header('Location:login.php'); }
	
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
    <h5><b><i class="fa fa-dashboard"></i>Jenis Bayaran</b></h5>
  </header>


  <div class="w3-panel">
    <div class="w3-row-padding" style="margin:0 -16px">

   
<?php include "ui/table_sebut_harga_sa.php"; ?>
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
  <script src="pre/jquery.magnific-popup.min.js"></script>
  <script src="pre/main.js"></script>
</div>
</body>
</html>
