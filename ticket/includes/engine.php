<?php
 use PHPMailer\PHPMailer\PHPMailer;
 use PHPMailer\PHPMailer\SMTP;
 use PHPMailer\PHPMailer\Exception;

  $errors = array();
  $conn = mysqli_connect('localhost','root','','ticket');

  if (isset($_POST['login'])) {
      global $conn;
      
      $email = esc($_POST['email']);
      $password = esc($_POST['psw']);

      if (empty($email)) { array_push($errors, "*email is required");}
      if (empty($password)) { array_push($errors, "*password is required");}

      if (count($errors) == 0) {
      $sql = "SELECT * FROM `user` WHERE `email` = '".$email."' AND `email_status`='1'";
      $result = mysqli_query($conn,$sql);

      if (mysqli_num_rows($result) > 0) {
      $row = mysqli_fetch_assoc($result);

      if(password_verify($password,$row['password'])){
        $reg_user_id =   $row['user_id'];
        // Last login function and make session active
        $date = date('Y-m-d');
        $update="UPDATE `user` SET `last_login` = '$date'  WHERE `user_id`='$reg_user_id'";
        mysqli_query($conn,$update);
        $_SESSION['user'] = get_user_by_id($reg_user_id);

        $_SESSION['message'] = "Password verified";

        // if user is admin, redirect to admin area
        if ( in_array($_SESSION['user']['user_type'], ['client'])) {

          header('location: ' . BASE_URL . 'my/dashboard.php');
          exit(0);

        }else if ( in_array($_SESSION['user']['user_type'], ["admin"])){

          header('location: ' . BASE_URL . 'admin/dashboard.php');
          exit(0);

        }else {

        header('location: ../engineer/dashboard.php');
        exit(0);
        
      }
  }
  else{ 
    $_SESSION['message'] = "Wrong Password";
      }
    }
  else{
  $_SESSION['message']= "Verification failed";
    }
  }
  }

  if (isset($_POST['register'])) {
    global $conn;
    $first_name = esc($_POST['first_name']);
    $last_name = esc($_POST['last_name']);
    $email = esc($_POST['email']);
    $password = esc($_POST['psw']);
    $cPassword = esc($_POST['cpsw']);

    if (empty($first_name)) { array_push($errors, "*first name is required");}
    if (empty($last_name)) { array_push($errors, "*last name is required");}
    if (empty($email)) { array_push($errors, "*email is required");}
    if (empty($password)) { array_push($errors, "*password is required");}

    if (strlen($password) <= 5) {
      array_push($errors,"*Password must be more than 5 characters!");
     }
    if ($password != $cPassword){
      array_push($errors, "*please check your password");
    }

    $user_check_query = "SELECT * FROM `user` WHERE `email` = '$email' LIMIT 1";
    $result = mysqli_query($conn,  $user_check_query);
    $user = mysqli_fetch_assoc($result);
    if (($user['email'] === $email)) {
         array_push($errors, "Sorry, this email is already register.");
    }else{
      echo "";
    }

      if (count($errors) == 0) {
      $options = array("cost"=>4);
      $hash = password_hash($password,PASSWORD_BCRYPT,$options);
      $user_activation_code = md5(rand());



     $query = "INSERT INTO `user` (`user_id`, `first_name`, `last_name`, `email`, `password`, `user_type`, `activation_code`, `email_status`, `created_at`, `updated_at`)
                            VALUES (NULL, '$first_name', '$last_name', '$email', '$hash', 'client', '$user_activation_code', '0', current_timestamp(), current_timestamp())";

      $result = mysqli_query($conn,$query);



   

      if($result){

      $_SESSION['message'] = "Your account has been created sucessfully. Please verify your email address to secure and create your first ticket";
      if(isset($result)){

          require 'Exception.php';
          require 'PHPMailer.php';
          require 'SMTP.php';

          $base_url = "http://localhost/ticket/account/";
          $mail = new PHPMailer(true);

          $mail_body = '<html><body style="width:95%;padding:2%; margin:0; >';
          $mail_body .= '<h3  style="padding:2px; text-align:center;color:#333;">Automatic Ticket Management | ARIF </h3></hr>';

          $mail_body .= '<div  style="padding:0; background-color:royalblue;height:10%;width:100%;overfolow:hidden;"></div>';

          $mail_body .= "<p>Hi ".$first_name.", thank you for creating an account with Arif System. To continue and to secure your account, please verify your email address by clicking the button below.</p>";

          $mail_body .= "<br><a href='http://localhost/ticket/account/activate.php?verify_email=".$user_activation_code."' style=' width:50%; background-color: tomato;border: none;color: white;padding: 8px 10px;text-align: center;text-decoration: none;display: inline-block;font-size:14px; margin:auto;'>Verify Email</a></br>";
          $mail_body .= '<p  style="color:black;">If this button does not redirect you to the browser then please copy and paste the link below in the browser url.</p>';
          $mail_body .= "<br> ".$base_url."activate.php?verify_email=".$user_activation_code."</br>";
          $mail_body .= '<p  style="color:black;">If you did not create this account , please ignore this email and kindly delete it.</p><br>';
          $mail_body .= '<p  style="color:black;">The Arif System Team</p>';




          $mail_body .= "</body></html>";

          try {
            //Server settings
            $mail->SMTPDebug = 0;
            $mail->isSMTP();                                           
            $mail->Host       = 'smtp.gmail.com';                   
            $mail->SMTPAuth   = "true";                                   
            $mail->Username   = 'prazu23@gmail.com';                  
            $mail->Password   = 'romeolopshum9849';                              
            $mail->SMTPSecure = 'ssl';
            $mail->Port = '465';

            //Recipients
            $mail->setFrom('prazu23@gmail.com', 'Welcom to Arif System');
            $mail->addAddress($_POST['email'], $_POST['first_name']);     // Add a recipient
          

            // Content
            $mail->isHTML(true);                                  // Set email format to HTML
            $mail->Subject = 'Welcom to Arif System';
            $mail->Body    =  $mail_body;

            $mail->Send();
            header('location:register.php');

          } catch (Exception $e) {
            echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
        }

      }

      }
      exit(0);

    }
  }





//password reset function
    if(isset($_POST['forgot'])){
      $email = esc($_POST['email']);

      if (empty($email)) {array_push($errors, "Please enter your email address");}

       $email_check_query = "SELECT * FROM `user` WHERE email = '$email' LIMIT 1";

       $result = mysqli_query($conn,  $email_check_query);
       $user = mysqli_fetch_assoc($result);

       if (!($user['email'] === $email)) {
       array_push($errors, "Not registered email");
       }

       if (count($errors) == 0) {
        $password='';
        $password = md5($password);
        $query = "SELECT `email`, `password` FROM `user` WHERE email='$email'";
        $result = mysqli_query($conn, $query);

          if(isset($result))	{
            require 'Exception.php';
            require 'PHPMailer.php';
            require 'SMTP.php';

            $base_url="http://localhost/ticket/account/reset.php?key=".$email."&reset=".$password."'</a>";
              $mail = new PHPMailer(true);

              $mail_body = '<html><body style="width:95%;padding:2%; margin:0; border:0.1px solid #eee;">';
              $mail_body .= '<h3  style="padding:2px; text-align:center;color:#333;">Automatic Ticket Management | ARIF </h3></hr>';

              $mail_body .= "<h5>Hi ".$email.",  </h5>";
              $mail_body .= '<p  style="color:black;">You recently requested to reset your password for Ticket System Account. Click on the button below to reset it. </p><br>';

         
              $mail_body .= "<br><a href='http://localhost/ticket/account/reset.php?key=".$email."&reset=".$password."' style=' width:50%;background-color: royalblue;border: none;color: white;padding: 8px 10px;text-align: center;text-decoration: none;display: inline-block;font-size:14px;'>Reset Password</a></br>";

              $mail_body .= '<p  style="color:grey;">If you did not request a password reset, please ignore this email and kindly delete it.</p><br>';
              $mail_body .= '<p  style="color:black;">The Arif System Team</p>';


              $mail_body .= "</body></html>";

              try {
                //Server settings
            $mail->SMTPDebug = 0;
            $mail->isSMTP();                                           
            $mail->Host       = 'smtp.gmail.com';                   
            $mail->SMTPAuth   = "true";                                   
            $mail->Username   = 'prazu23@gmail.com';                  
            $mail->Password   = 'romeolopshum9849';                              
            $mail->SMTPSecure = 'ssl';
            $mail->Port = '465';

            //Recipients
            $mail->setFrom('prazu23@gmail.com', 'Reset your password');
            $mail->addAddress($_POST['email']);     // Add a recipient
          

            // Content
            $mail->isHTML(true);                                  // Set email format to HTML
            $mail->Subject = 'Reset Link';
            $mail->Body    =  $mail_body;

            $mail->Send();
            $_SESSION['message'] = "Please check your email address and follow the link we have sent you!";

              } catch (Exception $e) {
                echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
            }
             }
           }
}



if(isset($_POST['update_password']) && $_POST['email'] && $_POST['npsw'])
{
  $email=$_POST['email'];
  $password=$_POST['npsw'];
  $options = array("cost"=>4);
  $hash = password_hash($password,PASSWORD_BCRYPT,$options);

  $query="UPDATE `user` SET `password`='$hash' where email='$email'";
  $result = mysqli_query($conn, $query);
  $reg_user_id = mysqli_insert_id($conn);

    if(isset($result)) {
      $_SESSION['message'] = "Your password has been reset sucessfully!";
      header('location:login.php');
}
}

if (isset($_POST['update-basic-info'])) {
  global $conn;
  $first_name = esc($_POST['first_name']);
  $last_name = esc($_POST['last_name']);


  $user = get_user_by_id($_SESSION['user']['user_id']);
  $user_id = $user['user_id'];

  $query = "UPDATE `user` SET `first_name` ='$first_name',`last_name` ='$last_name' WHERE `user_id` ='$user_id' ";

  $result = mysqli_query($conn,$query);



  $_SESSION['message'] = "PROFILE UPDATE SUCCESSFUL";
  header('location:'.$_SERVER['PHP_SELF']);
  exit(0);
}




function get_user_by_id($user_id) {
    global $conn;
    $query = "SELECT * FROM `user` WHERE `user_id` ='$user_id' LIMIT 1";
    $result = mysqli_query($conn, $query);
    $user = mysqli_fetch_assoc($result);
    return $user;
  }

  function isLoggedIn()
  {
      if (isset($_SESSION['user'])) {
          return true;
      }else{
          return false;
      }
  }

  // ...
  function isAdmin()
  {
      if (isset($_SESSION['user']) && $_SESSION['user']['user_type'] == 'admin' ) {
          return true;
      }else{
          return false;
      }
  }

// escape value from form
function esc(String $value){
    global $conn;
    $val = trim($value); // remove empty space sorrounding string
    $val = mysqli_real_escape_string($conn, $value);
    return $val;
  }




if(isset($_POST['contact'])){

    $name = $_POST['name'];
    $email = $_POST['email'];
    $message = $_POST['message'];
    if (empty($name)) { array_push($errors, "* Name is required");}
    if (empty($email)) { array_push($errors, "* Email is required");}
    if (empty($message)) { array_push($errors, "* Message is required");}
    
    
    if (count($errors) == 0) {
 
     $query= "INSERT INTO `contact` (`contact_id`, `contact_name`, `contact_email`, `contact_message`, `contact_status`, `created_at`, `updated_at`) VALUES
            (NULL, '$name', '$email', '$message', '0', current_timestamp(), current_timestamp())";
    
    $result = mysqli_query($conn, $query);
       if($result){
         $_SESSION['message'] = "Thanks for being awesome! Your message has been sent sucessfully.";
       }
       
      if(isset($result)){
    
            require 'Exception.php';
            require 'PHPMailer.php';
            require 'SMTP.php';
    
    
            $mail = new PHPMailer(true);
    
    
                  $mail_body = '<html><body style="width:95%;padding:1%; margin:0;">';
                  $mail_body .= '<img src="https://www.suryapanday.com.np/image/myproject.png" style="width:100%;" alt="" />';

                 
                  $mail_body .= '<h5  style="padding:2px; text-align:right;color:#333;">suryapanday.com.np</h5></hr>';
                  $mail_body .= '<p style="border-bottom:2px solid royalblue;width:20%;text-align:center;"> </p>';

                  $mail_body .= "<p>Hi ".$name.", </p>";
                  $mail_body .= '<p>Thanks for being awesome! Please allow me some time to go through your message.</p><br>';
    
        
                  $mail_body .= "<p>You are receiving this email because you recently contacted me by using your email (".$email."). If this was not you, please ignore this email and kindly delete this email.</p>";
                  $mail_body .= '<p style="text-align:center;border-top:1px solid grey;"><br>Surya Panday<br>The blog of Surya Panday<br><a href="https://wwww.suryapanday.com.np/">www.suryapanday.com.np</a></p>';
                  $mail_body .= "</body></html>";
    
            try {
              
           // $mail->SMTPDebug = 1;                      // Enable verbose debug output
              $mail->SMTPDebug = 0;                      // Enable verbose debug output
              $mail->isSMTP();                                            // Send using SMTP
              $mail->Host       = 'smtp.gmail.com';                    // Set the SMTP server to send through
              $mail->SMTPAuth   = "true";                                   // Enable SMTP authentication
              $mail->Username   = 'suryapanday1.sp@gmail.com';                     // SMTP username
              $mail->Password   = 'G2054M0503';                               // SMTP password
              $mail->SMTPSecure = 'ssl';         // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged
              $mail->Port = '465';                                   // TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above

              //Recipients
              $mail->setFrom('admin@suryapanday.com.np', 'Surya Panday');
              $mail->addAddress($_POST['email'], $_POST['name']);     // Add a recipient
             
              // Content
              $mail->isHTML(true);                                  // Set email format to HTML
              $mail->Subject = 'Thank you for your message.';
              $mail->Body    =  $mail_body;
    
              $mail->Send();
           
            } catch (Exception $e) {
              echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
          }
    
        }
    
    }
          //  exit(0);
    
    }


    // function show recent messages
    function display_all_contact_email(){
      global $conn;
      // $query="SELECT DISTINCT `contact_email` FROM  `contact` ORDER BY `created_at` DESC LIMIT 20";
      $query ="SELECT DISTINCT `contact_email` FROM `contact` ORDER BY `updated_at` DESC LIMIT 50 ";
      $result = mysqli_query($conn,$query);
      $contact_email = mysqli_fetch_all($result,MYSQLI_ASSOC);
      return  $contact_email ;
  
    }

    function get_all_the_messages_based_on_email($email){
      global $conn;
          $email = $_GET['user'];
          $sql = "select * FROM `contact`  WHERE `contact_email` ='$email' ";
          $result = mysqli_query($conn, $sql);
          $messages = mysqli_fetch_all($result,MYSQLI_ASSOC);
          return $messages;
  }
  

  function get_message_based_on_id($id){
      global $conn;
      $id = $_GET['message'];
      $query = "SELECT * FROM `contact` WHERE `contact_id` = ' $id'";
      $result = mysqli_query($conn,$query);
      $message = mysqli_fetch_assoc($result);
    
      // while ($row = $result->fetch_assoc()) {
      //     $notify[] = $row;
      //  }
      return $message;
    }
    

?>
