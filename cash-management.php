<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cash Management</title>
    <link rel="stylesheet" href="./css/styles.css">
</head>
<body>
    <div class="container">
        <div class="form-section">
            <label for="addCash">Cash</label>
            <input type="number" id="addCash" placeholder="Enter amount">

            <label for="addCashReason">Reason</label>
            <input type="text" id="addCashReason" placeholder="Enter reason">

            <label for="cutCash">Debit</label>
            <input type="number" id="cutCash" placeholder="Enter amount">

            <label for="cutCashReason">Reason</label>
            <input type="text" id="cutCashReason" placeholder="Enter reason">

            <button type="button" onclick="submitForm()">Submit</button>
        </div>

        <div class="info-section">
            <label for="currentCash">Cash in your account</label>
            <!-- This will be populated using JS after fetching balance from the server -->
            <input type="text" id="currentCash" readonly>

            <button type="button" onclick="showTransactions()">Show All Transactions</button>
        </div>
    </div>

    <script src="./js/cash.js"></script>
</body>
</html>
