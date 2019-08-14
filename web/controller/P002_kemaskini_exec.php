
<?php
    require '../../server.php';
 
   
      
	// keep track post values
	$idptj = $_POST['idptj'];
	$namaptj = $_POST['namaptj'];
	$singkatan = $_POST['singkatan'];
	 
	$sql="UPDATE kod_jabatan  set singkatan = '$singkatan', namaptj = '$namaptj'
			WHERE idptj = '$idptj'";
	$result=mysqli_query($conn,$sql);
		
		if($result){
			echo ("<script LANGUAGE='JavaScript'>
				window.alert('Kemaskini berjaya.');
				window.location.href='../P002.php';
				</script>");
				
						
		}else {
			 echo ("<script LANGUAGE='JavaScript'>
				window.alert('Kemaskini maklumat tidak berjaya.');
				window.location.href='../P002.php';
				</script>");
		}
	 
?>