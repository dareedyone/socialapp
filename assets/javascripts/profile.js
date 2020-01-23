"use strict";
$(document).ready(function() {
  // for profile pic and cover pic update
  $(document).click(function() {
    $("#userupload-error").removeClass("d-block");
    $("#userupload-error").addClass("d-none");
  });

  $("#myform").submit(function(event) {
    event.preventDefault();

    var fd = new FormData(this);
    $.ajax({
      url: "./includes/updatepicture.php",
      type: "POST",
      data: fd,
      contentType: false,
      processData: false,
      cache: false,

      success: function(data) {
        // console.log(data);
        $("#userupload-error").html(data);
        if (data.match("success")) {
          $("#userupload-error").removeClass("d-none");
          $("#userupload-error").removeClass("bg-warning");
          $("#userupload-error").addClass("d-block");
          $("#userupload-error").addClass("bg-primary");
          $("#upload-cover").val("");
          $("#upload-photo").val("");
          location.reload("true");
        } else {
          $("#userupload-error").removeClass("d-none");
          $("#userupload-error").removeClass("bg-primary");
          $("#userupload-error").addClass("d-block");
          $("#userupload-error").addClass("bg-warning");
        }
      }
    });
  });

  // Function to preview image after validation
  $(function() {
    $("#upload-photo").change(function() {
      $("#userupload-error").removeClass("d-block");
      $("#userupload-error").addClass("d-none");
      validPreview(this);
    });
    $("#upload-cover").change(function() {
      $("#userupload-error").removeClass("d-block");
      $("#userupload-error").addClass("d-none");
      validPreview(this);
    });

    let validPreview = param => {
      var file = param.files[0];
      var imagefile = file.type;
      var match = ["image/jpeg", "image/png", "image/jpg"];
      if (
        !(
          imagefile == match[0] ||
          imagefile == match[1] ||
          imagefile == match[2]
        )
      ) {
        $("#userupload-error").removeClass("d-none");
        $("#userupload-error").addClass("d-block");

        return false;
      } else {
        var reader = new FileReader();
        if (param.id == "upload-photo") {
          reader.onload = function imageIsLoaded(e) {
            $(".userpic").attr("src", e.target.result);
          };
          reader.readAsDataURL(file);
        } else {
          reader.onload = function imageIsLoaded(e) {
            $(".cover").css("background-image", "url(" + e.target.result + ")");
          };
          reader.readAsDataURL(file);
        }
      }
    };
  });
  // timeline, about, friends, photos functionality and rendering

  function handleRendering(arr, param) {
    $("#update-message").html("");
    arr.map(each => {
      $(each).removeClass("d-block");
      $(each).addClass("d-none");

      $(param).removeClass("d-none");
      $(param).addClass("d-block");
    });
  }
  let tmid = ["#timeline", "#about", "#friends", "#gallery"];
  let amid = [
    "#overview",
    "#contact",
    "#education",
    "#skills",
    "#details",
    "#settings"
  ];
  $("#timeline-btn").click(function() {
    handleRendering(tmid, "#timeline");
  });

  // Load profile (ABOUT) details.
  $("#about-btn").click(function() {
    handleRendering(tmid, "#about");
    $("#overview-btn").focus();
    $.post(
      "./includes/loadabout.php",

      function(response) {
        let obj = JSON.parse(response);
        // console.log(obj);
        let values = Object.values(obj);
        let checktruthy = values.filter(value => value).length > 0;
        let divsarr = [];
        let dp = `<div class="list-group-item list-group-item-action text-secondary">No records yet !</div>`;
        // console.log($("#overview"));
        // console.log("ayee cap");
        $("#overview").html(dp);
        // function doVisibilityClass() {
        //   $(`#${property}-visibility`).removeClass("text-secondary");
        //   $(`#${property}-visibility`).addClass("text-success");
        // return $("#overview").append(
        //   `<div class="list-group-item list-group-item-action text-primary d-flex justify-content-between">
        //  <div>${text}</div>
        //  <i class="fas ${icon} text-warning overview-icon"></i>
        //   </div>`
        // );
        // }

        function overviewDivs(obj, icon) {
          $(`#${property}-visibility`).removeClass("text-secondary");
          $(`#${property}-visibility`).addClass("text-success");
          obj["icon"] = icon;
          divsarr.push(obj);
        }

        if (checktruthy) {
          for (var property in obj) {
            if (obj[property]) {
              $(`input[name='${property}']`).val(`${obj[property].i}`);

              if (obj[property].i && obj[property].v == true) {
                // console.log(
                //   `${property}: ${obj[property].i}, ${
                //     obj[property].v
                //   }, output: ${obj[property].i && obj[property].v == true}`
                // );
                if (property == "birthdate") {
                  const monthNames = [
                    "January",
                    "February",
                    "March",
                    "April",
                    "May",
                    "June",
                    "July",
                    "August",
                    "September",
                    "October",
                    "November",
                    "December"
                  ];

                  const d = new Date(obj[property].i);
                  let month = monthNames[d.getMonth()];
                  let day = d.getDay();
                  let year = d.getYear();
                  const bd = month + " " + day;
                  obj["i"] = bd;
                  overviewDivs(obj, "fa-birthday-cake");
                } else if (property == "mobilenum") {
                  overviewDivs(obj[property], "fa-phone-alt");
                } else if (property == "contact_email") {
                  overviewDivs(obj[property], "fa-envelope");
                  $(`#${property}-visibility`).removeClass("text-secondary");
                  $(`#${property}-visibility`).addClass("text-success");
                } else if (property == "college_name") {
                  overviewDivs(obj[property], "fa-graduation-cap");
                } else if (property == "high_school") {
                  overviewDivs(obj[property], "fa-university");
                } else if (property == "social_handle") {
                  overviewDivs(obj[property], "fa-project-diagram");
                } else if (property == "current_city") {
                  overviewDivs(obj[property], "fa-city");
                }
              } else if ((obj[property].i = false && obj[property].v == true)) {
                // console.log("yiiii");

                $("#overview").html(dp);
              }
            }
          }
          // console.log(divsarr);
          $("#overview").html("");
          divsarr.map(e => {
            $("#overview").append(
              `<div class="list-group-item list-group-item-action text-primary d-flex justify-content-between">
               <div>${e.i}</div>
               <i class="fas ${e.icon} text-warning overview-icon"></i>
                </div>`
            );
          });
        }
      }
    );
  });

  $("#friends-btn").click(function() {
    handleRendering(tmid, "#friends");
  });

  $("#gallery-btn").click(function() {
    handleRendering(tmid, "#gallery");
  });

  ////about rendering

  $("#overview-btn").click(function() {
    handleRendering(amid, "#overview");
  });

  $("#contact-btn").click(function() {
    handleRendering(amid, "#contact");
  });

  $("#education-btn").click(function() {
    handleRendering(amid, "#education");
  });

  $("#skills-btn").click(function() {
    handleRendering(amid, "#skills");
  });

  $("#details-btn").click(function() {
    handleRendering(amid, "#details");
  });

  $("#settings-btn").click(function() {
    handleRendering(amid, "#settings");
  });

  //to make all inputs disabled when loose its focus
  // $("input").blur(() => $("input").attr("disabled", true));

  //For disabling all input fields pertaining to a set

  $(".fa-pen").click(function() {
    $("#update-message").html("");
    let id = `#${$(this)
      .parent()
      .attr("id")
      .replace("-edit", "")}`;
    $(`${id} input, ${id} select`).attr("disabled", (i, attr) => !attr);
    $(this).toggleClass("text-success");
  });

  //for submiting about set

  let formobj = {};
  let arr = [];
  let proccessForm = e => {
    e.preventDefault();
    // console.log(e.data.endpoint);
    let test = $(`#${e.target.id} input, #${e.target.id} select`);
    // console.log(test);
    let obj = {};
    for (let i = 0; i < test.length; i++) {
      arr.push(test[i].value);
    }
    let checkempty = arr.filter(el => el !== "");
    if (checkempty.length > 1) {
      for (let i = 0; i < test.length; i++) {
        // let obj = { i: test[i].value, v: 1 };
        // console.log(test[i].name);
        // formobj[test[i].name] = obj;
        if (
          test[i].name == "college_name" ||
          test[i].name == "high_school" ||
          test[i].name == "contact_email" ||
          test[i].name == "birthdate" ||
          test[i].name == "mobilenum" ||
          test[i].name == "social_handle" ||
          test[i].name == "current_city"
        ) {
          obj = { i: test[i].value, v: 1 };
          formobj[test[i].name] = obj;
        } else if (test[i].name == "oldpass" || test[i].name == "newpass") {
          obj = test[i].value;
          formobj[test[i].name] = obj;
        } else {
          obj = { i: test[i].value, v: 0 };
          formobj[test[i].name] = obj;
        }
      }

      // console.log(formobj);
      $.post(e.data.endpoint, formobj, function(response) {
        $("#update-message").html(response);
        if (response.trim() == "Update successful !") {
          $("#update-message").removeClass("text-danger");
          $("#update-message").addClass("text-success");
        } else {
          $("#update-message").removeClass("text-success");
          $("#update-message").addClass("text-danger");
        }
        // console.log(response);
      });
    } else {
      // console.log("fill the fields !");
      $("#update-message").html("fill the fields !");
      $("#update-message").removeClass("text-success");
      $("#update-message").addClass("text-danger");
    }

    formobj = {};
    checkempty = "";
    arr = [];
  };
  // $("#test-select").on("change", e => console.log(e.target.value));
  // $("#update-message").blur(() => $("#update-message").html(""));

  //submit each about button forms
  $("#contact").on(
    "submit",
    { endpoint: "./includes/updatecontact.php" },
    proccessForm
  );

  $("#education").on(
    "submit",
    { endpoint: "./includes/update_education.php" },
    proccessForm
  );

  $("#skills").on(
    "submit",
    { endpoint: "./includes/update_skills.php" },
    proccessForm
  );

  $("#settings").on(
    "submit",
    { endpoint: "./includes/update_password.php" },
    proccessForm
  );

  // to toggle visibility from backend
  $("#about .fa-eye").click(function() {
    $("#update-message").html("");
    $("#update-message").removeClass("text-success");
    $("#update-message").removeClass("text-danger");
    let target = this.id.replace("-visibility", "");

    if ($(`input[name='${target}']`).val()) {
      $.post(
        "./includes/about_visibility.php",
        {
          target
        },
        function(response) {
          if (response.match("visible")) {
            $(`#${target}-visibility`).removeClass("text-secondary");
            $(`#${target}-visibility`).addClass("text-success");
          } else if (response.match("error")) {
            $("#update-message").html("not successful !");
            $("#update-message").removeClass("text-success");
            $("#update-message").addClass("text-danger");
          } else if (response.match("hidden")) {
            $(`#${target}-visibility`).removeClass("text-success");
            $(`#${target}-visibility`).addClass("text-secondary");
          }
        }
      );
    } else {
      $("#update-message").html("You are yet to fill this info !");
      $("#update-message").removeClass("text-success");
      $("#update-message").addClass("text-danger");
    }
    // console.log();
    // target
    // console.log(this);
    // console.log(this);
  });
});
