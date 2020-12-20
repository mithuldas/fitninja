

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

<script>
// add indexPage class to body tag so that white background can be set

$("body").addClass("indexPage");

</script>


<main>




  <div class="container ">
    <!-- USP / product highlights section -->

    <div class="row pt-5">
      <div class="col-lg-4 col-6 text-center">
      <img src="/images/graphics/Customized plans with Text PNG.png" width="60%"> </img>
      </div>
      <div class="col-lg-4 col-6 text-center">
      <img src="/images/graphics/Flexible Schedule with text PNG.png" width="60%">
      </div>
      <div class="col-lg-4 col-6 text-center">
      <img src="/images/graphics/Feedback Loop with Text PNG.png" width="60%"> </img>
      </div>
      <div class="col-lg-4 col-6 text-center">
      <img src="/images/graphics/Top Tier Trainers with Text PNG.png" width="60%"> </img>
      </div>
      <div class="col-lg-4 col-6 text-center">
      <img src="/images/graphics/Accessible Anywhere with text PNG.png" width="60%"> </img>
      </div>
      <div class="col-lg-4 col-6 text-center">
      <img src="/images/graphics/Diverse workout routines with text PNG.png" width="60%"> </img>
      </div>

    </div>



</div>

</main>


<!--
<img src="/images/Icons/Enroll/Enroll with Text PNG.png" width="100%"> </img>
<img src="/images/Icons/Pick Membership/Pick Membership with text PNG.png" width="100%">  </img>
<img src="/images/Icons/Get Connected/Get Connected with Text PNG.png" width="100%"> </img>-->

<?php
  require "footer.php";
?>
