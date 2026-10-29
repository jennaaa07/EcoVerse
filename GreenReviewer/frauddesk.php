<?php
// PHP processing state for security operations can be handled here if needed
$system_name = "EcoRewards Fraud Investigation Desk";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fraud Desk - EcoRewards</title>
    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- FontAwesome Icons -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <!-- Custom External CSS -->
    <link href="fraudstyle.css" rel="stylesheet">
</head>
<body class="bg-[#e2ebe4] font-sans min-h-screen p-8 flex flex-col relative text-slate-900 selection:bg-emerald-200">

    <!-- Notification Toast Container -->
    <div id="toast-container" class="fixed top-5 right-5 z-50 flex flex-col gap-3 pointer-events-none"></div>

    <!-- Header -->
    <header class="mb-8 flex justify-between items-center bg-white px-8 py-5 rounded-3xl shadow-sm border-2 border-emerald-200">
        <div class="flex items-center gap-4">
            <!-- Back to Dashboard Arrow -->
            <a href="viewerdashboard.php" class="w-12 h-12 rounded-2xl bg-emerald-50 border-2 border-emerald-300 flex items-center justify-center text-emerald-800 hover:bg-emerald-900 hover:text-white hover:border-emerald-900 transition-all duration-300 shadow-xs group" title="Back to Dashboard">
                <i class="fa-solid fa-arrow-left text-lg group-hover:-translate-x-0.5 transition-transform"></i>
            </a>
            <div>
                <p class="text-xs font-black text-emerald-700 uppercase tracking-widest flex items-center gap-1.5">
                    <span class="w-2 h-2 rounded-full bg-red-500 animate-pulse"></span> Security Operations
                </p>
                <h1 class="text-2xl font-black text-emerald-950 tracking-tight">Fraud Investigation Desk</h1>
            </div>
        </div>

        <!-- Real-Time Header Clock -->
        <div class="hidden sm:flex items-center gap-2 bg-emerald-50 border-2 border-emerald-300 px-4 py-2.5 rounded-2xl shadow-2xs text-xs font-bold text-emerald-900">
            <i class="fa-solid fa-clock text-emerald-600"></i>
            <span id="live-clock">--:--:--</span>
        </div>
    </header>

    <!-- Main Content Grid -->
    <main class="grid grid-cols-1 md:grid-cols-2 gap-6 flex-grow">

        <!-- Flagged Item 1 -->
        <div id="card-P772910" class="bg-white rounded-3xl card-shadow border-2 border-red-200 overflow-hidden h-fit transition-all duration-300 relative">
            <div class="absolute top-0 left-0 right-0 h-2 bg-gradient-to-r from-red-500 via-rose-500 to-orange-500"></div>

            <div class="bg-red-50/70 px-6 py-4 border-b-2 border-red-100 flex justify-between items-center">
                <span class="text-red-800 font-black text-xs uppercase tracking-wider flex items-center gap-2">
                    <i class="fa-solid fa-triangle-exclamation text-red-600"></i> High Priority Flag
                </span>
                <span class="text-xs text-red-500 font-bold bg-white px-3 py-1 rounded-full border border-red-200 shadow-2xs">Reported 2 hrs ago</span>
            </div>
            
            <div class="p-8">
                <div class="flex justify-between items-start mb-6">
                    <div>
                        <h3 class="font-black text-emerald-950 text-xl mb-1">Participant: P-772910</h3>
                        <p class="text-xs font-bold text-emerald-700 uppercase tracking-wide">Flagged by: Verifier V-11</p>
                    </div>
                    <span class="bg-emerald-50 text-emerald-800 text-xs px-3 py-1 rounded-xl font-black border-2 border-emerald-200 shadow-inner">Log #8992</span>
                </div>
                
                <div class="bg-red-50/40 p-5 rounded-2xl text-xs font-medium text-slate-700 border-2 border-red-100 mb-8 leading-relaxed">
                    <strong class="font-black text-red-900 uppercase tracking-wider block mb-1">Reason for Flag:</strong> 
                    "User submitted an image found on Google Images instead of a real photo of their recycling bin."
                </div>

                <div class="flex gap-4">
                    <button onclick="handleFlagAction('card-P772910', 'P-772910', 'lock')" class="flex-1 bg-red-600 hover:bg-red-700 text-white font-black py-3.5 px-4 rounded-2xl shadow-lg transition text-xs flex items-center justify-center gap-2 cursor-pointer active:scale-98">
                        <i class="fa-solid fa-ban text-sm"></i> Lock Account
                    </button>
                    <button onclick="handleFlagAction('card-P772910', 'P-772910', 'dismiss')" class="flex-1 bg-emerald-50 hover:bg-emerald-100 border-2 border-emerald-200 text-emerald-900 font-black py-3.5 px-4 rounded-2xl shadow-2xs transition text-xs cursor-pointer active:scale-98">
                        Dismiss Flag
                    </button>
                </div>
            </div>
        </div>

    </main>

    <!-- External JavaScript File -->
    <script src="frauddesk.js"></script>
</body>
</html>