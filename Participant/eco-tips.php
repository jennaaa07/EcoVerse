<?php
// eco_tips.php
$pageTitle = "Eco Tips - Eco Hub";
$dailyInsightTitle = "Reduce Energy Use at Home";
$dailyInsightDesc = "Simple everyday adjustments can lower your carbon footprint and energy bills without sacrificing comfort.";
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
        <a href="view-forum.html" class="w-10 h-10 rounded-full bg-gray-100 flex items-center justify-center text-gray-700 hover:bg-gray-200 transition">
            <i class="fa-solid fa-arrow-left text-lg"></i>
        </a>
        <h1 class="text-lg font-bold text-gray-800 flex items-center gap-1.5">
            <span>🌱</span> Eco Tips
        </h1>
        <button onclick="toggleBookmarkAll()" id="mainBookmarkBtn" class="w-10 h-10 rounded-full bg-gray-100 flex items-center justify-center text-gray-700 hover:bg-gray-200 transition cursor-pointer" title="Saved Tips">
            <i class="fa-solid fa-bookmark text-base"></i>
        </button>
    </header>

    <main class="p-4 max-w-md mx-auto space-y-4">

        <!-- Topic Highlight Card -->
        <div class="bg-gradient-to-r from-green-600 to-emerald-700 rounded-2xl p-5 text-white shadow-sm space-y-2">
            <div class="flex items-center justify-between">
                <span class="text-[10px] font-extrabold uppercase tracking-wider bg-white/20 px-2.5 py-0.5 rounded-full">Daily Insight</span>
                <span class="text-xs text-green-100"><i class="fa-solid fa-fire text-amber-300"></i> Trending</span>
            </div>
            <h2 class="font-bold text-base"><?php echo $dailyInsightTitle; ?></h2>
            <p class="text-xs text-green-50 leading-relaxed">
                <?php echo $dailyInsightDesc; ?>
            </p>
        </div>

        <!-- Filter Sub-categories & Navigation Links -->
        <div class="flex items-center gap-2 overflow-x-auto pb-1 scrollbar-none text-xs">
            <a href="view-forum.html" class="bg-white border border-gray-200 text-gray-600 font-semibold px-4 py-2 rounded-full hover:bg-gray-50 shrink-0">
                All Topics
            </a>
            <a href="eco-tips.html" class="bg-green-600 text-white font-bold px-4 py-2 rounded-full shadow-sm shrink-0">
                🌱 Eco Tips
            </a>
            <a href="zero-waste.html" class="bg-white border border-gray-200 text-gray-600 font-semibold px-4 py-2 rounded-full hover:bg-gray-50 shrink-0">
                ♻️ Zero Waste
            </a>
            <a href="announcement.html" class="bg-white border border-gray-200 text-gray-600 font-semibold px-4 py-2 rounded-full hover:bg-gray-50 shrink-0">
                📢 Announcements
            </a>
        </div>

        <!-- Tip Card 1 -->
        <div class="bg-white rounded-2xl p-4 shadow-sm border border-gray-100 space-y-3">
            <div class="flex items-center justify-between">
                <div class="flex items-center gap-2.5">
                    <img src="https://images.unsplash.com/photo-1534528741775-53994a69daeb?auto=format&fit=crop&w=100&q=80" class="w-8 h-8 rounded-full object-cover" alt="User">
                    <div>
                        <h4 class="font-bold text-xs text-gray-800">Sarah Jenkins</h4>
                        <p class="text-[10px] text-gray-400">Eco Ambassador • 2h ago</p>
                    </div>
                </div>
                <span class="text-[10px] font-bold text-green-700 bg-green-100 px-2 py-0.5 rounded-full">
                    ⚡ Energy
                </span>
            </div>

            <h3 class="font-bold text-sm text-gray-800">Switch to Cold Water Laundry</h3>
            <p class="text-xs text-gray-600 leading-relaxed">
                Washing clothes in cold water saves up to 90% of the energy your washing machine uses per load while preserving fabric fibers and colors longer.
            </p>

            <div class="bg-green-50/60 rounded-xl p-3 flex items-center justify-between text-xs text-green-800 font-medium">
                <span class="flex items-center gap-1.5 text-[11px]">
                    <i class="fa-solid fa-leaf text-green-600"></i> Estimated Impact:
                </span>
                <span class="font-bold text-[11px] bg-white px-2 py-0.5 rounded-md text-green-700 shadow-2xs border border-green-100">-150kg CO₂ / yr</span>
            </div>

            <div class="flex items-center justify-between pt-2 border-t border-gray-100 text-gray-500 text-xs">
                <button onclick="toggleLike(this, 'likeCount1')" class="flex items-center gap-1.5 hover:text-green-600 transition cursor-pointer">
                    <i class="fa-regular fa-heart text-base"></i>
                    <span id="likeCount1" class="font-semibold text-[11px]">34</span>
                </button>
                <button onclick="openComments('Switch to Cold Water Laundry')" class="flex items-center gap-1.5 hover:text-green-600 transition cursor-pointer">
                    <i class="fa-regular fa-comment text-base"></i>
                    <span class="font-semibold text-[11px]">8 Comments</span>
                </button>
                <button onclick="toggleBookmark(this)" class="hover:text-green-600 transition cursor-pointer" title="Bookmark tip">
                    <i class="fa-regular fa-bookmark text-base"></i>
                </button>
            </div>
        </div>

        <!-- Tip Card 2 -->
        <div class="bg-white rounded-2xl p-4 shadow-sm border border-gray-100 space-y-3">
            <div class="flex items-center justify-between">
                <div class="flex items-center gap-2.5">
                    <img src="https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?auto=format&fit=crop&w=100&q=80" class="w-8 h-8 rounded-full object-cover" alt="User">
                    <div>
                        <h4 class="font-bold text-xs text-gray-800">Alex Tan</h4>
                        <p class="text-[10px] text-gray-400">Community Member • 5h ago</p>
                    </div>
                </div>
                <span class="text-[10px] font-bold text-blue-700 bg-blue-100 px-2 py-0.5 rounded-full">
                    💧 Water
                </span>
            </div>

            <h3 class="font-bold text-sm text-gray-800">Install Aerators on Water Faucets</h3>
            <p class="text-xs text-gray-600 leading-relaxed">
                A standard faucet aerator reduces tap water flow by up to 30-50% without reducing water pressure felt during washing.
            </p>

            <div class="bg-blue-50/60 rounded-xl p-3 flex items-center justify-between text-xs text-blue-800 font-medium">
                <span class="flex items-center gap-1.5 text-[11px]">
                    <i class="fa-solid fa-droplet text-blue-600"></i> Water Saved:
                </span>
                <span class="font-bold text-[11px] bg-white px-2 py-0.5 rounded-md text-blue-700 shadow-2xs border border-blue-100">~1,200 Gal / yr</span>
            </div>

            <div class="flex items-center justify-between pt-2 border-t border-gray-100 text-gray-500 text-xs">
                <button onclick="toggleLike(this, 'likeCount2')" class="flex items-center gap-1.5 hover:text-green-600 transition cursor-pointer">
                    <i class="fa-regular fa-heart text-base"></i>
                    <span id="likeCount2" class="font-semibold text-[11px]">22</span>
                </button>
                <button onclick="openComments('Install Aerators on Water Faucets')" class="flex items-center gap-1.5 hover:text-green-600 transition cursor-pointer">
                    <i class="fa-regular fa-comment text-base"></i>
                    <span class="font-semibold text-[11px]">4 Comments</span>
                </button>
                <button onclick="toggleBookmark(this)" class="hover:text-green-600 transition cursor-pointer" title="Bookmark tip">
                    <i class="fa-regular fa-bookmark text-base"></i>
                </button>
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
        <a href="community.html" class="flex flex-col items-center text-green-600">
            <i class="fa-solid fa-users text-xl mb-1"></i>
            <span class="text-[10px] font-bold">Community</span>
        </a>
        <a href="profile.html" class="flex flex-col items-center text-gray-400 hover:text-green-600 transition">
            <i class="fa-solid fa-user text-xl mb-1"></i>
            <span class="text-[10px] font-bold">Profile</span>
        </a>
    </nav>

    <!-- External JavaScript File -->
    <script src="eco_tips.js"></script>
</body>
</html>