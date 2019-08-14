<?
session_start();
date_default_timezone_set("Asia/Kuala_lumpur");
include("../../server.php");
require __DIR__.'/vendor/autoload.php';

use Spipu\Html2Pdf\Html2Pdf;

$content = '
<style type="text/css">
.button {
  background-color: #000000;
  border: none;
  color: white;
  padding: 5px;
  text-align: center;
  text-decoration: none;
  display: inline-block;
  font-size: 16px;
  margin: 4px 2px;
  cursor: pointer;
  width: 100%;
}

p,table {
	font-size:12px;
	font-family: Arial, Helvetica, sans-serif;
}
</style>
';

//include("../../server.php");


$idt=$_GET['idt'];
/*
$message		=$_GET['message'];
$transactionNo	=$_GET['transactionNo'];
$page			=$_GET['page'];
$pa				=$_GET['pa'];
$user			=$_GET['user'];
$merchantID		=$_GET['merchantID'];
$cardType		=$_GET['cardType']; */


$data = mysqli_query($conn,"SELECT * FROM transaksi T, maklumat_pengguna M, kod_transaksi K WHERE T.id_transaksi='".$idt."' AND M.ic_pengguna=T.ic_pengguna AND K.id_kodtransaksi=T.id_kodtransaksi");
$row = mysqli_fetch_array( $data );

$message		=$row['statustransaction'];
$transactionNo	=$row['norujukan'];
$tarikh			=$row['tarikh'];
$pa				=$row['jumlah'];
$nama			=$row['nama'];
$merchantid		=$row['merchantid'];
$cardType		=$row['jeniskad'];



	$no_sb 		 = $row['no_sb'];
	$description = $row['description'];
	$tarikh_mula = $row['tarikhbuka'];
	$tarikh_akhir= $row['tarikhtutup'];
	$kelas 		 = $row['kelas'];
	$lokasi 	 = $row['tempatlwtntapak'];
	$lokasi2 	 ="Kaunter JPP (KGB)";
	$tarikh_mula = substr($tarikh_mula,8,2).'/'.substr($tarikh_mula,5,2).'/'.substr($tarikh_mula,0,4);
	$tarikh_akhir= substr($tarikh_akhir,8,2).'/'.substr($tarikh_akhir,5,2).'/'.substr($tarikh_akhir,0,4);
	$harga 		 = $row['harga'];
	$jam 		 = $row['jam'];
	$dttaklimat  = $row['dttaklimat'];



//$tar=date("Y-m-d");

if($message=='Approved'){ $color='green'; } else { $color='red'; }

$content .= '
<page backtop="15mm" backbottom="15mm" backleft="20mm" backright="20mm">
';

$dokumen="Resit";
include "header.php";

$content .='<table style="width:100%; border-collapse: collapse;" border="0"><tr><td style="width:100%; padding: 1px;" align="center"><img src="../../web/imgs/unisza.png" alt="logo" style="height: 150px; "></td></tr></table><br>';
	
	

$content .= '
<div class="button">Resit Pembayaran Cashless UniSZA</div>

<br>
<table>
<tr><td><b>Status</b></td><td>:</td>			<td><font color="'.$color.'"><b>'.$message.'</b></font></td></tr>
<tr><td><b>No. Rujukan</b></td><td>:</td>		<td><b>'.$transactionNo.'</b></td></tr>
<tr><td><b>Tarikh Transaksi</b></td><td>:</td>	<td><b>'.$tarikh.'</b></td></tr>
<tr><td colspan="2">&nbsp;</td></tr>
<tr><td>Jumlah</td><td>:</td>					<td>RM '.$pa.'</td></tr>
<tr><td>Dibayar oleh</td><td>:</td>				<td>'.$nama.'</td></tr>
<tr><td>ID Merchant</td><td>:</td>				<td>'.$merchantid.'</td></tr>
<tr><td>Jenis Kad</td><td>:</td>				<td>'.$cardType.'</td></tr>
</table>
<br><br>
<b>Nombor dan butiran dokumen:</b>
<br><br>
<table style="width:100%; border-collapse: collapse;" border="1">
<tr>
<th style="width:100%;" align="Left"> </th>
</tr>
<tr>
<td style="width:100%; padding: 10px;"><b><u>'.$no_sb.'</u></b> <br><br>'.$description.' </td>

</tr>
</table>
<br><br><br><br>
Catatan: Resit ini dijana oleh komputer dan tiada tandatangan diperlukan. <br><br><br><br>
';

include 'footer.php';
$content .= '
</page>
';

//HTML2PDF JOB START
$html2pdf = new Html2Pdf('P', 'A4', 'fr', true, 'UTF-8', 0); //$html2pdf = new Html2Pdf();
$html2pdf->writeHTML($content);

/*Komen Salah Satu Dekat out.php*/
include 'out.php';

?>