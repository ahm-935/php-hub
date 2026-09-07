<?php
session_start();
ob_start();
print_r($_SESSION);
include_once 'config/base.php';
include_once 'config/db.php';

// echo password_hash('0000', PASSWORD_DEFAULT);

?>
<?php include('views/layouts/head.php'); ?>
    <div class="container-scroller">
      <!-- partial:partials/_navbar.html -->
     <?php include('views/layouts/nav.php'); ?>
      <!-- partial -->
      <div class="container-fluid page-body-wrapper">
        <!-- partial:partials/_sidebar.html -->
        <?php include('views/layouts/sidebar.php'); ?>
        <!-- partial -->
       <?php include('route.php'); ?>
        <!-- main-panel ends -->
      </div>
      <!-- page-body-wrapper ends -->
    </div>
    <!-- container-scroller -->
   <?php include('views/layouts/foot.php'); ?>