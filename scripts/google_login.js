function google_login(){

  var googleAuth;
    gapi.load('auth2', function() {
        googleAuth = gapi.auth2.init({
        client_id: '29019688226-vrs2euoj57drdrq3krf5gs76bil3otsk.apps.googleusercontent.com'
      });

      googleAuth.signIn().then(callback);

      //googleAuth.then(checkForLoggedInUser);
    });

  function callback(){
    currentUser = googleAuth.currentUser.get();
    profile = currentUser.getBasicProfile();
    processGoogleLoginRequest(profile)
  }
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
       'emailReceived' : true,
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
