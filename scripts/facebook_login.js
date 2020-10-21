
function fb_login(){
  FB.login(function(response){
    console.log(response);

    if(response.status=="connected"){

      FB.api('/me', { locale: 'en_US', fields: 'name, email' },
      function(response) {
       if(typeof response.email == 'undefined'){
         console.log("authorized BUT didn't get an e-mail");
       } else {
         console.log("authorized AND got an email");
       }
      }
      );
    }
    else {
      console.log("not authorized ");
    }
  },
  {
      scope:'public_profile,email'
  });
}
