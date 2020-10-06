<?php

include "includes/autoloader.php";
?>

<?php
  require "header.php";
?>

<main>

  <?php
    if(isset($_SESSION['uid'])){
      echo "<p>You are logged in as $_SESSION[username]</p>";
    }


  ?>


</main>



<?php
  require "footer.php";
?>
