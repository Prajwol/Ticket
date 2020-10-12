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

    <?php if (!empty($_SESSION['message'])){ ?>
        <p> <?PHP
          if(isset($_SESSION['message'])){
          echo $_SESSION['message'];
          unset($_SESSION['message']);
              }
      ?></p>
  <?php }else{}	?>

        <p><div><?php include('../includes/errors.php') ?></div></p>


       
    <p class="title">Tickets</p>
     <?php foreach($tickets as $ticket):?>
      <a href="show.php?id=<?php echo $ticket['ticket_id']; ?> ">      


        <div 
        class="ticket-card"
        <?php if ($ticket['ticket_priority'] == 'medium') { ?> style="background-color: lightblue;" <?php  } elseif ($ticket['ticket_priority'] == 'high') { ?>  style="background-color: tomato;"  <?php }else{ } ?>
        
        >
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


        </a>
        <?php endforeach ?>

    </div>

  
    </div>

    <div class="col-3" >
      
      </div>
  </div>


  </div>
</body>
</html>