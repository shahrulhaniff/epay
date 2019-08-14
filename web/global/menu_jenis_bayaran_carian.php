<?  
     

	$status=$_GET['status'];
	
	 $jabatan=$_GET['jbt'];   
?>

<div id='cssmenu'>
	<ul>
		<li class="<? echo ($flag=='tb_1'?'active':'') ?>"><a href="P004.php?status=<?echo $status;?>&jbt=&flg=tb_1&flagScreen=<?echo $flagScreen;?>">Papar Semua</a></li>
		<li class="<? echo ($flag=='tb_2'?'active':'') ?>"><a href="P004_carian.php?status=<?echo $status;?>&jbt=<? echo $jabatan;?>&flg=tb_2&flagScreen=<?echo $flagScreen;?>">Carian Mengikut Jabatan</a></li>
	</ul>
</div>
<? 
					
						
				
				
					?>
