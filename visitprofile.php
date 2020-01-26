<?php include_once('./includes/header.php') ?>


<div class="container-fluid body-home-1 pt-7">
    <div class="row">
        <div class="col-sm-2 first-profile">


        </div>
        <div class="col-sm-8">

            <div class="">
                <div class="visit_cover">
                    <div class="friend-suggest px-4 position-relative">
                        <div class="d-flex justify-content-between">
                            <div class="w-100 d-flex justify-content-between">
                                <div class="d-flex">
                                    <div class="py-1 position-relative user-pic-container w-50">

                                        <div class="userpic-container mr-5">

                                            <img class="visit_display-user-pic userpic rounded-circle thick-border"
                                                src="assets/images/defaultpic.jpg" alt="profile picture">

                                        </div>

                                        <!-- <label class="px-3 py-1 text-white position-absolute camera-label"
                                            for="upload-photo">
                                            <i class="fas fa-camera-retro text-white"></i> Edit..
                                        </label>
                                        <input class="d-none" type="file" name="userphoto" id="upload-photo" /> -->


                                    </div>
                                    <!-- <input name="atom" type="text"/> -->
                                    <div class="align-self-center ml-2">
                                        <h4 id="visit_username" class="text-white font-weight-bold user-name"></h4>
                                    </div>
                                </div>

                                <div class="primary-btn-container align-self-center cover-edit pl-2">
                                    <!-- <div>
                                        <label class="px-3 py-1 text-white bg-cus d-flex" for="upload-cover">
                                            <i class="fas fa-camera-retro text-white align-self-center"></i>
                                            <span>&nbsp;Edit..</span>
                                        </label>
                                        <input class="d-none" type="file" name="usercover" id="upload-cover" />
                                    </div> -->
                                    <!-- btn-primary  -->
                                    <button type="button" id="add_friend" class="btn mx-1 my-1 border oneforall">Add
                                        friend</button>

                                    <button type="button" id="changeee"
                                        class="btn border btn-secondary ml-1 mx-1 my-1">message</button>

                                    <!-- <button value=${reqsid[index]}
                                        class="confirm_request visit-profile-confirm btn border border-secondary my-0 py-0">Confirm</button>
                                    <button value=${reqsid[index]}
                                        class="reject_request btn my-bgdanger text-white border border-secondary my-0 py-0">Reject</button> -->



                                </div>
                            </div>
                        </div>



                    </div>
                </div>

                <div>
                    <div id="visit_userupload-error" class="d-none bg-warning text-center m-0">
                        <small class="text-danger"></small>
                    </div>

                    <div class="bg-white pt-1 d-flex justify-content-around profile-menu">
                        <button autofocus id="timeline-btn" class="btn color-second font-weight-bold"
                            type="button">Timeline</button>
                        <button id="visit_about-btn" class="btn color-second font-weight-bold"
                            type="button">About</button>
                        <button id="friends-btn" class="btn color-second font-weight-bold" type="button">
                            Friends
                            <span id="vfdnum" class="text-secondary see-all font-weight-normal"></span>
                        </button>

                        <button id="gallery-btn" class="btn color-second font-weight-bold" type="button">
                            Photo
                            <span class="visit_picnum text-secondary see-all font-weight-normal"></span>
                        </button>

                    </div>
                </div>

            </div>

            <div class="my-4 user-timeline">

                <div id="timeline">
                    <!-- <div class="card">
                        <h6 class="card-header">Create Post</h6>
                        <div class="card-body py-2">
                            <div class="card-title d-flex">

                                <div class="mw-10">
                                    <a href="profile.php">
                                        <img class="display-user-pic status-pic rounded-circle"
                                            src="assets/images/defaultpic.jpg" alt="profile picture">
                                    </a>

                                </div>
                                <textarea placeholder="Write something to him/her..."
                                    class="border-0 w-90 outline-none resize-none" name="" id="" cols="30"
                                    rows="3"></textarea>
                            </div>

                            <hr class="m-2">
                            <div class="pb-2 status-btn m-0 d-flex justify-content-between flex-wrap">
                                <button class="btn bg-tertiary py-0 px-2 d-flex">
                                    <i class="fas fa-photo-video mt-1"></i>
                                    <span>&nbsp;Photo/Video</span>
                                </button>
                                <button class="btn bg-tertiary py-0  px-2 d-flex">
                                    <i class="fas fa-user-tag  mt-1"></i>
                                    <span>&nbsp;Tag friends</span>
                                </button>
                                <button class="btn bg-tertiary py-0  px-2 d-flex">
                                    <i class="fas fa-snowboarding  mt-1"></i>
                                    <span>&nbsp;Activity</span>
                                </button>
                                <button class="btn bg-tertiary py-0  px-2 d-flex ">
                                    <i class="fas fa-filter  mt-1"></i>
                                    <span>&nbsp;Filter</span>
                                </button>
                            </div>
                            <a href="#" class="btn text-white my-bgprimary w-100 p-0 disabled">Post</a>
                        </div>
                    </div> -->

                    <div class="card my-2">
                        <div class="card-body p-2 posts visit-profile-posts-container bg-transparent">
                            <div class="card-title position-relative d-flex">
                                <img class="status-pic rounded-circle mr-3" src="assets/images/user-3.jpg"
                                    alt="profile picture">
                                <div class="d-flex pr-4 w-100 justify-content-between">
                                    <h6 class="color-second">George thomas</h6>
                                    <span class="border border-primary type px-1">Alumni</span>
                                </div>

                                <span class="position-absolute timespan text-secondary">18m</span>
                            </div>
                            <p class="card-text">Lorem ipsum dolor sit amet consectetur adipisicing elit. Repellendus
                                laborum consequatur cumque earum aperiam esse doloribus fuga obcaecati, exercitationem
                                distinctio explicabo, non deserunt sint reiciendis, qui eius mollitia ea animi.</p>
                            <hr class="m-1">
                            <div class="d-flex justify-content-between px-3">
                                <div class="d-flex">
                                    <div class="bg-primary like-container position-relative mr-1 rounded-circle">
                                        <i class="fas position-absolute like fa-thumbs-up"></i>
                                    </div>

                                    <div class="text-secondary">Atom taiwo and <span>2</span> others</div>
                                </div>

                                <div class="text-secondary">
                                    1 <span>Comment</span>
                                </div>

                            </div>
                            <hr class="m-2">
                            <div class="d-flex justify-content-around text-secondary">
                                <div>
                                    <i class="far fa-thumbs-up text-secondary"></i>
                                    <span>Like</span>
                                </div>

                                <div>
                                    <i class="far fa-comment-alt text-secondary"></i>
                                    <span>Comment</span>
                                </div>
                            </div>

                            <hr class="m-2">
                            <div>
                                <div class="d-flex">
                                    <img class="profile-pic mr-2 rounded-circle" src="assets/images/user-5.jpg"
                                        alt="profile picture">
                                    <div class="bg-my-secondary rounded d-flex">
                                        <h6 class="color-second px-2">Adele grimb</h6>
                                        <span class="px-2 real-comment">Nice Lorem, keep it up</span>
                                    </div>
                                </div>
                                <div class="d-flex mt-2">
                                    <img class="profile-pic mr-2 rounded-circle" src="assets/images/user-2.jpg"
                                        alt="profile picture">
                                    <div class="bg-my-secondary rounded d-flex">
                                        <h6 class="color-second px-2">cynthia alob</h6>
                                        <span class="px-2 real-comment">You just wrote some rubbish</span>
                                    </div>
                                </div>
                            </div>

                            <div class="d-flex mt-2">
                                <img class="profile-pic mr-2 rounded-circle" src="assets/images/user.jpg"
                                    alt="profile picture">
                                <div class="d-flex w-90">
                                    <input placeholder="write a comment here" type="text"
                                        class="bg-my-secondary rounded-left border border-secondary border-right-0 w-90 px-2 outline-none">
                                    <div
                                        class="bg-my-secondary border border-secondary border-left-0 rounded-right px-2 outline-none">
                                        <i class="fas fa-camera-retro text-secondary"></i>
                                    </div>
                                </div>


                            </div>
                        </div>

                    </div>
                </div>


            </div>

            <div id="visit_about" class="card user-about my-4 d-none">
                <div class="card-header text-secondary d-flex justify-content-between">
                    <div>
                        <i class="fas fa-user text-secondary"></i>
                        <span>About</span>
                    </div>

                    <small id="visit_update-message"></small>

                </div>
                <div class="card-body pt-1">
                    <div class="row">
                        <div class="col-4 p-0">
                            <div class="list-group about">
                                <button id="overview-btn" autofocus type="button"
                                    class="list-group-item list-group-item-action">
                                    Overview
                                </button>
                                <button id="contact-btn" type="button"
                                    class="list-group-item list-group-item-action">Contact and
                                    basic info</button>
                                <button id="education-btn" type="button"
                                    class="list-group-item list-group-item-action">Education</button>
                                <button id="skills-btn" type="button"
                                    class="list-group-item list-group-item-action">Skills</button>
                                <!-- <button id="details-btn" type="button"
                                    class="list-group-item list-group-item-action">Details about
                                    you</button> -->
                                <!-- <button id="settings-btn" type="button"
                                    class="list-group-item list-group-item-action">Settings</button> -->
                            </div>
                        </div>

                        <div class="col-8 p-0y">
                            <div id="overview" class="list-group overview-about see-all">

                                <!-- <div class="list-group-item list-group-item-action text-primary">Learning Software
                                    Engineering</div>
                                <div class="list-group-item list-group-item-action text-primary">School at Lautech
                                </div>
                                <div class="list-group-item list-group-item-action text-primary">School at Asos
                                </div>
                                <div class="list-group-item list-group-item-action text-primary">aswerty@gmail.com
                                </div>
                                <div class="list-group-item list-group-item-action text-primary">08065725739</div> -->



                            </div>
                            <form method="post" enctype="multipart/form-data" id="contact" class="list-group d-none">
                                <div class="list-group-item list-group-item-action font-weight-normal py-0">
                                    <h6 class="font-weight-normal mt-2 text-secondary">CONTACT INFORMATION</h6>

                                    <!-- <div class="d-flex">
                                        <button type="submit" id="contact-save"
                                            class="text-primary btn m-0">Save</button>

                                        <button type="button" id="contact-edit" class="text-primary btn m-0"><i
                                                class="fas fa-pen text-secondary see-all"></i>
                                        </button>
                                    </div> -->
                                </div>

                                <div
                                    class="list-group-item list-group-item-action d-flex justify-content-between see-all">
                                    <span class="tag-display">Mobile Number</span>
                                    <input name="mobilenum" disabled placeholder="p/n" class="border-0 bg-white"
                                        type="text">

                                    <!-- <i id="mobilenum-visibility" class="far fa-eye text-secondary see-all"></i> -->
                                </div>
                                <div
                                    class="list-group-item list-group-item-action d-flex justify-content-between see-all">
                                    <span class="tag-display">Email</span>
                                    <input name="contact_email" disabled placeholder="p/n" class="border-0 bg-white"
                                        type="email">
                                    <!-- <i id="contact_email-visibility" class="far fa-eye text-secondary see-all"></i> -->
                                </div>

                                <div
                                    class="list-group-item list-group-item-action font-weight-normal py-0 d-flex justify-content-between">
                                    <h6 class="font-weight-normal mt-2 text-secondary">BASIC INFORMATION</h6>
                                    <!-- <button class="text-primary btn">Save</button> -->
                                </div>
                                <div id=""
                                    class="list-group-item list-group-item-action d-flex justify-content-between see-all">
                                    <span class="tag-display">Birth date</span>
                                    <input placeholder="p/n" name="birthdate" disabled class="border-0 bg-white"
                                        type="text" onfocus="(this.type='date')">
                                    <!-- <i id="birthdate-visibility" class="far fa-eye text-secondary see-all"></i> -->
                                </div>
                                <div
                                    class="list-group-item list-group-item-action d-flex justify-content-between see-all">
                                    <span class="tag-display">Gender</span>
                                    <input placeholder="p/n" id="test-select" name="gender" disabled
                                        class="border-0 bg-white">

                                    <!-- <i id="gender-visibility" class="far fa-eye text-secondary see-all"></i> -->
                                </div>

                                <div
                                    class="list-group-item list-group-item-action font-weight-normal py-0 d-flex justify-content-between">
                                    <h6 class="font-weight-normal mt-2 text-secondary">WEBSITE & SOCIAL LINKS</h6>
                                    <!-- <button class="text-primary btn">Save</button> -->
                                </div>
                                <div
                                    class="list-group-item list-group-item-action d-flex justify-content-between see-all">
                                    <span class="tag-display">Portfolio Website</span>
                                    <input name="portfolio" disabled placeholder="p/n" class="border-0 bg-white"
                                        type="url">
                                    <!-- <i id="portfolio-visibility" class="far fa-eye text-secondary see-all"></i> -->
                                </div>
                                <div
                                    class="list-group-item list-group-item-action d-flex justify-content-between see-all">
                                    <span class="tag-display">Social handle</span>
                                    <input name="social_handle" disabled placeholder="p/n" class="border-0 bg-white"
                                        type="text">
                                    <!-- <i id="social_handle-visibility" class="far fa-eye text-secondary see-all"></i> -->
                                </div>
                                <div
                                    class="list-group-item list-group-item-action font-weight-normal py-0 d-flex justify-content-between">
                                    <h6 class="font-weight-normal mt-2 text-secondary">LOCATION</h6>
                                    <!-- <button class="text-primary btn">Save</button> -->
                                </div>
                                <div
                                    class="list-group-item list-group-item-action d-flex justify-content-between see-all">
                                    <span class="tag-display">City</span>
                                    <input name="current_city" disabled placeholder="p/n" class="border-0 bg-white"
                                        type="text">
                                    <!-- <i id="current_city-visibility" class="far fa-eye text-secondary see-all"></i> -->
                                </div>
                            </form>

                            <form id="education" method="post" class="list-group education d-none">
                                <div class="list-group-item list-group-item-action font-weight-normal py-0">
                                    <h6 class="font-weight-normal mt-2 text-secondary">COLLEGE</h6>
                                    <!-- <div class="d-flex">
                                        <button type="submit" id="education-save"
                                            class="text-primary btn m-0">Save</button>

                                        <button type="button" id="education-edit" class="text-primary btn m-0"><i
                                                class="fas fa-pen text-secondary see-all"></i>
                                        </button>
                                    </div> -->

                                </div>

                                <div
                                    class="list-group-item list-group-item-action d-flex justify-content-between see-all">
                                    <span class="tag-display">Name</span>
                                    <input name="college_name" disabled placeholder="p/n" class="border-0 bg-white"
                                        type="text">
                                    <!-- <i id="college_name-visibility" class="far fa-eye text-secondary see-all"></i> -->
                                </div>
                                <div
                                    class="list-group-item list-group-item-action d-flex justify-content-between see-all">
                                    <span class="tag-display">Course</span>
                                    <input name="college_course" disabled placeholder="p/n" class="border-0 bg-white"
                                        type="text">
                                    <!-- <i id="college_course-visibility" class="far fa-eye text-secondary see-all"></i> -->
                                </div>
                                <div
                                    class="list-group-item list-group-item-action d-flex justify-content-between see-all">
                                    <span class="tag-display">Certificate</span>
                                    <input placeholder="p/n" disabled class="border-0 bg-white"
                                        name="college_certificate" id="">


                                    <!-- <i id="college_certificate-visibility"
                                        class="far fa-eye text-secondary see-all"></i> -->
                                </div>
                                <div
                                    class="list-group-item list-group-item-action font-weight-normal py-0 d-flex justify-content-between">
                                    <h6 class="font-weight-normal mt-2 text-secondary">HIGH SCHOOL</h6>

                                </div>
                                <div
                                    class="list-group-item list-group-item-action d-flex justify-content-between see-all">
                                    <span class="tag-display">Name</span>
                                    <input name="high_school" disabled placeholder="p/n" class="border-0 bg-white"
                                        type="text">
                                    <!-- <i class="high_school-visibility" class="far fa-eye text-secondary see-all"></i> -->
                                </div>

                            </form>

                            <form id="skills" method="post" class="list-group skills d-none">
                                <div class="list-group-item list-group-item-action font-weight-normal py-0">
                                    <h6 class="font-weight-normal mt-2 text-secondary">TECHNICAL SKILLS</h6>

                                    <!-- <div class="d-flex">
                                        <button type="submit" id="skills-save"
                                            class="text-primary btn m-0">Save</button>

                                        <button type="button" id="skills-edit" class="text-primary btn m-0"><i
                                                class="fas fa-pen text-secondary see-all"></i>
                                        </button>
                                    </div> -->
                                </div>

                                <div
                                    class="list-group-item list-group-item-action d-flex justify-content-between see-all">
                                    <span class="tag-display">Learning path</span>
                                    <input placeholder="p/n" disabled class="border-0 bg-white" name="learning">


                                    <!-- <i id="learning-visibility" class="far fa-eye text-secondary see-all"></i> -->
                                </div>
                                <div
                                    class="list-group-item list-group-item-action d-flex justify-content-between see-all">
                                    <span class="tag-display">Quarter/Year</span>
                                    <input placeholder="p/n" disabled class="border-0 bg-white" name="quarter">

                                    <!-- <i id="quarter-visibility" class="far fa-eye text-secondary see-all"></i> -->
                                </div>
                                <div
                                    class="list-group-item list-group-item-action font-weight-normal py-0 d-flex justify-content-between">
                                    <h6 class="font-weight-normal mt-2 text-secondary">SOFT SKILLS</h6>

                                </div>
                                <div
                                    class="list-group-item list-group-item-action d-flex justify-content-between see-all">
                                    <span class="tag-display">Mental skills</span>
                                    <input name="mental_skills" disabled placeholder="p/n" class="border-0 bg-white"
                                        type="text">
                                    <!-- <i id="mental_skills-visibility" class="far fa-eye text-secondary see-all"></i> -->
                                </div>

                            </form>

                            <!-- <form id="details" method="post" class="list-group details-about-you d-none">
                                <div
                                    class="list-group-item list-group-item-action font-weight-normal py-0 d-flex justify-content-between">
                                    <h6 class="font-weight-normal mt-2 text-secondary">THINGS ABOUT YOU</h6>

                                    <div class="d-flex">
                                        <button type="submit" id="details-save"
                                            class="text-primary btn m-0">Save</button>

                                        <button type="button" id="details-edit" class="text-primary btn m-0"><i
                                                class="fas fa-pen text-secondary see-all"></i>
                                        </button>
                                    </div>
                                </div>

                                <div
                                    class="list-group-item list-group-item-action d-flex justify-content-between see-all">
                                    <span class="tag-display">About you</span>
                                    <input disabled placeholder="write something about you" class="border-0 bg-white"
                                        type="text">
                                    <i class="far fa-eye text-secondary see-all"></i>
                                </div>
                                <div
                                    class="list-group-item list-group-item-action d-flex justify-content-between see-all">
                                    <span class="tag-display">Favourite Quotes</span>
                                    <input disabled placeholder="Write quotes" class="border-0 bg-white" type="text">
                                    <i class="far fa-eye text-secondary see-all"></i>
                                </div>
                            </form> -->



                        </div>
                    </div>
                </div>
            </div>


            <div id="friends" class="card user-friends my-4 d-none">
                <div class="card-header text-secondary">
                    <i class="fas fa-user-friends text-secondary"></i>
                    <span>Friends</span>
                </div>
                <div id="v_friends_display" class="card-body pt-3 d-flex flex-wrap">
                    <div class="d-flex w-48 user-friends-contain justify-content-between align-items-center mb-3">
                        <div class="d-flex">
                            <img class="friend-pic" src="assets/images/user.jpg" alt="friends picture">
                            <div class="align-self-center">
                                <h6 class="color-second m-0">Ajewole Ajeigbe</h6>
                                <span class="text-secondary m-0 mutual">106 mutual friends</span>
                            </div>
                        </div>

                        <button class="btn btn-danger" type="button">Unfriend</button>
                        <!-- <button class="btn btn-secondary border" type="button">Done</button> -->
                    </div>

                    <div class="d-flex w-48 user-friends-contain justify-content-between align-items-center mb-3">
                        <div class="d-flex">
                            <img class="friend-pic" src="assets/images/user.jpg" alt="friends picture">
                            <div class="align-self-center">
                                <h6 class="color-second m-0">Ajewole Ajeigbe</h6>
                                <span class="text-secondary m-0 mutual">106 mutual friends</span>
                            </div>
                        </div>

                        <button class="btn btn-danger" type="button">Unfriend</button>
                    </div>

                    <div class="d-flex w-48 user-friends-contain justify-content-between align-items-center mb-3">
                        <div class="d-flex">
                            <img class="friend-pic" src="assets/images/user.jpg" alt="friends picture">
                            <div class="align-self-center">
                                <h6 class="color-second m-0">Ajewole Ajeigbe</h6>
                                <span class="text-secondary m-0">106 mutual friends</span>
                            </div>
                        </div>

                        <button class="btn btn-danger" type="button">Unfriend</button>
                    </div>

                    <div class="d-flex w-48 user-friends-contain justify-content-between align-items-center mb-3">
                        <div class="d-flex">
                            <img class="friend-pic" src="assets/images/user.jpg" alt="friends picture">
                            <div class="align-self-center">
                                <h6 class="color-second m-0">Ajewole Ajeigbe</h6>
                                <span class="text-secondary m-0">106 mutual friends</span>
                            </div>
                        </div>

                        <button class="btn btn-danger" type="button">Unfriend</button>
                    </div>

                    <div class="d-flex w-48 user-friends-contain justify-content-between align-items-center mb-3">
                        <div class="d-flex">
                            <img class="friend-pic" src="assets/images/user.jpg" alt="friends picture">
                            <div class="align-self-center">
                                <h6 class="color-second m-0">Ajewole Ajeigbe</h6>
                                <span class="text-secondary m-0">106 mutual friends</span>
                            </div>
                        </div>

                        <button class="btn btn-danger" type="button">Unfriend</button>
                    </div>

                    <div class="d-flex w-48 user-friends-contain justify-content-between align-items-center mb-3">
                        <div class="d-flex">
                            <img class="friend-pic" src="assets/images/user.jpg" alt="friends picture">
                            <div class="align-self-center">
                                <h6 class="color-second m-0">Ajewole Ajeigbe</h6>
                                <span class="text-secondary m-0">106 mutual friends</span>
                            </div>
                        </div>

                        <button class="btn btn-danger" type="button">Unfriend</button>
                    </div>
                </div>
            </div>


            <div id="gallery" class="card user-friends my-4 d-none">
                <div class="card-header text-secondary">
                    <i class="fas fa-photo-video text-secondary"></i>
                    <span>Photos</span>
                    <small class="visit_picnum"></small>
                </div>
                <div id="visit_user-gallery" class="card-body pt-3 d-flex flex-wrap user-gallery">

                </div>
            </div>


        </div>







        <div class="col-sm-2 second-profile">

        </div>
    </div>




</div>


<script src="node_modules/jquery/dist/jquery.min.js"></script>
<script src="node_modules/bootstrap/dist/js/bootstrap.js"></script>
<script defer src="assets/javascripts/visitprofile.js"></script>
<!-- <script defer src="assets/javascripts/profile.js"></script> -->
</body>

</html>