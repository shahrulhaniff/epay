<?php 
include "global.php";

if (empty($_SESSION['user'])) {
   header("Access-Control-Allow-Origin: *");
}
	/* *********** !!!!!!! PERHATIAN !!!!!!!********* */
	/* ****NAMA SERVER KENA TUKAR DEKAT************** */
	/* *********SERVER.PHP & GLOBAL.PHP************** */
	/* ***  sebab nak pakai GLOBAL.PHP dalam function lepas tukar v5->v7 server unisza*** */
	/* *** PASTU CUBA SOLVE GUNA GLOBAL CLASS VARIABLE DALAM PHP LINE 30,31,32,33 *** */

   //PASSWORD ABELEY : abcde123
   // Define database connection parameters
   //mysql_select_db($db) or die(mysql_error()); 
   
   
   // Set up the PDO parameters
   $dsn 	= "mysql:host=" . $hn . ";port=3306;dbname=" . $db . ";charset=" . $cs;
   $opt 	= array(
                        PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
                        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ,
                        PDO::ATTR_EMULATE_PREPARES   => false,
                       );
					   
   // Create a PDO instance (connect to the database)
   $pdo 	= new PDO($dsn, $un, $pwd, $opt);
	
	//include "pdo.php";
?>