<?php 
require_once("user.php");

$user = new User(); 

if(isset($_POST)) {
if (validate($_POST["comment"])) {
    $user->post_comment($_SESSION["id"], validate($_POST["postid"]), validate($_POST["comment"]));
}
    
   
   
  
}


?>