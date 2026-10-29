<?php
// vouchers.php
$pageTitle = "Vouchers - EcoRewards";

// Mock user points and vouchers data
$userPoints = 2450;

$vouchers = [
    [
        "id" => 1,
        "title" => "RM5 Cafe Voucher",
        "points" => 500,
        "icon" => "fa-mug-hot",
        "icon_color" => "text-amber-600",
        "bg_color" => "bg-amber-50",
        "status" => "available",
        "stock" => 12
    ],
    [
        "id" => 2,
        "title" => "RM10 Grocery Discount",
        "points" => 950,
        "icon" => "fa-basket-shopping",
        "icon_color" => "text-emerald-600",
        "bg_color" => "bg-emerald-50",
        "status" => "available",
        "stock" => 8
    ],
    [
        "id" => 3,
        "title" => "Transit Pass Credit",
        "points" => 1500,
        "icon" => "fa-bus",
        "icon_color" => "text-indigo-600",
        "bg_color" => "bg-indigo-50",
        "status" => "available",
        "stock" => 5
    ],
    [
        "id" => 4,
        "title" => "Movie Ticket",
        "points" => 1000,
        "icon" => "fa-ticket-simple",
        "icon_color" => "text-gray-400",
        "bg_color" => "bg-gray-50",
        "status" => "out_of_stock",
        "stock" => 0
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
    <style>
        .hide-scrollbar::-webkit-scrollbar { display: none; }
        .hide-scrollbar { -ms-overflow-style: none; scrollbar-width: none; }
    </style>
</head>
<body class="bg-gray-50 font-sans min-h-screen text-gray-800 pb-20">

    <!-- Header & Points -->
    <header class="bg-white shadow-sm sticky top-0 z-10">
        <div class="px-6 py-4 flex justify-between items-center">
            <h1 class="text-xl font-extrabold text-gray-800">Reward Store</h1>
            <div class="bg-green-100 text-green-800 px-3 py-1 rounded-full font-bold text-sm flex items-center gap-1 border border-green-200">
                <i class="fa-solid fa-leaf text-green-600"></i> <?php echo number_format($userPoints); ?> pts
            </div>
        </div>
        
        <!-- Category Tabs -->
        <div class="flex overflow-x-auto px-4 pb-3 space-x-2 hide-scrollbar">
            <a href="store.php" class="bg-gray-100 text-gray-600 px-4 py-1.5 rounded-full text-sm font-medium whitespace-nowrap hover:bg-gray-200">All</a>
            <a href="vouchers.php" class="bg-gray-800 text-white px-4 py-1.5 rounded-full text-sm font-bold whitespace-nowrap">Vouchers</a>
            <a href="merchandise.php" class="bg-gray-100 text-gray-600 px-4 py-1.5 rounded-full text-sm font-medium whitespace-nowrap hover:bg-gray-200">Merchandise</a>
            <a href="donations.php" class="bg-gray-100 text-gray-600 px-4 py-1.5 rounded-full text-sm font-medium whitespace-nowrap hover:bg-gray-200">Donations</a>
        </div>
    </header>

    <main class="p-4 max-w-md mx-auto">
        <div class="grid grid-cols-2 gap-4">
            <?php foreach ($vouchers as $voucher): ?>
                <?php 
                    $isLocked = ($voucher['points'] > $userPoints) && ($voucher['status'] !== 'out_of_stock');
                    if ($isLocked) {
                        $voucher['status'] = 'locked';
                    }
                ?>
                
                <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden flex flex-col relative 
                    <?php 
                        if ($voucher['status'] === 'locked') echo 'opacity-80';
                        elseif ($voucher['status'] === 'out_of_stock') echo 'opacity-70 grayscale';
                    ?>">

                    <!-- Badges / Indicators -->
                    <?php if ($voucher['status'] === 'locked'): ?>
                        <div class="absolute top-2 right-2 bg-gray-800/80 text-white w-6 h-6 rounded-full flex items-center justify-center text-xs z-10">
                            <i class="fa-solid fa-lock"></i>
                        </div>
                    <?php elseif ($voucher['status'] === 'out_of_stock'): ?>
                        <div class="absolute top-2 left-2 bg-red-600 text-white px-2 py-0.5 rounded text-[10px] font-bold uppercase tracking-wide z-10">
                            Out of Stock
                        </div>
                    <?php endif; ?>

                    <!-- Icon Area -->
                    <div class="h-32 <?php echo $voucher['bg_color']; ?> flex items-center justify-center text-4xl <?php echo $voucher['icon_color']; ?>">
                        <i class="fa-solid <?php echo $voucher['icon']; ?>"></i>
                    </div>

                    <!-- Details Area -->
                    <div class="p-3 flex flex-col flex-grow">
                        <h3 class="font-bold text-sm text-gray-800 mb-1"><?php echo htmlspecialchars($voucher['title']); ?></h3>
                        
                        <p class="<?php echo ($voucher['status'] === 'available') ? 'text-green-600' : 'text-gray-500'; ?> font-extrabold text-sm mb-<?php echo ($voucher['status'] === 'locked') ? '2' : '3'; ?>">
                            <?php echo number_format($voucher['points']); ?> pts
                        </p>

                        <?php if ($voucher['status'] === 'locked'): ?>
                            <?php 
                                $pointsNeeded = $voucher['points'] - $userPoints;
                                $progressPercent = min(100, round(($userPoints / $voucher['points']) * 100));
                            ?>
                            <div class="w-full bg-gray-200 rounded-full h-1.5 mb-1 mt-auto">
                                <div class="bg-yellow-400 h-1.5 rounded-full" style="width: <?php echo $progressPercent; ?>%"></div>
                            </div>
                            <p class="text-[10px] text-gray-500 text-center mb-2"><?php echo number_format($pointsNeeded); ?> pts needed</p>
                            <button disabled class="w-full bg-gray-100 text-gray-400 text-xs font-bold py-2 rounded-lg cursor-not-allowed">
                                Locked
                            </button>
                        <?php elseif ($voucher['status'] === 'out_of_stock'): ?>
                            <button disabled class="mt-auto w-full bg-gray-200 text-gray-500 text-xs font-bold py-2 rounded-lg cursor-not-allowed">
                                Sold Out
                            </button>
                        <?php else: ?>
                            <button onclick="redeemVoucher(<?php echo $voucher['id']; ?>, '<?php echo addslashes($voucher['title']); ?>')" class="mt-auto w-full bg-green-600 hover:bg-green-700 text-white text-xs font-bold py-2 rounded-lg transition">
                                Redeem Now
                            </button>
                        <?php endif; ?>
                    </div>
                </div>
            <?php endforeach; ?>
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
        <a href="store.php" class="flex flex-col items-center text-green-600">
            <i class="fa-solid fa-store text-xl mb-1"></i>
            <span class="text-[10px] font-bold">Store</span>
        </a>
        <a href="community.php" class="flex flex-col items-center text-gray-400 hover:text-green-600 transition">
            <i class="fa-solid fa-users text-xl mb-1"></i>
            <span class="text-[10px] font-bold">Community</span>
        </a>
        <a href="profile.php" class="flex flex-col items-center text-gray-400 hover:text-green-600 transition">
            <i class="fa-solid fa-user text-xl mb-1"></i>
            <span class="text-[10px] font-bold">Profile</span>
        </a>
    </nav>

    <!-- External JavaScript File -->
    <script src="vouchers.js"></script>
</body>
</html>