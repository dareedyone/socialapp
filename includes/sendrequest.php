<?php
require_once('user.php');
$user = new User();

if($_POST) {
    if ($_SESSION["id"] === $_POST['visitId']) {
        echo "You cant send friend request to yourself !";
    }else {
        $user->send_request(validate($_SESSION["id"]) ,validate($_POST['visitId']));
    }

}else {
    // $user->alldata(validate($_SESSION["id"]));
    echo "You cant send friend request to yourself !";
}





?>

