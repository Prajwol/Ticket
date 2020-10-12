<?php

if (isset($_POST['update-profile'])) {
    global $conn;
    $first_name = esc($_POST['first_name']);
    $last_name = esc($_POST['last_name']);
    $user = get_user_by_id($_SESSION['user']['user_id']);
    $user_id = $user['user_id'];

    $query = "UPDATE `user` SET `first_name` ='$first_name',`last_name` ='$last_name' WHERE `user_id` ='$user_id' ";

    $result = mysqli_query($conn,$query);


    // $query1 ="INSERT INTO `activity` (`id`, `title`, `body`, `published`, `created_at`, `user_id`)
    // VALUES (NULL, 'Profile updated', 'profile has been updated', '1', now(), '1')";
    // mysqli_query($conn, $query1);

    $_SESSION['message'] = "Profile updated succesfully";
    header('location:'.$_SERVER['PHP_SELF']);
    exit(0);
}

if(isset($_POST['create-ticket'])) {
    global $conn;
    $title = esc($_POST['title']);
    $type = esc($_POST['type']);
    $description = esc($_POST['description']);
    $date = esc($_POST['date']);
    $priority = esc($_POST['priority']);
    $info = esc($_POST['info']);

    $user = get_user_by_id($_SESSION['user']['user_id']);
    $user_id = $user['user_id'];

    $query = " INSERT INTO `ticket` (`ticket_id`, `ticket_type`, `ticket_title`, `ticket_description`, `ticket_image`, `ticket_status`, `ticket_priority`, `due_date`, `info`, `created_at`, `updated_at`, `user_id`)
                                     VALUES (NULL, '$type', '$title', '$description', NULL, 'issued', '$priority', '$date', '$info', now(),  now(), '$user_id') ";
      $result = mysqli_query($conn,$query);


      // $query1 ="INSERT INTO `activity` (`id`, `title`, `body`, `published`, `created_at`, `user_id`)
      // VALUES (NULL, 'Profile updated', 'profile has been updated', '1', now(), '1')";
      // mysqli_query($conn, $query1);
  
      $_SESSION['message'] = "SUCCESSFUL";
      header('location:'.$_SERVER['PHP_SELF']);
      exit(0);
  

}

function disp_my_tickets(){
    global $conn;
    $user = get_user_by_id($_SESSION['user']['user_id']);
    $user_id = $user['user_id'];
    $query = "SELECT * FROM `ticket` WHERE `user_id` ='$user_id' ORDER BY `updated_at` DESC ";

    $result = mysqli_query($conn,$query);
    $tickets = mysqli_fetch_all($result,MYSQLI_ASSOC);

    return $tickets;
}
?>