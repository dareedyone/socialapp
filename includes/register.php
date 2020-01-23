<?php
require_once('user.php');

if (isset($_POST["rsubmit"])) {
    $fname = validate($_POST["fname"]);
    $lname = validate($_POST["lname"]);
    $email = validate($_POST["email"]);
    $passw = sha1(md5(validate($_POST["passw"])));
    $user = new User(); 
    $user->register($fname, $lname, $email, $passw);  

} 
?>