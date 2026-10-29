// donations.js

let currentPoints = 2450;

function processDonation(campaignName, pointsCost) {
    if (currentPoints < pointsCost) {
        alert(`Insufficient points! You need ${pointsCost} points for the "${campaignName}", but you only have ${currentPoints} points.`);
        return;
    }

    const confirmed = confirm(`Confirm donation of ${pointsCost} points to support the "${campaignName}"?`);

    if (confirmed) {
        currentPoints -= pointsCost;
        
        // Update points view on page dynamically
        const pointsDisplay = document.getElementById('userPointsDisplay');
        if (pointsDisplay) {
            pointsDisplay.innerText = currentPoints.toLocaleString();
        }

        alert(`Thank you! Your donation of ${pointsCost} points to "${campaignName}" was successful.`);
    }
}