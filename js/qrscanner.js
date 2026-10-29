// qrscanner.js — Manages scanning simulations, dynamic list insertions, and notifications

document.addEventListener('DOMContentLoaded', () => {
    const simulateScanBtn = document.getElementById('simulateScanBtn');
    const scanLogContainer = document.getElementById('scanLogContainer');
    const manualEntryBtn = document.getElementById('manualEntryBtn');

    // List of simulated participants for scanning tests
    const sampleParticipants = [
        { id: "P-88392", event: "Zero-Waste Workshop (+80 Pts)" },
        { id: "P-44210", event: "Campus Tree Planting (+150 Pts)" },
        { id: "P-90211", event: "Solar Panel Q&A Session (+120 Pts)" },
        { id: "P-33104", event: "Eco-Gifting Fair Entry (+50 Pts)" }
    ];

    // Dynamic Toast Notification Generator
    function showToast(message, type = 'success') {
        const existingToast = document.getElementById('notificationToast');
        if (existingToast) existingToast.remove();

        const toast = document.createElement('div');
        toast.id = 'notificationToast';
        toast.className = `fixed bottom-6 right-6 z-50 px-5 py-3 rounded-2xl shadow-xl text-xs font-black text-white flex items-center gap-3 transform translate-y-10 opacity-0 transition-all duration-300 ${
            type === 'success' ? 'bg-emerald-900 border-2 border-emerald-500' : 'bg-gray-800 border-2 border-gray-600'
        }`;
        
        toast.innerHTML = `<i class="fa-solid fa-circle-check text-emerald-400 text-base"></i> ${message}`;
        document.body.appendChild(toast);
        
        setTimeout(() => toast.classList.remove('translate-y-10', 'opacity-0'), 50);
        setTimeout(() => {
            toast.classList.add('translate-y-10', 'opacity-0');
            setTimeout(() => toast.remove(), 300);
        }, 3000);
    }

    // Simulate Scan Interaction
    simulateScanBtn.addEventListener('click', () => {
        // Randomly pick a sample participant
        const randomIndex = Math.floor(Math.random() * sampleParticipants.length);
        const participant = sampleParticipants[randomIndex];

        // Create new log item element
        const newLogItem = document.createElement('div');
        newLogItem.className = 'flex items-center justify-between bg-emerald-50/70 p-3.5 rounded-2xl border-2 border-emerald-200 shadow-2xs animate-pulse';
        newLogItem.innerHTML = `
            <div class="flex items-center gap-3">
                <div class="w-9 h-9 rounded-xl bg-emerald-200 text-emerald-900 flex items-center justify-center font-bold text-sm">
                    <i class="fa-solid fa-user-check"></i>
                </div>
                <div>
                    <p class="font-black text-emerald-950 text-xs">Participant: ${participant.id}</p>
                    <p class="text-[11px] text-emerald-700 font-semibold">${participant.event}</p>
                </div>
            </div>
            <span class="text-emerald-600 text-sm font-bold bg-white p-2 rounded-xl border border-emerald-200 shadow-2xs"><i class="fa-solid fa-circle-check"></i></span>
        `;

        // Prepend to the log container
        scanLogContainer.prepend(newLogItem);
        setTimeout(() => newLogItem.classList.remove('animate-pulse'), 1000);

        showToast(`Successfully verified: ${participant.id}!`, 'success');
    });

    // Manual Entry Mode Trigger
    manualEntryBtn.addEventListener('click', () => {
        const manualId = prompt("Enter Participant ID manually (e.g., P-XXXXX):");
        if (manualId && manualId.trim() !== "") {
            const cleanId = manualId.trim().toUpperCase();
            
            const newLogItem = document.createElement('div');
            newLogItem.className = 'flex items-center justify-between bg-emerald-50/70 p-3.5 rounded-2xl border-2 border-emerald-200 shadow-2xs';
            newLogItem.innerHTML = `
                <div class="flex items-center gap-3">
                    <div class="w-9 h-9 rounded-xl bg-teal-200 text-teal-900 flex items-center justify-center font-bold text-sm">
                        <i class="fa-solid fa-keyboard"></i>
                    </div>
                    <div>
                        <p class="font-black text-emerald-950 text-xs">Participant: ${cleanId} <span class="text-[9px] uppercase bg-emerald-200 px-1.5 py-0.5 rounded text-emerald-900 ml-1">Manual</span></p>
                        <p class="text-[11px] text-emerald-700 font-semibold">General Attendance Entry (+100 Pts)</p>
                    </div>
                </div>
                <span class="text-emerald-600 text-sm font-bold bg-white p-2 rounded-xl border border-emerald-200 shadow-2xs"><i class="fa-solid fa-circle-check"></i></span>
            `;

            scanLogContainer.prepend(newLogItem);
            showToast(`Manually registered ${cleanId} successfully!`, 'success');
        }
    });
});