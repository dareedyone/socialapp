<?php 
require_once("user.php");

$user = new User(); 

if($_POST) {
    $user->confirm_request(validate($_POST['requestid']));
   
}


?>