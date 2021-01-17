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
      <a href=\"/request_trial.php\" class=\"btn btn-primary btn mt-3\
      \" id =\"loginButton\"> Request a Free Trial </a>\
      ");
  } else if (currentUser.activePlan.productName=="Trial" && currentUser.trialCompleted){
    var finalHTML ="<p>Now that you\'ve completed your trial, we would love to hear your <a href=\"contact.php\">feedback.</a></p>\
    <p> Explore <a href=\"about_us.php\">FuNinja,</a> our <a href=\"offerings.php\">Offerings</a> and exciting <a href=\"plans.php\">Membership Plans </a></p>";

  } else {

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
        <th class='cell100 column3 upcoming'> Trainer </th>\
        </tr></thead>\
        </table>\
        </div>";

      var tableBody='';
      var tableFooter =
      "</table>";

        upcomingSessions.forEach(function (session, index) {
          //var jsDate = new Date(session.scheduledDateTimeLocal);
          var jsDate = moment(session.scheduledDateTimeLocal, 'YYYY-MM-DD H:m');
          var momentDate = moment(jsDate);
          var momentDateString = momentDate.format('ddd D MMM');
          var momentTimeString = momentDate.format('h:mm A');

          tableBody=tableBody+'<tr class=\'row100 body\'><td class="cell100 column1 upcoming">'+momentDateString+' @ '+ momentTimeString+'</td><td class="cell100 column2 upcoming">'+session.duration+' mins'+'</td><td class="cell100 column3 upcoming">'+session.activity+'</td><td class="cell100 column4 upcoming">'+session.trainerFirstName+'</td></tr>';
        });
        tableBodyHeader = '<div class=\'table100-body\'><table class="mb-4"><tbody>';
        tableBodyFooter = '</tbody></table></div></div>';

        tableBodyFinal=tableBodyHeader+tableBody+tableBodyFooter;

      var finalUpcomingSessions = tableHeader+tableBodyFinal;
      finalHTML = finalHTML+finalUpcomingSessions;
    }

    if(unassignedProducts.length>0){ // if there are products that haven't been scheduled yet, display them next

      var tableHeader=
      " <div class='table100'>\
        <div class='table100-head'>\
        <table id='unassignedProducts'><thead>\
        <tr class='row100 head'>\
        <th class='cell100 column1 unassigned'> Session </th>\
        <th class='cell100 column2 unassigned'> Requested </th>\
        <th class='cell100 column3 unassigned'> Status </th>\
        </tr></thead>\
        </table>\
        </div>";
        tableBody='';
        unassignedProducts.forEach(function (product, index) {
          var productValidFromDate = moment(product.validFrom, 'YYYY-MM-DD H:m');
          var momentDate = moment(productValidFromDate);
          var momentDateString = momentDate.format('D MMM');


          tableBody=tableBody+'<tr class=\'row100 body\'><td class="cell100 column1 unassigned">'+product.productName+'</td><td class="cell100 column2 unassigned">'+momentDateString+'</td><td class="cell100 column3 unassigned">'+'We\'re working on finding you the right trainer'+'</td></tr>';

        });

        tableBodyHeader = '<div class=\'table100-body\'><table><tbody>';
        tableBodyFooter = '</tbody></table></div></div>';

        tableBodyFinal=tableBodyHeader+tableBody+tableBodyFooter;
        var finalUnassignedProducts = tableHeader+tableBodyFinal;
        finalHTML=finalHTML+finalUnassignedProducts;

    }



  }

  $(".upcoming-sessions-area").html(finalHTML);
}

function populateTrainerDetailsDivContent(){

  if(trainers.length>0){
    var finalHTML ='';
    var tableHeader=
    " <div class='table100'>\
      <div class='table100-head'>\
      <table id='trainerList'><thead>\
      <tr class='row100 head'>\
      <th class='cell100 column1 trainerlist'> Name </th>\
      <th class='cell100 column2 trainerlist'> Specialization </th>\
      </tr></thead>\
      </table>\
      </div>";

    var tableBody='';

    trainers.forEach(function (trainer, index) {
      tableBody=tableBody+'<tr class=\'row100 body\'><td class="cell100 column1 trainerlist">'+trainer.firstName+' '+trainer.lastName+'</td><td class="cell100 column2 trainerlist">'+trainer.qualifiedActivitiesString+'</td></tr>';

    });

    tableBodyHeader = '<div class=\'table100-body\'><table><tbody>';
    tableBodyFooter = '</tbody></table></div></div>';

    tableBodyFinal=tableBodyHeader+tableBody+tableBodyFooter;

    var finalTrainerList = tableHeader+tableBodyFinal;

    finalHTML = finalHTML+finalTrainerList;
    $(".trainer-facts").html(finalHTML);
  } else {
    var finalHTML ='';
    finalHTML = '<p>Trainers that have been assigned to you will be listed here. </p>Learn more <a href="/about_us.php">About FuNinja</a>, our <a href="/offerings.php">Offerings</a> and our exciting <a href="/plans.php">Membership Plans.</a>';
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

    var status = completedSessionsForPie+' of ' +(completedSessionsForPie+scheduledSessionsForPie+unscheduledSessionsForPie)+' complete';

    if(currentUser.activePlan.productName=="Trial" && currentUser.activePlan.sessionsScheduled==0 && !currentUser.trialCompleted){
      var status = "Trial Requested";
    }

    if(currentUser.activePlan.productName=="Trial" && currentUser.activePlan.sessionsScheduled==1 && !currentUser.trialCompleted){
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
    var donutNextDate = moment(currentUser.nextSession.scheduledDateTimeLocal, 'YYYY-MM-DD H:m');
    var momentDate = moment(donutNextDate);
    var momentDateString = momentDate.format('D MMM') + ' at ' + momentDate.format('h:mm A');
    var donutCenterText = status;
  }


  var chart = new Chart(ctx, {
    // The type of chart we want to create
    type: 'pie',

    // The data for our dataset
    data: {
        labels: ['Completed', 'Scheduled', 'Unscheduled'],
        datasets: [{
            backgroundColor: ['#00BA7C','blue','lightgrey'],
            borderColor: ['white','white','white'],
            borderWidth: [3,3,3],
            data: [completedSessionsForPie, scheduledSessionsForPie, unscheduledSessionsForPie],
        }]
    },

    // Configuration options go here
    options: {
      elements: {
  center: {
    text: donutCenterText,
    color: 'black', // Default is #000000
    fontStyle: 'Arial', // Default is Arial
    sidePadding: 20, // Default is 20 (as a percentage)
    minFontSize: 20, // Default is 20 (in px), set to false and text will not wrap.
    lineHeight: 25 // Default is 25 (in px), used for when text wraps
  }
},

      cutoutPercentage: 70,
      title: {
        display: false,
        text: status,
        position: 'bottom',
    },
    legend: {
     onClick: (e) => e.stopPropagation(),
     labels: {
                fontColor: "500472"
              }

 }
    }
});

// donut for mobile

var ctxMobile = document.getElementById('myMobileChart').getContext('2d');

if(!currentUser.nextSession){
  var donutCenterText = status;
} else {
  var donutNextDate = moment(currentUser.nextSession.scheduledDateTimeLocal, 'YYYY-MM-DD H:m');
  var momentDate = moment(donutNextDate);
  var momentDateString = momentDate.format('D MMM') + ' at ' + momentDate.format('h:mm A');
  var donutCenterText = status;
}


var chart = new Chart(ctxMobile, {
  // The type of chart we want to create
  type: 'pie',

  // The data for our dataset
  data: {
      labels: ['Completed', 'Scheduled', 'Unscheduled'],
      datasets: [{
          backgroundColor: ['#79cbb8','#500472','white'],
          borderColor: ['black','black','black'],
          data: [completedSessionsForPie, scheduledSessionsForPie, unscheduledSessionsForPie],
      }]
  },

  // Configuration options go here
  options: {
    elements: {
center: {
  text: donutCenterText,
  color: '#500472', // Default is #000000
  fontStyle: 'Arial', // Default is Arial
  sidePadding: 20, // Default is 20 (as a percentage)
  minFontSize: 15, // Default is 20 (in px), set to false and text will not wrap.
  lineHeight: 25 // Default is 25 (in px), used for when text wraps
}
},

    cutoutPercentage: 70,
    title: {
      display: false,
      text: status,
      position: 'bottom',
  },
  legend: {
   onClick: (e) => e.stopPropagation(),
   labels: {
              fontColor: "#500472"
            }
},
  }
});

}
