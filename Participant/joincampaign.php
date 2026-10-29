<?php
// join_campaign.php
$pageTitle = "Join Campaign - EcoRewards";
$campaignTitle = "City Park Tree Planting";
$campaignCategory = "Community Event";
$pointsEarned = 300;
$spotsLeft = 14;
$totalSpots = 50;
$duration = "3 Hours";
$eventDate = "Saturday, April 18, 2026";
$eventTime = "8:30 AM – 11:30 AM";
$locationName = "Central City Green Park";
$locationDetails = "Gate 3 Assembly Point, Main Avenue";
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

    <!-- Header & Back Navigation -->
    <header class="bg-white shadow-sm sticky top-0 z-10">
        <div class="px-4 py-3 flex items-center justify-between">
            <a href="community.html" class="w-10 h-10 rounded-full bg-gray-100 flex items-center justify-center text-gray-700 hover:bg-gray-200 transition">
                <i class="fa-solid fa-arrow-left text-lg"></i>
            </a>
            <h1 class="text-lg font-bold text-gray-800">Campaign Details</h1>
            <button type="button" onclick="shareCampaign()" class="w-10 h-10 rounded-full bg-gray-100 flex items-center justify-center text-gray-700 hover:bg-gray-200 transition cursor-pointer">
                <i class="fa-solid fa-share-nodes text-base"></i>
            </button>
        </div>
    </header>

    <main class="max-w-md mx-auto">
        <!-- Banner Image / Icon -->
        <div class="h-48 bg-gradient-to-br from-green-500 to-emerald-700 flex flex-col items-center justify-center text-white p-6 relative">
            <span class="absolute top-3 left-3 bg-white/20 backdrop-blur-md text-white text-xs font-bold px-3 py-1 rounded-full border border-white/30">
                <?php echo htmlspecialchars($campaignCategory); ?>
            </span>
            <i class="fa-solid fa-tree text-6xl mb-2 opacity-90"></i>
            <h2 class="text-2xl font-extrabold text-center"><?php echo htmlspecialchars($campaignTitle); ?></h2>
        </div>

        <div class="p-4 space-y-5">
            <!-- Event Quick Stats Bar -->
            <div class="bg-white rounded-2xl p-4 shadow-sm border border-gray-100 grid grid-cols-3 divide-x divide-gray-100 text-center">
                <div>
                    <p class="text-xs text-gray-400 font-medium">Earn</p>
                    <p class="text-base font-extrabold text-green-600 flex items-center justify-center gap-1">
                        <i class="fa-solid fa-leaf text-xs"></i> <?php echo $pointsEarned; ?> pts
                    </p>
                </div>
                <div>
                    <p class="text-xs text-gray-400 font-medium">Spots Left</p>
                    <p class="text-base font-extrabold text-gray-800"><?php echo $spotsLeft; ?> / <?php echo $totalSpots; ?></p>
                </div>
                <div>
                    <p class="text-xs text-gray-400 font-medium">Duration</p>
                    <p class="text-base font-extrabold text-gray-800"><?php echo htmlspecialchars($duration); ?></p>
                </div>
            </div>

            <!-- Date, Time, Location -->
            <div class="bg-white rounded-2xl p-4 shadow-sm border border-gray-100 space-y-3">
                <div class="flex items-start gap-3">
                    <div class="w-9 h-9 rounded-xl bg-green-100 text-green-700 flex items-center justify-center flex-shrink-0">
                        <i class="fa-regular fa-calendar-check text-lg"></i>
                    </div>
                    <div>
                        <h4 class="text-xs font-bold text-gray-400 uppercase tracking-wider">Date & Time</h4>
                        <p class="text-sm font-semibold text-gray-800"><?php echo htmlspecialchars($eventDate); ?></p>
                        <p class="text-xs text-gray-500"><?php echo htmlspecialchars($eventTime); ?></p>
                    </div>
                </div>

                <hr class="border-gray-100">

                <div class="flex items-start gap-3">
                    <div class="w-9 h-9 rounded-xl bg-blue-100 text-blue-700 flex items-center justify-center flex-shrink-0">
                        <i class="fa-solid fa-location-dot text-lg"></i>
                    </div>
                    <div>
                        <h4 class="text-xs font-bold text-gray-400 uppercase tracking-wider">Location</h4>
                        <p class="text-sm font-semibold text-gray-800"><?php echo htmlspecialchars($locationName); ?></p>
                        <p class="text-xs text-gray-500"><?php echo htmlspecialchars($locationDetails); ?></p>
                    </div>
                </div>
            </div>

            <!-- About Campaign -->
            <div class="bg-white rounded-2xl p-4 shadow-sm border border-gray-100 space-y-2">
                <h3 class="font-bold text-base text-gray-800">About the Campaign</h3>
                <p class="text-xs text-gray-600 leading-relaxed">
                    Join local eco-enthusiasts as we aim to plant over 100 native saplings in Central City Green Park. Gloves, shovels, and refreshments will be provided. Earn 300 EcoRewards points upon check-in verification!
                </p>
                
                <h4 class="font-bold text-xs text-gray-700 pt-2">What to bring:</h4>
                <ul class="text-xs text-gray-600 space-y-1 list-disc list-inside">
                    <li>Reusable water bottle</li>
                    <li>Comfortable outdoor footwear</li>
                    <li>Sun protection (hat/sunscreen)</li>
                </ul>
            </div>

            <!-- Registration Form -->
            <div class="bg-white rounded-2xl p-4 shadow-sm border border-gray-100 space-y-3">
                <h3 class="font-bold text-base text-gray-800">Volunteer Details</h3>
                
                <form id="campaignForm" onsubmit="event.preventDefault(); submitRegistration();" class="space-y-3">
                    <div>
                        <label class="block text-xs font-bold text-gray-700 mb-1">Full Name</label>
                        <input type="text" id="volunteerName" placeholder="Enter your full name" required class="w-full bg-gray-50 border border-gray-200 rounded-xl px-3 py-2 text-xs focus:outline-none focus:border-green-600">
                    </div>

                    <div>
                        <label class="block text-xs font-bold text-gray-700 mb-1">Phone Number</label>
                        <input type="tel" id="volunteerPhone" placeholder="+60 12-345 6789" required class="w-full bg-gray-50 border border-gray-200 rounded-xl px-3 py-2 text-xs focus:outline-none focus:border-green-600">
                    </div>

                    <div>
                        <label class="block text-xs font-bold text-gray-700 mb-1">Dietary Preferences (Optional)</label>
                        <select id="volunteerDiet" class="w-full bg-gray-50 border border-gray-200 rounded-xl px-3 py-2 text-xs text-gray-600 focus:outline-none focus:border-green-600">
                            <option value="none">No specific preference</option>
                            <option value="vegetarian">Vegetarian</option>
                            <option value="vegan">Vegan</option>
                            <option value="halal">Halal</option>
                        </select>
                    </div>

                    <div class="flex items-center gap-2 pt-1">
                        <input type="checkbox" id="terms" required class="w-4 h-4 text-green-600 rounded border-gray-300 focus:ring-green-500 cursor-pointer">
                        <label for="terms" class="text-[11px] text-gray-500 cursor-pointer">I agree to event safety guidelines and terms.</label>
                    </div>
                </form>
            </div>
        </div>
    </main>

    <!-- Bottom Action Bar -->
    <div class="fixed bottom-0 left-1/2 transform -translate-x-1/2 w-full max-w-md bg-white border-t border-gray-200 p-4 z-20">
        <button type="button" onclick="document.getElementById('campaignForm').requestSubmit()" class="w-full bg-green-600 hover:bg-green-700 text-white font-bold text-sm py-3 rounded-xl transition shadow-lg shadow-green-600/20 flex items-center justify-center gap-2 cursor-pointer">
            <i class="fa-solid fa-check"></i>
            Confirm Registration
        </button>
    </div>

    <!-- External JavaScript File -->
    <script src="join_campaign.js"></script>
</body>
</html>