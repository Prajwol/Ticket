<?php session_start();
include '../config/connection.php';
include '../includes/engine.php';
include 'includes/functions.php';

if (!isAdmin()) {
    $_SESSION['message'] = "Not Authorised";
    header('location:../../ticket/account/login.php');
}


$user = get_user_by_id($_SESSION['user']['user_id']);

$tickets = disp_all_tickets();

    
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./resources/css/app.css" />
    <script src="https://kit.fontawesome.com/94e26d1e88.js" crossorigin="anonymous"></script>



