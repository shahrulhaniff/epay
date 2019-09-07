
<?php include "ui/header.php"; ?>
<?php include "ui/menulogin.php"; ?>


<!-- Overlay effect when opening sidebar on small screens -->
<div class="w3-overlay w3-hide-large w3-animate-opacity" onclick="w3_close()" style="cursor:pointer" title="close side menu" id="myOverlay"></div>

<!-- !PAGE CONTENT! -->
<div class="w3-main" style="margin-left:300px;margin-top:43px;">

  <!-- Header -->
  <header class="w3-container" style="padding-top:22px">
    <h5><b><i class="fa fa-lock"></i> Lupa Kata Laluan</b></h5>
  </header>

  
  <div class="w3-panel">
     <div class="w3-panel">
    <div class="w3-row-padding" style="margin:0 -16px">

   
<?php include "ui/form_forgot_password.php"; ?>
  </div>
  </div>
 
<?php //include "ui/footer.php"; ?>

  <!-- End page content -->
  <!-- last skali paste preloader js punya sebelum tutup body -->
  <script src="pre/jquery.magnific-popup.min.js"></script>
  <script src="pre/main.js"></script>
</div>
</body>
</html>