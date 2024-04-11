<?php

$dbservername = "localhost";
$dbusername = "root";
$dbpassword = "a1b2c3d4";
$dbname = "wtech_eshop";

session_start();

function db_query($sql)
{
    $conn = mysqli_connect($GLOBALS["dbservername"], $GLOBALS["dbusername"], $GLOBALS["dbpassword"], $GLOBALS["dbname"]);
    if (!$conn) {
      die("Connection failed: " . mysqli_connect_error());
    }
    $result = mysqli_query($conn, $sql);
    mysqli_close($conn);
    return $result;
}

?>