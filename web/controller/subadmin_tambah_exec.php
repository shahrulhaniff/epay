<?php
     
    require '../../server.php';
    require '../../credential.php';
    $jabatan = $_GET['jabatan'];
	
	require '../PHPMailer/PHPMailerAutoload.php';
	
	$mail = new PHPMailer;

	$mail->isSMTP();                            // Set mailer to use SMTP
	$mail->Host = 'smtp.gmail.com';             // Specify main and backup SMTP servers
	$mail->SMTPAuth = true;                     // Enable SMTP authentication
	$mail->Username = EMAIL;          // SMTP username
	$mail->Password = PASS; // SMTP password
	$mail->SMTPSecure = 'tls';                  // Enable TLS encryption, `ssl` also accepted
	$mail->Port = 587; 
	
	
 
      
        // keep track post values
        $id_jenistransaksi = $_POST['id_jenistransaksi'];
        $nama = $_POST['nama'];
        $ic_pengguna = $_POST['ic_pengguna'];
        $ic_pengguna2 = hash('sha256',$_POST['ic_pengguna']);
        $email = $_POST['email'];
        $no_telefon = $_POST['no_telefon'];
     
		
	// check email sub admin adalah email unisza
	if (strpos($email, 'unisza.edu.my') !== false) {
	
			//checking exist user
			$sql = "SELECT COUNT(ic_pengguna) AS countNokp FROM akaun_pengguna WHERE ic_pengguna='$ic_pengguna'";
			$result=mysqli_query($conn,$sql);
			$countNokp=mysqli_fetch_object($result) ->countNokp;						 
						 
			if($countNokp=='0'){
			
				$sql1="SELECT MAX(KJ.jabatan) AS jabatan 
							FROM kod_jenistransaksi KT 
							LEFT JOIN kod_jenispengguna KJ ON KT.jabatan = KJ.jabatan 
							WHERE KJ.jabatan='$jabatan' AND KJ.jenis_pengguna='sub-admin'";
				$result1=mysqli_query($conn,$sql1);
				$jabatan2=mysqli_fetch_object($result1)->jabatan; 
				
				$sql2="SELECT kod_pengguna FROM kod_jenispengguna
							WHERE jabatan='$jabatan2' AND jenis_pengguna='sub-admin'";
				$result2=mysqli_query($conn,$sql2);
				$kod_pengguna=mysqli_fetch_object($result2)->kod_pengguna; 
				
				
				
				
				
?>				
<script>
window.onunload = refreshParent;
function refreshParent() {
	self.opener.location.reload();
}
</script>
<? 
			
				

				//send email
				$mail->setFrom(EMAIL);
				$mail->addAddress($email);   // Add a recipient

				$mail->isHTML(true);  // Set email format to HTML

				$bodyContent = '<h1>Anda kini boleh mengakses aplikasi Cashless dan Cashless Web</h1>';
				$bodyContent .= '<p>Berikut merupakan maklumat anda:</p>
								<p><b>Emel Pengguna</b> : '.$ic_pengguna.'</p>
								<p><b>Kata Laluan</b> :'.$ic_pengguna.'</p>
								<p></p>
								<p>Anda boleh mengubah kata laluan selepas mengakses sistem ini.</p>';

				$mail->Subject = '';
				$mail->Body    = $bodyContent;

				if(!$mail->send()) {
					echo"<script>alert('Pendaftaran Sub-Admin Tidak Berjaya');document.location.href='../senarai_sa.php?jabatan=$jabatan';</script>";
					//echo 'Message could not be sent.';
					//echo 'Mailer Error: ' . $mail->ErrorInfo;
				} 
				else {
					//echo 'Message has been sent';
					$sql3="INSERT INTO maklumat_pengguna (ic_pengguna,nama,email,no_telefon) values('$ic_pengguna','$nama','$email','$no_telefon')";
				    $result3=mysqli_query($conn,$sql3);
					
					$sql4 = "INSERT INTO akaun_pengguna (ic_pengguna,kod_pengguna,pwd,status_aktif) values('$ic_pengguna','$kod_pengguna','$ic_pengguna2','yes')";
					$result4=mysqli_query($conn,$sql4);
					
					echo"<script>alert('Pendaftaran Sub-Admin Berjaya');document.location.href='../senarai_sa.php?jabatan=$jabatan';</script>";
				}

		}else{
			 //echo ("<script LANGUAGE='JavaScript'>window.alert('tambah sub admin tidak berjaya. Nombor kad pengenalan sudah wujud di dalam sistem.');window.location.href='../senarai_sa.php';</script>");
			 echo ("<script LANGUAGE='JavaScript'>window.alert('tambah sub admin tidak berjaya. Nombor kad pengenalan sudah wujud di dalam sistem.');window.location.href='../P003A.php?IC=".$ic_pengguna."';</script>");
		}
	}else{
			 echo ("<script LANGUAGE='JavaScript'>
					window.alert('tambah sub admin tidak berjaya.Sila guna email UniSZA.');
					window.location.href='../senarai_sa.php';
					</script>");
		}	
