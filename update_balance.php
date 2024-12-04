<?php
session_start();
if (!isset($_SESSION['userID'])) {
    header("Location: loginsubmit.php");
    exit();
}

// Include database connection
include 'db_connection.php';

if (isset($_POST['newBalance'])) {
    $newBalance = floatval($_POST['newBalance']);
    $userID = $_SESSION['userID'];

    // Check if the user already has an entry in the accountbalance table
    $stmt = $conn->prepare("SELECT COUNT(*) FROM accountbalance WHERE UserID = ?");
    $stmt->bind_param("i", $userID);
    $stmt->execute();
    $stmt->bind_result($count);
    $stmt->fetch();
    $stmt->close();

    if ($count > 0) {
        // Update the existing balance
        $stmt = $conn->prepare("UPDATE accountbalance SET CurrentBalance = ? WHERE UserID = ?");
        $stmt->bind_param("di", $newBalance, $userID);
    } else {
        // Insert a new balance record for the user
        $stmt = $conn->prepare("INSERT INTO accountbalance (UserID, CurrentBalance) VALUES (?, ?)");
        $stmt->bind_param("id", $userID, $newBalance);
    }

    if ($stmt->execute()) {
        echo "Balance updated successfully.";
    } else {
        echo "Error updating balance: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
} else {
    echo "No balance received.";
}
?>
