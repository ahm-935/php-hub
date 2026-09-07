<?php
// Localhost
define('DB_HOST', 'localhost');
define('DB_USER', 'root');
define('DB_PASS', '1234');
define('DB_NAME', 'courier');

// Hosting
// define('DB_HOST', 'http://ecom.com');
// define('DB_USER', 'asia');
// define('DB_PASS', '123456');
// define('DB_NAME', 'ecom');

$db = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
if ($db->connect_error) {
    die("Connection failed: " . $db->connect_error);
}
// else{
//     echo "Connected successfully";
// }

?>