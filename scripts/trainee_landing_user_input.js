var currentTab = 0; // Current tab is set to be the first tab (0)
var totalTabs = document.getElementsByClassName("tab").length;


showTab(currentTab); // Display the current tab

function showTab(n) {
  // This function will display the specified tab of the form ...

  document.getElementById("errorMsg").innerHTML="";
  var x = document.getElementsByClassName("tab");

  x[n].style.display = "block";
  // ... and fix the Previous/Next buttons:
  if (n == 0) {
    document.getElementById("prevBtn").style.display = "none";
  } else {
    document.getElementById("prevBtn").style.display = "inline";
  }
  if (n == (x.length - 1)) {
    document.getElementById("nextBtn").innerHTML = "Submit";
  } else {
    document.getElementById("nextBtn").innerHTML = "Next";
  }

  updateProgressBar(n);

}

function nextPrev(n) {

  // This function will figure out which tab to display
  var x = document.getElementsByClassName("tab");
  // Exit the function if any field in the current tab is invalid:
  if (n == 1 && !validateForm()) return false;
  // Hide the current tab:
  x[currentTab].style.display = "none";
  // Increase or decrease the current tab by 1:
  currentTab = currentTab + n;
  // if you have reached the end of the form... :

    if (currentTab >= x.length) {
    //...the form gets submitted:
    document.getElementById("nextBtn").setAttribute("type", "submit");
    document.getElementById("regForm").submit();
    return false;
  }
  // Otherwise, display the correct tab:
  showTab(currentTab);
}



function getNumChecked(checkBoxList){
  var checkedBoxList = [];

  for(var i=0; i<checkBoxList.length; i++){
      if(checkBoxList[i].checked){
        checkedBoxList.push(checkBoxList[i]);
      }
  }

  return checkedBoxList.length;

}


function validateForm() {

  // This function deals with validation of the form fields
  var x, y, i, valid = true;
  x = document.getElementsByClassName("tab");
  y = x[currentTab].getElementsByTagName("input");
  // A loop that checks every input field in the current tab:
  for (i = 0; i < y.length; i++) {
    // If a field is empty...
    if (y[i].value == "") {
      // add an "invalid" class to the field:
      y[i].className += " invalid";
      // and set the current valid status to false:
      valid = false;

    }





  }

var numDayChecked = getNumChecked(document.getElementsByClassName("daypreference"));
var numTimeslotChecked = getNumChecked(document.getElementsByClassName("timeslot"));
var errorMsg = document.getElementById("errorMsg");
var numActivitiesChecked = getNumChecked(document.getElementsByClassName("activity"))


/*   if(numDayChecked==0){
    valid = false;
    errorMsg.innerHTML='<P class="text-danger"> * Please select at least one preferred day</p> ';
  }

  if(numTimeslotChecked==0){
    valid = false;
    errorMsg.innerHTML= '<P class="text-danger">* Please select at least one preferred timeslot</p> ';
  }

  if(numDayChecked==0 && numTimeslotChecked==0){
    valid = false;
    document.getElementById("errorMsg").innerHTML= '<P class="text-danger">* Please select at least one preferred day and timeslot</p> ';
  }
*/
  if(numActivitiesChecked==0 && currentTab==0){
    valid = false;
    document.getElementById("errorMsg").innerHTML= '<P class="text-danger">* Please select at least one activity</p> ';

    console.log(document.getElementsByClassName("activity"));
  }







  return valid; // return the valid status
}

function updateProgressBar(n){
  n=n+1;
  percentage = (n/totalTabs)*100 + "%";

  x=document.getElementById("progressbar");
  document.getElementById("progressbar").style.width=percentage;


}
