<?
   $hn      = 'localhost';
   $un      = 'root';
   $pwd     = ''; /* kena buat skali lg kat bawah sebab class xdpt baca global, kena tanya siapa power java */
   $db      = 'cashless';
   $cs      = 'utf8';

   //untuk web
   $conn=mysqli_connect($hn, $un, $pwd, $db) or die(mysqli_error());
?>