<?php
session_start();
date_default_timezone_set("Asia/Kuala_lumpur");
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
	font-size:12px;
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
include("../../web/functions.php");



//$message= $_GET['message'];
$dokumen="Dokumen";
$stop = "y";
$content .= '<page backtop="15mm" backbottom="15mm" backleft="20mm" backright="20mm">';
include "header.php";
$count=true;

 if(isset($_GET['idk'])){
  if (is_array($_GET['idk'])) {
	foreach($_GET['idk'] as $idkv){
		
		
	//PERBEZAAN CETAK BY JABATAN DISINI
	$jab = getJabatanByIDK($idkv);
	//$content .= 'TEST OUTPUT : '.$jab.'';
	
	$sizee = sizeof($_GET['idk']);
	if ($sizee == '1'){ $stop = "n"; }
	
	$data = mysqli_query($conn,"SELECT * FROM kod_transaksi WHERE id_kodtransaksi='".$idkv."'");
	$row = mysqli_fetch_array( $data );
	$no_sb = $row['no_sb'];
	$description = $row['description'];
	$tarikh_mula = $row['tarikhbuka'];
	$tarikh_akhir= $row['tarikhtutup'];
	$kelas 		 = $row['kelas'];


$tar=date("Y-m-d");

$tarikh_mula  = substr($tarikh_mula,8,2).'/'.substr($tarikh_mula,5,2).'/'.substr($tarikh_mula,0,4);
$tarikh_akhir = substr($tarikh_akhir,8,2).'/'.substr($tarikh_akhir,5,2).'/'.substr($tarikh_akhir,0,4);
$harga 		  = $row['harga'];
$lokasi 	  = "Kaunter JPP (KGB)";
$jam 		  = "12:00 Tengahari";


$idd = $no_sb;
include "../qr/qr4html2pdf.php";

if($jab == "JPP"){ //open if
$content .= '

<p style="text-align: justify; font-size:12px;">Tawaran adalah dipelawa daripada <b>Kontraktor Bumiputera</b> yang mempunyai Sijil Perolehan Kerja Kerajaan berdaftar dengan Lembaga Pembangunan Industri Pembinaan Malaysia (LPIPM (CIDB) dalam Gred Kategori & pengkhususan yang berkaitan dan Kementerian Kewangan dan yang masih dibenarkan membuat tawaran buat masa ini bagi kerja berikut:</p>

<table style="width:100%; border-collapse: collapse;" border="1">
<tr>
<th style="width:30%;" align="center"> NOMBOR DAN BUTIRAN TAWARAN 								 </th>
<th style="width:20%;" align="center">KELAS, KEPALA, SUB-KEPALA									 </th>
<th style="width:25%;" align="center">TARIKH, MASA TAKLIMAT & TEMPAT LAWATAN TAPAK 				 </th>
<th style="width:25%; padding: 8px;" align="center">TARIKH, TEMPAT, HARGA JUALAN DOKUMEN TAWARAN & TARIKH TUTUP</th>
</tr>

<tr>
<td style="width:30%; padding: 10px;"><b><u>'.$no_sb.'</u></b> <br><br>'.$description.' </td>
<td style="width:20%;" align="center">'.$kelas.'</td>
<td style="width:25%;" align="center">3</td>
<td style="width:25%;" align="center">
	<table>
	
	<tr><td class="firstLine"><b>Tarikh:</b><br>'.$tarikh_mula.' - '.$tarikh_akhir.'<br><br></td></tr>
	
	<tr><td class="firstLine"><b>Harga Dokumen:</b><br>RM'.$harga.'<br><br></td></tr>
	
	<tr><td class="firstLine"><b>Tempat:</b><br>'.$lokasi.'<br><br></td></tr>
	<tr><td><b>Tarikh Tutup:</b><br>'.$tarikh_akhir.'<br><br>'.$jam.'</td></tr>
	</table>
</td>
</tr>

</table>



<table style="width:100%; border-collapse: collapse;" border="0"><tr><td style="width:100%; padding: 0px;">

	<p style="text-align: justify; font-size:12px;">
	2.Lawatan tapak adalah diwajibkan. Hanya penama di dalam Sijil Perolehan Kerja Kerajaan berdaftar dengan Lembaga Pembangunan Industri Pembinaan Malaysia (LPIPM (CIDB)) dalam Gred Kategori & pengkhususan yang berkaitan dan Kementerian Kewangan dengan membawa salinan sijil ASAL dibenarkan menghadiri lawatan tapak dan membeli/mengambil Dokumen Sebutharga
	<br><br>
	3.Dokumen Sebut Harga boleh diperolehi pada waktu pejabat di <b>Kaunter Jabatan Pengurusan Pembangunan, Universiti Sultan Zainal Abidin (UniSZA), Kampus Gong Badak, 21300 Kuala Nerus</b> dengan menunjukkan Sijil Pendaftaran(CIDB), Sijil Perolehan Kerja Kerajaan berdaftar dengan Lembaga Pembangunan Industri Pembinaan Malaysia (LPIPM(CIDB)) dan SIJIL TARAF BUMIPUTERA. Satu salinan (fotostat) sijil-sijil berkenaan hendaklah diserahkan semasa mendapatkan Dokumen Sebut Harga. Bayaran Pembelian dokumen sebut harga dibuat dalam bentuk <b>kiriman wang, wang pos</b> ataupun <b>bank draf</b> atas nama <b>"Bendahari Universiti Sultan Zainal Abidin" Slip pembayaran perlu dikemukakan semasa mengambil dokumen sebutharga. Wang ini tidak akan dikembalikan.</b>
	<br><br>
	4.UniSZA tidak tertakluk menerima mana-mana tawaran terendah atau sebarang tawaran. UniSZA berhak untuk membatalkan atau menunda atau menggantung tawaran di atas secara keseluruhan atau sebahagian sebelum atau selepas tarikh dan masa tutup tawaran tanpa menyatakan sebab di atas keputusan tersebut dan wang bayaran dokumen tidak akan dikembalikan.
	<br><br>
	5.Dokumen Sebutharga yang lengkap diisi hendaklah dihantar dalam sampul surat dan ditulis dengan tajuk dan no. sebutharga berkenaan dan hendaklah dimasukkan ke dalam peti tender di <b>Kaunter Jabatan Pengurusan Pembangunan, Universiti Sultan Zainal Abidin (UniSZA), Kampus Gong Badak, 21300 Kuala Nerus Terengganu Darul Iman</b> pada atau sebelum <b>jam 12.00 tengah hari</b> pada hari tersebut.
	<br><br>
	6.Universiti tidak terikat untuk menerima tawaran ataupun mana-mana tawaran.
	<br><br>
	7.Kontraktor yang berjaya tetapi enggan menjalankan kerja-kerja ini selepas tawaran dibuat atau menarik balik tawaran tersebut sebelum tempoh sahlaku tender tamat akan diambil tindakan ke atas pendaftarannya dan juga akan menanggung segala kos perbezaan.
	<br><br>
	Kenyataan Sebutharga ini juga dipamerkan di laman web kami: <b>www.jpp.unisza.edu.my(e-sebutharga)</b>
	</p>
</td></tr></table> <br>
';

} //close if jabatan JPP

if ($stop=="y"){
	
include "footer.php";
$content .= '<div style="page-break-after:always"></div>';
include "header.php"; 
$stop="n";
}
	}
	}
	else {
	$content .='Sesuatu tidak kena';
 }
 } //close LOOP array
 
include "footer.php";
$content .='</page>';

//HTML2PDF JOB START
$html2pdf = new Html2Pdf('P', 'A4', 'fr', true, 'UTF-8', 0); //$html2pdf = new Html2Pdf();
$html2pdf->writeHTML($content);

/*Komen Salah Satu Dekat out.php*/
include 'out2.php';

?>