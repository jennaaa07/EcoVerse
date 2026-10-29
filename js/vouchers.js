// vouchers.js

function redeemVoucher(voucherId, voucherTitle) {
    if (confirm(`Would you like to redeem your points for the "${voucherTitle}"?`)) {
        console.log(`Voucher redemption requested for ID: ${voucherId}`);
        alert(`Successfully redeemed "${voucherTitle}"! Your voucher code is now available in your profile wallet.`);
        // Future expansion: Send fetch/AJAX request to process point deduction
    }
}