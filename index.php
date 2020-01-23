<?php 
session_start();
require_once('includes/functions.php');

if (isset($_SESSION["id"])) {
    redirect_to('home.php');
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
    <link rel="stylesheet" href="assets/stylesheets/index.css" />
    <link rel="stylesheet" href="assets/vendors/WOW-master/css/libs/animate.css">

</head>

<body>
    <div class="container-fluid mother">
        <div class="row">
            <nav class="navbar-my d-flex justify-content-between align-items-center col wow slideInDown">
                <div class="logo-container p-2">
                    <img src="assets/images/sqicollege.png" alt="logo" class="logo" />
                    <div class="social wow bounceInUp">Social</div>
                </div>
                <a class="coll" href="edu.sqi.edu.ng"> College</a>
            </nav>
        </div>

        <div class="row land-container">
            <div class="col-md-6 c2a-container">
                <div class="c2a wow slideInLeft">
                    <h5>SQI COLLEGE OF ICT SOCIAL MEDIA PLATFORM</h5>
                    <p>
                        A social network platform created for students, instructors,
                        alumni, staffs and every member of SQI COLLEGE OF ICT to
                        socialize, collaborate, and connect to each other bringing an
                        atmosphere of productivity and connectivity.
                    </p>

                    <!-- <span class="test"></span> -->

                    <button type="button" id="c2a-button" class="btn btn-outline-primary">
                        Register
                    </button>
                    <br />
                    <small class="font-weight-bold">Study at SQI succeed anywhere !</small>
                </div>
            </div>

            <div class="col-md-6 pt-5 pb-2">
                <div class="bg-white w-50 reg-log wow bounceInUp">
                    <form method="post" id="register" class="p-3 shadow-lg d-none">
                        <h5>Register SQI Social</h5>
                        <small class="d-none mb-1" id="myAlert" class="alert py-0" role="alert"></small>

                        <div class="form-row">
                            <div class="col">
                                <input id="fn" required type="text" name="fname" class="form-control"
                                    placeholder="First name" />
                            </div>
                            <div class="col">
                                <input id="ln" required type="text" name="lname" class="form-control"
                                    placeholder="Last name" />
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="exampleInputEmail1">Email address</label>
                            <input id="em" required name="email" type="email" class="form-control"
                                id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Your email" />
                            <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone
                                else.</small>
                        </div>

                        <div class="form-group">
                            <label for="pass1">Password</label>
                            <input autocomplete="off" required type="password" name="passw" class="form-control"
                                id="pass1" placeholder="Password" />
                        </div>


                        <div class="form-group">
                            <label for="pass2">Repeat Password</label>
                            <input autocomplete="off" required type="password" name="rpassw" class="form-control"
                                id="pass2" placeholder="Repeat Password" />
                        </div>

                        <button type="submit" id="rbtn" name="rsubmit" class="btn btn-primary">Submit</button>
                    </form>


                    <form id="login" class="p-4 shadow-lg">
                        <h5 class="mb-4">Login to SQI Social</h5>
                        <small id="mySucc" class="alert alert-danger py-0 d-none" role="alert"></small>
                        <div class="form-group">
                            <label for="logemail">Email address</label>
                            <input required type="email" name="logemail" class="form-control" id="logemail"
                                aria-describedby="emailHelp" placeholder="Enter email">
                        </div>
                        <div class="form-group">
                            <label for="logpass">Password</label>
                            <input required autocomplete="off" id="logpass" name="logpass" type="password" class="form-control"
                                placeholder="Password">
                        </div>

                        <button id="logbtn" name="logbtn" type="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script src="node_modules/jquery/dist/jquery.min.js"></script>
    <script src="node_modules/bootstrap/dist/js/bootstrap.js"></script>
    <script src="assets/vendors/WOW-master/dist/wow.min.js"></script>
    <script defer src="assets/javascripts/index.js"></script>

</body>

</html>