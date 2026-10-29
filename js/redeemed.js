// reward_history.js

function openFilterOptions() {
    const selectedFilter = prompt("Select filter type:\n1. All Records\n2. This Month Only\n3. Higher Point Transactions", "1");
    
    if (selectedFilter === "1") {
        alert("Showing all reward records.");
    } else if (selectedFilter === "2") {
        alert("Filtered by current month (August 2026).");
    } else if (selectedFilter === "3") {
        alert("Filtered by high-value transactions.");
    }
}