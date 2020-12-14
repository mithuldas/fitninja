<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta charset="utf-8">
<?php

require_once __DIR__.'/vendor/autoload.php';
require_once __DIR__.'/config.php';
require_once ( ROOT_DIR.'/includes/autoloader.php' );
require_once ( ROOT_DIR.'/includes/dbh.php' );




FlowControl::startSession();
FlowControl::redirectIfNotLoggedIn();
FlowControl::redirectIfWrongUserType("Trainee");


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

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<link href="/css/custom.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/underscore@1.12.0/underscore-min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>
<script src="ext_scripts/clndr.min.js"></script>
<link rel="stylesheet/less" type="text/css" href="/css/clndr.less" />
<script src="https://cdn.jsdelivr.net/npm/less/dist/less.min.js" ></script>
<br><br>
<div class="" id ="mini-clndr">
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
        var jsDate = new Date(assignment.scheduledDateTimeLocal);
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
});
</script>
