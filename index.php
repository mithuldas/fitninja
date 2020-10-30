<?php

include "includes/autoloader.php";
?>

<?php
  if(isset($_GET['status'])){
    if($_GET['status']=='verification-sent'){
        ?>
        <div class="alert alert-dismissible alert-success">
          <button type="button" class="close" data-dismiss="alert">&times;</button>
          We've sent you an email to make sure that you own the email account. Please click the link in it to login!
        </div>
        <?php
    }
  }
?>

<?php
  require "header.php";
?>


<main>




<div class="container-fluid" >
  <div class="container">
  <div class="row" >
    <div class="col-md">

  <h3 style="text-align: center"></h3>
  <p> When run of the mill personal training doesn't quite cut it. </p>
    </div>

    <div class="col-md">

  <p> FuNinja is great. I love my trainer - <b>John Doe</b> </p>
  <p> I've lost so much weight after joining FuNinja. My trainer keeps gets me working out even when I really didn't feel like it. - <b>Jill Bagabong</b></p>

    </div>

    </div>
  </div>
</div>

</main>



<?php
  require "footer.php";
?>
