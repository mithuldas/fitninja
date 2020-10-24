
function fb_login(){
  FB.login(function(response){
    processFbLoginRequest(response);
  },
  {  scope:'public_profile,email'
  });
}

function moveToRegisterTab(){ // for moving from login tab to register tab after ext login fail msg
  $("#pills-signin-tab").removeClass("active");
  $("#pills-signup-tab").addClass("active");
  $("#pills-signin-body").removeClass("show active");
  $("#pills-signup-body").addClass("show active");
  $("#login-errorMsg").text(''); // clear any existing error messages
}

function processFbLoginRequest(response){
  if(response.status=="connected"){

    FB.api('/me', { locale: 'en_US', fields: 'id,name,email' }, function(response) {

      var id = response.id;
      var email = "empty";
      var name = "empty";
      var emailReceived = false;

      //set to true if we got an email from facebook
      if(typeof response.email != 'undefined'){
         emailReceived = true;
         email = response.email;
         name = response.name;
         console.log("email has been received");
       }
       // AJAX call to fb specific php login processor

       $.ajax({
         url: 'includes/social_login.php',
         type: 'post',
         data: {
           'externalLogin' : 1,
           'id' : id,
           'email' : email,
           'name' : name,
           'vendor' : 'facebook',
           'emailReceived' : emailReceived,
         },
         timeout:5000, //5 second timeout
         error: function(xmlhttprequest, textstatus, message){
           if(textstatus==="timeout"){
             $("#login-errorMsg").text('Something went wrong. Try once more and if it still does not work, please get in touch with us.');
             $("#login-errorMsg").slideDown();
           }

         },
         success: function(response){
           if (response == "sqlerror"){
             $("#login-errorMsg").text('There was a database error, please contact support.');
             $("#login-errorMsg").slideDown();
           }

           else if(response == "noEmail"){

             $("#login-errorMsg").html("We couldn't log you in through Facebook. Please <a href = \" #\" onClick= \"moveToRegisterTab();\"> <b><u>Register</b></u> </a> to login");
             $("#login-errorMsg").slideDown();

           }
           else if(response=="loggedInExisting" || response=="loggedInNew" ){
             window.location.href = "../includes/post_login_landing_controller.php";
           }
         }
       });

    });

  }
  else {
    console.log("not authorized ");
  }
}
