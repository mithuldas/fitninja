<?php

$servername="localhost";
$dbusername="root";
$dbname="funinja";

if(isset($_SERVER['HTTP_HOST']) and $_SERVER['HTTP_HOST']=="localhost"){ // Sabre windows laptop

  $dbpassword="";
  $dbname="funinja";

} else { // AWS
  $dbpassword="Aeh2kpst1!";
}

if($_SERVER['DOCUMENT_ROOT']="/Users/mithulmangaldas/funinja"){ // MAMP Mac
  $servername='127.0.0.1';
  $dbpassword='root';
}
$conn=mysqli_connect($servername, $dbusername, $dbpassword, $dbname);

if(!$conn){
  die("Connection failed: ".mysqli.connect.error());
}
