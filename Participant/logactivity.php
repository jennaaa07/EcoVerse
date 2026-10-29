<?php
// log_activity.php
$pageTitle = "Log Activity - EcoRewards";

$categories = [
    ["value" => "recycling", "label" => "♻️ Recycling (Plastic/Paper/Glass)"],
    ["value" => "transit", "label" => "🚌 Public Transportation"],
    ["value" => "ewaste", "label" => "🔋 E-Waste Disposal"],
    ["value" => "cup", "label" => "☕ Reusable Cup at Cafe"],
    ["value" => "volunteer", "label" => "🌱 Volunteer Event"]
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
<body class="bg-gray-50 font-sans min-h-screen text-gray-800 pb-28">

    <!-- Top Navigation Header -->
    <header class="bg-white shadow-sm px-6 py-4 flex items-center justify-between sticky top-0 z-10">
        <a href="dashboard.html" class="text-gray-500 hover:text-green-600 w-8 flex items-center justify-start">
            <i class="fa-solid fa-arrow-left text-xl"></i>
        </a>
        <h1 class="text-base font-bold text-gray-800">Log Eco-Action</h1>
        <div class="w-8"></div>
    </header>

    <main class="p-6 max-w-md mx-auto">
        <!-- Subtitle Info Card -->
        <div class="bg-green-50 border border-green-100 rounded-xl p-4 text-center mb-6">
            <p class="text-xs text-green-800 leading-relaxed">
                Submit proof of your sustainable action to earn points. All submissions are reviewed by our team.
            </p>
        </div>

        <form id="logActivityForm" enctype="multipart/form-data">
            <!-- Category Selection -->
            <div class="mb-5">
                <label class="block text-xs font-bold text-gray-700 uppercase tracking-wider mb-2">Activity Category</label>
                <div class="relative">
                    <select id="activityCategory" name="activity_type" class="block w-full bg-white border border-gray-200 text-gray-800 py-3.5 px-4 pr-10 rounded-xl appearance-none focus:outline-none focus:ring-2 focus:ring-green-500 text-sm font-semibold shadow-sm cursor-pointer">
                        <?php foreach ($categories as $cat): ?>
                            <option value="<?php echo $cat['value']; ?>"><?php echo $cat['label']; ?></option>
                        <?php endforeach; ?>
                    </select>
                    <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-4 text-gray-400">
                        <i class="fa-solid fa-chevron-down text-sm"></i>
                    </div>
                </div>
            </div>

            <!-- Photo Upload Area -->
            <div class="mb-5">
                <label class="block text-xs font-bold text-gray-700 uppercase tracking-wider mb-2">Upload Proof (Photo)</label>
                <div class="border-2 border-dashed border-gray-200 rounded-2xl bg-white hover:bg-green-50/50 transition cursor-pointer flex flex-col items-center justify-center py-10 relative shadow-sm group">
                    <input type="file" id="proofFile" name="proof" onchange="previewFile(this)" class="absolute inset-0 w-full h-full opacity-0 cursor-pointer z-10" accept="image/*" capture="environment">
                    
                    <div id="uploadIconContainer" class="w-14 h-14 bg-green-100 text-green-600 rounded-full flex items-center justify-center text-2xl mb-3 group-hover:scale-105 transition-transform">
                        <i class="fa-solid fa-camera"></i>
                    </div>
                    <p id="uploadTextPrimary" class="font-bold text-sm text-gray-800">Tap to take a photo</p>
                    <p id="uploadTextSecondary" class="text-xs text-gray-400 mt-1">or upload from gallery</p>
                </div>
            </div>

            <!-- Optional Notes -->
            <div class="mb-5">
                <label class="block text-xs font-bold text-gray-700 uppercase tracking-wider mb-2">Additional Notes <span class="text-gray-400 font-normal lowercase">(optional)</span></label>
                <textarea id="activityNotes" name="notes" rows="3" placeholder="E.g., Recycled 5 plastic bottles at the main campus bin." class="w-full bg-white border border-gray-200 rounded-xl p-3.5 text-sm text-gray-800 placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-green-500 shadow-sm resize-none"></textarea>
            </div>

            <!-- Metadata/Location Badge -->
            <div class="bg-blue-50 border border-blue-100 rounded-xl p-3.5 flex items-center gap-3 mb-8">
                <div class="w-8 h-8 bg-blue-100 text-blue-600 rounded-full flex items-center justify-center flex-shrink-0 text-sm">
                    <i class="fa-solid fa-location-dot"></i>
                </div>
                <p id="locationStatusText" class="text-xs text-blue-800">Your current location will be attached to verify the submission occurred on campus.</p>
                <input type="hidden" id="activityLocation" name="location">
            </div>

            <!-- Fixed Bottom Submit Button -->
            <div class="fixed bottom-0 left-1/2 transform -translate-x-1/2 w-full max-w-md p-4 bg-white border-t border-gray-200 z-20">
                <button type="submit" class="w-full bg-green-600 hover:bg-green-700 active:bg-green-800 text-white font-bold py-3.5 px-4 rounded-xl shadow-md transition text-sm flex items-center justify-center gap-2 cursor-pointer">
                    <i class="fa-solid fa-paper-plane"></i>
                    <span>Submit for Review</span>
                </button>
            </div>
        </form>
    </main>

    <!-- Mobile Bottom Navigation -->
    <nav class="fixed bottom-0 w-full bg-white border-t border-gray-200 flex justify-around p-3 pb-6 max-w-md left-1/2 transform -translate-x-1/2 z-10 hidden sm:flex">
        <a href="dashboard.html" class="flex flex-col items-center text-gray-400 hover:text-green-600 transition">
            <i class="fa-solid fa-house text-xl mb-1"></i>
            <span class="text-[10px] font-bold">Home</span>
        </a>
        <a href="log-activity.html" class="flex flex-col items-center text-green-600">
            <i class="fa-solid fa-list-check text-xl mb-1"></i>
            <span class="text-[10px] font-bold">Activity</span>
        </a>
        <a href="store.html" class="flex flex-col items-center text-gray-400 hover:text-green-600 transition">
            <i class="fa-solid fa-store text-xl mb-1"></i>
            <span class="text-[10px] font-bold">Store</span>
        </a>
        <a href="profile.html" class="flex flex-col items-center text-gray-400 hover:text-green-600 transition">
            <i class="fa-solid fa-user text-xl mb-1"></i>
            <span class="text-[10px] font-bold">Profile</span>
        </a>
    </nav>

    <!-- External JavaScript File -->
    <script src="log_activity.js"></script>
</body>
</html>
