<?php
  require "header.php";
?>

<?php
  if(isset($_SESSION['uid'])){
    header("Location: ../user_landing.php");
  }

?>

  <form class="form-signin" action="includes/login.php" method="post">

    <input type="text" name="mailuid" class="form-control" placeholder="Email or Username" required autofocus>
    <input type="password" name="pwd" class="form-control mb-1" placeholder="Password" required>

    <div class="checkbox mb-3">
        <input type="checkbox" value="remember-me"> Remember me
    </div>
    <button class="btn btn-lg btn-primary btn-block" type="submit" name="login-submit">Sign in</button>

<?php

if(isset($_GET['newpwd'])){
  if ($_GET['newpwd'] == "passwordupdated") {
    echo '<p> Your password has been reset </p>';
  }
}

?>

    <button type="button" class="btn btn-link"><a href="forgot-password.php"> Forgot password?</a> </button>
  </form>



<?php
  require "footer.php";
?>
