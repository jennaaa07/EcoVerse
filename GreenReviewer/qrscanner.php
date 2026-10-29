<?php
// PHP session or environment initialization can go here
$system_name = "Eco Hub QR Scanner";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>QR Scanner - Eco Hub</title>
    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- FontAwesome Icons -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <!-- Custom External CSS -->
    <link href="scannerstyle.css" rel="stylesheet">
</head>
<body class="bg-[#e2ebe4] font-sans min-h-screen flex flex-col p-6 text-gray-900 selection:bg-emerald-800 selection:text-white">

    <!-- Header Section -->
    <header class="max-w-xl mx-auto w-full mb-6 flex items-center justify-between bg-white px-6 py-4 rounded-2xl card-shadow border-2 border-emerald-200">
        <div class="flex items-center gap-4">
            <a href="viewerdashboard.php" class="w-10 h-10 rounded-xl bg-emerald-50 border border-emerald-300 flex items-center justify-center text-emerald-800 hover:bg-emerald-900 hover:text-white hover:border-emerald-900 transition-all duration-300 shadow-xs group" title="Back to Dashboard">
                <i class="fa-solid fa-arrow-left group-hover:-translate-x-0.5 transition-transform"></i>
            </a>
            <div>
                <p class="text-[10px] font-black text-emerald-700 uppercase tracking-widest flex items-center gap-1.5">
                    <span class="w-2 h-2 rounded-full bg-emerald-500 animate-pulse"></span> Attendance Verification
                </p>
                <h1 class="text-xl font-black tracking-tight text-emerald-950">QR Scanner</h1>
            </div>
        </div>
        <div class="hidden sm:flex items-center gap-2 bg-emerald-50 px-3 py-1.5 rounded-xl border-2 border-emerald-200 text-xs font-black text-emerald-900 shadow-2xs">
            <i class="fa-solid fa-camera text-emerald-600"></i> Active Lens
        </div>
    </header>

    <!-- Centered Scanner Container -->
    <main class="flex-grow flex flex-col items-center justify-center w-full max-w-xl mx-auto space-y-6">
        
        <!-- Main Scanner Box -->
        <div class="w-full bg-white rounded-3xl p-8 card-shadow border-2 border-emerald-200 flex flex-col items-center relative overflow-hidden">
            <!-- Decorative Top Bar -->
            <div class="absolute top-0 left-0 right-0 h-2 bg-gradient-to-r from-emerald-500 via-teal-500 to-green-600"></div>

            <p class="text-xs font-bold text-emerald-800 mb-6 text-center max-w-sm">
                Align the participant's QR code within the frame below to instantly register attendance points.
            </p>

            <!-- Camera Viewport Frame -->
            <div class="relative w-64 h-64 bg-emerald-950 rounded-2xl border-4 border-emerald-800 overflow-hidden shadow-inner flex items-center justify-center group">
                <!-- Glowing Corners -->
                <div class="absolute top-4 left-4 w-8 h-8 border-t-4 border-l-4 border-emerald-400 rounded-tl-md"></div>
                <div class="absolute top-4 right-4 w-8 h-8 border-t-4 border-r-4 border-emerald-400 rounded-tr-md"></div>
                <div class="absolute bottom-4 left-4 w-8 h-8 border-b-4 border-l-4 border-emerald-400 rounded-bl-md"></div>
                <div class="absolute bottom-4 right-4 w-8 h-8 border-b-4 border-r-4 border-emerald-400 rounded-br-md"></div>
                
                <!-- Animated Scanning Line -->
                <div class="absolute w-full h-1 bg-emerald-400 shadow-[0_0_15px_rgba(52,211,153,1)] animate-[pulse_1.5s_ease-in-out_infinite]"></div>
                
                <!-- Central Icon -->
                <i class="fa-solid fa-qrcode text-6xl text-emerald-800 opacity-60 group-hover:scale-110 transition-transform duration-300"></i>
            </div>

            <!-- Action Trigger Buttons -->
            <div class="mt-6 flex gap-3 w-full max-w-xs">
                <button id="simulateScanBtn" class="flex-1 py-3 bg-emerald-900 text-white font-black rounded-xl text-xs shadow-md hover:bg-emerald-950 active:scale-95 transition cursor-pointer flex items-center justify-center gap-2">
                    <i class="fa-solid fa-bolt text-emerald-400"></i> Simulate Scan
                </button>
            </div>
        </div>

        <!-- Recent Scans Log -->
        <div class="w-full bg-white rounded-3xl p-6 card-shadow border-2 border-emerald-200">
            <h4 class="text-xs font-black text-emerald-800 mb-4 uppercase tracking-wider flex items-center justify-between">
                <span>Recent Scans Log</span>
                <i class="fa-solid fa-list-check text-emerald-600"></i>
            </h4>
            
            <div id="scanLogContainer" class="space-y-3">
                <!-- Default Mock Log Item -->
                <div class="flex items-center justify-between bg-emerald-50/70 p-3.5 rounded-2xl border-2 border-emerald-200 shadow-2xs">
                    <div class="flex items-center gap-3">
                        <div class="w-9 h-9 rounded-xl bg-emerald-200 text-emerald-900 flex items-center justify-center font-bold text-sm">
                            <i class="fa-solid fa-user-check"></i>
                        </div>
                        <div>
                            <p class="font-black text-emerald-950 text-xs">Participant: P-19384</p>
                            <p class="text-[11px] text-emerald-700 font-semibold">Green Tech Seminar (+100 Pts)</p>
                        </div>
                    </div>
                    <span class="text-emerald-600 text-sm font-bold bg-white p-2 rounded-xl border border-emerald-200 shadow-2xs"><i class="fa-solid fa-circle-check"></i></span>
                </div>
            </div>

            <button id="manualEntryBtn" class="w-full text-center text-xs font-black text-emerald-800 mt-5 py-2.5 bg-emerald-50 border-2 border-dashed border-emerald-300 rounded-xl hover:bg-emerald-100 transition cursor-pointer">
                <i class="fa-solid fa-keyboard mr-1"></i> Switch to Manual ID Entry Mode
            </button>
        </div>

    </main>

    <!-- External Script -->
    <script src="qrscanner.js"></script>
</body>
</html>