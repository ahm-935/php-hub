<?php 
require_once 'models/parcel.class.php'; 

if (isset($_POST['delete_id'])) {
    $tracking_id = $_POST['delete_id'];
    $res = Parcel::delete($tracking_id); 
    if ($res === true) {
        $msg = "Parcel item deleted successfully.";
    } else {
        $msg = "Error: " . $res;
    }
}

$parcels = Parcel::readAll();

?>

<div class="main-panel">
  <div class="content-wrapper">
    <div class="page-header">
      <h3 class="page-title"> Parcel Management </h3>
      <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="#">Home</a></li>
          <li class="breadcrumb-item active" aria-current="page">Parcel Management</li>
        </ol>
      </nav>
    </div>
    
    <div class="row">
      <div class="col-12 grid-margin stretch-card">
        <div class="card">
          <div class="card-body">
              
            <?php if (isset($msg)): ?>
              <div class="alert alert-dark alert-dismissible fade show" role="alert">
                <?php echo htmlspecialchars($msg); ?>
                <button type="button" class="btn-close" data-dismiss="alert" aria-label="Close">&times;</button>
              </div>
            <?php endif; ?>

            <p><a href="add-item"><button class="btn btn-primary">Add Item</button></a> </p>
            
            <div class="table-responsive">
              <table class="table table-striped table-bordered table-hover">
                <thead>
                  <tr>
                    <th> Tracking ID </th>
                    <th> Sender Name </th>
                    <th> Receiver Name </th>
                    <th> Destination </th>
                    <th> Parcel Type </th>
                    <th> Weight </th>
                    <th> Delivery Charge </th>
                    <th> Date </th>
                    <th> Action </th>
                  </tr>
                </thead>
                <tbody>
                  <?php if (empty($parcels)): ?>
                    <tr>
                      <td colspan="9" class="text-center">No parcels found.</td>
                    </tr>
                  <?php else: ?>
                    <?php foreach ($parcels as $item): ?>
                    <tr>
                      <td> <strong><?php echo htmlspecialchars($item['tracking_id']); ?></strong> </td>
                      <td> <?php echo htmlspecialchars($item['sender_name']); ?> </td>
                      <td> <?php echo htmlspecialchars($item['receiver_name']); ?> </td>
                      <td> <?php echo htmlspecialchars($item['destination']); ?> </td>
                      <td> <span class="text-muted"><?php echo htmlspecialchars($item['parcel_type'] ?? 'N/A'); ?></span> </td>
                      <td> <strong><?php echo htmlspecialchars($item['weight'] ?? 'N/A'); ?></strong> </td>
                      <td> ৳ <?php echo htmlspecialchars(number_format((float)$item['delivery_charge'], 2)); ?> </td>
                      <td> <?php echo htmlspecialchars($item['date']); ?> </td>
                      <td>
                        <div class="btn-group">
                          <button type="button" class="btn btn-sm btn-default" title="View"><i class="fa fa-eye text-primary"></i></button>
                          <a href="edit-parcel?id=<?= urlencode($item['tracking_id']); ?>" class="btn btn-sm btn-default" title="Edit"><i class="fa fa-edit text-success"></i></a>
                          
                          <form method="POST" style="display:inline;" onsubmit="return confirm('Are you sure you want to delete this parcel?');">
                            <input type="hidden" name="delete_id" value="<?= htmlspecialchars($item['tracking_id']) ?>">
                            <button type="submit" class="btn btn-sm btn-default" title="Delete"><i class="fa fa-trash text-danger"></i></button>
                          </form>
                        </div>
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