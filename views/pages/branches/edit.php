<?php
require_once 'models/branch.class.php';

if(isset($_POST['btn_submit'])){
    $id           = $_POST['id'];
    $branch_name  = $_POST['branch_name'];
    $manager_name = $_POST['manager_name'];
    $email        = $_POST['email'];
    $phone_number = $_POST['phone_number'];
    $location     = $_POST['location'];
    $status       = $_POST['status'];
  
   
    $branch = new Branch($id, $branch_name, $manager_name, $email, $phone_number, $location, $status);
    $res    = $branch->update();  
    
    if($res === true){
        $msg = "Branch updated successfully";
    }else{
        $msg = "Error: " . $res;
    }
}

if(isset($_GET['id'])){
    $row = Branch::readById($_GET['id']);  
    if(!$row){
        $not_found = true; 
    }
} else {
 
    echo "<script>window.location='branches';</script>";
    exit;
}
?>

<div class="main-panel">
  <div class="content-wrapper">
    <div class="page-header">
      <h3 class="page-title"> Update Branch Details </h3>
    </div>
    
    <div class="row">
      <div class="col-12 grid-margin stretch-card">
        
       
        <?php if(isset($msg)): ?>
            <div class="alert alert-dark alert-dismissible fade show" role="alert">
                <?= $msg ?>
                <button type="button" class="btn-close" data-dismiss="alert" aria-label="Close">&times;</button>
            </div>
        <?php endif; ?>
         
        <div class="card">
          <div class="card-body">
            
            <?php if(isset($not_found)): ?>
                <h5 class="text-danger">Data not found or invalid Branch ID.</h5>
                <p><a href="branches" class="btn btn-dark">&larr; Back to List</a></p>
            <?php else: ?>
                
                <p class="card-description"> 
                  <a href="branches"><button class="btn btn-dark">&larr; Back to List</button></a> 
                </p>
              
                <form class="forms-sample" method="POST">
                  
                
                  <input type="hidden" name="id" value="<?= $row['id']; ?>">
                  
                  <div class="form-group">
                    <label>Branch Name</label>
                    <input type="text" class="form-control" name="branch_name" value="<?= htmlspecialchars($row['branch_name']); ?>" required>
                  </div>
                  
                  <div class="form-group">
                    <label>Manager Name</label>
                    <input type="text" class="form-control" name="manager_name" value="<?= htmlspecialchars($row['manager_name']); ?>" required>
                  </div>
                  
                  <div class="form-group">
                    <label>Email address</label>
                    <input type="email" class="form-control" name="email" value="<?= htmlspecialchars($row['email']); ?>" required>
                  </div>
                  
                  <div class="form-group">
                    <label>Phone Number</label>
                    <input type="text" class="form-control" name="phone_number" value="<?= htmlspecialchars($row['phone_number']); ?>" required>
                  </div>
                  
                  <div class="form-group">
                    <label>Location</label>
                    <input type="text" class="form-control" name="location" value="<?= htmlspecialchars($row['location']); ?>" required>
                  </div>
                  
                  <div class="form-group">
                    <label>Status</label>
                    <select class="form-control" name="status" required>
                      <option value="Pending" <?= $row['status'] == 'Pending' ? 'selected' : ''; ?>>Pending</option>
                      <option value="Operating" <?= $row['status'] == 'Operating' ? 'selected' : ''; ?>>Operating</option>
                      <option value="Closed" <?= $row['status'] == 'Closed' ? 'selected' : ''; ?>>Closed</option>
                    </select>
                  </div>
                  
                  <button type="submit" name="btn_submit" class="btn btn-success mr-2">Update</button>
                  <a href="branches" class="btn btn-light">Cancel</a>
                </form>
                
            <?php endif; ?>
            
          </div>
        </div>
      </div>
    </div>
  </div>
  <?php include('views/layouts/footer.php'); ?>
</div>