<?php
$iipp = $_SERVER["REMOTE_ADDR"];
echo $iipp ."<br>";

$link = mysqli_connect("mysql", "root", "123456");

if (!$link) {
    echo "Error: Unable to connect to MySQL." . PHP_EOL;
    echo "Debugging errno: " . mysqli_connect_errno() . PHP_EOL;
    echo "Debugging error: " . mysqli_connect_error() . PHP_EOL;
    exit;
} else {
  echo "Success: A proper connection to MySQL was made! The my_db database is great." . PHP_EOL;
  echo "Host information: " . mysqli_get_host_info($link) . PHP_EOL;
  mysqli_close($link);
}

$conn = new MongoDB\Driver\Manager("mongodb://mongo:27017");

if (!$conn) {
    echo "Error: Unable to connect to mongo." . PHP_EOL;
    exit;
} else {
   echo "Success: A proper connection to MongoDB was made!" . PHP_EOL;
}

echo "echo phpinfo";

phpinfo();

