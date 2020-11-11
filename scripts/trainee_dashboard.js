$(document).ready(function(){
  populateUpcomingDivContent();

  $("#trialSubmit").submit(function(event){
    event.preventDefault();
  });

  // click submit and validate everything
  //$('#trialSubmit').on('click', function(){
  //  console.log("hi");
  //});

});

function populateUpcomingDivContent(){
  if(currentUser.isNew){
    $(".upcoming-sessions-area").html
      ("You don't have any upcoming sessions yet. \
      <br><small>Your next session will always appear here,\
      </small><br>\
      <a onclick=\"viewTrialForm()\" class=\"btn btn-primary btn-sm btn mr mb\
      \" id =\"loginButton\"> Request a Free Trial </a>\
      <a href=\"membership.php\" class=\"btn btn-primary btn-sm btn mr mb\
      \" id =\"loginButton\"> Membership </a>\
      ");
  } else {
    $(".upcoming-sessions-area").html("Existing user");
  }
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
    availableDates.push(days[newDate.getDay()]+' '+newDate.getDate()+' '+months[newDate.getMonth()]);
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
      }
    }
  });
}





//You don't have any scheduled sessions yet. <br>
//<button type="button" class="btn btn-primary btn-sm btn mr-1 mb-1" data-toggle="modal" data-target="#exampleModal" id ="registerButton"> SCHEDULE A FREE TRIAL</button>
