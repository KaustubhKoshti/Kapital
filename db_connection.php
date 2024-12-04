<?php
$db_hostname = "127.0.0.1";
$db_username = "root";
$db_password = "";
$dbname = "bankapp";

// Create connection
$conn = new mysqli($db_hostname, $db_username, $db_password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
