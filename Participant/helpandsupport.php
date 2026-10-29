<?php
// help_support.php
$pageTitle = "Help & Support - EcoRewards";
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
        <a href="profile.html" class="w-10 h-10 rounded-full bg-gray-100 flex items-center justify-center text-gray-700 hover:bg-gray-200 transition">
            <i class="fa-solid fa-arrow-left text-lg"></i>
        </a>
        <h1 class="text-lg font-bold text-gray-800">Help & Support</h1>
        <div class="w-10"></div> <!-- Placeholder to center title -->
    </header>

    <main class="p-4 max-w-md mx-auto space-y-6">

        <!-- Search Box -->
        <div class="relative">
            <i class="fa-solid fa-magnifying-glass absolute left-4 top-1/2 -translate-y-1/2 text-gray-400 text-sm"></i>
            <input type="text" id="faqSearchInput" onkeyup="filterFAQs()" placeholder="Search for help articles..." class="w-full bg-white border border-gray-200 rounded-2xl py-3.5 pl-11 pr-4 text-xs font-medium placeholder-gray-400 shadow-sm focus:outline-none focus:border-green-500 focus:ring-1 focus:ring-green-500 transition">
        </div>

        <!-- Quick Contact Actions -->
        <div>
            <h3 class="text-xs font-bold text-gray-400 uppercase tracking-wider px-1 mb-3">Contact Us</h3>
            <div class="grid grid-cols-2 gap-3">
                <a href="liveChat.html" class="bg-white border border-gray-100 rounded-2xl p-4 shadow-sm hover:shadow-md transition flex flex-col items-center text-center">
                    <div class="w-10 h-10 rounded-xl bg-green-100 text-green-600 flex items-center justify-center text-lg mb-2">
                        <i class="fa-solid fa-comments"></i>
                    </div>
                    <span class="font-bold text-xs text-gray-800">Live Chat</span>
                    <span class="text-[10px] text-gray-400 mt-0.5">24/7 Support</span>
                </a>
                <a href="emailSupport.html" class="bg-white border border-gray-100 rounded-2xl p-4 shadow-sm hover:shadow-md transition flex flex-col items-center text-center">
                    <div class="w-10 h-10 rounded-xl bg-blue-100 text-blue-600 flex items-center justify-center text-lg mb-2">
                        <i class="fa-solid fa-envelope"></i>
                    </div>
                    <span class="font-bold text-xs text-gray-800">Email Support</span>
                    <span class="text-[10px] text-gray-400 mt-0.5">Reply in 24 hrs</span>
                </a>
            </div>
        </div>

        <!-- Frequently Asked Questions -->
        <div class="space-y-3">
            <h3 class="text-xs font-bold text-gray-400 uppercase tracking-wider px-1">Frequently Asked Questions</h3>
            
            <div id="faqContainer" class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden divide-y divide-gray-50">
                <details class="faq-item group p-4 [&_summary::-webkit-details-marker]:hidden cursor-pointer">
                    <summary class="flex items-center justify-between font-bold text-xs text-gray-800">
                        <span>How do I earn Eco-Points?</span>
                        <span class="transition group-open:-rotate-180 text-gray-400">
                            <i class="fa-solid fa-chevron-down text-xs"></i>
                        </span>
                    </summary>
                    <p class="mt-3 text-xs text-gray-500 leading-relaxed border-t border-gray-50 pt-3">
                        You can earn points by logging sustainable activities such as recycling, using reusable containers, participating in eco-events, or scanning your QR code at designated campus hubs.
                    </p>
                </details>

                <details class="faq-item group p-4 [&_summary::-webkit-details-marker]:hidden cursor-pointer">
                    <summary class="flex items-center justify-between font-bold text-xs text-gray-800">
                        <span>How can I redeem my rewards?</span>
                        <span class="transition group-open:-rotate-180 text-gray-400">
                            <i class="fa-solid fa-chevron-down text-xs"></i>
                        </span>
                    </summary>
                    <p class="mt-3 text-xs text-gray-500 leading-relaxed border-t border-gray-50 pt-3">
                        Visit the Store tab from the main navigation, select your preferred reward voucher or merchandise, and tap "Redeem". Show the generated voucher QR code at checkout.
                    </p>
                </details>

                <details class="faq-item group p-4 [&_summary::-webkit-details-marker]:hidden cursor-pointer">
                    <summary class="flex items-center justify-between font-bold text-xs text-gray-800">
                        <span>Why was my activity submission rejected?</span>
                        <span class="transition group-open:-rotate-180 text-gray-400">
                            <i class="fa-solid fa-chevron-down text-xs"></i>
                        </span>
                    </summary>
                    <p class="mt-3 text-xs text-gray-500 leading-relaxed border-t border-gray-50 pt-3">
                        Submissions may be rejected if the uploaded photo proof is blurry, missing key verification elements, or if duplicate entries were detected.
                    </p>
                </details>

                <details class="faq-item group p-4 [&_summary::-webkit-details-marker]:hidden cursor-pointer">
                    <summary class="flex items-center justify-between font-bold text-xs text-gray-800">
                        <span>How do I change my account email?</span>
                        <span class="transition group-open:-rotate-180 text-gray-400">
                            <i class="fa-solid fa-chevron-down text-xs"></i>
                        </span>
                    </summary>
                    <p class="mt-3 text-xs text-gray-500 leading-relaxed border-t border-gray-50 pt-3">
                        Go to Profile > Edit Profile to update your personal information. For student ID or email changes, please contact administrator support directly.
                    </p>
                </details>
            </div>
        </div>

        <!-- Additional Resources -->
        <div class="space-y-3">
            <h3 class="text-xs font-bold text-gray-400 uppercase tracking-wider px-1">Resources</h3>
            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
                <!-- Linked to appGuidelines.html -->
                <a href="appGuidlines.html" class="flex items-center justify-between p-4 border-b border-gray-50 hover:bg-gray-50 transition">
                    <div class="flex items-center gap-3">
                        <i class="fa-solid fa-book text-green-600 text-sm"></i>
                        <span class="font-semibold text-gray-700 text-xs">App Guidelines & Policy</span>
                    </div>
                    <i class="fa-solid fa-chevron-right text-gray-300 text-xs"></i>
                </a>
                <a href="privacyPolicy.html" class="flex items-center justify-between p-4 hover:bg-gray-50 transition">
                    <div class="flex items-center gap-3">
                        <i class="fa-solid fa-shield-halved text-purple-600 text-sm"></i>
                        <span class="font-semibold text-gray-700 text-xs">Privacy & Data Security</span>
                    </div>
                    <i class="fa-solid fa-chevron-right text-gray-300 text-xs"></i>
                </a>
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
    <script src="help_support.js"></script>
</body>
</html>