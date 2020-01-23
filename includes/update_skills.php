<?php 
require_once("user.php");


$learning = do_proper_serial($_POST["learning"]);
$quarter = do_proper_serial($_POST["quarter"]);
$mental_skills = do_proper_serial($_POST["mental_skills"]);


$user = new User(); 
$user->update_skills($_SESSION["id"], $learning, $quarter, $mental_skills);
?>