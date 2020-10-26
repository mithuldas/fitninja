<?php

$servername="localhost";
$dbusername="root";
$dbpassword="Aeh2kpst1!";
$dbname="fitninja";

$conn=mysqli_connect($servername, $dbusername, $dbpassword, $dbname);

if(!$conn){
  die("Connection failed: ".mysqli.connect.error());

}
