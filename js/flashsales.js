// flashsale.js — Flash sale timers, form management, and toast notifications

document.addEventListener('DOMContentLoaded', () => {
    // Set an initial target end time for the default active sale (4 hours, 15 minutes, 30 seconds from now)
    const defaultEndTime = new Date().getTime() + (4 * 3600 * 1000) + (15 * 60 * 1000) + (30 * 1000);
    const initialTimer = document.querySelector('.countdown-timer');
    if (initialTimer) {
        initialTimer.setAttribute('data-endtime', defaultEndTime);
    }

    // Run countdown loop immediately and every 1000ms
    updateCountdowns();
    setInterval(updateCountdowns, 1000);

    // Form Submission to add new item dynamically with working countdown
    const saleForm = document.getElementById('sale-form');
    if (saleForm) {
        saleForm.addEventListener('submit', function(e) {
            e.preventDefault();

            const itemName = document.getElementById('item-select').value;
            const salePrice = document.getElementById('sale-price').value;
            const endTimeInput = document.getElementById('end-time').value;

            if (!endTimeInput) {
                showToast('Please specify an end date and time.', 'error');
                return;
            }

            const customEndTime = new Date(endTimeInput).getTime();
            const salesList = document.getElementById('sales-list');

            // Create new sale element card with fancy styling
            const newCard = document.createElement('div');
            newCard.className = "bg-gradient-to-r from-emerald-50/40 to-white border border-emerald-100 border-l-4 border-l-emerald-500 p-5 rounded-2xl shadow-sm hover:shadow-md transition-all flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 transform translate-y-2 opacity-0";
            newCard.innerHTML = `
                <div>
                    <span class="bg-emerald-100 text-emerald-800 text-[10px] font-extrabold uppercase px-2.5 py-1 rounded-md tracking-wider inline-flex items-center gap-1.5 shadow-2xs">
                        <span class="w-1.5 h-1.5 rounded-full bg-emerald-600 animate-pulse"></span> Live Now
                    </span>
                    <h3 class="font-extrabold text-lg text-gray-900 mt-2">${itemName}</h3>
                    <p class="text-sm text-gray-500 mt-0.5">Price: <del class="text-gray-400 font-mono">500 Pts</del> <span class="font-bold text-emerald-700 font-mono">${salePrice} Pts</span></p>
                </div>
                <div class="text-right bg-white p-4 rounded-2xl border border-emerald-100/80 shadow-xs min-w-[160px] w-full sm:w-auto flex sm:block justify-between items-center">
                    <p class="text-[10px] font-bold text-gray-400 uppercase tracking-wider mb-0.5">Ends In:</p>
                    <p class="text-xl font-mono font-extrabold text-emerald-900 countdown-timer tracking-wider" data-endtime="${customEndTime}">--:--:--</p>
                </div>
            `;

            salesList.prepend(newCard);
            
            // Animate card entry
            setTimeout(() => {
                newCard.classList.remove('translate-y-2', 'opacity-0');
            }, 10);

            showToast(`Successfully queued flash sale for ${itemName}!`);
            this.reset();
            updateCountdowns();
        });
    }
});

// Toast Notification System
function showToast(message, type = 'success') {
    const container = document.getElementById('toast-container');
    if (!container) return;
    
    const toast = document.createElement('div');
    const bgColor = type === 'success' ? 'bg-emerald-900/90 text-white border-emerald-700' : 'bg-red-900/90 text-white border-red-700';
    const icon = type === 'success' ? 'fa-circle-check text-emerald-400' : 'fa-circle-exclamation text-red-400';

    toast.className = `pointer-events-auto flex items-center gap-3 px-5 py-4 rounded-2xl shadow-2xl backdrop-blur-xl border ${bgColor} transform translate-y-2 opacity-0 transition-all duration-300 font-medium text-sm`;
    toast.innerHTML = `<i class="fa-solid ${icon} text-lg"></i><span>${message}</span>`;
    
    container.appendChild(toast);
    
    setTimeout(() => {
        toast.classList.remove('translate-y-2', 'opacity-0');
    }, 10);

    setTimeout(() => {
        toast.classList.add('translate-y-2', 'opacity-0');
        setTimeout(() => toast.remove(), 300);
    }, 3500);
}

// Global Countdown Loop logic
function updateCountdowns() {
    const timers = document.querySelectorAll('.countdown-timer');
    
    timers.forEach(timer => {
        const endTimeAttr = timer.getAttribute('data-endtime');
        if (!endTimeAttr) return;

        const endTime = parseInt(endTimeAttr);
        const now = new Date().getTime();
        const distance = endTime - now;

        if (distance < 0) {
            timer.textContent = "EXPIRED";
            timer.classList.add('text-red-500');
            return;
        }

        // Calculate hours, minutes, seconds
        const hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
        const minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
        const seconds = Math.floor((distance % (1000 * 60)) / 1000);

        // Format with leading zeros
        const formattedHours = String(hours).padStart(2, '0');
        const formattedMinutes = String(minutes).padStart(2, '0');
        const formattedSeconds = String(seconds).padStart(2, '0');

        timer.textContent = `${formattedHours}:${formattedMinutes}:${formattedSeconds}`;
    });
}