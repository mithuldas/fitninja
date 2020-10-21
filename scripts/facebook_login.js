
function fb_login(){
  FB.login(function(response){
    processFbLoginRequest(response);
  },
  {  scope:'public_profile,email'
  });
}

function processFbLoginRequest(response){
  if(response.status=="connected"){

    FB.api('/me', { locale: 'en_US', fields: 'name,email' }, function(response) {

      var emailReceived = false;
      //set to true if we got an email from facebook
      if(typeof response.email != 'undefined'){
         emailReceived = true;
         var email = response.email;
         var name = response.name;
         console.log("email has been received");
       }
       // AJAX call to fb specific php login processor
       // Possible request parameters - emailReceived, emailNotReceived
       // response not expected
       $.ajax({
         url: 'includes/process_external_login.php',
         type: 'post',
         data: {
           'externalLogin' : 1,
           'email' : email,
           'name' : name,
           'vendor' : 'facebook',
           'emailReceived' : emailReceived,
         },
         timeout:5000, //5 second timeout
         error: function(xmlhttprequest, textstatus, message){
           if(textstatus==="timeout"){
             $("#login-errorMsg").text('Something went wrong. Try once more and if it still does not work, please get in touch with us.');
           }

         },
         success: function(response){
           if(response=="loginSuccess"){
             window.location.href = "../landing.php";
           }
         }
       });

    });

  }
  else {
    console.log("not authorized ");
  }
}
