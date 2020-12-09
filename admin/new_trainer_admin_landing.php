<?php

include_once __DIR__.'/../config.php';
require_once ROOT_DIR.'/includes/dbh.php';
include_once (ROOT_DIR.'/includes/autoloader.php');

FlowControl::startSession();

//delete cookie if exists and log-out
if(isset($_SESSION['uid']) && isset($_COOKIE['FuNinja'])){
  $extractDataFromCookie = explode(':', $_COOKIE["FuNinja"], 2);
  $selector = $extractDataFromCookie[0] ;
  $validator =  $extractDataFromCookie[1];
  Token::deleteToken($selector, $conn);
}

session_unset();
session_destroy();

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



require ROOT_DIR."/header.php";

$email = "";
$username = "";

if(isset($_GET['email'])){
  $email = $_GET['email'];
}

if(isset($_GET['uid'])){
  $username = $_GET['uid'];
}

  $months = ['Jan','Feb','Mar','Apr','May','Jun','Jul','Aug','Sep','Oct','Nov','Dec'];
  $activityNames=Activity::getAllActivityNames($conn);
?>

<div class="container">
    <center><h4>New Trainer Onboarding</h4></center>
    <center><small>Fill in the details below to get started. All fields are mandatory. </small></center>
<form action="/includes/process_new_trainer_or_admin_onboarding_form.php" method="post">
  <input type="hidden" name="type" value="<?php echo $_GET["type"]; ?>" />
  <input type="hidden" name="selector" value="<?php echo $_GET["selector"]; ?>" />
  <input type="hidden" name="validator" value="<?php echo $_GET["validator"]; ?>" />
  <input type="hidden" name="zoomID" value="<?php echo $_GET["zoomID"]; ?>" />
  <h6 id = "statusMessage"> </h6>
  <div class="row">
    <div class="form-group col-xs-4 col-md-4">
      <label class="pt-2" for="phone">1. What do you train? Select at least 1. </label><br>
      <?php
        foreach ($activityNames as $activityName) {
          echo "
          <input  type='checkbox' value='$activityName' id='$activityName' name='$activityName'>
          <label class='form-check-label' for='$activityName'> $activityName </label>
          <br>
          ";
        }
      ?>
    </div>
  </div>
  <div class="row">
    <div class="form-group col-xs-4 col-md-4">
      <label for="uid">2. Select a username</label>
      <input id="uid" type="text" name="uid" class="form-control" value="<?php echo $username; ?>" required>
    </div>
    <div class="form-group col-xs-4 col-md-4">
      <label for="email">3. Email</label>
      <input id="email" type="email" name="email" class="form-control" value="<?php echo $email; ?>" required autofocus readonly>
    </div>
  </div>
  <div class="row">
    <div class="form-group col-xs-4 col-md-4">
      <label for="firstName">4. First name</label>
      <input id="firstName" type="text" name="firstName" class="form-control" required>
    </div>
    <div class="form-group col-xs-4 col-md-4">
      <label for="lastName">5. Last name</label>
      <input type="text" name="lastName" class="form-control" required>
    </div>

  </div>
  <div class="row">
    <div class="form-group col-xs-4 col-md-4">
      <label for="gender">4. Gender</label>
      <select id="gender" class="form-control" name="gender">
        <option>Female</option>
        <option>Male</option>
      </select>
    </div>
    <div class="form-group col-xs-4 col-md-4">
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
  <div class="row">
    <div class="form-group col-xs-4 col-md-4">
      <label for="phone">8. Phone number</label>
      <input id="phone" type="text" name="phone" class="form-control" required>
    </div>
    <div class="form-group col-xs-4 col-md-4">
      <label for="city">9. Town/City</label>
      <input id="city" type="text" name="city" class="form-control" value="<?php echo $api_result->city; ?>" required>
    </div>
  </div>
  <div class="row">
    <div class="form-group col-xs-4 col-md-4">
      <label for="phone">10. Password</label>
      <input id="pwd" type="password" name="pwd" class="form-control" required>
    </div>
    <div class="form-group col-xs-4 col-md-4">
      <label for="pwd-repeat">11. Repeat your password</label>
      <input id="pwd-repeat" type="password" name="pwd-repeat" class="form-control" required>
    </div>
  </div>
  <div class="row">
    <div class="form-group col-xs-4 col-md-4">
      <button class="btn btn-primary mt-1" type="submit" name="signup-onboard-submit">Begin</button>
    </div>
  </div>
</form>
</div>


<?php
  require ROOT_DIR."/footer.php";
?>

<script>
  $('#statusMessage').hide();
    var status = "<?php echo($_GET['status']); ?>";

    if (status == "emptyfields"){
      $('#statusMessage').slideDown();
      $('#statusMessage').html('<h6 style="color:red"> Fill in all fields </h6');
    } else if (status == "noactivities") {
      $('#statusMessage').show();
      $('#statusMessage').html('<h6 style="color:red"> Pick at least one activity that you can train </h6');
    } else if (status == "invalidemailuid") {
      $('#statusMessage').show();
      $('#statusMessage').html('<h6 style="color:red"> Enter a valid username and e-mail ID. Your username must be at least 6 characters long, must only have letters, numbers, _ and . </h6');
    } else if (status == "invalidemail") {
      $('#statusMessage').show();
      $('#statusMessage').html('<h6 style="color:red">Please enter a valid e-mail ID </h6>');
    } else if (status == "invalidUsernameChars") {
      $('#statusMessage').show();
      $('#statusMessage').html('<h6 style="color:red">Your username must be at least 6 characters long, must only have letters, numbers, _ and . </h6>');
    } else if (status == "usernameTooShort") {
      $('#statusMessage').show();
      $('#statusMessage').html('<h6 style="color:red">Your username must be at least 6 characters long </h6>');
    } else if (status == "pwdMismatch") {
      $('#statusMessage').show();
      $('#statusMessage').html('<h6 style="color:red"> Passwords do not match </h6');
    } else if (status == "tooShort") {
      $('#statusMessage').show();
      $('#statusMessage').html('<h6 style="color:red"> Password must contain at least 8 characters </h6');
    } else if (status == "username_taken") {
      $('#statusMessage').show();
      $('#statusMessage').html('<h6 style="color:red"> This username is already in use. Please choose another one. </h6');
    } else if (status == "emailexists") {
      $('#statusMessage').show();
      $('#statusMessage').html('<h6 style="color:red"> User with this e-mail already exists. Would you like to <a href="/forgot-password.php"><u> reset your password </u></a> instead? </h6');
    } else if (status == "invalidlink") {
      $('#statusMessage').show();
      $('#statusMessage').html('<h6 style="color:red"> Your link is no longer valid. Please get in touch with the support team. </h6');
    } else if (status == "sqlerror") {
      $('#statusMessage').show();
      $('#statusMessage').html('<h6 style="color:red"> There was an error in the database. Please contact our support team. </h6');
    }
</script>
