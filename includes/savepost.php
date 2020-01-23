<?php 
require_once("user.php");
$user = new User(); 

if($_FILES["post-image"]["name"] && validate($_POST["post-text"])) {
    $user->save_post($_SESSION["id"], validate($_POST["post-text"]), $_FILES["post-image"]);
}else if (validate($_POST["post-text"])) {
    $user->save_post($_SESSION["id"], validate($_POST["post-text"]));
    
}

?>