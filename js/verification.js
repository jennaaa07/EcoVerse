// verification.js — Client-side interaction logic

function showToast(message, type = 'success') {
    const container = document.getElementById('toast-container');
    const toast = document.createElement('div');
    
    toast.className = `pointer-events-auto flex items-center gap-3 px-5 py-4 rounded-2xl shadow-2xl backdrop-blur-xl border bg-emerald-900/90 text-white border-emerald-700 transform translate-y-2 opacity-0 transition-all duration-300 font-medium text-sm`;
    toast.innerHTML = `<i class="fa-solid fa-circle-check text-emerald-400 text-lg"></i><span>${message}</span>`;
    
    container.appendChild(toast);
    
    setTimeout(() => {
        toast.classList.remove('translate-y-2', 'opacity-0');
    }, 10);

    setTimeout(() => {
        toast.classList.add('translate-y-2', 'opacity-0');
        setTimeout(() => toast.remove(), 300);
    }, 3500);
}

// 1. Search filter functionality
document.addEventListener('DOMContentLoaded', () => {
    const searchInput = document.getElementById('searchInput');
    const rows = document.querySelectorAll('#tableBody tr');

    if (searchInput) {
        searchInput.addEventListener('keyup', function() {
            const val = searchInput.value.toLowerCase();
            rows.forEach(row => {
                const text = row.innerText.toLowerCase();
                row.style.display = text.includes(val) ? '' : 'none';
            });
        });
    }
});

// 2. Modal Management Logic
let activeTxRow = null;

function openModal(txId, senderDetails, amount, currentStatus) {
    activeTxRow = document.querySelector(`tr[data-id="${txId}"]`);
    document.getElementById('modalTxId').innerText = txId;
    document.getElementById('modalTxDetails').innerText = `${senderDetails} — Amount: ${amount}`;
    document.getElementById('modalNotes').value = '';
    
    const select = document.getElementById('modalStatusSelect');
    if(currentStatus.includes('High Risk')) select.value = 'High Risk';
    else if(currentStatus.includes('Pending')) select.value = 'Pending Audit';
    else select.value = 'Verified';

    const modal = document.getElementById('auditModal');
    const content = document.getElementById('auditModalContent');
    modal.classList.remove('hidden');
    setTimeout(() => {
        modal.classList.remove('opacity-0');
        content.classList.remove('scale-95');
        content.classList.add('scale-100');
    }, 10);
}

function closeModal() {
    const modal = document.getElementById('auditModal');
    const content = document.getElementById('auditModalContent');
    modal.classList.add('opacity-0');
    content.classList.remove('scale-100');
    content.classList.add('scale-95');
    setTimeout(() => {
        modal.classList.add('hidden');
        activeTxRow = null;
    }, 300);
}

function saveAudit() {
    if (!activeTxRow) return;
    const newStatus = document.getElementById('modalStatusSelect').value;
    const statusCell = activeTxRow.querySelector('.status-cell');
    
    // Update UI Badge dynamically
    if(newStatus === 'Verified') {
        statusCell.innerHTML = `<span class="bg-emerald-100 text-emerald-800 px-2.5 py-1 rounded-xl text-[10px] font-extrabold border border-emerald-200/80 shadow-2xs">Verified</span>`;
        activeTxRow.classList.remove('bg-red-50/40');
    } else if(newStatus === 'High Risk') {
        statusCell.innerHTML = `<span class="bg-red-100 text-red-700 px-2.5 py-1 rounded-xl text-[10px] font-extrabold border border-red-200/80 inline-flex items-center gap-1 shadow-2xs"><i class="fa-solid fa-flag text-xs"></i> High Risk</span>`;
        activeTxRow.classList.add('bg-red-50/40');
    } else {
        statusCell.innerHTML = `<span class="bg-amber-100 text-amber-800 px-2.5 py-1 rounded-xl text-[10px] font-extrabold border border-amber-200/80 shadow-2xs">Pending Audit</span>`;
        activeTxRow.classList.remove('bg-red-50/40');
    }

    showToast('Audit decision saved successfully!');
    closeModal();
}

// 3. Freeze account button toggle logic
function toggleFreeze(button) {
    if(button.innerText === 'Freeze') {
        button.innerText = 'Unfreeze';
        button.classList.add('bg-amber-100', 'text-amber-800', 'border-amber-300');
        showToast('Account has been frozen successfully.');
    } else {
        button.innerText = 'Freeze';
        button.classList.remove('bg-amber-100', 'text-amber-800', 'border-amber-300');
        showToast('Account restriction lifted.');
    }
}