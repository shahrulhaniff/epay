<?php
  include "../server.php";
 
  //try main get dulu sebab nak post vaue select where xjadi lagi
  $id = $_GET['id'];
  $idtr = $_GET['idtr'];
  $data    = array();

      

   // Attempt to query database table and retrieve data
   try {
	  
      $stmt 	= $pdo->query('SELECT * FROM transaksi WHERE ic_pengguna="'.$id.'" AND id_transaksi="'.$idtr.'" ORDER BY tarikh ASC');
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