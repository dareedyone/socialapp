<?php 
require_once("user.php");

$user = new User(); 

if($_POST) {
    $user->load_friends($_POST["fdids"]);
 
}


?>