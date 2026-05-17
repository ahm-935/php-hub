<form method="post">
    <input type="number" name="num" placeholder="Enter Number" required>
    <button type="submit" name="q2">Check</button>
</form>
<?php if (isset($_POST['q2'])) {

    $num = $_POST['num'];
    if ($num % 2 == 0) echo "$num is Even";
    else echo "$num is Odd";
}
?>