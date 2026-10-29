// pos.js — Handles terminal points emission and dynamic toast feedback

function showNotification(title, message) {
    const container = document.getElementById('toast-container');
    const toast = document.createElement('div');
    
    toast.className = `flex items-center gap-3 bg-emerald-900 text-white border-2 border-emerald-500 shadow-2xl rounded-2xl p-4 min-w-[320px] pointer-events-auto transform transition-all duration-300 translate-x-full opacity-0`;
    
    toast.innerHTML = `
        <i class="fa-solid fa-circle-check text-emerald-400 text-xl"></i>
        <div class="flex-grow">
            <p class="font-black text-sm">${title}</p>
            <p class="text-xs text-emerald-200 mt-0.5">${message}</p>
        </div>
    `;

    container.appendChild(toast);

    setTimeout(() => toast.classList.remove('translate-x-full', 'opacity-0'), 50);

    setTimeout(() => {
        toast.classList.add('translate-x-full', 'opacity-0');
        setTimeout(() => toast.remove(), 300);
    }, 3500);
}

async function handleIssuePoints(e) {
    e.preventDefault();
    const participantId = document.getElementById('participant_id').value;
    const selectElement = document.getElementById('eco_action');
    try {
        const response = await fetch('api/issue_points.php', { method: 'POST', body: new FormData(document.getElementById('posForm')) });
        const data = await response.json();
        if (!data.success) throw new Error(data.message);
        showNotification('Points Issued Successfully!', data.message);
        document.getElementById('posForm').reset();
    } catch (error) {
        showNotification('Could not issue points', error.message || 'Please try again.');
    }
}

document.addEventListener('DOMContentLoaded', () => {
    const posForm = document.getElementById('posForm');
    if (posForm) {
        posForm.addEventListener('submit', handleIssuePoints);
    }
});
