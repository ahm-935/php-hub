<?php
if(isset($_POST['logout'])) {
  // echo "logout";
  session_destroy();
  header("Location: login");
}
?>
<nav class="sidebar sidebar-offcanvas" id="sidebar">
  <ul class="nav">
    <li class="nav-item nav-category"><b>Dashboard</b></li>
    <li class="nav-item">
      <a class="nav-link" href="dashboard.php">
        <span class="icon-bg"><i class="mdi mdi-home menu-icon"></i></span>
        <span class="menu-title">Dashboard</span>
      </a>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="parcels">
        <span class="icon-bg"><i class="mdi mdi-format-list-bulleted menu-icon"></i></span>
        <span class="menu-title">Parcels</span>
      </a>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="branches">
        <span class="icon-bg"><i class="mdi mdi-table-large menu-icon"></i></span>
        <span class="menu-title">Branches</span>
      </a>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="riders">
        <span class="icon-bg"><i class="mdi mdi-chart-bar menu-icon"></i></span>
        <span class="menu-title">Riders</span>
      </a>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="rider-items">
        <span class="icon-bg"><i class="mdi mdi-format-list-bulleted menu-icon"></i></span>
        <span class="menu-title">Rider Items</span>
      </a>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="shipments">
        <span class="icon-bg"><i class="mdi mdi-crosshairs-gps menu-icon"></i></span>
        <span class="menu-title">Shipments</span>
      </a>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="users">
        <span class="icon-bg"><i class="mdi mdi-contacts menu-icon"></i></span>
        <span class="menu-title">Users</span>
      </a>
    </li>
   <?php if($_SESSION['role_id'] != 2 ) : ?>
    <li class="nav-item">
      <a class="nav-link" data-toggle="collapse" href="#auth" aria-expanded="false" aria-controls="auth">
        <span class="icon-bg"><i class="mdi mdi-lock menu-icon"></i></span>
        <span class="menu-title">Admin Pages</span>
        <i class="menu-arrow"></i>
      </a>
      <div class="collapse" id="auth">
        <ul class="nav flex-column sub-menu">
          <li class="nav-item"> <a class="nav-link" href="../../pages/samples/blank-page.html"> Blank Page </a></li>
          <li class="nav-item"> <a class="nav-link" href="login"> Login </a></li>
          <li class="nav-item"> <a class="nav-link" href="register"> Register </a></li>
          <li class="nav-item"> <a class="nav-link" href="../../pages/samples/error-404.html"> 404 </a></li>
          <li class="nav-item"> <a class="nav-link" href="../../pages/samples/error-500.html"> 500 </a></li>
        </ul>
      </div>
    </li>
    <?php endif; ?>
    <li class="nav-item documentation-link">
      <a class="nav-link"
        href="http://www.bootstrapdash.com/demo/connect-plus-free/jquery/documentation/documentation.html"
        target="_blank">
        <span class="icon-bg">
          <i class="mdi mdi-file-document-box menu-icon"></i>
        </span>
        <span class="menu-title">Documentation</span>
      </a>
    </li>
    <li class="nav-item sidebar-user-actions">
      <div class="user-details">
        <div class="d-flex justify-content-between align-items-center">
          <div>
            <div class="d-flex align-items-center">
              <div class="sidebar-profile-img">
                <img src="assets/images/faces/arif.png" alt="image">
              </div>
              <div class="sidebar-profile-text">
                <p class="mb-1">A H Munna</p>
              </div>
            </div>
          </div>
          <div class="badge badge-danger">3</div>
        </div>
      </div>
    </li>
    <li class="nav-item sidebar-user-actions">
      <div class="sidebar-user-menu">
        <a href="#" class="nav-link"><i class="mdi mdi-settings menu-icon"></i>
          <span class="menu-title">Settings</span>
        </a>
      </div>
    </li>
    <li class="nav-item sidebar-user-actions">
      <div class="sidebar-user-menu">
        <a href="#" class="nav-link"><i class="mdi mdi-speedometer menu-icon"></i>
          <span class="menu-title">Take Tour</span></a>
      </div>
    </li>
    <li class="nav-item sidebar-user-actions">
      <div class="sidebar-user-menu">
        <form method="POST" action="">
        <button type="submit" name="logout" class="btn nav-link"><i class="mdi mdi-logout menu-icon"></i>
          <span class="menu-title">Log Out</span></button>
        </form>
      </div> 
    </li>
  </ul>  
</nav>