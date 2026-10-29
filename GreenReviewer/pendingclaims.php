<?php
// PHP processing state for pending claims can be handled here if needed
$system_name = "EcoRewards Pending Claims Queue";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pending Claims | EcoRewards</title>
    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- FontAwesome Icons -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <!-- Custom External CSS -->
    <link href="claimsstyle.css" rel="stylesheet">
</head>
<body class="bg-slate-50 font-sans min-h-screen text-slate-900 selection:bg-emerald-200">

    <!-- Toast Container -->
    <div id="toast-container" class="fixed top-5 right-5 z-50 flex flex-col gap-3 pointer-events-none"></div>

    <!-- Header -->
    <header class="sticky top-0 z-30 bg-white/80 backdrop-blur-md border-b border-slate-200 px-8 py-5 flex justify-between items-center shadow-sm">
        <div class="flex items-center gap-6">
            <a href="viewerdashboard.php" class="bg-slate-100 hover:bg-emerald-100 text-slate-600 hover:text-emerald-700 p-3 rounded-2xl transition flex items-center justify-center w-12 h-12 border border-slate-200">
                <i class="fa-solid fa-arrow-left text-lg"></i>
            </a>
            <div>
                <h2 class="text-2xl font-black text-slate-800 tracking-tight">Pending Claims Queue</h2>
                <p class="text-slate-500 text-sm font-medium">Verify submissions for reward issuance.</p>
            </div>
        </div>

        <div class="flex items-center gap-4">
            <div class="hidden sm:flex items-center gap-2 bg-slate-100 px-4 py-2 rounded-full text-xs font-bold text-slate-600 border border-slate-200">
                <i class="fa-solid fa-clock text-emerald-600"></i>
                <span id="live-clock">--:--:--</span>
            </div>
            <div class="relative">
                <input type="text" placeholder="Search ID..." class="bg-slate-100 border border-slate-200 rounded-full py-2 px-5 pl-10 focus:outline-none focus:ring-2 focus:ring-emerald-500 w-64 text-sm shadow-inner transition">
                <i class="fa-solid fa-search absolute left-4 top-2.5 text-slate-400"></i>
            </div>
        </div>
    </header>

    <!-- Main Content -->
    <main id="claims-list" class="p-8 grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
        
        <!-- Claim Card 1 -->
        <div id="card-PT001" class="group bg-white rounded-3xl p-6 border border-slate-100 shadow-sm hover:shadow-2xl transition-all hover:-translate-y-2 flex flex-col relative overflow-hidden">
            <div class="absolute top-0 right-0 p-4 opacity-50"><i class="fa-solid fa-recycle text-4xl text-emerald-100"></i></div>
            
            <div class="flex justify-between items-center mb-6">
                <span class="bg-amber-50 text-amber-700 text-[10px] font-black px-3 py-1 rounded-full uppercase tracking-widest border border-amber-200">Pending</span>
                <span class="text-xs text-slate-400 font-mono" data-offset-minutes="10">Calculating...</span>
            </div>
            <h3 class="text-xl font-bold text-slate-900 mb-1">PT001</h3>
            <p class="text-sm text-emerald-600 font-bold mb-4 uppercase tracking-wide">Community E-Waste</p>
            <p class="text-slate-600 text-sm mb-6 flex-grow bg-slate-50 p-4 rounded-2xl italic">"Dropped off an old laptop and 3 broken chargers..."</p>
            
            <button onclick="document.getElementById('review-modal-1').classList.remove('hidden')" class="w-full bg-slate-900 hover:bg-emerald-700 text-white font-bold py-3 px-4 rounded-xl transition shadow-lg hover:shadow-emerald-500/20 cursor-pointer">
                Verify Evidence
            </button>
        </div>

        <!-- Claim Card 2 -->
        <div id="card-PT002" class="group bg-white rounded-3xl p-6 border border-slate-100 shadow-sm hover:shadow-2xl transition-all hover:-translate-y-2 flex flex-col relative overflow-hidden">
            <div class="absolute top-0 right-0 p-4 opacity-50"><i class="fa-solid fa-car text-4xl text-emerald-100"></i></div>

            <div class="flex justify-between items-center mb-6">
                <span class="bg-amber-50 text-amber-700 text-[10px] font-black px-3 py-1 rounded-full uppercase tracking-widest border border-amber-200">Pending</span>
                <span class="text-xs text-slate-400 font-mono" data-offset-minutes="60">Calculating...</span>
            </div>
            <h3 class="text-xl font-bold text-slate-900 mb-1">PT002</h3>
            <p class="text-sm text-emerald-600 font-bold mb-4 uppercase tracking-wide">Carpool Session</p>
            <p class="text-slate-600 text-sm mb-6 flex-grow bg-slate-50 p-4 rounded-2xl italic">"Carpool log attached. Drove 4 participants to the main event hall..."</p>

            <button onclick="document.getElementById('review-modal-2').classList.remove('hidden')" class="w-full bg-slate-900 hover:bg-emerald-700 text-white font-bold py-3 px-4 rounded-xl transition shadow-lg hover:shadow-emerald-500/20 cursor-pointer">
                Verify Evidence
            </button>
        </div>
    </main>

    <!-- Modals -->
    <div id="review-modal-1" class="fixed inset-0 bg-slate-900/40 backdrop-blur-sm hidden flex items-center justify-center z-50 p-4">
        <div class="bg-white rounded-3xl shadow-2xl w-full max-w-lg overflow-hidden animate-in fade-in zoom-in duration-300">
            <div class="bg-slate-900 text-white p-6 flex justify-between items-center">
                <h3 class="font-bold text-lg">Reviewing: PT001</h3>
                <button onclick="document.getElementById('review-modal-1').classList.add('hidden')" class="hover:text-emerald-400 transition cursor-pointer"><i class="fa-solid fa-times"></i></button>
            </div>
            <div class="p-6">
                <img src="../images/ewaste-bin.jpg" alt="Proof" class="w-full h-64 object-cover rounded-2xl mb-6 shadow-inner">
                <div class="flex gap-3">
                    <button onclick="handleClaimAction('review-modal-1', 'card-PT001', 'PT001', 'reject')" class="flex-1 bg-slate-100 hover:bg-red-50 text-slate-700 font-bold py-3 rounded-xl transition cursor-pointer">Reject</button>
                    <button onclick="handleClaimAction('review-modal-1', 'card-PT001', 'PT001', 'approve')" class="flex-1 bg-emerald-600 hover:bg-emerald-700 text-white font-bold py-3 rounded-xl transition shadow-lg shadow-emerald-500/30 cursor-pointer">Approve</button>
                </div>
            </div>
        </div>
    </div>

    <div id="review-modal-2" class="fixed inset-0 bg-slate-900/40 backdrop-blur-sm hidden flex items-center justify-center z-50 p-4">
        <div class="bg-white rounded-3xl shadow-2xl w-full max-w-lg overflow-hidden animate-in fade-in zoom-in duration-300">
            <div class="bg-slate-900 text-white p-6 flex justify-between items-center">
                <h3 class="font-bold text-lg">Reviewing: PT002</h3>
                <button onclick="document.getElementById('review-modal-2').classList.add('hidden')" class="hover:text-emerald-400 transition cursor-pointer"><i class="fa-solid fa-times"></i></button>
            </div>
            <div class="p-6">
                <img src="../images/carpool.jpg" alt="Proof" class="w-full h-64 object-cover rounded-2xl mb-6 shadow-inner">
                <div class="flex gap-3">
                    <button onclick="handleClaimAction('review-modal-2', 'card-PT002', 'PT002', 'reject')" class="flex-1 bg-slate-100 hover:bg-red-50 text-slate-700 font-bold py-3 rounded-xl transition cursor-pointer">Reject</button>
                    <button onclick="handleClaimAction('review-modal-2', 'card-PT002', 'PT002', 'approve')" class="flex-1 bg-emerald-600 hover:bg-emerald-700 text-white font-bold py-3 rounded-xl transition shadow-lg shadow-emerald-500/30 cursor-pointer">Approve</button>
                </div>
            </div>
        </div>
    </div>

    <!-- External JavaScript File -->
    <script src="pendingclaims.js"></script>
</body>
</html>
