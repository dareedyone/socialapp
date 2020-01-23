<?php 
require_once("user.php");

$user = new User(); 

if($_POST) {
    // $user->alldata(validate($_POST['visitId']));
    $user->loadabout(validate($_POST['visitId']));
}else {
    $user->loadabout($_SESSION["id"]);
}


?>