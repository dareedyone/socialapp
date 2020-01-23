<?php 

function prep_input($data) {
    if (!empty($data)) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
   } else {
       return false;
   }
}

function redirect_to($location = NULL) {
    if ($location !=NULL) {
        header("location: {$location}");
        exit;
    }
}

function validate($data) {
    if(isset($data) && !empty($data)) {
return prep_input($data);
    }else {
        return false;
    }
}

function do_proper_unserial($val) {
    return unserialize(base64_decode($val));
      }

      function do_proper_serial($val) {

       return base64_encode(serialize($val));
       
          }

?>