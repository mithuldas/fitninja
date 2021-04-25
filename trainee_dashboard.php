<?php
include_once "config.php";
include_once ( ROOT_DIR.'/includes/autoloader.php' );

FlowControl::startSession();
FlowControl::redirectIfNotLoggedIn();
FlowControl::redirectIfWrongUserType("Trainee");
include_once ROOT_DIR."/includes/auto_login.php";
?>

<!DOCTYPE html>
<html lang='en'>
<head>
  <title> Dashboard - FuNinja </title>
  <?php
  require ROOT_DIR."/includes/frameworks.php";
  ?>
</head>

<body>
<?php
include ROOT_DIR."/header.php";


$currentUser = new Trainee($_SESSION['uid'], $conn);
$allAssignments = json_encode($currentUser->getAllAssignments($conn));
$upcomingSessions=$currentUser->getUpcomingSessions(3, $conn);

foreach ($upcomingSessions as $upcomingSession) {
  $upcomingSession->initTrainerDetails($conn);
}

$upcomingSessions=json_encode($upcomingSessions);

$currentUserJSON = json_encode($currentUser);
$unassignedProducts = json_encode($currentUser->getUnassignedProducts($conn));
$trainers = json_encode($currentUser->getTrainerList($conn));
?>

<script src="https://cdn.jsdelivr.net/npm/underscore@1.12.0/underscore-min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>
<script src="ext_scripts/clndr.min.js"></script>
<link href="/css/clndr.css" rel="stylesheet">

<script type="text/javascript">
  var currentUser = <?php echo $currentUserJSON; ?>;
  var upcomingSessions = <?php echo $upcomingSessions; ?>;
  var unassignedProducts = <?php echo $unassignedProducts; ?>;
  var trainers = <?php echo $trainers; ?>;
</script>


<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/chart.js@2.9.4/dist/Chart.min.js"> </script>
<script type="text/javascript" src="scripts/trainee_dashboard.js"> </script>

<div class="container-fluid containerReducePadding">

  <a id="yourFormsMobBtn" class="btn btn-sm yourFormsBtn hide-on-nonmobile" href="/profile.php#plans" > <i class='fas fa-paperclip mr-1'></i> Your Forms </a>

  <!-- row 2 - contains two columns -
    col 1 to contain upcoming sessions and below it, the progress donut
    col 2 to contain the calendar and below it, the trainers list
  -->

  <div class="row">
    <div class="col-lg m-3 mt-4 mobileDiv">
      <!-- row 1 - Welcome banner on pc and mob-->
      <div class="welcome-banner mb-4">
        <h5 class="welcomeText p-0 m-0" >Hi <?php echo $currentUser->firstName;?>, </h5>
        <h5 class="p-0 m-0 welcomeText"> This is your FuNinja dashboard</h5>
        <small class="hide-on-mobile">You can find your upcoming sessions, progress data, your full schedule and details of your trainers here.</small>
      </div>
      <div class="pb-2 dashCardTitle dashMobTitle">Upcoming Sessions
      </div>
      <div class="upcoming-sessions-area p-3 dashCard dashMobTitle dashMobTextInner" align="left">
      </div>
      <div class=" mt-4 dashCardTitle dashMobTitle"> Your Trainers
      </div>
        <div class="trainer-facts dashCard p-3 pb-3 mt-2 dashMobTextInner" align="left">
        Trainer info here
        </div>

        <div class=" mt-4 hide-on-nonmobile dashCardTitle dashMobTitle"> Your Schedule
        </div>
      <div class="row mt-2 hide-on-nonmobile">
          <div id ="mini-clndr"> </div>
      </div>

      <div class=" mt-4 hide-on-nonmobile dashCardTitle dashMobTitle"> Your Plan
      </div>
      <div class="row pt-4, pb-4 hide-on-nonmobile dashMobTitle">
        <div class="col-lg mt-2 ml-3 mr-3 dashCard">
          <canvas id="myMobileChart" ></canvas>
        </div>
      </div>

    </div>
    <div class="col-lg m-3 mt-4">
      <div class="hide-on-mobile">
        <center><a class="btn yourFormsBtn mb-4" href="/profile.php#plans"> <i class='fas fa-paperclip mr-1'></i> Your Forms </a></center>
        <br>
      </div>

      <div class=" hide-on-mobile dashCardTitle"> <center>Your Schedule</center>
      </div>
      <div class=" hide-on-mobile mb-3 mt-2" >
      <div class="calendar hide-on-mobile " id ="large-clndr">
      </div>
      <center><div class="mt-4 hide-on-mobile dashCardTitle"> Your Plan
      </div>
      <div class="progressArea hide-on-mobile pt-3 pb-3 mt-2 mb-2 dashCard" style="width:500px">
        <canvas id="myChart"></canvas>
      </div></center>
    </div>

    </div>
  </div>



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
        <div class="event-header">Session details</div>
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
          title: assignment.activity+' @ '+momentTimeString,
          url: '#'
        };
        assignmentEvents.push(assignmentEvent);
  });

  var today = moment().format('YYYY-MM-DD');
  var tomm = moment().add(1, 'day').format('YYYY-MM-DD');

  var events = assignmentEvents;

  $('#mini-clndr').clndr({
    daysOfTheWeek: ['Sun', 'Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat'],
    template: $('#mini-clndr-template').html(),
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

  $('#large-clndr').clndr({
    daysOfTheWeek: ['Sun', 'Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat'],
    template: $('#mini-clndr-template').html(),
    events: events,
    clickEvents: {
      click: function(target) {
        if(target.events.length) {
          var daysContainer = $('#large-clndr').find('.days-container');
          daysContainer.toggleClass('show-events', true);
          var selectedClass = target.date.format('YYYY-MM-DD');
          $('.eventday').hide();
          $('.event-'+selectedClass).show();
          $('#large-clndr').find('.x-button').click( function() {
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

<script>
  btnWidth=$('#yourFormsMobBtn').width();
  console.log(btnWidth);
  $("#yourFormsMobBtn").css({"right":20});


</script>

<?php
  require "footer.php";
?>
