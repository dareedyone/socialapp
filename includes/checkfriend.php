<?php 
require_once("user.php");

$user = new User(); 

if($_POST) {
    $user->check_friend(validate($_SESSION["id"]) ,validate($_POST['visitId']));
}else {
    echo "none";
}


?>