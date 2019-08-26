<?php
  include "../server.php";
 
  //try main get dulu sebab nak post vaue select where xjadi lagi
  $id = $_GET['id'];
  $data    = array();

      

   // Attempt to query database table and retrieve data
   try {
	  
      $stmt 	= $pdo->query('
	  SELECT * FROM transaksi T,kod_transaksi K, kod_jenistransaksi J 
	  WHERE T.ic_pengguna="'.$id.'" 
	  AND T.statustransaction="Approved" 
	  AND K.id_kodtransaksi=T.id_kodtransaksi 
	  AND J.id_jenistransaksi=T.id_jenistransaksi
	  ORDER BY tarikh ASC');
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