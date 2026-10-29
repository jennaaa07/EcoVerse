<?php
// profile.php
$pageTitle = "My Profile - EcoRewards";

$userProfile = [
    "name" => "Jane Doe",
    "initials" => "JD",
    "participant_id" => "P-102934",
    "badge" => "Eco Champion",
    "total_points" => "5.2k",
    "actions_count" => 34,
    "co2_saved" => "12kg"
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
    <header class="bg-white shadow-sm px-6 py-4 sticky top-0 z-10 flex justify-between items-center">
        <h1 class="text-xl font-extrabold text-gray-800">Profile</h1>
        <a href="setting.php" class="text-gray-400 hover:text-green-600 transition">
            <i class="fa-solid fa-gear text-xl"></i>
        </a>
    </header>

    <main class="p-4 max-w-md mx-auto">
        
        <!-- Profile Card -->
        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6 mb-6 flex flex-col items-center text-center">
            <div class="w-20 h-20 bg-green-600 rounded-full flex items-center justify-center text-white text-2xl font-bold shadow-md mb-3 relative">
                <?php echo htmlspecialchars($userProfile['initials']); ?>
                <a href="edit_profile.php" class="absolute bottom-0 right-0 bg-white text-gray-600 p-1.5 rounded-full border border-gray-200 shadow-sm hover:text-green-600 transition">
                    <i class="fa-solid fa-pen text-[10px]"></i>
                </a>
            </div>
            <h2 class="text-xl font-bold text-gray-800"><?php echo htmlspecialchars($userProfile['name']); ?></h2>
            <p class="text-gray-500 text-sm font-medium mb-2">Participant ID: <?php echo htmlspecialchars($userProfile['participant_id']); ?></p>
            <span class="bg-green-100 text-green-800 py-1 px-3 rounded-full text-xs font-bold border border-green-300">
                <i class="fa-solid fa-star text-yellow-500 mr-1"></i> <?php echo htmlspecialchars($userProfile['badge']); ?>
            </span>
        </div>

        <!-- Lifetime Stats Grid -->
        <h3 class="text-sm font-bold text-gray-500 mb-3 px-2 uppercase tracking-wider">Lifetime Impact</h3>
        <div class="grid grid-cols-3 gap-3 mb-8">
            <div class="bg-white p-3 rounded-xl shadow-sm border border-gray-100 text-center">
                <i class="fa-solid fa-leaf text-green-500 text-xl mb-1"></i>
                <p class="text-lg font-bold text-gray-800"><?php echo htmlspecialchars($userProfile['total_points']); ?></p>
                <p class="text-[10px] text-gray-500 uppercase font-bold">Total Pts</p>
            </div>
            <div class="bg-white p-3 rounded-xl shadow-sm border border-gray-100 text-center">
                <i class="fa-solid fa-list-check text-blue-500 text-xl mb-1"></i>
                <p class="text-lg font-bold text-gray-800"><?php echo htmlspecialchars($userProfile['actions_count']); ?></p>
                <p class="text-[10px] text-gray-500 uppercase font-bold">Actions</p>
            </div>
            <div class="bg-white p-3 rounded-xl shadow-sm border border-gray-100 text-center">
                <i class="fa-solid fa-cloud text-gray-400 text-xl mb-1"></i>
                <p class="text-lg font-bold text-gray-800"><?php echo htmlspecialchars($userProfile['co2_saved']); ?></p>
                <p class="text-[10px] text-gray-500 uppercase font-bold">CO₂ Saved</p>
            </div>
        </div>

        <!-- Menu List -->
        <h3 class="text-sm font-bold text-gray-500 mb-2 px-2 uppercase tracking-wider">Account</h3>
        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden mb-6">
            
            <a href="edit_profile.php" class="flex items-center justify-between p-4 border-b border-gray-50 hover:bg-gray-50 transition">
                <div class="flex items-center gap-3">
                    <div class="w-8 h-8 bg-green-100 text-green-600 rounded-lg flex items-center justify-center">
                        <i class="fa-solid fa-user-pen"></i>
                    </div>
                    <span class="font-semibold text-gray-700 text-sm">Edit Profile</span>
                </div>
                <i class="fa-solid fa-chevron-right text-gray-300 text-sm"></i>
            </a>

            <a href="my_qr_code.php" class="flex items-center justify-between p-4 border-b border-gray-50 hover:bg-gray-50 transition">
                <div class="flex items-center gap-3">
                    <div class="w-8 h-8 bg-purple-100 text-purple-600 rounded-lg flex items-center justify-center">
                        <i class="fa-solid fa-qrcode"></i>
                    </div>
                    <span class="font-semibold text-gray-700 text-sm">My QR Code</span>
                </div>
                <i class="fa-solid fa-chevron-right text-gray-300 text-sm"></i>
            </a>

            <a href="reward_history.php" class="flex items-center justify-between p-4 border-b border-gray-50 hover:bg-gray-50 transition">
                <div class="flex items-center gap-3">
                    <div class="w-8 h-8 bg-blue-100 text-blue-600 rounded-lg flex items-center justify-center">
                        <i class="fa-solid fa-clock-rotate-left"></i>
                    </div>
                    <span class="font-semibold text-gray-700 text-sm">Reward History</span>
                </div>
                <i class="fa-solid fa-chevron-right text-gray-300 text-sm"></i>
            </a>

            <a href="setting.php" class="flex items-center justify-between p-4 border-b border-gray-50 hover:bg-gray-50 transition">
                <div class="flex items-center gap-3">
                    <div class="w-8 h-8 bg-orange-100 text-orange-600 rounded-lg flex items-center justify-center">
                        <i class="fa-solid fa-bell"></i>
                    </div>
                    <span class="font-semibold text-gray-700 text-sm">Notifications & Settings</span>
                </div>
                <i class="fa-solid fa-chevron-right text-gray-300 text-sm"></i>
            </a>

            <a href="help_and_support.php" class="flex items-center justify-between p-4 hover:bg-gray-50 transition">
                <div class="flex items-center gap-3">
                    <div class="w-8 h-8 bg-gray-100 text-gray-600 rounded-lg flex items-center justify-center">
                        <i class="fa-solid fa-circle-question"></i>
                    </div>
                    <span class="font-semibold text-gray-700 text-sm">Help & Support</span>
                </div>
                <i class="fa-solid fa-chevron-right text-gray-300 text-sm"></i>
            </a>
        </div>

        <!-- Logout Button -->
        <button onclick="handleLogout()" class="w-full bg-white border border-red-200 text-red-600 hover:bg-red-50 font-bold py-4 rounded-xl shadow-sm transition flex items-center justify-center gap-2 cursor-pointer">
            <i class="fa-solid fa-arrow-right-from-bracket"></i> Log Out
        </button>

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
    <script src="profile.js"></script>
</body>
</html>