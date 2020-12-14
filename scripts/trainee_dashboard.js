$(document).ready(function(){
  populateUpcomingDivContent();
  populateProgressDivContent();
  populateTrainerDetailsDivContent();


});

function populateUpcomingDivContent(){
  if(currentUser.isNew){
    $(".upcoming-sessions-area").html
      ("You don't have any upcoming sessions yet. \
      <br>\
      <a href=\"/request_trial.php\" class=\"btn btn-primary btn-sm btn mr mb\
      \" id =\"loginButton\"> Request a Free Trial </a>\
      ");
  } else if (currentUser.activePlan.productName=="Trial" && currentUser.trialCompleted){
    var finalHTML ="<p>Now that you\'ve completed your trial, we would love to hear your <a href=\"contact.php\">feedback.</a></p>\
    <p> Explore <a href=\"about_us.php\">FuNinja,</a> our <a href=\"trainers.php\">Trainers</a> and our exciting <a href=\"plans.php\">Membership Plans </a></p>";

  } else {

    var finalHTML ='';

    if(upcomingSessions.length>0){ // if there are upcoming sessions, display them in a table
      var title="<h6>Your upcoming sessions</h6>";
      var tableHeader=
      " <table id='upcomingSessions' class='table-sm table' style='width:100%'><thead>\
        <tr>\
        <th> Date and time </th>\
        <th> Duration </th>\
        <th> Activity </th>\
        <th> Trainer </th>\
        </tr><thead>";

      var tableBody='';
      var tableFooter =
      "</table>";

        upcomingSessions.forEach(function (session, index) {
          var jsDate = new Date(session.scheduledDateTimeLocal);
          var momentDate = moment(jsDate);
          var momentDateString = momentDate.format('ddd D MMM');
          var momentTimeString = momentDate.format('h:mm A');
          tableBody=tableBody+'<tr><td>'+momentDateString+' @ '+ momentTimeString+'</td><td>'+session.duration+' minutes'+ '</td><td>'+session.activity+'<td>'+session.trainerFirstName+'</td></td></tr>';
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
        <th> Added On </th>\
        <th> Status </th>\
        </tr><thead>";

      var tableBody='';
      var tableFooter =
      "</table>";

        unassignedProducts.forEach(function (product, index) {
          var productValidFromDate = new Date(product.validFrom);
          var momentDate = moment(productValidFromDate);
          var momentDateString = momentDate.format('Do MMM');
          tableBody=tableBody+'<tr><td>'+product.productName+'</td><td>'+momentDateString+'</td><td>'+'We\'re working on finding you the right trainer'+'</td></tr>';
        });

        var finalUnassignedProducts = title+tableHeader+tableBody+tableFooter;
        finalHTML=finalHTML+finalUnassignedProducts;
    }



  }

  $(".upcoming-sessions-area").html(finalHTML);
}

function populateTrainerDetailsDivContent(){

  if(trainers.length>0){
    var finalHTML ='';
    var title="<h6>Your Trainers</h6>";

    var tableHeader=
    " <table id='trainerList' class='table-sm table' style='width:100%'><thead>\
      <tr>\
      <th> Name </th>\
      <th> Specialization </th>\
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
  } else {
    var finalHTML ='';
    finalHTML = '<center>Explore <a href="/about_us.php">FuNinja,</a> our <a href="/trainers.php">Trainers</a> and our exciting <a href="/plans.php">Membership Plans </a></center>';
    $(".trainer-facts").html(finalHTML);
  }


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

  if(!currentUser.activePlan){
    var completedSessionsForPie=0
    var scheduledSessionsForPie=0;
    var unscheduledSessionsForPie=1;
    var status = "Kickstart Your Fitness Journey";
  } else {
    var completedSessionsForPie=currentUser.activePlan.sessionsCompleted;
    var scheduledSessionsForPie=currentUser.activePlan.sessionsScheduled-completedSessionsForPie;
    var unscheduledSessionsForPie=currentUser.activePlan.totalSessions-currentUser.activePlan.sessionsScheduled;

    var status = completedSessionsForPie+' out of ' +(completedSessionsForPie+scheduledSessionsForPie+unscheduledSessionsForPie)+' sessions completed';

    if(currentUser.activePlan.productName=="Trial" && !currentUser.trialCompleted){
      var status = "Trial Scheduled";
    }

    if(currentUser.activePlan.productName=="Trial" && currentUser.trialCompleted){
      var status = "Trial Completed";
    }
  }

// donut for desktop view
  var ctx = document.getElementById('myChart').getContext('2d');

  if(!currentUser.nextSession){
    var donutCenterText = status;
  } else {
    var donutNextDate = new Date(currentUser.nextSession.scheduledDateTimeLocal);
    var momentDate = moment(donutNextDate);
    var momentDateString = momentDate.format('Do MMM') + ' at ' + momentDate.format('h:mm A');
    var donutCenterText = status;
  }


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
        display: false,
        text: status,
        position: 'bottom',
    },
    legend: {
     onClick: (e) => e.stopPropagation()
 }
    }
});

// donut for mobile

var ctxMobile = document.getElementById('myMobileChart').getContext('2d');

if(!currentUser.nextSession){
  var donutCenterText = status;
} else {
  var donutNextDate = new Date(currentUser.nextSession.scheduledDateTimeLocal);
  var momentDate = moment(donutNextDate);
  var momentDateString = momentDate.format('Do MMM') + ' at ' + momentDate.format('h:mm A');
  var donutCenterText = status;
}


var chart = new Chart(ctxMobile, {
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
      display: false,
      text: status,
      position: 'bottom',
  },
  legend: {
   onClick: (e) => e.stopPropagation()
},
  }
});

}
