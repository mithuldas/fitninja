
<?php
require_once __DIR__.'/../config.php';
include ROOT_DIR."/includes/autoloader.php";

  if(!isset($_SESSION)){
    session_start();
  }

  if(!isset($_SESSION['uid'])){

    header("Location: /index.php");
    exit();
  }
  else {
    header("Location: /admin/admin_dashboard.php");
    exit();
  }

?>
