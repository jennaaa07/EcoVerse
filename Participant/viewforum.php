<?php
// community.php
$pageTitle = "Community Forum - Eco Hub";

// Mock current user profile data
$currentUser = [
    "name" => "Jane Doe",
    "initials" => "JD",
    "points" => 2450
];

// Mock forum posts database/array
$posts = [
    [
        "id" => 1,
        "is_pinned" => true,
        "tag" => "Pinned",
        "tag_class" => "text-amber-700 bg-amber-100",
        "tag_icon" => "fa-thumbtack",
        "time" => "2h ago",
        "author" => "Sarah Jenkins",
        "author_title" => "Eco Ambassador • 1,240 pts",
        "author_avatar" => "https://images.unsplash.com/photo-1534528741775-53994a69daeb?auto=format&fit=crop&w=100&q=80",
        "title" => "Top 5 ways to eliminate single-use plastic in your dorm room",
        "content" => "Switching to solid shampoo bars and reusable silicone bags saved me over 30 plastic bottles this semester alone! Here is my breakdown of budget-friendly swaps...",
        "likes" => 48,
        "replies" => 12,
        "liked" => false,
        "bookmarked" => false
    ],
    [
        "id" => 2,
        "is_pinned" => false,
        "tag" => "🌱 Eco Tips",
        "tag_class" => "text-green-700 bg-green-100 hover:bg-green-200 transition",
        "tag_icon" => "",
        "time" => "5h ago",
        "author" => "Alex Tan",
        "author_title" => "Community Member • 450 pts",
        "author_avatar" => "https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?auto=format&fit=crop&w=100&q=80",
        "title" => "Where to donate old electronics near campus?",
        "content" => "Does anyone know if the Student Union is still running the e-waste drive this Friday? I have two old cables and an e-reader to drop off.",
        "likes" => 19,
        "replies" => 5,
        "liked" => false,
        "bookmarked" => false
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
        <a href="community.php" class="w-10 h-10 rounded-full bg-gray-100 flex items-center justify-center text-gray-700 hover:bg-gray-200 transition">
            <i class="fa-solid fa-arrow-left text-lg"></i>
        </a>
        <h1 class="text-lg font-bold text-gray-800">Community Forum</h1>
        <button class="w-10 h-10 rounded-full bg-gray-100 flex items-center justify-center text-gray-700 hover:bg-gray-200 transition">
            <i class="fa-solid fa-magnifying-glass text-base"></i>
        </button>
    </header>

    <main class="p-4 max-w-md mx-auto space-y-4">

        <!-- Search & Filter Bar -->
        <div class="flex items-center gap-2 overflow-x-auto pb-1 scrollbar-none">
            <a href="community.php" class="bg-green-600 text-white font-bold text-xs px-4 py-2 rounded-full shadow-sm shrink-0">
                All Topics
            </a>
            <a href="eco-tips.php" class="bg-white border border-gray-200 text-gray-600 font-semibold text-xs px-4 py-2 rounded-full hover:bg-gray-50 shrink-0">
                🌱 Eco Tips
            </a>
            <a href="zero-waste.php" class="bg-white border border-gray-200 text-gray-600 font-semibold text-xs px-4 py-2 rounded-full hover:bg-gray-50 shrink-0">
                ♻️ Zero Waste
            </a>
            <a href="announcements.php" class="bg-white border border-gray-200 text-gray-600 font-semibold text-xs px-4 py-2 rounded-full hover:bg-gray-50 shrink-0">
                📢 Announcements
            </a>
        </div>

        <!-- Create Post Banner -->
        <div class="bg-white rounded-2xl p-3 shadow-sm border border-gray-100 flex items-center gap-3">
            <div class="w-10 h-10 rounded-full bg-green-100 text-green-700 flex items-center justify-center font-bold text-xs shrink-0">
                <?php echo $currentUser['initials']; ?>
            </div>
            <input type="text" id="postInput" placeholder="Share an eco-tip or ask a question..." class="w-full bg-gray-50 border border-gray-200 rounded-xl px-3 py-2 text-xs focus:outline-none focus:border-green-600">
            <button onclick="createPost()" class="bg-green-600 text-white w-9 h-9 rounded-xl flex items-center justify-center hover:bg-green-700 transition shrink-0">
                <i class="fa-solid fa-paper-plane text-xs"></i>
            </button>
        </div>

        <!-- Forum Posts Dynamic Loop -->
        <div id="postsContainer" class="space-y-4">
            <?php foreach ($posts as $post): ?>
                <div class="bg-white rounded-2xl p-4 shadow-sm border border-gray-100 space-y-3" data-id="<?php echo $post['id']; ?>">
                    <div class="flex items-center justify-between">
                        <?php if ($post['is_pinned']): ?>
                            <span class="text-[10px] font-bold <?php echo $post['tag_class']; ?> px-2 py-0.5 rounded-full flex items-center gap-1">
                                <i class="fa-solid <?php echo $post['tag_icon']; ?> text-[9px]"></i> <?php echo $post['tag']; ?>
                            </span>
                        <?php else: ?>
                            <a href="#" class="text-[10px] font-bold <?php echo $post['tag_class']; ?> px-2 py-0.5 rounded-full">
                                <?php echo $post['tag']; ?>
                            </a>
                        <?php endif; ?>
                        <span class="text-[11px] text-gray-400"><?php echo $post['time']; ?></span>
                    </div>

                    <div class="flex items-center gap-3">
                        <img src="<?php echo htmlspecialchars($post['author_avatar']); ?>" class="w-9 h-9 rounded-full object-cover" alt="User">
                        <div>
                            <h4 class="font-bold text-xs text-gray-800"><?php echo htmlspecialchars($post['author']); ?></h4>
                            <p class="text-[10px] text-gray-400"><?php echo htmlspecialchars($post['author_title']); ?></p>
                        </div>
                    </div>

                    <div>
                        <h3 class="font-bold text-sm text-gray-800 mb-1"><?php echo htmlspecialchars($post['title']); ?></h3>
                        <p class="text-xs text-gray-600 leading-relaxed <?php echo $post['is_pinned'] ? 'line-clamp-2' : ''; ?>">
                            <?php echo htmlspecialchars($post['content']); ?>
                        </p>
                    </div>

                    <div class="flex items-center justify-between pt-2 border-t border-gray-100 text-gray-500 text-xs">
                        <button onclick="toggleLike(this)" class="flex items-center gap-1.5 hover:text-green-600 transition">
                            <i class="fa-regular fa-heart like-icon"></i>
                            <span class="font-semibold text-[11px] like-count"><?php echo $post['likes']; ?></span>
                        </button>
                        <button class="flex items-center gap-1.5 hover:text-green-600 transition">
                            <i class="fa-regular fa-comment"></i>
                            <span class="font-semibold text-[11px]"><?php echo $post['replies']; ?> Replies</span>
                        </button>
                        <button onclick="toggleBookmark(this)" class="hover:text-green-600 transition">
                            <i class="fa-regular fa-bookmark bookmark-icon"></i>
                        </button>
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
    <script src="community.js"></script>
</body>
</html>