<?php
  require "header.php";
?>


<?php
  if(isset($_SESSION['uid'])){
    header("Location: ../index.php");
  }

?>

    <?php
    if(isset($_GET['error'])){
      if($_GET['error']=="emptyfields"){
        echo '<p>Fill in all the fields!</p>';
      }

    }
  ?>


  <form class="form-signin" action="includes/signup.php" method="post">
    <h1 class="h3 mb-3 font-weight-normal">Signup</h1>

    <input type="text" name="uid" class="form-control" placeholder="Username" required autofocus>
    <input type="email" name="email" class="form-control" placeholder="E-Mail" required>
    <input type="password" name="pwd" class="form-control" placeholder="Password" required>
    <input type="password" name="pwd-repeat" class="form-control mb-1" placeholder="Repeat Password" required>

    <button class="btn btn-lg btn-primary btn-block" type="submit" name="signup-submit">Register</button>
  </form>



<?php
  require "footer.php";
?>
