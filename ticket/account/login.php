<?php
session_start();
// include necessary files
include_once '../config/connection.php';
include_once '../includes/engine.php';

// include necessary function
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="../resources/css/main.css">
    <link rel="stylesheet" href="../resources/css/form.css">
    <title>Login| Arif Systems</title>


</head>
<body style="background-image: linear-gradient(rgba(0, 0, 0, 0), rgba(0, 0, 0, 0)), url('../resources/images/cover.png');background-position: center; background-repeat: no-repeat;background-size: cover;position: relative;min-height:800px;" >


<!-- Include Navigation -->
<?php include '../includes/navigation.php' ?>



    <form action="login.php"  method="post" class="container fade-in"  >
        <p class="main-title">LOGIN</p>
        <img src="../resources/images/logo.png" style="height:50px;width:60%;margin-left:20%;"  />

        <?php if (!empty($_SESSION['message'])){ ?>
        <p> <?PHP
          if(isset($_SESSION['message'])){
          echo $_SESSION['message'];
          unset($_SESSION['message']);
              }
      ?></p>
  <?php }else{}	?>

        <p><div><?php include('../includes/errors.php') ?></div></p>

        <!-- <label for="email">Email</label> -->
        <input type="text" placeholder="Enter Email" name="email" >

        <!-- <label for="psw">Password</label> -->
        <input type="password" placeholder="Enter Password" name="psw" >

        <input type="submit" class="btn-login" name="login" value="Login"></input>

        <div class="link">
      <p ><a href="<?php echo BASE_URL .'account/register.php'?>" >Don't have an account? Sign Up</a></p>
      <p > <a href="<?php echo BASE_URL .'account/forgot.php'?>">Forgot Password?</a> </p>
   </div>
    </form>




</body>
<!-- Include js files -->
<!-- Include Footer content -->
</html>