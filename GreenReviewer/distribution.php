<?php
// PHP session or environment initialization can go here
$system_name = "Eco Hub Reward Distribution";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reward Distribution - EcoRewards</title>
    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- FontAwesome Icons -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <!-- Custom External CSS -->
    <link href="distributionstyle.css" rel="stylesheet">
</head>
<body class="bg-[#e2ebe4] font-sans min-h-screen p-6 flex flex-col relative text-slate-900 selection:bg-emerald-800 selection:text-white">

    <div id="toast-container" class="fixed top-5 right-5 z-50 flex flex-col gap-3 pointer-events-none"></div>

    <!-- Header -->
    <header class="w-full mb-8 flex justify-between items-center bg-white px-8 py-5 rounded-3xl shadow-sm border-2 border-emerald-200">
        <div class="flex items-center gap-4">
            <a href="viewerdashboard.php" class="w-12 h-12 rounded-2xl bg-emerald-50 border-2 border-emerald-300 flex items-center justify-center text-emerald-800 hover:bg-emerald-900 hover:text-white hover:border-emerald-900 transition-all duration-300 shadow-xs group" title="Back to Dashboard">
                <i class="fa-solid fa-arrow-left text-lg group-hover:-translate-x-0.5 transition-transform"></i>
            </a>
            <div>
                <p class="text-xs font-black text-emerald-700 uppercase tracking-widest flex items-center gap-1.5">
                    <span class="w-2 h-2 rounded-full bg-emerald-500 animate-pulse"></span> Fulfillment Desk
                </p>
                <h1 class="text-2xl font-black text-emerald-950 tracking-tight">Reward Distribution Desk</h1>
            </div>
        </div>
    </header>

    <!-- Centered Content Wrapper -->
    <main class="w-full max-w-2xl mx-auto flex-grow flex flex-col justify-center pb-12">
        
        <!-- Search Bar -->
        <div class="bg-white p-4 rounded-3xl card-shadow mb-8 flex gap-3 border-2 border-emerald-200">
            <div class="relative flex-grow">
                <i class="fa-solid fa-ticket absolute left-4 top-4 text-emerald-600 text-lg"></i>
                <input type="text" id="voucher-input" placeholder="Enter 8-Digit Voucher Code (e.g. VCH-8492)" class="w-full bg-emerald-50/30 border-2 border-emerald-200 rounded-2xl py-3.5 pl-12 pr-4 text-sm font-black text-emerald-950 tracking-wider focus:outline-none focus:border-emerald-600 focus:bg-white uppercase transition shadow-inner">
            </div>
            <button id="searchBtn" class="bg-emerald-900 hover:bg-emerald-950 text-white font-black px-8 rounded-2xl shadow transition cursor-pointer flex items-center gap-2">
                <i class="fa-solid fa-magnifying-glass"></i> Search
            </button>
        </div>

        <!-- Results Card -->
        <div id="result-card" class="bg-white rounded-3xl card-shadow overflow-hidden border-2 border-emerald-200 relative transition-all duration-300">
            <div class="absolute top-0 left-0 right-0 h-2 bg-gradient-to-r from-emerald-500 via-teal-500 to-green-600"></div>

            <div class="p-8 text-center pt-10">
                <span class="inline-flex items-center gap-1.5 bg-emerald-100 text-emerald-800 font-black px-4 py-1.5 rounded-full uppercase tracking-widest text-xs mb-4 border-2 border-emerald-300 shadow-inner">
                    <i class="fa-solid fa-circle-check text-emerald-600"></i> Active Voucher
                </span>
                <h3 class="text-2xl font-black text-emerald-950 mb-1">Exclusive Eco-Tote Bag</h3>
                <p class="text-xs font-bold text-emerald-700 uppercase tracking-wide mb-6">Redeemed by Participant: <span class="text-emerald-950 font-black">P-102934</span></p>
                
                <div class="bg-emerald-50/50 border-2 border-emerald-200 rounded-2xl p-4 mb-8 inline-flex gap-8 mx-auto text-left shadow-inner">
                    <div>
                        <p class="text-[10px] font-black uppercase text-emerald-700">Cost</p>
                        <p class="text-sm font-black text-emerald-950">1,200 Pts</p>
                    </div>
                    <div class="border-r border-emerald-200"></div>
                    <div>
                        <p class="text-[10px] font-black uppercase text-emerald-700">Claimed On</p>
                        <p class="text-sm font-black text-emerald-950">Oct 12, 2026</p>
                    </div>
                </div>

                <!-- Action Button -->
                <button id="confirmBtn" class="w-full bg-emerald-900 hover:bg-emerald-950 text-white font-black py-4 rounded-2xl shadow-lg transition flex items-center justify-center gap-2 text-sm cursor-pointer active:scale-98">
                    <i class="fa-solid fa-box-open text-base"></i> Confirm Item Collection
                </button>
            </div>
        </div>

    </main>

    <!-- External Script -->
    <script src="distribution.js"></script>
</body>
</html>