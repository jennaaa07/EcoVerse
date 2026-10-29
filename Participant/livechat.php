<?php
// live_chat.php
$pageTitle = "Live Chat Support - EcoRewards";

$messages = [
    ["sender" => "agent", "text" => "Hello! Welcome to EcoRewards Support. How can we help you with your eco-points, activities, or vouchers today?", "time" => "10:42 AM"],
    ["sender" => "user", "text" => "Hi! One of my recycling activity submissions hasn't been approved yet. Can you check why?", "time" => "10:44 AM"],
    ["sender" => "agent", "text" => "I'd be happy to check that for you! Could you please provide your <strong>Participant ID</strong> or the reference number of the submitted activity?", "time" => "10:45 AM"],
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
<body class="bg-gray-50 font-sans min-h-screen text-gray-800 flex flex-col justify-between pb-24">

    <!-- Header -->
    <header class="bg-white shadow-sm px-4 py-3 sticky top-0 z-10 flex items-center justify-between">
        <a href="helpAndSupport.html" class="w-10 h-10 rounded-full bg-gray-100 flex items-center justify-center text-gray-700 hover:bg-gray-200 transition">
            <i class="fa-solid fa-arrow-left text-lg"></i>
        </a>
        <div class="flex items-center gap-2">
            <div class="relative">
                <div class="w-8 h-8 rounded-full bg-green-600 text-white flex items-center justify-center font-bold text-xs">
                    CS
                </div>
                <div class="absolute bottom-0 right-0 w-2.5 h-2.5 bg-green-500 border-2 border-white rounded-full"></div>
            </div>
            <div>
                <h1 class="text-xs font-bold text-gray-800">Support Assistant</h1>
                <p class="text-[10px] text-green-600 font-medium">Online | 24/7 Support</p>
            </div>
        </div>
        <div class="w-10"></div>
    </header>

    <!-- Chat Messages Area -->
    <main id="chatContainer" class="p-4 max-w-md mx-auto w-full space-y-4 overflow-y-auto flex-1">
        
        <!-- Timestamp divider -->
        <div class="text-center">
            <span class="text-[10px] bg-gray-200 text-gray-500 px-2.5 py-1 rounded-full font-medium">Today, 10:42 AM</span>
        </div>

        <?php foreach ($messages as $msg): ?>
            <?php if ($msg['sender'] === 'agent'): ?>
                <!-- Agent Message -->
                <div class="flex items-start gap-2.5">
                    <div class="w-7 h-7 rounded-full bg-green-600 text-white flex items-center justify-center font-bold text-[10px] shrink-0 mt-1">
                        CS
                    </div>
                    <div class="bg-white border border-gray-100 rounded-2xl rounded-tl-sm p-3.5 shadow-sm max-w-[80%]">
                        <p class="text-xs text-gray-700 leading-relaxed">
                            <?php echo $msg['text']; ?>
                        </p>
                        <span class="text-[9px] text-gray-400 mt-1.5 block text-right"><?php echo $msg['time']; ?></span>
                    </div>
                </div>
            <?php else: ?>
                <!-- User Message -->
                <div class="flex items-start gap-2.5 justify-end">
                    <div class="bg-green-600 text-white rounded-2xl rounded-tr-sm p-3.5 shadow-sm max-w-[80%]">
                        <p class="text-xs leading-relaxed">
                            <?php echo htmlspecialchars($msg['text']); ?>
                        </p>
                        <span class="text-[9px] text-green-100 mt-1.5 block text-right"><?php echo $msg['time']; ?></span>
                    </div>
                    <div class="w-7 h-7 rounded-full bg-gray-300 text-gray-700 flex items-center justify-center font-bold text-[10px] shrink-0 mt-1">
                        JD
                    </div>
                </div>
            <?php endif; ?>
        <?php endforeach; ?>

    </main>

    <!-- Chat Input Footer -->
    <div class="fixed bottom-16 w-full bg-white border-t border-gray-200 p-3 max-w-md left-1/2 transform -translate-x-1/2 z-20">
        <form id="chatForm" onsubmit="event.preventDefault(); sendMessage();" class="flex items-center gap-2">
            <button type="button" onclick="attachFile()" class="w-10 h-10 rounded-full bg-gray-100 text-gray-500 flex items-center justify-center hover:bg-gray-200 transition shrink-0 cursor-pointer">
                <i class="fa-solid fa-paperclip text-sm"></i>
            </button>
            <input type="text" id="chatInput" placeholder="Type your message..." required class="w-full bg-gray-50 border border-gray-200 rounded-full py-2.5 px-4 text-xs font-medium placeholder-gray-400 focus:outline-none focus:border-green-500 focus:ring-1 focus:ring-green-500 transition">
            <button type="submit" class="w-10 h-10 rounded-full bg-green-600 text-white flex items-center justify-center hover:bg-green-700 transition shrink-0 shadow-sm cursor-pointer">
                <i class="fa-solid fa-paper-plane text-xs"></i>
            </button>
        </form>
    </div>

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
    <script src="live_chat.js"></script>
</body>
</html>