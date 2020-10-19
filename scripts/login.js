//hide all errors and guides to start with-->
$(document).ready(function() {
  $("#login-errorMsg").hide();
  $("#login").submit(function(event){
    event.preventDefault();
  });


  $(document).ajaxStart(function () {
    $("#loader").show();
  }).ajaxStop(function () {
    $("#loader").hide();
  });

});


$(document).ready(function() {

  // click submit and validate everything
  $('#login-submit').on('click', function(){

    var mailuid = $('#login-mailuid').val();
    var password = $('#login-pwd').val();

    var mailuid_valid = false;
    var password_valid = false;

    if(mailuid.length>0){
      username_valid = true;
    }

    if(password.length>0){
      password_valid = true;
    }

    if(mailuid_valid == false){
      $('#login-mailuid').addClass("is-invalid");
    }

    if(password_valid == false){
      $('#login-pwd').addClass("is-invalid");
    }

    if(password_valid == false || password_valid == false ){
      $("#login-errorMsg").text("Fill in all the fields");
      $("#login-errorMsg").slideDown();
    } else {
      $("#login-errorMsg").text("");
      $('#login-mailuid').removeClass("is-invalid");
      $('#login-pwd').removeClass("is-invalid");

      $.ajax({
        url: 'includes/login.php',
        type: 'post',
        data: {
          'save' : 1,
          'mailuid': mailuid,
          'password' : password,
        },
        timeout:3000, //5 second timeout
        error: function(xmlhttprequest, textstatus, message){
          if(textstatus==="timeout"){
            $("#errorMsg").text("The server didn't respond. Try clicking login again...");
          }

        },
        success: function(response){
          console.log(response);
          $("#login-errorMsg").show();
          if (response == 'sqlerror' ){
            $("#login-errorMsg").text('Database error, please try submitting again.');
          } else if (response == 'emptyfields' ){
            $("#login-errorMsg").text('Fill in all the fields');
          } else if (response == 'verifyemail' ){
            $("#login-errorMsg").text("You haven't verified your email yet. Click the link that was sent to your email to verify.");
          } else if (response == 'wrongpassword' ){
            $("#login-errorMsg").html("The password that you've entered is incorrect. <a href = 'forgot-password.php'> <b><u>Forgotten password?</u></b></a>");
          } else if (response == 'nouser' ){
            $("#login-errorMsg").html("The email address or username that you've entered doesn't match any account.  <a href = 'forgot-password.php'> <b><u>Sign up for an account.</u></b></a>");
          } else if (response == 'badrequest' ){
            $("#login-errorMsg").text("Something went wrong.");
          } else if (response == 'success' ){
            window.location.href = "landing.php"
          }

        }
      });
    }

  });
});
