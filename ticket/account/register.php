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
    <title>Register| Arif Systems</title>


</head>
<body>
<!-- Include Navigation -->
<?php include '../includes/navigation.php' ?>



    <form action="register.php" class="container fade-in" method="post" >
    <p class="main-title">REGISTER</p>

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
        <input type="text" placeholder="First Name" name="first_name"  style="width:49.3%;" >
        <input type="text" placeholder="Last Name" name="last_name"  style="width:49.3%;" >
        <input type="email" placeholder="Email Address" name="email" >

        <!-- <label for="psw">Password</label> -->
        <input type="password" placeholder="Password" name="psw" >
        <input type="password" placeholder="Confirm Password" name="cpsw" >

        <input type="submit" class="btn-login" name="register" value="Register"></input>

        <div class="link">
      <p><a href="<?php echo BASE_URL .'/account/login.php'?>">Already have an account? Log in</a></p>
      
   </div>
    </form>




</body>
<!-- Include js files -->
<!-- Include Footer content -->
</html>