<?php
// reward_history.php
$pageTitle = "Reward History - EcoRewards";
$currentBalance = "5,240";
$redeemedTotal = "1,800 Pts";
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
<body class="bg-gray-50 font-sans min-h-screen text-gray-800 pb-24">

    <!-- Header -->
    <header class="bg-white shadow-sm px-4 py-3 sticky top-0 z-10 flex items-center justify-between">
        <a href="profile.html" class="w-10 h-10 rounded-full bg-gray-100 flex items-center justify-center text-gray-700 hover:bg-gray-200 transition">
            <i class="fa-solid fa-arrow-left text-lg"></i>
        </a>
        <h1 class="text-lg font-bold text-gray-800">Reward History</h1>
        <button onclick="toggleFilterOptions()" class="w-10 h-10 rounded-full bg-gray-100 flex items-center justify-center text-gray-700 hover:bg-gray-200 transition cursor-pointer" title="Filter History">
            <i class="fa-solid fa-filter text-base"></i>
        </button>
    </header>

    <main class="p-4 max-w-md mx-auto space-y-4">

        <!-- Summary Banner Card -->
        <div class="bg-gradient-to-r from-green-600 to-emerald-700 rounded-2xl p-4 text-white shadow-sm flex items-center justify-between">
            <div>
                <p class="text-xs text-green-100 font-medium">Current Balance</p>
                <h2 class="text-2xl font-extrabold flex items-center gap-1.5 mt-0.5">
                    <i class="fa-solid fa-leaf text-amber-300 text-xl"></i> <?php echo $currentBalance; ?> <span class="text-xs font-normal text-green-100">Pts</span>
                </h2>
            </div>
            <div class="text-right border-l border-green-500/50 pl-4">
                <p class="text-[11px] text-green-100">Redeemed Total</p>
                <p class="text-base font-bold text-white"><?php echo $redeemedTotal; ?></p>
            </div>
        </div>

        <!-- Filter Tabs -->
        <div class="flex items-center gap-2 overflow-x-auto pb-1 scrollbar-none text-xs">
            <a href="rewardHistory.html" class="bg-white border border-gray-200 text-gray-600 font-semibold px-4 py-2 rounded-full hover:bg-gray-50 shrink-0">
                All Activity
            </a>
            <a href="earned.html" class="bg-green-600 text-white font-bold px-4 py-2 rounded-full shadow-sm shrink-0">
                🌱 Earned
            </a>
            <a href="redeemed.html" class="bg-white border border-gray-200 text-gray-600 font-semibold px-4 py-2 rounded-full hover:bg-gray-50 shrink-0">
                🎁 Redeemed
            </a>
        </div>

        <!-- History List Group: August 2026 -->
        <div class="space-y-3">
            <h3 class="text-xs font-bold text-gray-400 uppercase tracking-wider px-1">August 2026</h3>

            <!-- Item 1: Earned -->
            <div onclick="viewHistoryDetail('Plastic Recycling Drive', '+150 Pts', 'Aug 14, 2026 • Campus Hub')" class="bg-white rounded-2xl p-4 shadow-sm border border-gray-100 flex items-center justify-between hover:bg-gray-50 transition cursor-pointer">
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 rounded-xl bg-green-100 text-green-600 flex items-center justify-center font-bold shrink-0">
                        <i class="fa-solid fa-recycle text-base"></i>
                    </div>
                    <div>
                        <h4 class="font-bold text-xs text-gray-800">Plastic Recycling Drive</h4>
                        <p class="text-[10px] text-gray-400">Aug 14, 2026 • Campus Hub</p>
                    </div>
                </div>
                <div class="text-right">
                    <span class="font-bold text-xs text-green-600">+150 Pts</span>
                    <p class="text-[9px] font-bold text-green-700 bg-green-50 px-2 py-0.5 rounded-full mt-0.5">Completed</p>
                </div>
            </div>

            <!-- Item 2: Earned -->
            <div onclick="viewHistoryDetail('Reusable Bottle Bonus', '+50 Pts', 'Aug 05, 2026 • Cafeteria')" class="bg-white rounded-2xl p-4 shadow-sm border border-gray-100 flex items-center justify-between hover:bg-gray-50 transition cursor-pointer">
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 rounded-xl bg-blue-100 text-blue-600 flex items-center justify-center font-bold shrink-0">
                        <i class="fa-solid fa-bottle-water text-base"></i>
                    </div>
                    <div>
                        <h4 class="font-bold text-xs text-gray-800">Reusable Bottle Bonus</h4>
                        <p class="text-[10px] text-gray-400">Aug 05, 2026 • Cafeteria</p>
                    </div>
                </div>
                <div class="text-right">
                    <span class="font-bold text-xs text-green-600">+50 Pts</span>
                    <p class="text-[9px] font-bold text-green-700 bg-green-50 px-2 py-0.5 rounded-full mt-0.5">Completed</p>
                </div>
            </div>
        </div>

        <!-- History List Group: July 2026 -->
        <div class="space-y-3 pt-2">
            <h3 class="text-xs font-bold text-gray-400 uppercase tracking-wider px-1">July 2026</h3>

            <!-- Item 3: Earned -->
            <div onclick="viewHistoryDetail('Paper Recycling Drop', '+200 Pts', 'Jul 15, 2026 • Library Station')" class="bg-white rounded-2xl p-4 shadow-sm border border-gray-100 flex items-center justify-between hover:bg-gray-50 transition cursor-pointer">
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 rounded-xl bg-teal-100 text-teal-600 flex items-center justify-center font-bold shrink-0">
                        <i class="fa-solid fa-newspaper text-base"></i>
                    </div>
                    <div>
                        <h4 class="font-bold text-xs text-gray-800">Paper Recycling Drop</h4>
                        <p class="text-[10px] text-gray-400">Jul 15, 2026 • Library Station</p>
                    </div>
                </div>
                <div class="text-right">
                    <span class="font-bold text-xs text-green-600">+200 Pts</span>
                    <p class="text-[9px] font-bold text-green-700 bg-green-50 px-2 py-0.5 rounded-full mt-0.5">Completed</p>
                </div>
            </div>
        </div>

    </main>

    <!-- Mobile Bottom Navigation -->
    <nav class="fixed bottom-0 w-full bg-white border-t border-gray-200 flex justify-around p-3 pb-6 max-w-md left-1/2 transform -translate-x-1/2 z-20">
        <a href="dashboard.html" class="flex flex-col items-center text-gray-400 hover:text-green-600 transition">
            <i class="fa-solid fa-house text-xl mb-1"></i>
            <span class="text-[10px] font-bold">Home</span>
        </a>
        <a href="log-activity.html" class="flex flex-col items-center text-gray-400 hover:text-green-600 transition">
            <i class="fa-solid fa-plus-circle text-xl mb-1"></i>
            <span class="text-[10px] font-bold">Log</span>
        </a>
        <a href="store.html" class="flex flex-col items-center text-gray-400 hover:text-green-600 transition">
            <i class="fa-solid fa-store text-xl mb-1"></i>
            <span class="text-[10px] font-bold">Store</span>
        </a>
        <a href="community.html" class="flex flex-col items-center text-gray-400 hover:text-green-600 transition">
            <i class="fa-solid fa-users text-xl mb-1"></i>
            <span class="text-[10px] font-bold">Community</span>
        </a>
        <a href="profile.html" class="flex flex-col items-center text-green-600">
            <i class="fa-solid fa-user text-xl mb-1"></i>
            <span class="text-[10px] font-bold">Profile</span>
        </a>
    </nav>

    <!-- External JavaScript File -->
    <script src="reward_history.js"></script>
</body>
</html>