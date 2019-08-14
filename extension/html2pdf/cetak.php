<?
session_start();
require __DIR__.'/vendor/autoload.php';

use Spipu\Html2Pdf\Html2Pdf;

$content = '
<style type="text/css">
.button {
  background-color: #1b1c57;
  border: none;
  color: white;
  padding: 15px 32px;
  text-align: center;
  text-decoration: none;
  display: inline-block;
  font-size: 30px;
  margin: 4px 2px;
  cursor: pointer;
  width: 100%;
}

p,table {
	font-size:30px;
	font-family: Arial, Helvetica, sans-serif;
}
</style>
';

//include("../../server.php");


$message		=$_GET['message'];
$transactionNo	=$_GET['transactionNo'];
$page			=$_GET['page'];
$pa				=$_GET['pa'];
$user			=$_GET['user'];
$merchantID		=$_GET['merchantID'];
$cardType		=$_GET['cardType'];

$tar=date("Y-m-d");

if($message=='Approved'){ $color='green'; } else { $color='red'; }

$content .= '
<page backtop="15mm" backbottom="15mm" backleft="20mm" backright="20mm">

<table>
<tr>
<td><img src="../../web/imgs/nopic.png" alt="logo" style="height: 26px; width: 26px;"></td><td ><font style="font-size:9px;"><i>Cetakan Resit Pembayaran Melalui Aplikasi Cashless UniSZA</i></font></td></tr></table>

<div class="button">Resit Pembayaran Cashless UniSZA</div>


<table>
<tr><td>Status</td><td>:</td>				<td><font color="'.$color.'">'.$message.'</font></td></tr>
<tr><td>No. Rujukan</td><td>:</td>			<td>'.$transactionNo.'</td></tr>
<tr><td>Tarikh Transaksi</td><td>:</td>				<td>'.$page.'</td></tr>
<tr><td>Jumlah</td><td>:</td>				<td>'.$pa.'</td></tr>
<tr><td>Dibayar oleh</td><td>:</td>				<td>'.$user.'</td></tr>
<tr><td>ID Merchant</td><td>:</td>				<td>'.$merchantID.'</td></tr>
<tr><td>Jenis Kad</td><td>:</td>				<td>'.$cardType.'</td></tr>
</table>
</page>
';

//HTML2PDF JOB START
$html2pdf = new Html2Pdf('P', 'A4', 'fr', true, 'UTF-8', 0); //$html2pdf = new Html2Pdf();
$html2pdf->writeHTML($content);

/*Komen Salah Satu Dekat out.php*/
include 'out.php';

?>