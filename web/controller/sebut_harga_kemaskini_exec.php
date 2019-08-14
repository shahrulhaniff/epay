
<?php
    require '../../server.php';
	
	date_default_timezone_set("Asia/Kuala_Lumpur");
	$date = new DateTime();
	$current_date=$date->format('Y-m-d h:i:s');
    
        // keep track post values
        $id_kodtransaksi = $_POST['id_kodtransaksi'];
        $status = $_POST['status'];
        $kod_pengguna = $_POST['kod_pengguna'];
        $no_sb = $_POST['no_sb'];
        $description = $_POST['description'];
        $tarikhbuka = $_POST['tarikhbuka'];
        $tarikhtutup = $_POST['tarikhtutup'];
        $jam = $_POST['jam']; 
		$harga = $_POST['harga'];
        $id_jenistransaksi = $_POST['id_jenistransaksi'];
        $kelas = $_POST['kelas'];
        $edit_by = $_POST['edit_by'];
        //$tarikh_edit = $_POST['tarikh_edit'];
         
        
		
		
			
			$sql="UPDATE kod_transaksi  set id_kodtransaksi = '$id_kodtransaksi', kod_pengguna = '$kod_pengguna', no_sb = '$no_sb', 
					description = '$description',tarikhbuka = '$tarikhbuka', tarikhtutup = '$tarikhtutup', jam = '$jam', harga = '$harga',
					id_jenistransaksi = '$id_jenistransaksi', kelas = '$kelas', edit_by = '$edit_by', tarikh_edit = '$current_date' 
					WHERE id_kodtransaksi = '$id_kodtransaksi'";
			$result=mysqli_query($conn,$sql);// or die(mysqli_error());
			
			
			if($result){
				if($status=='aktif'){
					echo"<script>alert('Kemaskini berjaya!');document.location.href='../P004.php?status=aktif&jbt=&flg=tb_1&flagScreen=tab_1';</script>";
					exit();
				}else if($status=='tak_aktif'){
					echo"<script>alert('Kemaskini berjaya!');document.location.href='../P004.php?status=tak_aktif&jbt=&flg=tb_1&flagScreen=tab_2';</script>";
					exit();
				}else{
					echo"<script>alert('Kemaskini berjaya!');document.location.href='../P004.php?status=&jbt=&flg=&flagScreen=';</script>";
					exit();
				}
			}else {
				
				if($status=='aktif'){
					echo ("<script LANGUAGE='JavaScript'>
					window.alert('Kemaskini sebut harga tidak berjaya.');
					window.location.href='../P004.php?status=aktif&jbt=&flg=tb_1&flagScreen=tab_1';
					</script>");
				}else if($status=='tak_aktif'){
					echo ("<script LANGUAGE='JavaScript'>
					window.alert('Kemaskini sebut harga tidak berjaya.');
					window.location.href='../P004.php?status=tak_aktif&jbt=&flg=tb_1&flagScreen=tab_2';
					</script>");
				}else{
					echo ("<script LANGUAGE='JavaScript'>
					window.alert('Kemaskini sebut harga tidak berjaya.');
					window.location.href='../P004.php?status=&jbt=&flg=&flagScreen=';
					</script>");
				}
				
				 
			}
			
        

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