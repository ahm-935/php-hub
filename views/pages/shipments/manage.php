<?php 
require_once 'models/parcel.class.php'; 
require_once 'models/rider.class.php'; 

$msg = null;
$msg_type = "success";

// সাবমিট হ্যান্ডলার
if (isset($_POST['btn_assign'])) {
    $rider_id = $_POST['rider_id'];
    $selected_parcels = $_POST['parcels'] ?? []; // চেক করা পার্সেলগুলোর ট্র্যাকিং আইডি array

    if (empty($rider_id)) {
        $msg = "Please select a rider first!";
        $msg_type = "danger";
    } elseif (empty($selected_parcels)) {
        $msg = "Please select at least one parcel to assign!";
        $msg_type = "danger";
    } else {
        $error_count = 0;
        foreach ($selected_parcels as $tracking_id) {
            $res = Parcel::assignRider($tracking_id, $rider_id);
            if ($res !== true) {
                $error_count++;
            }
        }

        if ($error_count == 0) {
            $msg = "Parcels successfully assigned to the rider.";
            $msg_type = "success";
        } else {
            $msg = "Something went wrong! {$error_count} parcels failed to assign.";
            $msg_type = "danger";
        }
    }
}

// ড্রপডাউনের জন্য সকল রাইডার তুলে আনা
$riders = Rider::readAll();

// সকল পার্সেল তুলে আনা (আপনি চাইলে SQL পরিবর্তন করে শুধু rider_id IS NULL পার্সেলগুলোও দেখাতে পারেন)
$parcels = Parcel::readAll();
?>

<div class="main-panel">
  <div class="content-wrapper">
    <div class="page-header">
      <h3 class="page-title"> Shipment & Rider Assignment </h3>
    </div>
    
    <div class="row">
      <div class="col-12 grid-margin stretch-card">
        <div class="card">
          <div class="card-body">
              
            <?php if ($msg): ?>
              <div class="alert alert-<?= $msg_type ?> alert-dismissible fade show" role="alert">
                <?php echo htmlspecialchars($msg); ?>
                <button type="button" class="btn-close" data-dismiss="alert" aria-label="Close">&times;</button>
              </div>
            <?php endif; ?>

            <form method="POST">
              
              <div class="row align-items-end mb-4">
                <div class="col-md-6">
                  <div class="form-group mb-0">
                    <label class="font-weight-bold">Select Rider to Assign:</label>
                    <select class="form-control" name="rider_id" required>
                      <option value="">-- Choose Rider --</option>
                      <?php foreach ($riders as $rider): ?>
                          <option value="<?= $rider['id'] ?>"><?= htmlspecialchars($rider['name']) ?> (<?= htmlspecialchars($rider['phone'] ?? '') ?>)</option>
                      <?php endforeach; ?>
                    </select>
                  </div>
                </div>
                <div class="col-md-6">
                  <button type="submit" name="btn_assign" class="btn btn-success">Assign Selected Parcels</button>
                </div>
              </div>

              <div class="table-responsive">
                <table class="table table-striped table-bordered table-hover">
                  <thead>
                    <tr>
                      <th width="50" class="text-center">
                        <input type="checkbox" id="checkAll"> </th>
                      <th> Tracking ID </th>
                      <th> Sender </th>
                      <th> Receiver </th>
                      <th> Destination </th>
                      <th> Current Rider </th>
                      <th> Date </th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php if (empty($parcels)): ?>
                      <tr>
                        <td colspan="7" class="text-center">No parcels found.</td>
                      </tr>
                    <?php else: ?>
                      <?php foreach ($parcels as $item): ?>
                      <tr>
                        <td class="text-center">
                          <input type="checkbox" name="parcels[]" value="<?= htmlspecialchars($item['tracking_id']) ?>" class="parcel-checkbox">
                        </td>
                        <td> <strong><?php echo htmlspecialchars($item['tracking_id']); ?></strong> </td>
                        <td> <?php echo htmlspecialchars($item['sender_name']); ?> </td>
                        <td> <?php echo htmlspecialchars($item['receiver_name']); ?> </td>
                        <td> <?php echo htmlspecialchars($item['destination']); ?> </td>
                        <td> 
                          <?php if(!empty($item['rider_name'])): ?>
                            <span class="badge badge-success"><?= htmlspecialchars($item['rider_name']) ?></span>
                          <?php else: ?>
                            <span class="badge badge-warning">Not Assigned</span>
                          <?php endif; ?>
                        </td>
                        <td> <?php echo htmlspecialchars($item['date']); ?> </td>
                      </tr>
                      <?php endforeach; ?>
                    <?php endif; ?>
                  </tbody>
                </table>
              </div>
            </form>
            </div>
        </div>
      </div>
    </div>
  </div>
  <?php include('views/layouts/footer.php'); ?>
</div>

<script>
document.getElementById('checkAll').addEventListener('change', function() {
    let checkboxes = document.querySelectorAll('.parcel-checkbox');
    checkboxes.forEach(cb => cb.checked = this.checked);
});
</script>