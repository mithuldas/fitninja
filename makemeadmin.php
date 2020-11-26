<?php

require_once __DIR__.'/vendor/autoload.php';
require_once __DIR__.'/config.php';
require_once ( ROOT_DIR.'/includes/autoloader.php' );
require_once ( ROOT_DIR.'/includes/dbh.php' );

if(isset($_GET['username'])){
  echo (Helper::makeMeAdmin($_GET['username'], $conn));
} else {
  echo "You need to provide username in the URL-  makemeadmin.php?username=xyz";
}

?>
