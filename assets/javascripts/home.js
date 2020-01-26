"use strict";
$(document).ready(function() {
  let userId;
  let userImg;
  $.post("./includes/getminiuserdata.php", function(response) {
    let miniUserData = JSON.parse(response);
    userImg = miniUserData.picture;
    userId = miniUserData.user_id;
  });
  // Function to preview image after validation
  $(function() {
    $("#upload-post-pic").change(function() {
      $("#post-image-preview").removeClass("d-none");
      // $("post-image-preview").addClass("d-block");
      $(".post-image-error").removeClass("d-block");
      $(".post-image-error").addClass("d-none");
      validPreview(this);
      //   console.log(this);
    });
    // $("#upload-cover").change(function() {
    //   $("#userupload-error").removeClass("d-block");
    //   $("#userupload-error").addClass("d-none");
    //   validPreview(this);
    // });

    let validPreview = param => {
      if (param) {
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
          $(".post-image-error").removeClass("d-none");
          $(".post-image-error").addClass("d-block");

          return false;
        } else {
          var reader = new FileReader();
          reader.onload = function imageIsLoaded(e) {
            $("#post-image-preview").attr("src", e.target.result);
          };
          reader.readAsDataURL(file);
          // if (param.id == "upload-photo") {
          //   reader.onload = function imageIsLoaded(e) {
          //     $(".userpic").attr("src", e.target.result);
          //   };
          //   reader.readAsDataURL(file);
          // } else {
          //   reader.onload = function imageIsLoaded(e) {
          //     $(".cover").css("background-image", "url(" + e.target.result + ")");
          //   };
          //   reader.readAsDataURL(file);
          // }
        }
      }
    };
  });

  $("#post-words").keyup(function() {
    // console.log(this.value, this.value.length);
    if (this.value.length > 1) {
      $("#post-btn").prop("disabled", false);
    } else {
      $("#post-btn").prop("disabled", true);
    }
  });

  $("#post-btn").click(function() {
    // $("#postForm").submit(function(event) {
    // event.preventDefault();

    var fd = new FormData(document.getElementById("postForm"));
    $.ajax({
      url: "./includes/savepost.php",
      type: "POST",
      data: fd,
      contentType: false,
      processData: false,
      cache: false,

      success: function(data) {
        // console.log(data);

        if (data.match("Posting successful !")) {
          // console.log("post sucessful");
          $("#upload-post-pic").val("");
          $("#post-words").val("");
          $("#post-image-preview").attr("src", "");
          $("#post-image-preview").addClass("d-none");
          $(".post-image-error").addClass("d-none");
          // $("#userupload-error").removeClass("d-none");
          // $("#userupload-error").removeClass("bg-warning");
          // $("#userupload-error").addClass("d-block");
          // $("#userupload-error").addClass("bg-primary");
          // $("#upload-cover").val("");
          // $("#upload-photo").val("");
          // location.reload("true");
        } else {
          // console.log("post not sucessful");
          $(".post-image-error").removeClass("d-none");
          // $("#userupload-error").removeClass("d-none");
          // $("#userupload-error").removeClass("bg-primary");
          // $("#userupload-error").addClass("d-block");
          // $("#userupload-error").addClass("bg-warning");
        }
      }
    });
    // });
  });

  function loadFriends() {
    // console.log("seen loadfriends");
    $.post("./includes/loaduserfriends.php", function(response) {
      if (response) {
        let parseData = JSON.parse(response);
        let userId = parseData[parseData.length - 1];
        parseData.pop();
        let fdids = parseData.map(el => (el.f1 == userId ? el.f2 : el.f1));
        fdids.unshift(userId);
        // console.log(parseData);
        // // console.log(userId);
        // console.log(fdids);
        loadPosts(fdids);
      }
    });
  }
  loadFriends();
  function loadPosts(arr = []) {
    // console.log(arr);
    $.post("./includes/loadposts.php", { fdids: arr }, function(response) {
      // console.log(JSON.parse(response), "fro  post server");
      if (response) {
        let posts = [];
        let parseData = JSON.parse(response);
        // console.log(parseData);
        parseData.map(arr => {
          arr.map(obj => {
            posts.push(obj);
          });
        });
        // console.log(posts);
        posts.sort(function(a, b) {
          return b.post_id - a.post_id;
        });
        console.log(posts);
        renderPosts(posts);
      }
    });
  }
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
        commentCount = commentsId.length;
        commenterId = commenterId.split(",");
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
                    <img class="profile-pic mr-2 rounded-circle" src="assets/pictures/${userImg}" alt="profile picture">
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
    $("#home-timeline").html(postHtml);
  }
});
