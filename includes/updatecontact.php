<?php
require_once("user.php");

$mobilenum = do_proper_serial($_POST["mobilenum"]);
$contact_email = do_proper_serial($_POST["contact_email"]);
$birthdate = do_proper_serial($_POST["birthdate"]);
$gender = do_proper_serial($_POST["gender"]);
$portfolio = do_proper_serial($_POST["portfolio"]);
$socialhandle = do_proper_serial($_POST["social_handle"]);
$currentcity = do_proper_serial($_POST["current_city"]);
$user = new User(); 
$user->updatecontact($_SESSION["id"], $mobilenum, $contact_email, $birthdate, $gender, $portfolio, $socialhandle, $currentcity );

?>