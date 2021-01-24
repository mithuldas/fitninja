<?php

require_once __DIR__.'/vendor/autoload.php';
require_once __DIR__.'/config.php';
require_once ( ROOT_DIR.'/includes/autoloader.php' );
require_once ( ROOT_DIR.'/includes/dbh.php' );

FlowControl::startSession();
FlowControl::redirectIfNotLoggedIn();
FlowControl::redirectIfWrongUserType("Trainer");

?>

<?php
require "header.php";

$currentUser = new Trainer($_SESSION['uid'], $conn);
$allAssignments = $currentUser->getAllAssignments($conn);


// add trainee list to each assignment

foreach ($allAssignments as $assignment) {
  $assignmentId=$assignment->id;
  $sql = "select u.uid from user_assignments ua, users u
  where ua.uid=u.uid and u.user_type_id=2 and session_id in
  (select session_id from user_assignments ua where  ua.id=$assignmentId);";
  $stmt = mysqli_stmt_init($conn);

  if(!mysqli_stmt_prepare($stmt, $sql)){
    return "sqlerror";
  } else {
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    while($row = $result->fetch_assoc()) { // loop through the array and set all session properties
      $trainee= new Trainee($row['uid'], $conn);
      $assignment->traineeName = $trainee->firstName. ' '.$trainee->lastName;
    }
  }
}

$allAssignments = json_encode($allAssignments);

$upcomingSessions=$currentUser->getUpcomingSessions(3, $conn);

foreach ($upcomingSessions as $upcomingSession) {
  $upcomingSession->initTraineeDetails($conn);
}

$upcomingSessions=json_encode($upcomingSessions);

$trainees = json_encode($currentUser->getTraineeList($conn));

$currentUserJSON = json_encode($currentUser);
?>

<script src="https://cdn.jsdelivr.net/npm/underscore@1.12.0/underscore-min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>
<script src="ext_scripts/clndr.min.js"></script>
<link href="/css/clndr.css" rel="stylesheet">

<script type="text/javascript">
  var currentUser = <?php echo $currentUserJSON; ?>;
  var upcomingSessions = <?php echo $upcomingSessions; ?>;
  var trainees = <?php echo $trainees; ?>;

</script>

<script type="text/javascript" src="scripts/trainer_dashboard.js"> </script>

<div class="container-fluid breadcrumbContiner">
  <nav aria-label="breadcrumb">
    <ol class="breadcrumb" style="margin-bottom: 0px; padding-left:0px; padding-top:0px; padding-bottom:0px">
      <li class="breadcrumb-item"><a href="/index.php">Home</a></li>
      <li class="breadcrumb-item active" aria-current="page">Dashboard</li>
    </ol>
  </nav>
</div>
<div class="container-fluid containerReducePadding">



  <!-- row 2 - contains two columns -
    col 1 to contain upcoming sessions and below it, instructions area
    col 2 to contain the calendar and below it, the trainers list
  -->

  <div class="row">
    <div class="col-md m-3 mt-4 mobileDiv">
      <!-- row 1 - Welcome banner on pc and mob-->

      <div class="welcome-banner mb-4">
        <h5 class="welcomeText p-0 m-0" >Hi <?php echo $currentUser->firstName;?>, </h5>
        <h5 class="p-0 m-0 welcomeText"> This is your FuNinja dashboard</h5>
        <small class="hide-on-mobile">You can find your upcoming sessions, your full schedule and details of your trainees here.</small>
      </div>
      <div class="dashCardTitle dashMobTitle">Upcoming Sessions
      </div>
      <div class="upcoming-sessions-area p-3 dashCard mt-2 dashMobTextInner" align="left">
      </div>
      <div class="mt-4 dashCardTitle dashMobTitle"> Your Trainees
      </div>
      <div class="trainee-details dashCard  dashMobTextInner pt-3 pb-3  pl-3 pr-3 mt-2 mb-2" align="left">
      </div>

    </div>
    <div class="col-md mt-5 mobileDiv">
      <div class=" mt-1 hide-on-nonmobile dashCardTitle dashMobTitle"> Your Schedule
      </div>
      <div class=" hide-on-mobile dashCardTitle"> <center>Your Schedule</center>
      </div>
      <div class="calendar mt-2" id ="mini-clndr">
      </div>
      <div class="mt-4 dashCardTitle dashMobTitle"> <center>Trainer Guidelines</center>
      </div>
      <div class="instructions-area dashCard dashMobInstrInner mt-2 pt-3 pb-3 mb-2 pr-2" style="font-size:14px">
      </div>

    </div>
  </div>

  <!-- row - visible only on mobile that'll contain carousel with pie and calendar-->

</div>

<script id="mini-clndr-template" type="text/template">
  <div class="controls">
    <div class="clndr-previous-button">&lsaquo;</div><div class="month"><%= month %> <%= year %></div><div class="clndr-next-button">&rsaquo;</div>
  </div>

  <div class="days-container">
    <div class="days">
      <div class="headers">
        <% _.each(daysOfTheWeek, function(day) { %><div class="day-header"><%= day %></div><% }); %>
      </div>
      <% _.each(days, function(day) { %><div class="<%= day.classes %>" id="<%= day.id %>"><%= day.day %></div><% }); %>
    </div>
    <div class="events">
      <div class="headers">
        <div class="x-button">x</div>
        <div class="event-header">Sessions</div>
      </div>
      <div class="events-list">
        <% _.each(eventsThisMonth, function(event) { %>
          <div class="event eventday event-<%=moment(event.date).format('YYYY-MM-DD')%>">
            <!--<a href="<%= event.url %>"><%=moment(event.date).format('Do') %>: <%= event.title %></a>-->
            <a href="<%= event.url %>"><%= event.title %></a>
          </div>
        <% }); %>
      </div>
    </div>
  </div>
</script>

<script>

var clndr = {};

$( function() {

  var assignments = <?php echo $allAssignments; ?>;
  var assignmentEvents = [];

  assignments.forEach(function (assignment, index) {
        var jsDate = moment(assignment.scheduledDateTimeLocal, 'YYYY-MM-DD H:m');
        var momentDate = moment(jsDate);
        var momentDateString = momentDate.format('YYYY-MM-DD');
        var momentTimeString = momentDate.format('h:mm A');
        var assignmentEvent = {
          date: momentDateString,
          title: assignment.traineeName+' @ '+momentTimeString,
          url: '#'
        };
        assignmentEvents.push(assignmentEvent);
  });

  var today = moment().format('YYYY-MM-DD');
  var tomm = moment().add(1, 'day').format('YYYY-MM-DD');

  var events = assignmentEvents;

  $('#mini-clndr').clndr({
    template: $('#mini-clndr-template').html(),
    daysOfTheWeek: ['Sun', 'Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat'],
    events: events,
    clickEvents: {
      click: function(target) {
        if(target.events.length) {
          var daysContainer = $('#mini-clndr').find('.days-container');
          daysContainer.toggleClass('show-events', true);
          var selectedClass = target.date.format('YYYY-MM-DD');
          $('.eventday').hide();
          $('.event-'+selectedClass).show();
          $('#mini-clndr').find('.x-button').click( function() {
            daysContainer.toggleClass('show-events', false);
          });
        }
      }
    },
    adjacentDaysChangeMonth: true,
    forceSixRows: true
  });
});
</script>

<script>
// set active link display in the menu bar
$('.dashLink').addClass("activeMenuLink");

</script>

<?php
  require "footer.php";
?>
