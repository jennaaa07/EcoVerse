<?php
// privacy_controls.php
$pageTitle = "Privacy Controls - EcoRewards";

$privacySettings = [
    "public_profile" => true,
    "share_activity" => true,
    "personalized_analytics" => false
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
    <header class="bg-white shadow-sm px-4 py-3 sticky top-0 z-10 flex items-center justify-between">
        <a href="setting.php" class="w-10 h-10 rounded-full bg-gray-100 flex items-center justify-center text-gray-700 hover:bg-gray-200 transition">
            <i class="fa-solid fa-arrow-left text-lg"></i>
        </a>
        <h1 class="text-lg font-bold text-gray-800">Privacy Controls</h1>
        <div class="w-10"></div>
    </header>

    <main class="p-4 max-w-md mx-auto space-y-6">

        <!-- Info Card -->
        <div class="bg-emerald-50 border border-emerald-100 rounded-2xl p-4 flex items-start gap-3">
            <div class="w-8 h-8 bg-emerald-100 text-emerald-600 rounded-lg flex items-center justify-center text-sm shrink-0 mt-0.5">
                <i class="fa-solid fa-shield-halved"></i>
            </div>
            <div>
                <h4 class="font-bold text-xs text-emerald-900 mb-1">Manage Your Data Sharing</h4>
                <p class="text-[11px] text-emerald-700 leading-relaxed">Control how your activity data and profile visibility are handled within the EcoRewards community and leaderboards.</p>
            </div>
        </div>

        <!-- Privacy Settings Form -->
        <form id="privacyForm" onsubmit="savePrivacyPreferences(event)">
            <div class="space-y-6">
                
                <!-- Privacy Settings Group -->
                <div class="space-y-4">
                    <h3 class="text-xs font-bold text-gray-400 uppercase tracking-wider px-2">Data & Visibility Preferences</h3>
                    
                    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden divide-y divide-gray-50">
                        
                        <!-- Profile Visibility -->
                        <div class="flex items-center justify-between p-4">
                            <div class="flex items-center gap-3">
                                <div class="w-8 h-8 bg-emerald-100 text-emerald-600 rounded-lg flex items-center justify-center text-sm">
                                    <i class="fa-solid fa-user-shield"></i>
                                </div>
                                <div>
                                    <span class="font-semibold text-gray-700 text-sm block">Public Profile & Leaderboard</span>
                                    <span class="text-[11px] text-gray-400">Allow others to see your eco-ranking</span>
                                </div>
                            </div>
                            <label class="relative inline-flex items-center cursor-pointer">
                                <input type="checkbox" id="publicProfileToggle" <?php echo $privacySettings['public_profile'] ? 'checked' : ''; ?> class="sr-only peer">
                                <div class="w-11 h-6 bg-gray-200 peer-focus:outline-none rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-green-600"></div>
                            </label>
                        </div>

                        <!-- Activity Share -->
                        <div class="flex items-center justify-between p-4">
                            <div class="flex items-center gap-3">
                                <div class="w-8 h-8 bg-blue-100 text-blue-600 rounded-lg flex items-center justify-center text-sm">
                                    <i class="fa-solid fa-share-nodes"></i>
                                </div>
                                <div>
                                    <span class="font-semibold text-gray-700 text-sm block">Share Activity Feed</span>
                                    <span class="text-[11px] text-gray-400">Post verified logs to community feed</span>
                                </div>
                            </div>
                            <label class="relative inline-flex items-center cursor-pointer">
                                <input type="checkbox" id="shareActivityToggle" <?php echo $privacySettings['share_activity'] ? 'checked' : ''; ?> class="sr-only peer">
                                <div class="w-11 h-6 bg-gray-200 peer-focus:outline-none rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-green-600"></div>
                            </label>
                        </div>

                        <!-- Analytics & Cookies -->
                        <div class="flex items-center justify-between p-4">
                            <div class="flex items-center gap-3">
                                <div class="w-8 h-8 bg-purple-100 text-purple-600 rounded-lg flex items-center justify-center text-sm">
                                    <i class="fa-solid fa-chart-pie"></i>
                                </div>
                                <div>
                                    <span class="font-semibold text-gray-700 text-sm block">Personalized Analytics</span>
                                    <span class="text-[11px] text-gray-400">Help improve carbon footprint tracking</span>
                                </div>
                            </div>
                            <label class="relative inline-flex items-center cursor-pointer">
                                <input type="checkbox" id="analyticsToggle" <?php echo $privacySettings['personalized_analytics'] ? 'checked' : ''; ?> class="sr-only peer">
                                <div class="w-11 h-6 bg-gray-200 peer-focus:outline-none rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-green-600"></div>
                            </label>
                        </div>

                    </div>
                </div>

                <!-- Data Management Section -->
                <div class="space-y-4">
                    <h3 class="text-xs font-bold text-gray-400 uppercase tracking-wider px-2">Data Management</h3>
                    
                    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
                        <button type="button" onclick="requestDataDownload()" class="w-full flex items-center justify-between p-4 hover:bg-gray-50 transition text-left bg-transparent border-none cursor-pointer">
                            <div class="flex items-center gap-3">
                                <div class="w-8 h-8 bg-gray-100 text-gray-600 rounded-lg flex items-center justify-center text-sm">
                                    <i class="fa-solid fa-download"></i>
                                </div>
                                <div>
                                    <span class="font-semibold text-gray-700 text-sm block">Download My Data</span>
                                    <span class="text-[11px] text-gray-400">Request a copy of your personal info</span>
                                </div>
                            </div>
                            <i class="fa-solid fa-chevron-right text-gray-300 text-xs"></i>
                        </button>
                    </div>
                </div>

                <!-- Save Button -->
                <div class="pt-2">
                    <button type="submit" id="savePreferencesBtn" class="w-full bg-green-600 hover:bg-green-700 text-white font-bold py-3 px-4 rounded-2xl shadow-sm transition text-xs cursor-pointer">
                        Save Preferences
                    </button>
                </div>

            </div>
        </form>

    </main>

    <!-- Mobile Bottom Navigation -->
    <nav class="fixed bottom-0 w-full bg-white border-t border-gray-200 flex justify-around p-3 pb-6 max-w-md left-1/2 transform -translate-x-1/2 z-20">
        <a href="dashboard.php" class="flex flex-col items-center text-gray-400 hover:text-green-600 transition">
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
        <a href="profile.php" class="flex flex-col items-center text-green-600">
            <i class="fa-solid fa-user text-xl mb-1"></i>
            <span class="text-[10px] font-bold">Profile</span>
        </a>
    </nav>

    <!-- External JavaScript File -->
    <script src="privacy_controls.js"></script>
</body>
</html>