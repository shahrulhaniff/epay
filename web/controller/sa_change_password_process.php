
<?php
	session_start();
    require '../../server.php';
	
	$pengguna=$_SESSION['user'];
	$kod_pengguna=$_SESSION['KOD_PENGGUNA'];
 
   
        // keep track post values
		$password_lama = hash('sha256',$_POST['password_lama']);
        $password_baru= $_POST['password_baru'];
        $reenter_password_baru= $_POST['reenter_password_baru'];
        $password_baru2= hash('sha256',$_POST['password_baru']);
     
  
		$sql1 = "SELECT pwd FROM akaun_pengguna WHERE ic_pengguna='$pengguna' and kod_pengguna='$kod_pengguna'";
			$result1=mysqli_query($conn,$sql1);
			$pwdlama=mysqli_fetch_object($result1)->pwd;
		
		if ($password_lama == $pwdlama) {
				
				
			if ($reenter_password_baru == $password_baru) {
				
				
					$sql2= "UPDATE akaun_pengguna set pwd = '$password_baru2' WHERE ic_pengguna='$pengguna' and kod_pengguna='$kod_pengguna'";
					$result2=mysqli_query($conn,$sql2);
					if($result2){
					
						 echo ("<script LANGUAGE='JavaScript'>
						window.alert('Kemaskini kata laluan berjaya.');
						window.location.href='../sa_change_password.php';
						</script>");
					
					}else {
						 echo ("<script LANGUAGE='JavaScript'>
							window.alert('Kemaskini kata laluan tidak berjaya.');
							window.location.href='../sa_change_password.php';
							</script>");
					}
			}else {
					 echo ("<script LANGUAGE='JavaScript'>
						window.alert('Kata Laluan Baru tidak sama dengan Sah Kata Laluan Baru.');
						window.location.href='../sa_change_password.php';
						</script>");
				}
		}else {
				 echo ("<script LANGUAGE='JavaScript'>
					window.alert('Salah kata laluan semasa.');
					window.location.href='../sa_change_password.php';
					</script>");
			}
?>
			