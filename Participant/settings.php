<?php
// settings.php
$pageTitle = "Settings - EcoRewards";

// Mock user settings profile data
$userProfile = [
    "name" => "Jane Doe",
    "initials" => "JD",
    "participant_id" => "P-102934",
    "language" => "English (US)",
    "push_notifications_enabled" => true
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
        <a href="profile.php" class="text-gray-400 hover:text-green-600 transition w-8 flex items-center">
            <i class="fa-solid fa-arrow-left text-xl"></i>
        </a>
        <h1 class="text-xl font-extrabold text-gray-800">Settings</h1>
        <div class="w-8"></div>
    </header>

    <main class="p-4 max-w-md mx-auto space-y-6">
        
        <!-- Profile Overview Card -->
        <div class="bg-white rounded-2xl p-4 shadow-sm border border-gray-100 flex items-center justify-between">
            <div class="flex items-center gap-3">
                <div class="w-12 h-12 bg-green-600 rounded-full flex items-center justify-center text-white font-bold text-base shadow-sm">
                    <?php echo $userProfile['initials']; ?>
                </div>
                <div>
                    <h2 class="font-bold text-gray-800 text-sm"><?php echo htmlspecialchars($userProfile['name']); ?></h2>
                    <p class="text-gray-400 text-xs font-medium">Participant ID: <?php echo htmlspecialchars($userProfile['participant_id']); ?></p>
                </div>
            </div>
            <a href="profile.php" class="text-xs font-bold text-green-600 hover:underline">View Profile</a>
        </div>

        <!-- Preferences -->
        <div>
            <h3 class="text-xs font-bold text-gray-400 uppercase tracking-wider mb-2 px-2">Preferences</h3>
            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
                
                <!-- Push Notifications -->
                <div class="flex items-center justify-between p-4 border-b border-gray-50">
                    <div class="flex items-center gap-3">
                        <div class="w-8 h-8 bg-green-100 text-green-600 rounded-lg flex items-center justify-center text-sm">
                            <i class="fa-solid fa-bell"></i>
                        </div>
                        <div>
                            <span class="font-semibold text-gray-700 text-sm block">Push Notifications</span>
                            <span class="text-[11px] text-gray-400">Activity & campaign updates</span>
                        </div>
                    </div>
                    <label class="relative inline-flex items-center cursor-pointer">
                        <input type="checkbox" id="pushToggle" <?php echo $userProfile['push_notifications_enabled'] ? 'checked' : ''; ?> onchange="toggleNotifications(this)" class="sr-only peer">
                        <div class="w-11 h-6 bg-gray-200 peer-focus:outline-none rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-green-600"></div>
                    </label>
                </div>

                <!-- Language Selection -->
                <a href="language.php" class="flex items-center justify-between p-4 hover:bg-gray-50 transition">
                    <div class="flex items-center gap-3">
                        <div class="w-8 h-8 bg-blue-100 text-blue-600 rounded-lg flex items-center justify-center text-sm">
                            <i class="fa-solid fa-globe"></i>
                        </div>
                        <div>
                            <span class="font-semibold text-gray-700 text-sm block">Language</span>
                            <span class="text-[11px] text-gray-400"><?php echo htmlspecialchars($userProfile['language']); ?></span>
                        </div>
                    </div>
                    <i class="fa-solid fa-chevron-right text-gray-300 text-xs"></i>
                </a>

            </div>
        </div>

        <!-- Security & Privacy -->
        <div>
            <h3 class="text-xs font-bold text-gray-400 uppercase tracking-wider mb-2 px-2">Security & Privacy</h3>
            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
                
                <!-- Change Password -->
                <a href="change_password.php" class="flex items-center justify-between p-4 border-b border-gray-50 hover:bg-gray-50 transition">
                    <div class="flex items-center gap-3">
                        <div class="w-8 h-8 bg-orange-100 text-orange-600 rounded-lg flex items-center justify-center text-sm">
                            <i class="fa-solid fa-lock"></i>
                        </div>
                        <span class="font-semibold text-gray-700 text-sm">Change Password</span>
                    </div>
                    <i class="fa-solid fa-chevron-right text-gray-300 text-xs"></i>
                </a>

                <!-- Privacy Controls -->
                <a href="privacy_controls.php" class="flex items-center justify-between p-4 hover:bg-gray-50 transition">
                    <div class="flex items-center gap-3">
                        <div class="w-8 h-8 bg-emerald-100 text-emerald-600 rounded-lg flex items-center justify-center text-sm">
                            <i class="fa-solid fa-shield-halved"></i>
                        </div>
                        <span class="font-semibold text-gray-700 text-sm">Privacy Controls</span>
                    </div>
                    <i class="fa-solid fa-chevron-right text-gray-300 text-xs"></i>
                </a>

            </div>
        </div>

        <!-- Account Actions -->
        <div>
            <h3 class="text-xs font-bold text-gray-400 uppercase tracking-wider mb-2 px-2">Account Actions</h3>
            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
                <!-- Delete Account -->
                <a href="delete_account.php" class="w-full text-left p-4 hover:bg-red-50 transition flex items-center justify-between text-red-600 font-semibold text-sm">
                    <div class="flex items-center gap-3">
                        <div class="w-8 h-8 bg-red-100 text-red-600 rounded-lg flex items-center justify-center text-sm">
                            <i class="fa-solid fa-trash-can"></i>
                        </div>
                        <span>Delete Account</span>
                    </div>
                    <i class="fa-solid fa-chevron-right text-red-300 text-xs"></i>
                </a>
            </div>
        </div>

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
    <script src="settings.js"></script>
</body>
</html>