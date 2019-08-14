<?php
  include "../server.php";
 
  //try main get dulu sebab nak post vaue select where xjadi lagi
  $id = $_GET['id'];
  //$kodpengguna = $_GET['kodpengguna'];
  $data    = array();

      

   // Attempt to query database table and retrieve data
   try {
	  
      $stmt 	= $pdo->query('
	  SELECT * FROM maklumat_pengguna M, akaun_pengguna A 
	  WHERE M.ic_pengguna="'.$id.'"
	  
	  AND  A.ic_pengguna=M.ic_pengguna
	  '); //AND A.kod_pengguna="'.$kodpengguna.'"
	  
      while($row  = $stmt->fetch(PDO::FETCH_OBJ))
      {
         // Assign each row of data to associative array
         $data[] = $row;
      }

      // Return data as JSON
      echo json_encode($data);
   }
   catch(PDOException $e)
   {
      echo $e->getMessage();
   }

?>