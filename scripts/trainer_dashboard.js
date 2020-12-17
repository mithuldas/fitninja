$(document).ready(function(){
  populateUpcomingDivContent();

  if(trainees.length>0){
    populateTraineeDetailsDivContent();
  }

  populateInstructionsDivContent();

  $("#trialSubmit").submit(function(event){
    event.preventDefault();
  });

  // click submit and validate everything
  //$('#trialSubmit').on('click', function(){
  //  console.log("hi");
  //});

});

function populateInstructionsDivContent(){
    var finalHTML = "<center><h5 class='tableTitle'>Things to keep in mind </h5> </center>\
    <ol>\
      <li> Wear your FuNinja t shirt while conducting a FuNinja session </li>\
      <li> Ensure logging into Fitness Room N mins prior to the session </li>\
      <li> Ensure marking your trainees attendance with the FuNinja Fitness Manager to ensure session is marked complete </li>\
      <li> Ensure complete confidentiality of FuNinja T&C under the NDA signed with us since we like to have healthy working relationships </li>\
    </ol>";

    $(".instructions-area").html(finalHTML);
}


function populateUpcomingDivContent(){

  var finalHTML ='';

  if(upcomingSessions.length>0){ // if there are upcoming sessions, display them in a table
    var title="<h6 class='tableTitle'>Your upcoming sessions</h6>";

    var tableHeader=
    " <div class='table100'>\
      <div class='table100-head'>\
      <table id='upcomingSessions'><thead>\
      <tr class='row100 head'>\
      <th class='cell100 column1 upcoming'> Date and time </th>\
      <th class='cell100 column2 upcoming'> Duration </th>\
      <th class='cell100 column3 upcoming'> Activity </th>\
      <th class='cell100 column3 upcoming'> Trainee </th>\
      </tr></thead>\
      </table>\
      </div>";

    var tableBody='';
    var tableFooter =
    "</table>";

    upcomingSessions.forEach(function (session, index) {
      var jsDate = moment(session.scheduledDateTimeLocal, 'YYYY-MM-DD H:m')
      var momentDate = moment(jsDate);
      var momentDateString = momentDate.format('ddd D MMM');
      var momentTimeString = momentDate.format('h:mm A');
      tableBody=tableBody+'<tr class=\'row100 body\'><td class="cell100 column1 upcoming">'+momentDateString+' @ '+ momentTimeString+'</td><td class="cell100 column2 upcoming">'+session.duration+' mins'+'</td><td class="cell100 column3 upcoming">'+session.activity+'</td><td class="cell100 column4 upcoming">'+session.traineeFirstName+'</td></tr>';
    });
    tableBodyHeader = '<div class=\'table100-body\'><table><tbody>';
    tableBodyFooter = '</tbody></table></div></div>';

    tableBodyFinal=tableBodyHeader+tableBody+tableBodyFooter;

  var finalUpcomingSessions = title+tableHeader+tableBodyFinal;
  finalHTML = finalHTML+finalUpcomingSessions;
} else {
  finalHTML = "<P class='tableTitle'> Welcome to FuNinja.</P> <P> While we get you started and assign trainees and sessions to you, feel free to <a href='offerings.php'>GET TO KNOW US </a> better and <a href='contact.php'>GET IN TOUCH</a> with us if you have any questions </P>";
}

  $(".upcoming-sessions-area").html(finalHTML);

}

function populateTraineeDetailsDivContent(){
  var finalHTML ='';
  var title="<center><h6 class='tableTitle'>Your Trainees</h6></center>";

  var tableHeader=
  " <div class='table100'>\
    <div class='table100-head'>\
    <table id='traineeList'><thead>\
    <tr class='row100 head'>\
    <th class='cell100 column1 traineelist'> Name </th>\
    <th class='cell100 column2 traineelist'> Gender </th>\
    <th class='cell100 column2 traineelist'> Age </th>\
    <th class='cell100 column2 traineelist'> Completed </th>\
    </tr></thead>\
    </table>\
    </div>";

  var tableBody='';

  trainees.forEach(function (trainee, index) {
    var age = moment().diff(trainee.dateOfBirth, 'years');
    var trainerStats = trainee.activePlan.trainerStats;
    var progressContent = '';
    trainerStats.forEach(function (stat, index) {
      if(stat.uid==currentUser.uid){
        progressContent = progressContent + stat.completedSessions + ' of ' + stat.totalSessions;
      }
    });

    tableBody=tableBody+'<tr class=\'row100 body\'><td class="cell100 column1 traineelist">'+trainee.firstName+' '+trainee.lastName+'</td><td class="cell100 column2 traineelist">'+trainee.gender+'</td><td class="cell100 column3 traineelist">'+age+'</td><td class="cell100 column4 traineelist">'+progressContent+'</td></tr>';

  });

  tableBodyHeader = '<div class=\'table100-body\'><table><tbody>';
  tableBodyFooter = '</tbody></table></div></div>';
  tableBodyFinal=tableBodyHeader+tableBody+tableBodyFooter;

  var finalTrainerList = title+tableHeader+tableBodyFinal;

  finalHTML = finalHTML+finalTrainerList;
  $(".trainee-details").html(finalHTML);

}
