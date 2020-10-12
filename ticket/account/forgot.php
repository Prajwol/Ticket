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
    <title>Forgot| Arif Systems</title>


</head>
<body>
<!-- Include Navigation -->
<?php include '../includes/navigation.php' ?>



<form action="forgot.php"  method="post" class="container fade-in"  >
        <p class="main-title">FORGOT</p>

        <?php if (!empty($_SESSION['message'])){ ?>
        <p> <?PHP
          if(isset($_SESSION['message'])){
          echo $_SESSION['message'];
          unset($_SESSION['message']);
              }
      ?></p>
  <?php }else{}	?>

        <p><div><?php include('../includes/errors.php') ?></div></p>


        <p> Enter your email address through which you had created an account.</p>

        <input type="email" placeholder="Email" name="email" required>

        <input type="submit" class="btn-login" name="forgot" value="Send reset email"></input>

        <div class="link">
        <p><a href="<?php echo BASE_URL .'/account/login.php'?>">&#8592; Back to login</a></p>

  
   </div>
    </form>




</body>
<!-- Include js files -->
<!-- Include Footer content -->
</html>