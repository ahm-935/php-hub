<?php

$msg = "";
if (isset($_POST['Submit'])) {
    $name = $_POST['username'];

    if (empty($name)) {
        $nameErr = "Name is required";
    } elseif (strlen($name) <= 3 || strlen($name) >= 9) {
        $nameErr = "Name must be 4–8 characters long";
    } elseif (strpos($name, '@') === false) {
        $nameErr = "Name must contain '@'";
    } else {
        $nameErr = "";
    }

    if ($nameErr == "") {
        $msg = "Name submitted successfully";
    }
}


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Username Validation</title>
    <style>
        .error {
            color: red;
        }

        .success {
            color: green;
        }
    </style>
</head>

<body>
    <form action="" method="POST">
        <input type="text" name="username" value="<?php echo $_POST['username'] ?? '' ?>">
        <button type="submit" name="Submit">Submit</button>
    </form>
    <div class="success">
        <strong><?= $msg; ?></strong>
    </div>
    <br>
    <div class="error">
        <?= $nameErr  ?? ""; ?>
    </div>
    <br>

</body>

</html>