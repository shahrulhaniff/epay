
<?php
    require '../../server.php';
 
   
      
	// keep track post values
	$ic_lama_pengguna = $_POST['ic_lama_pengguna'];
	$nama = $_POST['nama'];
	$ic_pengguna = $_POST['ic_pengguna'];
	$email = $_POST['email'];
	$no_telefon = $_POST['no_telefon'];
	 
	$sql="UPDATE maklumat_pengguna  set nama = '$nama', ic_pengguna = '$ic_pengguna', email = '$email', no_telefon = '$no_telefon' 
			WHERE ic_pengguna = '$ic_lama_pengguna'";
	$result=mysqli_query($conn,$sql);
		
		if($result){
			echo ("<script LANGUAGE='JavaScript'>
				window.alert('Kemaskini berjaya.');
				window.location.href='../senarai_sa.php';
				</script>");
				
						// //jika ic pengguna juga boleh diedit
						// $sql2="UPDATE akaun_pengguna  set ic_pengguna = '$ic_pengguna' 
								// WHERE ic_pengguna = '$ic_lama_pengguna'";
						// $result2=mysqli_query($conn,$sql2);
					
					
					// if($result2){
						// echo"<script>alert('Kemaskini berjaya!');document.location.href='../senarai_sa.php';</script>";
						// exit();
					
					// }else {
						 // echo ("<script LANGUAGE='JavaScript'>
							// window.alert('Kemaskini tidak berjaya.');
							// window.location.href='../senarai_sa.php';
							// </script>");
					// }
		}else {
			 echo ("<script LANGUAGE='JavaScript'>
				window.alert('Kemaskini sebut harga tidak berjaya.');
				window.location.href='../senarai_sa.php';
				</script>");
		}
	 
?>