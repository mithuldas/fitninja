//hide all errors and guides to start with-->
$(document).ready(function() {
  $(".signup-error, .signup-guidance").hide();

  $(document).ajaxStart(function () {
    $("#loader").show();
  }).ajaxStop(function () {
    $("#loader").hide();
  });

  $("#username").focus(function(){
      $("#username-guidance").slideDown();
  });



  $("#username").blur(function(){
    $("#username-guidance").slideUp();
  });

  $("#email").focus(function(){
    $("#email-guidance").slideDown();
  });

  $("#email").blur(function(){
    $("#email-guidance").slideUp();
  });

  $("#signup").submit(function(event){
    event.preventDefault();
  });
});


$(document).ready(function() {
  var username_valid = false;
  var email_valid = false;
  var password_valid = false;
  var passwordRepeat_valid = false;

  // username validations
  $('#username').on('blur', function(){
    var username = $('#username').val();
    if (username == '') {
      username_valid = false;
      return;
    }
    $.ajax({
      url: 'includes/trainee_signup.php',

      type: 'post',
      data: {
      	'username_check' : 1,
      	'username' : username,
      },
      timeout:5000, //3 second timeout
      error: function(xmlhttprequest, textstatus, message){
        if(textstatus==="timeout"){
          //do nothing?
        }

      },
      success: function(response){
        if (response == 'invalidLength' ) {
        	username_valid = false;
          $('#username-error').slideDown();
          $('#username').addClass("is-invalid");
        	$('#username-error').html("<small> Your username should be at least 6 characters</small>");
        } else if (response == 'invalidCharacters') {
          username_valid = false;
          $('#username').addClass("is-invalid");
          $('#username-error').slideDown();
          $('#username-error').html("<small> Your username must only have letters, numbers, _ and .</small>");
        }else if (response == 'taken') {
          username_valid = false;
          $('#username').addClass("is-invalid");
          $('#username-error').slideDown();
          $('#username-error').html("<small> This username is already taken</small>");
        } else {
          username_valid = true;
          $('#username').removeClass("is-invalid");
          $('#username').addClass("is-valid");
          $('#username-error').html("");
        }
      }
    });

  });

  // email validation
  $('#email').on('blur', function(){
    var email = $('#email').val();
    // good
    if (email == '') {
      email_valid = false;
      return;
    }

    $.ajax({
      url: 'includes/trainee_signup.php',
      type: 'post',
      data: {
        'email_check' : 1,
        'email' : email,
      },
      timeout:5000, //3 second timeout
      error: function(xmlhttprequest, textstatus, message){
        if(textstatus==="timeout"){
          //do nothing?
        }

      },
      success: function(response){
        if (response == 'invalidEmail' ) {
          email_valid = false;
          $('#email-error').slideDown();
          $('#email').addClass("is-invalid");
          $('#email-error').html("<small> Provide a valid e-mail ID</small>");
        } else if(response == 'sqlerror'){
          $('#email-error').slideDown();
          $('#email').addClass("is-invalid");
          $('#email-error').html("Warning: SQL Erorr");
        } else if(response == 'emailExists'){
          $('#email-error').slideDown();
          $('#email').addClass("is-invalid");
          $('#email-error').html("<small>User with this e-mail already exists. Would you like to <a href='../forgot-password.php'><u> reset your password </u></a> instead?</small>");
        } else {
          email_valid = true;
          $('#email').removeClass("is-invalid");
          $('#email').addClass("is-valid");
          $('#email-error').html("");
        }
      }
    });
  });

  // password validation

  $('#password').on('blur', function(){
    var password = $('#password').val();
    var passwordRepeat = $('#passwordRepeat').val();

    if (password == '') {
      password_valid = false;
      return;
    }

    if(password && passwordRepeat){
      console.log("1");
      if(password!=passwordRepeat){
        console.log("2");
        passwordRepeat_valid = false;
        $('#passwordRepeat').removeClass("is-valid");
        $('#passwordRepeat').addClass("is-invalid");
        $('#passwordRepeat-error').html("<small> Passwords don't match</small>");
        $('#passwordRepeat-error').slideDown();
      } else {
        $('#passwordRepeat').removeClass("is-invalid");
        $('#passwordRepeat').addClass("is-valid");
        $('#passwordRepeat-error').html("");
        $('#passwordRepeat-error').hide();
      }
    }

    $.ajax({
      url: 'includes/trainee_signup.php',
      type: 'post',
      data: {
        'password_check' : 1,
        'password' : password,
      },
      timeout:5000, //3 second timeout
      error: function(xmlhttprequest, textstatus, message){
        if(textstatus==="timeout"){
          //do nothing?
        }

      },
      success: function(response){
        if (response == 'invalidPasswordLength' ) {
          password_valid = false;
          $('#password-error').slideDown();
          $('#password').addClass("is-invalid");
          $('#password-error').html("<small> Password must contain at least 8 characters</small>");
        } else if (response == 'complexityFailed' ){
          $('#password-error').slideDown();
          $('#password').addClass("is-invalid");
          $('#password-error').html("<small> Password should contain at least 1 upper case, 1 lowercase and 1 number</small>");
        } else {
          password_valid = true;
          $('#password').removeClass("is-invalid");
          $('#password').addClass("is-valid");
          $('#password-error').html("");
        }
      }
    });
  });

  // password repeat validation

  $('#passwordRepeat').on('blur', function(){
    var passwordRepeat = $('#passwordRepeat').val();
    var password = $('#password').val();
    // good
    if (passwordRepeat == '') {
      passwordRepeat_valid = false;
      return;
    }

    $.ajax({
      url: 'includes/trainee_signup.php',
      type: 'post',
      data: {
        'passwordRepeat_check' : 1,
        'password' : password,
        'passwordRepeat' : passwordRepeat,
      },
      timeout:5000, //3 second timeout
      error: function(xmlhttprequest, textstatus, message){
        if(textstatus==="timeout"){
          //do nothing?
        }

      },
      success: function(response){
        if (password && password_valid == false){
          passwordRepeat_valid = false;
          $('#passwordRepeat').addClass("is-invalid");
        } else if (password && response == 'mismatch' ) {
          passwordRepeat_valid = false;
          $('#passwordRepeat-error').slideDown();
          $('#passwordRepeat').addClass("is-invalid");
          $('#passwordRepeat-error').html("<small> Passwords don't match</small>");
        } else {
          passwordRepeat_valid= true;
          $('#passwordRepeat').removeClass("is-invalid");
          $('#passwordRepeat').addClass("is-valid");
          $('#passwordRepeat-error').html("");
        }
      }
    });
  });

  // click submit and validate everything
  $('#submit').on('click', function(){
    var username = $('#username').val();
    var email = $('#email').val();
    var passwordRepeat = $('#passwordRepeat').val();
    var password = $('#password').val();

    if(username_valid == false || email_valid == false || password_valid == false || passwordRepeat_valid == false){
      $("#errorMsg").text('Please fix all the errors first');
      $("#errorMsg").slideDown();

    } else {
      // clear errors
      $("#errorMsg").text('');
      // submit the form!
      $.ajax({
        url: 'includes/trainee_signup.php',
        type: 'post',
        data: {
          'save' : 1,
          'username': username,
          'email': email,
          'password' : password,
        },
        timeout:5000, //5 second timeout
        error: function(xmlhttprequest, textstatus, message){
          if(textstatus==="timeout"){
            $("#errorMsg").text("The server didn't respond. Try clicking submit again...");
          }

        },
        success: function(response){
          if (response == 'sqlerror' ){
            $("#errorMsg").text('Database error, please try submitting again.');
          } else {
            window.location = 'index.php?status=verification-sent&email=' + email;
          }

        }
      });

    }

  });
});
