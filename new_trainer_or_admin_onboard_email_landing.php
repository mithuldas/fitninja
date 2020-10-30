<?php

session_start();

session_unset();
session_destroy();

require "header.php";

$email = "";
$username = "";

if(isset($_GET['email'])){
  $email = $_GET['email'];
}

if(isset($_GET['uid'])){
  $username = $_GET['uid'];
}

?>

<div class="container">

      <h4>Welcome! Let's get you started:</h4>

    <form class="form-signin" action="includes/process_new_trainer_or_admin_onboarding_form.php" method="post">
      <h6 id = "statusMessage"> <h6>
      <input type="hidden" name="type" value="<?php echo $_GET["type"]; ?>" />
      <input type="hidden" name="selector" value="<?php echo $_GET["selector"]; ?>" />
      <input type="hidden" name="validator" value="<?php echo $_GET["validator"]; ?>" />
      <input type="email" name="email" class="form-control" value="<?php echo $email; ?>" required autofocus readonly>
      <input type="text" name="uid" class="form-control" placeholder="Choose a username" value="<?php echo $username; ?>" required autofocus>
      <input type="password" name="pwd" class="form-control" placeholder="Password" required>
      <input type="password" name="pwd-repeat" class="form-control" placeholder="Repeat Password" required>

      <button class="btn btn-lg btn-primary btn-block mt-1" type="submit" name="signup-onboard-submit">Begin</button>
    </form>



</div>

<?php
  require "footer.php";
?>

<script>
  $('#statusMessage').hide();
    var status = "<?php echo($_GET['status']); ?>";

    if (status == "emptyfields"){
      $('#statusMessage').slideDown();
      $('#statusMessage').html('<h6 style="color:red"> Fill in all fields </h6');
    } else if (status == "invalidemailuid") {
      $('#statusMessage').show();
      $('#statusMessage').html('<h6 style="color:red"> Enter a valid username and e-mail ID. Your username must be at least 6 characters long, must only have letters, numbers, _ and . </h6');
    } else if (status == "invalidemail") {
      $('#statusMessage').show();
      $('#statusMessage').html('<h6 style="color:red">Please enter a valid e-mail ID </h6>');
    } else if (status == "invalidUsernameChars") {
      $('#statusMessage').show();
      $('#statusMessage').html('<h6 style="color:red">Your username must be at least 6 characters long, must only have letters, numbers, _ and . </h6>');
    } else if (status == "usernameTooShort") {
      $('#statusMessage').show();
      $('#statusMessage').html('<h6 style="color:red">Your username must be at least 6 characters long </h6>');
    } else if (status == "pwdMismatch") {
      $('#statusMessage').show();
      $('#statusMessage').html('<h6 style="color:red"> Passwords do not match </h6');
    } else if (status == "tooShort") {
      $('#statusMessage').show();
      $('#statusMessage').html('<h6 style="color:red"> Password must contain at least 8 characters </h6');
    } else if (status == "username_taken") {
      $('#statusMessage').show();
      $('#statusMessage').html('<h6 style="color:red"> This username is already in use. Please choose another one. </h6');
    } else if (status == "emailexists") {
      $('#statusMessage').show();
      $('#statusMessage').html('<h6 style="color:red"> User with this e-mail already exists. Would you like to <a href="../forgot-password.php"><u> reset your password </u></a> instead? </h6');
    } else if (status == "invalidlink") {
      $('#statusMessage').show();
      $('#statusMessage').html('<h6 style="color:red"> Your link is no longer valid. Please get in touch with the support team. </h6');
    } else if (status == "sqlerror") {
      $('#statusMessage').show();
      $('#statusMessage').html('<h6 style="color:red"> There was an error in the database. Please contact our support team. </h6');
    }
</script>
