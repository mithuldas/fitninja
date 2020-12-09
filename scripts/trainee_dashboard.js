$(document).ready(function(){
  populateUpcomingDivContent();
  populateProgressDivContent();
  populateTrainerDetailsDivContent();

  $("#trialSubmit").submit(function(event){
    event.preventDefault();
  });

  // click submit and validate everything
  //$('#trialSubmit').on('click', function(){
  //  console.log("hi");
  //});

});

function populateUpcomingDivContent(){
  console.log(upcomingSessions);
  if(currentUser.isNew){
    $(".upcoming-sessions-area").html
      ("You don't have any upcoming sessions yet. \
      <br><small>Your next session will always appear here,\
      </small><br>\
      <a onclick=\"viewTrialForm()\" class=\"btn btn-primary btn-sm btn mr mb\
      \" id =\"loginButton\"> Request a Free Trial </a>\
      <a href=\"plans.php\" class=\"btn btn-primary btn-sm btn mr mb\
      \" id =\"loginButton\"> Membership </a>\
      ");
  } else {

    var finalHTML ='';

    if(upcomingSessions.length>0){ // if there are upcoming sessions, display them in a table
      var title="<h6>Your upcoming sessions</h6>";
      var tableHeader=
      " <table id='upcomingSessions' class='table-sm table' style='width:100%'><thead>\
        <tr>\
        <th> Date and time </th>\
        <th> Activity </th>\
        <th> Trainer </th>\
        </tr><thead>";

      var tableBody='';
      var tableFooter =
      "</table>";

        upcomingSessions.forEach(function (session, index) {
          var jsDate = new Date(session.scheduledDateTimeLocal);
          var momentDate = moment(jsDate);
          var momentDateString = momentDate.format('Do MMM');
          var momentTimeString = momentDate.format('h:mm A');
          tableBody=tableBody+'<tr><td>'+momentDateString+' @ '+ momentTimeString+'</td><td>'+session.activity+'<td>'+session.trainerFirstName+'</td></td></tr>';
        });

      var finalUpcomingSessions = title+tableHeader+tableBody+tableFooter;
      finalHTML = finalHTML+finalUpcomingSessions;
    }

    if(unassignedProducts.length>0){ // if there are products that haven't been scheduled yet, display them next
      var title="<h6> Unscheduled Plans</h6>";
      var tableHeader=
      " <table id='unassignedProducts' class='table-sm table' style='width:100%'><thead>\
        <tr>\
        <th> Type </th>\
        <th> Date Added </th>\
        <th> Status </th>\
        </tr><thead>";

      var tableBody='';
      var tableFooter =
      "</table>";

        unassignedProducts.forEach(function (product, index) {
          tableBody=tableBody+'<tr><td>'+product.productName+'</td><td>'+product.validFrom+'</td><td>'+'We\'re working on finding you the right trainer'+'</td></tr>';
        });

        var finalUnassignedProducts = title+tableHeader+tableBody+tableFooter;
        finalHTML=finalHTML+finalUnassignedProducts;
    }


    $(".upcoming-sessions-area").html(finalHTML);
  }
}

function populateTrainerDetailsDivContent(){
  var finalHTML ='';
  var title="<h6>Your Trainers</h6>";

  var tableHeader=
  " <table id='trainerList' class='table-sm table' style='width:100%'><thead>\
    <tr>\
    <th> Name </th>\
    <th> Speciality </th>\
    </tr><thead>";

  var tableBody='';
  var tableFooter =
  "</table>";


  trainers.forEach(function (trainer, index) {
    tableBody=tableBody+'<tr><td>'+trainer.firstName+' '+trainer.lastName+'</td><td>'+trainer.qualifiedActivitiesString+'</td></tr>';
  });

  var finalTrainerList = title+tableHeader+tableBody+tableFooter;
  finalHTML = finalHTML+finalTrainerList;
  $(".trainer-facts").html(finalHTML);
}


function populateProgressDivContent(){

  Chart.pluginService.register({
  beforeDraw: function(chart) {
    if (chart.config.options.elements.center) {
      // Get ctx from string
      var ctx = chart.chart.ctx;

      // Get options from the center object in options
      var centerConfig = chart.config.options.elements.center;
      var fontStyle = centerConfig.fontStyle || 'Arial';
      var txt = centerConfig.text;
      var color = centerConfig.color || '#000';
      var maxFontSize = centerConfig.maxFontSize || 75;
      var sidePadding = centerConfig.sidePadding || 20;
      var sidePaddingCalculated = (sidePadding / 100) * (chart.innerRadius * 2)
      // Start with a base font of 30px
      ctx.font = "30px " + fontStyle;

      // Get the width of the string and also the width of the element minus 10 to give it 5px side padding
      var stringWidth = ctx.measureText(txt).width;
      var elementWidth = (chart.innerRadius * 2) - sidePaddingCalculated;

      // Find out how much the font can grow in width.
      var widthRatio = elementWidth / stringWidth;
      var newFontSize = Math.floor(30 * widthRatio);
      var elementHeight = (chart.innerRadius * 2);

      // Pick a new font size so it will not be larger than the height of label.
      var fontSizeToUse = Math.min(newFontSize, elementHeight, maxFontSize);
      var minFontSize = centerConfig.minFontSize;
      var lineHeight = centerConfig.lineHeight || 25;
      var wrapText = false;

      if (minFontSize === undefined) {
        minFontSize = 20;
      }

      if (minFontSize && fontSizeToUse < minFontSize) {
        fontSizeToUse = minFontSize;
        wrapText = true;
      }

      // Set font settings to draw it correctly.
      ctx.textAlign = 'center';
      ctx.textBaseline = 'middle';
      var centerX = ((chart.chartArea.left + chart.chartArea.right) / 2);
      var centerY = ((chart.chartArea.top + chart.chartArea.bottom) / 2);
      ctx.font = fontSizeToUse + "px " + fontStyle;
      ctx.fillStyle = color;

      if (!wrapText) {
        ctx.fillText(txt, centerX, centerY);
        return;
      }

      var words = txt.split(' ');
      var line = '';
      var lines = [];

      // Break words up into multiple lines if necessary
      for (var n = 0; n < words.length; n++) {
        var testLine = line + words[n] + ' ';
        var metrics = ctx.measureText(testLine);
        var testWidth = metrics.width;
        if (testWidth > elementWidth && n > 0) {
          lines.push(line);
          line = words[n] + ' ';
        } else {
          line = testLine;
        }
      }

      // Move the center up depending on line height and number of lines
      centerY -= (lines.length / 2) * lineHeight;

      for (var n = 0; n < lines.length; n++) {
        ctx.fillText(lines[n], centerX, centerY);
        centerY += lineHeight;
      }
      //Draw text in center
      ctx.fillText(line, centerX, centerY);
    }
  }
});

  var completedSessionsForPie=currentUser.activePlan.sessionsCompleted;
  var scheduledSessionsForPie=currentUser.activePlan.sessionsScheduled-completedSessionsForPie;
  var unscheduledSessionsForPie=currentUser.activePlan.totalSessions-currentUser.activePlan.sessionsScheduled;

  var title = ['Completed: ' + completedSessionsForPie, 'Remaining: ' + (scheduledSessionsForPie+unscheduledSessionsForPie)];
  var ctx = document.getElementById('myChart').getContext('2d');
  console.log(currentUser.nextSession);
  var donutCenterText = "Next: "+currentUser.nextSession.scheduledDateTimeLocal+' ('+currentUser.nextSession.activity+')';

  var chart = new Chart(ctx, {
    // The type of chart we want to create
    type: 'pie',

    // The data for our dataset
    data: {
        labels: ['Completed', 'Scheduled', 'Unscheduled'],
        datasets: [{
            backgroundColor: ['rgb(255, 99, 132)','grey'],
            borderColor: ['rgb(255, 99, 132)','grey'],
            data: [completedSessionsForPie, scheduledSessionsForPie, unscheduledSessionsForPie],
        }]
    },

    // Configuration options go here
    options: {
      elements: {
  center: {
    text: donutCenterText,
    color: '#FF6384', // Default is #000000
    fontStyle: 'Arial', // Default is Arial
    sidePadding: 20, // Default is 20 (as a percentage)
    minFontSize: 20, // Default is 20 (in px), set to false and text will not wrap.
    lineHeight: 25 // Default is 25 (in px), used for when text wraps
  }
},

      cutoutPercentage: 80,
      title: {
        display: true,
        text: title,
        position: 'bottom',
    },
    legend: {
     onClick: (e) => e.stopPropagation()
 }
    }
});

}




function viewTrialForm(){ // form with the following options - type dropdown, date dropdown with the next 5 days, and preferred timeslot dropdown
  $(".upcoming-sessions-area").html("<form id=\"requestTrialForm\">\
    <div class=\"form-group\">\
      <label for=\"typeSelect\">Type:</label> <small> Which trial are you interested in? </small>\
      <select class=\"form-control\" id=\"typeSelect\">\
      </select>\
      <label for=\"dateSelect\">Date:</label> <small> Pick from the list of available dates </small>\
      <select class=\"form-control\" id=\"dateSelect\">\
      </select>\
      <label for=\"timeSlot\">Time:</label><small> This is just a guideline. Don't worry, one of us will get in touch with you to finalize a timeslot.</small>\
      <select class=\"form-control\" id=\"timeSlot\">\
      </select>\
       <button type=\"submit\" class=\"btn btn-primary\" id=\"trialSubmit\" name=\"trialSubmit\" onclick=\"submitTrialRequestForm()\">Submit Request</button>\
    </div>\
  </form>");

  $("#requestTrialForm").submit(false);

  var date = new Date();
  var days = ['Sun','Mon','Tue','Wed','Thu','Fri','Sat'];
  var months = ['Jan','Feb','Mar','Apr','May','Jun','Jul','Aug','Sep','Oct','Nov','Dec'];


  var newDate = new Date();

  var availableDates=[];
  var timeSlots = ['9 AM - 12 PM', '12 PM - 3 PM', '3 PM - 6 PM','6 PM - 9 PM'];

  var i;

  for(i=1; i<=5; i++){
    newDate.setDate(date.getDate()+i);
    availableDates.push(days[newDate.getDay()]+' '+newDate.getDate()+' '+months[newDate.getMonth()]+' '+newDate.getFullYear());
  }


  var typeSelect = document.getElementById('typeSelect');
  for(var i = 0; i < productListForTrial.length; i++) {
    var opt = document.createElement('option');
    opt.innerHTML = productListForTrial[i];
    opt.value = productListForTrial[i];
    typeSelect.appendChild(opt);
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

}

function submitTrialRequestForm(){

  $("#trialSubmit").prop('disabled', true);

  var trialType = $("#typeSelect").val();
  var trialDate = $("#dateSelect").val();
  var trialTimeSlot = $("#timeSlot").val();

  $.ajax({
    url: '/includes/submit_trial_request.php',
    type: 'post',
    data: {
      'currentUser' : currentUser,
      'trialType': trialType,
      'trialDate' : trialDate,
      'trialTimeSlot' : trialTimeSlot
    },
    timeout:5000, //5 second timeout
    error: function(xmlhttprequest, textstatus, message){
      if(textstatus==="timeout"){
        $("#errorMsg").text("The server didn't respond. Try clicking submit again...");
      }

    },
    success: function(response){
      if(response=="success"){
        currentUser.isNew=false;
        populateUpcomingDivContent();
        var successMessage = "We've received your request for a "+trialType+" trial for "+trialDate+ " between "+trialTimeSlot+". Sit tight and one of us will be in touch!";
        alert(successMessage);
        window.location.href = "/trainee_dashboard.php";
      }
    }
  });
}





//You don't have any scheduled sessions yet. <br>
//<button type="button" class="btn btn-primary btn-sm btn mr-1 mb-1" data-toggle="modal" data-target="#exampleModal" id ="registerButton"> SCHEDULE A FREE TRIAL</button>
