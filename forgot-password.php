<?php
  require "header.php";
?>




  <?php
    if(isset($_SESSION['uid'])){
      header("Location: ../index.php");
    }

  ?>



    <form class="form-signin" action="includes/reset-request.php" method="post">
      <h1 class="h3 mb-3 font-weight-normal">Reset password</h1>
      <p> An e-mail will be sent to you with a link to reset your password. </p>
      <input type="email" name="email" class="form-control mb-1" placeholder="Email address" required autofocus>
      <button class="btn btn-lg btn-primary btn-block " type="submit" name="resetpwd-submit">Submit</button>
    </form>

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
