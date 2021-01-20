<?php

require_once __DIR__.'/vendor/autoload.php';
require_once __DIR__.'/config.php';
require_once ( ROOT_DIR.'/includes/autoloader.php' );
require_once ( ROOT_DIR.'/includes/dbh.php' );

FlowControl::startSession();
FlowControl::redirectIfNotLoggedIn();
FlowControl::redirectIfWrongUserType("Trainee");

require "header.php";

$activityNames=Activity::getAllActivityNames($conn);
$currentUser = new Trainee($_SESSION['uid'], $conn);
$currentUserJSON = json_encode($currentUser);
?>

<script>
  var currentUser = <?php echo $currentUserJSON; ?>;
</script>

<div class="container mt-3">
  <div class="row justify-content-center">
    <div class="col-8 dashCard p-3" align="center">
<p>We have received your trial request. A FuNinja co-ordinator will reach out to you soon.</p>

<a href="/trainee_dashboard.php" class="btn btn btn-primary blueButton">Back to Dashboard </a>

</div>
</div>


</div>

<?php
  require "footer.php";
?>
