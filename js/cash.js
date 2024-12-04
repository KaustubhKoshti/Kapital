let transactions = [];
let totalCash = 0;

// Fetch current balance from the PHP file and update totalCash
window.onload = function() {
    fetch('get_balance.php')
        .then(response => response.text())
        .then(balance => {
            totalCash = parseFloat(balance) || 0;
            document.getElementById('currentCash').value = totalCash;
        })
        .catch(error => console.log('Error fetching balance:', error));
};

function submitForm() {
    const addCash = parseFloat(document.getElementById('addCash').value);
    const addCashReason = document.getElementById('addCashReason').value;
    const cutCash = parseFloat(document.getElementById('cutCash').value);
    const cutCashReason = document.getElementById('cutCashReason').value;

    if (addCash) {
        transactions.push({ type: 'Add', amount: addCash, reason: addCashReason });
        totalCash += addCash;
    }

    if (cutCash) {
        transactions.push({ type: 'Cut', amount: cutCash, reason: cutCashReason });
        totalCash -= cutCash;
    }

    document.getElementById('currentCash').value = totalCash;

    // Update the new balance in the database
    updateBalanceInDatabase(totalCash);

    // Reset the form
    document.getElementById('addCash').value = '';
    document.getElementById('addCashReason').value = '';
    document.getElementById('cutCash').value = '';
    document.getElementById('cutCashReason').value = '';
}

// Function to send the updated balance to the server
function updateBalanceInDatabase(newBalance) {
    fetch('update_balance.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded',
        },
        body: `newBalance=${newBalance}`
    })
    .then(response => response.text())
    .then(data => {
        console.log(data);
    })
    .catch(error => {
        console.error('Error updating balance:', error);
    });
}

// Function to show transactions
function showTransactions() {
    const newWindow = window.open("", "_blank", "width=500,height=600");
    newWindow.document.write("<h1>Transaction Summary</h1>");
    newWindow.document.write("<p><strong>Total Cash in Account:</strong> " + totalCash + "</p>");
    newWindow.document.write("<h2>All Transactions:</h2>");
    newWindow.document.write("<ul>");
    transactions.forEach(t => {
        newWindow.document.write("<li>" + t.type + " Cash: " + t.amount + ", Reason: " + t.reason + "</li>");
    });
    newWindow.document.write("</ul>");
}
