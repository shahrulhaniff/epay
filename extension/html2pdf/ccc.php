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

$content .= '
<page backtop="15mm" backbottom="15mm" backleft="20mm" backright="20mm">

<div class="ft">



<table style="width:100%;" border="0"><tr><td align="center" style="width:100%;"><font style="font-size:16px;"><b>PERMOHONAN BERTUGAS KERJA LEBIH MASA</b></font></td></tr></table>

<br><br>
<table style="width:100%;" border="0">
<tr><td style="width:40%;"> Nama pegawai yang memohon </td><td style="width:2%;">:</td><td style="width:58%;"> ok</td></tr>
<tr><td style="width:40%;"> Jawatan                   </td><td style="width:2%;">:</td><td style="width:58%;">ok</td></tr>
<tr><td style="width:40%;"> Unit                      </td><td style="width:2%;">:</td><td style="width:58%;"> ok </td></tr>
<tr><td colspan="3">  &nbsp;  </td></tr>
</table>
</div>
</page>
';


//HTML2PDF JOB START
$html2pdf = new Html2Pdf('P', 'A4', 'fr', true, 'UTF-8', 0); //$html2pdf = new Html2Pdf();
$html2pdf->writeHTML($content);

/*Komen Salah Satu Dekat out.php*/
include 'out.php';

?>