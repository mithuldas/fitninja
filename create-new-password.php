<?php
  require "header.php";
?>

<?php
  if(isset($_SESSION['uid'])){
    header("Location: ../index.php");
    exit();
  }

?>

<form class="form-signin" action="includes/reset-password.php" method="post">
  <h6 id = "statusMessage"> <h6>
  <h1 class="h3 mb-3 font-weight-normal">Enter new password</h1>
  <input type="hidden" name="selector" value= "<?php echo $selector; ?>">
  <input type="hidden" name="validator" value= "<?php echo $validator; ?>">
  <input type="password" name="pwd" class="form-control" placeholder="Password" required autofocus>
  <input type="password" name="pwd-repeat" class="form-control mb-1" placeholder="Repeat Password" required autofocus>
  <button class="btn btn-lg btn-primary btn-block " type="submit" name="pwd-change">Submit</button>
</form>
        <?php

?>


<?php
  require "footer.php";
?>

<script>
  $('#statusMessage').hide();
    var status = "<?php echo($_GET['status']); ?>";

    if(status == "emptyfields" || status == "pwdMismatch" || status =="wrongPassword" || status =="tooShort" || status =="complexityFailed"){
      $("*").removeClass("active");
      $("#security, #security-link").addClass("active");
    }
    if (status == "emptyfields"){
      $('#statusMessage').slideDown();
      $('#statusMessage').html('<h6 style="color:red"> Fill in all fields </h6');
    } else if (status == "pwdMismatch") {
      $('#statusMessage').slideDown();
      $('#statusMessage').html('<h6 style="color:red"> Passwords do not match </h6');
    } else if (status == "wrongPassword") {
      $('#statusMessage').slideDown();
      $('#statusMessage').html('<h6 style="color:red"> The current password you have entered is incorrect </h6');
    } else if (status == "tooShort") {
      $('#statusMessage').slideDown();
      $('#statusMessage').html('<h6 style="color:red"> Password must contain at least 8 characters </h6');
    } else if (status == "complexityFailed") {
      $('#statusMessage').slideDown();
      $('#statusMessage').html('<h6 style="color:red"> Password should contain at least 1 upper case, 1 lowercase and 1 number </h6');

    }
      else if (status == "passwordupdated") {
      $('#statusMessage').slideDown();
      $('#statusMessage').html('<h6 style="color:green"> Your password has been updated </h6');
    }
</script>
