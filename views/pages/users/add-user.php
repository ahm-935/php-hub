<?php
require_once 'models/user.class.php';
require_once 'models/role.class.php';
$roles = Role::readAll();

if (isset($_POST['btn_submit'])) {
  $name = $_POST['name'];
  $email = $_POST['email'];
  $role_id = $_POST['role_id'];
  $password = $_POST['password'];
  $confirm_password = $_POST['confirm_password'];

  if ($password == $confirm_password) {
    
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);
    $user = new User(null, $name, $email, $hashed_password, $role_id);
    $res = $user->create();

    if ($res === true) {
      $msg = "<div class='alert alert-success'>User created successfully.</div>";
    } else {
      $msg = "<div class='alert alert-danger'>Error: " . $res . "</div>";
    }
  } else {
    $msg = "<div class='alert alert-danger'>Passwords do not match.</div>";
  }
}
?>

<div class="main-panel">
  <div class="content-wrapper">
    <div class="page-header">
      <h3 class="page-title"> Input Details </h3>
    </div>
    <div class="row">
      <div class="col-12 grid-margin stretch-card">
        <div class="card">
          <div class="card-body">
            <?php if (isset($msg)): ?>
              <h4><?= $msg ?></h4>
            <?php endif; ?>
            <p class="card-description"> <a href="users"><button class="btn btn-dark">&larr; Back</button></a> </p>

            <form class="forms-sample" method="POST">
              <div class="form-group">
                <label for="exampleInputUsername1">Username</label>
                <input type="text" class="form-control" name="name" id="exampleInputUsername1" placeholder="Username"
                  required>
              </div>
              <div class="form-group">
                <label for="exampleInputEmail1">Email address</label>
                <input type="email" class="form-control" name="email" id="exampleInputEmail1" placeholder="Email"
                  required>
              </div>
              <div class="form-group">
                <label>Role</label>
                <select class="form-control" name="role_id" required>
                  <option value="">Select Role</option>
                  <option value="1">Admin</option>
                  <option value="2">User</option>
                </select>
              </div>
              <div class="form-group">
                <label for="exampleInputPassword1">Password</label>
                <input type="password" class="form-control" name="password" id="exampleInputPassword1"
                  placeholder="Password" required>
              </div>
              <div class="form-group">
                <label for="exampleInputConfirmPassword1">Confirm Password</label>
                <input type="password" class="form-control" name="confirm_password" id="exampleInputConfirmPassword1"
                  placeholder="Confirm Password" required>
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