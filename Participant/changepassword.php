<?php
// change_password.php
$pageTitle = "Change Password - EcoRewards";
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
        <a href="setting.html" class="w-10 h-10 rounded-full bg-gray-100 flex items-center justify-center text-gray-700 hover:bg-gray-200 transition">
            <i class="fa-solid fa-arrow-left text-lg"></i>
        </a>
        <h1 class="text-lg font-bold text-gray-800">Change Password</h1>
        <div class="w-10"></div>
    </header>

    <main class="p-4 max-w-md mx-auto space-y-6">

        <!-- Info Card -->
        <div class="bg-orange-50 border border-orange-100 rounded-2xl p-4 flex items-start gap-3">
            <div class="w-8 h-8 bg-orange-100 text-orange-600 rounded-lg flex items-center justify-center text-sm shrink-0 mt-0.5">
                <i class="fa-solid fa-lock"></i>
            </div>
            <div>
                <h4 class="font-bold text-xs text-orange-900 mb-1">Secure Your Account</h4>
                <p class="text-[11px] text-orange-700 leading-relaxed">Your new password must be at least 8 characters long and include a mix of letters, numbers, and symbols.</p>
            </div>
        </div>

        <!-- Password Form -->
        <form id="changePasswordForm" class="bg-white rounded-2xl shadow-sm border border-gray-100 p-5 space-y-4">
            
            <!-- Current Password -->
            <div class="space-y-1.5">
                <label class="block text-xs font-bold text-gray-700">Current Password</label>
                <div class="relative">
                    <span class="absolute inset-y-0 left-0 flex items-center pl-3.5 pointer-events-none text-gray-400">
                        <i class="fa-solid fa-key text-xs"></i>
                    </span>
                    <input type="password" id="currentPassword" placeholder="••••••••••••" class="w-full bg-gray-50 border border-gray-200 rounded-xl py-3 pl-10 pr-10 text-xs focus:outline-none focus:border-green-600 focus:bg-white transition shadow-sm">
                    <button type="button" onclick="togglePasswordVisibility('currentPassword', this)" class="absolute inset-y-0 right-0 flex items-center pr-3.5 text-gray-400 hover:text-gray-600 cursor-pointer">
                        <i class="fa-solid fa-eye text-xs"></i>
                    </button>
                </div>
            </div>

            <!-- New Password -->
            <div class="space-y-1.5">
                <label class="block text-xs font-bold text-gray-700">New Password</label>
                <div class="relative">
                    <span class="absolute inset-y-0 left-0 flex items-center pl-3.5 pointer-events-none text-gray-400">
                        <i class="fa-solid fa-lock text-xs"></i>
                    </span>
                    <input type="password" id="newPassword" placeholder="••••••••••••" class="w-full bg-gray-50 border border-gray-200 rounded-xl py-3 pl-10 pr-10 text-xs focus:outline-none focus:border-green-600 focus:bg-white transition shadow-sm">
                    <button type="button" onclick="togglePasswordVisibility('newPassword', this)" class="absolute inset-y-0 right-0 flex items-center pr-3.5 text-gray-400 hover:text-gray-600 cursor-pointer">
                        <i class="fa-solid fa-eye text-xs"></i>
                    </button>
                </div>
            </div>

            <!-- Confirm New Password -->
            <div class="space-y-1.5">
                <label class="block text-xs font-bold text-gray-700">Confirm New Password</label>
                <div class="relative">
                    <span class="absolute inset-y-0 left-0 flex items-center pl-3.5 pointer-events-none text-gray-400">
                        <i class="fa-solid fa-lock text-xs"></i>
                    </span>
                    <input type="password" id="confirmPassword" placeholder="••••••••••••" class="w-full bg-gray-50 border border-gray-200 rounded-xl py-3 pl-10 pr-10 text-xs focus:outline-none focus:border-green-600 focus:bg-white transition shadow-sm">
                    <button type="button" onclick="togglePasswordVisibility('confirmPassword', this)" class="absolute inset-y-0 right-0 flex items-center pr-3.5 text-gray-400 hover:text-gray-600 cursor-pointer">
                        <i class="fa-solid fa-eye text-xs"></i>
                    </button>
                </div>
            </div>

            <!-- Submit Button -->
            <div class="pt-2">
                <button type="submit" class="w-full bg-green-600 hover:bg-green-700 text-white font-bold py-3 px-4 rounded-2xl shadow-sm transition text-xs cursor-pointer">
                    Update Password
                </button>
            </div>

        </form>

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
        <a href="community.html" class="flex flex-col items-center text-gray-400 hover:text-green-600 transition">
            <i class="fa-solid fa-users text-xl mb-1"></i>
            <span class="text-[10px] font-bold">Community</span>
        </a>
        <a href="profile.html" class="flex flex-col items-center text-green-600">
            <i class="fa-solid fa-user text-xl mb-1"></i>
            <span class="text-[10px] font-bold">Profile</span>
        </a>
    </nav>

    <!-- External JavaScript File -->
    <script src="change_password.js"></script>
</body>
</html>