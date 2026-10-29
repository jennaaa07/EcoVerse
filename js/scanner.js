// scanner.js

// Initialize current points dynamically from the body data attribute
const bodyElement = document.body;
let currentPoints = parseInt(bodyElement.getAttribute('data-initial-points')) || 150;

function handleDepositClaim() {
    currentPoints += 50;
    const ledgerDisplay = document.getElementById('pointLedgerDisplay');
    if (ledgerDisplay) {
        ledgerDisplay.innerText = `+${currentPoints} Unclaimed Pts`;
    }
    alert('Deposit verified! +50 points added to your guest session ledger.');
}

function saveGuestProgress() {
    alert('Redirecting to account registration to secure your ' + currentPoints + ' points!');
}

// Live Guest Session Countdown Timer Function
let totalSeconds = 59 * 60 + 42;
const sessionTimerElement = document.getElementById('sessionTimer');

if (sessionTimerElement) {
    const timerInterval = setInterval(() => {
        if (totalSeconds > 0) {
            totalSeconds--;
            const minutes = Math.floor(totalSeconds / 60);
            const seconds = totalSeconds % 60;
            sessionTimerElement.innerText = `${String(minutes).padStart(2, '0')}:${String(seconds).padStart(2, '0')} remaining`;
        } else {
            clearInterval(timerInterval);
            sessionTimerElement.innerText = 'Session expired';
        }
    }, 1000);
}