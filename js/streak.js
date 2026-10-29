// streaks.js — Handles real-time participant filtering, modal control, and streak adjustments

document.addEventListener('DOMContentLoaded', () => {
    // 1. SEARCH FILTER LOGIC
    const searchInput = document.getElementById('searchInput');
    const tableBody = document.getElementById('tableBody');
    
    if (searchInput && tableBody) {
        const rows = tableBody.getElementsByTagName('tr');

        searchInput.addEventListener('keyup', function() {
            const filter = searchInput.value.toLowerCase();
            
            for (let i = 0; i < rows.length; i++) {
                const rowText = rows[i].textContent || rows[i].innerText;
                if (rowText.toLowerCase().indexOf(filter) > -1) {
                    rows[i].style.display = "";
                } else {
                    rows[i].style.display = "none";
                }
            }
        });
    }

    // 2. MODAL LOGIC
    const modal = document.getElementById('adjustModal');
    const modalName = document.getElementById('modalName');
    const modalId = document.getElementById('modalId');
    const streakInput = document.getElementById('streakInput');

    function openModal(name, id, currentStreak) {
        if (modalName) modalName.innerText = name;
        if (modalId) modalId.innerText = id;
        if (streakInput) streakInput.value = currentStreak;
        
        if (modal) {
            modal.classList.remove('hidden');
            modal.classList.add('flex');
        }
    }

    function closeModal() {
        if (modal) {
            modal.classList.add('hidden');
            modal.classList.remove('flex');
        }
    }

    function saveChanges() {
        const newStreak = streakInput ? streakInput.value : 0;
        const userName = modalName ? modalName.innerText : 'Participant';
        
        alert('Success! ' + userName + '\'s streak has been updated to ' + newStreak + ' days.');
        closeModal();
    }

    // Attach event listeners to all dynamic adjust buttons
    const adjustButtons = document.querySelectorAll('.adjust-btn');
    adjustButtons.forEach(btn => {
        btn.addEventListener('click', () => {
            const name = btn.getAttribute('data-name');
            const id = btn.getAttribute('data-id');
            const streak = btn.getAttribute('data-streak');
            openModal(name, id, streak);
        });
    });

    // Close and save button bindings
    const closeModalBtn = document.getElementById('closeModalBtn');
    const cancelModalBtn = document.getElementById('cancelModalBtn');
    const saveChangesBtn = document.getElementById('saveChangesBtn');
    const nextPageBtn = document.getElementById('nextPageBtn');

    if (closeModalBtn) closeModalBtn.addEventListener('click', closeModal);
    if (cancelModalBtn) cancelModalBtn.addEventListener('click', closeModal);
    if (saveChangesBtn) saveChangesBtn.addEventListener('click', saveChanges);

    if (nextPageBtn) {
        nextPageBtn.addEventListener('click', () => {
            alert('Loading next 50 participants...');
        });
    }
});