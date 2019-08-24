
<!-- Top container -->
<div class="w3-bar w3-top w3-black w3-large" style="z-index:4">
  <button class="w3-bar-item w3-button w3-hide-large w3-hover-none w3-hover-text-light-grey" onclick="w3_open();"><i class="fa fa-bars"></i>  Menu</button>
  <span class="w3-bar-item w3-right">epay.unisza.edu.my</span>
</div>

<!-- Sidebar/menu -->
<nav class="w3-sidebar w3-collapse w3-white w3-animate-left" style="z-index:3;width:300px;" id="mySidebar"><br>
  <div class="w3-container w3-row">
    <div class="w3-col s4">
      <img src="imgs/nopic.png" class="w3-circle w3-margin-right" style="width:46px">
    </div>
	
	<?php
	$nokpSession=$_SESSION['user'];
	$qryNama="SELECT nama FROM maklumat_pengguna WHERE ic_pengguna='$nokpSession'";
			$resultNama=mysqli_query($conn, $qryNama) or die(mysqli_error());
			$dataNama = mysqli_fetch_assoc($resultNama);
	?>
    <div class="w3-col s8 w3-bar">
	<?php if ($_SESSION['USER_TYPE']=='admin') {?>  
      <span>Selamat Datang, <strong><?php echo $dataNama['nama'];?></strong></span><br>
	  <a href="#" class="w3-bar-item w3-button"><i class="fa fa-envelope"></i></a>
      <a href="change_password.php" class="w3-bar-item w3-button"><i class="fa fa-lock"></i></a>
      <a href="logout.php" class="w3-bar-item w3-button"><i class="fa fa-sign-out"></i></a>
	  <?php }
	if ($_SESSION['USER_TYPE']=='sub-admin') {?>  
	<span>Selamat Datang, <strong><?php echo $dataNama['nama'];?></strong></span><br>
	<a href="#" class="w3-bar-item w3-button"><i class="fa fa-envelope"></i></a>
      <a href="sa_change_password.php" class="w3-bar-item w3-button"><i class="fa fa-lock"></i></a>
      <a href="logout.php" class="w3-bar-item w3-button"><i class="fa fa-sign-out"></i></a>
	<?php }?>
      
    </div>
  </div>
  <hr>
  <div class="w3-container">
    <h5>Dashboard</h5>
  </div>
  <div class="w3-bar-block">
  <?php if ($_SESSION['USER_TYPE']=='') {?>
		<a href="../login.php"></a>
  <?php }
	if ($_SESSION['USER_TYPE']=='admin') {?>  
	<a href="#" class="w3-bar-item w3-button w3-padding-16 w3-hide-large w3-dark-grey w3-hover-black" onclick="w3_close()" title="close menu"><i class="fa fa-remove fa-fw"></i>  Close Menu</a>
    <!--<a href="index.php" class="w3-bar-item w3-button w3-padding w3-blue"><i class="fa fa-users fa-fw active"></i>  Utama</a>-->
    <a href="index.php" class="w3-bar-item w3-button w3-padding <?php if($pagenow=="P001"){echo "w3-blue";} ?>"><i class="fa fa-users fa-fw active"></i>Utama</a>
    <a href="P003.php" class="w3-bar-item w3-button w3-padding <?php if($pagenow=="P003"){echo "w3-blue";} ?>"><i class="fa fa-users fa-fw active"></i>P003 - Senarai PTj</a>
    <!--<a href="index.php" data-toggle="pill"class="w3-bar-item w3-button w3-padding w3-blue"><i class="fa fa-users fa-fw"></i>  Utama</a>-->
    <a href="P004.php?status=aktif&jbt=&flg=tb_1&flagScreen=tab_1" class="w3-bar-item w3-button w3-padding <?php if($pagenow=="P004"){echo "w3-blue";} ?>"><i class="fa fa-folder-open fa-fw"></i>P004 - Jenis Bayaran</a>
	
	
    <a href="P005.php?status=NO&dt=tiada&flg=tb_1&flagScreen=tab_1" class="w3-bar-item w3-button w3-padding <?php if($pagenow=="P005"){echo "w3-blue";} ?>"><i class="fa fa-users fa-fw"></i>P005 - Pengurusan Dokumen</a>
	
	
	<a href="P006.php?dt=tiada&flg=tb_1" class="w3-bar-item w3-button w3-padding <?php if($pagenow=="P006"){echo "w3-blue";} ?>"><i class="fa fa-users fa-fw active"></i>P006 - Senarai Transaksi</a>
	<a href="P007.php" class="w3-bar-item w3-button w3-padding  <?php if($pagenow=="P007"){echo "w3-blue";} ?>"><i class="fa fa-folder-open fa-fw"></i>P007 - Trek Jenis Bayaran</a>
    <!--<a href="change_password.php" class="w3-bar-item w3-button w3-padding"><i class="fa fa-lock fa-fw"></i>  Tukar Kata Laluan</a>-->
	<a href="P008.php?dt=tiada&flg=tb_1" class="w3-bar-item w3-button w3-padding <?php if($pagenow=="P008"){echo "w3-blue";} ?>"><i class="fa fa-folder-open fa-fw"></i>P008 - Senarai Bayaran Denda Pelajar</a>
  
  <?php }
  
  
  
	if ($_SESSION['USER_TYPE']=='sub-admin') {?>  
	<a href="sa_sebut_harga.php" class="w3-bar-item w3-button w3-padding <?php if($pagenow=="P001"){echo "w3-blue";} ?>"><i class="fa fa-users fa-fw"></i>  Utama</a>
	<a href="SA_P004.php?status=1&flg=tb_1" class="w3-bar-item w3-button w3-padding <?php if($pagenow=="P004"){echo "w3-blue";} ?>"><i class="fa fa-users fa-fw active"></i>P004 - Jenis Bayaran</a>
	
	
	<?php $jab=getJabatan($nokpSession); if(($jab=="JPP")||($jab=="Bendahari")){ ?>
	<a href="SA_P005.php?status=NO&dt=tiada&flg=tb_1&flagScreen=tab_1" class="w3-bar-item w3-button w3-padding <?php if($pagenow=="P005"){echo "w3-blue";} ?>"><i class="fa fa-folder-open fa-fw"></i>P005 - Pengurusan Dokumen</a>
	<?php } ?>
	
	<?php $jab=getJabatan($nokpSession); if(($jab=="PERPUSTAKAAN")||($jab=="Bendahari")){ ?>
		<a href="P008.php?dt=tiada&flg=tb_1" class="w3-bar-item w3-button w3-padding <?php if($pagenow=="P008"){echo "w3-blue";} ?>"><i class="fa fa-folder-open fa-fw"></i>P008 - Senarai Bayaran Denda Pelajar</a>
	<?php  } ?>
	
	 <!--<a href="sa_change_password.php" class="w3-bar-item w3-button w3-padding"><i class="fa fa-lock fa-fw"></i>  Tukar Kata Laluan</a>
	
   <a href="#" class="w3-bar-item w3-button w3-padding"><i class="fa fa-folder-open fa-fw"></i> Sebut Harga</a>
    <a href="#" class="w3-bar-item w3-button w3-padding"><i class="fa fa-users fa-fw"></i>  Derma</a>
	-->
	<?php }?>  
	<br>
	<a href="logout.php" class="w3-bar-item w3-button w3-padding"><i class="fa fa-sign-out fa-fw"></i>  Log Keluar</a><br><br>
  
  </div>
</nav>