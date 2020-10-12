<!-- Head Section -->
<?php include 'includes/head-layout.php' ?>

<!-- Title of the Page -->
    <title>Automated Ticket Management | Arif Systems</title>
    
</head>
<body>
<?php include 'includes/navigation.php' ?>

  <div id="main">

   
  <div class="row">
    <div class="col-8">

    <div class="content">
       
    <p class="title">My Tickets</p>
     <?php foreach($tickets as $ticket):?>
        <div class="ticket-card">
          <p><span class="id"><?php echo $ticket['ticket_id'] ?></span> | <span class="title"><?php echo $ticket['ticket_title'] ?></span></p>
          <p class="body"><?php echo $ticket['ticket_description'] ?></p>

          <?php if ($ticket['ticket_status'] == 'issued') { ?>
           <span class="status"><?php echo $ticket['ticket_status'] ?><p class="message"><i class="far fa-clock"> </i> <?php echo date("F j, Y ", strtotime($ticket["created_at"])); ?></p></span>

          <?php }else if ($ticket['ticket_status'] == 'approved') { ?>
            <span class="status" style="background-color: tomato;"><?php echo $ticket['ticket_status'] ?><p class="message"><i class="far fa-clock"> </i> <?php echo date("F j, Y ", strtotime($ticket["created_at"])); ?></p></span>

          <?php }else if ($ticket['ticket_status'] == 'in-progress') { ?>
           <span class="status" style="background-color: lightgreen;" ><?php echo $ticket['ticket_status'] ?><p class="message"><i class="far fa-clock"> </i> <?php echo date("F j, Y ", strtotime($ticket["created_at"])); ?></p></span>
          <?php }else if ($ticket['ticket_status'] == 'solved'){ ?>
            <span class="status"  style="background-color: pink;" ><?php echo $ticket['ticket_status'] ?><p class="message"><i class="far fa-clock"> </i> <?php echo date("F j, Y ", strtotime($ticket["created_at"])); ?></p></span>
            <?php }else if ($ticket['ticket_status'] == 'reject'){ ?>
            <span class="status"  style="background-color: red;" ><?php echo $ticket['ticket_status'] ?><p class="message"><i class="far fa-clock"> </i> <?php echo date("F j, Y ", strtotime($ticket["created_at"])); ?></p></span>
         <?php  } ?>
        </div>

        <?php endforeach ?>

    </div>

  
    </div>

    <div class="col-3" >
      
      </div>
  </div>


  </div>
</body>
</html>