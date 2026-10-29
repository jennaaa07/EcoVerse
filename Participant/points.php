<?php
// impact.php
$pageTitle = "Points & Carbon - Eco Hub";

$userStats = [
    "available_points" => 2450,
    "carbon_savings" => -12.5 // kg CO2e
];
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
    <header class="bg-white shadow-sm px-6 py-4 sticky top-0 z-10 flex items-center justify-between">
        <a href="dashboard.php" class="text-gray-400 hover:text-green-600 transition w-8">
            <i class="fa-solid fa-arrow-left text-xl"></i>
        </a>
        <h1 class="text-xl font-extrabold text-gray-800">Impact & Rewards</h1>
        <div class="w-8"></div>
    </header>

    <main class="p-4 max-w-md mx-auto space-y-6">
        
        <!-- Points Card -->
        <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100 text-center flex flex-col items-center">
            <span class="text-xs font-bold text-gray-400 uppercase tracking-wider mb-1">Available Points</span>
            <div class="flex items-center gap-2 mb-4">
                <i class="fa-solid fa-leaf text-green-500 text-3xl"></i>
                <h2 id="availablePointsDisplay" class="text-5xl font-extrabold text-gray-800"><?php echo number_format($userStats['available_points']); ?></h2>
            </div>
            <a href="merchandise.php" class="bg-green-600 text-white font-bold w-full py-3.5 rounded-xl shadow-sm hover:bg-green-700 transition active:scale-[0.98] flex items-center justify-center gap-2 text-sm">
                <i class="fa-solid fa-store"></i> Go to Reward Store
            </a>
            <button onclick="viewRedemptionHistory()" class="mt-3 text-xs font-bold text-gray-500 hover:text-green-600 transition bg-transparent border-none cursor-pointer">
                View Redemption History <i class="fa-solid fa-chevron-right text-[10px] ml-0.5"></i>
            </button>
        </div>

        <!-- Carbon Footprint Widget -->
        <div class="bg-gradient-to-br from-gray-800 to-gray-900 rounded-2xl p-6 text-white shadow-sm relative overflow-hidden">
            <i class="fa-solid fa-cloud absolute -right-6 -bottom-6 text-8xl text-white opacity-5"></i>
            
            <div class="flex items-center gap-3 mb-4">
                <div class="w-10 h-10 bg-gray-700/60 text-green-400 rounded-xl flex items-center justify-center text-lg">
                    <i class="fa-solid fa-leaf"></i>
                </div>
                <div>
                    <h3 class="font-bold text-base text-white">Carbon Footprint</h3>
                    <p class="text-xs text-gray-400 font-medium">Monthly Est. Savings</p>
                </div>
            </div>
            
            <div class="flex items-baseline gap-1 mb-5">
                <span id="carbonSavingsValue" class="text-4xl font-extrabold text-green-400"><?php echo number_format($userStats['carbon_savings'], 1); ?></span>
                <span class="text-sm font-medium text-gray-300">kg CO₂e</span>
            </div>

            <button onclick="recalculateImpact()" id="recalculateBtn" class="w-full bg-gray-700/80 hover:bg-gray-700 text-white font-bold py-3 rounded-xl text-xs uppercase tracking-wider transition active:scale-[0.98] border border-gray-600/50 cursor-pointer">
                Recalculate Impact
            </button>
        </div>

    </main>

    <!-- Mobile Bottom Navigation -->
    <nav class="fixed bottom-0 w-full bg-white border-t border-gray-200 flex justify-around p-3 pb-6 max-w-md left-1/2 transform -translate-x-1/2 z-20">
        <a href="dashboard.php" class="flex flex-col items-center text-green-600">
            <i class="fa-solid fa-house text-xl mb-1"></i>
            <span class="text-[10px] font-bold">Home</span>
        </a>
        <a href="log_activity.php" class="flex flex-col items-center text-gray-400 hover:text-green-600 transition">
            <i class="fa-solid fa-plus-circle text-xl mb-1"></i>
            <span class="text-[10px] font-bold">Log</span>
        </a>
        <a href="merchandise.php" class="flex flex-col items-center text-gray-400 hover:text-green-600 transition">
            <i class="fa-solid fa-store text-xl mb-1"></i>
            <span class="text-[10px] font-bold">Store</span>
        </a>
        <a href="community.php" class="flex flex-col items-center text-gray-400 hover:text-green-600 transition">
            <i class="fa-solid fa-users text-xl mb-1"></i>
            <span class="text-[10px] font-bold">Community</span>
        </a>
        <a href="profile.php" class="flex flex-col items-center text-gray-400 hover:text-green-600 transition">
            <i class="fa-solid fa-user text-xl mb-1"></i>
            <span class="text-[10px] font-bold">Profile</span>
        </a>
    </nav>

    <!-- External JavaScript File -->
    <script src="impact.js"></script>
</body>
</html>