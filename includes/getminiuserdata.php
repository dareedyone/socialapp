<?php 
require_once("user.php");

$user = new User(); 

    $user->mini_user_data($_SESSION["id"]);
   


?>