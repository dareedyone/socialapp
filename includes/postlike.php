<?php 
require_once("user.php");

$user = new User(); 

if($_POST) {
    $user->post_like($_SESSION["id"], $_POST["postid"]);
   
  
}


?>