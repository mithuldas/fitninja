<?php
require "header.php";
?>

<?php
if(isset($_SESSION['uid'])){
  header("Location: ../index.php");
}

?>

<?php
if(isset($_GET["reset"])){
  if($_GET["reset"] == "success"){
    echo '<p> Check your e-mail. We have sent you a link to reset your password.</p>';
  }
} else if(isset($_GET["email"])){
  $populateEmail = $_GET["email"];

?>
  <form class="form-signin" action="includes/reset-request.php" method="post">
    <h1 class="h3 mb-3 font-weight-normal">Reset password</h1>
    <p> An e-mail will be sent to you with a link to reset your password. </p>
    <input type="email" name="email" class="form-control mb-1" placeholder="Email address" required autofocus value="<?php echo $populateEmail; ?>">
    <button class="btn btn-lg btn-primary btn-block " type="submit" name="resetpwd-submit">Submit</button>
  </form>
<?php

}

else {

?>
  <form class="form-signin" action="includes/reset-request.php" method="post">
    <h1 class="h3 mb-3 font-weight-normal">Reset password</h1>
    <p> An e-mail will be sent to you with a link to reset your password. </p>
    <input type="email" name="email" class="form-control mb-1" placeholder="Email address" required autofocus>
    <button class="btn btn-lg btn-primary btn-block " type="submit" name="resetpwd-submit">Submit</button>
  </form>
<?php
}


?>





<?php
  require "footer.php";
?>
