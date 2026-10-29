<?php
// waste_guide.php
$pageTitle = "Waste Guide - Eco Hub";

// Mock waste categories data
$categories = [
    [
        "name" => "Plastics",
        "desc" => "PET, HDPE, PVC",
        "icon" => "fa-bottle-water",
        "color" => "blue",
        "link" => "category.php?type=plastics"
    ],
    [
        "name" => "Paper & Cardboard",
        "desc" => "Clean & Dry Only",
        "icon" => "fa-box",
        "color" => "orange",
        "link" => "category.php?type=paper"
    ],
    [
        "name" => "E-Waste",
        "desc" => "Batteries, Cables",
        "icon" => "fa-plug",
        "color" => "purple",
        "link" => "category.php?type=ewaste"
    ],
    [
        "name" => "Compost",
        "desc" => "Food scraps",
        "icon" => "fa-apple-whole",
        "color" => "emerald",
        "link" => "category.php?type=compost"
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
    <header class="bg-white shadow-sm px-6 py-4 sticky top-0 z-10 flex items-center justify-between">
        <a href="dashboard.php" class="text-gray-400 hover:text-green-600 transition w-8">
            <i class="fa-solid fa-arrow-left text-xl"></i>
        </a>
        <h1 class="text-xl font-extrabold text-gray-800">Waste Guide</h1>
        <div class="w-8"></div> <!-- Spacer to keep title centered -->
    </header>

    <main class="p-4 max-w-md mx-auto">
        
        <!-- Smart AI Scanner Feature -->
        <div class="bg-gradient-to-r from-green-600 to-emerald-700 rounded-2xl p-6 text-white shadow-sm mb-6 text-center relative overflow-hidden">
            <i class="fa-solid fa-robot absolute -left-4 -bottom-4 text-6xl opacity-20"></i>
            <h2 class="text-xl font-bold mb-2">Not sure where it goes?</h2>
            <p class="text-green-100 text-sm mb-4">Scan your waste using our AI camera for instant segregation instructions.</p>
            <button onclick="launchAIScanner()" class="bg-white text-green-700 font-bold py-3 px-6 rounded-xl shadow-md w-full flex items-center justify-center gap-2 hover:bg-gray-50 transition active:scale-[0.98]">
                <i class="fa-solid fa-camera"></i> Launch Smart AI Scanner
            </button>
        </div>

        <!-- Manual Search -->
        <h3 class="text-sm font-bold text-gray-500 mb-3 px-2 uppercase tracking-wider">Search Recycling Guide</h3>
        <div class="relative mb-6">
            <i class="fa-solid fa-magnifying-glass absolute left-4 top-3.5 text-gray-400"></i>
            <input type="text" id="searchInput" onkeyup="filterCategories()" placeholder="e.g., 'Coffee Cup' or 'Batteries'" class="w-full bg-white border border-gray-200 rounded-xl py-3 pl-10 pr-4 focus:ring-2 focus:ring-green-500 outline-none shadow-sm text-sm">
        </div>

        <!-- Categories Grid -->
        <h3 class="text-sm font-bold text-gray-500 mb-3 px-2 uppercase tracking-wider">Categories</h3>
        <div id="categoriesGrid" class="grid grid-cols-2 gap-3 mb-6">
            <?php foreach ($categories as $cat): ?>
                <a href="<?php echo $cat['link']; ?>" class="category-card bg-white border border-gray-100 p-4 rounded-2xl text-center shadow-sm hover:shadow-md transition flex flex-col items-center" data-name="<?php echo strtolower($cat['name'] . ' ' . $cat['desc']); ?>">
                    <div class="w-12 h-12 bg-<?php echo $cat['color']; ?>-100 text-<?php echo $cat['color']; ?>-600 rounded-xl flex items-center justify-center text-2xl mb-2">
                        <i class="fa-solid <?php echo $cat['icon']; ?>"></i>
                    </div>
                    <h4 class="font-bold text-sm text-gray-800"><?php echo htmlspecialchars($cat['name']); ?></h4>
                    <p class="text-[10px] text-gray-500 font-medium"><?php echo htmlspecialchars($cat['desc']); ?></p>
                </a>
            <?php endforeach; ?>
        </div>

    </main>

    <!-- Mobile Bottom Navigation -->
    <nav class="fixed bottom-0 w-full bg-white border-t border-gray-200 flex justify-around p-3 pb-6 max-w-md left-1/2 transform -translate-x-1/2 z-20">
        <a href="dashboard.php" class="flex flex-col items-center text-green-600">
            <i class="fa-solid fa-house text-xl mb-1"></i>
            <span class="text-[10px] font-bold">Home</span>
        </a>
        <a href="log_activity.php" class="flex flex-col items-center text-gray-400 hover:text-green-600 transition">
            <i class="fa-solid fa-plus-circle text-xl mb-1"></i>
            <span class="text-[10px] font-bold">Log</span>
        </a>
        <a href="store.php" class="flex flex-col items-center text-gray-400 hover:text-green-600 transition">
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
    <script src="waste_guide.js"></script>
</body>
</html>