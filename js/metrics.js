// metrics.js

function updateRealtimeClock() {
    const now = new Date();
    
    // Format Date (e.g., Aug 19, 2026)
    const dateOptions = { year: 'numeric', month: 'short', day: '2-digit' };
    const dateElement = document.getElementById('realtime-date');
    if (dateElement) {
        dateElement.textContent = now.toLocaleDateString('en-US', dateOptions);
    }
    
    // Format Time (e.g., 12:43:29 AM)
    const timeOptions = { hour: '2-digit', minute: '2-digit', second: '2-digit', hour12: true };
    const clockElement = document.getElementById('realtime-clock');
    if (clockElement) {
        clockElement.textContent = now.toLocaleTimeString('en-US', timeOptions);
    }
}

// Initialize and update every second
updateRealtimeClock();
setInterval(updateRealtimeClock, 1000);

// Handle Save UI Feedback (triggered if phpSaved flag is true)
document.addEventListener('DOMContentLoaded', () => {
    if (typeof phpSaved !== 'undefined' && phpSaved) {
        const submitBtn = document.querySelector('button[type="submit"]');
        if (submitBtn) {
            const originalText = submitBtn.innerHTML;
            
            submitBtn.innerHTML = `<i class="fa-solid fa-check"></i> Saved Successfully!`;
            submitBtn.classList.remove('bg-emerald-600', 'hover:bg-emerald-700');
            submitBtn.classList.add('bg-green-700');

            setTimeout(() => {
                submitBtn.innerHTML = originalText;
                submitBtn.classList.remove('bg-green-700');
                submitBtn.classList.add('bg-emerald-600', 'hover:bg-emerald-700');
            }, 2000);
        }
    }
});