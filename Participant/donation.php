<?php
// donations.php
$pageTitle = "Donations - EcoRewards";
$userPoints = 2450;
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
<body class="bg-gray-50 font-sans min-h-screen text-gray-800 pb-20">

    <!-- Header & Points -->
    <header class="bg-white shadow-sm sticky top-0 z-10">
        <div class="px-6 py-4 flex justify-between items-center">
            <h1 class="text-xl font-extrabold text-gray-800">Reward Store</h1>
            <div class="bg-green-100 text-green-800 px-3 py-1 rounded-full font-bold text-sm flex items-center gap-1 border border-green-200">
                <i class="fa-solid fa-leaf text-green-600"></i> <span id="userPointsDisplay"><?php echo number_format($userPoints); ?></span> pts
            </div>
        </div>
        
        <!-- Category Tabs -->
        <div class="flex overflow-x-auto px-4 pb-3 space-x-2 hide-scrollbar">
            <a href="store.html" class="bg-gray-100 text-gray-600 px-4 py-1.5 rounded-full text-sm font-medium whitespace-nowrap hover:bg-gray-200 transition">All</a>
            <a href="vouchers.html" class="bg-gray-100 text-gray-600 px-4 py-1.5 rounded-full text-sm font-medium whitespace-nowrap hover:bg-gray-200 transition">Vouchers</a>
            <a href="merchandise.html" class="bg-gray-100 text-gray-600 px-4 py-1.5 rounded-full text-sm font-medium whitespace-nowrap hover:bg-gray-200 transition">Merchandise</a>
            <a href="donations.html" class="bg-gray-800 text-white px-4 py-1.5 rounded-full text-sm font-bold whitespace-nowrap">Donations</a>
        </div>
    </header>

    <main class="p-4 max-w-md mx-auto">
        <div class="grid grid-cols-2 gap-4">
            
            <!-- Donation 1 -->
            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden flex flex-col">
                <div class="h-32 bg-green-50 flex items-center justify-center text-4xl text-green-600">
                    <i class="fa-solid fa-tree"></i>
                </div>
                <div class="p-3 flex flex-col flex-grow">
                    <h3 class="font-bold text-sm text-gray-800 mb-1">Plant a Tree Initiative</h3>
                    <p class="text-green-600 font-extrabold text-sm mb-3">300 pts</p>
                    <button onclick="processDonation('Plant a Tree Initiative', 300)" class="mt-auto w-full bg-green-600 hover:bg-green-700 text-white text-xs font-bold py-2 rounded-lg transition cursor-pointer">
                        Donate Now
                    </button>
                </div>
            </div>

            <!-- Donation 2 -->
            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden flex flex-col">
                <div class="h-32 bg-sky-50 flex items-center justify-center text-4xl text-sky-600">
                    <i class="fa-solid fa-water"></i>
                </div>
                <div class="p-3 flex flex-col flex-grow">
                    <h3 class="font-bold text-sm text-gray-800 mb-1">Ocean Cleanup Fund</h3>
                    <p class="text-green-600 font-extrabold text-sm mb-3">600 pts</p>
                    <button onclick="processDonation('Ocean Cleanup Fund', 600)" class="mt-auto w-full bg-green-600 hover:bg-green-700 text-white text-xs font-bold py-2 rounded-lg transition cursor-pointer">
                        Donate Now
                    </button>
                </div>
            </div>

            <!-- Donation 3 -->
            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden flex flex-col">
                <div class="h-32 bg-rose-50 flex items-center justify-center text-4xl text-rose-600">
                    <i class="fa-solid fa-paw"></i>
                </div>
                <div class="p-3 flex flex-col flex-grow">
                    <h3 class="font-bold text-sm text-gray-800 mb-1">Wildlife Habitat Shield</h3>
                    <p class="text-green-600 font-extrabold text-sm mb-3">1,000 pts</p>
                    <button onclick="processDonation('Wildlife Habitat Shield', 1000)" class="mt-auto w-full bg-green-600 hover:bg-green-700 text-white text-xs font-bold py-2 rounded-lg transition cursor-pointer">
                        Donate Now
                    </button>
                </div>
            </div>

            <!-- Donation 4 -->
            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden flex flex-col">
                <div class="h-32 bg-yellow-50 flex items-center justify-center text-4xl text-yellow-600">
                    <i class="fa-solid fa-solar-panel"></i>
                </div>
                <div class="p-3 flex flex-col flex-grow">
                    <h3 class="font-bold text-sm text-gray-800 mb-1">Community Solar Grant</h3>
                    <p class="text-green-600 font-extrabold text-sm mb-3">2,000 pts</p>
                    <button onclick="processDonation('Community Solar Grant', 2000)" class="mt-auto w-full bg-green-600 hover:bg-green-700 text-white text-xs font-bold py-2 rounded-lg transition cursor-pointer">
                        Donate Now
                    </button>
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
        <a href="store.html" class="flex flex-col items-center text-green-600">
            <i class="fa-solid fa-store text-xl mb-1"></i>
            <span class="text-[10px] font-bold">Store</span>
        </a>
        <a href="community.html" class="flex flex-col items-center text-gray-400 hover:text-green-600 transition">
            <i class="fa-solid fa-users text-xl mb-1"></i>
            <span class="text-[10px] font-bold">Community</span>
        </a>
        <a href="profile.html" class="flex flex-col items-center text-gray-400 hover:text-green-600 transition">
            <i class="fa-solid fa-user text-xl mb-1"></i>
            <span class="text-[10px] font-bold">Profile</span>
        </a>
    </nav>

    <style>
        .hide-scrollbar::-webkit-scrollbar { display: none; }
        .hide-scrollbar { -ms-overflow-style: none; scrollbar-width: none; }
    </style>

    <!-- External JavaScript File -->
    <script src="donations.js"></script>
</body>
</html>