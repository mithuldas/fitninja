<?php

$servername="localhost";
$dbusername="root";
$dbname="funinja";

if(isset($_SERVER['HTTP_HOST']) and $_SERVER['HTTP_HOST']=="localhost"){

  $dbpassword="";
  $dbname="funinja";

} else {
  $dbpassword="Aeh2kpst1!";
}

$conn=mysqli_connect($servername, $dbusername, $dbpassword, $dbname);

if(!$conn){
  die("Connection failed: ".mysqli.connect.error());
}
