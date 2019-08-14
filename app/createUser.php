<?php
include "../server.php";


   // Retrieve the posted data
   $json    =  file_get_contents('php://input');
   $obj     =  json_decode($json);



      // Add a new user
     

         // Sanitise URL supplied values
         $usr 	  = filter_var($obj->usr, FILTER_SANITIZE_STRING, FILTER_FLAG_ENCODE_LOW);
         $nama	  = filter_var($obj->nama, FILTER_SANITIZE_STRING, FILTER_FLAG_ENCODE_LOW);
         $matr	  = filter_var($obj->matr, FILTER_SANITIZE_STRING, FILTER_FLAG_ENCODE_LOW);
         $email	  = filter_var($obj->email, FILTER_SANITIZE_STRING, FILTER_FLAG_ENCODE_LOW);
         $phone	  = filter_var($obj->phone, FILTER_SANITIZE_STRING, FILTER_FLAG_ENCODE_LOW);
         $pwd	  = hash('sha256',filter_var($obj->pwd, FILTER_SANITIZE_STRING, FILTER_FLAG_ENCODE_LOW));
         $akap	  = filter_var($obj->akap, FILTER_SANITIZE_STRING, FILTER_FLAG_ENCODE_LOW);

         // Attempt to run PDO prepared statement
         try {
            $sql 	= "INSERT INTO maklumat_pengguna(ic_pengguna, nama, email, no_telefon, matr) VALUES(:usr, :nama, :email, :phone, :matr)";
            $stmt 	= $pdo->prepare($sql);
            $stmt->bindParam(':usr', $usr, PDO::PARAM_STR);
            $stmt->bindParam(':nama', $nama, PDO::PARAM_STR);
            $stmt->bindParam(':email', $email, PDO::PARAM_STR);
            $stmt->bindParam(':phone', $phone, PDO::PARAM_STR);
            $stmt->bindParam(':matr', $matr, PDO::PARAM_STR);
            //$stmt->bindParam(':pwd', $pwd, PDO::PARAM_STR);
            $stmt->execute();

            //echo json_encode(array('message' => 'Congratulations the record ' . $usr . ' was added to the database'));
			
			if($stmt==true) {
				$sql2 	= "INSERT INTO akaun_pengguna(ic_pengguna, kod_pengguna, pwd,jenis_akaun, status_aktif) VALUES(:usr, '1',:pwd,:akap,'yes')";
				$stmt2 	= $pdo->prepare($sql2);
				$stmt2->bindParam(':usr', $usr, PDO::PARAM_STR);
				$stmt2->bindParam(':pwd', $pwd, PDO::PARAM_STR);
				$stmt2->bindParam(':akap', $akap, PDO::PARAM_STR);
				$stmt2->execute();
			}
			
         }
         // Catch any errors in running the prepared statement
         catch(PDOException $e)
         {
            echo $e->getMessage();
         }

?>