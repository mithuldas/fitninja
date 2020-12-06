$(document).ready(function(){
  populateUpcomingDivContent();
  populateTraineeDetailsDivContent();

  $("#trialSubmit").submit(function(event){
    event.preventDefault();
  });

  // click submit and validate everything
  //$('#trialSubmit').on('click', function(){
  //  console.log("hi");
  //});

});

function populateUpcomingDivContent(){

  var finalHTML ='';

  if(upcomingSessions.length>0){ // if there are upcoming sessions, display them in a table
    var title="<h6>Your upcoming sessions</h6>";
    var tableHeader=
    " <table id='upcomingSessions' class='table-sm table' style='width:100%'><thead>\
      <tr>\
      <th> Date and time </th>\
      <th> Activity </th>\
      <th> Trainee </th>\
      </tr><thead>";

    var tableBody='';
    var tableFooter =
    "</table>";

    upcomingSessions.forEach(function (session, index) {
      if(session.notes==null){
        session.notes='';
      }
      tableBody=tableBody+'<tr><td>'+session.scheduledDateTime+'</td><td>'+session.activity+'</td><td>'+session.traineeFirstName+'</td></tr>';
    });

    var finalUpcomingSessions = title+tableHeader+tableBody+tableFooter;
    finalHTML = finalHTML+finalUpcomingSessions;
  }

  $(".upcoming-sessions-area").html(finalHTML);

}

function populateTraineeDetailsDivContent(){
  var finalHTML ='';
  var title="<h6>Your Trainees</h6>";

  var tableHeader=
  " <table id='traineeList' class='table-sm table' style='width:100%'><thead>\
    <tr>\
    <th> Name </th>\
    <th> Age </th>\
    </tr><thead>";

  var tableBody='';
  var tableFooter =
  "</table>";


  trainees.forEach(function (trainee, index) {
    tableBody=tableBody+'<tr><td>'+trainee.firstName+' '+trainee.lastName+'</td><td>'+'99'+'</td></tr>';
  });

  var finalTraineeList = title+tableHeader+tableBody+tableFooter;
  finalHTML = finalHTML+finalTraineeList;
  $(".trainee-details").html(finalHTML);
}