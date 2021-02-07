<?php

require_once __DIR__.'/../config.php';
include ROOT_DIR."/includes/autoloader.php";
include ROOT_DIR."/includes/dbh.php";

FlowControl::startSession();
FlowControl::redirectIfNotLoggedIn();
FlowControl::redirectIfWrongUserType("Admin");


require ROOT_DIR."/header.php";


?>

<div class="container">
  <?php require ROOT_DIR."/admin/admin_subheader.php" ?>

<h4> Customer Data Form </h4><br>

<?php
if (Form::getCurrentFormVersion($conn)==1){
  ?>

<!-- form content front-end -->
<form action="/includes/process_customer_data_collector.php" method="post">

  <div class="row">
    <div class="form-group col-4 col-md-4">
      <label class="pt-2" for="date">1. Date: </label><br>
      <input id="date" type="text" name="1" class="form-control" required>
    </div>
  </div>
  <div class="row justify-content-center ">
    <div class="form-group col-4 col-md-4">
      <label class="pt-2" for="name">2. Name: </label><br>
      <input id="name" type="text" name="2" class="form-control" required>
    </div>
    <div class="form-group col-xs-4 col-md-4">
      <label class="pt-2" for="age">3. Age: </label><br>
      <input id="age" type="text" name="3" class="form-control" required>
    </div>
    <div class="form-group col-xs-4 col-md-4">
      <label class="pt-2" for="gender">4. Gender: </label><br>
      <input id="gender" type="text" name="4" class="form-control" required>
    </div>
  </div>

  <div class="row justify-content-center">
    <div class="form-group col-4 col-md-4">
      <label class="pt-2" for="weight">5. Weight (KG): </label><br>
      <input id="weight" type="text" name="5" class="form-control" required>
    </div>
    <div class="form-group col-xs-4 col-md-4">
      <label class="pt-2" for="height">6. Height (CM): </label><br>
      <input id="height" type="text" name="6" class="form-control" required>
    </div>
    <div class="form-group col-xs-4 col-md-4">
      <label class="pt-2" for="bmi">7. BMI: </label><br>
      <input id="bmi" type="text" name="7" class="form-control" required>
    </div>
  </div>

  <div class="row justify-content-center">
    <div class="form-group col-4 col-md-4">
      <label class="pt-2" for="package">8. Package Purchased: </label><br>
      <input id="package" type="text" name="8" class="form-control" required>
    </div>
    <div class="form-group col-xs-4 col-md-4">
      <label class="pt-2" for="formats">9. Workout Formats Selected </label><br>
      <input id="formats" type="text" name="9" class="form-control" required>
    </div>
    <div class="form-group col-xs-4 col-md-4">
      <label class="pt-2" for="yearsOfExercise">10. Years you have been exercising </label><br>
      <input id="yearsOfExercise" type="text" name="10" class="form-control" required>
    </div>
  </div>

  <div class="row justify-content-center">
    <div class="form-group col-4 col-md-4">
      <label class="pt-2" for="lifestyle">11. Lifestyle </label><br>
      <div class="form-check ">
        <input class="form-check-input" type="radio" name="11" id="sedentary" value="Sedentary">
        <label class="form-check-label" for="sedentary">
          Sedentary
        </label>
        <br>
        <input class="form-check-input" type="radio" name="11" id="moderately" value="Moderately Active">
        <label class="form-check-label" for="moderately">
          Moderately Active (1-2 / week)
        </label>
        <br>
        <input class="form-check-input" type="radio" name="11" id="active" value="Active">
        <label class="form-check-label" for="active">
          Active (>2 / week)
        </label>
        <br>
        <input class="form-check-input" type="radio" name="11" id="veryactive" value="Very Active">
        <label class="form-check-label" for="veryactive">
          Moderately Active (>4 / week)
        </label>
      </div>
    </div>
    <div class="form-group col-xs-4 col-md-4">
      <label class="pt-2" for="phone">12. Goals </label><br>
      <div class="form-check ">
        <input class="form-check-input" type="radio" name="12" id="weightLoss" value="Weight Loss">
        <label class="form-check-label" for="weightLoss">
          Weight Loss
        </label>
        <br>
        <input class="form-check-input" type="radio" name="12" id="muscle" value="Muscle Gain">
        <label class="form-check-label" for="muscle">
          Muscle Gain
        </label>
        <br>
        <input class="form-check-input" type="radio" name="12" id="flexibility" value="Flexibility">
        <label class="form-check-label" for="flexibility">
          Flexibility
        </label>
      </div>
    </div>
    <div class="form-group col-xs-4 col-md-4">
      <label class="pt-2" for="otherGoals">13. Other goals </label><br>
      <textarea class="form-control" id="otherGoals" rows="2" name="13" style="resize: none" placeholder=""></textarea>
    </div>
  </div>


  <div class="row justify-content-center">
    <div class="form-group col-xs-4 col-md-4">
      <label class="pt-2" for="medHist">14. Medical history, health concerns (Optional) </label><br>
      <textarea class="form-control" id="medHist" rows="2" name="14" style="resize: none" placeholder="" ></textarea>
    </div>
    <div class="form-group col-xs-4 col-md-4">
      <label class="pt-2" for="surgeriesInjuries">15. Recent surgeries or injuries (Optional)</label><br>
      <textarea class="form-control" id="surgeriesInjuries" rows="2" name="15" style="resize: none" placeholder="" ></textarea>
    </div>
    <div class="form-group col-xs-4 col-md-4">
      <label class="pt-2" for="activeMeds">16. Active Medications (Optional)</label><br>
      <textarea class="form-control" id="activeMeds" rows="2" name="16" style="resize: none" placeholder="" ></textarea>
    </div>


  </div>
  <div class="row">
    <div class="form-group col-xs-4 col-md-4">
      <label class="pt-2" for="restrictions">17. Restrictions (Optional) </label><br>
      <input id="restrictions" type="text" name="17" class="form-control" required>
    </div>
    <div class="form-group col-xs-4 col-md-4">
      <label class="pt-2" for="diet">18. Current Diet Type (Veg, Non-Veg etc...) </label><br>
      <input id="diet" type="text" name="18" class="form-control" required>
    </div>
  </div>
  <div class="row" align=center>
    <div class="form-group col-12">
      <button class="btn btn-primary blueButton mt-1" type="submit" name="submit">Submit</button>
    </div>
  </div>
</form>

  </div>
<?php
}
?>

</div>

<?php
  require ROOT_DIR."/footer.php";
?>
