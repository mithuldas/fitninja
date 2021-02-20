<?php
include_once "config.php";
require_once ROOT_DIR.'/includes/dbh.php';
include_once ( ROOT_DIR.'/includes/autoloader.php' );

FlowControl::startSession();
FlowControl::redirectIfNotLoggedIn();
FlowControl::redirectIfWrongUserType("Trainee");

include_once ROOT_DIR."/includes/auto_login.php";
?>

<?php


// set IP address and API access key
$ip = $_SERVER['REMOTE_ADDR'];
$access_key = '7357bacb1c74bb8f04932b04277611b6';

// Initialize CURL:
$ch = curl_init('http://api.ipstack.com/'.$ip.'?access_key='.$access_key.'');
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

// Store the data:
$json = curl_exec($ch);
curl_close($ch);

// Decode JSON response:
$api_result = json_decode($json, false);

$trainee = new Trainee($_SESSION['uid'],$conn);

if($trainee->onboardingComplete){
  header("Location: trainee_dashboard.php");
  exit();
}

$months = ['Jan','Feb','Mar','Apr','May','Jun','Jul','Aug','Sep','Oct','Nov','Dec'];

$activityNames=Activity::getAllActivityNames($conn);

?>

<!DOCTYPE html>
<html lang='en'>
<head>
  <title> Welcome! - FuNinja </title>
  <?php
  require ROOT_DIR."/includes/frameworks.php";
  ?>
</head>

<body>
  <?php
  include ROOT_DIR."/header.php";
  ?>
<div class="container">
  <div class="row justify-content-center p-0 m-0">
    <div class="col-md-8 p-0 m-0">

      <h5 class="m-0 mt-3">Let's get you started</h5>
    </div>
  </div>
<div class="row justify-content-center">

  <div class="col-md-8 dashCard m-3">

<form action="/includes/trainee_landing_submit_form.php" method="post">
  <div class="row justify-content-center mt-3">

    <div class="form-group col-xs-4 col-md-4">

      <label class="pt-2" for="phone">1. Interests: </label><br>
      <?php
        foreach ($activityNames as $activityName) {
          if($activityName=="Slimnastics"){
            echo "
            <input  type='checkbox' value='$activityName' id='$activityName' name='$activityName'>
            <label class='form-check-label' for='$activityName' style='font-size:13px'> $activityName * </label>
            <br>
            ";
          } else{
          echo "
          <input  type='checkbox' value='$activityName' id='$activityName' name='$activityName'>
          <label class='form-check-label' for='$activityName' style='font-size:13px'> $activityName </label>
          <br>
          ";
          }
        }
      ?>

    </div>
    <div class="col-xs-4 col-md-4">

    </div>

  </div>
  <div class="row justify-content-center">
    <div class="form-group col-xs-4 col-md-4">
      <label for="firstName">2. First name</label>
      <input id="firstName" type="text" name="firstName" class="form-control" required>
    </div>
    <div class="form-group col-xs-4 col-md-4">
      <label for="lastName">3. Last name</label>
      <input type="text" name="lastName" class="form-control" required>
    </div>

  </div>
  <div class="row justify-content-center">
    <div class="form-group col-xs-4 col-md-4">
      <div class="row pl-3">
        <label for="gender">4. Gender</label>
      </div>
      <div class="row form-inline pl-3">
      <input  type='radio' value='Male' id='maleGender' name='gender' class="mr-1" required>
      <label for="maleGender" class="mr-3" style='font-size:13px'>Male</label>
      <input  type='radio' value='Female' id='femaleGender' name='gender' class="mr-1" required>
      <label for="femaleGender" class="mr-3" style='font-size:13px'>Female</label>
      <input  type='radio' value='Other' id='otherGender' name='gender' class="mr-1" required>
      <label for="otherGender" style='font-size:13px'>Other</label>
    </div>
    </div>
    <div class="form-group col-md-4">
      <div class="row pl-3">
        <label for="dobDay">5. Date of Birth</label>
      </div>
      <div class="row form-inline pl-3">
      <input id="dobDay" type="text" name="dobDay" class="form-control mr-1" placeholder="DD" required style="width: 50px">
      <select class="form-control mr-1" name="dobMonth" style="width: 75px">
        <?php
        foreach ($months as $value) {
          echo "<option>".$value."</option>";
        }
        ?>
      </select>
      <input id="dobYear" type="text" name="dobYear" class="form-control" placeholder="YYYY" style="width: 70px" required>
    </div>
  </div>
</div>
  <div class="row justify-content-center">
    <div class="form-group col-xs-4 col-md-4">
      <label for="phone">6. Phone number</label>
      <input id="phone" type="text" name="phone" class="form-control" required>
      <small> Format e.g: 9123456789 </small>
    </div>
    <div class="form-group col-xs-4 col-md-4">
      <label for="city">7. Town/City</label>
      <input id="city" type="text" name="city" class="form-control" required value="<?php echo $api_result->city; ?>">
    </div>
  </div>
  <div class="row" align=center>
    <div class="form-group col-12">
      <button class="btn btn-primary blueButton mt-1" type="submit" name="trainee_landing_submit">Begin</button>
    </div>
  </div>
  <div class="row" align=left>
    <div class="form-group col-12">
      <small>* Our very own toning and weight loss offering</small>
    </div>
  </div>
</form>
</div>
</div>
</div>


<?php
  require "footer.php";
?>
