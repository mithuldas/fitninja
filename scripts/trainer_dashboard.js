$(document).ready(function(){

  populateUpcomingDivContent();
  populateTraineeDetailsDivContent();
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
    var finalHTML = "<ol>\
      <li> Wear your FuNinja T-Shirt. </li>\
      <li> Log-in to the Fitness Room 5 minutes before the session and greet your trainee. </li>\
      <li> Marking your trainees attendance with the FuNinja Fitness Manager to mark the session complete and receive payment for your time. </li>\
      <li> Ensure compliance to the FuNinja Terms and Conditions.</li>\
    </ol>";

    $(".instructions-area").html(finalHTML);
}


function populateUpcomingDivContent(){

  var finalHTML ='';

  if(upcomingSessions.length>0){ // if there are upcoming sessions, display them in a table

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

  var finalUpcomingSessions = tableHeader+tableBodyFinal;
  finalHTML = finalHTML+finalUpcomingSessions;
} else {
  finalHTML = "You don't have any upcoming sessions yet.";
}

  $(".upcoming-sessions-area").html(finalHTML);

}

function populateTraineeDetailsDivContent(){

  var finalHTML ='';

  if(trainees.length>0){
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

    var finalTrainerList = tableHeader+tableBodyFinal;

    finalHTML = finalHTML+finalTrainerList;
    $(".trainee-details").html(finalHTML);
  } else {
    finalHTML = '<p>Trainees that have been assigned to you will be listed here.</p> While we get you started and assign trainees and sessions to you, feel free to learn more <a href=\'offerings.php\'> About FuNinja </a> and <a href=\'contact.php\'>Get In Touch</a> with us if you have any questions.';
    $(".trainee-details").html(finalHTML);
    console.log("hello");
  }



}
