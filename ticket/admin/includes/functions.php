<?php

function disp_all_tickets(){
    global $conn;
    // $user = get_user_by_id($_SESSION['user']['user_id']);
    // $user_id = $user['user_id'];
    // $query = "SELECT * FROM `ticket` ORDER BY `updated_at` DESC ";
    $query = "SELECT  user.*, ticket.*
              FROM    user 
              JOIN    ticket ON user.user_id = ticket.user_id
              WHERE   ticket.user_id = user.user_id
              ORDER BY ticket.updated_at DESC ";

    $result = mysqli_query($conn,$query);
    $tickets = mysqli_fetch_all($result,MYSQLI_ASSOC);

    return $tickets;
}

// Returns a single post
function display_ticket($id){
	global $conn;
	$id = $_GET['id'];
    // $query = "SELECT * FROM `ticket` WHERE `ticket_id` = '$id'  ";

    $query = "  SELECT  user.*, ticket.*
                FROM    user 
                JOIN    ticket ON user.user_id = ticket.user_id
                WHERE   ticket.ticket_id = '$id' ";

	$result = mysqli_query($conn, $query);
	$ticket = mysqli_fetch_assoc($result);
	return 	$ticket;
}

// if user clicks ignore btn
if (isset($_GET['approve'])) {
	$id = $_GET['approve'];
	approve($id);
}
if (isset($_GET['assign'])) {
	$id = $_GET['assign'];
	assign($id);
}
if (isset($_GET['reject'])) {
	$id = $_GET['reject'];
	reject($id);
}
function approve($id){
  global $conn;
  $query = "UPDATE `ticket` SET `ticket_status`='approved'  WHERE `ticket_id`=$id";
  if (mysqli_query($conn, $query)) {
    $_SESSION['message'] = "CHANGED TO UPDATED";
    header('location:./dashboard.php');
    exit(0);
  }
}

function assign($id){
    global $conn;
    $query = "UPDATE `ticket` SET `ticket_status`='assigned'  WHERE `ticket_id`=$id";
    if (mysqli_query($conn, $query)) {
      $_SESSION['message'] = "CHANGED TO ASSIGNED";
      header('location:./dashboard.php');
      exit(0);
    }
  }

  function reject($id){
    global $conn;
    $query = "UPDATE `ticket` SET `ticket_status`='reject'  WHERE `ticket_id`=$id";
    if (mysqli_query($conn, $query)) {
      $_SESSION['message'] = "CHANGED TO REJECT";
      header('location:./dashboard.php');
      exit(0);
    }
  }

?>