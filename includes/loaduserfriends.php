<?php 
require_once("user.php");

$user = new User(); 
$user->load_user_friends($_SESSION["id"]) 

?>