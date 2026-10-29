// store.js

function redeemItem(itemId, itemTitle) {
    if (confirm(`Are you sure you want to redeem "${itemTitle}"?`)) {
        console.log(`Redeemed item ID: ${itemId}`);
        alert(`Successfully redeemed ${itemTitle}! Check your profile for details.`);
        // Add backend redirection or fetch call here to process redemption
    }
}