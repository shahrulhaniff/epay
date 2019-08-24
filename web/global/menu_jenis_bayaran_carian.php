<?php  
     

	$status=$_GET['status'];
	
	 $jabatan=$_GET['jbt'];   
?>

<div id='cssmenu'>
	<ul>
		<li class="<?php echo ($flag=='tb_1'?'active':'') ?>"><a href="P004.php?status=<?php echo $status;?>&jbt=&flg=tb_1&flagScreen=<?php echo $flagScreen;?>">Papar Semua</a></li>
		<li class="<?php echo ($flag=='tb_2'?'active':'') ?>"><a href="P004_carian.php?status=<?php echo $status;?>&jbt=<?php echo $jabatan;?>&flg=tb_2&flagScreen=<?php echo $flagScreen;?>">Carian Mengikut Jabatan</a></li>
	</ul>
</div>
