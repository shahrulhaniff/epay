
<?php include "ui/header.php"; ?>
<?php include "ui/menulogin.php"; ?>


<!-- Overlay effect when opening sidebar on small screens -->
<div class="w3-overlay w3-hide-large w3-animate-opacity" onclick="w3_close()" style="cursor:pointer" title="close side menu" id="myOverlay">
</div>

<!-- !PAGE CONTENT! -->
<div class="w3-main" style="margin-left:300px;margin-top:43px;">

  <!-- Header -->
  <header class="w3-container" style="padding-top:22px">
    <h5><b><i class="fa fa-lock"></i> Log Masuk</b></h5>
  </header>

  
  <div class="w3-panel">
    <div class="w3-row-padding" style="margin:0 -16px">
	
      <div class="w3-container w3-quarter">
 <form action="login2.php" method="POST">
    <div class="input-group">
      <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
      <input id="email" type="text" class="form-control" name="usr" value="bendahari@unisza.edu.my" placeholder="ID Sub-Admin" autocomplete="off">
    </div>
    <br>
    <div class="input-group">
      <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
      <input id="password" type="password" class="form-control" name="pwd" value="123" placeholder="Kata Laluan" autocomplete="new-password">
    </div>
	<input type="checkbox" onclick="myFunction()">Show Password
    <br>
    <div class="input-group">
      <span class="input-group-addon"><i class="glyphicon glyphicon-log-in"></i></span>
      <input type="submit" name="loginuser" value="Log Masuk"><!-- style="width: 200px; border: 2px solid #f13f12;" -->
	  
	</div>
	<a href="forgot_password.php" >Lupa Kata Laluan</a>	
  </form>
	</div>
</div>


<script>
	function myFunction() {
	  var x = document.getElementById("password");
	  if (x.type === "password") {
		x.type = "text";
	  } else {
		x.type = "password";
	  }
	}
</script>
 
<?php //include "ui/footer.php"; ?>

  </div>
</div><!-- End page content -->


    <script src="assets/js/jquery-1.10.2.js"></script>
   <!--last skali paste preloader js punya sebelum tutup body -->
  <script src="pre/jquery.magnific-popup.min.min.js"></script>
  <script src="pre/main.js"></script>
</body>
</html>