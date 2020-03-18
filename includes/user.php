<?php
session_start();
 require_once('functions.php') ?>
<?php require_once('database.php') ?>
<?php
class User {
private $fname; 
private $lname;
private $email;
private $passw;

private $logemail;
private $logpass;


// function __construct () {
   
  
    
// }

public function register($fname, $lname, $email, $passw) {
  global $database;
          $sqlcheck = "SELECT * FROM `user` WHERE email = '$email'";        
          $result = $database->conn->query($sqlcheck);
          if($result->num_rows > 0) {
            echo "Email already exist with an account !";

          }  else {
           $fname = ucfirst($fname);
           $lname = ucfirst($lname);
            $sql = "INSERT INTO user (firstname, lastname, email, passw, picture, cover)
            VALUES ( '$fname',  '$lname', '$email', '$passw', 'defaultpic.jpg', 'cover.png')"; 
             
            if($database->conn->query($sql) === true) {  
              $sqlcheck = "SELECT user_id FROM `user` WHERE email = '$email'";
              $result = $database->conn->query($sqlcheck);
              if($result->num_rows > 0) {
              
                $userid = $result->fetch_assoc()["user_id"];
               
                $sqlid = "INSERT INTO contact_basic (user_id)
                VALUES ( '$userid')";
                $sqledu = "INSERT INTO education (user_id)
                VALUES ( '$userid')";
                $sqlskill = "INSERT INTO skills (user_id)
                VALUES ( '$userid')";
                 if($database->conn->query($sqlid) === true && $database->conn->query($sqledu) === true && $database->conn->query($sqlskill) === true) {
                  echo "Registration Successful.. Sign In";  
                 }else {
                   echo "oops! something went wrong !";
                 }
                 
              }
                    
            } 
            else {
              echo "Error during Registration"; 
            }
          }
         
    }  



public function login($logemail, $logpass) {
  global $database;
    $sqlcheck = "SELECT * FROM `user` WHERE email = '$logemail' AND  passw='$logpass'";
    $result = $database->conn->query($sqlcheck);
    if($result->num_rows >= 1) {
      $user = $result->fetch_assoc();
      $_SESSION["id"] = $user["user_id"];
      echo "good";
    

    }  else {
      echo "Invalid Credentials !";
  }

}


public function alldata($id) {
  global $database;
  $myarray = array();
  $sqlcheck = "SELECT firstname, lastname, picture, cover FROM `user` WHERE user_id = '$id'";
  $loadpic = "SELECT name, uploaded_at FROM `photo` WHERE user_id = '$id' ORDER BY uploaded_at";
  // $loadpic = "SELECT CASE WHEN COUNT(name) > 0 THEN name ELSE 0 END AS name FROM `photo` WHERE user_id = '$id' ORDER BY uploaded_at";
  $sqlrequest = "SELECT * FROM `requests` WHERE receiver_id = '$id' LIMIT 4";
  $sqlfriends = "SELECT * FROM `friends` WHERE f1 ='$id' OR f2 ='$id'";
  
    $result = $database->conn->query($sqlcheck);
    $pictures = $database->conn->query($loadpic);
    $rq = $database->conn->query($sqlrequest);
    $fd = $database->conn->query($sqlfriends);
    if($result->num_rows >= 1 OR $pictures->num_rows >= 1 OR $rq->num_rows >= 1) {
      $user = $result->fetch_assoc();
      $picture = $pictures->fetch_all(MYSQLI_ASSOC);
      $countpic = count($picture);   
      $requests = $rq->fetch_all(MYSQLI_ASSOC);
      $countrq = count($requests);
      $friends = $fd->fetch_all(MYSQLI_ASSOC);
      $fdcount = count($friends);
      $userid = $_SESSION["id"];
    array_push($myarray, $user, $picture, $countpic, $requests, $countrq, $friends, $fdcount, $userid);   
     echo json_encode($myarray);

    } ; 

}

public function uploadphoto($id, $file, $type) {
  global $database;
$allowed = array('gif', 'png', 'jpg', 'jpeg');
$picname = $file["name"];
$ext = pathinfo($picname, PATHINFO_EXTENSION);
$ext = strtolower($ext);
if (in_array($ext, $allowed)) {
    $name = rand(). time() . '.' . $ext;
    $location = "../assets/pictures/".$name;
    $a = move_uploaded_file($file["tmp_name"], $location);
    if ($a) {
      $sql = "INSERT INTO photo (user_id, name)
      VALUES ( '$id', '$name')";
      if($database->conn->query($sql) === true) { 
        $ssql = "UPDATE user
        SET $type = '$name'
        WHERE user_id = $id"; 
        if($database->conn->query($ssql) === true) {        
          echo "Upload successful !";          
        }else {
          echo "Updating error !";
        }         
      } 
      else {
        echo "Error during uploading !"; 
      }
  
    }else {
      echo "Opps, something went wrong with uploaded file !";
    }
} else {
  echo "wrong format of file uploaded !";
}
}

public function loadabout ($id) {
  global $database;
  $sqlcheck = "SELECT * FROM `contact_basic` WHERE user_id = '$id'";
  $sqledu = "SELECT * FROM `education` WHERE user_id = '$id'";
  $sqlskill = "SELECT * FROM `skills` WHERE user_id = '$id'";
  
  $result = $database->conn->query($sqlcheck);
  $eduresult = $database->conn->query($sqledu);
  $skillresult = $database->conn->query($sqlskill);
  $arr = array();
    

    if($eduresult->num_rows > 0) {

      while($row =$eduresult->fetch_assoc() ) {

      
          $arr["college_name"] = do_proper_unserial($row["college_name"]);
          $arr["college_course"] = do_proper_unserial($row["college_course"]);
          $arr["college_certificate"] = do_proper_unserial($row["college_certificate"]);
          $arr["high_school"] = do_proper_unserial($row["high_school"]);
          
           
      }
   

    }

    if($result->num_rows > 0) {

      while($row =$result->fetch_assoc() ) {
     
        $arr["mobilenum"] = do_proper_unserial($row["mobilenum"]);
        $arr["contact_email"] = do_proper_unserial($row["contact_email"]);
        $arr["birthdate"] = do_proper_unserial($row["birthdate"]);
        $arr["gender"]= do_proper_unserial($row["gender"]);
        $arr["portfolio"]= do_proper_unserial($row["portfolio"]);
        $arr[ "social_handle"] = do_proper_unserial($row["social_handle"]);
        $arr["current_city"] = do_proper_unserial($row["current_city"]);
        
           
      }
     

    }

    if($skillresult->num_rows > 0) {

      while($row =$skillresult->fetch_assoc() ) {
     
        $arr["learning"] = do_proper_unserial($row["learning"]);
        $arr["quarter"] = do_proper_unserial($row["quarter"]);
        $arr["mental_skills"] = do_proper_unserial($row["mental_skills"]);
           
      }
     

    }
    echo json_encode($arr);
}


public function updatecontact ($id, $num, $email, $birth, $gender, $portf, $social, $city ) {
  global $database;
  $ssql = "UPDATE contact_basic
  SET mobilenum = '$num', contact_email = '$email', birthdate = '$birth', gender = '$gender', portfolio = '$portf', social_handle = '$social', current_city = '$city'
  WHERE user_id = $id"; 
  // $sql = "INSERT INTO contact_basic (user_id, mobilenum, contact_email, birthdate, gender, portfolio, social_handle, current_city)
  // VALUES ( '$id',  '$num', '$email', '$birth', '$gender', '$portf', '$social', '$city')";
  if($database->conn->query($ssql) === true) {  
    echo "Update successful !";          
  } else {
    echo "Update error !";
  }
}


public function update_education($id, $college_name, $college_course, $college_certificate, $high_school) {
  global $database;
  $ssql = "UPDATE education
  SET college_name = '$college_name', college_course = '$college_course', college_certificate = '$college_certificate', high_school = '$high_school'
  WHERE user_id = $id"; 

if($database->conn->query($ssql) === true) {  
  echo "Update successful !";          
} else { 
  echo "Update error !";
}
}


public function update_skills($id, $learning, $quarter, $mental_skills) {
  global $database;
  $ssql = "UPDATE skills
  SET learning = '$learning', quarter = '$$quarter', mental_skills = '$$mental_skills'
  WHERE user_id = $id"; 

if($database->conn->query($ssql) === true) {  
  echo "Update successful !";          
} else { 
  echo "Update error !";
}
}


public function update_password($id, $old, $new) {
  global $database;
  $sqlcheck = "SELECT passw FROM `user` WHERE user_id = '$id'";
  $result = $database->conn->query($sqlcheck);

  if($result->num_rows > 0) {
    $olddb = $result->fetch_assoc()["passw"];

    if($olddb === $old) {
      $sql = "UPDATE user
      SET passw = '$new'
      WHERE user_id = $id"; 
      if($database->conn->query($sql) === true) {  
        echo "Update successful !";          
      } else { 
        echo "Update error !";
      }
    }else {
      echo "Wrong password !";
    }
   

  }
    
}

public function toggle_about_visibility($tg, $id) {
  global $database;
  $sqlcheck = "SELECT $tg FROM `contact_basic` WHERE user_id = '$id'";
  $result = $database->conn->query($sqlcheck);

  if($result->num_rows > 0) {

    $data = $result->fetch_assoc()[$tg];
    $unserial_data = do_proper_unserial($data);
    echo var_dump($unserial_data);

    if ($unserial_data["v"] == 1 ) {
      $unserial_data["v"] = 0;
    }else {
      $unserial_data["v"] = 1;
  
    }

    $data = do_proper_serial($unserial_data);
    $ssql = "UPDATE `contact_basic`
    SET $tg = '$data'
    WHERE user_id = $id"; 
    if($database->conn->query($ssql) === true) {        
      if ($unserial_data["v"] == 1 ) {
        echo 'visible';
      }else {
        echo 'hidden';
    
      }        
    }else {
      echo "error";
    }       
  //  echo json_encode($unserial_data);
   
   

  }
    
}

public function do_search($firstname, $lastname) {
  global $database;
  $sqlcheck =  "SELECT user_id, firstname, lastname, picture FROM `user` WHERE firstname LIKE '$firstname%' AND lastname LIKE '$lastname%' LIMIT 7";
  $result = $database->conn->query($sqlcheck);

  if($result->num_rows > 0) {
    $res = $result->fetch_all(MYSQLI_ASSOC);
    echo json_encode($res);
  }else {
    echo "Search can't be found !";
  }
  
    
}


public function send_request($sid, $vid) {
  global $database;
  $sql = "INSERT INTO requests (sender_id, receiver_id, r_status)
  VALUES ('$sid',  '$vid', '0')"; 
   
  if($database->conn->query($sql) === true) {  
  echo "success";
    
}else {
  echo "error";
}
}


public function check_request($sid, $vid) {
global $database;
$sql = "SELECT id FROM `requests` WHERE sender_id = '$sid' AND receiver_id = '$vid'";
$sql2 = "SELECT id FROM `requests` WHERE sender_id = '$vid' AND receiver_id = '$sid'";
$result = $database->conn->query($sql);
$result2 = $database->conn->query($sql2);

if ($result->num_rows > 0) {
$res = $result->fetch_all(MYSQLI_ASSOC);
array_push($res, "1");
echo json_encode($res);
}else if ($result2->num_rows > 0) {
  $res2 = $result2->fetch_all(MYSQLI_ASSOC);
  array_push($res2, "2");
  echo json_encode($res2);
}else {
  echo "none found";
}
}

public function cancel_request($rid) {
global $database;
$sql = "DELETE FROM `requests` WHERE id = '$rid'";
if ($database->conn->query($sql) === true) {
  echo "success";
}else {
  echo "error";
}
}

public function load_requests($arr) {
  global $database;
  $garr = [];
  foreach ($arr as $id) {
$sql = "SELECT user_id, firstname, lastname, picture FROM user where user_id = '$id'";
$result = $database->conn->query($sql);
$res = $result->fetch_assoc();
if ($result->num_rows > 0) {
array_push($garr, $res);
}
  }
  echo json_encode($garr);
  }

  public function confirm_request($id) {
    global $database;
    $sqlsel = "SELECT sender_id, receiver_id FROM requests WHERE id='$id'";
    $result_sel = $database->conn->query($sqlsel);
    if ($result_sel->num_rows > 0) {
      $seldata = $result_sel->fetch_assoc();
      $sid = $seldata["sender_id"];
      $rid = $seldata["receiver_id"];
      $sqlins = "INSERT INTO friends (f1, f2) VALUES ('$sid', '$rid')";

      if ($database->conn->query($sqlins) === TRUE) {
        $sqldel = "DELETE FROM requests WHERE id = '$id'";
        if ($database->conn->query($sqldel) === TRUE) {
          $sqlfid = "SELECT id FROM friends WHERE f1 ='$sid' AND f2 ='$rid'";
          $fidqry = $database->conn->query($sqlfid);
          if ($fidqry->num_rows > 0) {
            $fidresult = $fidqry->fetch_assoc(); 
            echo json_encode($fidresult);
          }else {
            echo "none";
          }
         
        }
      }

     
    }
  }

  public function check_friend ($uid, $vid) {
    global $database;
    $sql = "SELECT * FROM `friends` WHERE f1 = '$uid' AND f2 = '$vid' OR f1 = '$vid' AND f2 = '$uid'";
    $result = $database->conn->query($sql);
    if ($result->num_rows > 0) {
      $data = $result->fetch_assoc();
      echo json_encode($data);
    }else {
      echo "none";
    }
  }

  public function load_friends($arr) {
    global $database;
    $garr = [];
    foreach ($arr as $id) {
  $sql = "SELECT user_id, firstname, lastname, picture FROM user where user_id = '$id'";
  $result = $database->conn->query($sql);
  $res = $result->fetch_assoc();
  if ($result->num_rows > 0) {
  array_push($garr, $res);
  }
    }
    echo json_encode($garr);
    }


    public function delete_friend($id) {
      global $database;
      $sql = "DELETE FROM `friends` WHERE id = '$id'";
      if ($database->conn->query($sql) === true) {
        echo "success";
      }else {
        echo "error";
      }
      }

      public function save_post($id, $text, $photo = false) {
        global $database;
       if ($photo) {
        $allowed = array('gif', 'png', 'jpg', 'jpeg');
        $picname = $photo["name"];
        $ext = pathinfo($picname, PATHINFO_EXTENSION);
        $ext = strtolower($ext);
        if (in_array($ext, $allowed)) {
        
            $name = rand(). time() . '.' . $ext;
            $location = "../assets/pictures/".$name;
            $a = move_uploaded_file($photo["tmp_name"], $location);
            if ($a) {
              $sql = "INSERT INTO posts (user_id, text, image)
              VALUES ('$id', '$text', '$name')";
              if($database->conn->query($sql) === true) { 
                echo "Posting successful !";  
           
                }else {
                  echo "Posting error !";
                }         
              }else {
                echo "Error moving file !";
              } 
        }
      } else {
        $sql = "INSERT INTO posts (user_id, text)
              VALUES ('$id', '$text')";
              if($database->conn->query($sql) === true) { 
                echo "Posting successful !";  
           
                }else {
                  echo "Posting error !";
                }         

      }
    }

public function load_user_friends($id) {
global $database;
$sqlfriends = "SELECT * FROM `friends` WHERE f1 ='$id' OR f2 ='$id'";
$result = $database->conn->query($sqlfriends);

if ($result->num_rows > 0) {
  $output =  $result->fetch_all(MYSQLI_ASSOC);
  array_push($output, $_SESSION["id"]);
 echo json_encode($output);
}
}

public function load_posts($arr) { 
  global $database;
  $garr = [];
  foreach ($arr as $id) {
    // $sql = "SELECT user.user_id, user.firstname, user.lastname, user.picture, posts.id post_id, posts.text post_text, posts.image post_image, posts.time post_time FROM posts INNER JOIN user USING(user_id) WHERE user_id='$id' ORDER BY post_time DESC";

    // $sql = "SELECT user.user_id, user.firstname, user.lastname, user.picture, posts.id post_id, posts.text post_text, posts.image post_image, posts.time post_time, likes.id like_id, likes.liker_id FROM posts INNER JOIN user USING(user_id) left join likes ON (likes.post_id=posts.id) WHERE user_id='$id' ORDER BY post_time DESC";
    // $sql ="SELECT user.user_id, user.firstname, user.lastname, user.picture, posts.id post_id, posts.text post_text, posts.image post_image, posts.time post_time, GROUP_CONCAT(likes.id) like_id, GROUP_CONCAT(likes.liker_id) liker_id FROM posts INNER JOIN user USING(user_id) left join likes ON (likes.post_id=posts.id) WHERE user_id='$id' GROUP BY posts.id ORDER BY post_time DESC";

$sql = "SELECT user.user_id, user.firstname, user.lastname, user.picture, posts.id post_id, posts.text post_text, posts.image post_image, posts.time post_time, GROUP_CONCAT(likes.id) like_id, GROUP_CONCAT(likes.liker_id) liker_id, c.comment_id, c.commenter_id, c.commenter_fullname, c.commenter_picture, c.comment_text, c.comment_time FROM posts INNER JOIN user USING(user_id) LEFT JOIN likes ON (likes.post_id=posts.id) LEFT JOIN (SELECT user.user_id, posts.id, comments.post_id cpid, GROUP_CONCAT(comments.id) comment_id, GROUP_CONCAT(comments.commenter_id) commenter_id, GROUP_CONCAT(CONCAT(user.firstname,' ', user.lastname)) commenter_fullname, GROUP_CONCAT(user.picture) commenter_picture, GROUP_CONCAT(comments.text SEPARATOR '----') comment_text, GROUP_CONCAT(comments.time) comment_time FROM comments RIGHT JOIN posts ON (comments.post_id = posts.id ) RIGHT JOIN user ON (commenter_id = user.user_id) GROUP BY comments.post_id) c ON (c.id = posts.id) WHERE posts.user_id='$id' GROUP BY posts.id ORDER BY post_time DESC";
$result = $database->conn->query($sql);

if ($result->num_rows > 0) {
  $res = $result->fetch_all(MYSQLI_ASSOC);
  array_push($garr, $res);
}                               
  }
  echo json_encode($garr);
  }

public function post_like ($id, $pid) {
global $database;
$sqlcheck = "SELECT * FROM `likes` WHERE post_id ='$pid' AND liker_id ='$id'";
$sqldel = "DELETE FROM `likes` WHERE post_id ='$pid' AND liker_id ='$id'";
$sqlins = "INSERT INTO `likes` (post_id, liker_id) VALUES('$pid', '$id')";
$checkresult = $database->conn->query($sqlcheck);
if ($checkresult->num_rows > 0) {
if ($database->conn->query($sqldel) == true) {
echo "unlike";
}
}else {
  if ($database->conn->query($sqlins) == true) {
    echo "like";
    }
}
  }

  public function mini_user_data ($id) {
    global $database;
    $sqlsel = "SELECT user_id, firstname, lastname, picture, cover FROM `user` WHERE user_id = '$id'";
    
    $checkresult = $database->conn->query($sqlsel);
    if ($checkresult->num_rows > 0) {
   echo json_encode($checkresult->fetch_assoc());
    }
      }

  public function post_comment ($uid, $pid, $comment) {
    global $database;
    $sqlins = "INSERT INTO `comments` (post_id, commenter_id, text) VALUES('$pid', '$uid', '$comment')";
    $sqlsel = "SELECT * FROM `comments` WHERE post_id='$pid' AND commenter_id='$uid' AND text='$comment'";
    
    if ($database->conn->query($sqlins) == true) {
  //  echo "comment successful";
   $result = $database->conn->query($sqlsel);
   if ($result->num_rows > 0) {
     $postres = $result->fetch_assoc();
     echo json_encode($postres);
   }
    }
      }

  public function load_profile_posts($id) {
    global $database;
    echo $id . " here is id";
    // $sql = "SELECT user.user_id, user.firstname, user.lastname, user.picture, posts.id post_id, posts.text post_text, posts.image post_image, posts.time post_time, GROUP_CONCAT(likes.id) like_id, GROUP_CONCAT(likes.liker_id) liker_id, c.comment_id, c.commenter_id, c.commenter_fullname, c.commenter_picture, c.comment_text, c.comment_time FROM posts INNER JOIN user USING(user_id) LEFT JOIN likes ON (likes.post_id=posts.id) LEFT JOIN (SELECT user.user_id, posts.id, comments.post_id cpid, GROUP_CONCAT(comments.id) comment_id, GROUP_CONCAT(comments.commenter_id) commenter_id, GROUP_CONCAT(CONCAT(user.firstname,' ', user.lastname)) commenter_fullname, GROUP_CONCAT(user.picture) commenter_picture, GROUP_CONCAT(comments.text SEPARATOR '----') comment_text, GROUP_CONCAT(comments.time) comment_time FROM comments RIGHT JOIN posts ON (comments.post_id = posts.id ) RIGHT JOIN user ON (commenter_id = user.user_id) GROUP BY comments.post_id) c ON (c.id = posts.id) WHERE posts.user_id='$id' GROUP BY posts.id ORDER BY post_time DESC";
    $sql ="SELECT * FROM user WHERE id = '$id'";
    $result = $database->conn->query($sql);
    if ($result->num_rows > 0) {
      $res = $result->fetch_all(MYSQLI_ASSOC);
      echo json_encode($res);
    } 
    else{
      $srr = [];
      echo json_encode($srr);
    }
      }



}



?>