<?php
    
//set it to writable location, a place for temp generated PNG files
$PNG_TEMP_DIR = dirname(__FILE__).DIRECTORY_SEPARATOR.'temp'.DIRECTORY_SEPARATOR;  
//html PNG location prefix
$PNG_WEB_DIR = 'temp/';

if($count==true){ include "../qr/qrlib.php"; $count=false; }

    //ofcourse we need rights to create temp dir
    if (!file_exists($PNG_TEMP_DIR))
        mkdir($PNG_TEMP_DIR);
    
    
    $filename = $PNG_TEMP_DIR.'test.png';
    
    //processing form input
    //remember to sanitize user input in real-life solution !!!
    $errorCorrectionLevel = 'L';
    if (isset($_REQUEST['level']) && in_array($_REQUEST['level'], array('L','M','Q','H')))
        $errorCorrectionLevel = $_REQUEST['level'];    
	/*
	echo 'sizeallqr:&nbsp;<select name="sizeallqr">';
        
    for($i=1;$i<=10;$i++)
        echo '<option value="'.$i.'"'.(($matrixPointSize==$i)?' selected':'').'>'.$i.'</option>';
        
    echo '</select>&nbsp<br>';
	*/
    $matrixPointSize = 8;
    if (isset($_REQUEST['size']))
        $matrixPointSize = min(max((int)$_REQUEST['size'], 1), 10);

    if (!isset($_REQUEST['data'])) { 
    
        //it's very important!
        if (trim($idd) == '')
            die('Maklumat tidak wujud! <a href="index.php">back</a>');
            
        // user data
        $filename = $PNG_TEMP_DIR.'test'.md5($idd.'|'.$errorCorrectionLevel.'|'.$matrixPointSize).'.png';
        QRcode::png($idd, $filename, $errorCorrectionLevel, $matrixPointSize, 2);    
        
    } else {
    $content .='Oops.. Ada masalah, sila hubungi pihak pembangun sistem';
        
    }    
	$content .='<table style="width:100%; border-collapse: collapse;" border="0"><tr><td style="width:25%; padding: 1px;" align="center"></td><td style="width:50%; padding: 1px;" align="center"><img src="../../web/imgs/unisza.png" alt="logo" style="height: 150px; "></td><td style="width:25%; padding: 1px;" align="center">';
	$content .='<table style="width:100%; border-collapse: collapse;" border="0"><tr><td style="width:100%; padding: 1px;" align="center">Kod QR bagi dokumen ini:</td></tr></table>';
	
    $content .='<table style="width:100%; border-collapse: collapse;" border="0"><tr><td style="width:100%;" align="center">';
    
    $content .='<img src="../qr/'.$PNG_WEB_DIR.basename($filename).'" style="height:150px;"/><br>';
	
	//$content .=' '. (isset($idd)?htmlspecialchars($idd):''.$idd.'');
	$content .='</td></tr></table>';
	$content .='</td></tr></table>';
	$content .='<table style="width:100%; border-collapse: collapse;" border="1"><tr><td style="width:100%; padding: 1px;" bgcolor="#000000" align="center">hitam</td></tr></table>';
	?>