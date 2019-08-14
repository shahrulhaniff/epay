
<?php
    require '../../server.php';
 
    // keep track post values
        $id_transaksi = $_GET['id_transaksi'];
        $doc_acceptby_nama = $_POST['doc_acceptby_nama'];
        $doc_acceptby = $_POST['doc_acceptby'];
        $doc_giveby = $_POST['doc_giveby'];
        $status_dokumen = $_POST['status_dokumen'];
       
         
        //checking ic yang dah didaftar dlm sistem
		// $sql1 = "SELECT IFNULL(ic_pengguna,0) AS nokp FROM maklumat_pengguna WHERE ic_pengguna='$kepada'";
		// $result1=mysqli_query($conn,$sql1);
		// $checkNokp=mysqli_fetch_object($result1)->nokp; 
			
			
		// if($checkNokp>0){
		
			
			$sql="UPDATE transaksi  set doc_giveby = '$doc_giveby', doc_acceptby = '$doc_acceptby', doc_acceptby_nama = '$doc_acceptby_nama', status_dokumen = '$status_dokumen' 
					WHERE id_transaksi = '$id_transaksi'";
			$result=mysqli_query($conn,$sql) or die(mysqli_error());
			
			
			if($result){
				echo"<script>alert('Kemaskini berjaya!');document.location.href='../P005.php?status=YES&dt=tiada&flg=tb_1&flagScreen=tab_2';</script>";
				exit();
			
			}else {
				 echo ("<script LANGUAGE='JavaScript'>
					window.alert('Kemaskini tidak berjaya.');
					window.location.href='../P005.php?status=YES&dt=tiada&flg=tb_1&flagScreen=tab_1';
					</script>");
			}
		// }else{
		 // echo ("<script LANGUAGE='JavaScript'>
				// window.alert('Nombor kad pengenalan tiada dalam sistem');
				// window.location.href='../P005.php';
				// </script>");
		// }	
        
?>