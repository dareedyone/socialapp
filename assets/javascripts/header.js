"use strict";
// new WOW().init();
$(document).ready(function() {
  let rqcount = 0;
  let fdcount = 0;
  let userId;
  let user;
  let fullname;
  $.post("./includes/session.php", function(data) {
    console.log(data);
    const a = JSON.parse(data);

    if (a) {
      user = a[0];
      fullname = `${user.firstname} ${user.lastname}`;
      let picnumber = a[2];
      let requests = a[3];
      rqcount = a[4];
      let friends = a[5];
      fdcount = a[6];
      userId = a[7];

      let rq;

      let allpic = a[1].map(
        pic => `<img src="assets/pictures/${pic.name}" alt="photo">`
      );

      // console.log(picnumber);
      $("#username").html(fullname);
      if (a[1].length > 0) {
        $(".display-user-pic").attr("src", `assets/pictures/${user.picture}`);
        $(".cover").css(
          "background-image",
          `url(assets/pictures/${user.cover})`
        );
      }
      if (picnumber > 0) {
        $("#user-gallery").html(allpic);
        $(".picnum").html(picnumber);
      } else {
        $("#user-gallery").html(
          "<small class='text-secondary'>You have no pictures yet !</small>"
        );
      }

      if (rqcount > 0) {
        $("#requests_count").removeClass("invisible");
        $("#requests_count").addClass("visible");
        $("#requests_count").html(rqcount);
        let reqs = requests.map(el => el.sender_id);
        let reqsid = requests.map(el => el.id);
        // console.log(reqsid);
        $.post("./includes/loadrequests.php", { reqs }, function(data) {
          let a = JSON.parse(data);
          // console.log(a);
          rq = a.map((user, index) => {
            return `<div class="d-flex req-ele friend-suggest px-2  justify-content-between">
            <a class="request_link d-flex" href="visitprofile.php?id='${user.user_id}'">
                <img class="status-pic mr-2 rounded-circle" src="assets/pictures/${user.picture}"
                    alt="pp">
                <div>
                    <h6 class="color-second  m-0">${user.firstname} ${user.lastname}</h6>
                    <p class="text-secondary m-0"><span>--</span> mutual friends</p>
                </div>
            </a>
            <div class="request_btn_container mt-0">
                <button value=${reqsid[index]} class="req-ele confirm_request btn border confirm border-secondary my-0 py-0">Confirm</button>
                <button value=${reqsid[index]} class="req-ele reject_request btn my-bgdanger text-white border border-secondary my-0 py-0">Reject</button>
            </div>
        </div>
        <hr>`;
          });
          $("#requests_mini_display").html(rq);
        });
      } else {
        rq = `<div class="friend-suggest px-2  justify-content-between text-center">
        <div class="mt-3"> No requests available !</div>
      
    </div>
    <hr>`;
        $("#requests_mini_display").html(rq);
      }

      $("#requests_mini_display").html(rq);

      if (fdcount > 0) {
        $(".fdnum").html(fdcount);
        let fdids = friends.map(el => (el.f1 == userId ? el.f2 : el.f1));
        let conserial = friends.map(el => el.id);
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

      <button value='${conserial[index]}' class="unfriend btn border btn-danger" type="button">Unfriend</button>
  </div>`;
          });

          $("#friends_display").html(fds);
        });
      }
    }
  });

  $(document).on("click", ".confirm_request", function() {
    let mybutton = this;

    $.post(
      "./includes/confirmrequest.php",
      { requestid: mybutton.value },
      function(response) {
        // console.log(response);
        if (response.trim() !== "none") {
          let fid = JSON.parse(response).id;
          // console.log(fid);
          mybutton.value = "";
          $(".request_btn_container").html(
            `<button class="btn border text-white border-secondary bg-primary my-0 py-0">Accepted</button>`
          );
          $(".primary-btn-container").html(`
          <button value='${fid}' class="unfriend btn border btn-danger mx-1 my-1" type="button">Unfriend</button>
          <button type="button" id="changeee" class="btn btn-secondary ml-1 mx-1 my-1">message</button>`);

          if (rqcount - 1 < 1) {
            $("#requests_count").removeClass("visible");
            $("#requests_count").addClass("invisible");
          } else {
            $("#requests_count").removeClass("invisible");
            $("#requests_count").addClass("visible");
            $("#requests_count").html(rqcount - 1);
          }
        }
      }
    );
  });

  $(document).on("click", ".reject_request", function() {
    let mybutton = this;
    // console.log(
    //   $(mybutton)
    //     .parent()
    //     .attr("class")
    // );
    $.post(
      "./includes/cancelrequest.php",
      { requestid: mybutton.value },
      function(response) {
        if (response.trim() == "success") {
          // console.log(response);
          mybutton.value = "";
          $(".request_btn_container").html(
            `<button class="btn border text-white border-dark bg-secondary my-0 py-0">Rejected</button>`
          );
          $(".primary-btn-container").html(` 
          <button class="btn border text-white border-dark bg-warning my-0 py-0">Rejected</button>
          <button type="button" id="changeee"
          class="btn btn-secondary border ml-1 mx-1 my-1">message</button>`);
          // $(mybutton)
          //   .parent()
          //   .html(
          //     `<button class="btn border text-white border-secondary bg-secondary my-0 py-0">Rejected</button>`
          //   );

          if (rqcount - 1 < 1) {
            $("#requests_count").removeClass("visible");
            $("#requests_count").addClass("invisible");
          } else {
            $("#requests_count").removeClass("invisible");
            $("#requests_count").addClass("visible");
            $("#requests_count").html(rqcount - 1);
          }
        }
      }
    );
  });

  $(document).on("click", ".unfriend", function() {
    let mybutton = this;
    // console.log(this, this.value);
    // console.log($(this).parent());
    let parentClass = $(this)
      .parent()
      .attr("class");

    // console.log(parentClass);

    // console.log(parentClass.match("primary-btn-contain"));

    $.post("./includes/unfriend.php", { friendid: mybutton.value }, function(
      response
    ) {
      if (response.trim() == "success") {
        if (fdcount - 1 > 0) {
          $(".fdnum").html(fdcount - 1);
        } else {
          $(".fdnum").html("");
        }

        $(mybutton).removeClass("unfriend");
        $(mybutton).removeClass("btn-danger");
        $(mybutton).addClass("btn-secondary");
        $(mybutton).html("Done");
      }
    });
  });

  //proper rendering of view friend request button
  $(document).click(function(e) {
    if (e.target.className.match("req-ele")) {
      $("#request-view").css("display", "block");
    } else {
      $("#request-view").css("display", "none");
    }
  });

  $("#dropdownMenuLink").click(function() {
    $("#request-view").css("display") == "none"
      ? $("#request-view").css("display", "block")
      : $("#request-view").css("display", "none");
  });

  // $.post("./includes/session.php", function(data) {
  //   let a = JSON.parse(data);
  //   // console.log(a) ;
  //   if (a) {
  //     let user = a[0];
  //     let picnumber = a[2];
  //     let fullname = `${user.firstname} ${user.lastname}`;
  //     let allpic = a[1].map(
  //       pic => `<img src="assets/pictures/${pic.name}" alt="photo">`
  //     );

  //     $("#username").html(fullname);
  //     $(".display-user-pic").attr("src", `assets/pictures/${user.picture}`);
  //     $(".cover").css("background-image", `url(assets/pictures/${user.cover})`);

  //     if (picnumber > 0) {
  //       $("#user-gallery").html(allpic);
  //       $(".picnum").html(picnumber);
  //     } else {
  //       $("#user-gallery").html("You have no pictures yet");
  //     }
  //   }
  // });

  $("#logout").click(function() {
    // alert();
    // console.log(1234);
    // event.preventDefault();
    $.post(
      "./includes/logout.php",

      function(response) {
        // console.log(response);
        if (response.trim() == "destroyed") {
          window.location = "index.php";
        }
      }
    );
  });

  /////search icon rendering
  $("#secondary-search-btn").click(function() {
    doDisplay(".search-tab-secondary");
    $(".search-tab-secondary").focus();
  });
  function doDisplay(ele) {
    $(ele).removeClass("d-none");
    $(ele).addClass("d-block");
  }
  function undoDisplay(ele) {
    $(ele).removeClass("d-block");
    $(ele).addClass("d-none");
  }
  // });
  $("#input-search").on("focus", () => doDisplay(".search-tab"));
  $("#input-search").on("blur", () => undoDisplay(".search-tab"));
  $("#search-btn").click(function() {
    $("#input-search").focus();
  });
  $(".search-tab-secondary").on("blur", () =>
    undoDisplay(".search-tab-secondary")
  );

  //search endpoint

  function doUserSearch() {
    // console.log(this.id, $(this).id);
    let inpId = this.id;
    let holder;
    // to know if to render for desktop or mobile
    inpId == "input-search"
      ? (holder = ".search-tab")
      : (holder = "#secondary-holder");
    // console.log($(".search-tab"));
    if ($(this).val().length >= 1) {
      let paramarr = $(this)
        .val()
        .split(" ");
      let objparam = { firstname: paramarr[0] };
      // console.log(paramarr, paramarr.length);
      if (paramarr.length > 1 && paramarr[1].length > 0) {
        objparam["lastname"] = paramarr[1];
        // console.log(paramarr[1].length);
      }
      // console.log(objparam);

      $.post("./includes/handlesearch.php", objparam, function(response) {
        $(holder).html("");
        // console.log(response, typeof JSON.parse(response));
        if (response.match("Search can't be found !")) {
          $(holder)
            .append(`<li class="list-group-item border-0 py-2 text-danger text-center font-italic body-home">
          No search found !
      </li>`);
        } else {
          let resarr = JSON.parse(response);
          resarr.map(e => {
            $(holder).append(`<li class="list-group-item border-0 py-2">
            <a href="visitprofile.php?id='${e.user_id}'">
                <img class="profile-pic rounded-circle" src="assets/pictures/${e.picture}" alt="profile picture">
                <span class="text-dark">${e.firstname} ${e.lastname}</span></a>
        </li>`);
          });
        }
      });
    }
  }

  $("#input-search").on("input", doUserSearch);

  $("#input-search-secondary").on("input", doUserSearch);

  //functionalities for posts comments and likes
  $(document).on("click", ".post-comment-btn", function() {
    let textarea = $(this)
      .parent()
      .parent()
      .find("textarea");
    // console.log(textarea);
    // console.log(textarea.val().length);
    let mybutton = this;
    let postComCon = $(this)
      .parent()
      .parent()
      .parent()
      .parent()
      .find(".post-comment-contain");
    let selcn = $(this)
      .parent()
      .parent()
      .parent()
      .parent()
      .find(".commentNum");

    let selPostComNum = $(this)
      .parent()
      .parent()
      .parent()
      .parent()
      .find(".commentNum")
      .text();

    let postComNum = parseInt(selPostComNum.match(/\d+/)[0]);
    postComNum == false || postComNum == null
      ? (postComNum = 0)
      : (postComNum = postComNum);
    console.log(postComNum, typeof postComNum);

    // console.log(mybutton.value, "btn val");

    if (textarea.val().length > 0) {
      $.post(
        "./includes/postcomment.php",
        { postid: mybutton.value, comment: textarea.val().trim() },
        function(response) {
          console.log(response);
          if (response !== "") {
            textarea.val("");
            let obj = JSON.parse(response);
            console.log(obj);
            postComCon.removeClass("d-none");

            let commentHtml = `<div class="d-flex mt-2">
            <a href="visitprofile.php?id='${obj.commenter_id}'">
             <img class="profile-pic mr-2 rounded-circle" src="assets/pictures/${user.picture}"
                alt="profile picture">
            </a>
            <div class="bg-my-secondary rounded w-100">
                <h6 class="color-second px-2">${fullname}</h6>
                <span class="px-2 real-comment">${obj.text}</span>
            </div>
        </div>`;
            postComCon.append(commentHtml);
            selcn.text(`${postComNum + 1} Comment`);
          }
        }
      );
    }
  });

  $(document).on("click", ".post-like", function() {
    let mybutton = this;
    // console.log(
    //   $(this)
    //     .parent()
    //     .parent()
    //     .find(".like-count")
    //     .html()
    // );
    let likenum = $(this)
      .parent()
      .parent()
      .find(".like-count")
      .html();
    let likelem = $(this)
      .parent()
      .parent()
      .find(".like-count");

    likenum == "" ? (likenum = 0) : (likenum = likenum);

    console.log(likenum, likenum == false);

    console.log("lorem like");
    console.log(this.value);
    $.post("./includes/postlike.php", { postid: mybutton.value }, function(
      response
    ) {
      if (response.trim() == "like") {
        console.log($(this).find("i"));
        $(".post-like-con").removeClass("d-none");
        $(".post-like-con").removeClass("d-block");

        likelem.html(parseInt(likenum) + 1);

        $(mybutton)
          .find("i")
          .removeClass("text-secondary");
        $(mybutton)
          .find("i")
          .addClass("text-primary");

        $(mybutton)
          .find("span")
          .removeClass("text-secondary");
        $(mybutton)
          .find("span")
          .addClass("text-primary");
      } else {
        $(".post-like-con").removeClass("d-none");
        $(".post-like-con").removeClass("d-block");
        if (likenum - 1 <= 0) {
          $(".post-like-con").removeClass("d-block");
          $(".post-like-con").addClass("d-none");
        }

        likelem.html(parseInt(likenum - 1));
        $(mybutton)
          .find("span")
          .removeClass("text-primary");
        $(mybutton)
          .find("span")
          .addClass("text-secondary");
        $(mybutton)
          .find("i")
          .removeClass("bg-primary");
        $(mybutton)
          .find("i")
          .addClass("text-secondary");
      }
      // console.log(response);
    });
  });

  $(document).on("click", ".post-comment", function() {
    let pp = $(this)
      .parent()
      .parent()
      .find("textarea");
    // console.log(pp);
    $(pp).focus();
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
          return el == userId;
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
    $(".profile-posts-container").html(postHtml);
  }
  // ./includes/loadprofileposts.php
  //load post api call
  $.post(
    "https://sqisocialapp.herokuapp.com/includes/loadprofileposts.php",
    function(data) {
      // console.log($(".profile-posts-container"));
      console.log(data);
      profile - posts - container;
      if (data !== "") {
        let posts = JSON.parse(data);
        console.log(posts);
        posts = posts.sort(function(a, b) {
          return b.post_id - a.post_id;
        });
        console.log(posts);
        $(".postsNum").html(`${posts.length}`);
        renderPosts(posts);
      }
    }
  );
});
