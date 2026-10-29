<?php
session_start();

if (!isset($_SESSION['user_id']) || !in_array($_SESSION['role'] ?? '', ['Participant', 'Member'], true)) {
    header('Location: ../index.php');
    exit();
}

require_once '../includes/db_connect.php';

$stmt = mysqli_prepare($conn, 'SELECT full_name, green_points FROM user_profile WHERE user_id = ? LIMIT 1');
mysqli_stmt_bind_param($stmt, 'i', $_SESSION['user_id']);
mysqli_stmt_execute($stmt);
$profile = mysqli_fetch_assoc(mysqli_stmt_get_result($stmt)) ?: [];

$userName = ($profile['full_name'] ?? '') ?: ($_SESSION['name'] ?? 'Participant');
$nameParts = preg_split('/\s+/', trim($userName));
$userInitials = strtoupper(substr($nameParts[0] ?? 'P', 0, 1) . substr($nameParts[1] ?? '', 0, 1));
$points = (int)($profile['green_points'] ?? 0);
$pointsBalance = number_format($points);
$targetReward = 'Premium Tumbler';
$pointsAway = $points >= 3000 ? 'You can redeem' : number_format(3000 - $points) . ' pts away from';
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
<body class="bg-gray-50 font-sans min-h-screen text-gray-800 pb-20">

    <!-- Top Navigation -->
    <header class="bg-white shadow-sm px-6 py-4 flex justify-between items-center sticky top-0 z-10">
        <div class="flex items-center gap-3">
            <div class="w-10 h-10 bg-green-600 rounded-full flex items-center justify-center text-white font-bold">
                <?php echo $userInitials; ?>
            </div>
            <div>
                <p class="text-xs text-gray-500">Welcome back,</p>
                <p class="font-bold text-sm"><?php echo $userName; ?></p>
            </div>
        </div>
        <button onclick="openNotifications()" class="text-gray-400 hover:text-green-600 transition cursor-pointer" title="Notifications">
            <i class="fa-solid fa-bell text-xl"></i>
        </button>
    </header>

    <main class="p-6 max-w-md mx-auto">
        <!-- Points Balance Card -->
        <a href="points.html" class="block bg-gradient-to-br from-green-600 to-green-800 rounded-2xl p-6 text-white shadow-lg mb-8 relative overflow-hidden group">
            <i class="fa-solid fa-leaf absolute -bottom-4 -right-4 text-8xl text-white opacity-10"></i>
            <p class="text-green-100 text-sm font-medium mb-1">Available Balance</p>
            <h1 class="text-5xl font-extrabold mb-4"><?php echo $pointsBalance; ?> <span class="text-lg font-normal">pts</span></h1>
            
            <div class="w-full bg-green-900 rounded-full h-2 mb-2">
                <div class="bg-yellow-400 h-2 rounded-full" style="width: 70%"></div>
            </div>
            <div class="flex justify-between items-center text-xs text-green-100">
                <span><?php echo $pointsAway; ?> <strong><?php echo $targetReward; ?></strong></span>
                <i class="fa-solid fa-chevron-right group-hover:translate-x-1 transition-transform"></i>
            </div>
        </a>

        <!-- Quick Actions Grid -->
        <h2 class="text-lg font-bold mb-4">Quick Actions</h2>
        <div class="grid grid-cols-3 gap-3 mb-8">
            <a href="log-activity.html" class="bg-white p-4 rounded-xl shadow-sm border border-gray-100 flex flex-col items-center gap-2 hover:bg-green-50 transition">
                <div class="w-12 h-12 bg-blue-100 text-blue-600 rounded-full flex items-center justify-center text-xl">
                    <i class="fa-solid fa-camera"></i>
                </div>
                <span class="text-xs font-bold text-center">Log Activity</span>
            </a>

            <a href="centre-locator.html" class="bg-white p-4 rounded-xl shadow-sm border border-gray-100 flex flex-col items-center gap-2 hover:bg-green-50 transition">
                <div class="w-12 h-12 bg-purple-100 text-purple-600 rounded-full flex items-center justify-center text-xl">
                    <i class="fa-solid fa-map-location-dot"></i>
                </div>
                <span class="text-xs font-bold text-center">Find Centre</span>
            </a>

            <a href="waste-guide.html" class="bg-white p-4 rounded-xl shadow-sm border border-gray-100 flex flex-col items-center gap-2 hover:bg-green-50 transition">
                <div class="w-12 h-12 bg-yellow-100 text-yellow-600 rounded-full flex items-center justify-center text-xl">
                    <i class="fa-solid fa-book-open"></i>
                </div>
                <span class="text-xs font-bold text-center">Waste Guide</span>
            </a>
        </div>

        <!-- Recent Activity Log -->
        <div class="flex justify-between items-end mb-4">
            <h2 class="text-lg font-bold">Recent Activity</h2>
            <a href="points.html" class="text-sm text-green-600 font-bold hover:underline">View History</a>
        </div>

        <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
            <div onclick="viewActivityDetail('Recycled Plastics', '+50 Pts')" class="p-4 border-b border-gray-50 flex justify-between items-center hover:bg-gray-50 transition cursor-pointer">
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 bg-green-100 text-green-600 rounded-full flex items-center justify-center">
                        <i class="fa-solid fa-check"></i>
                    </div>
                    <div>
                        <p class="font-bold text-sm">Recycled Plastics</p>
                        <p class="text-xs text-gray-400">Oct 10, 2026</p>
                    </div>
                </div>
                <span class="text-green-600 font-bold text-sm">+50 Pts</span>
            </div>

            <div onclick="viewActivityDetail('E-Waste Dropoff', 'Pending')" class="p-4 border-b border-gray-50 flex justify-between items-center hover:bg-gray-50 transition cursor-pointer">
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 bg-orange-100 text-orange-600 rounded-full flex items-center justify-center">
                        <i class="fa-solid fa-clock"></i>
                    </div>
                    <div>
                        <p class="font-bold text-sm">E-Waste Dropoff</p>
                        <p class="text-xs text-gray-400">Oct 11, 2026</p>
                    </div>
                </div>
                <span class="text-orange-500 font-bold text-xs bg-orange-50 px-2 py-1 rounded">Pending</span>
            </div>

            <div onclick="viewActivityDetail('Cafe Voucher (RM5)', '-500 Pts')" class="p-4 flex justify-between items-center hover:bg-gray-50 transition cursor-pointer">
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 bg-gray-100 text-gray-600 rounded-full flex items-center justify-center">
                        <i class="fa-solid fa-ticket"></i>
                    </div>
                    <div>
                        <p class="font-bold text-sm">Cafe Voucher (RM5)</p>
                        <p class="text-xs text-gray-400">Oct 05, 2026</p>
                    </div>
                </div>
                <span class="text-gray-600 font-bold text-sm">-500 Pts</span>
            </div>
        </div>
    </main>

    <!-- Mobile Bottom Navigation -->
    <nav class="fixed bottom-0 w-full bg-white border-t border-gray-200 flex justify-around p-3 pb-6 max-w-md left-1/2 transform -translate-x-1/2 z-10">
        <a href="dashboard.html" class="flex flex-col items-center text-green-600">
            <i class="fa-solid fa-house text-xl mb-1"></i>
            <span class="text-[10px] font-bold">Home</span>
        </a>
        <a href="log-activity.html" class="flex flex-col items-center text-gray-400 hover:text-green-600">
            <i class="fa-solid fa-plus-circle text-xl mb-1"></i>
            <span class="text-[10px] font-bold">Log</span>
        </a>
        <a href="store.html" class="flex flex-col items-center text-gray-400 hover:text-green-600">
            <i class="fa-solid fa-store text-xl mb-1"></i>
            <span class="text-[10px] font-bold">Store</span>
        </a>
        <a href="community.html" class="flex flex-col items-center text-gray-400 hover:text-green-600">
            <i class="fa-solid fa-users text-xl mb-1"></i>
            <span class="text-[10px] font-bold">Community</span>
        </a>
        <a href="profile.html" class="flex flex-col items-center text-gray-400 hover:text-green-600">
            <i class="fa-solid fa-user text-xl mb-1"></i>
            <span class="text-[10px] font-bold">Profile</span>
        </a>
    </nav>

    <!-- External JavaScript File -->
    <script src="dashboard.js"></script>
</body>
</html>
