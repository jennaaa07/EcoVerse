// merchandise.js

function redeemItem(itemName, itemPoints) {
    const confirmRedemption = confirm(`Are you sure you want to redeem "${itemName}" for ${itemPoints.toLocaleString()} points?`);
    
    if (confirmRedemption) {
        alert(`Congratulations! You have successfully redeemed the ${itemName}. Check your profile vouchers or reward history for fulfillment details.`);
        window.location.reload();
    }
}