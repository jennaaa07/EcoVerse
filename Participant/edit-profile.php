<?php
// edit_profile.php
$pageTitle = "Edit Profile - Eco Hub";
$fullName = "Name";
$username = "username";
$email = "email@example.com";
$bio = "Passionate about zero-waste living, indoor composting, and reducing campus plastic consumption! 🌱✨";
$campus = "Main Campus • Environmental Science";
$profileImg = "../images/profile.jpg";
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
        <a href="profile.html" class="w-10 h-10 rounded-full bg-gray-100 flex items-center justify-center text-gray-700 hover:bg-gray-200 transition">
            <i class="fa-solid fa-arrow-left text-lg"></i>
        </a>
        <h1 class="text-lg font-bold text-gray-800">Edit Profile</h1>
        <button type="button" onclick="handleProfileSave()" class="text-sm font-bold text-green-600 hover:text-green-700 transition cursor-pointer">
            Save
        </button>
    </header>

    <main class="p-4 max-w-md mx-auto space-y-6">

        <!-- Profile Picture Upload -->
        <div class="flex flex-col items-center justify-center pt-2">
            <div class="relative">
                <img id="profilePreview" src="<?php echo $profileImg; ?>" class="w-24 h-24 rounded-full object-cover border-4 border-white shadow-md" alt="Profile Picture">
                <label for="avatar-upload" class="absolute bottom-0 right-0 bg-green-600 text-white w-8 h-8 rounded-full flex items-center justify-center shadow-md cursor-pointer hover:bg-green-700 transition">
                    <i class="fa-solid fa-camera text-xs"></i>
                </label>
                <input id="avatar-upload" type="file" class="hidden" accept="image/*" onchange="previewImage(event)">
            </div>
            <p class="text-xs text-gray-400 mt-2">Tap camera icon to change photo</p>
        </div>

        <!-- Edit Profile Form -->
        <form id="editProfileForm" onsubmit="event.preventDefault(); handleProfileSave();" class="space-y-4">
            
            <!-- Full Name -->
            <div class="space-y-1">
                <label class="text-xs font-bold text-gray-700 block">Full Name</label>
                <div class="relative">
                    <span class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none text-gray-400">
                        <i class="fa-regular fa-user text-sm"></i>
                    </span>
                    <input type="text" id="fullName" value="<?php echo htmlspecialchars($fullName); ?>" class="w-full bg-white border border-gray-200 rounded-xl pl-9 pr-3 py-2.5 text-xs text-gray-800 font-medium focus:outline-none focus:border-green-600 shadow-2xs">
                </div>
            </div>

            <!-- Username -->
            <div class="space-y-1">
                <label class="text-xs font-bold text-gray-700 block">Username</label>
                <div class="relative">
                    <span class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none text-gray-400">
                        <i class="fa-solid fa-at text-sm"></i>
                    </span>
                    <input type="text" id="username" value="<?php echo htmlspecialchars($username); ?>" class="w-full bg-white border border-gray-200 rounded-xl pl-9 pr-3 py-2.5 text-xs text-gray-800 font-medium focus:outline-none focus:border-green-600 shadow-2xs">
                </div>
            </div>

            <!-- Email Address -->
            <div class="space-y-1">
                <label class="text-xs font-bold text-gray-700 block">Email Address</label>
                <div class="relative">
                    <span class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none text-gray-400">
                        <i class="fa-regular fa-envelope text-sm"></i>
                    </span>
                    <input type="email" id="email" value="<?php echo htmlspecialchars($email); ?>" class="w-full bg-white border border-gray-200 rounded-xl pl-9 pr-3 py-2.5 text-xs text-gray-800 font-medium focus:outline-none focus:border-green-600 shadow-2xs">
                </div>
            </div>

            <!-- Bio -->
            <div class="space-y-1">
                <label class="text-xs font-bold text-gray-700 block">Bio</label>
                <textarea id="bio" rows="3" class="w-full bg-white border border-gray-200 rounded-xl p-3 text-xs text-gray-800 font-medium focus:outline-none focus:border-green-600 shadow-2xs resize-none" placeholder="Write a short bio..."><?php echo htmlspecialchars($bio); ?></textarea>
            </div>

            <!-- Campus / Organization -->
            <div class="space-y-1">
                <label class="text-xs font-bold text-gray-700 block">Campus / Affiliation</label>
                <div class="relative">
                    <span class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none text-gray-400">
                        <i class="fa-solid fa-building-columns text-sm"></i>
                    </span>
                    <input type="text" id="campus" value="<?php echo htmlspecialchars($campus); ?>" class="w-full bg-white border border-gray-200 rounded-xl pl-9 pr-3 py-2.5 text-xs text-gray-800 font-medium focus:outline-none focus:border-green-600 shadow-2xs">
                </div>
            </div>

            <!-- Action Buttons -->
            <div class="pt-4 space-y-2">
                <button type="submit" class="w-full bg-green-600 text-white font-bold text-xs py-3 rounded-xl shadow-sm hover:bg-green-700 transition flex items-center justify-center gap-2 cursor-pointer">
                    <i class="fa-solid fa-check text-xs"></i> Save Changes
                </button>
                <a href="profile.html" class="w-full bg-gray-100 text-gray-600 font-bold text-xs py-3 rounded-xl hover:bg-gray-200 transition flex items-center justify-center">
                    Cancel
                </a>
            </div>

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
    <script src="edit_profile.js"></script>
</body>
</html>
