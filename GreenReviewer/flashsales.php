<?php
// PHP processing state for flash sales can be handled here if needed
$engine_version = "v2.4";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Flash-Sale Automation - Reviewer</title>
    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- FontAwesome Icons -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <!-- Custom External CSS -->
    <link href="style.css" rel="stylesheet">
</head>
<body class="bg-gradient-to-br from-emerald-50 via-teal-50/30 to-white font-sans min-h-screen text-gray-800 antialiased selection:bg-emerald-500 selection:text-white relative overflow-x-hidden">

    <!-- Ambient Background Glow Effects -->
    <div class="absolute top-0 left-1/4 w-96 h-96 bg-emerald-300/15 rounded-full blur-3xl pointer-events-none"></div>
    <div class="absolute bottom-10 right-10 w-96 h-96 bg-teal-300/15 rounded-full blur-3xl pointer-events-none"></div>

    <!-- Toast Notification Container -->
    <div id="toast-container" class="fixed top-20 right-6 z-50 flex flex-col gap-3 pointer-events-none"></div>

    <!-- Header -->
    <header class="bg-white/80 backdrop-blur-xl px-8 py-5 flex justify-between items-center border-b border-emerald-100/80 sticky top-0 z-30 shadow-xs">
        <div class="flex items-center gap-4">
            <a href="viewerdashboard.php" class="h-10 w-10 flex items-center justify-center rounded-2xl bg-emerald-50 text-emerald-700 hover:bg-emerald-600 hover:text-white transition-all duration-300 shadow-xs border border-emerald-200/60 group" title="Back to Dashboard">
                <i class="fa-solid fa-arrow-left text-base group-hover:-translate-x-0.5 transition-transform"></i>
            </a>
            <div>
                <p class="text-[11px] font-extrabold text-emerald-600 uppercase tracking-widest flex items-center gap-1.5">
                    <span class="w-2 h-2 rounded-full bg-emerald-500 animate-pulse"></span> Reviewer Dashboard
                </p>
                <h1 class="text-2xl font-extrabold text-gray-900 tracking-tight">Flash-Sale Automation</h1>
            </div>
        </div>
        <div class="hidden sm:flex items-center gap-2 bg-emerald-50/80 border border-emerald-200/60 px-4 py-2 rounded-2xl">
            <i class="fa-solid fa-shield-halved text-emerald-600 text-sm"></i>
            <span class="text-xs font-bold text-emerald-900">Automation Engine <?php echo $engine_version; ?></span>
        </div>
    </header>

    <!-- Main Content Container -->
    <main class="px-6 py-10 max-w-7xl mx-auto grid grid-cols-1 lg:grid-cols-3 gap-8 relative z-10">
        
        <!-- Schedule Form (Left Column) -->
        <div class="lg:col-span-1 bg-white/90 backdrop-blur-md rounded-3xl p-8 shadow-xl shadow-emerald-900/5 border border-emerald-100/80 h-fit transition-all hover:shadow-2xl hover:shadow-emerald-900/10">
            <h2 class="text-xl font-extrabold text-gray-900 border-b border-emerald-100 pb-4 mb-6 flex items-center gap-3">
                <div class="w-9 h-9 rounded-xl bg-emerald-100 text-emerald-700 flex items-center justify-center text-sm shadow-inner">
                    <i class="fa-solid fa-bolt"></i>
                </div>
                Schedule New Sale
            </h2>
            <form id="sale-form" class="space-y-5">
                <div>
                    <label class="block text-xs font-bold uppercase tracking-wider text-gray-700 mb-2 flex items-center gap-1.5">
                        <i class="fa-solid fa-gift text-emerald-600"></i> Select Reward Item
                    </label>
                    <select id="item-select" class="w-full px-4 py-3 bg-emerald-50/50 border border-emerald-200/80 rounded-2xl outline-none font-medium text-gray-800 focus:bg-white focus:border-emerald-500 focus:ring-4 focus:ring-emerald-500/10 transition">
                        <option value="RM5 Cafe Voucher">RM5 Cafe Voucher (ID: V-101)</option>
                        <option value="Premium Tumbler">Premium Tumbler (ID: M-202)</option>
                        <option value="Movie Ticket">Movie Ticket (ID: T-303)</option>
                    </select>
                </div>
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="block text-xs font-bold uppercase tracking-wider text-gray-700 mb-2">Original Price</label>
                        <input type="text" value="500 Pts" disabled class="w-full px-3 py-3 bg-gray-100/80 border border-gray-200 rounded-2xl text-gray-400 font-mono text-center font-bold">
                    </div>
                    <div>
                        <label class="block text-xs font-bold uppercase tracking-wider text-gray-700 mb-2">Sale Price</label>
                        <input type="number" id="sale-price" placeholder="350" required class="w-full px-3 py-3 bg-emerald-50/50 border border-emerald-200/80 rounded-2xl outline-none font-mono text-center font-bold text-emerald-900 focus:bg-white focus:border-emerald-500 focus:ring-4 focus:ring-emerald-500/10 transition">
                    </div>
                </div>
                <div>
                    <label class="block text-xs font-bold uppercase tracking-wider text-gray-700 mb-2 flex items-center gap-1.5">
                        <i class="fa-regular fa-calendar-plus text-emerald-600"></i> Start Date & Time
                    </label>
                    <input type="datetime-local" id="start-time" required class="w-full px-4 py-3 bg-emerald-50/50 border border-emerald-200/80 rounded-2xl outline-none font-mono text-xs text-gray-800 focus:bg-white focus:border-emerald-500 focus:ring-4 focus:ring-emerald-500/10 transition">
                </div>
                <div>
                    <label class="block text-xs font-bold uppercase tracking-wider text-gray-700 mb-2 flex items-center gap-1.5">
                        <i class="fa-regular fa-calendar-xmark text-emerald-600"></i> End Date & Time
                    </label>
                    <input type="datetime-local" id="end-time" required class="w-full px-4 py-3 bg-emerald-50/50 border border-emerald-200/80 rounded-2xl outline-none font-mono text-xs text-gray-800 focus:bg-white focus:border-emerald-500 focus:ring-4 focus:ring-emerald-500/10 transition">
                </div>
                <button type="submit" class="w-full bg-emerald-600 hover:bg-emerald-700 text-white font-bold py-3.5 rounded-2xl mt-3 transition-all duration-300 shadow-lg shadow-emerald-600/25 hover:shadow-xl hover:shadow-emerald-600/35 hover:-translate-y-0.5 flex items-center justify-center gap-2 cursor-pointer">
                    <i class="fa-solid fa-plus"></i> Queue Flash Sale
                </button>
            </form>
        </div>

        <!-- Active/Queued Sales List (Right Column) -->
        <div class="lg:col-span-2 bg-white/90 backdrop-blur-md rounded-3xl shadow-xl shadow-emerald-900/5 border border-emerald-100/80 overflow-hidden flex flex-col">
            <div class="p-6 border-b border-emerald-100/80 bg-gradient-to-r from-emerald-50/60 to-transparent flex justify-between items-center">
                <div class="flex items-center gap-3">
                    <div class="w-8 h-8 rounded-xl bg-emerald-200/60 text-emerald-800 flex items-center justify-center text-sm">
                        <i class="fa-solid fa-clock-rotate-left"></i>
                    </div>
                    <h2 class="text-xl font-extrabold text-gray-900">Active & Queued Events</h2>
                </div>
                <span class="text-xs font-extrabold text-emerald-700 bg-emerald-100/80 px-3.5 py-1.5 rounded-full border border-emerald-200 shadow-xs flex items-center gap-1.5">
                    <span class="w-2 h-2 rounded-full bg-emerald-500 animate-ping"></span> Real-Time Sync Active
                </span>
            </div>
            
            <div id="sales-list" class="p-6 space-y-4 flex-grow">
                <!-- Active Sale -->
                <div class="bg-gradient-to-r from-emerald-50/40 to-white border border-emerald-100 border-l-4 border-l-emerald-500 p-5 rounded-2xl shadow-sm hover:shadow-md transition-all flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
                    <div>
                        <span class="bg-emerald-100 text-emerald-800 text-[10px] font-extrabold uppercase px-2.5 py-1 rounded-md tracking-wider inline-flex items-center gap-1.5 shadow-2xs">
                            <span class="w-1.5 h-1.5 rounded-full bg-emerald-600 animate-pulse"></span> Live Now
                        </span>
                        <h3 class="font-extrabold text-lg text-gray-900 mt-2">RM5 Cafe Voucher</h3>
                        <p class="text-sm text-gray-500 mt-0.5">Price: <del class="text-gray-400 font-mono">500 Pts</del> <span class="font-bold text-emerald-700 font-mono">350 Pts</span></p>
                    </div>
                    <div class="text-right bg-white p-4 rounded-2xl border border-emerald-100/80 shadow-xs min-w-[160px] w-full sm:w-auto flex sm:block justify-between items-center">
                        <p class="text-[10px] font-bold text-gray-400 uppercase tracking-wider mb-0.5">Ends In:</p>
                        <!-- Countdown timer target with timestamp -->
                        <p class="text-xl font-mono font-extrabold text-emerald-900 countdown-timer tracking-wider" data-endtime="">--:--:--</p>
                    </div>
                </div>

                <!-- Queued Sale -->
                <div class="bg-gray-50/60 border border-gray-200/80 border-l-4 border-l-blue-500 p-5 rounded-2xl shadow-xs hover:shadow-md transition-all flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 opacity-90">
                    <div>
                        <span class="bg-blue-100 text-blue-700 text-[10px] font-extrabold uppercase px-2.5 py-1 rounded-md tracking-wider shadow-2xs">Queued</span>
                        <h3 class="font-extrabold text-lg text-gray-900 mt-2">Premium Tumbler</h3>
                        <p class="text-sm text-gray-500 mt-0.5">Price: <del class="text-gray-400 font-mono">3000 Pts</del> <span class="font-bold text-emerald-700 font-mono">2200 Pts</span></p>
                    </div>
                    <div class="text-right w-full sm:w-auto flex sm:block justify-between items-center">
                        <p class="text-[10px] font-bold text-gray-400 uppercase tracking-wider mb-0.5">Starts On:</p>
                        <p class="text-xs font-bold font-mono text-gray-800 bg-white px-3.5 py-2.5 rounded-xl border border-gray-200/80 shadow-xs">Oct 30, 2026 - 12:00 PM</p>
                    </div>
                </div>
            </div>
        </div>

    </main>

    <!-- External JavaScript File -->
    <script src="flashsale.js"></script>
</body>
</html>