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
<center>We've received your request. A FuNinja co-ordinator will be in touch with you shortly.
<br><br>
<a href="/trainee_dashboard.php">Return to dashboard </a>

</center>
</div>
