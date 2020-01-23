<?php 
require_once("user.php");

$user = new User(); 

if($_POST) {
    $user->load_requests($_POST["reqs"]);
    // echo $_POST["reqs"];
}


?>