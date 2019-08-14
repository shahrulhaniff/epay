<!DOCTYPE html>
<html>
<head>
<link rel="icon" href="imgs/ico.png" />
	<link href="pre/preloader.css" rel="stylesheet">
<? 
if(!empty($pagenow)){$title="Menu ".$pagenow;}
if(empty($title)){ $title = "Cashless@UniSZA"; } 
?>
<title><?=$title?></title>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="assets/css/w3.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <!-- BOOTSTRAP CORE STYLE  -->
    <link href="assets/css/bootstrap.css" rel="stylesheet" />
    <!-- FONT AWESOME STYLE  -->
    <!-- DATATABLE STYLE  -->
    <link href="assets/js/dataTables/dataTables.bootstrap.css" rel="stylesheet" />
    <!-- CUSTOM STYLE  -->
    <link href="assets/css/style.css" rel="stylesheet" />
	
	<!-- JQUERY -->
	<script src="../extension/jquery.min.js"></script>
<style>
html,body,h1,h2,h3,h4,h5 {font-family: Arial, Helvetica, sans-serif;}
</style>
</head>
<body class="w3-light-grey">


<?php include "functions.php"; ?>

<!--
 <div id="preloader">
      <div id="status">
        <img alt="logo" src="imgs/ico.png">
      </div>
    </div> -->
