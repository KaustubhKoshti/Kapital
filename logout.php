<?php
session_start();

// Destroy all session data
$_SESSION = []; // Clear the session array
session_destroy(); // Destroy the session

// Redirect to the login page
header("Location: login.php");
exit();
?>
