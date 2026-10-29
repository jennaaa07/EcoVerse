<?php
// merchandise.php
$pageTitle = "Merchandise - EcoRewards";
$userPoints = 2450;

$categories = [
    ["name" => "All", "url" => "store.html", "active" => false],
    ["name" => "Vouchers", "url" => "vouchers.html", "active" => false],
    ["name" => "Merchandise", "url" => "merchandise.html", "active" => true],
    ["name" => "Donations", "url" => "donations.html", "active" => false],
];

$items = [
    [
        "id" => "item_1",
        "name" => "Eco-Tote Bag",
        "points" => 1200,
        "icon" => "fa-shirt",
        "bg_header" => "bg-blue-50",
        "text_color" => "text-blue-600",
        "locked" => false
    ],
    [
        "id" => "item_2",
        "name" => "Bamboo Cutlery Set",
        "points" => 1800,
        "icon" => "fa-utensils",
        "bg_header" => "bg-teal-50",
        "text_color" => "text-teal-600",
        "locked" => false
    ],
    [
        "id" => "item_3",
        "name" => "Premium Tumbler",
        "points" => 3000,
        "icon" => "fa-bottle-water",
        "bg_header" => "bg-gray-50",
        "text_color" => "text-gray-400",
        "locked" => true,
        "progress" => 81,
        "needed" => 550
    ],
    [
        "id" => "item_4",
        "name" => "Organic Cotton Cap",
        "points" => 2800,
        "icon" => "fa-hat-cowboy",
        "bg_header" => "bg-gray-50",
        "text_color" => "text-gray-400",
        "locked" => true,
        "progress" => 87,
        "needed" => 350
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
            <?php foreach ($categories as $cat): ?>
                <a href="<?php echo $cat['url']; ?>" class="<?php echo $cat['active'] ? 'bg-gray-800 text-white font-bold' : 'bg-gray-100 text-gray-600 font-medium hover:bg-gray-200'; ?> px-4 py-1.5 rounded-full text-sm whitespace-nowrap transition">
                    <?php echo $cat['name']; ?>
                </a>
            <?php endforeach; ?>
        </div>
    </header>

    <main class="p-4 max-w-md mx-auto">
        <div class="grid grid-cols-2 gap-4">
            <?php foreach ($items as $item): ?>
                <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden flex flex-col relative <?php echo $item['locked'] ? 'opacity-80' : ''; ?>">
                    
                    <?php if ($item['locked']): ?>
                        <div class="absolute top-2 right-2 bg-gray-800/80 text-white w-6 h-6 rounded-full flex items-center justify-center text-xs z-10">
                            <i class="fa-solid fa-lock"></i>
                        </div>
                    <?php endif; ?>

                    <div class="h-32 <?php echo $item['bg_header'] . ' ' . $item['text_color']; ?> flex items-center justify-center text-4xl">
                        <i class="fa-solid <?php echo $item['icon']; ?>"></i>
                    </div>

                    <div class="p-3 flex flex-col flex-grow">
                        <h3 class="font-bold text-sm text-gray-800 mb-1"><?php echo htmlspecialchars($item['name']); ?></h3>
                        
                        <?php if (!$item['locked']): ?>
                            <p class="text-green-600 font-extrabold text-sm mb-3"><?php echo number_format($item['points']); ?> pts</p>
                            <button onclick="redeemItem('<?php echo htmlspecialchars($item['name']); ?>', <?php echo $item['points']; ?>)" class="mt-auto w-full bg-green-600 hover:bg-green-700 text-white text-xs font-bold py-2 rounded-lg transition cursor-pointer">
                                Redeem Now
                            </button>
                        <?php else: ?>
                            <p class="text-gray-500 font-extrabold text-sm mb-2"><?php echo number_format($item['points']); ?> pts</p>
                            
                            <div class="w-full bg-gray-200 rounded-full h-1.5 mb-1 mt-auto">
                                <div class="bg-yellow-400 h-1.5 rounded-full" style="width: <?php echo $item['progress']; ?>%"></div>
                            </div>
                            <p class="text-[10px] text-gray-500 text-center mb-2"><?php echo $item['needed']; ?> pts needed</p>
                            
                            <button disabled class="w-full bg-gray-100 text-gray-400 text-xs font-bold py-2 rounded-lg cursor-not-allowed">
                                Locked
                            </button>
                        <?php endif; ?>
                    </div>
                </div>
            <?php endforeach; ?>
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
        <a href="store.html" class="flex flex-col items-center text-green-600">
            <i class="fa-solid fa-store text-xl mb-1"></i>
            <span class="text-[10px] font-bold">Store</span>
        </a>
        <a href="community.html" class="flex flex-col items-center text-gray-400 hover:text-green-600 transition">
            <i class="fa-solid fa-users text-xl mb-1"></i>
            <span class="text-[10px] font-bold">Community</span>
        </a>
        <a href="profile.html" class="flex flex-col items-center text-gray-400 hover:text-green-600 transition">
            <i class="fa-solid fa-user text-xl mb-1"></i>
            <span class="text-[10px] font-bold">Profile</span>
        </a>
    </nav>

    <style>
        .hide-scrollbar::-webkit-scrollbar { display: none; }
        .hide-scrollbar { -ms-overflow-style: none; scrollbar-width: none; }
    </style>

    <!-- External JavaScript File -->
    <script src="merchandise.js"></script>
</body>
</html>