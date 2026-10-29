// inventory.js — Handles real-time clock, modal toggles, validation, row additions, and inventory saves

document.addEventListener('DOMContentLoaded', () => {
    updateHeaderClock();
    setInterval(updateHeaderClock, 1000);
    loadInventory();
});

async function loadInventory() {
    try {
        const response = await fetch('api/inventory.php');
        const data = await response.json();
        if (!data.success) throw new Error(data.message);
        const body = document.getElementById('inventory-table-body');
        body.innerHTML = data.items.map(item => inventoryRow(item)).join('');
        let history = document.getElementById('inventory-history');
        if (!history) { history = document.createElement('section'); history.id = 'inventory-history'; history.className = 'mt-8 bg-white rounded-3xl p-6 border-2 border-emerald-200'; document.querySelector('main').after(history); }
        history.innerHTML = `<h2 class="font-black text-emerald-950 text-lg mb-3">Recent inventory transactions</h2>${data.history.length ? data.history.map(row => `<p class="text-sm text-slate-600 border-t border-emerald-100 py-2"><strong>${row.rewardname || row.reward_id}</strong> was ${row.action_type} by ${row.full_name || 'Reviewer'} · stock ${row.old_quantity ?? '—'} → ${row.new_quantity} · ${row.created_at}</p>`).join('') : '<p class="text-sm text-slate-500">No saved inventory changes yet.</p>'}`;
    } catch (error) { showToast('Could not load inventory', error.message); }
}

function inventoryRow(item) {
    const visible = Number(item.quantity) > 0;
    return `<tr class="inventory-row hover:bg-emerald-50/40 transition-colors" data-reward-id="${item.rewardid}"><td class="px-6 py-5 border-b-2 border-emerald-100 bg-white text-sm"><div class="ml-4"><p class="item-name text-emerald-950 font-black text-base">${item.rewardname}</p><p class="item-category text-emerald-700 font-bold text-xs uppercase tracking-wide">${item.category || 'Product'}</p></div></td><td class="px-6 py-5 border-b-2 border-emerald-100 bg-white"><input type="number" min="0" value="${item.pointsrequired}" class="cost-input integer-only w-32 border-2 border-emerald-200 rounded-xl px-3 py-2 font-black"></td><td class="px-6 py-5 border-b-2 border-emerald-100 bg-white"><input type="number" min="0" value="${item.quantity}" class="stock-input integer-only w-28 border-2 border-emerald-200 rounded-xl px-3 py-2 font-black"></td><td class="px-6 py-5 border-b-2 border-emerald-100 bg-white status-cell">${visible ? 'Visible' : 'Hidden (Out of Stock)'}</td></tr>`;
}

window.saveInventory = async function saveInventoryToDatabase() {
    const items = [...document.querySelectorAll('.inventory-row')].map(row => ({ id: row.dataset.rewardId || '', name: row.querySelector('.item-name').textContent.trim(), category: row.querySelector('.item-category').textContent.trim(), cost: row.querySelector('.cost-input').value, stock: row.querySelector('.stock-input').value }));
    try {
        const form = new FormData(); form.append('items', JSON.stringify(items));
        const response = await fetch('api/inventory.php', { method: 'POST', body: form }); const data = await response.json();
        if (!data.success) throw new Error(data.message);
        showToast('Inventory Saved', data.message); loadInventory();
    } catch (error) { showToast('Could not save inventory', error.message); }
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

// 2. Modal Controls
function openAddModal() {
    document.getElementById('add-modal').classList.remove('hidden');
}

function closeAddModal() {
    document.getElementById('add-modal').classList.add('hidden');
    document.getElementById('add-item-form').reset();
}

// 3. Integer Input Validation & Formatting
document.addEventListener('input', function (e) {
    if (e.target.classList.contains('integer-only')) {
        e.target.value = e.target.value.replace(/[^0-9]/g, '');
        if (e.target.value === '') {
            e.target.value = 0;
        }
        e.target.value = parseInt(e.target.value, 10);
    }
});

document.addEventListener('keydown', function (e) {
    if (e.target.classList.contains('integer-only')) {
        if (['e', 'E', '.', ',', '-', '+'].includes(e.key)) {
            e.preventDefault();
        }
    }
});

// 4. Add New Item Functionality
function addNewItem(event) {
    event.preventDefault();

    const name = document.getElementById('new-name').value;
    const category = document.getElementById('new-cat').value;
    const cost = parseInt(document.getElementById('new-cost').value, 10) || 0;
    const stock = parseInt(document.getElementById('new-stock').value, 10) || 0;

    const isVisible = stock > 0;
    const badgeHTML = isVisible 
        ? `<span class="inline-flex items-center gap-1.5 bg-emerald-100 text-emerald-800 py-1.5 px-3.5 rounded-full text-xs font-black uppercase tracking-wider border-2 border-emerald-300 shadow-inner"><i class="fa-solid fa-circle-check text-emerald-600"></i> Visible</span>`
        : `<span class="inline-flex items-center gap-1.5 bg-red-100 text-red-800 py-1.5 px-3.5 rounded-full text-xs font-black uppercase tracking-wider border-2 border-red-300 shadow-inner"><i class="fa-solid fa-triangle-exclamation text-red-600"></i> Hidden (Out of Stock)</span>`;

    const stockInputClasses = isVisible
        ? "stock-input integer-only w-28 border-2 border-emerald-200 bg-emerald-50/30 rounded-xl px-3 py-2 font-black text-emerald-950 focus:border-emerald-600 focus:bg-white outline-none transition shadow-inner"
        : "stock-input integer-only w-28 border-2 border-red-300 bg-red-50 rounded-xl px-3 py-2 font-black text-red-700 focus:border-red-500 focus:bg-white outline-none transition shadow-inner";

    const newRowHTML = `
        <tr class="inventory-row hover:bg-emerald-50/40 transition-colors" data-reward-id="">
            <td class="px-6 py-5 border-b-2 border-emerald-100 bg-white text-sm">
                <div class="flex items-center">
                    <div class="flex-shrink-0 w-12 h-12 bg-emerald-100 text-emerald-800 rounded-2xl border-2 border-emerald-200 flex items-center justify-center shadow-inner">
                        <i class="fa-solid fa-box text-base"></i>
                    </div>
                    <div class="ml-4">
                        <p class="item-name text-emerald-950 font-black text-base">${name}</p>
                        <p class="item-category text-emerald-700 font-bold text-xs uppercase tracking-wide">${category}</p>
                    </div>
                </div>
            </td>
            <td class="px-6 py-5 border-b-2 border-emerald-100 bg-white text-sm font-black">
                <input type="number" step="1" min="0" value="${cost}" class="cost-input integer-only w-32 border-2 border-emerald-200 bg-emerald-50/30 rounded-xl px-3 py-2 font-black text-emerald-950 focus:border-emerald-600 focus:bg-white outline-none transition shadow-inner">
            </td>
            <td class="px-6 py-5 border-b-2 border-emerald-100 bg-white text-sm">
                <input type="number" step="1" min="0" value="${stock}" class="${stockInputClasses}">
            </td>
            <td class="px-6 py-5 border-b-2 border-emerald-100 bg-white text-sm status-cell">
                ${badgeHTML}
            </td>
        </tr>
    `;

    document.getElementById('inventory-table-body').insertAdjacentHTML('beforeend', newRowHTML);
    closeAddModal();
    showToast("Item Added", `"${name}" has been added to inventory.`);
}

// 5. Save All Inventory Changes
function saveInventory() {
    const rows = document.querySelectorAll('.inventory-row');
    
    rows.forEach(row => {
        const stockInput = row.querySelector('.stock-input');
        const statusCell = row.querySelector('.status-cell');
        const stockVal = parseInt(stockInput.value, 10) || 0;

        if (stockVal > 0) {
            statusCell.innerHTML = `<span class="inline-flex items-center gap-1.5 bg-emerald-100 text-emerald-800 py-1.5 px-3.5 rounded-full text-xs font-black uppercase tracking-wider border-2 border-emerald-300 shadow-inner"><i class="fa-solid fa-circle-check text-emerald-600"></i> Visible</span>`;
            stockInput.className = "stock-input integer-only w-28 border-2 border-emerald-200 bg-emerald-50/30 rounded-xl px-3 py-2 font-black text-emerald-950 focus:border-emerald-600 focus:bg-white outline-none transition shadow-inner";
        } else {
            statusCell.innerHTML = `<span class="inline-flex items-center gap-1.5 bg-red-100 text-red-800 py-1.5 px-3.5 rounded-full text-xs font-black uppercase tracking-wider border-2 border-red-300 shadow-inner"><i class="fa-solid fa-triangle-exclamation text-red-600"></i> Hidden (Out of Stock)</span>`;
            stockInput.className = "stock-input integer-only w-28 border-2 border-red-300 bg-red-50 rounded-xl px-3 py-2 font-black text-red-700 focus:border-red-500 focus:bg-white outline-none transition shadow-inner";
        }
    });

    showToast("Inventory Saved", "Item costs and stock counts updated successfully!");
}

// 6. Notification Toast Engine
function showToast(title, message) {
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

    setTimeout(() => {
        toast.classList.remove('translate-x-full', 'opacity-0');
    }, 50);

    setTimeout(() => {
        toast.classList.add('translate-x-full', 'opacity-0');
        setTimeout(() => toast.remove(), 300);
    }, 3500);
}
