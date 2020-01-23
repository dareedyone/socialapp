<?php 
require_once("user.php");
$user = new User(); 
if ($_FILES["userphoto"]["name"] && $_FILES["usercover"]["name"]) {
   
    $user->uploadphoto($_SESSION["id"], $_FILES["userphoto"], "picture"); 
    $user->uploadphoto($_SESSION["id"], $_FILES["usercover"], "cover");   
    
}else if ($_FILES["userphoto"]["name"] || $_FILES["usercover"]){
    if ($_FILES["userphoto"]["name"]) {
        $user->uploadphoto($_SESSION["id"], $_FILES["userphoto"], "picture"); 
    }else {
        $user->uploadphoto($_SESSION["id"], $_FILES["usercover"], "cover");   
    }
   
}else {
    echo "You must upload profile or cover photo !";
}
?>