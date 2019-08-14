<?php
   include "../server.php";
   

   // Retrieve the posted data
   $json    =  file_get_contents('php://input');
   $obj     =  json_decode($json);
   // Sanitise URL supplied values
   $usr   = filter_var($obj->usr, FILTER_SANITIZE_STRING, FILTER_FLAG_ENCODE_LOW);
   $pwd	  = hash('sha256',filter_var($obj->pwd, FILTER_SANITIZE_STRING, FILTER_FLAG_ENCODE_LOW));
//$usr = 'shahrul@unisza.edu.my';
//$pwd = '202cb962ac59075b964b07152d234b70';

   // Attempt to query database table and retrieve data
   try {
	    $auth ='Denied'; 
		//$stmt = $pdo->query('SELECT ic_pengguna, pwd FROM akaun_pengguna');
		$stmt = $pdo->query('SELECT * FROM akaun_pengguna A, maklumat_pengguna M WHERE A.ic_pengguna=M.ic_pengguna');
		
		
        while($data = $stmt->fetch(PDO::FETCH_ASSOC)){
			
			$usrdb = $data['ic_pengguna'];
			$pwddb = $data['pwd']; 
			
			$nama = $data['nama']; 
			$email = $data['email']; 
			$no_telefon = $data['no_telefon']; 
			
		$stmt2 = $pdo->query('SELECT count(ic_pengguna) AS cek_jum_akaun FROM akaun_pengguna WHERE ic_pengguna ="'.$usr.'"');
			$data2 = $stmt2->fetch(PDO::FETCH_ASSOC);
			$cek_jum_akaun = $data2['cek_jum_akaun'];
			
			if ((($usr==$usrdb)||($usr==$nama)||($usr==$email)||($usr==$no_telefon))&&($pwd==$pwddb)){
				
				if($cek_jum_akaun>1){ $auth ='Granted2'; }
				
				else { 
					$auth ='Granted';
					//Update IP and Last login --> $time=NOW();
					$ipaddress = $_SERVER['REMOTE_ADDR'];
					$qry2="UPDATE akaun_pengguna SET lastlogin= NOW() , ipaddress ='$ipaddress'
					WHERE ic_pengguna='$usrdb' LIMIT 1";
					$result2=mysqli_query($conn,$qry2);
				}
			}
			
			//else { $auth ='Denied'; }
			
				
		}
	  
      // Return data as JSON
      echo json_encode($auth);
   }
   catch(PDOException $e)
   {
      echo $e->getMessage();
   } 


?>