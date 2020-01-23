<?php 
require_once("user.php");

$target = validate($_POST["target"]);

$user = new User(); 
$user->toggle_about_visibility($target, $_SESSION["id"]);
// echo "ehhh";
// echo json_encode($_POST);
?>