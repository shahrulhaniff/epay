<?php
session_start();
include "../server.php";
$pagenow="P003";
if (empty($_SESSION['user'])) { header('Location:login.php'); }
include "ui/header.php"; 
include "ui/menu.php";

//unset($_SESSION['id']);
$id = $_SESSION['id'];
$s_jab = $_SESSION['jabatan'];
?>

<style>
.formshahrul{display:block;height:32px;padding:6px 12px;font-size:16px;line-height:1.42857143;color:#0d0040;background-color:#fff;background-image:none;border:1px solid #ccc;border-radius:4px;-webkit-box-shadow:inset 0 1px 1px rgba(0,0,0,.075);box-shadow:inset 0 1px 1px rgba(0,0,0,.075);-webkit-transition:border-color ease-in-out .15s,-webkit-box-shadow ease-in-out .15s;-o-transition:border-color ease-in-out .15s,box-shadow ease-in-out .15s;transition:border-color ease-in-out .15s,box-shadow ease-in-out .15s}
 
.formshahrul:focus{border-color:#ff0000;outline:0;-webkit-box-shadow:inset 0 1px 1px rgba(0,0,0,.075),0 0 8px rgba(102,175,233,.6);box-shadow:inset 0 1px 1px rgba(0,0,0,.075),0 0 8px rgba(102,175,233,.6)}

</style>

<!-- Overlay effect when opening sidebar on small screens -->
<div class="w3-overlay w3-hide-large w3-animate-opacity" onclick="w3_close()" style="cursor:pointer" title="close side menu" id="myOverlay"></div>

<!-- !PAGE CONTENT! -->
<div class="w3-main" style="margin-left:300px;margin-top:43px;">

  <!-- Header -->
  <header class="w3-container" style="padding-top:22px">
    <h5>
	<a href="index.php"><i class="fa fa-dashboard"></i> Utama</a> /
	<a href="P003.php"><i class="fa fa-dashboard"></i>Senarai Pusat Tanggungjawab</a> / 
	<a href="P003.php"><i class="fa fa-laptop"></i>Senarai Sub-Admin</a> /
	<b><i class="fa fa-laptop"></i>Tambah Sub-Admin</b>
	</h5>
  </header>


  <div class="w3-panel">
    <div class="w3-row-padding" style="margin:0 -16px">




<div class="w3-twothird">
	  <label><font color="red">
	  <?php
		$IC = $_GET['IC'];
		$JAB = getJabatan($IC);
		$NAMA = getNama($IC);
		$EMEL = getEmel($IC);
		$PHONE = getPhone($IC);
		 if($JAB==NULL){ echo "Kad pengenalan berdaftar sebagai Pengguna";}
		 else { echo "Kad pengenalan telah berdaftar sebagai ".$JAB;}
	  ?>
	  </font></label>
	  
	  
	  
	  <?php if($s_jab!=$JAB){?>
	  <label><font color="red">
	  <br>*Sila sahkan maklumat dibawah jika ingin mendaftar sebagai sub-Admin <?=$s_jab?>.
	  </font></label>
      <form method="post" action="../web/controller/P003A_exec.php?jabatan=<?=$s_jab?>">
                         <div class="form-group" align="left">
                            <input type="HIDDEN" name="id_jenistransaksi" id="id_jenistransaksi" class="formshahrul" value="<? echo $id;?>" readonly />
						 </div>
							 
							<div class="form-group">
								<label for="comment">Nama<font color="red">**</font></label>
								<input type="text" class="formshahrul" name="nama" id="nama" value="<?=$NAMA?>" size="50" readonly>
							</div> 
							
							<div class="form-group">
								<label for="comment">Nombor Kad Pengenalan<font color="red">**</font></label>
								<input type="text" class="formshahrul" name="ic_pengguna" id="ic_pengguna" value="<?=$IC?>" size="20" readonly>
							</div> 
							
							<div class="form-group">
								<label for="comment">Emel<font color="red">**</font></label>
								<input type="text" class="formshahrul" name="email" id="email" value="<?=$EMEL?>" size="20" readonly>
							</div> 
							
							<div class="form-group">
								<label for="comment">Nombor Telefon<font color="red">**</font></label>
								<input type="text" class="formshahrul" name="no_telefon" value="<?=$PHONE?>" id="no_telefon" size="20" readonly>
							</div>		
									
                  
                                   <button type="submit" class="btn btn-primary" >Lantik Sebagai sub-Admin <?=$s_jab?></button>
								   <a href="senarai_sa.php" class="btn btn-danger">Batal</a>
					</form>
	  <?php } /*close if dah daftar subadmin dalam jabatan sama*/ 
	  else { ?>
	  <div class="form-group" align="left">
                            <input type="HIDDEN" name="id_jenistransaksi" id="id_jenistransaksi" class="formshahrul" value="<?php echo $id;?>" readonly />
						 </div>
							 
							<div class="form-group">
								<label for="comment">Nama<font color="red">**</font></label>
								<input type="text" class="formshahrul" name="nama" id="nama" value="<?=$NAMA?>" size="20" readonly>
							</div> 
							
							<div class="form-group">
								<label for="comment">Nombor Kad Pengenalan<font color="red">**</font></label>
								<input type="text" class="formshahrul" name="ic_pengguna" id="ic_pengguna" value="<?=$IC?>" size="20" readonly>
							</div> 
							
							<div class="form-group">
								<label for="comment">Emel<font color="red">**</font></label>
								<input type="text" class="formshahrul" name="email" id="email" value="<?=$EMEL?>" size="20" readonly>
							</div> 
							
							<div class="form-group">
								<label for="comment">Nombor Telefon<font color="red">**</font></label>
								<input type="text" class="formshahrul" name="no_telefon" value="<?=$PHONE?>" id="no_telefon" size="20" readonly>
							</div>
	  <a href="senarai_sa.php" class="btn btn-danger">Kembali</a>
	  <?php } ?>
	  
</div>
   
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
