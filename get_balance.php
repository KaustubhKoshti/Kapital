<?php
// Include database connection
include 'db_connection.php';

session_start();
if (!isset($_SESSION['userID'])) {
    header("Location: loginsubmit.php");
    exit();
}

// Get UserID from session
$userID = $_SESSION['userID'];

// SQL query to fetch the current balance
$sql = "SELECT CurrentBalance FROM accountbalance WHERE UserID = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $userID);
$stmt->execute();
$stmt->bind_result($currentBalance);
$stmt->fetch();
$stmt->close();
$conn->close();

// Output the current balance
echo $currentBalance ? $currentBalance : "0.00";
?>
