<?php
require_once('user.php');
$user = new User();
$user->alldata(validate($_SESSION["id"]));




?>

