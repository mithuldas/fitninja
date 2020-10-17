<?php

require "header.php";

session_unset();

session_destroy();

?>

<div class="container">

      <h4>Welcome! Let's get you started:</h4>

    <form class="form-signin" action="includes/signup_onboard.php" method="post">

      <input type="hidden" name="type" value="<?php echo $_GET["type"]; ?>" />
      <input type="email" name="email" class="form-control" value="<?php echo $_GET['email']; ?>" required autofocus readonly>
      <input type="text" name="uid" class="form-control" placeholder="Choose a username" required autofocus>
      <input type="password" name="pwd" class="form-control" placeholder="Password" required>
      <input type="password" name="pwd-repeat" class="form-control" placeholder="Repeat Password" required>

      <button class="btn btn-lg btn-primary btn-block mt-1" type="submit" name="signup-onboard-submit">Begin</button>
    </form> ;



</div>

<?php
  require "footer.php";
?>
