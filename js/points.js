// impact.js

function viewRedemptionHistory() {
    alert("Redemption History:\n- Eco-Tote Bag (1,200 pts) - Redeemed on May 12\n- 10% Cafe Voucher (500 pts) - Redeemed on April 28");
}

function recalculateImpact() {
    const btn = document.getElementById('recalculateBtn');
    const savingsEl = document.getElementById('carbonSavingsValue');
    
    btn.textContent = "Updating metrics...";
    btn.disabled = true;

    setTimeout(() => {
        // Randomly simulate a slight improvement in carbon savings
        const currentVal = parseFloat(savingsEl.textContent);
        const newVal = (currentVal - 1.2).toFixed(1);
        
        savingsEl.textContent = newVal;
        btn.textContent = "Recalculate Impact";
        btn.disabled = false;
        
        alert(`Impact successfully synced! Your updated footprint savings are now ${newVal} kg CO₂e.`);
    }, 800);
}