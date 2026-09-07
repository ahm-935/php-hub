<?php
require_once 'models/auth.class.php';
if(isset($_POST['email']) && isset($_POST['password'])) {
    // echo $_POST['email'] . ' ' . $_POST['password'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $auth = Auth::login($email, $password);
    // print_r($auth); 
    if(isset($auth['error'])) {
        $msg = $auth['error'];
    } else { 
      // print_r($auth);
        $_SESSION['id'] = $auth['id'];
        $_SESSION['role_id'] = $auth['role_id'];
        header('Location: dashboard');
    }         
}
// echo password_hash('0000', PASSWORD_DEFAULT);
?>
<style>
  .navbar.default-layout-navbar {
  display: none !important;
}

#sidebar {
  display: none !important;
}

</style>
  <div class="container d-flex justify-content-center align-items-center vh-100">
    <div class="card shadow p-4" style="width: 350px;">
      <h3 class="text-center mb-4">User Login</h3>
      <form action="" method="POST">
        <div class="mb-3">
          <label for="email" class="form-label">Email address</label>
          <input type="email" class="form-control" id="email" name="email">
        </div>
        <div class="mb-3">
          <label for="password" class="form-label">Password</label>
          <input type="password" class="form-control" id="password" name="password">
        </div>
         <p class="text-danger text-center font-weight-bold mb-1"><?php echo $msg ?? "" ?></p>
        <button type="submit" class="btn btn-primary w-100">Login</button>
        <p class="text-center mt-3">
          <a href="register.php">Create an account</a>
        </p>
      </form>
    </div>
  </div>
