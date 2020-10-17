<?php

require "header.php";

if(isset($_SESSION['uid'])){
  header("Location: ../index.php");
}

?>
  <div class="container">

<?php
if(isset($_GET['error'])){
  if($_GET['error']=="emptyfields"){
    echo '<p>Fill in all the fields!</p>';
  }
}

if(isset($_GET['error'])){
  if($_GET['error']=="emailexists"){
    echo '
    <div class="alert alert-dismissible alert-danger">
  <button type="button" class="close" data-dismiss="alert">&times;</button>
  <strong>Oh snap!</strong> ' . $_GET['email'] . ' is already linked to an account. Would you like to <a href="forgot-password.php?email=' . $_GET['email'] . '" class="alert-link"> Reset Your Password </a> instead?
</div>
    ';
  }
}

if(isset($_GET['status'])){
  if($_GET['status']=="verify_email"){

?>

  <p>Check your e-mail for a verification link.</p>

<?php

  }
} else{

    echo '
    <form class="form-signin" action="includes/signup_trainee.php" method="post">
      <h1 class="h3 mb-3 font-weight-normal">Signup</h1>

      <input type="text" name="uid" class="form-control" placeholder="Username" required autofocus>
      <input type="email" name="email" class="form-control" placeholder="E-Mail" required>
      <input type="password" name="pwd" class="form-control" placeholder="Password" required>
      <input type="password" name="pwd-repeat" class="form-control mb-1" placeholder="Repeat Password" required>

      <button class="btn btn-lg btn-primary btn-block" type="submit" name="signup-submit">Register</button>
    </form> ';
}
?>
</div>






<?php
  require "footer.php";
?>
