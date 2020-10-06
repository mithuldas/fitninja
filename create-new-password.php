<?php
  require "header.php";
?>

<?php
  if(isset($_SESSION['uid'])){
    header("Location: ../index.php");
  }

?>


<?php

  $selector = $_GET["selector"];
  $validator = $_GET["validator"];


  if(empty($selector) || empty($validator)) {
    echo "Could not validate your request!";
  } else {

    if(ctype_xdigit($selector) !== false && ctype_xdigit($validator) !== false){

      ?>

      <form class="form-signin" action="includes/reset-password.php" method="post">
        <h1 class="h3 mb-3 font-weight-normal">Enter new password</h1>
        <input type="hidden" name="selector" value= "<?php echo $selector; ?>">
        <input type="hidden" name="validator" value= "<?php echo $validator; ?>">
        <input type="password" name="pwd" class="form-control" placeholder="Password" required autofocus>
        <input type="password" name="pwd-repeat" class="form-control mb-1" placeholder="Repeat Password" required autofocus>
        <button class="btn btn-lg btn-primary btn-block " type="submit" name="pwd-change">Submit</button>
      </form>

        <?php
    } else {
      echo 'xdigit validation failed';
      ?>

      <form class="form-signin" action="includes/reset-password.php" method="post">
        <h1 class="h3 mb-3 font-weight-normal">Enter new password</h1>
        <input type="hidden" name="selector" value= "<?php echo $selector; ?>">
        <input type="hidden" name="validator" value= "<?php echo $validator; ?>">
        <input type="password" name="pwd" class="form-control" placeholder="Password" required autofocus>
        <input type="password" name="pwd-repeat" class="form-control mb-1" placeholder="Repeat Password" required autofocus>
        <button class="btn btn-lg btn-primary btn-block " type="submit" name="pwd-change">Submit</button>
      </form>

        <?php
    }
  }
?>


<?php
if(isset($_GET["reset"])){
  if($_GET["reset"] == "success"){
    echo '<p> Check your e-mail for the reset link!</p>';
  }
}


?>

<?php
  require "footer.php";
?>
