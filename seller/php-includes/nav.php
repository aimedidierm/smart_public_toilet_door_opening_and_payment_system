<?php
$query = "SELECT * FROM seller WHERE email= ? limit 1";
$stmt = $db->prepare($query);
$stmt->execute(array($_SESSION['email']));
$rows = $stmt->fetch(PDO::FETCH_ASSOC);
if ($stmt->rowCount()>0) {
    $names=$rows['names'];
    $email=$rows['email'];
}
?>
<!--Start sidebar-wrapper-->
<div id="sidebar-wrapper" data-simplebar="" data-simplebar-auto-hide="true">
     <div class="brand-logo">
      <a href="index.html">
       <h5 class="logo-text">Smart toilette | Seller</h5>
     </a>
   </div>
   <ul class="sidebar-menu do-nicescrol">
      <li class="sidebar-header">MAIN NAVIGATION</li>
      <li>
        <a href="dashboard.php">
          <i class="zmdi zmdi-view-dashboard"></i> <span>Dashboard</span>
        </a>
      </li>
      <li>
        <a href="withdraw.php">
          <i class="zmdi zmdi-card"></i> <span>Withdraw</span>
        </a>
      </li>
      <li>
        <a href="history.php">
          <i class="icon-grid mr-2"></i> <span>Transactions</span>
        </a>
      </li>
      <li>
        <a href="reported.php">
        <i class="icon-grid mr-2"></i> <span>Reported</span>
        </a>
      </li>
      <li>
        <a href="account.php">
        <i class="icon-settings mr-2"></i> <span>Settings</span>
        </a>
      </li>
      <li>
      <a href="../php-includes/logout.php">
        <i class="icon-power mr-2"></i> <span>Logout</span>
        </a>
      </li>
    </ul>
   
   </div>
   <!--End sidebar-wrapper-->

<!--Start topbar header-->
<header class="topbar-nav">
 <nav class="navbar navbar-expand fixed-top">
  <ul class="navbar-nav mr-auto align-items-center">
    <li class="nav-item">
      <a class="nav-link toggle-menu" href="javascript:void();">
       <i class="icon-menu menu-icon"></i>
     </a>
    </li>
  </ul>
     
  <ul class="navbar-nav align-items-center right-nav-link">
    <li class="nav-item">
      <a class="nav-link dropdown-toggle dropdown-toggle-nocaret" data-toggle="dropdown" href="#">
        <span class="user-profile"><img src="../assets/images/user.jpg" class="img-circle" alt="user avatar"></span>
      </a>
      <ul class="dropdown-menu dropdown-menu-right">
       <li class="dropdown-item user-details">
        <a href="javaScript:void();">
           <div class="media">
             <div class="avatar"><img class="align-self-start mr-3" src="../assets/images/user.jpg" alt="user avatar"></div>
            <div class="media-body">
            <h6 class="mt-2 user-title"><?php echo $names;?></h6>
            <p class="user-subtitle"><?php echo $email;?></p>
            </div>
           </div>
          </a>
        </li>
        <a href="account.php"><li class="dropdown-item"><i class="icon-settings mr-2"></i> Setting</li></a>
        <li class="dropdown-divider"></li>
        <a href="../php-includes/logout.php"><li class="dropdown-item"><i class="icon-power mr-2"></i> Logout</li></a>
      </ul>
    </li>
  </ul>
</nav>
</header>
<!--End topbar header-->