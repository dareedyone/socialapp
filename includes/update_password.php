<?php 
require_once("user.php");

$oldpass = sha1(md5(validate($_POST["oldpass"])));
$newpass = sha1(md5(validate($_POST["newpass"])));

if ($oldpass && $newpass) {
    $user = new User(); 
    $user->update_password($_SESSION["id"], $oldpass, $newpass);
}else {
    echo "something went wrong !";
}

?>