<?php
   $hn      = 'localhost';
   $un      = 'root';
   $pwd     = ''; /* MyP@eYGB24 */
   $db      = 'cashless';
   $cs      = 'utf8';

   //untuk web
   $conn=mysqli_connect($hn, $un, $pwd, $db) or die(mysqli_error());
?>