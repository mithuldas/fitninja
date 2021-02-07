<?php

require_once __DIR__.'/../config.php';
include ROOT_DIR."/includes/autoloader.php";
include ROOT_DIR."/includes/dbh.php";

FlowControl::startSession();
FlowControl::redirectIfNotLoggedIn();
FlowControl::redirectIfWrongUserType("Admin");


require ROOT_DIR."/header.php";

$session = new Session(json_decode($_POST['session'])->id, $conn);

$trainee = new Trainee($session->uid, $conn);

$userProductId = $session->getUserProductId($conn);
if(Form::checkIfFormForUserProductExists($userProductId, $conn)){
  $mode="Update";
  $form = new Form($userProductId, $conn);
} else {
  $mode="New";
}

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
      <input id="date" type="text" name="1" class="form-control" required <?php
      if($mode=="New"){
        $date = date("d-m-Y");
        echo " value='$date'";
      } else if ($mode=="Update"){
        $answer=$form->answers[0];
        echo " value='$answer'";
      }?>
      >
    </div>
  </div>
  <div class="row justify-content-center ">
    <div class="form-group col-4 col-md-4">
      <label class="pt-2" for="name">2. Name: </label><br>
      <input id="name" type="text" name="2" class="form-control" required readonly <?php
      if($mode=="New"){
        $name = $trainee->fullName;
        echo " value='$name'";
      } else if ($mode=="Update"){
        $answer=$form->answers[1];
        echo " value='$answer'";
      }?>
      >
    </div>
    <div class="form-group col-xs-4 col-md-4">
      <label class="pt-2" for="age">3. Age: </label><br>
      <input id="age" type="text" name="3" class="form-control" required readonly <?php
      if($mode=="New"){
        $from = new DateTime($trainee->dateOfBirth);
        $to = new DateTime('today');
        $age = $from->diff($to)->y;
        echo " value='$age'";
      } else if ($mode=="Update"){
        $answer=$form->answers[2];
        echo " value='$answer'";
      }?>
      >
    </div>
    <div class="form-group col-xs-4 col-md-4">
      <label class="pt-2" for="gender">4. Gender: </label><br>
      <input id="gender" type="text" name="4" class="form-control" required readonly <?php
      if($mode=="New"){
        $gender = $trainee->gender;
        echo " value='$gender'";
      } else if ($mode=="Update"){
        $answer=$form->answers[3];
        echo " value='$answer'";
      }?>
      >
    </div>
  </div>

  <div class="row justify-content-center">
    <div class="form-group col-4 col-md-4">
      <label class="pt-2" for="weight">5. Weight (KG): </label><br>
      <input id="weight" type="text" name="5" class="form-control" required <?php
      if ($mode=="Update"){
        $answer=$form->answers[4];
        echo " value='$answer'";
      }?>
      >
    </div>
    <div class="form-group col-xs-4 col-md-4">
      <label class="pt-2" for="height">6. Height (CM): </label><br>
      <input id="height" type="text" name="6" class="form-control" required <?php
      if ($mode=="Update"){
        $answer=$form->answers[5];
        echo " value='$answer'";
      }?>>
    </div>
    <div class="form-group col-xs-4 col-md-4">
      <label class="pt-2" for="bmi">7. BMI: </label><br>
      <input id="bmi" type="text" name="7" class="form-control" required <?php
      if ($mode=="Update"){
        $answer=$form->answers[6];
        echo " value='$answer'";
      }?>>
    </div>
  </div>

  <div class="row justify-content-center">
    <div class="form-group col-4 col-md-4">
      <label class="pt-2" for="package">8. Package Purchased: </label><br>
      <input id="package" type="text" name="8" class="form-control" required readonly <?php
      if($mode=="New"){
        echo " value='$session->productName'";
      } else if ($mode=="Update"){
        $answer=$form->answers[7];
        echo " value='$answer'";
      }?>
      >
    </div>
    <div class="form-group col-xs-4 col-md-4">
      <label class="pt-2" for="formats">9. Selected Workout Formats </label><br>
      <input id="formats" type="text" name="9" class="form-control" required <?php
      if ($mode=="Update"){
        $answer=$form->answers[8];
        echo " value='$answer'";
      }?>>
    </div>
    <div class="form-group col-xs-4 col-md-4">
      <label class="pt-2" for="yearsOfExercise">10. Years you have been exercising </label><br>
      <input id="yearsOfExercise" type="text" name="10" class="form-control" required <?php
      if ($mode=="Update"){
        $answer=$form->answers[9];
        echo " value='$answer'";
      }?>>
    </div>
  </div>

  <div class="row justify-content-center">
    <div class="form-group col-4 col-md-4">
      <label class="pt-2" for="lifestyle">11. Lifestyle </label><br>
      <div class="form-check ">
        <input class="form-check-input" type="radio" name="11" id="sedentary" value="Sedentary" required
        <?php
        if($form->answers[10]=="Sedentary"){
          echo "checked";
        }
        ?>
        >
        <label class="form-check-label" for="sedentary">
          Sedentary
        </label>
        <br>
        <input class="form-check-input" type="radio" name="11" id="moderately" value="Moderately Active" required
        <?php
        if($form->answers[10]=="Moderately Active"){
          echo "checked";
        }
        ?>
        >
        <label class="form-check-label" for="moderately">
          Moderately Active (1-2 / week)
        </label>
        <br>
        <input class="form-check-input" type="radio" name="11" id="active" value="Active"
        <?php
        if($form->answers[10]=="Active"){
          echo "checked";
        }
        ?>
        >
        <label class="form-check-label" for="active">
          Active (>2 / week)
        </label>
        <br>
        <input class="form-check-input" type="radio" name="11" id="veryactive" value="Very Active"
        <?php
        if($form->answers[10]=="Very Active"){
          echo "checked";
        }
        ?>
        >
        <label class="form-check-label" for="veryactive">
          Very Active (>4 / week)
        </label>
      </div>
    </div>
    <div class="form-group col-xs-4 col-md-4">
      <label class="pt-2" for="phone">12. Goals </label><br>
      <div class="form-check ">
        <input class="form-check-input" type="radio" name="12" id="weightLoss" value="Weight Loss"
        <?php
        if($form->answers[11]=="Weight Loss"){
          echo "checked";
        }
        ?>
        >
        <label class="form-check-label" for="weightLoss">
          Weight Loss
        </label>
        <br>
        <input class="form-check-input" type="radio" name="12" id="muscle" value="Muscle Gain"
        <?php
        if($form->answers[11]=="Muscle Gain"){
          echo "checked";
        }
        ?>
        >
        <label class="form-check-label" for="muscle">
          Muscle Gain
        </label>
        <br>
        <input class="form-check-input" type="radio" name="12" id="flexibility" value="Flexibility"
        <?php
        if($form->answers[11]=="Muscle Gain"){
          echo "Flexibility";
        }
        ?>
        >
        <label class="form-check-label" for="flexibility">
          Flexibility
        </label>
      </div>
    </div>
    <div class="form-group col-xs-4 col-md-4">
      <label class="pt-2" for="otherGoals">13. Other goals </label><br>
      <textarea class="form-control" id="otherGoals" rows="2" name="13" style="resize: none" placeholder="" ><?php
        if ($mode=="Update"){
          $answer=$form->answers[12];
          echo $answer;
        }?>
      </textarea>
    </div>
  </div>


  <div class="row justify-content-center">
    <div class="form-group col-xs-4 col-md-4">
      <label class="pt-2" for="medHist">14. Medical history, health concerns (Optional) </label><br>
      <textarea class="form-control" id="medHist" rows="2" name="14" style="resize: none" placeholder="" ><?php
        if ($mode=="Update"){
          $answer=$form->answers[13];
          echo $answer;
        }?></textarea>
    </div>
    <div class="form-group col-xs-4 col-md-4">
      <label class="pt-2" for="surgeriesInjuries">15. Recent surgeries or injuries (Optional)</label><br>
      <textarea class="form-control" id="surgeriesInjuries" rows="2" name="15" style="resize: none" placeholder="" ><?php
              if ($mode=="Update"){
                $answer=$form->answers[14];
                echo $answer;
              }?></textarea>
    </div>
    <div class="form-group col-xs-4 col-md-4">
      <label class="pt-2" for="activeMeds">16. Active Medications (Optional)</label><br>
      <textarea class="form-control" id="activeMeds" rows="2" name="16" style="resize: none" placeholder="" ><?php
              if ($mode=="Update"){
                $answer=$form->answers[15];
                echo $answer;
              }?></textarea>
    </div>


  </div>
  <div class="row">
    <div class="form-group col-xs-4 col-md-4">
      <label class="pt-2" for="restrictions">17. Restrictions (Optional) </label><br>
      <input id="restrictions" type="text" name="17" class="form-control" <?php
      if ($mode=="Update"){
        $answer=$form->answers[16];
        echo " value='$answer'";
      }?>>
    </div>
    <div class="form-group col-xs-4 col-md-4">
      <label class="pt-2" for="diet">18. Current Diet Type (Veg, Non-Veg etc...) </label><br>
      <input id="diet" type="text" name="18" class="form-control" required <?php
      if ($mode=="Update"){
        $answer=$form->answers[17];
        echo " value='$answer'";
      }?>>
    </div>
  </div>
  <div class="row" align=center>
    <div class="form-group col-12">
      <input id="formVersion" type="text" name="formVersion" class="form-control" value="1" hidden>
      <input id="userProductId" type="text" name="userProductId" class="form-control" value="<?php echo $userProductId; ?>" hidden>
      <button class="btn btn-primary blueButton mt-1" type="submit" name="submit">
        <?php
        if($mode=="New"){
          echo "Save Form";
        } else if($mode=="Update"){
          echo "Update Form";
        }
        ?>

      </button>
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
