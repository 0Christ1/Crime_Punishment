<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "Project3";

// create connection
$conn = new mysqli($servername, $username, $password, $dbname);


// check connection
if ($conn->connect_error) {
    die("connect error: " . $conn->connect_error);
}
?>

