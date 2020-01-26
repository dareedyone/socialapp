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
  let user;
  //fetch all visiting user data and check for request after
  $.post("./includes/visitprofile_id.php", { visitId }, function(data) {
    // console.log(data);
    let a = JSON.parse(data);
    console.log(a);
    if (a) {
      user = a[0];
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
  //load post api call
  $.post("./includes/loadprofileposts.php", { visitId }, function(data) {
    console.log($(".profile-posts-container"));
    // profile-posts-container
    if (data !== "") {
      let posts = JSON.parse(data);
      console.log(posts);
      posts = posts.sort(function(a, b) {
        return b.post_id - a.post_id;
      });
      console.log(posts);
      renderPosts(posts);
    }
  });
  //load posts from home and profile
  function renderPosts(arr) {
    let postHtml = arr.map((post, index) => {
      let postImageDisp = "d-none";
      let postLikeComDisp = "d-none";
      let likerIds = post.liker_id;
      let userLikeCondition = false;
      let commentsId = post.comment_id;
      let commenterId = post.commenter_id;
      let commenterName = post.commenter_fullname;
      let commenterPic = post.commenter_picture;
      let commentText = post.comment_text;
      let commentTime = post.comment_time;
      let commentDisp = "d-none";
      let commentsHtml = "";
      let commentCount = 0;
      // let commentHtml = "";
      let likeCount = "";
      if (likerIds !== null) {
        postLikeComDisp = "d-block";
        likerIds = likerIds.split(",");
        // console.log(likerIds, index);

        // console.log(userId, "useriddd");
        function checKIfUserId(el) {
          return el == visitId;
        }
        userLikeCondition = likerIds.find(checKIfUserId);
        // console.log(userLikeCondition, "my new", index);

        //for if user has like a post already
        if (userLikeCondition !== undefined) {
          userLikeCondition = "text-primary";
        } else {
          userLikeCondition = "text-secondary";
        }
        likeCount = likerIds.length;
      }

      function renderComments(arr, arr1, arr2, arr3, arr4) {
        // console.log(arr, arr1, arr2, arr3, arr4);
        let commentHtml = "";
        for (let i = 0; i < arr.length; i++) {
          // console.log(arr1[i], arr2[i], arr3[i], arr4[i], index);
          commentHtml += `<div class="d-flex mt-2">
          <a href="visitprofile.php?id='${arr1[i]}'">
           <img class="profile-pic mr-2 rounded-circle" src="assets/pictures/${arr2[i]}"
              alt="profile picture">
          </a>
          <div class="bg-my-secondary rounded w-100">
              <h6 class="color-second px-2">${arr3[i]}</h6>
              <span class="px-2 real-comment">${arr4[i]}</span>
          </div>
      </div>`;
          // console.log(commentHtml);
          // if (arr.length - 1 == i) {
          //   console.log("last");
          // }
          // return myhtml;
        }
        return commentHtml;
        // console.log(commentHtml);
      }

      if (commentsId !== null) {
        commentDisp = "d-block";
        postLikeComDisp = "d-block";
        commentsId = commentsId.split(",");
        commenterId = commenterId.split(",");
        commentCount = commentsId.length;
        commenterName = commenterName.split(",");
        commenterPic = commenterPic.split(",");
        commentText = commentText.split("----");
        commentTime = commentTime.split(",");
        commentsHtml = renderComments(
          commentsId,
          commenterId,
          commenterPic,
          commenterName,
          commentText
        ).trim();
        // console.log(commentsHtml);
      }

      //show or hide post image based on the condition that it exists
      post.post_image !== null
        ? (postImageDisp = "d-block")
        : (postImageDisp = "d-none");
      const monthNames = [
        "Jan",
        "Feb",
        "Mar",
        "Apr",
        "May",
        "Jun",
        "Jul",
        "Aug",
        "Sep",
        "Oct",
        "Nov",
        "Dec"
      ];
      let postDispTime = "";
      let test = post.post_time;
      let d = new Date(test);
      let nd = new Date();
      let dateDiff = nd - d;
      let ddSec = dateDiff / 1000;
      let ddMin = ddSec / 60;
      let ddHours = ddMin / 60;
      let ddDays = ddHours / 24;

      let pDateDay = d.getDay();
      let pDateMonth = monthNames[d.getMonth()];
      // console.log(dateDiff);
      // console.log(pDateDay, "pdd");
      // console.log(pDateMonth, "pdm");
      // console.log(ddSec, "ddsec");
      // console.log(ddMin, "dmin");
      // console.log(ddHours, "dHours");
      // console.log(ddDays, "ddDays");

      if (ddSec < 60) {
        postDispTime = `${Math.floor(ddSec)}s`;
        // console.log("sec do");
      } else if (ddMin >= 1 && ddMin < 60) {
        postDispTime = `${Math.floor(ddMin)}m`;
        // console.log("min do");
      } else if (ddHours >= 1 && ddHours < 24) {
        postDispTime = `${Math.floor(ddHours)}h`;
        // console.log("hour do");
      } else if (ddDays >= 1 && ddDays < 7) {
        postDispTime = `${Math.floor(ddDays)}d`;
        // console.log("day do");
      } else {
        postDispTime = `${pDateDay} ${pDateMonth}`;
        // console.log("else do");
      }
      // console.log(postDispTime, "sd");

      return `<div class="card-body bg-white p-2 mb-3 posts">
  <a href="visitprofile.php?id='${
    post.user_id
  }'" class="card-title position-relative d-flex">
      <img class="status-pic rounded-circle mr-3" src="assets/pictures/${
        post.picture
      }"
          alt="profile picture">
      <div class="d-flex pr-4 w-100 justify-content-between">
          <h6 class="color-second">${post.firstname} ${post.lastname}</h6>
          <span class="border border-primary type px-1">Student</span>
      </div>

      <span class="position-absolute timespan text-secondary">${postDispTime}</span>
  </a>
  <p class="card-text">${post.post_text}</p>
  <img class="w-100 ${postImageDisp}" src="assets/pictures/${
        post.post_image == null ? "128801575470745.jpg" : post.post_image
      }" alt="post picture">
  
      <div class="${postLikeComDisp} post-like-con">
  <hr class="m-1">
  <div class="d-flex justify-content-between px-3">
      <div class="d-flex">
          <div class="bg-primary like-container position-relative mr-1 rounded-circle">
              <i class="fas position-absolute like fa-thumbs-up"></i>
          </div>

          <div class="like-count text-secondary">${likeCount}</div>
      </div>

      <div class="text-secondary">
         <span class="commentNum">${commentCount} Comment</span>
      </div>

  </div> 
</div>

  <hr class="m-2">
  <div class="d-flex justify-content-around text-secondary">
      <button value="${post.post_id}" class="btn post-like">
          <i class="far fa-thumbs-up ${userLikeCondition}"></i>
          <span class="${userLikeCondition}">Like</span>
      </button>

      <button value="${post.post_id}" class="btn post-comment">
          <i class="far fa-comment-alt text-secondary"></i>
          <span>Comment</span>
      </button>
  </div>

                  <hr class="m-2">
                    <div class="post-comment-contain ${commentDisp}">
                        
                       ${commentsHtml} 
                    </div>

                    <div class="d-flex mt-2">
                    <img class="profile-pic mr-2 rounded-circle" src="assets/pictures/${
                      user.picture
                    }" alt="profile picture">
                    <div class="post-comment-input-contain d-flex w-90">
                       
                        <textarea placeholder="write a comment here"
                            class="post-comment-input resize-none bg-my-secondary rounded-left border outline-none border-secondary border-right-0 w-90 px-2 outline-none"
                            name="post-text" cols="30" rows="1"></textarea>
                        <div
                            class="bg-my-secondary border border-secondary border-left-0 rounded-right px-2 outline-none">
                            <button  value="${
                              post.post_id
                            }" class="btn post-comment-btn p-0"><i
                                    class="far fa-comment-alt text-secondary"></i></button>
                        </div>
                    </div>
                </div>
              </div>`;
    });
    // console.log($("#home-timeline"));
    $(".visit-profile-posts-container").html(postHtml);
  }
});
