<?php

require_once __DIR__.'/../config.php';
require_once ( ROOT_DIR.'/includes/autoloader.php' );
require_once ( ROOT_DIR.'/includes/dbh.php' );

switch ($_GET['action']) {
  case "deleteAllUsers":
    echo (Helper::deleteAllUsers($conn));
    exit();
  case "deleteUserProducts":
    echo (Helper::deleteUserProducts($conn));
    exit();
}
?>
