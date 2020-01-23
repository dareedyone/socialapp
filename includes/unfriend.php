<?php 
require_once("user.php");

$user = new User(); 

if($_POST) {
    $user->delete_friend(validate($_POST['friendid']));
}


?>