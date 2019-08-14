<?php
require __DIR__.'/vendor/autoload.php';

use Spipu\Html2Pdf\Html2Pdf;

$html2pdf = new Html2Pdf();
$htmlFile = "test.html";
$buffer = file_get_contents($htmlFile);
$html2pdf->writeHTML($buffer);


//Inline
//$html2pdf->Output('my.pdf', 'I');


/* ___________________________________________Server save Start */
//Save temporary at server
$html2pdf->Output(__DIR__ .'/pdfile/my.pdf', 'F');
// The location of the PDF file on the server.
$filename = "pdfile/my.pdf";
// Let the browser know that a PDF file is coming.
header("Content-type: application/pdf");
header("Content-Length: " . filesize($filename));
// Send the file to the browser.
readfile($filename);
exit; 
/* ____________________________________________Server save End */
?>