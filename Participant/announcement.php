<?php
// announcements.php
$pageTitle = "Announcements - Eco Hub";
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
            <span>📢</span> Announcements
        </h1>
        <button id="notificationBellBtn" class="w-10 h-10 rounded-full bg-gray-100 flex items-center justify-center text-gray-700 hover:bg-gray-200 transition cursor-pointer">
            <i class="fa-solid fa-bell text-base"></i>
        </button>
    </header>

    <main class="p-4 max-w-md mx-auto space-y-4">

        <!-- Topic Highlight Card -->
        <div class="bg-gradient-to-r from-amber-500 to-orange-600 rounded-2xl p-5 text-white shadow-sm space-y-2">
            <div class="flex items-center justify-between">
                <span class="text-[10px] font-extrabold uppercase tracking-wider bg-white/20 px-2.5 py-0.5 rounded-full">Official Notice</span>
                <span class="text-xs text-amber-100"><i class="fa-solid fa-bullhorn text-amber-200"></i> Platform Update</span>
            </div>
            <h2 class="font-bold text-base">Campus Sustainability Week 2026</h2>
            <p class="text-xs text-amber-50 leading-relaxed">
                Stay updated with official news, upcoming campus recycling drives, and community reward challenge dates.
            </p>
        </div>

        <!-- Filter Sub-categories & Navigation Links -->
        <div class="flex items-center gap-2 overflow-x-auto pb-1 scrollbar-none text-xs">
            <a href="view-forum.html" class="bg-white border border-gray-200 text-gray-600 font-semibold px-4 py-2 rounded-full hover:bg-gray-50 shrink-0">
                All Topics
            </a>
            <a href="eco-tips.html" class="bg-white border border-gray-200 text-gray-600 font-semibold px-4 py-2 rounded-full hover:bg-gray-50 shrink-0">
                🌱 Eco Tips
            </a>
            <a href="zero-waste.html" class="bg-white border border-gray-200 text-gray-600 font-semibold px-4 py-2 rounded-full hover:bg-gray-50 shrink-0">
                ♻️ Zero Waste
            </a>
            <a href="announcement.html" class="bg-amber-600 text-white font-bold px-4 py-2 rounded-full shadow-sm shrink-0">
                📢 Announcements
            </a>
        </div>

        <!-- Announcement Card 1 -->
        <div class="bg-white rounded-2xl p-4 shadow-sm border border-gray-100 space-y-3" data-announcement-id="1">
            <div class="flex items-center justify-between">
                <div class="flex items-center gap-2.5">
                    <div class="w-8 h-8 rounded-full bg-amber-100 text-amber-700 flex items-center justify-center font-bold text-xs shrink-0">
                        HQ
                    </div>
                    <div>
                        <h4 class="font-bold text-xs text-gray-800">Eco Hub Admin</h4>
                        <p class="text-[10px] text-gray-400">Official Announcement • 1d ago</p>
                    </div>
                </div>
                <span class="text-[10px] font-bold text-amber-700 bg-amber-100 px-2 py-0.5 rounded-full">
                    🎉 Event
                </span>
            </div>

            <h3 class="font-bold text-sm text-gray-800">E-Waste Collection Drive This Friday!</h3>
            <p class="text-xs text-gray-600 leading-relaxed">
                Bring your old cables, batteries, and electronics to the Student Union plaza between 10:00 AM and 4:00 PM. Double Eco-Points awarded for all certified submissions!
            </p>

            <div class="bg-amber-50/60 rounded-xl p-3 flex items-center justify-between text-xs text-amber-900 font-medium">
                <span class="flex items-center gap-1.5 text-[11px]">
                    <i class="fa-solid fa-calendar-day text-amber-600"></i> Event Date:
                </span>
                <span class="font-bold text-[11px] bg-white px-2 py-0.5 rounded-md text-amber-800 shadow-2xs border border-amber-200">Friday, 10 AM - 4 PM</span>
            </div>

            <div class="flex items-center justify-between pt-2 border-t border-gray-100 text-gray-500 text-xs">
                <button onclick="toggleLike(this)" class="like-btn flex items-center gap-1.5 hover:text-amber-600 transition cursor-pointer" data-likes="89">
                    <i class="fa-regular fa-heart"></i>
                    <span class="font-semibold text-[11px] like-count">89</span>
                </button>
                <button onclick="openComments(1)" class="flex items-center gap-1.5 hover:text-amber-600 transition cursor-pointer">
                    <i class="fa-regular fa-comment"></i>
                    <span class="font-semibold text-[11px]">24 Comments</span>
                </button>
                <button onclick="toggleBookmark(this)" class="bookmark-btn hover:text-amber-600 transition cursor-pointer">
                    <i class="fa-regular fa-bookmark"></i>
                </button>
            </div>
        </div>

        <!-- Announcement Card 2 -->
        <div class="bg-white rounded-2xl p-4 shadow-sm border border-gray-100 space-y-3" data-announcement-id="2">
            <div class="flex items-center justify-between">
                <div class="flex items-center gap-2.5">
                    <div class="w-8 h-8 rounded-full bg-amber-100 text-amber-700 flex items-center justify-center font-bold text-xs shrink-0">
                        HQ
                    </div>
                    <div>
                        <h4 class="font-bold text-xs text-gray-800">Eco Hub Admin</h4>
                        <p class="text-[10px] text-gray-400">System Notice • 3d ago</p>
                    </div>
                </div>
                <span class="text-[10px] font-bold text-blue-700 bg-blue-100 px-2 py-0.5 rounded-full">
                    ⚙️ Update
                </span>
            </div>

            <h3 class="font-bold text-sm text-gray-800">New Store Voucher Rewards Available</h3>
            <p class="text-xs text-gray-600 leading-relaxed">
                You can now redeem your Eco-Points for campus coffee shop discounts and reusable water bottle vouchers directly from the Store tab!
            </p>

            <div class="flex items-center justify-between pt-2 border-t border-gray-100 text-gray-500 text-xs">
                <button onclick="toggleLike(this)" class="like-btn flex items-center gap-1.5 hover:text-amber-600 transition cursor-pointer" data-likes="64">
                    <i class="fa-regular fa-heart"></i>
                    <span class="font-semibold text-[11px] like-count">64</span>
                </button>
                <button onclick="openComments(2)" class="flex items-center gap-1.5 hover:text-amber-600 transition cursor-pointer">
                    <i class="fa-regular fa-comment"></i>
                    <span class="font-semibold text-[11px]">7 Comments</span>
                </button>
                <button onclick="toggleBookmark(this)" class="bookmark-btn hover:text-amber-600 transition cursor-pointer">
                    <i class="fa-regular fa-bookmark"></i>
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
    <script src="announcements.js"></script>
</body>
</html>