<?php


include_once "config.php";
include_once ( ROOT_DIR.'/includes/autoloader.php' );

if(!isset($_SESSION)){
  session_start();
}

include_once ROOT_DIR."/includes/auto_login.php";
?>

<!DOCTYPE html>
<html lang='en'>
<head>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta charset="utf-8">
  <title> FuNinja </title>

  <!-- Bootstrap sources -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootswatch/4.5.2/united/bootstrap.min.css">
  <link href="/css/custom.css" rel="stylesheet">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"
    integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV"
    crossorigin="anonymous">
  </script>

  <script async defer crossorigin="anonymous" src="https://connect.facebook.net/en_US/sdk.js"></script>

  <script src="https://apis.google.com/js/platform.js?onload=init" async defer></script>

  <meta name="google-signin-client_id" content="29019688226-vrs2euoj57drdrq3krf5gs76bil3otsk.apps.googleusercontent.com">

  <script>
  window.fbAsyncInit = function() {
    FB.init({
      appId            : '744163999514262',
      autoLogAppEvents : true,
      cookie           : true,
      xfbml            : true,
      version          : 'v8.0'
    });
  }

  </script>

  <script src="/scripts/trainee_signup.js"> </script>
  <script src="/scripts/login.js"> </script>
  <script src="/scripts/facebook_login.js"> </script>
  <script src="/scripts/google_login.js"> </script>


    <!-- support script for displaying popovers -->
    <script>
      $(document).ready(function(){
      $('[data-toggle="popover"]').popover();
      });
    </script>

    <!-- set default tabs when clicking sign up / login -->
    <script>
    $(document).ready(function(){
      $("#loginButton, #pills-signin-tab").on("click",function(){
          $("#pills-signup-tab").removeClass("active");
          $("#pills-signin-tab").addClass("active");
          $("#pills-signup-body").removeClass("show active");
          $("#pills-signin-body").addClass("show active");
          $("#login-errorMsg").text(''); // clear any existing error messages
      });

      $("#registerButton, #pills-signup-tab").on("click",function(){
          $("#pills-signin-tab").removeClass("active");
          $("#pills-signup-tab").addClass("active");
          $("#pills-signin-body").removeClass("show active");
          $("#pills-signup-body").addClass("show active");
          $("#login-errorMsg").text(''); // clear any existing error messages
      });

    });
    </script>

</head>

<body>

<div class="container-fluid">
<div class="row">
  <!--navbar -->
  <nav id = "main-navbar" class="navbar navbar-expand-lg navbar-light fixed-top navbar-custom boxshadoweffect mb-0 pb-0 mt-0 pt-0">
  <a href="/index.php" class="navbar-brand"><img src="/images/logo2.png" alt="FuNinja" style="height:40px"></a>

  <!-- burger -->
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <!-- /burger" -->

  <!-- everything in here will be collapsed on smaller devices -->
  <div class="collapse navbar-collapse pt-1" id="navbarSupportedContent">
    <!-- Navbar links, dropdowns etc go here -->
    <ul class="navbar-nav mr-auto ">

      <li class="nav-item active">
        <a class="nav-link " href="plans.php">Membership</a>
      </li>
      <li class="nav-item active">
        <a class="nav-link " href="contact.php">Contact Us</a>
      </li>


    </ul>
<ul class="navbar-nav ml-auto ">
    <!-- Other stuff in the navbar goes here-->

    <?php
    // if user user isn't logged in, show the login and register buttons
    if(!isset($_SESSION['uid'])){ ?>
      <button type="button" class="btn btn-secondary btn-sm btn mr-1 mb-1" data-toggle="modal" data-target="#exampleModal" id ="loginButton"> LOG IN </button>
      <button type="button" class="btn btn-primary btn-sm btn mr-1 mb-1" data-toggle="modal" data-target="#exampleModal" id ="registerButton"> SIGN UP</button>

      <?php  ;
    }

    // if the user is logged in, show the user profile button
    if(isset($_SESSION['uid'])){?>
    <div class="dropdown">
  <button type="button" class="btn btn-sm btn-primary dropdown-toggle mb-1" data-toggle="dropdown">
    <?php echo $_SESSION['username']?>
  </button>
  <div class="dropdown-menu dropdown-menu-right">
    <a class="dropdown-item" href="/includes/post_login_landing_controller.php">Dashboard</a>
    <a class="dropdown-item" href="settings.php">Send Us Feedback</a>
    <a class="dropdown-item" href="settings.php">Settings</a>
    <div class="dropdown-divider"></div>
    <a class="dropdown-item" href="/includes/logout.php">Logout</a>
  </div>
</div>
      <?php
    }
    ?>
</ul>
</div>
</nav>
<!-- /navbar -->

<!-- Modal for login / registration popup -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-hidden="true">
<div class="modal-dialog" role="document" style=" width: 350px;">
<div class="modal-content signup_modal">
  <div class="modal-header">

  <ul class="nav nav-pills nav-fill mb-1" id="pills-tab" role="tablist">
  <li class="nav-item"> <a class="nav-link active" id="pills-signin-tab" data-toggle="pill" href="#pills-signin" role="tab"  aria-selected="true">Log In</a> </li>
  <li class="nav-item"> <a class="nav-link" id="pills-signup-tab" data-toggle="pill" href="#pills-signup" role="tab"  aria-selected="false">Register</a> </li>
  </ul>
  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
  <span aria-hidden="true">&times;</span>
  </button>
  </div>

  <div class="modal-body" id = "signup-body">
    <div class="tab-content" id="pills-tabContent">
      <div class="tab-pane show active p-0 m-0" id="pills-signin-body" role="tabpanel">
        <div class="col-sm-12 p-0 m-0">
          <form class="form-signin p-0 m-0" id = "login" action="includes/login.php" method="post" novalidate>
          <label class = "float-left"> <b> User name or email </b> </label>
          <input type="text" name="login-mailuid" id = "login-mailuid" class="form-control mb-1 greybgd" required>
          <label class = "float-left"> <b> Password </b> </label>
          <input type="password" name="login-pwd" id = "login-pwd" class="form-control mb-1 greybgd" required>
          <small id = "login-errorMsg" class = "login-error formErrors">  </small>
          <div class="checkbox mb-3">
          <input type="checkbox" value="remember-me" name="remember-me" id="remember-me"> Remember me
          </div>
          <button class="btn btn-primary btn-block" type="submit" name="login-submit" id = "login-submit">Sign in</button>
          <a href="forgot-password.php" class="btn btn-link"> Forgot password?</a>

          </form>
          <HR>

          <a href="#" onclick="fb_login();"><img src="/images/fb_login.png" width="225" height="54"   alt=""></a>
          <br><a href="#" onclick="google_login();"> <img src="/images/google_login.png" alt="Google Login"></a>
        </div>



      </div>
    <div class="tab-pane p-0 m-0" id="pills-signup-body" role="tabpanel" >
      <div class="col-sm-12 p-0 m-0">
        <form id = "signup" class="form-signin m-0 p-0" action="includes/signup_trainee.php" method="post" novalidate>

        <input id = "username" type="text" name="uid" class="form-control mb-1 greybgd " placeholder="Username" required>
        <div id = "username-guidance" class="signup-guidance mb-1 "><small> This is the name people will know you by on FuNinja. </small></div>
        <div id = "username-error" class="signup-error formErrors mb-1"></div>

        <input id = "email" type="email" name="email" class="form-control mb-1 greybgd" placeholder="E-Mail" required>
        <div id = "email-guidance" class="signup-guidance mb-1"><small> You'll need to verify that you own this email account. </small></div>
        <div id = "email-error" class="signup-error formErrors mb-1"><small> </small></div>

        <input id = "password" type="password" name="pwd" class="form-control mb-1 greybgd" placeholder="Password" required >
        <div id = "password-error" class="signup-error mb-1 formErrors"><small> </small></div>

        <input id = "passwordRepeat" type="password" name="pwd-repeat" class="form-control mb-1 greybgd" placeholder="Repeat Password" required>
        <div id = "passwordRepeat-error" class="signup-error mb-1 formErrors" ><small> </small></div>

        <small id = "errorMsg" class = "signup-error formErrors">  </small>
        <button id = "submit" class="btn btn-primary btn-block mt-1 mb-1" type="submit" name="signup-submit">Sign Up</button>
        </form>
        <HR>
          <a href="#" onclick="fb_login();"><img src="/images/fb_login.png" width="225" height="54" alt="Facebook Login"></a>
          <br><a href="#" onclick="google_login();"> <img src="/images/google_login.png" alt="Google Login"></a>

      </div>
    </div>
    </div>

  <img id="loader" src="/images/loader.svg" alt="load_animation" width="50" height="50" class="m-0 p-0">

  </div>
</div>
</div>
</div>
<!-- EO Modal for login / registration -->

</div>

</div>



<script>
// set the padding on load to space the body correctly below the navbar
  $(document).ready(function() {
     $('body').css('padding-top', parseInt($('#main-navbar').css("height"))+10);
  });


  $(window).resize(function () {
     $('body').css('padding-top', parseInt($('#main-navbar').css("height"))+10);
  });

  // set the margins on body so that contents don't overlap the footer
    $(document).ready(function() {
       $('body').css('margin-bottom', parseInt($('#standard_footer').css("height"))+10);
    });


    $(window).resize(function () {
      $('body').css('margin-bottom', parseInt($('#standard_footer').css("height"))+10);
    });

</script>
