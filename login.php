<?php
  require "header.php";
?>

<?php
  if(isset($_SESSION['uid'])){
    header("Location: ../landing.php");
  }

?>

<div class="container">
<?php

if(isset($_GET['newpwd'])){
  if ($_GET['newpwd'] == "passwordupdated") {
    echo '
    <div class="alert alert-dismissible alert-success">
  <button type="button" class="close" data-dismiss="alert">&times;</button>
  <strong>Success!</strong> Login with your new password </a>.
</div>
    ';
  }
}

?>

<?php

if(isset($_GET['status'])){
  if ($_GET['status'] == "verify_email") {

?>

    <div class="container">
    <p> Please verify your e-mail id before logging-in. Try checking your spam folder if you cannot find the e-mail. </p>
    <button type="button" class="btn btn-link" name="resend-verification"><a href= <?php echo "includes/resend_verification.php?email=" . $_GET['email'] ; ?>> Resend e-mail </a> </button>
  </div>
<?php
  }
}else {

?>
  <form class="form-signin" action="includes/login.php" method="post">

    <input type="text" name="mailuid" class="form-control" placeholder="Email or Username" required autofocus>
    <input type="password" name="pwd" class="form-control mb-1" placeholder="Password" required>

    <div class="checkbox mb-3">
        <input type="checkbox" value="remember-me"> Remember me
    </div>
    <button class="btn btn-lg btn-primary btn-block" type="submit" name="login-submit">Sign in</button>
        <button type="button" class="btn btn-link"><a href="forgot-password.php"> Forgot password?</a> </button>

          </form>
<?php
}




?>


</div>



<?php
  require "footer.php";
?>
