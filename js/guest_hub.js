// guest_hub.js

// Initialize current points dynamically from the body data attribute
const bodyElement = document.body;
let currentPoints = parseInt(bodyElement.getAttribute('data-initial-points')) || 150;

async function handleDepositClaim() {
    try {
        const response = await fetch('api/claim.php', { method: 'POST' });
        const data = await response.json();
        if (!data.success) throw new Error(data.message);
        currentPoints = data.points;
        const ledgerDisplay = document.getElementById('pointLedgerDisplay');
        if (ledgerDisplay) ledgerDisplay.innerText = `+${currentPoints} Pts`;
        alert(data.message);
    } catch (error) {
        alert(error.message || 'Could not save the guest claim.');
    }
}

function saveGuestProgress() {
    alert(`Your ${currentPoints} guest points are saved for this browser session. Log in or register to transfer them to an account.`);
}

function triggerLockedAction() {
    alert('This reward is locked. Please create an account or sign in to redeem items from the marketplace.');
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
            sessionTimerElement.innerText = `${String(minutes).padStart(2, '0')}:${String(seconds).padStart(2, '0')}`;
        } else {
            clearInterval(timerInterval);
            sessionTimerElement.innerText = 'Expired';
        }
    }, 1000);
}
