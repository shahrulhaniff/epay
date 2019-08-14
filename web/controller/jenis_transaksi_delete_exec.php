<?php
    require '../../server.php';
    $id_jenistransaksi = 0;
     
    if ( !empty($_GET['id_jenistransaksi'])) {
       
        $id_jenistransaksi = $_GET['id_jenistransaksi'];
	
		
		// delete data
		$sql="DELETE FROM kod_jenistransaksi  WHERE id_jenistransaksi = '$id_jenistransaksi'";
			$result=mysqli_query($conn,$sql);
		if($result){
				echo ("<script LANGUAGE='JavaScript'>
					window.alert('Padam data berjaya.');
					window.location.href='../P003.php';
					</script>");
			
			}else {
				 echo ("<script LANGUAGE='JavaScript'>
					window.alert('Padam data tidak berjaya.');
					window.location.href='../P003.php';
					</script>");
			}
    }else {
			 echo ("<script LANGUAGE='JavaScript'>
				window.alert('Padam data tidak berjaya.');
				window.location.href='../P003.php';
				</script>");
			}
	
?>