<?php
$arr = [
    "Ukraine" => "Kiev",
    "Itali" => "Rome",
    "Russia" => "Moscow",
    "Azarbaijan" => "Baku",
    "Belarus" => "Minsk"
];
echo " <h3>Original Array:</h3>";
foreach($arr as $key => $value){
    echo " [$key] => $value <br>";
}

echo " <h3>Sorted Array by key(Country Name):</h3>";
echo "<br>";
 ksort($arr);

foreach($arr as $key => $value){
    echo " [$key] => $value <br>";
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Array</title>
</head>
<body>
    
</body>
</html>