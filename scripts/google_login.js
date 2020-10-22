
function moveToRegisterTab(){ // for moving from login tab to register tab after ext login fail msg
  $("#pills-signin-tab").removeClass("active");
  $("#pills-signup-tab").addClass("active");
  $("#pills-signin-body").removeClass("show active");
  $("#pills-signup-body").addClass("show active");
  $("#login-errorMsg").text(''); // clear any existing error messages
}

function onSignIn(googleUser) {
  var profile = googleUser.getBasicProfile();
  processGoogleLoginRequest(profile);

}

function processGoogleLoginRequest(profile){

  var id = profile.getId();
  var email = profile.getEmail();
  var name = profile.getName();

   // AJAX call to fb specific php login processor
   $.ajax({
     url: 'includes/social_login.php',
     type: 'post',
     data: {
       'externalLogin' : 1,
       'id' : id,
       'email' : email,
       'name' : name,
       'vendor' : 'google',
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

       else if(response=="loggedInExisting" || response=="loggedInNew" ){
         window.location.href = "../landing.php";
       }
     }
   });


}
