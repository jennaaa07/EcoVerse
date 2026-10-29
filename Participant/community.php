<?php
// community.php
$pageTitle = "Community - Eco Hub";
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
        <a href="dashboard.html" class="text-gray-400 hover:text-green-600 transition w-8">
            <i class="fa-solid fa-arrow-left text-xl"></i>
        </a>
        <h1 class="text-xl font-extrabold text-gray-800">Community</h1>
        <div class="w-8"></div> <!-- Spacer to keep title centered -->
    </header>

    <main class="p-4 max-w-md mx-auto space-y-6">
        
        <!-- Eco-Challenge Generator Widget -->
        <div class="bg-amber-50 rounded-2xl p-5 border border-amber-200/60 shadow-sm flex items-center justify-between gap-3">
            <div>
                <h2 class="font-bold text-amber-900 text-sm mb-1">Eco-Challenge Generator</h2>
                <p id="challengeText" class="text-xs text-amber-700/80 font-medium">Need inspiration? Generate a random daily eco-task for bonus points!</p>
            </div>
            <button onclick="generateEcoChallenge()" class="w-12 h-12 bg-amber-400 text-amber-950 rounded-2xl shadow-sm hover:bg-amber-500 transition active:scale-95 flex items-center justify-center text-xl shrink-0 cursor-pointer" title="Generate Challenge">
                <i class="fa-solid fa-dice"></i>
            </button>
        </div>

        <!-- View & Join Campaigns -->
        <div>
            <div class="flex justify-between items-center mb-3 px-1">
                <h3 class="text-sm font-bold text-gray-500 uppercase tracking-wider">Active Campaigns</h3>
                <a href="view-forum.html" class="text-xs text-green-600 font-bold hover:underline">View Forum <i class="fa-solid fa-chevron-right text-[10px] ml-0.5"></i></a>
            </div>

            <!-- Campaign Card 1 -->
            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden mb-4">
                <div class="h-36 bg-green-200 relative">
                    <img src="https://images.unsplash.com/photo-1532996122724-e3c354a0b15b?auto=format&fit=crop&w=800&q=80" class="w-full h-full object-cover" alt="Cleanup">
                    <div class="absolute top-3 right-3 bg-white/95 backdrop-blur-sm px-2.5 py-1 rounded-full text-xs font-extrabold text-green-700 shadow-sm border border-green-100 flex items-center gap-1">
                        <i class="fa-solid fa-leaf text-green-500"></i> +500 Pts
                    </div>
                </div>
                <div class="p-4">
                    <h4 class="font-bold text-base text-gray-800 mb-1">Campus Park Clean-up</h4>
                    <p class="text-xs text-gray-500 font-medium mb-4 flex items-center gap-1.5">
                        <i class="fa-regular fa-calendar text-gray-400"></i> Oct 24, 2026 • 120 Joined
                    </p>
                    <button onclick="joinCampaign('Campus Park Clean-up')" class="w-full bg-green-600 hover:bg-green-700 text-white font-bold py-3 rounded-xl transition shadow-sm active:scale-[0.98] text-sm flex items-center justify-center gap-2 cursor-pointer">
                        <i class="fa-solid fa-user-plus"></i> Join Campaign
                    </button>
                </div>
            </div>

            <!-- Campaign Card 2 -->
            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden p-4">
                <div class="flex items-center justify-between gap-3">
                    <div>
                        <span class="text-[10px] font-bold text-purple-700 bg-purple-100/80 px-2.5 py-0.5 rounded-full uppercase tracking-wider mb-2 inline-block">Virtual Event</span>
                        <h4 class="font-bold text-sm text-gray-800 mb-0.5">Zero-Plastic Week</h4>
                        <p class="text-xs text-gray-500 font-medium">Log 5 plastic-free meals.</p>
                    </div>
                    <button onclick="joinCampaign('Zero-Plastic Week')" class="bg-white border-2 border-green-600 text-green-600 font-bold px-4 py-2.5 rounded-xl text-xs hover:bg-green-50 transition active:scale-95 shrink-0 flex items-center justify-center cursor-pointer">
                        Join
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
    <script src="community.js"></script>
</body>
</html>