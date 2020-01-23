<?php
require_once('user.php');
if (isset($_POST["logbtn"])) {
    $logemail = validate($_POST["logemail"]);
    $logpass = sha1(md5(validate($_POST["logpass"])));
    $user = new User(); 
    $user->login($logemail, $logpass);
}
?>