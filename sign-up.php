<?php
if (isset($_POST['register'])) {
    // echo $_POST['email'] . "<br>". $_POST['password'] . "<br>" . $_POST['confirm_password'];
    $email = $_POST['email'] ?? "";
    $password = $_POST['password'] ?? "";
    $confirm_password = $_POST['confirm_password'] ?? "";
    $emailRegex = "/^[a-zA-Z0-9_.]{3,60}[@]{1}[a-zA-Z0-9-]{3,20}[.]{1}[a-zA-Z]{2,6}$/";

    if($email==""){
        $emailErr = "Email is required";
    } elseif (preg_match($emailRegex, $email) === 0) {
        $emailErr = "Email is not valid";
    } else {
        $emailErr = "";
    }

    if($password==""){
        $passwordErr = "Password is required";
    } elseif (strlen($password) < 8) {
        $passwordErr = "Password must be at least 8 characters long";
    } else {
        $passwordErr = "";
    }

    if($confirm_password==""){
        $confirm_passwordErr = "Confirm Password is required";
    } elseif ($password !== $confirm_password) {
        $confirm_passwordErr = "Passwords does not match";
    } else {
        $confirm_passwordErr = "";
    }

    if($emailErr=="" && $passwordErr=="" && $confirm_passwordErr==""){
        $msg = "<span style='color:green'>Registration successful!</span>";
    }

}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up Form</title>
    <style>
        .error {
            color: red;
        }
    </style>
</head>
<body>
    <h2>Registration Form</h2>
    <form action="" method="POST">
        <label for="email">Email:</label><br>
        <input type="text" name="email" value="<?= $email ?? "" ?>"><br>
        <div class="error"><?=  $emailErr ?? "" ?></div>
        <br>
        <label for="password">Password:</label><br>
        <input type="password" name="password" value="<?= $password ?? "" ?>" placeholder="Enter your password"><br>
        <div class="error"><?=  $passwordErr ?? "" ?></div>
        <br>
        <label for="confirm_password">Confirm Password:</label><br>
        <input type="password" name="confirm_password" value="<?= $confirm_password ?? "" ?>" placeholder="Confirm your password"><br>
        <div class="error"><?=  $confirm_passwordErr ?? "" ?></div>
        <br>
        <button type="submit" name="register">Sign Up</button>
    </form>
    <div>
        <?= $msg ?? "" ?>
    </div>
</body>
</html>