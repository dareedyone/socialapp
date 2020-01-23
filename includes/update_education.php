<?php 
require_once("user.php");

$college_name = do_proper_serial($_POST["college_name"]);
$college_course = do_proper_serial($_POST["college_course"]);
$college_certificate = do_proper_serial($_POST["college_certificate"]);
$high_school = do_proper_serial($_POST["high_school"]);

$user = new User(); 
$user->update_education($_SESSION["id"], $college_name, $college_course, $college_certificate, $high_school);
?>