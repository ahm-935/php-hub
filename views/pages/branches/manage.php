<?php 
include 'models/branch.class.php'; 

if(isset($_POST['delete_id'])){
  $id = $_POST['delete_id'];
  $res = Branch::delete($id);
  if($res === true){
    $msg = "Branch deleted successfully";
  }else{
    $msg = "Error: " . $res;
  }
}


$branches = Branch::readAll();
?>

<div class="main-panel">
  <div class="content-wrapper">
    <div class="page-header">
      <h3 class="page-title"> All Branches </h3>
      <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="#">Home</a></li>
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
            <p><a href="add-branch"><button class="btn btn-primary">Add New Branch</button></a> </p>
            
            <div class="table-responsive">
              <table class="table table-striped table-bordered table-hover">
                <thead>
                  <tr>
                    <th> Branch Name </th>
                    <th> Manager Name </th>
                    <th> Email </th>
                    <th> Phone Number </th>
                    <th> Location </th>
                    <th> Status </th>
                    <th> Action </th>
                  </tr>
                </thead>
                <tbody>
                  <?php if(empty($branches)): ?>
                    <tr>
                      <td colspan="7" class="text-center">No branches found.</td>
                    </tr>
                  <?php else: ?>
                    <?php foreach($branches as $item): ?>
                    <tr>
                      <td> <?php echo htmlspecialchars($item['branch_name']); ?> </td>
                      <td> <?php echo htmlspecialchars($item['manager_name']); ?> </td>
                      <td> <?php echo htmlspecialchars($item['email']); ?> </td>
                      <td> <?php echo htmlspecialchars($item['phone_number']); ?> </td>
                      <td> <?php echo htmlspecialchars($item['location']); ?> </td>
                      <td> 
                        <?php 
                       
                          $statusClass = 'badge-warning'; // Pending
                          if($item['status'] == 'Operating') { $statusClass = 'badge-success'; }
                          elseif($item['status'] == 'Closed') { $statusClass = 'badge-danger'; }
                        ?>
                        <span class="badge <?php echo $statusClass; ?>">
                          <?php echo htmlspecialchars($item['status']); ?> 
                        </span>
                      </td>
                      <td>
                        <div class="btn-group">
                          <button type="button" class="btn btn-sm btn-default"><i class="fa fa-eye text-primary"></i></button>
                          <a href="edit-branch?id=<?= $item['id']; ?>" class="btn btn-sm btn-default"><i class="fa fa-edit text-success"></i></a>
                          
                          <form method="POST" style="display:inline;" onsubmit="return confirm('Are you sure you want to delete this branch?');">
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