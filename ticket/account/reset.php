<?php session_start();
// include necessary files
include_once '../config/connection.php';
include_once '../includes/engine.php';
?>

<?php
if($_GET['key'] && $_GET['reset'])
{
  global $conn;
  $email=$_GET['key'];
  $password=$_GET['reset'];
	$query = " SELECT `email`, `password` FROM `user` WHERE email='$email'and md5(password)= '$password'";
	$result = mysqli_query($conn, $query);
  if(isset($result)) {

}
  if ($result) {


?>

<!DOCTYPE html lang="en">
<head>
<title> Reset your password </title>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0" />
<link rel="stylesheet" href="../resources/css/main.css">
    <link rel="stylesheet" href="../resources/css/form.css">

</head>

<body >
<?php include "../includes/navigation.php"; ?>
<div id="main" >



      <form action="reset.php"  method="post" class="container fade-in"  >
        <p class="main-title">RESET</p>

        <?php if (!empty($_SESSION['message'])){ ?>
        <p> <?PHP
          if(isset($_SESSION['message'])){
          echo $_SESSION['message'];
          unset($_SESSION['message']);
              }
      ?></p>
  <?php }else{}	?>

        <p><div><?php include('../includes/errors.php') ?></div></p>
  <div class="input-container">
    <i class="fa fa-envelope icon"></i>
    <input class="input-field" type="email" name ="email" value="<?php echo $email;?>"  readonly>
  </div>
  <div class="input-container">
    <i class="fa fa-key icon"></i>
    <input class="input-field" type="password" placeholder="Your New Password" name="npsw">
  </div>



  <input type="submit" class="btn-login" name="update_password" value="Update your password">
</form>

</div>
<?php include "../includes/footer-layout.php"; ?>


</body>
</html>
<?php
  }else{};
}
?>
