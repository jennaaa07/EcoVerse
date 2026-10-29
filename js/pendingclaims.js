// pendingclaims.js — Handles real-time clock, relative card stamps, notifications, and claim decisions

document.addEventListener('DOMContentLoaded', () => {
    updateHeaderClock();
    setInterval(updateHeaderClock, 1000);
    updateCardRelativeTimes();
    loadPendingClaims();
    loadClaimHistory();
});

async function loadClaimHistory() {
    try { const response=await fetch('api/claim_history.php'); const data=await response.json(); if(!data.success) throw new Error(data.message); let section=document.getElementById('claim-history'); if(!section){section=document.createElement('section');section.id='claim-history';section.className='mx-8 mb-8 bg-white rounded-3xl p-6 border border-slate-200';document.querySelector('main').after(section);} section.innerHTML=`<h2 class="font-black text-slate-800 mb-3">Reviewed claim history</h2>${data.history.length?data.history.map(x=>`<p class="text-sm border-t border-slate-100 py-2"><strong>${x.user_code}</strong> · ${x.activity_type} · ${x.requested_points} pts · <span class="font-bold">${x.status}</span> · ${x.reviewed_at}</p>`).join(''):'<p class="text-sm text-slate-500">No reviewed claims yet.</p>'}`; } catch(error){console.error(error);}
}

function escapeHtml(value) {
    const element = document.createElement('div');
    element.textContent = value || '';
    return element.innerHTML;
}

async function loadPendingClaims() {
    const list = document.getElementById('claims-list');
    if (!list) return;
    try {
        const response = await fetch('api/pending_claims.php');
        const data = await response.json();
        if (!data.success) throw new Error(data.message);
        if (!data.claims.length) {
            list.innerHTML = '<div class="col-span-full bg-white rounded-3xl p-10 text-center text-slate-500 shadow-sm">No pending participant claims.</div>';
            return;
        }
        list.innerHTML = data.claims.map(claim => `
            <article class="bg-white rounded-3xl p-6 border border-slate-100 shadow-sm flex flex-col">
                <span class="bg-amber-50 text-amber-700 text-[10px] font-black px-3 py-1 rounded-full uppercase tracking-widest border border-amber-200 w-fit">Pending</span>
                <h3 class="text-xl font-bold text-slate-900 mt-5">${escapeHtml(claim.user_code)}</h3>
                <p class="text-sm text-emerald-600 font-bold mb-4 uppercase">${escapeHtml(claim.activity_type)} · ${claim.requested_points} pts</p>
                ${claim.proof_path ? `<img src="../${encodeURI(claim.proof_path)}" alt="Submitted proof" class="w-full h-40 object-cover rounded-2xl mb-4 border border-slate-200">` : ''}
                <p class="text-slate-600 text-sm mb-5 flex-grow bg-slate-50 p-4 rounded-2xl">${escapeHtml(claim.notes || 'No additional notes.')}</p>
                <div class="flex gap-3">
                    <button onclick="reviewClaim(${claim.submission_id}, 'rejected')" class="flex-1 bg-slate-100 hover:bg-red-50 text-slate-700 font-bold py-3 rounded-xl">Reject</button>
                    <button onclick="reviewClaim(${claim.submission_id}, 'approved')" class="flex-1 bg-emerald-600 hover:bg-emerald-700 text-white font-bold py-3 rounded-xl">Approve</button>
                </div>
            </article>`).join('');
    } catch (error) {
        list.innerHTML = `<div class="col-span-full text-red-600">${escapeHtml(error.message || 'Could not load claims.')}</div>`;
    }
}

async function reviewClaim(submissionId, decision) {
    if (!confirm(`Mark this claim as ${decision}?`)) return;
    const form = new FormData();
    form.append('submission_id', submissionId);
    form.append('decision', decision);
    try {
        const response = await fetch('api/review_claim.php', { method: 'POST', body: form });
        const data = await response.json();
        if (!data.success) throw new Error(data.message);
        showNotification(decision === 'approved' ? 'Claim approved!' : 'Claim rejected', data.message, decision);
        loadPendingClaims();
        loadClaimHistory();
    } catch (error) {
        showNotification('Could not save review', error.message || 'Please try again.', 'reject');
    }
}

// 1. Live Header Clock Function
function updateHeaderClock() {
    const clockElement = document.getElementById('live-clock');
    if (!clockElement) return;
    const now = new Date();
    clockElement.textContent = now.toLocaleDateString([], { month: 'short', day: 'numeric' }) + ' • ' + now.toLocaleTimeString([], { hour: '2-digit', minute: '2-digit' });
}

// 2. Relative Card Time Calculations
function updateCardRelativeTimes() {
    document.querySelectorAll('.text-xs[data-offset-minutes]').forEach(el => {
        const mins = parseInt(el.getAttribute('data-offset-minutes'));
        const time = new Date(Date.now() - (mins * 60000));
        el.textContent = time.toLocaleTimeString([], { hour: '2-digit', minute: '2-digit' });
    });
}

// 3. Notification Toast Engine
function showNotification(title, message, status) {
    const container = document.getElementById('toast-container');
    if (!container) return;
    
    const toast = document.createElement('div');
    toast.className = `bg-white border-l-4 ${status === 'approve' ? 'border-emerald-500' : 'border-red-500'} shadow-xl rounded-2xl p-4 min-w-[300px] pointer-events-auto transform transition-all translate-x-0 opacity-100`;
    
    toast.innerHTML = `
        <div class="font-black text-sm text-slate-800">${title}</div>
        <div class="text-xs text-slate-500">${message}</div>
    `;

    container.appendChild(toast);

    setTimeout(() => {
        toast.classList.add('translate-x-full', 'opacity-0');
        setTimeout(() => toast.remove(), 300);
    }, 3000);
}

// 4. Claim Action Handler (Approve / Reject)
function handleClaimAction(modalId, cardId, participantId, action) {
    const modal = document.getElementById(modalId);
    if (modal) {
        modal.classList.add('hidden');
    }
    
    const card = document.getElementById(cardId);
    if (card) {
        card.classList.add('opacity-0', 'scale-90');
        setTimeout(() => card.remove(), 300);
    }
    
    showNotification(
        action === 'approve' ? 'Claim Approved!' : 'Claim Rejected', 
        `Action for ${participantId} completed.`, 
        action
    );
}
