// centre_locator.js

let heatmapActive = false;

function toggleHeatmap() {
    heatmapActive = !heatmapActive;
    const heatmapSwitch = document.getElementById('heatmapSwitch');
    const heatmapKnob = document.getElementById('heatmapKnob');
    const heatmapText = document.getElementById('heatmapText');

    if (heatmapActive) {
        heatmapSwitch.classList.remove('bg-gray-600');
        heatmapSwitch.classList.add('bg-orange-500');
        heatmapKnob.style.transform = 'translateX(14px)';
        heatmapText.innerText = 'Hide Collection Heatmap';
        alert('Collection heatmap overlay enabled: high-traffic bins are highlighted.');
    } else {
        heatmapSwitch.classList.remove('bg-orange-500');
        heatmapSwitch.classList.add('bg-gray-600');
        heatmapKnob.style.transform = 'translateX(0px)';
        heatmapText.innerText = 'Show Collection Heatmap';
        alert('Collection heatmap overlay disabled.');
    }
}

function focusCentre(centreName) {
    alert(`Centering map on: ${centreName}`);
}

function getDirections(centreName) {
    alert(`Launching turn-by-turn navigation directions to ${centreName}.`);
}

// Live Search Filter for Centres
document.addEventListener('DOMContentLoaded', () => {
    const searchInput = document.getElementById('centreSearchInput');
    const centreItems = document.querySelectorAll('.centre-item');

    if (searchInput) {
        searchInput.addEventListener('input', (e) => {
            const query = e.target.value.toLowerCase();
            centreItems.forEach(item => {
                const name = item.getAttribute('data-name').toLowerCase();
                if (name.includes(query)) {
                    item.style.display = 'flex';
                } else {
                    item.style.display = 'none';
                }
            });
        });
    }
});