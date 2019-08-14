<?php
     
    require '../../server.php';
    require '../../credential.php';
	
	require '../PHPMailer/PHPMailerAutoload.php';
	
	include "../functions.php";
	
	$mail = new PHPMailer;

	$mail->isSMTP();                            // Set mailer to use SMTP
	$mail->Host = 'smtp.gmail.com';             // Specify main and backup SMTP servers
	$mail->SMTPAuth = true;                     // Enable SMTP authentication
	$mail->Username = EMAIL;          // SMTP username
	$mail->Password = PASS; // SMTP password
	$mail->SMTPSecure = 'tls';                  // Enable TLS encryption, `ssl` also accepted
	$mail->Port = 587;
      
		$jabatan = $_GET['jabatan'];
		$kod_pengguna = getKodJabatan($jabatan);
        // keep track post values
        $id_jenistransaksi = $_POST['id_jenistransaksi'];
        $nama = $_POST['nama'];
        $ic_pengguna = $_POST['ic_pengguna'];
        $ic_pengguna2 = hash('sha256',$_POST['ic_pengguna']);
        $email = $_POST['email'];
        $no_telefon = $_POST['no_telefon'];


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
					
					$sql4 = "INSERT INTO akaun_pengguna (ic_pengguna,kod_pengguna,pwd,status_aktif) values('$ic_pengguna','$kod_pengguna','$ic_pengguna2','yes')";
					$result4=mysqli_query($conn,$sql4);
					
					echo"<script>alert('Pendaftaran Sub-Admin Berjaya');document.location.href='../senarai_sa.php?jabatan=$jabatan';</script>";
				}
	
