<?php
session_start();
include "../server.php";

$usr = $_POST['usr'];
//$pwd = md5($_POST['pwd']);
$pwd = hash('sha256',$_POST['pwd']);

$qry="
SELECT * FROM akaun_pengguna A, maklumat_pengguna M 
WHERE (M.ic_pengguna='$usr' OR M.email='$usr' OR M.nama='$usr' OR M.no_telefon='$usr')
AND A.ic_pengguna=M.ic_pengguna
AND A.pwd='$pwd'
AND A.kod_pengguna!='1'
"; 

// $qry="SELECT * FROM akaun_pengguna WHERE ic_pengguna='$usr' and pwd='$pwd' AND kod_pengguna!='1'"; 

$result=mysqli_query( $conn, $qry);
	
if($result) {
		    if(mysqli_num_rows($result) > 0) {
				
					//Login Successful
					session_regenerate_id();
					$row = mysqli_fetch_assoc($result);
					
					//session
					$_SESSION['user'] = $row['ic_pengguna'];
					
					
					//tetapkan position utk akses sistem
					$position = $row['kod_pengguna'];
					$_SESSION['KOD_PENGGUNA'] = $row['kod_pengguna'];
					
					
			$qry2="SELECT jenis_pengguna,jabatan FROM kod_jenispengguna WHERE kod_pengguna='$position'";
			$result2=mysqli_query( $conn, $qry2);// or die(mysqli_error());
			$row2 = mysqli_fetch_assoc($result2);
				$_SESSION['USER_TYPE'] = $row2['jenis_pengguna'];
				$_SESSION['JABATAN'] = $row2['jabatan'];
				
					//Go to home page
					 if ($_SESSION['USER_TYPE'] == 'user') {
						header("location: logout.php");//echo $position;
						//header("location: SA_P004.php");
					 }
					
					else if ($_SESSION['USER_TYPE'] == 'admin'){
						header("location: index.php");
					}
					
					else if ($_SESSION['USER_TYPE'] == 'sub-admin'){
						header("location: sa_sebut_harga.php");
					}
					
					else{ echo"<script>alert('Access Denied!');document.location.href='login.php';</script>"; }
					
					exit();
					}
			
			else
			{
				echo"<script>alert('Access Denied!');document.location.href='login.php';</script>";
			}
	}
	
	else {
		die("Query failed");
	}
?> 
