<?php
	session_start(); ?>
<?php
require_once '../config/connection.php';
require_once '../includes/engine.php';

	if(isset($_GET['verify_email'])){

	$user_activation_code = $_GET['verify_email'];

   global $conn;
   $query = " SELECT * FROM `user` WHERE `activation_code` = '$user_activation_code'";
   $result = mysqli_query($conn, $query);

   if(mysqli_query($conn, $query)){
     $row=mysqli_fetch_array($result);

   }else{
     echo "Error: " . $query . "" . mysqli_error($conn);
   }

	if($row['activation_code']== $user_activation_code){
		//activate account
    global $conn;
    $query = "UPDATE user SET `email_status` = '1' WHERE `user_id` = '".$row['user_id']."'";

    $result = mysqli_query($conn, $query);
    if(mysqli_query($conn, $query)){

    }else{
      echo "Error: " . $query . "" . mysqli_error($conn);
    }?>




    <!-- Html template  -->
  <!DOCTYPE html lang="en">
  <head>
  <title> Hurray ! Activation Successful</title>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0" />
  <link rel="stylesheet" href="../resources/css/main.css">
    <link rel="stylesheet" href="../resources/css/form.css">


    </head>


<body >
<?php include "../includes/navigation.php"; ?>
<div id="main"  >

        <h4 style="padding:5%;margin:0; background-color:white; color:black;  box-shadow: 1px 1px 2px 2px #ddd; text-align:center;font-size: 20px;width:auto;height:250px;"> Your account has been activated successfully!</h4>

    </div>
    <?php include "../includes/footer-layout.php"; ?>
    <script type="text/javascript" src="../script/global_navigation.js"></script>

    </body>
    </html>

<?php


	}
	else{
    echo " something went wrong";

	}
	}
	else{
		header('location: ./index.php');
	}
?>
