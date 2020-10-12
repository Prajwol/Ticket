<?php
	session_start();
	session_unset($_SESSION['user']);
	session_destroy();
    $_SESSION['message'] = "You've been log out of the system";
	header("Location: http://localhost/ticket/account/login.php");
?>
