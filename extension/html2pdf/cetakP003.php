<?php
session_start();
date_default_timezone_set("Asia/Kuala_lumpur");
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
	font-size:13px;
	font-family: Arial, Helvetica, sans-serif;
}

.firstLine{
    border-bottom: 1px solid black;
}
.firstLine2{
    border: 1px solid black;
}
/*
th, td {
  padding: 8px;
} */
</style>
';

include("../../server.php");
//$message= $_GET['message'];
$id= $_GET['id'];

	$data = mysqli_query($conn,"SELECT * FROM kod_jenistransaksi WHERE id_jenistransaksi='".$id."'");
	$row = mysqli_fetch_array( $data );
	$id_jenistransaksi = $row['id_jenistransaksi'];
	$jenistransaksi = $row['jenistransaksi'];
	$jabatan = $row['jabatan'];




$dokumen="Kod QR";
$content .= '<page backtop="15mm" backbottom="15mm" backleft="20mm" backright="20mm">';
include "header.php";

$content .='<table style="width:100%; border-collapse: collapse;" border="0"><tr><td style="width:100%; padding: 1px;" align="center"><img src="../../web/imgs/unisza.png" alt="logo" style="height: 150px; "></td></tr></table><br>';

$content .= '
<div class="button">Kod QR Pusat Tanggungjawab: '.$jabatan.'</div>

	
<br>
<table>
<tr><td><b>Jenis transaksi</b></td><td>:</td>	<td>'.$jenistransaksi.'</td></tr>
</table>



';

$idd = $id;
include "../qr/qr4html2pdf_size2.php";

$content .='</page>';

//HTML2PDF JOB START
$html2pdf = new Html2Pdf('P', 'A4', 'fr', true, 'UTF-8', 0); //$html2pdf = new Html2Pdf();
$html2pdf->writeHTML($content);

/*Komen Salah Satu Dekat out.php*/
include 'out2.php';

?>