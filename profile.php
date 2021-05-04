<?php
include_once "config.php";
include_once ( ROOT_DIR.'/includes/autoloader.php' );

FlowControl::startSession();
include_once ROOT_DIR."/includes/auto_login.php";
?>

<!DOCTYPE html>
<html lang='en'>
<head>
  <title> Home - Premium Personal Training - FuNinja </title>
  <?php
  require ROOT_DIR."/includes/frameworks.php";
  ?>
</head>

<body>
<?php
include ROOT_DIR."/header.php";
if($_SESSION['userType']=="Trainee"){
  $user = new Trainee ($_SESSION['uid'], $conn);
} else if ($_SESSION['userType']=="Trainer"){
  $user = new Trainer ($_SESSION['uid'], $conn);
} else {
  $user = new User ($_SESSION['uid'], $conn);
}

?>

<link href="css/profile.css" rel="stylesheet">

<div class="container-fluid  breadcrumbContiner">
  <nav aria-label="breadcrumb mb-0 pb-0" >
    <ol class="breadcrumb" style="margin-bottom: 0px; padding-left:0px; padding-top:0px">
      <li class="breadcrumb-item"><a href="/index.php">Home</a></li>
      <li class="breadcrumb-item"><a href="/includes/post_login_landing_controller.php">Dashboard</a></li>
      <li class="breadcrumb-item active" aria-current="page">Profile</li>
    </ol>
  </nav>
</div>
<div class="container pb-3">
  <div class="row gutters-sm">
    <!-- desktop menu bar on left -->
    <div class="col-md-3 d-none d-md-block">
      <div class="card mt-4 roundborder">
        <div class="card-body profileShadow">
          <nav class="nav flex-column nav-pills nav-gap-y-1">
            <a href="#profile" data-toggle="tab" class="profileNavItem nav-item  nav-link has-icon nav-link-faded active" id="profileDesktopHeader">
              <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-user mr-2"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path><circle cx="12" cy="7" r="4"></circle></svg>Profile
            </a>
            <a href="#settings" data-toggle="tab" class="profileNavItem nav-item nav-link has-icon nav-link-faded" id="settingsDesktopHeader">
              <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-settings mr-2"><circle cx="12" cy="12" r="3"></circle><path d="M19.4 15a1.65 1.65 0 0 0 .33 1.82l.06.06a2 2 0 0 1 0 2.83 2 2 0 0 1-2.83 0l-.06-.06a1.65 1.65 0 0 0-1.82-.33 1.65 1.65 0 0 0-1 1.51V21a2 2 0 0 1-2 2 2 2 0 0 1-2-2v-.09A1.65 1.65 0 0 0 9 19.4a1.65 1.65 0 0 0-1.82.33l-.06.06a2 2 0 0 1-2.83 0 2 2 0 0 1 0-2.83l.06-.06a1.65 1.65 0 0 0 .33-1.82 1.65 1.65 0 0 0-1.51-1H3a2 2 0 0 1-2-2 2 2 0 0 1 2-2h.09A1.65 1.65 0 0 0 4.6 9a1.65 1.65 0 0 0-.33-1.82l-.06-.06a2 2 0 0 1 0-2.83 2 2 0 0 1 2.83 0l.06.06a1.65 1.65 0 0 0 1.82.33H9a1.65 1.65 0 0 0 1-1.51V3a2 2 0 0 1 2-2 2 2 0 0 1 2 2v.09a1.65 1.65 0 0 0 1 1.51 1.65 1.65 0 0 0 1.82-.33l.06-.06a2 2 0 0 1 2.83 0 2 2 0 0 1 0 2.83l-.06.06a1.65 1.65 0 0 0-.33 1.82V9a1.65 1.65 0 0 0 1.51 1H21a2 2 0 0 1 2 2 2 2 0 0 1-2 2h-.09a1.65 1.65 0 0 0-1.51 1z"></path></svg>Settings
            </a>
            <a href="#plans" data-toggle="tab" class="profileNavItem nav-item nav-link has-icon nav-link-faded" id="plansDesktopHeader">
              <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-credit-card mr-2"><rect x="1" y="4" width="22" height="16" rx="2" ry="2"></rect><line x1="1" y1="10" x2="23" y2="10"></line></svg>Plans
            </a>
          </nav>
        </div>
      </div>
    </div>

    <!-- content card -->
 <div class="col-md-9">
  <div class="card profileShadow mt-4 roundborder">
    <h6 id = "statusMessage" class="ml-2 mt-2"> <h6>
    <div class="card-header border-bottom mb-3 d-flex d-md-none">
      <ul class="nav nav-tabs card-header-tabs nav-gap-x-1" role="tablist">
        <li class="nav-item profileNavItem">
          <a href="#profile" data-toggle="tab" class="profileNav nav-link has-icon active" id="profileMobileHeader"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-user"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path><circle cx="12" cy="7" r="4"></circle></svg></a>
        </li>
        <li class="nav-item profileNavItem">
          <a href="#settings" data-toggle="tab" class="profileNav nav-link has-icon" id="settingsMobileHeader"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-settings"><circle cx="12" cy="12" r="3"></circle><path d="M19.4 15a1.65 1.65 0 0 0 .33 1.82l.06.06a2 2 0 0 1 0 2.83 2 2 0 0 1-2.83 0l-.06-.06a1.65 1.65 0 0 0-1.82-.33 1.65 1.65 0 0 0-1 1.51V21a2 2 0 0 1-2 2 2 2 0 0 1-2-2v-.09A1.65 1.65 0 0 0 9 19.4a1.65 1.65 0 0 0-1.82.33l-.06.06a2 2 0 0 1-2.83 0 2 2 0 0 1 0-2.83l.06-.06a1.65 1.65 0 0 0 .33-1.82 1.65 1.65 0 0 0-1.51-1H3a2 2 0 0 1-2-2 2 2 0 0 1 2-2h.09A1.65 1.65 0 0 0 4.6 9a1.65 1.65 0 0 0-.33-1.82l-.06-.06a2 2 0 0 1 0-2.83 2 2 0 0 1 2.83 0l.06.06a1.65 1.65 0 0 0 1.82.33H9a1.65 1.65 0 0 0 1-1.51V3a2 2 0 0 1 2-2 2 2 0 0 1 2 2v.09a1.65 1.65 0 0 0 1 1.51 1.65 1.65 0 0 0 1.82-.33l.06-.06a2 2 0 0 1 2.83 0 2 2 0 0 1 0 2.83l-.06.06a1.65 1.65 0 0 0-.33 1.82V9a1.65 1.65 0 0 0 1.51 1H21a2 2 0 0 1 2 2 2 2 0 0 1-2 2h-.09a1.65 1.65 0 0 0-1.51 1z"></path></svg></a>
        </li>
        <li class="nav-item profileNavItem">
          <a href="#plans" data-toggle="tab" class="profileNav nav-link has-icon" id="plansMobileHeader"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-credit-card"><rect x="1" y="4" width="22" height="16" rx="2" ry="2"></rect><line x1="1" y1="10" x2="23" y2="10"></line></svg></a>
        </li>
      </ul>
            </div>


  <div class="card-body profileCard tab-content">
    <div class="profileTabPane tab-pane active" id="profile">
      <h6>PERSONAL INFORMATION</h6>
      <hr>

      <?php
      if($user->authenticationType=='webLogin'){
        echo "
        <div class=\"row pt-2 pb-2\">
          <div class=\"col-4\">Username
          </div>
          <div class=\"col-8 greyfontNoCenter\">".$user->username."
          </div>
        </div>
        ";
      }


      ?>
      <div class="row pt-2 pb-2">
        <div class="col-4">Name
        </div>
        <div class="col-8 greyfontNoCenter"><?php echo $user->firstName; ?>
        </div>
      </div>
      <div class="row pt-2 pb-2">
        <div class="col-4">Email
        </div>
        <div class="col-8 greyfontNoCenter"><?php echo $user->email; ?>
        </div>
      </div>
      <div class="row pt-2 pb-2">
        <div class="col-4">Date of Birth
        </div>
        <div class="col-8 greyfontNoCenter"><?php echo $user->dateOfBirth; ?>
        </div>
      </div>
      <div class="row pt-2 pb-2">
        <div class="col-4 ">Gender
        </div>
        <div class="col-8 greyfontNoCenter"><?php echo $user->gender; ?>
        </div>
      </div>
      <div class="row pt-2 pb-2">
        <div class="col-4 ">Phone number
        </div>
        <div class="col-8 greyfontNoCenter"><?php echo $user->phoneNumber; ?>
        </div>
      </div>
      <div class="row pt-4">
        <div class="col"><small> <a href="contact.php">Submit a request</a> to update personal details.</small>
        </div>
      </div>

    </div>

    <div class="profileTabPane tab-pane" id="settings">
      <h6>SETTINGS</h6>
      <hr>
      <?php
      if($_SESSION['authenticationType']=="Web"){
        echo "
        <form action=\"includes/pwd-change-request.php\" method=\"post\">
          <div class=\"form-group\">
            <input type=\"password\" name=\"oldpwd\" class=\"form-control\" placeholder=\"Enter your old password\">
            <input type=\"password\" name=\"newpwd\" class=\"form-control mt-1\" placeholder=\"New password\">
            <input type=\"password\" name=\"newpwdrepeat\"  class=\"form-control mt-1\" placeholder=\"Confirm new password\">
          </div>

          <button type=\"submit\" name=\"changepwd-submit\" class=\"btn btn-primary\">Update Password</button>
        </form>
        ";
      } else {
        echo "
        <small> Your account doesn't have any configurable settings </small>
        ";
      }


      ?>



    </div>

    <div class="profileTabPane tab-pane" id="plans">

      <div class="dashCardTitle dashMobTitle">Your Current Plan</div>
      <div class='table100 plansTable'>
       <div class='table100-head'>
       <table id='upcomingSessions'><thead>
       <tr class='row100 head'>
       <th class='cell100 column1 curPlan'> Plan </th>
       <th class='cell100 column2 curPlan'> Valid From </th>
       <th class='cell100 column3 curPlan'> Valid To </th>
       <th class='cell100 column4 curPlan'> Form </th>
       </tr></thead>
       </table>
       </div>

       <?php
       if(!is_null($user->activePlan)){
         $formattedValidFrom = date("d M Y", strtotime($user->activePlan->validFrom));
         if(!is_null($user->activePlan->validTo)){
           $formattedValidTo = date("d M Y", strtotime($user->activePlan->validTo));
         } else {
           $formattedValidTo='';
         }
       }
        ?>

       <div class='table100-body'>
         <table class="mb-4">
           <tbody>
             <tr class=\'row100 body\'>
               <td class="cell100 column1 curPlan"><?php echo $user->activePlan->productName; ?></td>
               <td class="cell100 column2 curPlan"><?php echo $formattedValidFrom; ?></td>
               <td class="cell100 column3 curPlan"><?php echo $formattedValidTo; ?></td>
               <td class="cell100 column4 curPlan">
                 <?php
                 if($user->activePlan->customerDataCollected){
                   echo "<form action='/view_collected_form.php' method='post'>
                   <input type='hidden' name='userProductId' value='". $user->activePlan->userProductId."'>
                   <button class='btn' type='submit' name='viewCurrentPlanForm'><i class='fas fa-paperclip'></i></button>
                   </form>";
                 }
                 ?>
              </td>
             </tr>
           </tbody>
         </table>
       </div>
      </div>

      <div class="dashCardTitle dashMobTitle">Plan History</div>


      <div class='table100 plansTable'>
       <div class='table100-head'>
       <table id='upcomingSessions'><thead>
       <tr class='row100 head'>
       <th class='cell100 column1 pastPlan'> Plan </th>
       <th class='cell100 column2 pastPlan'> Date Purchased </th>
       <th class='cell100 column3 pastPlan'> Form </th>
       </tr></thead>
       </table>
       </div>

       <div class='table100-body'>
         <table class="mb-4">
           <tbody>
               <?php
               foreach ($user->plans as $plan) {
                 $formattedValidFrom = date("d M Y", strtotime($plan->validFrom));
                 if($plan->productName!="Trial"){
                   if($plan->customerDataCollected){
                     $formHTML = "<form action='/view_collected_form.php' method='post'>
                          <input type='hidden' name='userProductId' value='". $plan->userProductId."'>
                          <button  class='btn' type='submit' name='viewPlanForm'><i class='fas fa-paperclip'></i></button>
                          </form>";
                   } else {
                     $formHTML="";
                   }
                   echo "
                     <tr class='row100 body'>
                     <td class='cell100 column1 pastPlan'>".$plan->productName."</td>
                      <td class='cell100 column2 pastPlan'>".$formattedValidFrom."</td>
                      <td class='cell100 column3 pastPlan'> $formHTML </td>
                    </tr>
                 ";
                 }

               }
               ?>
           </tbody>
         </table>
       </div>
      </div>

  </div>

  </div>
  </div>
        </div>
  </div>
</div>

<?php
  require "footer.php";
?>

<script>
    var sublink = document.location.hash;
     $(".profileTabPane").removeClass("active");
     $(".profileNav").removeClass("active");
     $(".profileNavItem").removeClass("active");
     $(sublink).addClass("active");

     if(sublink=="#settings"){
       $("#settingsDesktopHeader").addClass("active");
       $("#settingsMobileHeader").addClass("active");
     } else if(sublink=="#profile"){
       $("#profileDesktopHeader").addClass("active");
       $("#profileMobileHeader").addClass("active");
     } else if(sublink=="#plans"){
       $("#plansDesktopHeader").addClass("active");
       $("#plansMobileHeader").addClass("active");
     }

     $(window).on('hashchange', function(e){
      var sublink = document.location.hash;
      $(".profileTabPane").removeClass("active");
      $(".profileNav").removeClass("active");
      $(".profileNavItem").removeClass("active");
      $(sublink).addClass("active");

      if(sublink=="#settings"){
        $("#settingsDesktopHeader").addClass("active");
        $("#settingsMobileHeader").addClass("active");
      } else if(sublink=="#profile"){
        $("#profileDesktopHeader").addClass("active");
        $("#profileMobileHeader").addClass("active");
      } else if(sublink=="#plans"){
        $("#plansDesktopHeader").addClass("active");
        $("#plansMobileHeader").addClass("active");
      }

    });

    // update status message based on password change response
    $('#statusMessage').hide();
      var status = "<?php echo($_GET['status']); ?>";

      if(status == "emptyfields" || status == "pwdMismatch" || status =="wrongPassword" || status =="tooShort"){
        $(".profileTabPane").removeClass("active");
        $(".profileNav").removeClass("active");
        $(".profileNavItem").removeClass("active");
        $("#settingsDesktopHeader, #settingsMobileHeader, #settings").addClass("active");
      }
      if (status == "emptyfields"){
        $('#statusMessage').slideDown();
        $('#statusMessage').html('<small style="color:red"> Fill in all fields </small>');
        $(".profileTabPane").removeClass("active");
        $(".profileNav").removeClass("active");
        $(".profileNavItem").removeClass("active");
        $("#settingsDesktopHeader, #settingsMobileHeader, #settings").addClass("active");
      } else if (status == "pwdMismatch") {
        $('#statusMessage').slideDown();
        $('#statusMessage').html('<small style="color:red"> Passwords do not match </small>');
        $(".profileTabPane").removeClass("active");
        $(".profileNav").removeClass("active");
        $(".profileNavItem").removeClass("active");
        $("#settingsDesktopHeader, #settingsMobileHeader, #settings").addClass("active");
      } else if (status == "wrongPassword") {
        $('#statusMessage').slideDown();
        $('#statusMessage').html('<small style="color:red"> Old password is incorrect </small>');
        $(".profileTabPane").removeClass("active");
        $(".profileNav").removeClass("active");
        $(".profileNavItem").removeClass("active");
        $("#settingsDesktopHeader, #settingsMobileHeader, #settings").addClass("active");
      } else if (status == "tooShort") {
        $('#statusMessage').slideDown();
        $('#statusMessage').html('<small style="color:red"> Password must contain at least 8 characters </small>');
        $(".profileTabPane").removeClass("active");
        $(".profileNav").removeClass("active");
        $(".profileNavItem").removeClass("active");
        $("#settingsDesktopHeader, #settingsMobileHeader, #settings").addClass("active");
      } else if (status == "passwordupdated") {
        $('#statusMessage').slideDown();
        $('#statusMessage').html('<small style="color:green"> Your password has been updated </small>');
        $(".profileTabPane").removeClass("active");
        $(".profileNav").removeClass("active");
        $(".profileNavItem").removeClass("active");
        $("#settingsDesktopHeader, #settingsMobileHeader, #settings").addClass("active");
      }

</script>
