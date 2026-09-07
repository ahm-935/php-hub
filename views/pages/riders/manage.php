<?php 
include 'models/rider.class.php'; 


if(isset($_POST['delete_id'])){
  $id = $_POST['delete_id'];
  $res = Rider::delete($id);
  if($res === true){
    $msg = "Rider deleted successfully";
  }else{
    $msg = "Error: " . $res;
  }
}


$riders = Rider::readAll();
?>

<div class="main-panel">
  <div class="content-wrapper">
    <div class="page-header">
      <h3 class="page-title"> All Riders </h3>
      <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="#">Forms</a></li>
          <li class="breadcrumb-item active" aria-current="page">Form elements</li>
        </ol>
      </nav>
    </div>
    
    <div class="row">
      <div class="col-12 grid-margin stretch-card">
         
         <?php if(isset($msg)): ?>
          <div class="alert alert-dark alert-dismissible fade show" role="alert">
            <?php echo $msg; ?>
            <button type="button" class="btn-close" data-dismiss="alert" aria-label="Close">&times;</button>
          </div>
          <?php endif; ?>
          
        <div class="card">
          <div class="card-body">
            <p><a href="add-rider"><button class="btn btn-primary">Add Rider</button></a> </p>
            
            <div class="table-responsive">
              <table class="table table-striped table-bordered table-hover">
                <thead>
                  <tr>
                    <th> ID </th>
                    <th> Rider Name </th>
                    <th> Phone </th>
                    <th> Vehicle </th>
                    <th> Total Delivery </th>
                    <th> Status </th>
                    <th> Action </th>
                  </tr>
                </thead>
                <tbody>
                  <?php if(empty($riders)): ?>
                    <tr>
                      <td colspan="6" class="text-center">No riders found.</td>
                    </tr>
                  <?php else: ?>
                    <?php foreach($riders as $item): ?>
                    <tr>
                      <td> <?php echo htmlspecialchars($item['id']); ?> </td>
                      <td> <?php echo htmlspecialchars($item['name']); ?> </td>
                      <td> <?php echo htmlspecialchars($item['phone']); ?> </td>
                      <td> <?php echo htmlspecialchars($item['vehicle']); ?> </td>
                      <td> <?php echo htmlspecialchars($item['total_delivery']); ?> </td>
                      <td> 
                        <span class="badge <?php echo $item['status'] == 'Active' ? 'badge-success' : 'badge-danger'; ?>">
                          <?php echo htmlspecialchars($item['status']); ?> 
                        </span>
                      </td>
                      <td>
                        <div class="btn-group">
                          <button type="button" class="btn btn-sm btn-default"><i class="fa fa-eye text-primary"></i></button>
                          <a href="edit-rider?id=<?= $item['id']; ?>" class="btn btn-sm btn-default"><i class="fa fa-edit text-success"></i></a>
                          
                          <form method="POST" style="display:inline;" onsubmit="return confirm('Are you sure you want to delete this rider?');">
                            <input type="hidden" name="delete_id" value="<?= $item['id'] ?>">
                            <button type="submit" class="btn btn-sm btn-default"><i class="fa fa-trash text-danger"></i></button>
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