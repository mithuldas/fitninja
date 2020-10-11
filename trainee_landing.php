
<?php

  include "includes/autoloader.php";
  require "header.php";

  if(!isset($_SESSION['uid'])){
    header("Location: ../index.php");
  }


?>



<body>
<div class="container">
  <h4> Welcome to FitNinja! Let's get you started:  </h4><br>
<div class="progress">
  <div id="progressbar" class="progress-bar" role="progressbar" style="width: 10%;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
</div>


<div class="card">
<div class="card-body tab-content">


    <form id= "regForm">

  <!-- Schedule preferences entry -->

  <div class="tab">
  <h6>When do you typically prefer to have your sessions?</h6>

  <hr>

  <div class="row">
  <div class="col-md-3"><strong>Days of the week</strong></label>
</div>
  <div class="col-md-3" >
    <input type="checkbox" name="weekday-mon" id="weekday-mon" class="daypreference"/>
    <label for="weekday-mon">Mon</label><br>
    <input type="checkbox" name="weekday-tue" id="weekday-tue" class="daypreference"/>
    <label for="weekday-tue">Tue</label><br>
    <input type="checkbox" name="weekday-wed" id="weekday-wed" class="daypreference"/>
    <label for="weekday-wed">Wed</label><br>
    <input type="checkbox" name="weekday-thu" id="weekday-thu" class="daypreference"/>
    <label for="weekday-thu">Thu</label><br>
    <input type="checkbox" name="weekday-fri" id="weekday-fri" class="daypreference"/>
    <label for="weekday-fri">Fri</label><br>
    <input type="checkbox" name="weekday-sat" id="weekday-sat" class="daypreference"/>
    <label for="weekday-sat">Sat</label><br>
    <input type="checkbox" name="weekday-sun" id="weekday-sun" class="daypreference"/>
    <label for="weekday-sun">Sun</label><br>


  </div>
  <div class="col-md-3"><strong>Timeslot</strong></div>
  <div class="col-md-3">
    <input type="checkbox" id="morning" name="morning" class="timeslot"/>
      <label for="morning">Morning</label><br>
      <input type="checkbox" id="afternoon" name="afternoon" class="timeslot" />
      <label for="afternoon">Afternoon</label><br>
      <input type="checkbox" id="evening" name="evening" class="timeslot" />
      <label for="evening">Evening</label>
  </div>
  </div>
<br>
  <div class="form-group small text-muted " id="errorMsg"><br>

  </div>
</div>


  <!-- Interests tab -->
    <div class="tab">

      <h6>Which of the activities below are you interested in?</h6>
      <hr>

      <div class="form-group">
      <div class="row">
      <div class="col">
      <label for="aerobics" class="float-right">Aerobics</label>
      </div>
      <div class="col">
      <input type="checkbox" class="float-left auto-width" id="aerobics">
      </div>
      </div>
      <div class="row">
      <div class="col">
      <label for="zumba" class="float-right">Zumba</label>
      </div>
      <div class="col">
      <input type="checkbox" class="float-left auto-width" id="zumba">
      </div>
      </div>
      <div class="row">
      <div class="col">
      <label for="yoga" class="float-right">Yoga</label>
      </div>
      <div class="col">
      <input type="checkbox" class="float-left" id="yoga">
      </div>
      </div>
      <div class="row">
      <div class="col">
      <label for="meditation" class="float-right">Meditation</label>
      </div>
      <div class="col">
      <input type="checkbox" class="float-left" id="meditation">
      </div>
      </div>
      <div class="row">
      <div class="col">
      <label for="reiki" class="float-right">Reiki</label>
      </div>
      <div class="col">
      <input type="checkbox" class="float-left" id="reiki">
      </div>
      </div>

      <div class="row">
      <div class="col">
      <label for="calisthenics" class="float-right">Calisthenics</label>
      </div>
      <div class="col">
      <input type="checkbox" class="float-left" id="calisthenics">
      </div>
      </div>

      <div class="row">
      <div class="col">
      <label for="toning" class="float-right">Toning</label>
      </div>
      <div class="col">
      <input type="checkbox" class="float-left" id="toning">
      </div>
      </div>

      </div>
      </div>



<!-- Personal info entry -->
<div class="tab">
  <h6>Tell us a bit more about yourself </h6>
  <div class="form-group small text-muted">
    Your presonal data will be stored securely and will not be shared outside of FitNinja.in
  </div>
<div class="row">
<div class="col-md-3">
  <label for="fname" class="float-left">First Name</label>
</div>
<div class="col-md-3"><input type="text" class="form-control " placeholder="First name" id="fname">
</div>
<div class="col-md-3">
  <label for="lname" class="float-left">Last Name</label>
</div>
<div class="col-md-3">
  <input id="lname" type="text" class="form-control" placeholder="Last name" id="lname">
</div>
</div>

<div class="row">
<div class="col-md-3">
  <label for="fname" class="float-left">Date of birth</label>
</div>
<div class="col-md-3"><input class="form-control" type="date"  id="dob" >
</div>
<div class="col-md-3">
  <label for="lname" class="float-left">City</label>
</div>
<div class="col-md-3">
      <input type="text" class="form-control" id="location" placeholder="City">
</div>
</div>

<div class="row">
<div class="col-md-3">
        <label for="phonenumber" class="float-left">Phone number</label>
</div>
<div class="col-md-3"><input type="text" class="form-control" id="phonenumber" placeholder="Phone number">
</div>
<div class="col-md-3">
  <label for="lname" class="float-left">Gender</label>
</div>
<div class="col-md-3">

  <div class="form-check form-check-inline float-left">
<input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio1" value="option1">
<label class="form-check-label" for="inlineRadio1">Male</label>
</div>
<div class="form-check form-check-inline float-left">
<input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio2" value="option2">
<label class="form-check-label" for="inlineRadio2">Female</label>
</div>

</div>
</div>

</div>
</div>


  <div style="overflow:auto;">
    <div style="float:right;">
      <button type="button" id="prevBtn" class="btn btn-primary" onclick="nextPrev(-1)">Previous</button>
      <button type="button" id="nextBtn" class="btn btn-primary" onclick="nextPrev(1)">Next</button>
    </div>
  </div>

  </form>

<script src="scripts/landing_user_input.js"></script>

</div>
</div>

</div>
</body>
</div>

<?php
  require "footer.php";
?>
