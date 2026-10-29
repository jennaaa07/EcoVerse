// waste_guide.js

// Function to simulate launching the smart AI camera scanner
function launchAIScanner() {
    alert("Launching Eco Hub AI Camera Scanner... Please point your camera at the waste item.");
    // Future expansion: Integrate camera stream modal or native media capture interface
}

// Function to filter categories dynamically based on input search text
function filterCategories() {
    const input = document.getElementById('searchInput').value.toLowerCase();
    const cards = document.querySelectorAll('.category-card');

    cards.forEach(card => {
        const keywords = card.getAttribute('data-name');
        if (keywords.includes(input)) {
            card.style.display = "flex";
        } else {
            card.style.display = "none";
        }
    });
}