<?php
require_once 'models/parcel.class.php';

$msg = null;
$msg_type = "success";


if (isset($_POST['update_status_trigger'])) {
  $tracking_id = $_POST['tracking_id'];
  $new_status  = $_POST['status'];

  $res = Parcel::updateStatus($tracking_id, $new_status);
  if ($res === true) {
    $msg = "Status updated successfully for Tracking ID: " . $tracking_id;
    $msg_type = "success";
  } else {
    $msg = "Error updating status: " . $res;
    $msg_type = "danger";
  }
}


$rider_items = Parcel::readRiderItems();
?>

<div class="main-panel">
  <div class="content-wrapper">
    <div class="page-header">
      <h3 class="page-title"> Rider Items Management </h3>
      <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
          <li class="breadcrumb-item active" aria-current="page">Rider Items</li>
        </ol>
      </nav>
    </div>

    <div class="row">
      <div class="col-12 grid-margin stretch-card">
        <div class="card">
          <div class="card-body">
            <h4 class="card-title mb-4">Assigned Parcels To Riders</h4>

            <?php if ($msg): ?>
              <div class="alert alert-<?= $msg_type ?> alert-dismissible fade show" role="alert">
                <?php echo htmlspecialchars($msg); ?>
                <button type="button" class="btn-close" data-dismiss="alert" aria-label="Close">&times;</button>
              </div>
            <?php endif; ?>

            <div class="table-responsive">
              <table class="table table-striped table-bordered table-hover">
                <thead>
                  <tr>
                    <th> Tracking ID </th>
                    <th> Sender Name </th>
                    <th> Receiver Name </th>
                    <th> Assigned Rider </th>
                    <th> Rider Phone </th>
                    <th width="150"> Status </th>
                    <th> Updated At </th>
                  </tr>
                </thead>
                <tbody>
                  <?php if (empty($rider_items)): ?>
                    <tr>
                      <td colspan="7" class="text-center">No parcels assigned to riders found.</td>
                    </tr>
                  <?php else: ?>
                    <?php foreach ($rider_items as $item): ?>
                      <tr>
                        <td> <strong><?php echo htmlspecialchars($item['tracking_id']); ?></strong> </td>
                        <td> <?php echo htmlspecialchars($item['sender_name']); ?> </td>
                        <td> <?php echo htmlspecialchars($item['receiver_name']); ?> </td>
                        <td>
                          <?php if (!empty($item['rider_name'])): ?>
                            <strong><?php echo htmlspecialchars($item['rider_name']); ?></strong>
                          <?php else: ?>
                            <span class="text-muted">Not Assigned</span>
                          <?php endif; ?>
                        </td>
                        <td> <?php echo htmlspecialchars($item['rider_phone'] ?? 'N/A'); ?> </td>
                        <td>
                         
                          <form method="POST" style="margin:0; padding:0;">
                            <input type="hidden" name="tracking_id" value="<?= htmlspecialchars($item['tracking_id']) ?>">
                            <input type="hidden" name="update_status_trigger" value="1">

                            <select name="status" class="form-control form-control-sm text-dark font-weight-bold"
                              style="background-color: #fff3cd; border: 1px solid #ffeba2;"
                              onchange="this.form.submit()">
                              <option value="Pending" <?= ($item['status'] ?? '') == 'Pending' ? 'selected' : '' ?>>Pending</option>
                              <option value="Shipped" <?= ($item['status'] ?? '') == 'Shipped' ? 'selected' : '' ?>>Shipped</option>
                              <option value="In Transit" <?= ($item['status'] ?? '') == 'In Transit' ? 'selected' : '' ?>>In Transit</option>
                              <option value="Delivered" <?= ($item['status'] ?? '') == 'Delivered' ? 'selected' : '' ?>>Delivered</option>
                              <option value="Returned" <?= ($item['status'] ?? '') == 'Returned' ? 'selected' : '' ?>>Returned</option>
                            </select>
                          </form>
                        </td>
                        <td>
                          <?php
                          if (!empty($item['updated_at']) && $item['updated_at'] !== '0000-00-00 00:00:00') {
                            
                            echo htmlspecialchars(date('Y-m-d h:i A', strtotime($item['updated_at'])));
                          } else {
                           
                            echo htmlspecialchars($item['date']);
                          }
                          ?>
                        </td>
                      </tr>
                    <?php endforeach; ?>
                  <?php endif; ?>
                </tbody>
              </table>
            </div>

          </div>
        </div>
      </div>
    </div>
  </div>
  <?php include('views/layouts/footer.php'); ?>
</div>