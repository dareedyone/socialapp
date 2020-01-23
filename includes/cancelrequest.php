<?php 
require_once("user.php");

$user = new User(); 

if($_POST) {
    $user->cancel_request(validate($_POST['requestid']));
}


?>