<?php
  include "../server.php";
 
  $id = $_GET['id'];
  $data    = array();

   try {
	  
      $stmt = $pdo->query('SELECT id_kodtransaksi, harga FROM kod_transaksi WHERE id_kodtransaksi="'.$id.'"');
	  
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