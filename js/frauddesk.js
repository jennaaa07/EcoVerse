// frauddesk.js — Handles live clock, pop-up notifications, and fraud card actions

document.addEventListener('DOMContentLoaded', () => {
    // Run clock immediately on page load and update every second
    updateHeaderClock();
    setInterval(updateHeaderClock, 1000);
    loadFraudCases();
});

async function loadFraudCases() {
    const main = document.querySelector('main');
    try {
        const response = await fetch('api/fraud.php'); const data = await response.json();
        if (!data.success) throw new Error(data.message);
        main.innerHTML = data.cases.map(item => `<article class="bg-white rounded-3xl p-7 border-2 ${item.decision ? 'border-emerald-200' : 'border-red-200'}"><p class="font-black text-lg">${item.user_code || 'Unknown participant'} · ${item.activity_name}</p><p class="text-sm text-slate-600 mt-2">Claimed ${item.points_claimed} points · ${item.device_ip}</p><p class="text-xs font-bold mt-3 ${item.decision ? 'text-emerald-700' : 'text-red-700'}">${item.decision ? `Decision: ${item.decision} (${item.actioned_at})` : 'Awaiting investigation'}</p>${item.decision ? '' : `<div class="flex gap-3 mt-5"><button onclick="handleFlagAction(${item.audit_id}, '${item.user_code}', 'lock')" class="bg-red-600 text-white font-bold py-2 px-4 rounded-xl">Lock Account</button><button onclick="handleFlagAction(${item.audit_id}, '${item.user_code}', 'dismiss')" class="bg-emerald-100 text-emerald-900 font-bold py-2 px-4 rounded-xl">Dismiss Flag</button></div>`}</article>`).join('') || '<div class="bg-white p-8 rounded-3xl">No fraud cases found.</div>';
    } catch (error) { main.innerHTML = `<div class="text-red-700">${error.message}</div>`; }
}

window.handleFlagAction = async function saveFraudAction(auditId, participantId, action) {
    if (!confirm(`Save ${action} decision for ${participantId}?`)) return;
    try { const form=new FormData(); form.append('audit_id', auditId); form.append('decision', action === 'lock' ? 'locked' : 'dismissed'); const response=await fetch('api/fraud.php',{method:'POST',body:form}); const data=await response.json(); if(!data.success) throw new Error(data.message); showNotification('Fraud decision saved', data.message, action); loadFraudCases(); } catch(error) { showNotification('Could not save decision', error.message, 'lock'); }
};

// 1. Live Header Clock Function
function updateHeaderClock() {
    const clockElement = document.getElementById('live-clock');
    if (!clockElement) return;
    const now = new Date();
    
    const dateStr = now.toLocaleDateString([], { month: 'short', day: 'numeric', year: 'numeric' });
    const timeStr = now.toLocaleTimeString([], { hour: '2-digit', minute: '2-digit', second: '2-digit' });
    
    clockElement.textContent = `${dateStr} • ${timeStr}`;
}

// 2. Pop-up Notification Engine
function showNotification(title, message, status) {
    const container = document.getElementById('toast-container');
    if (!container) return;
    
    const toast = document.createElement('div');
    
    const isLock = status === 'lock';
    const borderColor = isLock ? 'border-red-500' : 'border-emerald-500';
    const iconColor = isLock ? 'text-red-500' : 'text-emerald-500';
    const icon = isLock ? 'fa-user-slash' : 'fa-circle-check';

    toast.className = `flex items-center gap-3 bg-emerald-900 text-white border-2 ${borderColor} shadow-2xl rounded-2xl p-4 min-w-[320px] pointer-events-auto transform transition-all duration-300 translate-x-full opacity-0`;
    
    toast.innerHTML = `
        <i class="fa-solid ${icon} ${iconColor} text-xl"></i>
        <div class="flex-grow">
            <p class="font-black text-sm">${title}</p>
            <p class="text-xs text-emerald-200 mt-0.5">${message}</p>
        </div>
    `;

    container.appendChild(toast);

    setTimeout(() => {
        toast.classList.remove('translate-x-full', 'opacity-0');
    }, 50);

    setTimeout(() => {
        toast.classList.add('translate-x-full', 'opacity-0');
        setTimeout(() => toast.remove(), 300);
    }, 3500);
}

// 3. Flag Action Handler
function handleFlagAction(cardId, participantId, action) {
    const card = document.getElementById(cardId);
    if (card) {
        card.classList.add('opacity-0', 'scale-95');
        setTimeout(() => card.remove(), 300);
    }

    if (action === 'lock') {
        showNotification('Account Locked', `Participant ${participantId} has been suspended.`, 'lock');
    } else {
        showNotification('Flag Dismissed', `Report for ${participantId} was cleared.`, 'dismiss');
    }
}
