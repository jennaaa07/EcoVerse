<?php
// policy.php
$pageTitle = "App Guidelines & Policy - EcoRewards";
$lastUpdated = "August 2026";
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
        <a href="helpAndSupport.html" class="w-10 h-10 rounded-full bg-gray-100 flex items-center justify-center text-gray-700 hover:bg-gray-200 transition">
            <i class="fa-solid fa-arrow-left text-lg"></i>
        </a>
        <h1 class="text-lg font-bold text-gray-800">App Guidelines & Policy</h1>
        <button onclick="sharePolicySummary()" class="w-10 h-10 rounded-full bg-gray-100 flex items-center justify-center text-gray-700 hover:bg-gray-200 transition cursor-pointer" title="Share Policy">
            <i class="fa-solid fa-share-nodes text-sm"></i>
        </button>
    </header>

    <main class="p-4 max-w-md mx-auto space-y-6">

        <!-- Last Updated Notice -->
        <div class="bg-gray-100 border border-gray-200 rounded-2xl p-4 flex items-center gap-3">
            <div class="w-8 h-8 bg-gray-200 text-gray-600 rounded-lg flex items-center justify-center text-sm shrink-0">
                <i class="fa-solid fa-file-contract"></i>
            </div>
            <div>
                <h4 class="font-bold text-xs text-gray-800">Legal Agreement</h4>
                <p class="text-[11px] text-gray-500">Last updated: <?php echo $lastUpdated; ?></p>
            </div>
        </div>

        <!-- Terms Content Card -->
        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-5 space-y-4 text-xs text-gray-600 leading-relaxed">
            
            <div class="space-y-2">
                <h3 class="font-bold text-gray-800 text-sm">1. Acceptance of Terms</h3>
                <p>By accessing or using the EcoRewards platform, you agree to be bound by these Terms of Service. If you do not agree to all of these terms, do not use our services or applications.</p>
            </div>

            <hr class="border-gray-100">

            <div class="space-y-2">
                <h3 class="font-bold text-gray-800 text-sm">2. User Accounts & Responsibilities</h3>
                <p>You are responsible for maintaining the confidentiality of your account credentials and for all activities that occur under your account. You agree to notify us immediately of any unauthorized use of your account.</p>
            </div>

            <hr class="border-gray-100">

            <div class="space-y-2">
                <h3 class="font-bold text-gray-800 text-sm">3. Rewards and Activity Tracking</h3>
                <p>EcoRewards grants eco-points based on verified sustainable activities and submissions. Points hold no cash value and are subject to program rules, modification, or termination at any time without prior notice.</p>
            </div>

            <hr class="border-gray-100">

            <div class="space-y-2">
                <h3 class="font-bold text-gray-800 text-sm">4. Prohibited Conduct</h3>
                <p>Users agree not to exploit, misuse, or falsify activity logs, tamper with platform security features, or harass other members within the community platform.</p>
            </div>

            <hr class="border-gray-100">

            <div class="space-y-2">
                <h3 class="font-bold text-gray-800 text-sm">5. Contact Information</h3>
                <p>If you have any questions about these Terms, please reach out to our support team through the profile help section.</p>
            </div>

        </div>

        <!-- Accept/Back Action -->
        <div class="pt-2">
            <button onclick="handlePolicyAcknowledgement()" class="block text-center w-full bg-green-600 hover:bg-green-700 text-white font-bold py-3 px-4 rounded-2xl shadow-sm transition text-xs cursor-pointer">
                Got It
            </button>
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
    <script src="policy.js"></script>
</body>
</html>