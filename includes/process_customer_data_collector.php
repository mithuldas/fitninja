<?php

require_once __DIR__.'/../vendor/autoload.php';
require_once __DIR__.'/../config.php';
require_once ( ROOT_DIR.'/includes/autoloader.php' );
require_once ( ROOT_DIR.'/includes/dbh.php' );

Helper::view($_POST);

// clear out existing data before inserting new data ()
$userProductId = $_POST['userProductId'];

$sql = "delete from form_saved_data where user_product_id=$userProductId";
$stmt = mysqli_stmt_init($conn);
mysqli_stmt_prepare($stmt, $sql);
mysqli_stmt_execute($stmt);

$sql = "delete from form_saved where user_product_id=$userProductId";
$stmt = mysqli_stmt_init($conn);
mysqli_stmt_prepare($stmt, $sql);
mysqli_stmt_execute($stmt);

// insert new data

$sql = "insert into form_saved (user_product_id, form_version) values ($userProductId, 1)";
$stmt = mysqli_stmt_init($conn);
mysqli_stmt_prepare($stmt, $sql);
mysqli_stmt_execute($stmt);

// set limits based on form version
if($_POST['formVersion']=='1'){
  $limit=18;
}

for ($i=1; $i <=$limit; $i++) {
  $subQuery = "select id from form_saved where user_product_id=$userProductId";
  $postValue = $_POST["$i"];
  $sql = "insert into form_saved_data (saved_form_id, form_version, question_id, answer)
          values (($subQuery), 1, $i, '$postValue');";
  $stmt = mysqli_stmt_init($conn);
  mysqli_stmt_prepare($stmt, $sql);
  mysqli_stmt_execute($stmt);
  
}

?>
