<?php
// scanner.php
$pageTitle = "Instant Scanner - Eco Hub";
$initialPoints = 150;
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $pageTitle; ?></title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
</head>
<body class="bg-slate-900 font-sans min-h-screen text-slate-100 pb-24" data-initial-points="<?php echo $initialPoints; ?>">

    <!-- Guest Session Lifecycle Alert Banner -->
    <div class="bg-gradient-to-r from-amber-500 to-orange-600 text-slate-900 px-4 py-3 text-xs font-bold sticky top-0 z-30 shadow-md flex justify-between items-center">
        <span class="flex items-center gap-1.5 text-black">
            <i class="fa-solid fa-clock animate-pulse text-sm"></i> 
            Guest Session Window: <span id="sessionTimer" class="font-mono bg-black/10 px-1 rounded ml-1">59:42 remaining</span>
        </span>
        <button onclick="saveGuestProgress()" class="bg-slate-900 text-white px-3 py-1 rounded-md text-[10px] font-extrabold uppercase tracking-wider hover:bg-black transition shadow-sm cursor-pointer">
            Save Progress
        </button>
    </div>

    <!-- Live Session Counter Header -->
    <header class="p-4 flex justify-between items-center bg-slate-800/60 backdrop-blur border-b border-slate-700/50">
        <div>
            <span class="text-[10px] uppercase font-bold tracking-wider text-slate-400">Current Session Ledger</span>
            <h1 id="pointLedgerDisplay" class="text-lg font-black text-amber-400">+<?php echo $initialPoints; ?> Unclaimed Pts</h1>
        </div>
        <div class="text-right">
            <span class="text-xs font-bold text-slate-300 block bg-slate-700 px-2.5 py-1 rounded-full border border-slate-600">Guest Mode</span>
        </div>
    </header>

    <main class="p-4 max-w-md mx-auto space-y-4">
        
        <!-- On-Site Action Camera Viewfinder Component -->
        <div class="bg-slate-800 rounded-2xl border border-slate-700 p-4 shadow-xl space-y-4">
            <div>
                <h2 class="font-bold text-base text-white">Instant Drop-off Verification</h2>
                <p class="text-xs text-slate-400">Snap a quick photo of your deposit item against the bin open-gate</p>
            </div>

            <!-- Simulated Live Camera View Finder -->
            <div class="relative aspect-square w-full rounded-xl bg-black border border-slate-600 flex flex-col items-center justify-center overflow-hidden group">
                <!-- Camera Crosshair Grid Lines -->
                <div class="absolute inset-0 border border-white/5 pointer-events-none grid grid-cols-3 grid-rows-3">
                    <div class="border-r border-b border-white/10"></div><div class="border-r border-b border-white/10"></div><div class="border-b border-white/10"></div>
                    <div class="border-r border-b border-white/10"></div><div class="border-r border-b border-white/10"></div><div class="border-b border-white/10"></div>
                </div>

                <!-- QR Tag Detected Overlay Notification -->
                <div class="absolute top-4 bg-green-500 text-black font-extrabold text-xs px-3 py-1.5 rounded-lg shadow-lg flex items-center gap-2">
                    <i class="fa-solid fa-circle-check animate-bounce"></i> Connected: Smart Bin #04 (South Campus)
                </div>

                <!-- Central Target Reticle -->
                <div class="w-20 h-20 border-2 border-dashed border-slate-400/50 rounded-full flex items-center justify-center opacity-60">
                    <i class="fa-solid fa-camera text-2xl text-slate-400"></i>
                </div>

                <p class="absolute bottom-4 text-[11px] text-slate-400 tracking-wide font-medium bg-black/60 px-3 py-1 rounded-full">Proximity verified via hardware tags</p>
            </div>

            <!-- Trigger Submission Action -->
            <button onclick="handleDepositClaim()" class="w-full bg-green-500 hover:bg-green-600 text-slate-900 font-black py-4 rounded-xl shadow-lg shadow-green-500/10 transition text-sm flex items-center justify-center gap-2 cursor-pointer">
                <i class="fa-solid fa-circle-check text-sm"></i> Log Deposit & Claim +50 Points
            </button>
        </div>

        <!-- Anti-Spam Rate Limiter Security Notice Footer -->
        <div class="bg-slate-800/40 border border-slate-700/60 rounded-xl p-3 flex gap-3 items-start">
            <i class="fa-solid fa-shield-halved text-amber-500 text-base mt-0.5"></i>
            <div>
                <h4 class="text-xs font-bold text-slate-300">Guest Throttling Protection Policy</h4>
                <p class="text-[11px] text-slate-500 leading-relaxed mt-0.5">Anonymous guest uploads are capped at 2 per hour based on system fingerprinting thresholds to mitigate script attacks.</p>
            </div>
        </div>

    </main>

    <!-- External Script Integration -->
    <script src="scanner.js"></script>
</body>
</html>