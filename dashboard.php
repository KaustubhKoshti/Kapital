<?php
session_start();

// Check if the user is logged in
if (!isset($_SESSION['userID'])) {
    header("Location: login.php"); // Redirect to login if not logged in
    exit();
}

// Fetch user data from the database if needed
include 'db_connection.php';
$userID = $_SESSION['userID'];

$stmt = $conn->prepare("SELECT Username FROM Users WHERE UserID = ?");
$stmt->bind_param("i", $userID);
$stmt->execute();
$stmt->bind_result($username);
$stmt->fetch();
$stmt->close();
$conn->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>KAPITAL</title>
    <link rel="stylesheet" href="./css/dash.css">
</head>
<body>
    <header>
        <img src="./img/moneybaglogo.png" alt="KAPITAL Logo" class="logo"> 
        <h1>KAPITAL</h1>
        <div class="welcome-panel">
            <p>Hello, <?php echo htmlspecialchars($username); ?>!</p>
            <a href="logout.php" class="logout-btn">Logout</a>
        </div>
    </header>

    <main>
        <div class="panel" id="cashManagement">
            <a href="cash-management.php">Cash Management Panel</a>
        </div>
        <div class="panel" id="wealthLiteracy">
            <a href="lit.html">Wealth Literacy</a>
        </div>
        <div class="panel" id="userInfo">
            <a href="Financial_Management.html">Financial Management</a>
        </div>
    </main>

    <footer>
        <div class="footer-links">
            <a href="aboutus.html">About Us</a>
            <a href="contact.html">Contact and Info</a>
        </div>
    </footer>

    <script src="./js/indexscript.js"></script>
</body>
</html>
