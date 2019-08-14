<?php
    require '../../server.php';
       
        $idptj = $_GET['idptj'];
		
		
		// delete data
		$sql="DELETE FROM kod_jabatan  WHERE idptj = '$idptj' ";
			$result=mysqli_query($conn,$sql);
			
	if($result){
				echo ("<script LANGUAGE='JavaScript'>
					window.alert('Padam data berjaya.');
					window.location.href='../P002.php';
					</script>");
			
			}
	else {
			 echo ("<script LANGUAGE='JavaScript'>
				window.alert('Padam data tidak berjaya.');
				window.location.href='../P002.php';
				</script>");
			}
			
     
   
?>