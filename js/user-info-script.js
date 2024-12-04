document.addEventListener('DOMContentLoaded', function () {
    populateLoans();
    populateFDs();
});

// Function to add a loan
function addLoan() {
    const loanAmount = document.getElementById('loanAmount').value;
    const loanInterestRate = document.getElementById('loanInterestRate').value;
    const loanTerm = document.getElementById('loanTerm').value;

    const data = `action=addLoan&loanAmount=${loanAmount}&loanInterestRate=${loanInterestRate}&loanTerm=${loanTerm}`;

    fetch('financial_management.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded',
        },
        body: data,
    })
    .then(response => response.json())
    .then(data => {
        alert(data.message);
        if (data.status === 'success') {
            populateLoans();
        }
    })
    .catch(error => console.error('Error:', error));
}

// Function to add an FD
function addFD() {
    const fdAmount = document.getElementById('fdAmount').value;
    const fdInterestRate = document.getElementById('fdInterestRate').value;
    const fdTerm = document.getElementById('fdTerm').value;

    const data = `action=addFD&fdAmount=${fdAmount}&fdInterestRate=${fdInterestRate}&fdTerm=${fdTerm}`;

    fetch('financial_management.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded',
        },
        body: data,
    })
    .then(response => response.json())
    .then(data => {
        alert(data.message);
        if (data.status === 'success') {
            populateFDs();
        }
    })
    .catch(error => console.error('Error:', error));
}

// Fetch and populate loans
function populateLoans() {
    fetch('financial_management.php?action=getLoans')
        .then(response => response.json())
        .then(loans => {
            const loanTableBody = document.getElementById('loanTableBody');
            loanTableBody.innerHTML = ''; // Clear the table

            loans.forEach(loan => {
                const row = document.createElement('tr');

                row.innerHTML = `
                    <td>${loan.LoanAmount}</td>
                    <td>${loan.InterestRate}</td>
                    <td>${loan.Term}</td>
                    <td><button onclick="deleteLoan(${loan.LoanID})">Delete</button></td>
                `;

                loanTableBody.appendChild(row);
            });
        })
        .catch(error => console.error('Error:', error));
}

// Fetch and populate FDs
function populateFDs() {
    fetch('financial_management.php?action=getFDs')
        .then(response => response.json())
        .then(fds => {
            const fdTableBody = document.getElementById('fdTableBody');
            fdTableBody.innerHTML = ''; // Clear the table

            fds.forEach(fd => {
                const row = document.createElement('tr');

                row.innerHTML = `
                    <td>${fd.FDAmount}</td>
                    <td>${fd.InterestRate}</td>
                    <td>${fd.Term}</td>
                    <td><button onclick="deleteFD(${fd.FDID})">Delete</button></td>
                `;

                fdTableBody.appendChild(row);
            });
        })
        .catch(error => console.error('Error:', error));
}

// Delete loan
function deleteLoan(loanID) {
    if (confirm('Are you sure you want to delete this loan?')) {
        fetch('financial_management.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded',
            },
            body: `action=deleteLoan&loanID=${loanID}`
        })
        .then(response => response.json())
        .then(data => {
            alert(data.message);
            if (data.status === 'success') {
                populateLoans();
            }
        })
        .catch(error => console.error('Error:', error));
    }
}

// Delete FD
function deleteFD(fdID) {
    if (confirm('Are you sure you want to delete this FD?')) {
        fetch('financial_management.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded',
            },
            body: `action=deleteFD&fdID=${fdID}`
        })
        .then(response => response.json())
        .then(data => {
            alert(data.message);
            if (data.status === 'success') {
                populateFDs();
            }
        })
        .catch(error => console.error('Error:', error));
    }
}
