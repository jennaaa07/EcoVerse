<?php
// qr_code.php
$pageTitle = "My QR Code - EcoRewards";

$user = [
    "name" => "Jane Doe",
    "initials" => "JD",
    "participant_id" => "P-102934",
    "status" => "Active"
];

$qrImageUrl = "https://api.qrserver.com/v1/create-qr-code/?size=200x200&data=" . urlencode($user['participant_id'] . "-" . strtoupper(str_replace(' ', '-', $user['name'])));
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
        <a href="profile.php" class="w-10 h-10 rounded-full bg-gray-100 flex items-center justify-center text-gray-700 hover:bg-gray-200 transition">
            <i class="fa-solid fa-arrow-left text-lg"></i>
        </a>
        <h1 class="text-lg font-bold text-gray-800">My QR Code</h1>
        <button onclick="shareQRCode()" class="w-10 h-10 rounded-full bg-gray-100 flex items-center justify-center text-gray-700 hover:bg-gray-200 transition cursor-pointer">
            <i class="fa-solid fa-share-nodes text-base"></i>
        </button>
    </header>

    <main class="p-4 max-w-md mx-auto space-y-6">

        <!-- QR Code Display Card -->
        <div class="bg-white rounded-3xl shadow-sm border border-gray-100 p-6 flex flex-col items-center text-center space-y-4">
            
            <!-- User Info Header -->
            <div class="flex items-center gap-3 w-full pb-4 border-b border-gray-100">
                <div class="w-12 h-12 bg-green-600 rounded-full flex items-center justify-center text-white font-bold text-lg shadow-sm shrink-0">
                    <?php echo htmlspecialchars($user['initials']); ?>
                </div>
                <div class="text-left">
                    <h2 class="font-bold text-base text-gray-800"><?php echo htmlspecialchars($user['name']); ?></h2>
                    <p class="text-xs text-gray-400 font-medium">Participant ID: <span id="participantId"><?php echo htmlspecialchars($user['participant_id']); ?></span></p>
                </div>
                <span class="ml-auto bg-green-100 text-green-800 text-[10px] font-bold px-2.5 py-1 rounded-full flex items-center gap-1 border border-green-200">
                    <i class="fa-solid fa-check-circle text-green-600"></i> <?php echo htmlspecialchars($user['status']); ?>
                </span>
            </div>

            <!-- Instructions -->
            <p class="text-xs text-gray-500 max-w-xs">
                Scan this QR code at campus drop-off stations or partner stores to earn and redeem Eco-Points.
            </p>

            <!-- QR Code Graphic Container -->
            <div class="bg-gray-50 p-5 rounded-2xl border border-gray-200 shadow-inner flex flex-col items-center my-2">
                <img id="qrImageElement" src="<?php echo $qrImageUrl; ?>" class="w-48 h-48 rounded-lg shadow-xs transition-opacity duration-300" alt="User QR Code">
                <p class="text-[11px] font-mono font-bold text-gray-500 tracking-widest mt-3 bg-white px-3 py-1 rounded-md border border-gray-200">
                    <?php echo htmlspecialchars($user['participant_id']); ?>
                </p>
            </div>

            <!-- Quick Action Buttons -->
            <div class="grid grid-cols-2 gap-3 w-full pt-2">
                <button onclick="downloadQRCode()" class="bg-green-600 text-white font-bold text-xs py-3 rounded-xl shadow-sm hover:bg-green-700 transition flex items-center justify-center gap-2 cursor-pointer">
                    <i class="fa-solid fa-download text-xs"></i> Save Image
                </button>
                <button onclick="refreshQRCode()" class="bg-gray-100 text-gray-700 font-bold text-xs py-3 rounded-xl hover:bg-gray-200 transition flex items-center justify-center gap-2 cursor-pointer">
                    <i id="refreshIcon" class="fa-solid fa-arrows-rotate text-xs"></i> Refresh
                </button>
            </div>

        </div>

        <!-- Info Card -->
        <div class="bg-green-50/60 rounded-2xl p-4 border border-green-100 flex items-start gap-3">
            <div class="w-8 h-8 rounded-full bg-green-100 text-green-700 flex items-center justify-center shrink-0 text-sm font-bold mt-0.5">
                <i class="fa-solid fa-lightbulb"></i>
            </div>
            <div>
                <h4 class="font-bold text-xs text-green-900 mb-0.5">Pro Tip for Quick Check-in</h4>
                <p class="text-xs text-green-700 leading-relaxed">
                    Set screen brightness to high when scanning at outdoor recycling hubs to ensure instant code verification.
                </p>
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
    <script src="qr_code.js"></script>
</body>
</html>