<!-- Head Section -->
<?php include 'includes/head-layout.php' ?>
<!-- Title of the Page -->
    <title>Profile</title>
    
</head>
<body>
<?php include 'includes/navigation.php' ?>

  <div id="main">

   
  <div class="row">
    <!-- <div class="col-3">

    <div class="content">
       
    <p class="title">My Tickets</p>
     
        <div class="ticket-card">
          <p><span class="id">873786</span> | <span class="title">System browdown</span></p>
          <p class="body">Lorem ipusm aru k k k k</p>
          <span class="status"><p class="message">PENDING</p></span>
        </div>

    </div>

  
    </div> -->

    <div class="col-11" >


    <form action="profile.php" method="POST">


    <?php if (!empty($_SESSION['message'])){ ?>
        <p> <?PHP
          if(isset($_SESSION['message'])){
          echo $_SESSION['message'];
          unset($_SESSION['message']);
              }
      ?></p>
  <?php }else{}	?>

        <p><div><?php include('../includes/errors.php') ?></div></p>


  <h2> Edit Profile</h2>
    <label>First Name</label>
    <input type="text"  name="first_name" value="<?php echo $user['first_name'] ?>"required>
    <p>*required field</p>
 

    <label>Last Name</label>
    <input type="text"  name="last_name" value="<?php echo $user['last_name'] ?>" required>
    <p>*required field</p>






    

    <input type="submit"  class="btn" name="update-profile"  value="Update profile">


</form>

      </div>
  </div>


  </div>
</body>
</html>