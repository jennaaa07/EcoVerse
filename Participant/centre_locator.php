<?php
// centre_locator.php
$pageTitle = "Centre Locator - Eco Hub";
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

    <div class="relative max-w-md mx-auto h-screen flex flex-col overflow-hidden">
        
        <!-- Mock Map Background -->
        <div class="absolute inset-0 bg-blue-100 z-0 flex items-center justify-center overflow-hidden">
            <img src="https://www.transparenttextures.com/patterns/cartographer.png" class="opacity-30 absolute inset-0 w-full h-full object-cover">
            <!-- Map Pins -->
            <div onclick="focusCentre('Main Campus Eco-Bin')" class="absolute top-1/3 left-1/4 flex flex-col items-center group cursor-pointer">
                <i class="fa-solid fa-location-dot text-green-600 text-3xl drop-shadow-md transition transform group-hover:scale-110"></i>
                <span class="bg-white text-gray-800 font-bold text-[10px] px-2 py-0.5 rounded-full shadow border border-gray-100 mt-1">Main Campus</span>
            </div>
            <div onclick="focusCentre('IT Dept E-Waste Dropoff')" class="absolute top-1/2 right-1/3 flex flex-col items-center group cursor-pointer">
                <i class="fa-solid fa-location-dot text-purple-600 text-3xl drop-shadow-md transition transform group-hover:scale-110"></i>
                <span class="bg-white text-gray-800 font-bold text-[10px] px-2 py-0.5 rounded-full shadow border border-gray-100 mt-1">IT Dept E-Waste</span>
            </div>
        </div>

        <!-- Header Controls -->
        <div class="z-10 p-4">
            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 flex items-center px-4 py-3 mb-3">
                <a href="dashboard.html" class="text-gray-400 hover:text-green-600 transition mr-3">
                    <i class="fa-solid fa-arrow-left text-lg"></i>
                </a>
                <input type="text" id="centreSearchInput" placeholder="Search recycling centres..." class="flex-grow outline-none text-sm font-medium text-gray-800 bg-transparent">
                <i class="fa-solid fa-magnifying-glass text-gray-400"></i>
            </div>

            <!-- Heatmap Toggle Button -->
            <button id="heatmapToggleBtn" onclick="toggleHeatmap()" class="bg-gray-800 text-white rounded-full px-4 py-2 inline-flex items-center gap-2 shadow-md text-xs font-bold hover:bg-gray-700 transition cursor-pointer">
                <i class="fa-solid fa-fire text-orange-400"></i> <span id="heatmapText">Show Collection Heatmap</span>
                <div id="heatmapSwitch" class="w-7 h-4 bg-gray-600 rounded-full ml-1 relative transition">
                    <div id="heatmapKnob" class="absolute left-0.5 top-0.5 w-3 h-3 bg-white rounded-full transition"></div>
                </div>
            </button>
        </div>

        <!-- Bottom Sheet List -->
        <div class="z-10 bg-white mt-auto rounded-t-3xl shadow-[0_-10px_20px_rgba(0,0,0,0.05)] p-5 border-t border-gray-100 max-h-[50vh] overflow-y-auto">
            <div class="w-12 h-1.5 bg-gray-200 rounded-full mx-auto mb-4"></div>
            <h2 class="text-sm font-bold text-gray-500 mb-3 uppercase tracking-wider">Nearby Centres</h2>
            
            <div id="centreListContainer" class="space-y-3 mb-4">
                <!-- Centre 1 -->
                <div class="centre-item flex items-center gap-3 border-b border-gray-50 pb-3" data-name="Main Campus Eco-Bin">
                    <div class="w-10 h-10 bg-green-100 text-green-600 rounded-xl flex items-center justify-center shrink-0">
                        <i class="fa-solid fa-recycle text-lg"></i>
                    </div>
                    <div class="flex-grow">
                        <h3 class="font-bold text-sm text-gray-800">Main Campus Eco-Bin</h3>
                        <p class="text-xs text-gray-500 font-medium">Accepts: Plastic, Paper, Glass</p>
                        <p class="text-[11px] text-green-600 font-bold mt-0.5">0.2 km away • Open 24/7</p>
                    </div>
                    <button onclick="getDirections('Main Campus Eco-Bin')" class="w-9 h-9 bg-gray-100 text-gray-600 rounded-xl flex items-center justify-center hover:bg-green-600 hover:text-white transition shrink-0 cursor-pointer">
                        <i class="fa-solid fa-diamond-turn-right text-sm"></i>
                    </button>
                </div>

                <!-- Centre 2 -->
                <div class="centre-item flex items-center gap-3" data-name="IT Dept E-Waste Dropoff">
                    <div class="w-10 h-10 bg-purple-100 text-purple-600 rounded-xl flex items-center justify-center shrink-0">
                        <i class="fa-solid fa-plug text-lg"></i>
                    </div>
                    <div class="flex-grow">
                        <h3 class="font-bold text-sm text-gray-800">IT Dept E-Waste Dropoff</h3>
                        <p class="text-xs text-gray-500 font-medium">Accepts: Electronics, Batteries</p>
                        <p class="text-[11px] text-green-600 font-bold mt-0.5">0.8 km away • Closes at 5PM</p>
                    </div>
                    <button onclick="getDirections('IT Dept E-Waste Dropoff')" class="w-9 h-9 bg-gray-100 text-gray-600 rounded-xl flex items-center justify-center hover:bg-green-600 hover:text-white transition shrink-0 cursor-pointer">
                        <i class="fa-solid fa-diamond-turn-right text-sm"></i>
                    </button>
                </div>
            </div>
        </div>

        <!-- Mobile Bottom Navigation -->
        <nav class="fixed bottom-0 w-full bg-white border-t border-gray-200 flex justify-around p-3 pb-6 max-w-md left-1/2 transform -translate-x-1/2 z-20">
            <a href="dashboard.html" class="flex flex-col items-center text-green-600">
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
            <a href="profile.html" class="flex flex-col items-center text-gray-400 hover:text-green-600 transition">
                <i class="fa-solid fa-user text-xl mb-1"></i>
                <span class="text-[10px] font-bold">Profile</span>
            </a>
        </nav>

    </div>

    <!-- External JavaScript File -->
    <script src="centre_locator.js"></script>
</body>
</html>