<?php 
require_once("user.php");

$user = new User(); 

if($_POST) {
    // $user->alldata(validate($_POST['visitId']));
    $user->load_profile_posts(validate($_POST['visitId']));
}else {
    $user->load_profile_posts($_SESSION["id"]);
}


?>