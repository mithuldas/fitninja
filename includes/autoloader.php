<?php

spl_autoload_register('myAutoLoader');

include_once (__DIR__.'/../config.php');

function myAutoLoader($className) {
  $path = ROOT_DIR."/classes/";
  $extension = ".php";
  $fullPath = $path . $className . $extension;

  if(!file_exists($fullPath)){
    return false;
  }

  include_once $fullPath;
}

?>
