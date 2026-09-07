<?php
require_once 'models/user.class.php'; // যদি ডাটাবেজ কানেকশন বা গ্লোবাল $db এই ফাইলে থাকে
require_once 'models/rider.class.php';

// ফর্ম সাবমিট হয়েছে কিনা চেক করা
if (isset($_POST['btn_submit'])) {
    $name           = $_POST['name'];
    $phone          = $_POST['phone'];
    $vehicle        = $_POST['vehicle'];
    $total_delivery = $_POST['total_delivery'];
    $status         = $_POST['status'];

    // Rider ক্লাসের অবজেক্ট তৈরি (id = null পাঠানো হয়েছে কারণ এটি অটো-ইনক্রিমেন্ট হবে)
    $rider = new Rider(null, $name, $phone, $vehicle, $total_delivery, $status);
    $res = $rider->create();
    
    if ($res === true) {
        $msg = "Rider added successfully.";
    } else {
        $msg = "Error: " . $res;
    }
}
?>
 
<div class="main-panel">
  <div class="content-wrapper">
    <div class="page-header">
      <h3 class="page-title"> Add New Rider </h3>
      <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="riders">Riders</a></li>
          <li class="breadcrumb-item active" aria-current="page">Add Rider</li>
        </ol>
      </nav>
    </div>
    
    <div class="row">
      <div class="col-12 grid-margin stretch-card">
        
        <div class="card">
          <div class="card-body">
            
            <?php if(isset($msg)): ?>
              <div class="alert alert-dark alert-dismissible fade show" role="alert">
                <?php echo $msg; ?>
                <button type="button" class="btn-close" data-dismiss="alert" aria-label="Close">&times;</button>
              </div>
            <?php endif; ?>

            <p class="card-description"> 
              <a href="riders"><button class="btn btn-dark">&larr; Back to List</button></a> 
            </p>
            
            <form class="forms-sample" method="POST">
              
              <div class="form-group">
                <label for="riderName">Rider Name</label>
                <input type="text" class="form-control" name="name" id="riderName" placeholder="Enter Rider Name" required>
              </div>
              
              <div class="form-group">
                <label for="riderPhone">Phone Number</label>
                <input type="text" class="form-control" name="phone" id="riderPhone" placeholder="Enter Phone Number" required>
              </div>
              
              <div class="form-group">
                <label for="vehicleType">Vehicle Type</label>
                <select class="form-control" name="vehicle" id="vehicleType" required>
                  <option value="Bike">Bike</option>
                  <option value="Cycle">Cycle</option>
                  <option value="Van">Van</option>
                  <option value="Truck">Truck</option>
                </select>
              </div>
              
              <div class="form-group">
                <label for="totalDelivery">Total Delivery</label>
                <input type="number" class="form-control" name="total_delivery" id="totalDelivery" placeholder="0" value="0" min="0">
              </div>
              
              <div class="form-group">
                <label for="riderStatus">Status</label>
                <select class="form-control" name="status" id="riderStatus">
                  <option value="Active">Active</option>
                  <option value="Inactive">Inactive</option>
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