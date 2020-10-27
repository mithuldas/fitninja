<?php
if(isset($_SESSION['uid'])){
  header("Location: index.php");
  exit();
}

?>

<div class="container">
<?php

require "header.php";




if(isset($_GET["reset"])){
  if($_GET["reset"] == "success"){
    echo '<div class="container text-left"> <h3 class="h3 mb-3 font-weight-normal"><b>Check your email</b></h3>
        <p> Please go to your <b>' . $_GET["email"] . '</b> email and click the password reset link we have sent for your <b>' . $_GET["username"] . '</b> FuNinja account.</p>
        <p> It could take a few minutes to appear, and be sure to check any spam and promotional folders—just in case! </p> </div>';
  } else if($_GET["reset"] == "nouser"){
    echo "<div class='container'> <p> We weren't able to find an account with the email id or username <b>" . $_GET["mailuid"] . "</b><br><br>
    <a class='btn btn-sm btn-primary' href='forgot-password.php'>Try again? </a> </div>";

  }
} else if(isset($_GET["email"])){
  $populateEmail = $_GET["email"];

?>
  <form class="form-group" action="includes/pwd-reset-request.php" method="post">
    <h4 class="h3 mb-3 font-weight-normal"> <b>Getting back into your FuNinja account</b> </h4>
    <p> Enter your email id or username: </p>
    <input type="text" name="mailuid" class="form-control mb-1" placeholder="" required autofocus value="<?php echo $populateEmail; ?>">
    <button class="btn btn-sm btn-primary" type="submit" name="resetpwd-submit">Send My Password Reset Link</button>
  </form>
<?php

}

else {

?>

  <form class="form-group" action="includes/pwd-reset-request.php" method="post" style=" text-align:left">
    <h4 class="h4 mb-3 font-weight-normal"><b>Getting back into your FuNinja account</b></h4>
    <p> Enter your email id or username: </p>
    <input type="text" name="mailuid" class="form-control mb-3" placeholder="" required autofocus>
    <button class="btn btn-sm btn-primary" type="submit" name="resetpwd-submit">Send My Password Reset Link</button>
  </form>
<?php
}


?>

</div>



<?php
  require "footer.php";
?>
