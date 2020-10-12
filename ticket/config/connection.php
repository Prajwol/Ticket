<?php

// Connect to phpmyadmin for local server

$conn = mysqli_connect('localhost','root','','ticket');

// if there is any error in database name , password or server show error with following message
if(!$conn){
    die("Error connection to the database".mysqli_connect_error());
}

// Define global constant for root directory
define ('ROOT_PATH', realpath(dirname(__FILE__)));
 define('BASE_URL', 'http://localhost/ticket/');
//define('BASE_URL', 'http://192.168.64.2/ticket/');

?>
