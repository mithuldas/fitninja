<?php
include_once "config.php";
include_once ( ROOT_DIR.'/includes/autoloader.php' );

FlowControl::startSession();
include_once ROOT_DIR."/includes/auto_login.php";
?>


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

  <!-- Google Tag Manager (noscript) -->
<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-557BHJH"
height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
<!-- End Google Tag Manager (noscript) -->


  <a href="https://api.whatsapp.com/send?phone=919108806213" class="float" target="_blank">
  <i class="fa fa-sm fa-whatsapp my-float"></i>
  </a>
<div class="container-fluid">
<div class="row">

  <!--navbar -->
  <nav id = "main-navbar" class="navbar navbar-light fixed-top navbar-custom headerShadow navbar-expand-md  mb-0 pb-0 mt-0 pt-0">

    <!-- burger -->
    <button id="burger" class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <!-- /burger" -->


  <a href="<?php FlowControl::echoHomePageLink();?>" class="navbar-brand" style="padding-top:2px; padding-bottom:10px!important"><img src="/images/logo.png" alt="FuNinja" style="height:35px;"></a>


  <!-- everything in here will be collapsed on smaller devices -->
  <div class="collapse navbar-collapse pt-1 order-md-1 order-2" id="navbarSupportedContent" style="padding-top:0px!important">
    <!-- Navbar links, dropdowns etc go here -->
    <ul class="navbar-nav mr-auto" id="navbarLinks">


      <li class="nav-item active">
        <a class="nav-link burgerOption aboutLink" href="/about.php">About</a>
      </li>
      <li class="nav-item dropdown active">
        <a class="nav-link burgerOption offeringsLink" href="/offerings.php">Offerings</a>
      </li>
    <!--  <li class="nav-item dropdown active">
        <a class="nav-link burgerOption trainersLink" href="/trainers.php">Trainers</a>
      </li>-->
      <li class="nav-item active">
        <a class="nav-link burgerOption membershipLink" href="/plans.php">Membership</a>
      </li>
      <li class="nav-item active">
        <a class="nav-link burgerOption contactLink" href="/contact.php">Contact</a>
      </li>
      <li class="nav-item active">
        <a class="nav-link burgerOption faqLink" href="/faq.php">FAQs</a>
      </li>
      <?php
      // show dashboard link with special formatting if logged in
      if(isset($_SESSION['uid'])){ ?>
        <li class="nav-item active ">
          <a class="nav-link burgerOption dashLink" href="/includes/post_login_landing_controller.php">Dashboard</a>
        </li>

        <?php  ;}?>
    </ul>

</div>

<div class="order-md-2 order-1">
<?php
// if user user isn't logged in, show the login and register buttons
if(!isset($_SESSION['uid'])){ ?>
  <button type="button" class="mr-1 btn btn-secondary btn-sm btn blueButton" data-toggle="modal" data-target="#exampleModal" id ="loginButton"> LOGIN </button>
  <button type="button" class=" btn btn-primary btn-sm btn" data-toggle="modal" data-target="#exampleModal" id ="registerButton"> SIGN UP</button>

  <?php  ;
} ?>

<?php
  if(isset($_SESSION['uid'])){?>
  <div class="dropdown">

    <button type="button" class="stickyUserMenu" data-toggle="dropdown">
      <img class="mt-0 mb-0 mr-1 ml-2" title="User Menu" src="/images/user-ninja.png" width="30" style="padding: 2px; border-radius: 50%; box-shadow: 0px 3px 6px 0px #00000020; background-color:white"/>
    </button>

    <a href="/includes/logout.php" class="stickyUserLogout">
      <img class="m-0 " title="Logout" src="/images/logout.png" width="30" style="padding:4px; border-radius: 50%; box-shadow: 0px 3px 6px 0px #00000020; background-color:white"/>
    </a>
<div class="dropdown-menu dropdown-menu-right">
  <a class="dropdown-item userMenu" href="/includes/post_login_landing_controller.php">Dashboard</a>
  <a class="dropdown-item userMenu" href="/profile.php#profile">Profile</a>
  <a class="dropdown-item userMenu" href="/profile.php#settings">Settings</a>
  <a class="dropdown-item userMenu" href="/profile.php#plans">Plans</a>
  <a class="dropdown-item userMenu" href="/contact.php">Support</a>
  <div class="dropdown-divider mt-2 mb-2"></div>
  <a class="dropdown-item userMenu" href="/includes/logout.php" id="logoutArea">
    <svg viewBox="0 0 129 129" width="20px" height="20px" class="p-0 m-0" id="logoutSVG">
          <path d="m88.6,94.4c0.8,0.8 1.8,1.2 2.9,1.2s2.1-0.4 2.9-1.2l27-27c0.2-0.2 0.4-0.4 0.5-0.6 0,0 0.1-0.1 0.1-0.2 0.1-0.2 0.2-0.4 0.3-0.5 0-0.1 0-0.2 0.1-0.2 0.1-0.2 0.1-0.3 0.2-0.5 0.1-0.3 0.1-0.5 0.1-0.8 0-0.3 0-0.5-0.1-0.8 0-0.2-0.1-0.4-0.2-0.5 0-0.1 0-0.2-0.1-0.2-0.1-0.2-0.2-0.4-0.3-0.6 0,0 0-0.1-0.1-0.1-0.1-0.2-0.3-0.4-0.5-0.6l-27-27c-1.6-1.6-4.2-1.6-5.8,0-1.6,1.6-1.6,4.2 0,5.8l20,20h-71.1c-2.3,0-4.1,1.8-4.1,4.1 0,2.3 1.8,4.1 4.1,4.1h71.1l-20,20c-1.6,1.4-1.6,4 0,5.6z"/>
          <path d="m10.5,122.5h54c2.3,0 4.1-1.8 4.1-4.1v-40.3c0-2.3-1.8-4.1-4.1-4.1s-4.1,1.8-4.1,4.1v36.2h-45.8v-99.7h45.8v36.2c0,2.3 1.8,4.1 4.1,4.1s4.1-1.8 4.1-4.1v-40.3c0-2.3-1.8-4.1-4.1-4.1h-54c-2.3,0-4.1,1.8-4.1,4.1v107.9c0.1,2.3 1.9,4.1 4.1,4.1z"/>
    </svg>
    Logout</a>
</div>
</div>
    <?php
  }
  ?>
</div>


</nav>
<!-- /navbar -->

<!-- Modal for login / registration popup -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-hidden="true" >
<div class="modal-dialog" role="document" style=" width: 300px; margin-top:0px; margin-bottom:0px; margin-left: 0px;margin-right: 0px;">
<div class="modal-content signup_modal" style="vertical-align: middle">
  <div class="modal-header" style="margin-left: 60px; padding-bottom: 0px;">
  <ul class="nav nav-pills nav-fill mb-1" id="pills-tab" role="tablist">
  <li class="nav-item"> <a class="nav-link pillLoginButton btn-sm active" id="pills-signin-tab" data-toggle="pill" href="#pills-signin" role="tab"  aria-selected="true">Login</a> </li>
  <li class="nav-item"> <a class="nav-link pillRegButton btn-sm" id="pills-signup-tab" data-toggle="pill" href="#pills-signup" role="tab"  aria-selected="false">Register</a> </li>
  </ul>
  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
  <span id="signupPopupCloseBtn" class="hide-on-nonmobile" aria-hidden="true">&times;</span>
  </button>
  </div>

  <div class="modal-body" id = "signup-body">
    <div class="tab-content" id="pills-tabContent">
      <div class="tab-pane show active p-0 m-0" id="pills-signin-body" role="tabpanel">
        <div class="col-sm-12 p-0 m-0">
          <form class="form-signin p-0 m-0" id = "login" action="includes/login.php" method="post" novalidate>
          <small id = "login-errorMsg" class = "login-error formErrors">  </small>
          <input type="text" name="login-mailuid" id = "login-mailuid" class="form-control mb-1 greybgd" placeholder="Username or Email" required>
          <input type="password" name="login-pwd" id = "login-pwd" class="form-control mb-1 greybgd" placeholder="Password" required>
          <center><button class="btn btn-primary btn-block blueButton" type="submit" name="login-submit" id = "login-submit">Login</button></center>

          <div class="checkbox mt-2 mb-0">
          <input type="checkbox" value="remember-me" name="remember-me" id="remember-me">
          <label for="remember-me"> <small>Remember me</small> </label>
          </div>

          </form>
          <div class="mt-1 mb-1">
            <hr class="m-0 pb-2">
          </div>
          <div>
            <center><button onclick="fb_login();" class="loginBtn loginBtn--facebook">
            Login with Facebook
          </button><br>
            <button onclick="google_login();" class="loginBtn loginBtn--google boxshadoweffect">
              Login with Google
            </button></center>
            <center><a href="forgot-password.php" class="btn btn-link"> <small>Forgot password?</small></a></center>
          </div>
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
        <center><button id = "submit" class="btn btn-primary mt-1 mb-1 btn-block blueButton" type="submit" name="signup-submit">Sign Up</button></center>
        </form>
        <div class="mt-4 mb-1">
          <hr class="mt-2 mb-3 ">
        </div>
        <div>
          <center><button onclick="fb_login();" class="loginBtn loginBtn--facebook">
          Login with Facebook
        </button><br>
          <button onclick="google_login();" class="loginBtn loginBtn--google boxshadoweffect">
            Login with Google
          </button></center>
        </div>
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

    $(document).ready(function () {
       $(document).click(function (event) {
           var clickover = $(event.target);
           var _opened = $(".navbar-collapse").hasClass("show");
           if (_opened === true && !clickover.hasClass("navbar-toggler")) {
               $(".navbar-toggler").click();
           }
       });
   });

   $("#logoutArea").hover(function(){
     $("#logoutSVG").toggleClass('whiteSVG')
    });

    var modalHeight=418.75;
    var modalWidth = 300;
    var visibleHeight = window.innerHeight;
    var visibleWidth = window.innerWidth;
    var topPosition = (visibleHeight-modalHeight)/3;
    var sidePosition = (visibleWidth -modalWidth)/2;
    var x= document.getElementsByClassName('modal-content');
    $(x).css({"top":topPosition, "left":sidePosition});

</script>

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
