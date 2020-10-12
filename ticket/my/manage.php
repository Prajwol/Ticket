<!-- Head Section -->
<?php include 'includes/head-layout.php' ?>
<!-- Title of the Page -->
    <title>Show my tickets</title>
    <style>

* {
  box-sizing: border-box;
}
/* div.sticky{
  margin: 0;
  padding: 0;
  width: 100%;
  height: auto;
  position:sticky;
  top:35px;
  background: grey;

} */
form.find-ticket {
  width: 100%;
  height: auto;
  /* box-shadow: 0 2px 4px 0 rgba(0, 0, 0, 0.2); */

}
form.ticket .input-container {
  display: -ms-flexbox; /* IE10 */
  display: flex;
  width: 100%;
  margin-bottom: 15px;
  float: left;
}
form.ticket .input-field {
  width: 100%;
  padding: 10px;
  outline: none;
}
form .ticket input[type=text] {
  margin: 0;
  padding: 10px;
  font-size: 14px;
  border: 0.5px solid grey;
  float: left;
  width: 80%;
}

form.find-ticket input[type=text] {
  margin: 0;
  padding: 10px;
  font-size: 14px;
  border: 0.5px solid grey;
  float: left;
  width: 80%;
}
form.find-ticket input[type=text]:focus {
  border: 1px solid dodgerblue;
}

form.find-ticket .btn {
  float: left;
  width: 20%;
  margin: 0;
  padding: 10px;
  font-size: 14px;
  background-color:  #DC143C;
  color: white;
  border: 0.5px solid  #DC143C;
  cursor: pointer;
}

form.find-ticket .btn:hover {
  background: #0b7dda;
}

form.find-ticket::after {
  content: "";
  clear: both;
  display: table;
}

</style>
</head>
<body>
<?php include 'includes/navigation.php' ?>

  <div id="main">

   
  <div class="row">
    <div class="col-8">

    <div class="content">
       
    <form method="post" action="manage.php" class="ticket" enctype="multipart/form-data" >


    <?php if (!empty($_SESSION['message'])){ ?>
        <p> <?PHP
          if(isset($_SESSION['message'])){
          echo $_SESSION['message'];
          unset($_SESSION['message']);
              }
      ?></p>
  <?php }else{}	?>

   <p><div><?php include('../includes/errors.php') ?></div></p>


  <!-- <h3>Image: </h3>
  <span style="color:indianred">*Screenshot.</span>

  <div class="input-container" >
  <input type="file"  style="border: 1px solid #ccc;display: inline-block;padding: 6px 12px;cursor: pointer;"  name="featured_image"  value=""  accept="image/*" onchange="loadFile(ticket)" multiple></br>
    </div> -->


  <h3>Top details : </h3>
  <span style="color:indianred">Meaningful title of your issue.</span>
  <div class="input-container">
    <input class="input-field" type="text" style="width:100%;" placeholder="Ticket Title*" title ="ticket Title"  name="title">

  </div></br>

  <div class="input-container">
  <select class="input-field" style="width:100%; border-radius:0; outline: none; border:0.5px solid #ccc; padding: 10px;font-size: 14px;" id="country" name="type">
      <option value="australia">Choose Category</option>
      <option value="system">System</option>
      <option value="other">Other</option>
    </select>  </div>



  <h3>About: </h3>
  <span style="color:indianred">*Brief description about your ticket.</span>

  <div class="input-container" >
    <textarea name="description" id="mytextarea"style="height:500px; z-index:1; width:100%;" ></textarea>
    </div>



  <h3>Date & Time : </h3>
   <span style="color:indianred">Date format: DD/MM/YYYY and Time format: 01:20:am/pm</span>

</br>Due Date:
  <div class="input-container">
    <input class="input-field" type="date" style="width:100%;" placeholder="Sub Title" name="date">

  </div>
  <br>

  
 

  <span style="color:indianred">*Please visit our help portal about the priority.</span>

  <div class="input-container">
  <select class="input-field" style="width:100%; border-radius:0; outline: none; border:0.5px solid #ccc; padding: 10px;font-size: 14px;" id="country" name="priority">
      <option value="australia">Priority - based on guide</option>
      <option value="low">Low</option>
      <option value="medium">Medium</option>
      <option value="high">High</option>
    </select>  </div>

  <h3>Further Info : </h3>
  <span style="color:indianred">Optional, howerver if you want to include extra information about your ticket please enter below.</span>


  <div class="input-container">
    <input class="input-field" type="text" style="width:100%; " placeholder="+ Note" name="info">
  </div>



  <input type="submit" value="Create Ticket" name="create-ticket" class="btn">Create an ticket</input>
</form>


    </div>

  
    </div>

    <div class="col-3" >

    <div class="info">
    <p class="title"> Standarad </p>
    
    </div>

    
      </div>
  </div>


  </div>
</body>
</html>