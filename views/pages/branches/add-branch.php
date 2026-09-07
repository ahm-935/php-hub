<?php
require_once 'models/branch.class.php';

if (isset($_POST['btn_submit'])) {
    $branch_name  = $_POST['branch_name'];
    $manager_name = $_POST['manager_name'];
    $email        = $_POST['email'];
    $phone_number = $_POST['phone_number'];
    $location     = $_POST['location'];
    $status       = $_POST['status'];

    // অবজেক্ট তৈরি এবং প্যারামিটার পাঠানো
    $branch = new Branch(null, $branch_name, $manager_name, $email, $phone_number, $location, $status);
    $res = $branch->create();
    
    if ($res === true) {
        $msg = "Branch created successfully.";
    } else {
        $msg = "Error: " . $res;
    }
}
?>
 
<div class="main-panel">
  <div class="content-wrapper">
    <div class="page-header">
      <h3 class="page-title"> Add New Branch </h3>
    </div>
    <div class="row">
      <div class="col-12 grid-margin stretch-card">
        <?php if(isset($msg)): ?>
            <div class="alert alert-dark"><?= $msg ?></div>
        <?php endif; ?>
        
        <div class="card">
          <div class="card-body">
            <p class="card-description"> <a href="branches"><button class="btn btn-dark">&larr; Back to List</button></a> </p>
            
            <form class="forms-sample" method="POST">
              <div class="form-group">
                <label>Branch Name</label>
                <input type="text" class="form-control" name="branch_name" placeholder="Enter Branch Name" required>
              </div>
              <div class="form-group">
                <label>Manager Name</label>
                <input type="text" class="form-control" name="manager_name" placeholder="Enter Manager Name" required>
              </div>
              <div class="form-group">
                <label>Email address</label>
                <input type="email" class="form-control" name="email" placeholder="Enter Email" required>
              </div>
              <div class="form-group">
                <label>Phone Number</label>
                <input type="text" class="form-control" name="phone_number" placeholder="Enter Phone Number" required>
              </div>
              <div class="form-group">
                <label>Location</label>
                <input type="text" class="form-control" name="location" placeholder="Enter Location" required>
              </div>
              <div class="form-group">
                <label>Status</label>
                <select class="form-control" name="status">
                  <option value="Pending">Pending</option>
                  <option value="Operating">Operating</option>
                  <option value="Closed">Closed</option>
                </select>
              </div>

              <button type="submit" name="btn_submit" class="btn btn-success mr-2">Submit</button>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
  <?php include('views/layouts/footer.php'); ?>
</div>