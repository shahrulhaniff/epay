<?php
    require '../../server.php';
    $ic_pengguna = 0;
     
    if ( !empty($_GET['ic_pengguna'])) {
       
        $ic_pengguna = $_GET['ic_pengguna'];
		
		
		// delete data
		$sql="DELETE FROM site_visit WHERE ic_pengguna = '$ic_pengguna'";
			$result=mysqli_query($conn,$sql);
	
			if($result){
				echo ("<script LANGUAGE='JavaScript'>
					window.alert('Padam data berjaya.');
					window.location.href='../sa_lawat_tapak.php';
					</script>");
			
			}else {
				 echo ("<script LANGUAGE='JavaScript'>
					window.alert('Padam data tidak berjaya.');
					window.location.href='../sa_lawat_tapak.php';
					</script>");
			}
   
		
    }else {
			 echo ("<script LANGUAGE='JavaScript'>
				window.alert('Padam data tidak berjaya.');
				window.location.href='../sa_lawat_tapak.php';
				</script>");
			}
     
   
?>