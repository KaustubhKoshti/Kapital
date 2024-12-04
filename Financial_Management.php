<?php
session_start();

// If the user is not logged in, redirect to the login page
if (!isset($_SESSION['userID'])) {
    header("Location: loginsubmit.php");
    exit();
}

$userID = $_SESSION['userID']; // Retrieve UserID from the session

// Include the database connection
include('db_connection.php');

// Handle POST requests (add or delete loans and FDs)
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $action = $_POST['action'];

    // Add Loan
    if ($action == 'addLoan') {
        $loanAmount = $_POST['loanAmount'];
        $loanInterestRate = $_POST['loanInterestRate'];
        $loanTerm = $_POST['loanTerm'];

        // Insert loan into the database
        $stmt = $conn->prepare("INSERT INTO loans (UserID, LoanAmount, InterestRate, Term) VALUES (?, ?, ?, ?)");
        $stmt->bind_param('idii', $userID, $loanAmount, $loanInterestRate, $loanTerm);

        if ($stmt->execute()) {
            echo json_encode(['status' => 'success', 'message' => 'Loan added successfully!']);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Error adding loan.']);
        }

        $stmt->close();
    }

    // Add FD
    if ($action == 'addFD') {
        $fdAmount = $_POST['fdAmount'];
        $fdInterestRate = $_POST['fdInterestRate'];
        $fdTerm = $_POST['fdTerm'];

        // Insert FD in database
        $stmt = $conn->prepare("INSERT INTO fixeddeposits (UserID, FDAmount, InterestRate, Term) VALUES (?, ?, ?, ?)");
        $stmt->bind_param('idii', $userID, $fdAmount, $fdInterestRate, $fdTerm);

        if ($stmt->execute()) {
            echo json_encode(['status' => 'success', 'message' => 'FD added successfully!']);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Error adding FD.']);
        }

        $stmt->close();
    }

    // Delete Loan
    if ($action == 'deleteLoan') {
        $loanID = $_POST['loanID'];

        // Delete loan from the database
        $stmt = $conn->prepare("DELETE FROM loans WHERE LoanID = ? AND UserID = ?");
        $stmt->bind_param('ii', $loanID, $userID);

        if ($stmt->execute()) {
            echo json_encode(['status' => 'success', 'message' => 'Loan deleted successfully!']);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Error deleting loan.']);
        }

        $stmt->close();
    }

    // Delete FD
    if ($action == 'deleteFD') {
        $fdID = $_POST['fdID'];

        // Delete FD from the database
        $stmt = $conn->prepare("DELETE FROM fixeddeposits WHERE FDID = ? AND UserID = ?");
        $stmt->bind_param('ii', $fdID, $userID);

        if ($stmt->execute()) {
            echo json_encode(['status' => 'success', 'message' => 'FD deleted successfully!']);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Error deleting FD.']);
        }

        $stmt->close();
    }
}

// Handle GET requests (fetch loans and FDs)
if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    // Fetch loans
    if (isset($_GET['action']) && $_GET['action'] == 'getLoans') {
        $result = $conn->query("SELECT LoanID, LoanAmount, InterestRate, Term FROM loans WHERE UserID = $userID");
        $loans = $result->fetch_all(MYSQLI_ASSOC);
        echo json_encode($loans);
    }

    // Fetch FDs
    if (isset($_GET['action']) && $_GET['action'] == 'getFDs') {
        $result = $conn->query("SELECT FDID, FDAmount, InterestRate, Term FROM fixeddeposits WHERE UserID = $userID");
        $fds = $result->fetch_all(MYSQLI_ASSOC);
        echo json_encode($fds);
    }
}
?>
