<?php
session_start();
require_once('includes/functions.php');

if (! isset($_SESSION["id"])) {
    redirect_to('index.php');
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <title>SQI Social</title>
    <link rel="stylesheet" href="node_modules/bootstrap/dist/css/bootstrap.min.css" />
    <link rel="stylesheet" href="assets/stylesheets/fontawesome-free-5.11.2-web/css/all.css">
    <link rel="stylesheet" href="assets/stylesheets/index.css" />
    <!-- <link rel="stylesheet" href="WOW-master/css/libs/animate.css"> -->
    <!-- <script src="https://kit.fontawesome.com/a076d05399.js"></script> -->
    <script defer src="assets/javascripts/header.js"></script>

</head>

<body>
    <nav class="navbar navbar-expand navbar-dark homepage-nav fixed-top py-0">
        <a class="navbar-brand bg-white rounded-circle p-0 border border-dark" href="home.php"><img
                src="assets/images/sqicollege.png" alt="logo" class="logo" /></a>
        <div class="collapse navbar-collapse d-flex justify-content-around" id="navbarSupportedContent">
            <ul class="navbar-nav d-flex justify-content-between home-profile">
                <li class="nav-item active">
                    <a class="nav-link" href="home.php">Home <span class="sr-only">(current)</span></a>
                </li>

                <li class="nav-item d-flex position-relative">
                    <a class="nav-link" href="profile.php">
                        <img class="display-user-pic profile-pic rounded-circle position-absolute"
                            src="assets/images/defaultpic.jpg" alt="profile picture">

                        <span>Profile</span> </a>
                </li>

            </ul>



            <div class="w-50 position-relative search-holder">
                <form class="form-inline d-flex w-100 my-2 my-lg-0">
                    <input id="input-search" class="form-control px-2 w-75 h-50 p-0" type="search" placeholder="Search"
                        aria-label="Search" />
                    <button id="search-btn"
                        class="btn bg-hover-none border-0 h-25 py-0 px-1 btn-outline-light my-2 my-sm-0" type="button">
                        <i class="fas fa-search"></i>
                    </button>
                    <button id="secondary-search-btn"
                        class="btn bg-hover-none border-0 h-25 py-0 px-1 btn-outline-light my-2 my-sm-0 d-none"
                        type="button">
                        <i class="fas fa-search"></i>
                    </button>
                </form>

                <ul class="list-group position-absolute w-75 border border-dark search-tab d-none">
                    <!-- <li class="list-group-item border-0 py-2 d-none input-search-secondary-container">
                        <input id="input-search-secondary" class="form-control px-2 h-50 p-0" type="search"
                            placeholder="Search" aria-label="Search" />
                    </li> -->
                    <!-- <li class="list-group-item border-0 py-2 body-home">
                        <a href="#">
                            <img class="profile-pic rounded-circle" src="assets/images/user.jpg" alt="profile picture">
                            <span class="text-dark">Ridwan Ijadunola</span></a>
                    </li> -->
                    <li class="list-group-item border-0 py-2 body-home font-italic">
                        Search result here
                    </li>
                    <!-- <li class="list-group-item border-0 py-2 ">
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
                    </li> -->
                </ul>

                <ul tabindex="0"
                    class="list-group position-absolute w-75 border border-dark search-tab-secondary d-none bg-secondary">
                    <li class="list-group-item border-0 py-2 d-none input-search-secondary-container">
                        <input id="input-search-secondary" class="form-control px-2 h-50 p-0" type="search"
                            placeholder="Search" aria-label="Search" />
                    </li>
                    <!-- <li class="list-group-item border-0 py-2 body-home">
                        <a href="#">
                            <img class="profile-pic rounded-circle" src="assets/images/user.jpg" alt="profile picture">
                            <span class="text-dark">Ridwan Ijadunola</span></a>
                    </li> -->
                    <div id="secondary-holder">
                        <li class="list-group-item border-0 py-2 body-home font-italic">
                            Search result here
                        </li>

                    </div>

                    <!-- <li class="list-group-item border-0 py-2 ">
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
                    </li> -->
                </ul>
            </div>
            <!-- <div class="secondary-search-icon"> -->

            <!-- </div> -->


            <ul class="list-unstyled d-flex justify-content-between align-items-end mt-4 mini-menu">

                <li>
                    <div class="dropdown position-relative">
                        <a class="position-relative" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown"
                            aria-haspopup="true" aria-expanded="false">
                            <i class="fas fa-user-friends"></i><span id="requests_count"
                                class="badge badge-danger position-absolute invisible">-</span>
                        </a>

                        <div id="request-view" class="req-ele dropdown-menu position-absolute navdrop-menu-friends"
                            aria-labelledby="dropdownMenuLink">
                            <div class="dropdown-item dropup border-custom  m-minus position-relative p-0">
                                <i
                                    class="dropdown-toggle position-absolute  text-white navdrop-menu-friends-tooltip"></i>
                            </div>
                            <div class="req-ele dropdown-item px-2">
                                <h6>Friend Requests</h6>

                            </div>

                            <div class="req-ele" id="requests_mini_display">

                                <!-- <div class="d-flex friend-suggest px-2  justify-content-between">
                                    <div class="d-flex">
                                        <img class="status-pic mr-2 rounded-circle" src="assets/images/user-1.jpg"
                                            alt="profile picture">
                                        <div>
                                            <h6 class="color-second  m-0">King Daveed</h6>
                                            <p class="text-secondary m-0"><span>108</span> mutual friends</p>
                                        </div>
                                    </div>
                                    <div class=" mt-0">
                                        <button class="btn border confirm border-secondary my-0 py-0">Confirm</button>
                                        <button
                                            class="btn my-bgdanger text-white border border-secondary my-0 py-0">Delete</button>
                                        <button class="btn border d-none border-secondary my-0 py-0">Confirmed</button>
                                        <button class="btn border d-none border-secondary my-0 py-0">Deleted</button>
                                    </div>
                                </div>
                                <hr>


                                <div class="d-flex friend-suggest px-2 justify-content-between">
                                    <div class="d-flex">
                                        <img class="status-pic mr-2 rounded-circle" src="assets/images/user-3.jpg"
                                            alt="profile picture">
                                        <div>
                                            <h6 class="color-second  m-0">Qudus Mamare</h6>
                                            <p class="text-secondary m-0"><span>18</span> mutual friends</p>
                                        </div>
                                    </div>
                                    <div class=" mt-0">
                                        <button class="btn border confirm border-secondary my-0 py-0">Confirm</button>
                                        <button
                                            class="btn my-bgdanger text-white border border-secondary my-0 py-0">Delete</button>
                                        <button class="btn border d-none border-secondary my-0 py-0">Confirmed</button>
                                        <button class="btn border d-none border-secondary my-0 py-0">Deleted</button>
                                    </div>
                                </div>

                                <hr>
                                <div class="d-flex friend-suggest px-2 justify-content-between">
                                    <div class="d-flex">
                                        <img class="status-pic mr-2 rounded-circle" src="assets/images/user-2.jpg"
                                            alt="profile picture">
                                        <div>
                                            <h6 class="color-second  m-0">Maryann Ibokuenu</h6>
                                            <p class="text-secondary m-0"><span>14</span> mutual friends</p>
                                        </div>
                                    </div>
                                    <div class=" mt-0">
                                        <button class="btn border confirm border-secondary my-0 py-0">Confirm</button>
                                        <button
                                            class="btn my-bgdanger text-white border border-secondary my-0 py-0">Delete</button>
                                        <button class="btn border d-none border-secondary my-0 py-0">Confirmed</button>
                                        <button class="btn border d-none border-secondary my-0 py-0">Deleted</button>
                                    </div>
                                </div>

                                <hr>
                                <div class="d-flex friend-suggest px-2 justify-content-between">
                                    <div class="d-flex">
                                        <img class="status-pic mr-2 rounded-circle" src="assets/images/user-5.jpg"
                                            alt="profile picture">
                                        <div>
                                            <h6 class="color-second  m-0">Jamiu Tallest</h6>
                                            <p class="text-secondary m-0"><span>193</span> mutual friends</p>
                                        </div>
                                    </div>
                                    <div class=" mt-0">
                                        <button class="btn border confirm border-secondary my-0 py-0">Confirm</button>
                                        <button
                                            class="btn my-bgdanger text-white border border-secondary my-0 py-0">Delete</button>
                                        <button class="btn border d-none border-secondary my-0 py-0">Confirmed</button>
                                        <button class="btn border d-none border-secondary my-0 py-0">Deleted</button>
                                    </div>
                                </div> -->

                            </div>
                            <!-- <hr> -->
                            <div class="text-center req-ele">
                                <a href="#" class="see-all color-second">See All</a>
                            </div>


                        </div>
                    </div>


                </li>
                <li>
                    <div class="dropdown position-relative">
                        <a class="position-relative" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown"
                            aria-haspopup="true" aria-expanded="false">
                            <i class="fas fa-envelope"></i><span class="badge badge-danger position-absolute">20</span>
                        </a>

                        <div class="dropdown-menu position-absolute navdrop-menu-friends"
                            aria-labelledby="dropdownMenuLink">
                            <div class="dropdown-item dropup position-relative border-custom  m-minus p-0">
                                <i
                                    class="dropdown-toggle position-absolute  text-white navdrop-menu-friends-tooltip"></i>
                            </div>
                            <a class="dropdown-item py-0" href="#">
                                <h6>Message</h6>
                            </a>

                            <div class="d-flex friend-suggest px-2  justify-content-between">
                                <div class="d-flex">
                                    <img class="status-pic mr-2 rounded-circle" src="assets/images/user-1.jpg"
                                        alt="profile picture">
                                    <div>
                                        <h6 class="m-0">King Daveed</h6>
                                        <p class="text-secondary m-0">Whats up bro ?</p>
                                    </div>
                                </div>
                                <div>
                                    <span class="see-all">Thur</span>
                                </div>
                            </div>
                            <hr>

                            <div class="d-flex friend-suggest px-2  justify-content-between">
                                <div class="d-flex">
                                    <img class="status-pic mr-2 rounded-circle" src="assets/images/user-3.jpg"
                                        alt="profile picture">
                                    <div>
                                        <h6 class="m-0">Gee Black</h6>
                                        <p class="text-secondary m-0">How are you doing</p>
                                    </div>
                                </div>
                                <div>
                                    <span class="see-all">Mon</span>
                                </div>
                            </div>
                            <hr>

                            <div class="d-flex friend-suggest px-2  justify-content-between">
                                <div class="d-flex">
                                    <img class="status-pic mr-2 rounded-circle" src="assets/images/user-6.jpg"
                                        alt="profile picture">
                                    <div>
                                        <h6 class="m-0">Saint Maria</h6>
                                        <p class="text-secondary m-0">Going to school now</p>
                                    </div>
                                </div>
                                <div>
                                    <span class="see-all">Mon</span>
                                </div>
                            </div>
                            <hr>
                            <div class="text-center">
                                <a href="message.php" class="see-all color-second">See All Messages</a>
                            </div>

                        </div>
                    </div>

                </li>
                <li>
                    <div class="dropdown position-relative">
                        <a class="position-relative" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown"
                            aria-haspopup="true" aria-expanded="false">
                            <i class="fas fa-bell"></i><span class="badge badge-danger position-absolute">9</span>
                        </a>

                        <div class="dropdown-menu position-absolute navdrop-menu-friends"
                            aria-labelledby="dropdownMenuLink">
                            <div class="dropdown-item dropup position-relative p-0 border-custom  m-minus">
                                <i
                                    class="dropdown-toggle position-absolute  text-white navdrop-menu-friends-tooltip"></i>
                            </div>
                            <a class="dropdown-item py-0" href="#">
                                <h6>Notifications</h6>
                            </a>

                            <div class="d-flex friend-suggest px-2  justify-content-between">
                                <div class="d-flex">
                                    <img class="status-pic mr-2 rounded-circle" src="assets/images/user-1.jpg"
                                        alt="profile picture">
                                    <div>
                                        <h6 class="m-0">Tzee Amali <span class="see-all">is having birthday today</span>
                                        </h6>
                                        <p class="text-primary see-all m-0">Wish them the best !</p>
                                    </div>
                                </div>

                            </div>
                            <hr>

                            <div class="d-flex friend-suggest px-2  justify-content-between">
                                <div class="d-flex">
                                    <img class="status-pic mr-2 rounded-circle" src="assets/images/user-3.jpg"
                                        alt="profile picture">
                                    <div>
                                        <h6 class="m-0">Agape Love <span class="see-all">Accept your friend
                                                Request</span></h6>
                                        <p class="text-primary see-all m-0">You can now chat him without spamming !</p>
                                    </div>
                                </div>

                            </div>
                            <hr>

                        </div>
                    </div>

                </li>
                <li>
                    <div class="dropdown position-relative">
                        <a class="dropdown-toggle text-white" href="#" role="button" id="dropdownMenuLink"
                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        </a>

                        <div class="dropdown-menu position-absolute navdrop-menu-options"
                            aria-labelledby="dropdownMenuLink">
                            <!-- <a class="dropdown-item" href="#">Settings</a> -->
                            <button id="logout" class="dropdown-item">Log Out</button>

                        </div>
                    </div>
                </li>


            </ul>
        </div>
    </nav>