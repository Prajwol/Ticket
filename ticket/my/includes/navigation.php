<div class="mp-topnav">
    <a href=""> <i class="fa fa-sign-out-alt"></i></a>
    <a href="<?php echo BASE_URL.'my/profile.php' ?>" ><i class="far fa-user"></i></a>
    <a href="<?php echo BASE_URL.'my/manage.php' ?>" ><i class="far fa-plus-square"></i></a>

    <a  style="cursor:pointer;float:left;" onclick="openNav()">&#9776; </a>
</div>

<div id="mySidenav" class="mp-sidenav">
  <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
  <div class="gap" style="height: 100px;width:100%;">
  <h2 style="padding: 10px; color:white;">My Portal</h2>

  </div>
  <a href="<?php echo BASE_URL.'my/dashboard.php' ?>"><i class="fa fa-home"></i> Dashboard</a>

  <a href="#"><i class="far fa-user"></i> My Profile</a>

</div>

<script>
function openNav() {
  document.getElementById("mySidenav").style.width = "250px";
  document.getElementById("main").style.marginLeft = "250px";
}

function closeNav() {
  document.getElementById("mySidenav").style.width = "0";
  document.getElementById("main").style.marginLeft= "1%";
}
</script>