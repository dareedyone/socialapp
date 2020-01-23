"use strict";
new WOW().init();
$(document).ready(function() {
  $("#c2a-button").click(function() {
    $("#myAlert").removeClass("d-block");
    $("#myAlert").addClass("d-none");
    $("#register").toggleClass("d-block");
    $("#login").toggleClass("d-none");

    if ($(this).text() == "Login") {
      $(this).text("Register");
    } else {
      $(this).text("Login");
    }
  });

  $("#register").submit(function(event) {
    let fname = document.getElementsByName("fname")[0].value;
    let lname = document.getElementsByName("lname")[0].value;
    let email = document.getElementsByName("email")[0].value;
    let passw1 = document.getElementsByName("passw")[0].value;
    let passw2 = document.getElementsByName("rpassw")[0].value;
    let rsubmit = document.getElementsByName("rsubmit")[0].value;
    event.preventDefault();
    $("#myAlert").addClass("d-none");
    if (passw1 !== passw2) {
      $("#myAlert").addClass("d-block");
      $("#myAlert").html("Password does not match !");
      $("#myAlert").addClass("alert-danger");
    } else {
      $.post(
        "./includes/register.php",
        {
          fname: fname,
          lname: lname,
          email: email,
          passw: passw1,
          rsubmit: rsubmit
        },
        function(data) {
          // console.log(data);
          $("#myAlert").removeClass("d-none");
          $("#myAlert").addClass("d-block");

          $("#myAlert").html(data);
          if (data.trim() === "Registration Successful.. Sign In") {
            document.getElementsByName("fname")[0].value = "";
            document.getElementsByName("lname")[0].value = "";
            document.getElementsByName("email")[0].value = "";
            document.getElementsByName("passw")[0].value = "";
            document.getElementsByName("rpassw")[0].value = "";

            $("#myAlert").removeClass("alert-danger");
            $("#myAlert").addClass("alert-primary");
          } else {
            $("#myAlert").removeClass("alert-primary");
            $("#myAlert").addClass("alert-danger");
          }
        }
      );
    }
  });

  $("#login").submit(function(event) {
    event.preventDefault();
    $("#mySucc").addClass("d-none");
    let logemail = document.getElementsByName("logemail")[0].value;
    let logpass = document.getElementsByName("logpass")[0].value;
    let logbtn = document.getElementsByName("logbtn")[0].value;
    $.post(
      "./includes/login.php",
      {
        logemail: logemail,
        logpass: logpass,
        logbtn: logbtn
      },
      function(response) {
        if (response.trim() == "good") {
          window.location = "home.php";
        } else {
          $("#mySucc").html(response);
          $("#mySucc").removeClass("d-none");
          $("#mySucc").addClass("d-block");
        }
      }
    );
  });
});
