<?php
// privacy.php
$pageTitle = "Privacy & Data Security - EcoRewards";

$privacyTopics = [
    [
        "id" => "topic-1",
        "title" => "1. Information We Collect",
        "content" => "We collect information you provide directly during registration (name, email, participant ID) as well as data related to your logged sustainable activities, uploaded photo proofs, and voucher redemption history."
    ],
    [
        "id" => "topic-2",
        "title" => "2. How We Use Your Data",
        "content" => "Your data is used to calculate eco-points, verify activity submissions, process store vouchers, and maintain community leaderboards. We do not sell your personal information to third parties."
    ],
    [
        "id" => "topic-3",
        "title" => "3. Data Security & Encryption",
        "content" => "All data transmitted between your device and our servers is protected using industry-standard SSL encryption. Account credentials are securely hashed and stored with robust access controls."
    ],
    [
        "id" => "topic-4",
        "title" => "4. Your Rights & Data Control",
        "content" => "You can view and edit your profile details at any time, manage privacy visibility controls, or request permanent account deletion along with complete removal of your personal records through settings."
    ]
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
        <a href="help_and_support.php" class="w-10 h-10 rounded-full bg-gray-100 flex items-center justify-center text-gray-700 hover:bg-gray-200 transition">
            <i class="fa-solid fa-arrow-left text-lg"></i>
        </a>
        <h1 class="text-lg font-bold text-gray-800">Privacy & Data Security</h1>
        <div class="w-10"></div>
    </header>

    <main class="p-4 max-w-md mx-auto space-y-6">

        <!-- Search Box -->
        <div class="relative">
            <i class="fa-solid fa-magnifying-glass absolute left-4 top-1/2 -translate-y-1/2 text-gray-400 text-sm"></i>
            <input type="text" id="privacySearchInput" onkeyup="filterPrivacyTopics()" placeholder="Search privacy topics..." class="w-full bg-white border border-gray-200 rounded-2xl py-3.5 pl-11 pr-4 text-xs font-medium placeholder-gray-400 shadow-sm focus:outline-none focus:border-green-500 focus:ring-1 focus:ring-green-500 transition">
        </div>

        <!-- Introduction Banner -->
        <div class="bg-purple-50 border border-purple-100 rounded-2xl p-4 flex items-start gap-3 shadow-sm">
            <div class="w-8 h-8 rounded-xl bg-purple-100 text-purple-600 flex items-center justify-center text-sm shrink-0 mt-0.5">
                <i class="fa-solid fa-shield-halved"></i>
            </div>
            <div>
                <h2 class="font-bold text-xs text-purple-900">Your Data Protection Commitment</h2>
                <p class="text-[11px] text-purple-700 mt-0.5 leading-relaxed">
                    EcoRewards is dedicated to safeguarding your personal data and ensuring transparency regarding how your information is collected and managed.
                </p>
            </div>
        </div>

        <!-- Privacy Topics Accordion -->
        <div class="space-y-3">
            <h3 class="text-xs font-bold text-gray-400 uppercase tracking-wider px-1">Privacy Policies</h3>
            
            <div id="privacyTopicsList" class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden divide-y divide-gray-50">
                <?php foreach ($privacyTopics as $topic): ?>
                    <details class="privacy-item group p-4 [&_summary::-webkit-details-marker]:hidden cursor-pointer" data-title="<?php echo strtolower($topic['title']); ?>" data-content="<?php echo strtolower($topic['content']); ?>">
                        <summary class="flex items-center justify-between font-bold text-xs text-gray-800">
                            <span><?php echo htmlspecialchars($topic['title']); ?></span>
                            <span class="transition group-open:-rotate-180 text-gray-400">
                                <i class="fa-solid fa-chevron-down text-xs"></i>
                            </span>
                        </summary>
                        <p class="mt-3 text-xs text-gray-500 leading-relaxed border-t border-gray-50 pt-3">
                            <?php echo htmlspecialchars($topic['content']); ?>
                        </p>
                    </details>
                <?php endforeach; ?>
            </div>
        </div>

        <!-- Related Links -->
        <div class="space-y-3">
            <h3 class="text-xs font-bold text-gray-400 uppercase tracking-wider px-1">Related Settings</h3>
            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
                <a href="privacy_controls.php" class="flex items-center justify-between p-4 border-b border-gray-50 hover:bg-gray-50 transition">
                    <div class="flex items-center gap-3">
                        <i class="fa-solid fa-user-shield text-emerald-600 text-sm"></i>
                        <span class="font-semibold text-gray-700 text-xs">Privacy Controls & Visibility</span>
                    </div>
                    <i class="fa-solid fa-chevron-right text-gray-300 text-xs"></i>
                </a>
                <a href="delete_account.php" class="flex items-center justify-between p-4 hover:bg-gray-50 transition">
                    <div class="flex items-center gap-3">
                        <i class="fa-solid fa-trash-can text-red-600 text-sm"></i>
                        <span class="font-semibold text-red-600 text-xs">Request Account Deletion</span>
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
    <script src="privacy.js"></script>
</body>
</html>