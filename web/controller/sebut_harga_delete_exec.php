<?php
    require '../../server.php';
    $id = 0;
     
    if ( !empty($_GET['id'])) {
        // $ic_pengguna = $_REQUEST['ic_pengguna'];
        $id_kodtransaksi = $_GET['id'];
		
		// delete data
		$sql="DELETE FROM kod_transaksi WHERE id_kodtransaksi = '$id_kodtransaksi'";
			$result=mysqli_query($conn,$sql);// or die(mysqli_error())
			
			
			if($result){
				 echo ("<script LANGUAGE='JavaScript'>
					window.alert('Padam data berjaya.');
					window.location.href='../P004.php';
					</script>");
			
			}else {
				 echo ("<script LANGUAGE='JavaScript'>
					window.alert('Padam data tidak berjaya.');
					window.location.href='../P004.php';
					</script>");
			}
    }else {
				 echo ("<script LANGUAGE='JavaScript'>
					window.alert('Padam data tidak berjaya.');
					window.location.href='../P004.php';
					</script>");
			}
     
   
?>