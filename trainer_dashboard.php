<?php

require_once __DIR__.'/vendor/autoload.php';
require_once __DIR__.'/config.php';
require_once ( ROOT_DIR.'/includes/autoloader.php' );
require_once ( ROOT_DIR.'/includes/dbh.php' );


if(!isset($_SESSION)){
  session_start();
}

if(!isset($_SESSION['uid'])){
  header("Location: index.php?notLoggedIn");
  exit();
}

if($_SESSION['userType']!="Trainer"){
  header("Location: includes/post_login_landing_controller.php");
  exit();
}
?>

<?php
require "header.php";

$currentUser = new Trainer($_SESSION['uid'], $conn);
$upcomingSessions=json_encode($currentUser->getUpcomingSessions(3, $conn));
$trainees = json_encode($currentUser->getTraineeList($conn));

$currentUserJSON = json_encode($currentUser);
?>

<script type="text/javascript">
  var currentUser = <?php echo $currentUserJSON; ?>;
  var upcomingSessions = <?php echo $upcomingSessions; ?>;
  var trainees = <?php echo $trainees; ?>;

</script>

<script type="text/javascript" src="scripts/trainer_dashboard.js"> </script>

<div class="container-fluid">

  <!-- row 1 - Welcome banner on pc and mob-->

  <div class="row">
    <div class="col-md">
      <div class="welcome-banner">
        <center>Welcome back, <?php echo $currentUser->firstName;?>!</center>
      </div>
    </div>
  </div>

    <!-- row 2 - upcoming and donut on pc -->
  <div class="row">
    <div class="col-md">
      <div class="upcoming-sessions-area" align="center">
      </div>
    </div>
    <div class="col-md">
      <div class="doughnut">
        <center>Doughnut here</center>
      </div>
    </div>
  </div>

  <!-- row - visible only on mobile that'll contain carousel with pie and calendar-->

  <div class="row">
    <div class="col">
      <div class="dashboard-carousel">

        <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
          <ol class="carousel-indicators">
            <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
            <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
          </ol>
        <div class="carousel-inner">
          <div class="carousel-item active">
            <center><img src="../images/donut-chart.png" style="width: 80%"></center>
          </div>
          <div class="carousel-item">
            <center><img src="../images/calendar.png" style="width: 90%"></center>
          </div>
        </div>
        <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
          <span class="carousel-control-prev-icon" aria-hidden="true"></span>
          <span class="sr-only">Previous</span>
        </a>
        <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
          <span class="carousel-control-next-icon" aria-hidden="true"></span>
          <span class="sr-only">Next</span>
        </a>
      </div>



      </div>
    </div>
  </div>

  <!-- row 2 -->
  <div class="row">
    <div class="col-md">
      <div class="trainee-details" align="center">
      Trainee list and status here
      </div>
    </div>
    <div class="col-md">
      <div class="calendar">
      Calendar here
      </div>
    </div>
  </div>


</div>

<?php
  require "footer.php";
?>
