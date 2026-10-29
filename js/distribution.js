// distribution.js — Handles voucher code lookups, fulfillment confirmations, and toast alerts

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

function handleSearch() {
    const input = document.getElementById('voucher-input').value.trim();
    if(!input) {
        showNotification('Notice', 'Please type a valid voucher code.');
        return;
    }
    verifyVoucher(input);
}

let currentDistribution = null;
async function verifyVoucher(code) {
    try { const form=new FormData(); form.append('voucher_code',code); form.append('action','verify'); const response=await fetch('api/distribution.php',{method:'POST',body:form}); const data=await response.json(); if(!data.success) throw new Error(data.message); currentDistribution=data.distribution; document.querySelector('#result-card h3').textContent=currentDistribution.reward_name; document.querySelector('#result-card p span').textContent=currentDistribution.participant_code || 'Not recorded'; document.getElementById('result-card').style.display='block'; showNotification('Voucher saved', data.message); loadDistributionHistory(); } catch(error) { showNotification('Could not verify voucher',error.message); }
}

function confirmCollection() {
    if (!currentDistribution) { showNotification('Notice', 'Search and save a voucher first.'); return; }
    collectVoucher();
}
async function collectVoucher() {
    try { const form=new FormData(); form.append('distribution_id',currentDistribution.distribution_id); form.append('action','collect'); const response=await fetch('api/distribution.php',{method:'POST',body:form}); const data=await response.json(); if(!data.success) throw new Error(data.message); showNotification('Item collection saved!',data.message);
    const card = document.getElementById('result-card');
    card.classList.add('opacity-0', 'scale-95');
    setTimeout(() => {
        card.style.display = 'none';
        document.getElementById('voucher-input').value = '';
    }, 300);
        currentDistribution=null; loadDistributionHistory();
    } catch(error) { showNotification('Could not save collection',error.message); }
}

async function loadDistributionHistory() {
    try { const response=await fetch('api/distribution.php'); const data=await response.json(); if(!data.success) throw new Error(data.message); let history=document.getElementById('distribution-history'); if(!history){history=document.createElement('section');history.id='distribution-history';history.className='w-full max-w-2xl mx-auto bg-white rounded-3xl p-6 border-2 border-emerald-200';document.querySelector('main').after(history);} history.innerHTML=`<h2 class="font-black text-emerald-950 mb-3">Distribution history</h2>${data.history.length?data.history.map(x=>`<p class="text-sm border-t border-emerald-100 py-2"><strong>${x.voucher_code}</strong> · ${x.reward_name} · ${x.status} · ${x.verified_at}</p>`).join(''):'<p class="text-sm text-slate-500">No voucher transactions saved yet.</p>'}`; }catch(error){console.error(error);}
}

document.addEventListener('DOMContentLoaded', () => {
    loadDistributionHistory();
    const searchBtn = document.getElementById('searchBtn');
    const confirmBtn = document.getElementById('confirmBtn');

    if(searchBtn) {
        searchBtn.addEventListener('click', handleSearch);
    }

    if(confirmBtn) {
        confirmBtn.addEventListener('click', confirmCollection);
    }

    const voucherInput = document.getElementById('voucher-input');
    if(voucherInput) {
        voucherInput.addEventListener('keypress', (e) => {
            if(e.key === 'Enter') {
                handleSearch();
            }
        });
    }
});
