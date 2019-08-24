<?php
  include "../server.php";
  ini_set('error_reporting', E_STRICT);
  include "../web/functions.php";
  $data = array();
   try {
	   echo "[";
      $stmt 	=$pdo->query('SELECT * FROM kod_jenistransaksi ORDER BY jabatan ASC'); //ORDER
      //while($row = $stmt->fetch(PDO::FETCH_OBJ))
	
	$count = $stmt->rowCount();
	  while($row = $stmt->fetch(PDO::FETCH_ASSOC))
      { 
  
		$count--;
		
		//semak jika lebih dari satu jenis
		$j = $row['jabatan'];
		$stmt2 	=$pdo->query('SELECT * FROM kod_jenistransaksi WHERE jabatan="'.$j.'"');
		$count2 = $stmt2->rowCount();
		$i->loop = $count2;
		
		$i->id_jenistransaksi = $row['id_jenistransaksi'];
		$i->jenistransaksi = $row['jenistransaksi'];
		
		//jabatan
		$ptj = getNamaPtj($row['jabatan']);
		$i->jabatan = $ptj;//$row['jabatan'];
		
		
		$i->created_date = $row['created_date'];
		
		
		
        //$data[] = $row;
        echo $data[] = json_encode($i);
		if($count!='0'){ echo ","; }
		
      } 
	  echo "]";
      //echo json_encode($data);
   }
   catch(PDOException $e){ echo $e->getMessage(); }

?>