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

if($_SESSION['userType']!="Trainee"){
  header("Location: includes/post_login_landing_controller.php");
  exit();
}
?>

<?php
require "header.php";

$currentUser = new Trainee($_SESSION['uid'], $conn);
$allAssignments = json_encode($currentUser->getAllAssignments($conn));
$upcomingSessions=json_encode($currentUser->getUpcomingSessions(3, $conn));
$currentUserJSON = json_encode($currentUser);
$trialActivities = json_encode(Product::getActivities($conn));
$unassignedProducts = json_encode($currentUser->getUnassignedProducts($conn));
$trainers = json_encode($currentUser->getTrainerList($conn));
?>

<script src="https://cdn.jsdelivr.net/npm/underscore@1.12.0/underscore-min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>
<script src="ext_scripts/clndr.min.js"></script>
<link rel="stylesheet/less" type="text/css" href="/css/clndr.less" />
<script src="//cdn.jsdelivr.net/npm/less" ></script>

<script type="text/javascript">
  var currentUser = <?php echo $currentUserJSON; ?>;
  var productListForTrial = <?php echo $trialActivities; ?>;
  var upcomingSessions = <?php echo $upcomingSessions; ?>;
  var unassignedProducts = <?php echo $unassignedProducts; ?>;
  var trainers = <?php echo $trainers; ?>;
</script>


<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/chart.js@2.9.4/dist/Chart.min.js"> </script>
<script type="text/javascript" src="scripts/trainee_dashboard.js"> </script>

<div class="container-fluid">

  <!-- row 1 - Welcome banner on pc and mob-->

  <div class="row">
    <div class="col-md">
      <div class="welcome-banner">
        <center>Welcome back, <?php echo $currentUser->firstName;?>! </center>
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
      <div class="progressArea">
        <canvas id="myChart"></canvas>
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
      <div class="trainer-facts">
      Trainer info here
      </div>
    </div>
    <div class="col-md">
      <div class="calendar" id ="mini-clndr">
      </div>
    </div>
  </div>


</div>

<script id="mini-clndr-template" type="text/template">
  <div class="controls">
    <div class="clndr-previous-button">&lsaquo;</div><div class="month"><%= month %></div><div class="clndr-next-button">&rsaquo;</div>
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
            <a href="<%= event.url %>"><%=moment(event.date).format('MMMM Do') %>: <%= event.title %></a>
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
        var jsDate = new Date(assignment.scheduledDateTime);
        var momentDate = moment(jsDate);
        var momentDateString = momentDate.format('YYYY-MM-DD');
        var momentTimeString = momentDate.format('hh:mm A');
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
});
</script>

<?php
  require "footer.php";
?>
