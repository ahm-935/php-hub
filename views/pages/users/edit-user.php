<?php
require_once 'models/user.class.php';
require_once 'models/role.class.php';

if (isset($_POST['btn_submit'])) {
    $id = $_POST['id'];
    $name = $_POST['name'];
    $email = $_POST['email'];
    $role_id = $_POST['role_id'];

    $user = new User($id, $name, $email, null, $role_id);
    $res = $user->update();
    if ($res === true) {
        $msg = "User updated successfully";
    } else {
        $msg = "Error: " . $res;
    }
}

$roles = Role::readAll();

if (isset($_GET['id'])) {
    $row = User::readById($_GET['id']);
    if (!$row) {
        $not_found = true;
    }
} else {
    echo "<script>window.location='users';</script>";
    exit;
}
?>

<div class="main-panel">
    <div class="content-wrapper">
        <div class="page-header">
            <h3 class="page-title"> Update Details </h3>
        </div>
        <div class="row">
            <div class="col-12 grid-margin stretch-card">

                <div class="card">
                    <div class="card-body">
                        <?php if (isset($not_found)): ?>
                            <h5>Data not found.</h5>
                        <?php else: ?>
                            <?php if (isset($msg)): ?>
                                <h4><?= $msg ?></h4>
                            <?php endif; ?>
                            <p class="card-description"> <a href="users"><button class="btn btn-dark">&larr;
                                        Back</button></a> </p>

                            <form class="forms-sample" method="POST">
                                <input type="hidden" name="id" value="<?= $row['id']; ?>">

                                <div class="form-group">
                                    <label for="exampleInputUsername1">Username</label>
                                    <input type="text" class="form-control" name="name" id="exampleInputUsername1"
                                        placeholder="Username" value="<?= $row['name']; ?>" required>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Email address</label>
                                    <input type="email" class="form-control" name="email" id="exampleInputEmail1"
                                        placeholder="Email" value="<?= $row['email']; ?>" required>
                                </div>
                                <div class="form-group">
                                    <label>Role</label>
                                    <select class="form-control" name="role_id" required>
                                        <option value="">Select Role</option>
                                        <option value="1" <?= $row['role_id'] == 1 ? 'selected' : ''; ?>>Admin</option>
                                        <option value="2" <?= $row['role_id'] == 2 ? 'selected' : ''; ?>>User</option>
                                    </select>
                                </div>

                                <button type="submit" name="btn_submit" class="btn btn-success mr-2">Update</button>
                            </form>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php include('views/layouts/footer.php'); ?>
</div>