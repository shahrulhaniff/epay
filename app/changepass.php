<?php
include "../server.php";


   // Retrieve the posted data
   $json    =  file_get_contents('php://input');
   $obj     =  json_decode($json);



      // Add a new user
     

         // Sanitise URL supplied values
         $pwd 	  = hash('sha256',filter_var($obj->pwd, FILTER_SANITIZE_STRING, FILTER_FLAG_ENCODE_LOW));
         $user	  = filter_var($obj->user, FILTER_SANITIZE_STRING, FILTER_FLAG_ENCODE_LOW);
         $kodpengguna	  = filter_var($obj->kodpengguna, FILTER_SANITIZE_STRING, FILTER_FLAG_ENCODE_LOW);

         // Attempt to run PDO prepared statement
         try {
            $sql 	= "UPDATE akaun_pengguna SET pwd = :pwd WHERE ic_pengguna = :user AND kod_pengguna = :kodpengguna";
            $stmt 	= $pdo->prepare($sql);
            $stmt->bindParam(':pwd', $pwd, PDO::PARAM_STR);
            $stmt->bindParam(':user', $user, PDO::PARAM_STR);
            $stmt->bindParam(':kodpengguna', $kodpengguna, PDO::PARAM_STR);
            $stmt->execute();

            //echo json_encode(array('message' => 'Congratulations the record ' . $name . ' was added to the database'));
			
			
         }
         // Catch any errors in running the prepared statement
         catch(PDOException $e)
         {
            echo $e->getMessage();
         }

?>