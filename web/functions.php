<?php

//----------------------------------------------------------------------------------
// get Jabatan from idPekerja.
//----------------------------------------------------------------------------------
function getJabatan($idPekerja){
	include "../global.php";
	$s="SELECT jabatan from kod_jenispengguna K, akaun_pengguna A
		WHERE A.ic_pengguna='$idPekerja'
		AND K.kod_pengguna=A.kod_pengguna
		";
	$r=mysqli_query($conn,$s);
	$row=mysqli_fetch_row($r);

	if ($row[0]!=""){
		return $row[0];
	}
	else{
		return null;
	}
}

//----------------------------------------------------------------------------------
// [type1]get Jabatan from id_kodtransaksi.
//----------------------------------------------------------------------------------
function getJabatanByIDK($id_kodtransaksi){
	include "../../global.php"; //2 global sbb guna dalam extension
	$s="SELECT jabatan from kod_jenispengguna K, kod_transaksi A
		WHERE A.id_kodtransaksi='$id_kodtransaksi'
		AND K.kod_pengguna=A.kod_pengguna
		";
	$r=mysqli_query($conn, $s);
	$row=mysqli_fetch_row($r);

	if ($row[0]!=""){
		return $row[0];
	}
	else{
		return null;
	}
}
//----------------------------------------------------------------------------------
// [type2] get Jabatan from id_jenistransaksi.
//----------------------------------------------------------------------------------
function getJabatanByIDJT($id_jenistransaksi){
	include "../global.php";
	$s="SELECT jabatan from kod_jenistransaksi
		WHERE id_jenistransaksi='$id_jenistransaksi'
		";
	$r=mysqli_query($conn, $s);
	$row=mysqli_fetch_row($r);

	if ($row[0]!=""){
		return $row[0];
	}
	else{
		return null;
	}
}

//----------------------------------------------------------------------------------
// get id Jabatan from nama jabatan.
//----------------------------------------------------------------------------------
function getKodJabatan($jabatan){
	include "../global.php";
	$s="SELECT kod_pengguna from kod_jenispengguna 
		WHERE jabatan='$jabatan'
		";
	$r=mysqli_query($conn,$s);
	$row=mysqli_fetch_row($r);

	if ($row[0]!=""){
		return $row[0];
	}
	else{
		return null;
	}
}

//----------------------------------------------------------------------------------
// get nama from idPekerja.
//----------------------------------------------------------------------------------
function getNama($idPekerja){
	include "../global.php";
	$s="SELECT nama from maklumat_pengguna 
		WHERE ic_pengguna='$idPekerja'
		";
	$r=mysqli_query($conn,$s);
	$row=mysqli_fetch_row($r);

	if ($row[0]!=""){
		return $row[0];
	}
	else{
		return null;
	}
}
//----------------------------------------------------------------------------------
// get EMEL from idPekerja.
//----------------------------------------------------------------------------------
function getEmel($idPekerja){
	include "../global.php";
	$s="SELECT email from maklumat_pengguna 
		WHERE ic_pengguna='$idPekerja'
		";
	$r=mysqli_query($conn,$s);
	$row=mysqli_fetch_row($r);

	if ($row[0]!=""){
		return $row[0];
	}
	else{
		return null;
	}
}

//----------------------------------------------------------------------------------
// get notelefon from idPekerja.
//----------------------------------------------------------------------------------
function getPhone($idPekerja){
	include "../global.php";
	$s="SELECT no_telefon from maklumat_pengguna 
		WHERE ic_pengguna='$idPekerja'
		";
	$r=mysqli_query($conn,$s);
	$row=mysqli_fetch_row($r);

	if ($row[0]!=""){
		return $row[0];
	}
	else{
		return null;
	}
}


//----------------------------------------------------------------------------------
// array Dapatkan jenis transaksi untuk menu P003
//----------------------------------------------------------------------------------
function getJenisTransaksi($jabatan){
include "../global.php";
$qK="SELECT * FROM kod_jenistransaksi";
$resK=mysqli_query($conn,$qK) or die(mysqli_error());
while($fetchK=mysqli_fetch_array($resK)){
	if ($jabatan==$fetchK['jabatan']){ $jenis=$fetchK['jenistransaksi']; }
}mysqli_free_result($resK);

return $jenis;
}


//----------------------------------------------------------------------------------
// P003 : Dapatkan nama jabatan by kod jabatan $jaba
//----------------------------------------------------------------------------------
function getNamaPtj($jaba){
include "../global.php"; 
$nama="";
$qry2="SELECT * FROM kod_jabatan";
$res2=mysqli_query($conn, $qry2) or die(mysqli_error());
while($fetch2=mysqli_fetch_array($res2)){
	if ($jaba==$fetch2['idptj']){ $nama=$fetch2['namaptj']; }
}mysqli_free_result($res2);


return $nama;
}

//----------------------------------------------------------------------------------
// P003 : Dapatkan nama jenis by kod jenis $rekod
//----------------------------------------------------------------------------------
function getNamaJenisT($rekod){
$nama="";

if ($rekod=='SBT'){ $nama="Sebut Harga/Tender"; }
if ($rekod=='SYD'){ $nama="Seminar/Yuran/Denda"; }
if ($rekod=='D'){ $nama="Derma"; }
if ($rekod=='J'){ $nama="Jualan"; }


return $nama;
}




?>