<?php
require_once('user.php');

    // $searchparam = validate($_POST["searchp"]);
    // echo $searchparam;
    
    $user = new User(); 
   
    
    if(isset($_POST["firstname"]) && isset($_POST["lastname"])) {
         $firstname = validate($_POST["firstname"]);
         $lastname = validate($_POST["lastname"]);
         $user->do_search($firstname, $lastname);
       
    }elseif (isset($_POST["firstname"])) {
        $firstname = validate($_POST["firstname"]);
        $user->do_search($firstname, $lastname="_"); 
    }


?>