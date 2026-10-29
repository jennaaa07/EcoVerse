<?php
// email_support.php
$pageTitle = "Email Support - EcoRewards";
$supportEmail = "support@ecorewards.com";
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
        <!-- Back link to helpAndSupport.html -->
        <a href="helpAndSupport.html" class="w-10 h-10 rounded-full bg-gray-100 flex items-center justify-center text-gray-700 hover:bg-gray-200 transition">
            <i class="fa-solid fa-arrow-left text-lg"></i>
        </a>
        <h1 class="text-lg font-bold text-gray-800">Email Support</h1>
        <div class="w-10"></div> <!-- Placeholder to center title -->
    </header>

    <main class="p-4 max-w-md mx-auto space-y-6">

        <!-- Info Banner -->
        <div class="bg-blue-50 border border-blue-100 rounded-2xl p-4 flex items-start gap-3 shadow-sm">
            <div class="w-8 h-8 rounded-xl bg-blue-100 text-blue-600 flex items-center justify-center text-sm shrink-0 mt-0.5">
                <i class="fa-solid fa-envelope"></i>
            </div>
            <div>
                <h2 class="font-bold text-xs text-blue-900">Send us a message</h2>
                <p class="text-[11px] text-blue-700 mt-0.5 leading-relaxed">
                    Our support team typically replies within 24 hours. Fill out the details below to open a support ticket.
                </p>
            </div>
        </div>

        <!-- Support Ticket Form -->
        <form id="supportForm" onsubmit="event.preventDefault(); submitSupportTicket();" class="bg-white rounded-2xl p-5 shadow-sm border border-gray-100 space-y-4">
            
            <!-- Category Selection -->
            <div>
                <label class="block text-xs font-bold text-gray-700 mb-1.5">Issue Category</label>
                <div class="relative">
                    <select id="issueCategory" class="w-full bg-gray-50 border border-gray-200 rounded-xl py-3 px-3.5 text-xs font-medium text-gray-700 appearance-none focus:outline-none focus:border-green-500 focus:ring-1 focus:ring-green-500 transition">
                        <option>Eco-Points & Activity Logging</option>
                        <option>Store & Voucher Redemption</option>
                        <option>Account & Profile Settings</option>
                        <option>Technical Bug / App Issue</option>
                        <option>Other Inquiry</option>
                    </select>
                    <i class="fa-solid fa-chevron-down absolute right-3.5 top-1/2 -translate-y-1/2 text-gray-400 text-xs pointer-events-none"></i>
                </div>
            </div>

            <!-- Subject Line -->
            <div>
                <label class="block text-xs font-bold text-gray-700 mb-1.5">Subject</label>
                <input type="text" id="ticketSubject" placeholder="e.g. Missing points from recycling log" class="w-full bg-gray-50 border border-gray-200 rounded-xl py-3 px-3.5 text-xs font-medium placeholder-gray-400 focus:outline-none focus:border-green-500 focus:ring-1 focus:ring-green-500 transition">
            </div>

            <!-- Message Body -->
            <div>
                <label class="block text-xs font-bold text-gray-700 mb-1.5">Description</label>
                <textarea id="ticketDescription" rows="4" placeholder="Please describe your issue in detail..." class="w-full bg-gray-50 border border-gray-200 rounded-xl p-3.5 text-xs font-medium placeholder-gray-400 focus:outline-none focus:border-green-500 focus:ring-1 focus:ring-green-500 transition resize-none"></textarea>
            </div>

            <!-- Optional Attachment -->
            <div>
                <label class="block text-xs font-bold text-gray-700 mb-1.5">Attach Screenshot (Optional)</label>
                <label class="border-2 border-dashed border-gray-200 rounded-xl p-4 flex flex-col items-center justify-center cursor-pointer hover:border-green-500 transition bg-gray-50">
                    <i class="fa-solid fa-cloud-arrow-up text-gray-400 text-lg mb-1"></i>
                    <span id="fileLabelText" class="text-xs font-semibold text-gray-700">Tap to upload file</span>
                    <span class="text-[10px] text-gray-400 mt-0.5">PNG, JPG up to 5MB</span>
                    <input type="file" id="attachmentInput" class="hidden" accept="image/png, image/jpeg" onchange="handleFileSelection(event)">
                </label>
            </div>

            <!-- Submit Button -->
            <button type="submit" class="w-full bg-green-600 hover:bg-green-700 text-white font-bold py-3.5 px-4 rounded-xl text-xs shadow-sm transition flex items-center justify-center gap-2 mt-2 cursor-pointer">
                <i class="fa-solid fa-paper-plane text-xs"></i>
                Submit Support Ticket
            </button>

        </form>

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
    <script src="email_support.js"></script>
</body>
</html>