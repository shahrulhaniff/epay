<?
require __DIR__.'/vendor/autoload.php';

use Spipu\Html2Pdf\Html2Pdf;

$content = '
<style type="text/css">

table tr td {
	height: 25;
}

.firstLine{
    border-bottom: 1px solid black;
}
.firstLine2{
    border: 1px solid black;
}

.ft {
    //font-family:  "Times New Roman", Times, serif;
    font-family:  Arial, Helvetica, sans-serif;
	font-size: 15px;
}
@media print {
	input#btnPrint {
	display: none;
	}
	button {
	display: none;
	}
	body {
		margin: 0px auto;
		min-width: 100%; 
		max-width:100%;
	}
}
</style>
';

session_start();
include("../../odbc.php"); 
$session=$_SESSION["session"];
include("../../sessions.php");
$session=updateSession($session);
$_SESSION["session"]=$session;

//get value dr link
//cek flagAll dulu
$flagAll   = $_GET['flagAll'];

if ($flagAll=='N'){
$idPek=$_GET['id'];
$LC=getLCPekerja($idPek);
$jabatan=getJabatanPekerja($idPek);
$levelMenu=getLMPekerja($idPek);
$adminEL=getLCutiELPekerja($idPek);
$jab=getJabatanPekerja($idPek);
$idTL=$_GET['idTL'];

$tar=date("Y-m-d");


$qList="SELECT * FROM tugasluar WHERE idTL='$idTL'";
$qList=mysqli_query($conn,$qList) or die(mysqli_error());
$jumList=mysqli_num_rows($qList);
$rowList=mysqli_fetch_array($qList);

$tarikhMula=$rowList['tarikhMula'];
$tarikhTamat=$rowList['tarikhTamat'];
$idPenyelia=$rowList['idPenyelia'];
$tujuan=$rowList['tujuan'];
$lokasi=$rowList['lokasi'];
$catatan=$rowList['catatan'];
$kenderaan=$rowList['kenderaan'];

	$masa1 = getformatmasa($rowList['masamula']); if ($masa1[0]!="00:00"){ $ms1a = $masa1[0]; $ms1aa = $masa1[1]; } else { $ms1a = null; $ms1aa = null;; }
	$masa2 = getformatmasa($rowList['masatamat']); if ($masa2[0]!="00:00"){ $ms2a = $masa2[0]; $ms2aa = $masa2[1]; } else { $ms2a = null; $ms2aa = null;; }

//function di session.php
$kenderaan=getJenisKenderaan($kenderaan);
$tujuan=getTujuan($tujuan);
//ni untuk display data lama yang tak guna kod lookup table kod_kenderaan_p002
if (($kenderaan==null)||($kenderaan=="")) { $kenderaan=$rowList['kenderaan']; }
if (($tujuan==null)||($tujuan=="")) { $tujuan=$rowList['tujuan']; }

	$tarikhMula2=$rowList2['tarikhMula'];
	$tarikhMula = substr($tarikhMula,8,2).'/'.substr($tarikhMula,5,2).'/'.substr($tarikhMula,0,4);
	$tarikhTamat = substr($tarikhTamat,8,2).'/'.substr($tarikhTamat,5,2).'/'.substr($tarikhTamat,0,4);
	if ($tarikhMula==$tarikhTamat) { $tarikhTamat=null; $hingga=null; $ms2a=null; $ms2aa=null; }
	else {  /* $tarikhMula = substr($tarikhMula2,8,2); */ $hingga="hingga"; }

$qsv="SELECT nama,jawatan,idJabatan FROM pekerja WHERE idPekerja='$idPenyelia'";
$qsv=mysqli_query($conn,$qsv) or die(mysqli_error());
$rowsv=mysqli_fetch_array($qsv);
$svname=$rowsv['nama'];
$jsv=$rowsv['jawatan'];
$jab=$rowsv['idJabatan'];


$qj="SELECT jawatan,nama FROM pekerja WHERE idPekerja='$idPek'";
$qj=mysqli_query($conn,$qj) or die(mysqli_error());
$rj=mysqli_fetch_array($qj);
$jawatan=$rj['jawatan'];
$namapenuh=$rj['nama'];
}
$trkmohon=date('d-m-Y');
if ($flagAll=='Y') {

if(isset($_GET['invite'])){
  if (is_array($_GET['invite'])) {
    foreach($_GET['invite'] as $value){
		
	$idTL=$value;
	
$idPek=$_GET['id'];
$LC=getLCPekerja($idPek);
$jabatan=getJabatanPekerja($idPek);
$levelMenu=getLMPekerja($idPek);
$adminEL=getLCutiELPekerja($idPek);
$jab=getJabatanPekerja($idPek);

$tar=date("Y-m-d");


$qList="SELECT * FROM tugasluar WHERE idTL='$idTL'";
$qList=mysqli_query($conn,$qList) or die(mysqli_error());
$jumList=mysqli_num_rows($qList);
$rowList=mysqli_fetch_array($qList);

//$tarikhMula=$rowList['tarikhMula'];
//$tarikhTamat=$rowList['tarikhTamat'];
//$tujuan=$rowList['tujuan'];
//$lokasi=$rowList['lokasi'];
//$catatan=$rowList['catatan'];
//$kenderaan=$rowList['kenderaan'];
$idPenyelia=$rowList['idPenyelia'];

//$idPek=$_GET['id'];
$idPek=$rowList['idPekerja'];
$LC=getLCPekerja($idPek);
$jabatan=getJabatanPekerja($idPek);
$levelMenu=getLMPekerja($idPek);
$adminEL=getLCutiELPekerja($idPek);
$jab=getJabatanPekerja($idPek);

$qsv="SELECT nama,jawatan,idJabatan FROM pekerja WHERE idPekerja='$idPenyelia'";
$qsv=mysqli_query($conn,$qsv) or die(mysqli_error());
$rowsv=mysqli_fetch_array($qsv);
$svname=$rowsv['nama'];
$jsv=$rowsv['jawatan'];
$jab=$rowsv['idJabatan'];


$qj="SELECT jawatan,nama FROM pekerja WHERE idPekerja='$idPek'";
$qj=mysqli_query($conn,$qj) or die(mysqli_error());
$rj=mysqli_fetch_array($qj);
$jawatan=$rj['jawatan'];
$namapenuh=$rj['nama'];


}
}
else {
    $value = $_GET['invite'];
    //echo $value;
	$idTL=$value;
  }
}

}



$content .= '
<page backtop="15mm" backbottom="15mm" backleft="20mm" backright="20mm">

<div class="ft">
<table>
<tr>
<td><img src="../../images/pahang.png" alt="logo pahang" style="height: 26px; width: 26px;"></td><td ><font style="font-size:9px;"><i>Cetakan Sistem Ehadir P002 Pejabat Setiausaha Kerajaan Pahang</i></font></td></tr></table>


<table style="width:100%;" border="0"><tr><td align="center" style="width:100%;"><font style="font-size:16px;"><b>PERMOHONAN BERTUGAS DI LUAR PEJABAT</b></font></td></tr></table>

<br><br>
<table style="width:100%;" border="0">
<tr><td style="width:40%;"> NAMA PEGAWAI YANG MEMOHON </td><td style="width:2%;">:</td><td style="width:58%;">  '.$namapenuh.' </td></tr>
<tr><td style="width:40%;"> JAWATAN                   </td><td style="width:2%;">:</td><td style="width:58%;">  '.$jawatan.' </td></tr>
<tr><td style="width:40%;"> BAHAGIAN / UNIT                      </td><td style="width:2%;">:</td><td style="width:58%;">  '.strtoupper(getNamaJabatan($jab)).' </td></tr>
<tr><td colspan="3">  &nbsp;  </td></tr>
</table>
';

if ($flagAll=='N'){
	$content .= '
<table style="width:100%; border-collapse: collapse;" border="1">
<tr>
<td style="width:27%;" align="center"><strong>Tarikh dan masa</strong></td>
<td style="width:25%;" align="center"><strong>Tempat Bertugas</strong></td>
<td style="width:28%;" align="center"><strong>Keterangan Tugas</strong></td>
<td style="width:20%;" align="center"><strong>Jenis Kenderaan</strong></td>
</tr>
<tr>
<td style="width:27%;" align="center">'.$tarikhMula.' '.$ms1a.''.$ms1aa.' '.$hingga.'<br>'.$tarikhTamat.' '.$ms2a.''.$ms2aa.'</td>
<td style="width:25%;" align="center">'. $lokasi.'</td>
<td style="width:28%;">'. $tujuan.'<br>'.ucfirst($catatan).'</td>
<td style="width:20%;" align="center">'. ucfirst($kenderaan).'</td>
</tr>
</table>
';
}

$count=0;
if ($flagAll=='Y'){
	
	$content .= '<table style="width:100%; border-collapse: collapse;" border="1">
<tr>
<td style="width:27%;" align="center"><strong>Tarikh dan Masa</strong></td>
<td style="width:25%;" align="center"><strong>Tempat Bertugas</strong></td>
<td style="width:28%;" align="center"><strong>Keterangan Tugas</strong></td>
<td style="width:20%;" align="center"><strong>Jenis Kenderaan</strong></td>
</tr>
</table>
';
	
	if(isset($_GET['invite'])){
  if (is_array($_GET['invite'])) {
    foreach($_GET['invite'] as $value){
	$count++;
	$idTL=$value;
	$qList2="SELECT * FROM tugasluar WHERE idTL='$idTL'";
	$qList2=mysqli_query($conn,$qList2) or die(mysqli_error());
	$jumList2=mysqli_num_rows($qList2);
	$rowList2=mysqli_fetch_array($qList2);

	$tarikhMula=$rowList2['tarikhMula'];
	$tarikhTamat=$rowList2['tarikhTamat'];
	$tujuan=$rowList2['tujuan'];
	$lokasi=$rowList2['lokasi'];
	$catatan=$rowList2['catatan'];
	
	$masa1 = getformatmasa($rowList2['masamula']); if ($masa1[0]!="00:00"){ $ms1a = $masa1[0]; $ms1aa = $masa1[1]; } else { $ms1a = null; $ms1aa = null;; }
	$masa2 = getformatmasa($rowList2['masatamat']); if ($masa2[0]!="00:00"){ $ms2a = $masa2[0]; $ms2aa = $masa2[1]; } else { $ms2a = null; $ms2aa = null;; }
	
	$kenderaan=$rowList2['kenderaan'];
	
//function di session.php
$kenderaan=getJenisKenderaan($kenderaan);
$tujuan=getTujuan($tujuan);
//ni untuk display data lama yang tak guna kod lookup table kod_kenderaan_p002
if (($kenderaan==null)||($kenderaan=="")) { $kenderaan=$rowList2['kenderaan']; }
if (($tujuan==null)||($tujuan=="")) { $tujuan=$rowList2['tujuan']; }


	$tarikhMula2=$rowList2['tarikhMula'];
	$tarikhMula = substr($tarikhMula,8,2).'/'.substr($tarikhMula,5,2).'/'.substr($tarikhMula,0,4);
	$tarikhTamat = substr($tarikhTamat,8,2).'/'.substr($tarikhTamat,5,2).'/'.substr($tarikhTamat,0,4);
	if ($tarikhMula==$tarikhTamat) { $tarikhTamat=null; $hingga=null;  $ms2a=null; $ms2aa=null;  }
	else { /* $tarikhMula = substr($tarikhMula2,8,2); */ $hingga="hingga"; }
	
	$content .= '
<table style="width:100%; border-collapse: collapse;" border="1">
<tr>
<td style="width:27%;" align="center">'.$tarikhMula.' '.$ms1a.''.$ms1aa.' '.$hingga.'<br>'.$tarikhTamat.' '.$ms2a.''.$ms2aa.'</td>
<td style="width:25%;" align="center">'. $lokasi.'</td>
<td style="width:28%;">'. $tujuan.'<br>'.ucfirst($catatan).'</td>
<td style="width:20%;" align="center">'. ucfirst($kenderaan).'</td>
</tr>
</table>
';
}
}
else {
    $value = $_GET['invite'];
    //echo $value;
	$idTL=$value;
  }
}

}


//ni kalau nak buat page break, buat la condition macam mana pun
 //temporary count
if (($flagAll=='Y')&&($count==5)){
 $content .= '<div style="page-break-after:always"></div>';
 $content .= ' <table><tr><td><img src="../../images/pahang.png" alt="logo pahang" style="height: 26px; width: 26px;"></td><td ><font style="font-size:9px;"><i>Cetakan Sistem Ehadir P002 Pejabat Setiausaha Kerajaan Pahang</i></font></td></tr></table>';
}
//end page break with condition

$content .= '
&nbsp; <br><br>
<table style="width:100%;" border="0">

<tr><td style="width:35%;">  </td><td style="width:20%;">Tandatangan</td><td style="width:2%;">:</td><td style="width:43%;"  align="center"> ............................................................ <br>Pegawai yang memohon:<br> ('.$namapenuh.') </td></tr>
<tr valign="bottom"><td style="width:35%;">  </td><td style="width:20%;">Tarikh</td><td style="width:2%;">:</td><td style="width:43%;"> ............................................................ </td></tr>

<tr><td colspan="4" style="width:100%;" align="left"><br><br> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Saya menyokong / tidak menyokong permohonan ini.  <br><br> &nbsp; </td></tr>
<tr><td style="width:35%;">  </td><td style="width:20%;">Tandatangan</td><td style="width:2%;">:</td><td style="width:43%;"  align="center"> ............................................................ <br>(Ketua Unit) </td></tr>
<tr valign="bottom"><td style="width:35%;">  </td><td style="width:20%;">Tarikh</td><td style="width:2%;">:</td><td style="width:43%;"> ............................................................ </td></tr>

<tr><td colspan="4" style="width:100%;" align="left"><br><br> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Diluluskan / ditolak  <br> &nbsp;</td></tr>
<tr><td style="width:35%;">  </td><td style="width:20%;">Tandatangan</td><td style="width:2%;">:</td><td style="width:43%;"  align="center"> ............................................................ <br>Pegawai yang meluluskan:<br> ('.$svname.') </td></tr>
<tr valign="bottom"><td style="width:35%;">  </td><td style="width:20%;">Tarikh</td><td style="width:2%;">:</td><td style="width:43%;"> ............................................................ </td></tr>

</table>


</div>
</page>';


//HTML2PDF JOB START
$html2pdf = new Html2Pdf('P', 'A4', 'fr', true, 'UTF-8', 0); //$html2pdf = new Html2Pdf();
$html2pdf->writeHTML($content);

/*Komen Salah Satu Dekat out.php*/
include 'out.php';

?>