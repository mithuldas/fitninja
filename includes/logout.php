<?php

include_once "../config.php";

require_once ( ROOT_DIR.'/classes/Token.php' );
require_once ( ROOT_DIR.'/includes/dbh.php' );

session_start();

//if cookie is set, delete the cookie from DB and invalidate expiry of actual cookie itself
if(isset($_SESSION['uid']) && isset($_COOKIE['FuNinja'])){
  $extractDataFromCookie = explode(':', $_COOKIE["FuNinja"], 2);
  $selector = $extractDataFromCookie[0] ;
  $validator =  $extractDataFromCookie[1];
  Token::deleteToken($selector, $conn);
}

session_unset();
session_destroy();

header("Location: ../index.php");
exit();
?>
