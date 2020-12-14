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

  <h5>Request a Free Trial Session</h5>
  <small> Pick an activity, date and time for your trial. We'll pair you up with a FuNinja trainer. </small>

  <form action="/includes/submit_trial_request.php" class="mt-3" method="post">
    <div class="row">
      <div class="form-group col">
        <label class="pt-2" for="phone">1. Pick your activity: </label><br>
        <?php
          foreach ($activityNames as $activityName) {
            echo "
            <input  type='radio' value='$activityName' id='$activityName' name='trialType' required>
            <label class='form-check-label' for='$activityName'> $activityName </label>
            <br>
            ";
          }
        ?>
      </div>
    </div>

    <div class="row">
      <div class="form-group col-xs-4 col-md-4">
        <label for="gender">2. Requested date </label>
        <select class="form-control" id="dateSelect" name="trialDate">
        </select>
      </div>
      <div class="form-group col-xs-4 col-md-4">
        <div class="row pl-3">
          <label for="dobDay">3. Requested time window</label>
        </div>
        <select class="form-control" id="timeSlot" name="trialTimeSlot">
        </select>
    </div>
  </div>
    <div class="row">
      <div class="form-group col-xs-8 col-md-8">
        <label for="phone">4. Comments (Optional)<small> Expectations/ Feedback/ Health Restrictions </small></label>
        <input id="comments" type="text" name="comments" class="form-control">
      </div>

    </div>
    <div class="row">
      <div class="form-group col-xs-4 col-md-4">
        <input type='hidden' name='currentUser' value='<?php echo $currentUserJSON; ?>'>
        <button class="btn btn-sm btn-primary" type="submit" name="trainee_landing_submit">Submit Request</button>
      </div>
    </div>
  </form>
</div>


<script>

var date = new Date();
var days = ['Sun','Mon','Tue','Wed','Thu','Fri','Sat'];
var months = ['Jan','Feb','Mar','Apr','May','Jun','Jul','Aug','Sep','Oct','Nov','Dec'];


var newDate = new Date();

var availableDates=[];
var timeSlots = ['6-7 AM','7-8 AM', '8-9 AM','9-10 AM','10-11 AM','11-12 Noon','12-1 PM','1-2 PM','2-3 PM','4-5 PM','5-6 PM','6-7 PM','7-8 PM','8-9 PM','9-10 PM','10-11 PM','11-12 Midnight'];

var i;

for(i=1; i<=5; i++){
  newDate.setDate(date.getDate()+i);
  availableDates.push(days[newDate.getDay()]+' '+newDate.getDate()+' '+months[newDate.getMonth()]+' '+newDate.getFullYear());
}

var dateSelect = document.getElementById('dateSelect');

for(var i = 0; i < availableDates.length; i++) {
  var opt = document.createElement('option');
  opt.innerHTML = availableDates[i];
  opt.value = availableDates[i];
  dateSelect.appendChild(opt);
}

var timeSelect = document.getElementById('timeSlot');
for(var i = 0; i < timeSlots.length; i++) {
  var opt = document.createElement('option');
  opt.innerHTML = timeSlots[i];
  opt.value = timeSlots[i];
  timeSelect.appendChild(opt);
}

</script>
