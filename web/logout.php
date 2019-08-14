<?php
session_start();


	/*TO CLEAR GENERATED FILE*/
	$files = glob('../extension/qr/temp/*'); // get all file names
	foreach($files as $file){ // iterate files
	  if(is_file($file))
		unlink($file); // delete file
	}

$_SESSION['myusername'] = "";
session_destroy();
echo"<script>document.location.href='login.php';</script>";
?>