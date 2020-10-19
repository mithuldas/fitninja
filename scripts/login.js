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

    var username = $('#login-mailuid').val();
    var password = $('#login-pwd').val();

    var username_valid = false;
    var password_valid = false;

    if(username.length>0){
      username_valid = true;
    }

    if(password.length>0){
      password_valid = true;
    }

    if(username_valid == false){
      $('#login-mailuid').addClass("is-invalid");
    }

    if(username_valid == false){
      $('#login-pwd').addClass("is-invalid");
    }

    if(username_valid == false || password_valid == false ){
      $("#login-errorMsg").text("Fill in all the fields");
      $("#login-errorMsg").slideDown();
    } else {
      $("#login-errorMsg").text("");
      $('#login-mailuid').removeClass("is-invalid");
      $('#login-pwd').removeClass("is-invalid");
    }

  });
});
