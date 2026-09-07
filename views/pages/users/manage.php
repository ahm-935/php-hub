<?php 
include 'models/user.class.php'; 

if(isset($_POST['delete_id'])){
  $id = $_POST['delete_id'];
  $res = User::delete($id);
  if($res === true){
    $msg = "User deleted successfully";
  }else{
    $msg = $res;
  }
}
$limit = 3;
$pages = User::getPageNo(3);
$users = User::readAll();

if(isset($_GET['pg'])){
  $pg = $_GET['pg'];
  $users = User::readAll($pg, $limit);
}

?>

<div class="main-panel">
  <div class="content-wrapper">
    <div class="page-header">
      <h3 class="page-title"> User Management </h3>
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
            <p><a href="create-user"><button class="btn btn-primary">Create User</button></a> </p>
            
            <table class="table table-striped table-bordered table-hover">
              <thead>
                <tr>
                  <th> ID </th>
                  <th> Name </th>
                  <th> Email </th>
                  <?php if($_SESSION['role_id'] != 2): ?>
                  <th> Action </th>
                  <?php endif; ?>
                </tr>
              </thead>
              <tbody>
                <?php foreach($users as $item): ?>
                <tr>
                  <td> <?php echo $item['id']; ?> </td>
                  <td> <?php echo $item['name']; ?> </td>
                  <td> <?php echo $item['email']; ?> </td>
                  <?php if($_SESSION['role_id'] != 2): ?>
                  <td>
                    <div class="btn-group">
                      <button type="button" class="btn btn-sm btn-default"><i class="fa fa-eye text-primary"></i></button>
                      <a href="edit-user?id=<?= $item['id']; ?>" class="btn btn-sm btn-default"><i class="fa fa-edit text-success"></i></a>
                      
                      <form method="POST" style="display:inline;" onsubmit="return confirm('Are you sure you want to delete this user?');">
                        <input type="hidden" name="delete_id" value="<?= $item['id'] ?>">
                        <button type="submit" class="btn btn-sm btn-default"><i class="fa fa-trash text-danger"></i></button>
                      </form>
                    </div>
                  </td>
                  <?php endif; ?>
                </tr>
                <?php endforeach; ?>
              </tbody>
            </table>

          </div>
          <div class="card-footer clearfix">
               <ul class="pagination pagination-sm m-0 float-right">
                 <li class="page-item <?= $pg <= 1 ? 'disabled' : '' ?>">
                   <a class="page-link" href="users?pg=1">First Page</a>
                 </li>
                 <li class="page-item <?= $pg <= 1 ? 'disabled' : '' ?>">
                   <a class="page-link" href="users?pg=<?= $pg - 1 ?>">«Prev</a>
                 </li>
                 <?php for ($i = 1; $i <= $pages; $i++) : ?>
                   <li class="page-item">
                     <a class="page-link" href="users?pg=<?= $i ?>"><?= $i; ?></a>
                   </li>
                 <?php endfor; ?>
                 <li class="page-item <?= $pg == $pages ? 'disabled' : '' ?>">
                   <a class="page-link" href="users?pg=<?= $pg + 1 ?>">Next»</a>
                 </li>
                 <li class="page-item">
                   <a class="page-link" href="users?pg=<?= $pages ?>">Last page</a>
                 </li>
               </ul>
             </div>
        </div>
      </div>
    </div>
  </div>
  <?php include('views/layouts/footer.php'); ?>
</div>