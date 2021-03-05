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
  <img class="float" src="/images/wa_icon.svg"> </img>
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


  <a href="<?php FlowControl::echoHomePageLink();?>" class="navbar-brand" style="padding-top:3px; padding-bottom:3px!important"><img src="/images/logo.png" alt="FuNinja" style="height:35px;"></a>


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
<div class="dropdown-menu dropdown-menu-right mt-2">
  <a class="dropdown-item userMenu pb-2 pt-2 pl-3 pr-5" href="/includes/post_login_landing_controller.php">
<svg class="mr-2 userMenuSvg" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M1.25,17.5V7.5h5v10Zm11.25,0h-5V5H5l5-5,5,5H12.5Zm1.25,0v-5h5v5Z"></path></svg>
    Dashboard</a>
  <a class="dropdown-item userMenu pb-2 pt-2 pl-3 pr-5" href="/profile.php#profile"><svg class="mr-2 userMenuSvg" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><g fill="inherit"><path d="M15,15.5 L5,15.5 C4.724,15.5 4.5,15.276 4.5,15 C4.5,12.755 6.326,10.929 8.571,10.929 L11.429,10.929 C13.674,10.929 15.5,12.755 15.5,15 C15.5,15.276 15.276,15.5 15,15.5 M10,4.5 C11.405,4.5 12.547,5.643 12.547,7.048 C12.547,8.452 11.405,9.595 10,9.595 C8.595,9.595 7.453,8.452 7.453,7.048 C7.453,5.643 8.595,4.5 10,4.5 M16,2 L4,2 C2.897,2 2,2.897 2,4 L2,16 C2,17.103 2.897,18 4,18 L16,18 C17.103,18 18,17.103 18,16 L18,4 C18,2.897 17.103,2 16,2"></path>
  </g></svg> Profile</a>
  <a class="dropdown-item userMenu pb-2 pt-2 pl-3 pr-5" href="/profile.php#settings"><svg class="mr-2 userMenuSvg" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg" ><g fill="inherit"><path d="M7.03093403,10 C7.03093403,8.36301971 8.36301971,7.03093403 10,7.03093403 C11.6369803,7.03093403 12.9679409,8.36301971 12.9679409,10 C12.9679409,11.6369803 11.6369803,12.969066 10,12.969066 C8.36301971,12.969066 7.03093403,11.6369803 7.03093403,10 M16.4016617,8.49127796 C16.2362761,7.79148295 15.9606334,7.13669084 15.5916096,6.5437777 L16.5231696,5.06768276 C16.7526843,4.70315931 16.7684353,4.22387849 16.5231696,3.83572852 C16.1833977,3.29794393 15.4712269,3.13593351 14.9323172,3.47683044 L13.4562223,4.40839036 C12.8633092,4.03936662 12.208517,3.76259882 11.508722,3.59833825 L11.1250724,1.89947899 C11.0294412,1.47982699 10.7020452,1.12992949 10.2542664,1.02867298 C9.63322641,0.888038932 9.01556168,1.27843904 8.87492764,1.89947899 L8.49127796,3.59833825 C7.79148295,3.76259882 7.13669084,4.03936662 6.54265263,4.40726528 L5.06768276,3.47683044 C4.70315931,3.24731568 4.22387849,3.23156466 3.83572852,3.47683044 C3.29794393,3.81660229 3.13593351,4.5287731 3.47683044,5.06768276 L4.40726528,6.54265263 C4.03936662,7.13669084 3.76259882,7.79148295 3.59721318,8.49127796 L1.89947899,8.87492764 C1.47982699,8.97055879 1.12992949,9.29795485 1.02867298,9.74573365 C0.888038932,10.3667736 1.27843904,10.9844383 1.89947899,11.1250724 L3.59721318,11.508722 C3.76259882,12.208517 4.03936662,12.8633092 4.40726528,13.4573474 L3.47683044,14.9323172 C3.24731568,15.2968407 3.23156466,15.7761215 3.47683044,16.1642715 C3.81660229,16.7020561 4.5287731,16.8640665 5.06768276,16.5231696 L6.54265263,15.5927347 C7.13669084,15.9606334 7.79148295,16.2374012 8.49127796,16.4016617 L8.87492764,18.100521 C8.97055879,18.520173 9.29795485,18.8700705 9.74573365,18.971327 C10.3667736,19.1119611 10.9844383,18.721561 11.1250724,18.100521 L11.508722,16.4016617 C12.208517,16.2374012 12.8633092,15.9606334 13.4562223,15.5916096 L14.9323172,16.5231696 C15.2968407,16.7526843 15.7749964,16.7684353 16.1631464,16.5231696 C16.7020561,16.1833977 16.8629414,15.4712269 16.5231696,14.9323172 L15.5916096,13.4562223 C15.9606334,12.8633092 16.2362761,12.208517 16.4016617,11.508722 L18.100521,11.1250724 C18.520173,11.0294412 18.8700705,10.7020452 18.971327,10.2542664 C19.1119611,9.63322641 18.721561,9.01556168 18.100521,8.87492764 L16.4016617,8.49127796 Z"></path>
  </g></svg> Settings</a>
  <a class="dropdown-item userMenu pb-2 pt-2 pl-3 pr-5" href="/profile.php#plans"><svg class="mr-2 userMenuSvg" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg" ><path d="M4.78,5.15H4.15V2H3.09a1,1,0,0,1-.73.25V3a1.84,1.84,0,0,0,.7-.17V5.15H2.35V6H4.78Z"></path><path d="M3.62,8.88c.25,0,.39.12.39.35s-.17.41-.77.78c-1,.63-1.15,1.21-1.15,1.78V12H5v-.85H3.31c.06-.16.22-.35.72-.64.81-.43,1-.87,1-1.32C5,8.47,4.58,8,3.65,8A1.76,1.76,0,0,0,2.08,9l.72.52A1.07,1.07,0,0,1,3.62,8.88Z"></path><path d="M4.43,15.87A.82.82,0,0,0,5,15.05C5,14.4,4.53,14,3.65,14a2.15,2.15,0,0,0-1.51.61l.55.64a1.24,1.24,0,0,1,.88-.39c.27,0,.41.12.41.32s-.15.38-.67.38H3v.72h.31c.53,0,.76.13.76.46s-.15.42-.57.42a1.05,1.05,0,0,1-.85-.5L2,17.21A1.83,1.83,0,0,0,3.57,18c.94,0,1.55-.43,1.55-1.24A.87.87,0,0,0,4.43,15.87Z"></path><path d="M17,9H8a1,1,0,0,0,0,2h9a1,1,0,0,0,0-2Z"></path><path d="M17,15H8a1,1,0,0,0,0,2h9a1,1,0,0,0,0-2Z"></path><path d="M8,5h9a1,1,0,0,0,0-2H8A1,1,0,0,0,8,5Z">
  </path></svg>
 Plans</a>
  <a class="dropdown-item userMenu pb-2 pt-2 pl-3 pr-5" href="/contact.php"><svg class="mr-2 userMenuSvg" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg" style="height:23px"><path fill="inherit" d="M8.622 10.616c.078.08.14.175.183.28.044.105.07.218.07.332 0 .237-.087.456-.253.62-.167.168-.385.255-.622.255-.236 0-.455-.087-.62-.254-.167-.166-.255-.385-.255-.622 0-.114.027-.227.07-.332.044-.105.105-.2.184-.28.087-.088.174-.15.288-.193.324-.13.71-.052.954.193zm-.205-6.242c1.595 0 2.466.807 2.466 1.92 0 .976-.556 1.448-1.238 1.816-.615.317-.83.518-.904.898 0 .004-.034.207-.036.21-.034.126-.087.244-.18.336-.14.14-.323.21-.524.21-.097 0-.192-.017-.29-.052-.087-.035-.165-.088-.235-.158-.14-.14-.22-.333-.22-.533 0-.11.02-.188.074-.348.16-.472.55-.896 1.056-1.17.577-.327.84-.558.84-1.07 0-.42-.357-.715-.987-.715-.496 0-.996.218-1.39.52-.26.2-.62.202-.858-.02l-.05-.05c-.313-.29-.27-.787.075-1.04.603-.444 1.394-.753 2.4-.753zM8 13.25c-2.895 0-5.25-2.355-5.25-5.25S5.105 2.75 8 2.75 13.25 5.105 13.25 8 10.895 13.25 8 13.25M8 1C4.14 1 1 4.14 1 8s3.14 7 7 7 7-3.14 7-7-3.14-7-7-7">
  </path></svg>Support</a>
  <div class="dropdown-divider mt-2 mb-2"></div>
  <a class="dropdown-item userMenu pb-2 pt-2 pl-3 pr-5" href="/includes/logout.php" id="logoutArea">
    <svg class="userMenuSvg mr-2" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg" ><g fill="inherit"><path d="M15,2 L5,2 C4.447,2 4,2.447 4,3 L4,9 L9.586,9 L8.293,7.707 C7.902,7.316 7.902,6.684 8.293,6.293 C8.684,5.902 9.316,5.902 9.707,6.293 L12.707,9.293 C13.098,9.684 13.098,10.316 12.707,10.707 L9.707,13.707 C9.512,13.902 9.256,14 9,14 C8.744,14 8.488,13.902 8.293,13.707 C7.902,13.316 7.902,12.684 8.293,12.293 L9.586,11 L4,11 L4,17 C4,17.553 4.447,18 5,18 L15,18 C15.553,18 16,17.553 16,17 L16,3 C16,2.447 15.553,2 15,2"></path></g></svg>

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
          <div class="pt-2 pb-2">
            <p class="middleText"><span>OR</span></p>
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
        <div class="pt-3 pb-2">
            <p class="middleText"><span>OR</span></p>
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
       $('body').css('margin-bottom', parseInt($('#standard_footer').css("height")));
    });

    $(window).resize(function () {
      $('body').css('margin-bottom', parseInt($('#standard_footer').css("height")));
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
