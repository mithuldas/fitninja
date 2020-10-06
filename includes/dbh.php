<?php

$servername="localhost";
$dbusername="root";
$dbpassword="";
$dbname="fitninja";

$conn=mysqli_connect($servername, $dbusername, $dbpassword, $dbname);

if(!$conn){
  die("Connection failed: ".mysqli.connect.error());

}


