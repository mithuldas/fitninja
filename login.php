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
  <form class="form-signin" id = "login" action="includes/login.php" method="post" novalidate>

    <input type="text" name="login-mailuid" id = "login-mailuid" class="form-control" placeholder="Email or Username" required autofocus>
    <input type="password" name="login-pwd" id = "login-pwd" class="form-control mb-1" placeholder="Password" required>
        <small id = "login-errorMsg" class = "login-error formErrors">  </small>
    <div class="checkbox mb-3">
    <input type="checkbox" value="remember-me"> Remember me </input>
  </div>
    <button class="btn btn-sm btn-primary btn-block" type="submit" name="login-submit" id = "login-submit">Sign in</button>
    <button type="button" class="btn btn-link"><a href="forgot-password.php"> Forgot password?</a> </button>
    <hr>
      </form>
<?php
}




?>


</div>



<?php
  require "footer.php";
?>
