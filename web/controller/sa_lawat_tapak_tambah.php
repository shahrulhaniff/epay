<?php
     
    require '../../server.php';
  
        $id_kodtransaksi = $_POST['id_kodtransaksi'];
        $ic_pengguna = $_POST['ic_pengguna'];
      
		

	
			//checking exist user
			$sql = "SELECT COUNT(ic_pengguna) AS countNokp FROM akaun_pengguna WHERE ic_pengguna='$ic_pengguna'";
			$result=mysqli_query($conn,$sql);
			$countNokp=mysqli_fetch_object($result) ->countNokp;						 
						 
			if($countNokp=='1'){
		
					//echo 'Message has been sent';
					$sql3="INSERT INTO site_visit (ic_pengguna,id_kodtransaksi) values('$ic_pengguna','$id_kodtransaksi')";
				    $result3=mysqli_query($conn,$sql3);
					
				
					echo"<script>alert('Pendaftaran pelawat tapak berjaya.');document.location.href='../sa_lawat_tapak.php';</script>";
		

		}else{
			 echo ("<script LANGUAGE='JavaScript'>
					window.alert('tambah pelawat tapak tidak berjaya. Nombor kad pengenalan/nombor syarikat tidak wujud di dalam sistem.');
					window.location.href='../sa_lawat_tapak.php';
					</script>");
		}
	
