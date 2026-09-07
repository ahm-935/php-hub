<?php
if (isset($_GET['page'])) {
    $page = $_GET['page'];

    if(isset($_SESSION['id']) == false ){
        include_once 'views/pages/auth/login.php';
    }
     elseif ($page == 'dashboard') {
        include_once('views/pages/dashboard.php');
    }
     elseif ($page == 'login') {
        include_once('views/pages/auth/login.php');
    }
     elseif ($page == 'register') {
        include_once('views/pages/auth/register.php');
    }
     elseif ($page == 'users') {
        include_once('views/pages/users/manage.php');
    }
    elseif ($page == 'create-user') {
       include_once('views/pages/users/add-user.php');
   }
    elseif ($page == 'edit-user') {
       include_once('views/pages/users/edit-user.php');
   }
     elseif ($page == 'form' || $page == 'form.php') {
        include_once('views/pages/form.php');
    }
     elseif ($page == 'parcels' || $page == 'parcels.php') {
        include_once('views/pages/parcels/manage.php');
    }
     elseif ($page == 'add-item') {
        include_once('views/pages/parcels/add-parcel.php');
    }
     elseif ($page == 'riders' || $page == 'rider.php') {
        include_once('views/pages/riders/manage.php');
    }
     elseif ($page == 'add-rider') {
        include_once('views/pages/riders/add-rider.php');
    }
     elseif ($page == 'rider-items') {
        include_once('views/pages/r-items/manage.php');
    }
     elseif ($page == 'branches' || $page == 'branches.php') {
        include_once('views/pages/branches/manage.php');
    }
     elseif ($page == 'edit-branch') {
        include_once('views/pages/branches/edit.php');  
    }
     elseif ($page == 'add-branch') {
        include_once('views/pages/branches/add-branch.php');  
    }
     elseif ($page == 'shipments' || $page == 'shipments.php') {
        include_once('views/pages/shipments/manage.php');
    }
     elseif ($page == 'access-deny' || $page == '404') {
        include_once('views/pages/access-deny.php');
    }
     else {
        include_once('views/pages/dashboard.php');
    }
}
else {
    include_once('views/pages/auth/login.php');
}
      
?>