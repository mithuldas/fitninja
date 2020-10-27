<?php

if(!isset($_SESSION)){
  session_start();
}

include "includes/autoloader.php";
include "includes/dbh.php";

  if(!isset($_SESSION['uid'])){
    header("Location: ../index.php");
    exit();
  }


  $uid = $_SESSION['uid'];

    $sql = 'select * from user_attributes where attribute_value = "Y" and attribute_id in
    (select attribute_id from user_attribute_definitions where attribute_name = "trainee_onboarding_completed") and uid = ' . $uid . ';';

    $stmt = mysqli_stmt_init($conn);

    if(!mysqli_stmt_prepare($stmt, $sql)){
      header("Location: ../index.php?error=sqlerror");
    }
    else{
      mysqli_stmt_execute($stmt);

      $result = mysqli_stmt_get_result($stmt);
      // if onboarding complete status is Y, then move them onto the dashboard
      if ($row = mysqli_fetch_assoc($result)){
          header("Location: trainee_dashboard.php");
          exit();
	   }

    }

    require "header.php";

?>



<body>
<div class="container">
  <h4> Welcome to FuNinja! Let's get you started:  </h4><br>
<div class="progress">
  <div id="progressbar" class="progress-bar" role="progressbar" style="width: 10%;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
</div>


<div class="card">
<div class="card-body tab-content">


    <form id= "regForm" method="post" action="includes/trainee_landing_submit_form.php" >

  <!-- Schedule preferences entry

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



</div>
-->

  <!-- Interests tab -->
    <div class="tab">

      <h6>Which of the activities below are you interested in?</h6>
      <hr>

      <div class="row">
      <div class="col">
      <label for="aerobics" class="float-right">Aerobics</label>
      </div>
      <div class="col">
      <input type="checkbox" class="float-left activity mt-1 " id="aerobics" name="activities[]" value="aerobics">
      </div>
      </div>
      <div class="row">
      <div class="col">
      <label for="zumba" class="float-right">Zumba</label>
      </div>
      <div class="col">
      <input type="checkbox" class="float-left activity mt-1" id="zumba" name="activities[]" value="zumba">
      </div>
      </div>
      <div class="row">
      <div class="col">
      <label for="yoga" class="float-right">Yoga</label>
      </div>
      <div class="col">
      <input type="checkbox" class="float-left activity mt-1" id="yoga" name="activities[]" value="yoga">
      </div>
      </div>
      <div class="row">
      <div class="col">
      <label for="meditation" class="float-right">Meditation</label>
      </div>
      <div class="col">
      <input type="checkbox" class="float-left activity mt-1" id="meditation" name="activities[]" value="meditation">
      </div>
      </div>
      <div class="row">
      <div class="col">
      <label for="reiki" class="float-right">Reiki</label>
      </div>
      <div class="col">
      <input type="checkbox" class="float-left activity mt-1" id="reiki" name="activities[]" value="reiki">
      </div>
      </div>

      <div class="row">
      <div class="col">
      <label for="calisthenics" class="float-right">Calisthenics</label>
      </div>
      <div class="col">
      <input type="checkbox" class="float-left activity mt-1" id="calisthenics" name="activities[]" value="calisthenics">
      </div>
      </div>

      <div class="row">
      <div class="col">
      <label for="toning" class="float-right">Toning</label>
      </div>
      <div class="col">
      <input type="checkbox" class="float-left activity mt-1" id="toning" name="activities[]" value="toning">
      </div>
      </div>
      </div>



<!-- Personal info entry -->
<div class="tab">
  <h6>Tell us a bit more about yourself </h6>
  <div class="form-group small text-muted">
    Your personal data will be stored securely and will not be shared outside of FuNinja.in
  </div>
<div class="row">
<div class="col-md-3">
  <label for="fname" class="float-left mt-1">First Name</label>
</div>
<div class="col-md-3"><input type="text" class="form-control " placeholder="First name" id="fname" name="fname">
</div>
<div class="col-md-3">
  <label for="lname" class="float-left mt-1">Last Name</label>
</div>
<div class="col-md-3">
  <input id="lname" type="text" class="form-control" placeholder="Last name" id="lname" name="lname">
</div>
</div>

<div class="row">
<div class="col-md-3">


  <label for="fname" class="float-left mt-1">Date of birth</label>
</div>
<div class="col-md-3">

  <input class="form-control" type="date"  id="dob" name="dob">
</div>
<div class="col-md-3">
  <label for="lname" class="float-left">City</label>
</div>
<div class="col-md-3">
      <input type="text" class="form-control" id="location" placeholder="City" name="city">
</div>
</div>

<div class="row">
<div class="col-md-3">
        <label for="phonenumber" class="float-left mt-1">Phone number</label>
</div>
<div class="col-md-3"><input type="text" class="form-control" id="phonenumber" placeholder="Phone number" name="phonenumber">
</div>
<div class="col-md-3">
  <label for="lname" class="float-left mt-1">Gender</label>
</div>
<div class="col-md-3">

  <div class="form-check form-check-inline float-left">
<input class="form-check-input mt-2" type="radio" id="male" value="Male" name="gender">
<label class="form-check-label mt-2" for="male">Male</label>
</div>
<div class="form-check form-check-inline float-left">
<input class="form-check-input mt-2" type="radio" id="female" value="Female" name="gender">
<label class="form-check-label mt-2" for="female">Female</label>
</div>

</div>
</div>

</div>
</div>

  <div class="form-group small text-muted " id="errorMsg">  </div>
  <div style="overflow:auto;">
    <div style="float:right;">
      <button type="button" id="prevBtn" class="btn btn-primary" onclick="nextPrev(-1)">Previous</button>
      <button type="button" id="nextBtn" class="btn btn-primary" onclick="nextPrev(1)" name = "trainee_landing_submit">Next</button>
    </div>
  </div>

  </form>

<script src="scripts/trainee_landing_user_input.js"></script>

</div>
</div>

</div>
</body>
</div>

<?php
  require "footer.php";
?>
