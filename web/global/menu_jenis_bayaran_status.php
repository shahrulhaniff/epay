<?php  
     

	$status=$_GET['status'];
	
	 $jabatan=$_GET['jbt'];   
?>

<div id='cssmenu'>
	<ul>
		<li class="<?php echo ($flagScreen=='tab_1'?'active':'') ?>"><a href="P004.php?status=aktif&jbt=<?php echo $jabatan;?>&flg=<?php echo $flag; ?>&flagScreen=tab_1">Aktif</a></li>
		<li class="<?php echo ($flagScreen=='tab_2'?'active':'') ?>"><a href="P004.php?status=tak_aktif&jbt=<?php echo $jabatan;?>&flg=<?php echo $flag; ?>&flagScreen=tab_2">Tidak Aktif</a></li>
	</ul>
</div>
