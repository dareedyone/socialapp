<?php 
require_once("user.php");

$user = new User(); 

if($_POST) {
    $user->check_request(validate($_SESSION["id"]) ,validate($_POST['visitId']));
}else {
    echo "none found";
}


?>