<?php include_once('./includes/header.php') ?>
<div class="container-fluid body-home-1 pt-7">
    <div class="row home-row">
        <div class="col-md-3">
            <ul class="list-group side-nav">
                <li class="list-group-item border-0 bg-transparent py-4">
                    <a href="profile.php" class="text-decoration-none color-third">
                        <img id="profile-pic" class="display-user-pic profile-pic rounded-circle"
                            src="assets/images/defaultpic.jpg" alt="profile picture">
                        <span id="username"></span>
                    </a>

                </li>
                <li class="list-group-item border-0 bg-transparent py-4">
                    <i class="far fa-images"></i>
                    <span> Photos</span>
                    <span class="see-all ml-1 color-secondary picnum"></span>
                </li>


                <li class="list-group-item border-0 bg-transparent py-4">
                    <i class="fas fa-film"></i>
                    <span>Videos</span>
                    <span class="see-all ml-1 color-secondary">2</span>

                </li>
                <li class="list-group-item border-0 bg-transparent py-4">
                    <i class="fas fa-user-friends"></i>
                    <span>Friends</span>
                    <span class="see-all ml-1 color-secondary fdnum"></span>
                </li>

                <li class="list-group-item border-0 bg-transparent py-4">
                    <i class="fas fa-network-wired"></i>
                    <span>Posts</span>
                    <span class="see-all ml-1 color-secondary postsNum"></span>

                </li>
            </ul>
        </div>
        <div class="col-md-6 pt-2">
            <div class="w-100 position-relative secondary-search d-none">
                <div class="bg-light p-1 d-flex">
                    <form class="form-inline d-flex w-100 my-2 my-lg-0">
                        <input class="form-control d-block border border-secondary px-2 w-75 h-100 p-0" type="search"
                            placeholder="Search" aria-label="Search" />
                        <button class="btn bg-hover-none border-0 py-0 px-1 btn-outline-light my-2 my-sm-0"
                            type="submit">
                            <i class="fas fa-search text-secondary"></i>
                        </button>
                    </form>

                    <button class="btn">cancel</button>
                </div>

                <ul class="list-group w-100 border border-secondary search-tab">
                    <li class="list-group-item border-0 py-2 body-home">
                        <img class="profile-pic rounded-circle" src="assets/images/user.jpg" alt="profile picture">
                        <span>Ridwan Ijadunola</span>
                    </li>
                    <li class="list-group-item border-0 py-2 ">
                        <img class="profile-pic rounded-circle" src="assets/images/user-1.jpg" alt="profile picture">
                        <span>Ajetunbi akwa</span>
                    </li>
                    <li class="list-group-item border-0 py-2 ">
                        <img class="profile-pic rounded-circle" src="assets/images/user-2.jpg" alt="profile picture">
                        <span>Omusu owaa</span>
                    </li>
                    <li class="list-group-item border-0 py-2 ">
                        <img class="profile-pic rounded-circle" src="assets/images/user-3.jpg" alt="profile picture">
                        <span>Stroles toyles</span>
                    </li>
                    <li class="list-group-item border-0 py-2 ">
                        <img class="profile-pic rounded-circle" src="assets/images/user-5.jpg" alt="profile picture">
                        <span>Ridwan Ijadunola</span>
                    </li>
                </ul>
            </div>
            <div class="card">
                <div class="card-header d-flex justify-content-between">
                    <h6 class="m-0">Create Post</h6>
                    <small class="text-danger m-0 post-image-error d-none">Invalid file type !</small>
                </div>

                <div class="card-body py-2">
                    <div class="card-title d-flex">

                        <div class="mw-10">
                            <a href="profile.php">
                                <img class="display-user-pic status-pic rounded-circle"
                                    src="assets/images/defaultpic.jpg" alt="profile picture">
                            </a>

                        </div>
                        <!-- <textarea placeholder="What do you want to tell your SQI connections ?"
                            class="border-0 w-90 outline-none resize-none" name="" id="" cols="30" rows="3"></textarea> -->
                        <form id="postForm" method="post" enctype="multipart/form-data" class="w-90">
                            <textarea placeholder="What do you want to tell your SQI connections ?"
                                class="border-0 w-100 outline-none resize-none" name="post-text" id="post-words"
                                cols="30" rows="3"></textarea>
                            <!-- <div></div> -->
                            <img class="status-pic d-none" id="post-image-preview" src="assets/images/defaultpic.jpg" />
                            <input name="post-image" class="d-none" id="upload-post-pic" type="file">
                        </form>
                    </div>

                    <hr class="m-2">
                    <div class="pb-2 status-btn m-0 d-flex justify-content-between flex-wrap align-items-start">
                        <label for="upload-post-pic" class="btn bg-tertiary py-0 px-2 d-flex">
                            <i class="fas fa-photo-video mt-1"></i>
                            <span>&nbsp;Photo</span>
                        </label>
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
                    <button disabled id="post-btn" class="btn text-white my-bgprimary w-100 p-0">Post</button>
                </div>
            </div>

            <div id='home-timeline' class="card my-2 bg-transparent border-0">
                <div class="card-body bg-white p-2 mb-3 posts">
                    <a href="visitprofile.php" class="card-title position-relative d-flex">
                        <img class="status-pic rounded-circle mr-3" src="assets/images/user-3.jpg"
                            alt="profile picture">
                        <div class="d-flex pr-4 w-100 justify-content-between">
                            <h6 class="color-second">George thomas</h6>
                            <span class="border border-primary type px-1">Alumni</span>
                        </div>

                        <span class="position-absolute timespan text-secondary">18m</span>
                    </a>
                    <p class="card-text">Lorem ipsum dolor sit amet consectetur adipisicing elit. Repellendus
                        laborum consequatur cumque earum aperiam esse doloribus fuga obcaecati, exercitationem
                        distinctio explicabo, non deserunt sint reiciendis, qui eius mollitia ea animi.</p>
                    <img class="w-100" src="assets/pictures/128801575470745.jpg" alt="post picture">
                    <!-- 
                        <div>
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
                </div>
                -->
                    <hr class="m-2">
                    <div class="d-flex justify-content-around text-secondary">
                        <button class="btn post-like">
                            <i class="far fa-thumbs-up text-secondary"></i>
                            <span>Like</span>
                        </button>

                        <button class="btn post-comment">
                            <i class="far fa-comment-alt text-secondary"></i>
                            <span>Comment</span>
                        </button>
                    </div>

                    <hr class="m-0">
                    <div class="post-comment-contain">
                        <div class="d-flex mt-2">
                            <a href="visitprofile.php">
                                <img class="profile-pic mr-2 rounded-circle" src="assets/images/user-5.jpg"
                                    alt="profile picture">
                            </a>

                            <div class="bg-my-secondary rounded d-flex">
                                <h6 class="color-second px-2">Adele grimb</h6>
                                <span class="px-2 real-comment">Nice Lorem, keep it up</span>
                            </div>
                        </div>
                        <div class="d-flex mt-2">
                            <a href="visitprofile.php">
                                <img class="profile-pic mr-2 rounded-circle" src="assets/images/user-2.jpg"
                                    alt="profile picture">
                            </a>

                            <div class="bg-my-secondary rounded d-flex">
                                <h6 class="color-second px-2">cynthia alob</h6>
                                <span class="px-2 real-comment">You just wrote some rubbish</span>
                            </div>
                        </div>

                    </div>

                    <div class="d-flex mt-2">
                        <img class="profile-pic mr-2 rounded-circle" src="assets/images/user.jpg" alt="profile picture">
                        <div class="post-comment-input-contain d-flex w-90">
                            <!-- <input placeholder="write a comment here" type="text"
                                class="bg-my-secondary rounded-left border border-secondary border-right-0 w-90 px-2 outline-none"> -->
                            <textarea placeholder="write a comment here"
                                class="post-comment-input resize-none bg-my-secondary rounded-left border outline-none border-secondary border-right-0 w-90 px-2 outline-none"
                                name="post-text" cols="30" rows="1"></textarea>
                            <div
                                class="bg-my-secondary border border-secondary border-left-0 rounded-right px-2 outline-none">
                                <button class="btn post-comment-btn p-0"><i
                                        class="fas fa-camera-retro text-secondary"></i></button>
                            </div>
                        </div>

                    </div>
                </div>





                <div class="card-body p-2 bg-white mb-3 posts">
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
                    <div class="post-comment-contain">
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
                        <img class="profile-pic mr-2 rounded-circle" src="assets/images/user.jpg" alt="profile picture">
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

        <div class="col-md-3 my-2 right-nav">
            <div class="w-100 bg-light d-flex p-1 rounded font-weight-bold">
                <i class="fas fa-gift mx-2 text-warning"></i>
                <div class="color-second">Olofingbasote Opeyemi <span
                        class="text-secondary font-weight-normal">and</span> <span>8</span> others</div>
            </div>

            <div class="bg-light my-2 px-2 pb-3">
                <div class="d-flex justify-content-between">
                    <h6 class="friend-suggest-header">Friend Suggestions</h6>
                    <a href="#" class="see-all color-second ">See All</a>
                </div>

                <div class="d-flex flex-wrap justify-content-around">
                    <div class="d-flex friend-suggest mb-3">
                        <img class="status-pic mr-2 rounded-circle" src="assets/images/user-5.jpg"
                            alt="profile picture">
                        <div>
                            <h6 class="color-second  m-0">Maximanimus willips</h6>
                            <p class="text-secondary m-0"> <span>7</span> mutual friends</p>

                            <div class=" mt-0">
                                <button
                                    class="btn my-bgprimary text-white border border-secondary my-0 py-0">Add</button>
                                <button
                                    class="btn my-bgdanger text-white border border-secondary my-0 py-0">Remove</button>
                            </div>
                        </div>
                    </div>

                    <div class="d-flex friend-suggest mb-3">
                        <img class="status-pic mr-2 rounded-circle" src="assets/images/user-6.jpg"
                            alt="profile picture">
                        <div>
                            <h6 class="color-second  m-0">Cynthia luke</h6>
                            <p class="text-secondary m-0"><span>0</span> mutual friends</p>

                            <div class=" mt-0">
                                <button
                                    class="btn my-bgprimary text-white border border-secondary my-0 py-0">Add</button>
                                <button
                                    class="btn my-bgdanger text-white border border-secondary my-0 py-0">Remove</button>
                            </div>
                        </div>
                    </div>


                    <div class="d-flex friend-suggest mb-3">
                        <img class="status-pic mr-2 rounded-circle" src="assets/images/user-1.jpg"
                            alt="profile picture">
                        <div>
                            <h6 class="color-second  m-0">King Daveed</h6>
                            <p class="text-secondary m-0"><span>108</span> mutual friends</p>

                            <div class=" mt-0">
                                <button
                                    class="btn my-bgprimary text-white border border-secondary my-0 py-0">Add</button>
                                <button
                                    class="btn my-bgdanger text-white border border-secondary my-0 py-0">Remove</button>
                            </div>
                        </div>
                    </div>


                    <div class="d-flex friend-suggest mb-3">
                        <img class="status-pic mr-2 rounded-circle" src="assets/images/user-2.jpg"
                            alt="profile picture">
                        <div>
                            <h6 class="color-second  m-0">Maryan fox</h6>
                            <p class="text-secondary m-0"><span>41</span> mutual friends</p>

                            <div class=" mt-0">
                                <button
                                    class="btn my-bgprimary text-white border border-secondary my-0 py-0">Add</button>
                                <button
                                    class="btn my-bgdanger text-white border border-secondary my-0 py-0">Remove</button>
                            </div>
                        </div>
                    </div>

                    <div class="d-flex friend-suggest mb-3">
                        <img class="status-pic mr-2 rounded-circle" src="assets/images/user-5.jpg"
                            alt="profile picture">
                        <div>
                            <h6 class="color-second  m-0">Maximanimus willips</h6>
                            <p class="text-secondary m-0"> <span>7</span> mutual friends</p>

                            <div class=" mt-0">
                                <button
                                    class="btn my-bgprimary text-white border border-secondary my-0 py-0">Add</button>
                                <button
                                    class="btn my-bgdanger text-white border border-secondary my-0 py-0">Remove</button>
                            </div>
                        </div>
                    </div>

                    <div class="d-flex friend-suggest mb-3">
                        <img class="status-pic mr-2 rounded-circle" src="assets/images/user-6.jpg"
                            alt="profile picture">
                        <div>
                            <h6 class="color-second  m-0">Cynthia luke</h6>
                            <p class="text-secondary m-0"><span>0</span> mutual friends</p>

                            <div class=" mt-0">
                                <button
                                    class="btn my-bgprimary text-white border border-secondary my-0 py-0">Add</button>
                                <button
                                    class="btn my-bgdanger text-white border border-secondary my-0 py-0">Remove</button>
                            </div>
                        </div>
                    </div>
                </div>




            </div>

            <div></div>
        </div>
    </div>



</div>

<script src="node_modules/jquery/dist/jquery.min.js"></script>
<script src="node_modules/bootstrap/dist/js/bootstrap.js"></script>
<script src="assets/vendors/WOW-master/dist/wow.min.js"></script>
<script defer src="assets/javascripts/home.js"></script>
</body>

</html>