<?php
if (isset($_POST['form_email'])) {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $reg_email = "/^[a-zA-Z0-9_.]{3,60}[@]{1}[a-zA-Z0-9-]{3,20}[.]{1}[a-zA-Z]{2,6}$/";
    if (preg_match($reg_email, $email) === 0) {
        $emailErr = "Email is not valid";
    } else {
        $emailErr = "";
    }

    if($emailErr == ""){
       $msg = "Form submitted successfully";
    }

    if (empty($name)) {
        $nameErr = "Name is required";
    } elseif (strlen($name) <= 4 || strlen($name) >= 9) {
        $nameErr = "Name must be 4–8 characters long";
    } elseif (strpos($name, '@') === false) {
        $nameErr = "Name must contain '@'";
    } else {
        $nameErr = "";
    }

    // Success message only if both are valid
    if ($emailErr == "" && $nameErr == "") {
        $msg1 = "Form submitted successfully";
    }

}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form validation</title>
    <style>
        .error{
            color: red;
        }
    </style>
</head>
<body>
    <form action="" method="POST">
        <label for="name">Name:</label><br>
        <input type="text" name="name" value="<?= isset($_POST["name"]) ? $_POST["name"] : ""; ?>"><br>
        <span class="error" id="nameError"><?= $nameErr ?? "" ;?></span><br>
        <label for="email">Email:</label><br>
        <input type="text" name="email" value="<?= isset($_POST["email"]) ? $_POST["email"] : ""; ?>"><br>
        <span class="error" id="emailError"><?=  $emailErr ?? "" ;?> </span>
        <br>
        <input type="submit" name="form_email" value="submit">
        <h1><?= $msg ?? "" ?></h1>
        <h1><?= $msg1 ?? "" ?></h1>
    </form>
</body>
</html>