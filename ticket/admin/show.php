<!-- Head Section -->
<?php include 'includes/head-layout.php' ;

if (isset($_GET['id'])) {
  $ticket = display_ticket($_GET['id']);

}else{
  echo "No ID Selected";
}

?>
<!-- Title of the Page -->
    <title>Show my tickets</title>
    
</head>
<body>
<?php include 'includes/navigation.php' ?>

  <div id="main">

   
  <div class="row">
    <div class="col-8">

    <div class="content">
       
    <p class="title">CRUD TICKET</p>

    <div class="btn-crud">
      <a href="show.php?approve=<?php echo $ticket['ticket_id']?>"><i class="fa fa-check"></i></a>
      <a href="show.php?assign=<?php echo $ticket['ticket_id']?>" ><i class="fa fa-user"></i></a>
      <a href="show.php?reject=<?php echo $ticket['ticket_id']?>" ><i class="fa fa-times"></i></a>
  
    </div>
     
    <div class="ticket-card">
          <p><span class="id"><?php echo $ticket['ticket_id'] ?></span> | <span class="title"><?php echo $ticket['ticket_title'] ?></span></p>
          <p class="body"><?php echo $ticket['ticket_description'] ?></p>
          <p class="body"><?php echo $ticket['first_name'].' '.$ticket['last_name']?></p>


          <?php if ($ticket['ticket_status'] == 'issued') { ?>
           <span class="status"><?php echo $ticket['ticket_status'] ?><p class="message"><i class="far fa-clock"> </i> <?php echo date("F j, Y ", strtotime($ticket["created_at"])); ?></p></span>

          <?php }else if ($ticket['ticket_status'] == 'approved') { ?>
            <span class="status" style="background-color: tomato;"><?php echo $ticket['ticket_status'] ?><p class="message"><i class="far fa-clock"> </i> <?php echo date("F j, Y ", strtotime($ticket["created_at"])); ?></p></span>

          <?php }else if ($ticket['ticket_status'] == 'assigned') { ?>
           <span class="status" style="background-color: lightgreen;" ><?php echo $ticket['ticket_status'] ?><p class="message"><i class="far fa-clock"> </i> <?php echo date("F j, Y ", strtotime($ticket["created_at"])); ?></p></span>
          <?php }else if ($ticket['ticket_status'] == 'solved'){ ?>
            <span class="status"  style="background-color: pink;" ><?php echo $ticket['ticket_status'] ?><p class="message"><i class="far fa-clock"> </i> <?php echo date("F j, Y ", strtotime($ticket["created_at"])); ?></p></span>
            <?php }else if ($ticket['ticket_status'] == 'reject'){ ?>
            <span class="status"  style="background-color: red;" ><?php echo $ticket['ticket_status'] ?><p class="message"><i class="far fa-clock"> </i> <?php echo date("F j, Y ", strtotime($ticket["created_at"])); ?></p></span>
         <?php  } ?>
        </div>

    </div>

  
    </div>

    <div class="col-3" >
      s
      </div>
  </div>


  </div>
</body>
</html>