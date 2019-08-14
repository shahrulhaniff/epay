
<?php
    require '../../server.php';
 
    $id_jenistransaksi = null;
    if ( !empty($_GET['id_jenistransaksi'])) {
        $id_jenistransaksi = $_REQUEST['id_jenistransaksi'];
    }
     
  
        // keep track post values
        $jenistransaksi = $_POST['jenistransaksi'];
        $jabatan = $_POST['jabatan'];
       
         
		$sql="UPDATE kod_jenistransaksi set jenistransaksi = '$jenistransaksi', jabatan = '$jabatan' 
				WHERE id_jenistransaksi = '$id_jenistransaksi'";
		$result=mysqli_query($conn,$sql);
		
			
			if($result){
				echo"<script>alert('Kemaskini berjaya!');document.location.href='../sa_sebut_harga.php';</script>";
				exit();
			
			}else {
				 echo ("<script LANGUAGE='JavaScript'>
					window.alert('Kemaskini tidak berjaya.');
					window.location.href='../sa_sebut_harga.php';
					</script>");
			}
      
         
        // // update data
        // if ($valid) {
            // $pdo = Database::connect();
            // $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            // $sql = "UPDATE kod_jenistransaksi  set jenistransaksi = '$jenistransaksi', jabatan = '$jabatan' WHERE id_jenistransaksi = '$id_jenistransaksi'";
            // $q = $pdo->prepare($sql);
            // $q->execute(array($jenistransaksi,$jabatan,$id_jenistransaksi));
            // Database::disconnect();
			// echo"<script>alert('Update Success!');document.location.href='../sa_sebut_harga.php';</script>";
            // //header("Location: index.php");
        // }

    // else {
        // $pdo = Database::connect();
        // $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        // $sql = "SELECT * FROM kod_transaksi where id_kodtransaksi = ?";
        // $q = $pdo->prepare($sql);
        // $q->execute(array($id));
        // $data = $q->fetch(PDO::FETCH_ASSOC);
        // $no_sb = $data['no_sb'];
        // $description = $data['description'];
        // $tarikhbuka = $data['tarikhbuka'];
        // Database::disconnect();
    // }
?>