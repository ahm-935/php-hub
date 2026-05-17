<?php
$arr = [
    "Mina"  => 65,
    "Sara"  => 70,
    "Omar"  => 60,
    "Ali"   => 90,
    "Ahmed" => 80,
];
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <table border="1" cellpadding="5" cellspacing="0" width="200">
        <thead>
            <tr>
                <th>Name</th>
                <th>Score</th>
            </tr>
        </thead>
        <tbody>
            <?php
            foreach ($arr as $name => $score) {
                echo "<tr>
                        <td>$name</td>
                        <td>$score</td>
                    </tr>";
            }
            ?>
        </tbody>
    </table>
    <!-- <h5>Highest Score is : <?php // echo max($arr);?></h5>
    <h5>Student Name : <?php //echo array_search(max($arr), $arr); ?></h5> -->

    <h5>Highest Score is : <?php $max_score = max($arr); echo $max_score;?></h5>
    <h5>Student Name : <?php echo array_search($max_score, $arr); ?></h5>
</body>

</html>