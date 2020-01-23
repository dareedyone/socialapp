"use strict";
$(document).ready(function() {
  let requestid;
  let visitId;
  let params = new URLSearchParams(location.search);
  params = params.get("id");
  if (params !== null) {
    visitId = params.match(/\d+/)[0];
  }

  //for checking if request exist
  function checkRequest() {
    $.post("./includes/checkrequest.php", { visitId }, function(data) {
      if (data.trim() !== "none found") {
        let id = JSON.parse(data)[0].id;
        let type = JSON.parse(data)[1];

        //type one means the user send request to the visiting page
        if (type == 1) {
          requestid = id;
          $(".oneforall").removeAttr("id", "add_friend");
          $(".oneforall").attr("id", "cancel_request");
          $(".oneforall").html("Cancel request");
          //type 2 means the visitor send request to the user
        } else if (type == 2) {
          //add confirm and delete button
          $(".primary-btn-container").html(`  
      <button value=${id}
          class="confirm_request visit-profile-confirm btn border border-secondary my-0 py-0">Confirm</button>
      <button value=${id}
          class="reject_request btn my-bgdanger text-white border border-secondary my-0 py-0">Reject</button>
          <button type="button" id="changeee"
          class="btn btn-secondary ml-1 mx-1 my-1">message</button>
          `);
          // console.log("2 seen", id);
        }
        // console.log(JSON.parse(data));
      }

      // console.log(requestid);
    });
  }

  //check if visitee is a friend

  function checkFriend() {
    $.post("./includes/checkfriend.php", { visitId }, function(data) {
      if (data.trim() !== "none") {
        let fid = JSON.parse(data).id;
        $(".primary-btn-container").html(`
          <button value='${fid}' class="unfriend btn border btn-danger mx-1 my-1" type="button">Unfriend</button>
          <button type="button" id="changeee" class="btn btn-secondary border ml-1 mx-1 my-1">message</button>`);
      }
    });
  }

  //fetch all visiting user data and check for request after
  $.post("./includes/visitprofile_id.php", { visitId }, function(data) {
    // console.log(data);
    let a = JSON.parse(data);
    console.log(a);
    if (a) {
      let user = a[0];
      let fullname = `${user.firstname} ${user.lastname}`;
      let picnumber = a[2];
      let vfriends = a[5];
      let vfdcount = a[6];
      let allpic = a[1].map(
        pic => `<img src="assets/pictures/${pic.name}" alt="photo">`
      );
      $("#visit_username").html(fullname);
      if (a[1].length > 0) {
        $(".visit_display-user-pic").attr(
          "src",
          `assets/pictures/${user.picture}`
        );
        $(".visit_cover").css(
          "background-image",
          `url(assets/pictures/${user.cover})`
        );
      }
      if (picnumber > 0) {
        $("#visit_user-gallery").html(allpic);
        $(".visit_picnum").html(picnumber);
      } else {
        $("#visit_user-gallery").html(
          "<small class='text-secondary'>No pictures yet !</small>"
        );
      }

      checkRequest();
      checkFriend();
      if (vfdcount > 0) {
        $("#vfdnum").html(vfdcount);
        let fdids = vfriends.map(el => (el.f1 == visitId ? el.f2 : el.f1));
        let conserial = vfriends.map(el => el.id);
        let fds;
        // console.log(fdids);
        // console.log(conserial);
        $.post("./includes/loadfriends.php", { fdids }, function(data) {
          let a = JSON.parse(data);
          // console.log(a);
          fds = a.map((user, index) => {
            return `<div class="d-flex w-48 user-friends-contain justify-content-between align-items-center mb-3">
      <a href="visitprofile.php?id='${user.user_id}'" class="d-flex friends-link">
          <img class="friend-pic" src="assets/pictures/${user.picture}" alt="friends picture">
          <div class="align-self-center">
              <h6 class="color-second m-0">${user.firstname} ${user.lastname}</h6>
              <span class="text-secondary m-0 mutual">-- mutual friends</span>
          </div>
      </a>

      <a href="visitprofile.php?id='${user.user_id}"><button class="btn border btn-primary" type="button">
      View
      </button></a>
  </div>`;
          });

          $("#v_friends_display").html(fds);
        });
      }
    }
  });

  // timeline, about, friends, photos functionality and rendering

  function handleRendering(arr, param) {
    $("#visit_update-message").html("");
    arr.map(each => {
      $(each).removeClass("d-block");
      $(each).addClass("d-none");

      $(param).removeClass("d-none");
      $(param).addClass("d-block");
    });
  }
  let tmid = ["#timeline", "#visit_about", "#friends", "#gallery"];
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
  //change about btn to load for visit
  $("#visit_about-btn").click(function() {
    handleRendering(tmid, "#visit_about");
    $("#overview-btn").focus();
    $.post(
      "./includes/loadabout.php",
      { visitId },

      function(response) {
        let obj = JSON.parse(response);

        // console.log(obj);
        let values = Object.values(obj);
        let checktruthy = values.filter(value => value).length > 0;
        let divsarr = [];
        let dp = `<div class="list-group-item list-group-item-action text-secondary">No records yet !</div>`;
        $("#overview").html(dp);

        function overviewDivs(obj, icon) {
          $(`#${property}-visibility`).removeClass("text-secondary");
          $(`#${property}-visibility`).addClass("text-success");
          obj["icon"] = icon;
          divsarr.push(obj);
        }

        if (checktruthy) {
          for (var property in obj) {
            if (obj[property]) {
              if (obj[property].i && obj[property].v == true) {
                $(`input[name='${property}']`).val(`${obj[property].i}`);

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
                let dp = `<div class="list-group-item list-group-item-action text-secondary">No records yet !</div>`;
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

  //add friend functionality

  $(".oneforall").click(function() {
    console.log("ayiiiiii");
    $("#visit_update-message").html("");
    if ($(".oneforall").attr("id") == "add_friend") {
      $.post("./includes/sendrequest.php", { visitId }, function(response) {
        if (response.match("success")) {
          checkRequest();
        } else {
          $("#visit_userupload-error").removeClass("d-none");
          $("#visit_userupload-error").removeClass("bg-primary");
          $("#visit_userupload-error").addClass("d-block");
          $("#visit_userupload-error").addClass("bg-warning");
          $("#visit_userupload-error small").html(response);
        }
        // console.log(response);
      });
    } else {
      if (requestid) {
        $.post("./includes/cancelrequest.php", { requestid }, function(
          response
        ) {
          if (response.trim() == "success") {
            $(".oneforall").removeAttr("id", "cancel_request");
            $(".oneforall").attr("id", "add_friend");
            $(".oneforall").html("Add friend");
          }
        });
      }
    }
  });

  // $("#cancel_request").click(function() {
  //   console.log("seeing cancel request.");
  // });
});
