<?php
// zero_waste.php
$pageTitle = "Zero Waste - Eco Hub";

// Mock forum category metadata
$forumCategory = [
    "title" => "Zero Single-Use Plastics",
    "subtitle" => "Discover practical guides, community swaps, and upcycling ideas to minimize waste output daily.",
    "badge" => "Community Goal"
];

// Mock navigation tabs
$tabs = [
    ["name" => "All Topics", "link" => "view_forum.php", "active" => false],
    ["name" => "🌱 Eco Tips", "link" => "eco_tips.php", "active" => false],
    ["name" => "♻️ Zero Waste", "link" => "zero_waste.php", "active" => true],
    ["name" => "📢 Announcements", "link" => "announcement.php", "active" => false]
];

// Mock posts data
$posts = [
    [
        "id" => 1,
        "author" => "Alex Tan",
        "role" => "Community Member",
        "time" => "3h ago",
        "avatar" => "https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?auto=format&fit=crop&w=100&q=80",
        "category_badge" => "✂️ Upcycling",
        "badge_color" => "text-teal-700 bg-teal-100",
        "title" => "DIY Glass Jar Food Storage",
        "content" => "Don't throw away pasta sauce or jam jars! Soak them in warm soapy water to peel labels easily and reuse them for dry grain, spice, or snack storage.",
        "highlight_label" => "Waste Diverted:",
        "highlight_value" => "~12 Jars / Mo",
        "box_color" => "bg-teal-50/60 border-teal-100 text-teal-800",
        "likes" => 38,
        "comments" => 11,
        "bookmarked" => false
    ],
    [
        "id" => 2,
        "author" => "Sarah Jenkins",
        "role" => "Eco Ambassador",
        "time" => "6h ago",
        "avatar" => "https://images.unsplash.com/photo-1534528741775-53994a69daeb?auto=format&fit=crop&w=100&q=80",
        "category_badge" => "🍌 Composting",
        "badge_color" => "text-amber-700 bg-amber-100",
        "title" => "Easy Apartment Bokashi Composting",
        "content" => "Bokashi bins ferment food waste indoors without odors. You can safely compost dairy, meat scraps, and coffee grounds right under your kitchen sink.",
        "highlight_label" => "Landfill Reduction:",
        "highlight_value" => "30% Food Waste",
        "box_color" => "bg-amber-50/60 border-amber-200 text-amber-900",
        "likes" => 52,
        "comments" => 15,
        "bookmarked" => true
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
        .scrollbar-none::-webkit-scrollbar { display: none; }
        .scrollbar-none { -ms-overflow-style: none; scrollbar-width: none; }
    </style>
</head>
<body class="bg-gray-50 font-sans min-h-screen text-gray-800 pb-24">

    <!-- Header -->
    <header class="bg-white shadow-sm px-4 py-3 sticky top-0 z-10 flex items-center justify-between">
        <a href="view_forum.php" class="w-10 h-10 rounded-full bg-gray-100 flex items-center justify-center text-gray-700 hover:bg-gray-200 transition">
            <i class="fa-solid fa-arrow-left text-lg"></i>
        </a>
        <h1 class="text-lg font-bold text-gray-800 flex items-center gap-1.5">
            <span>♻️</span> Zero Waste
        </h1>
        <button onclick="toggleBookmarkTopic()" id="topicBookmarkBtn" class="w-10 h-10 rounded-full bg-gray-100 flex items-center justify-center text-gray-700 hover:bg-gray-200 transition">
            <i class="fa-solid fa-bookmark text-base"></i>
        </button>
    </header>

    <main class="p-4 max-w-md mx-auto space-y-4">

        <!-- Topic Highlight Card -->
        <div class="bg-gradient-to-r from-teal-600 to-emerald-700 rounded-2xl p-5 text-white shadow-sm space-y-2">
            <div class="flex items-center justify-between">
                <span class="text-[10px] font-extrabold uppercase tracking-wider bg-white/20 px-2.5 py-0.5 rounded-full">
                    <?php echo htmlspecialchars($forumCategory['badge']); ?>
                </span>
                <span class="text-xs text-teal-100"><i class="fa-solid fa-bullseye text-amber-300"></i> Active</span>
            </div>
            <h2 class="font-bold text-base"><?php echo htmlspecialchars($forumCategory['title']); ?></h2>
            <p class="text-xs text-teal-50 leading-relaxed">
                <?php echo htmlspecialchars($forumCategory['subtitle']); ?>
            </p>
        </div>

        <!-- Filter Sub-categories & Navigation Links -->
        <div class="flex items-center gap-2 overflow-x-auto pb-1 scrollbar-none text-xs">
            <?php foreach ($tabs as $tab): ?>
                <?php if ($tab['active']): ?>
                    <a href="<?php echo $tab['link']; ?>" class="bg-teal-600 text-white font-bold px-4 py-2 rounded-full shadow-sm shrink-0">
                        <?php echo $tab['name']; ?>
                    </a>
                <?php else: ?>
                    <a href="<?php echo $tab['link']; ?>" class="bg-white border border-gray-200 text-gray-600 font-semibold px-4 py-2 rounded-full hover:bg-gray-50 shrink-0">
                        <?php echo $tab['name']; ?>
                    </a>
                <?php endif; ?>
            <?php endforeach; ?>
        </div>

        <!-- Dynamic Loop Through Posts -->
        <?php foreach ($posts as $post): ?>
            <div class="bg-white rounded-2xl p-4 shadow-sm border border-gray-100 space-y-3" id="post-<?php echo $post['id']; ?>">
                <div class="flex items-center justify-between">
                    <div class="flex items-center gap-2.5">
                        <img src="<?php echo $post['avatar']; ?>" class="w-8 h-8 rounded-full object-cover" alt="User Avatar">
                        <div>
                            <h4 class="font-bold text-xs text-gray-800"><?php echo htmlspecialchars($post['author']); ?></h4>
                            <p class="text-[10px] text-gray-400"><?php echo htmlspecialchars($post['role'] . ' • ' . $post['time']); ?></p>
                        </div>
                    </div>
                    <span class="text-[10px] font-bold <?php echo $post['badge_color']; ?> px-2 py-0.5 rounded-full">
                        <?php echo htmlspecialchars($post['category_badge']); ?>
                    </span>
                </div>

                <h3 class="font-bold text-sm text-gray-800"><?php echo htmlspecialchars($post['title']); ?></h3>
                <p class="text-xs text-gray-600 leading-relaxed">
                    <?php echo htmlspecialchars($post['content']); ?>
                </p>

                <div class="<?php echo $post['box_color']; ?> rounded-xl p-3 flex items-center justify-between text-xs font-medium border">
                    <span class="flex items-center gap-1.5 text-[11px]">
                        <i class="fa-solid fa-recycle text-teal-600"></i> <?php echo htmlspecialchars($post['highlight_label']); ?>
                    </span>
                    <span class="font-bold text-[11px] bg-white px-2 py-0.5 rounded-md shadow-2xs border">
                        <?php echo htmlspecialchars($post['highlight_value']); ?>
                    </span>
                </div>

                <div class="flex items-center justify-between pt-2 border-t border-gray-100 text-gray-500 text-xs">
                    <button onclick="likePost(<?php echo $post['id']; ?>)" class="flex items-center gap-1.5 hover:text-teal-600 transition group">
                        <i id="like-icon-<?php echo $post['id']; ?>" class="fa-regular fa-heart group-hover:scale-110 transition"></i>
                        <span id="like-count-<?php echo $post['id']; ?>" class="font-semibold text-[11px]"><?php echo $post['likes']; ?></span>
                    </button>
                    <button onclick="openComments(<?php echo $post['id']; ?>)" class="flex items-center gap-1.5 hover:text-teal-600 transition">
                        <i class="fa-regular fa-comment"></i>
                        <span class="font-semibold text-[11px]"><?php echo $post['comments']; ?> Comments</span>
                    </button>
                    <button onclick="toggleBookmarkPost(<?php echo $post['id']; ?>)" class="hover:text-teal-600 transition">
                        <i id="bookmark-icon-<?php echo $post['id']; ?>" class="fa-<?php echo $post['bookmarked'] ? 'solid text-teal-600' : 'regular'; ?> fa-bookmark"></i>
                    </button>
                </div>
            </div>
        <?php endforeach; ?>

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
        <a href="store.php" class="flex flex-col items-center text-gray-400 hover:text-green-600 transition">
            <i class="fa-solid fa-store text-xl mb-1"></i>
            <span class="text-[10px] font-bold">Store</span>
        </a>
        <a href="community.php" class="flex flex-col items-center text-green-600">
            <i class="fa-solid fa-users text-xl mb-1"></i>
            <span class="text-[10px] font-bold">Community</span>
        </a>
        <a href="profile.php" class="flex flex-col items-center text-gray-400 hover:text-green-600 transition">
            <i class="fa-solid fa-user text-xl mb-1"></i>
            <span class="text-[10px] font-bold">Profile</span>
        </a>
    </nav>

    <!-- External JavaScript File -->
    <script src="zero_waste.js"></script>
</body>
</html>