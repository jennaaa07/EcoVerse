<?php
// language.php
$pageTitle = "Language Settings - EcoRewards";

$languages = [
    ["code" => "en", "badge" => "EN", "name" => "English", "sub" => "Default", "bg" => "bg-green-100", "text" => "text-green-600", "checked" => true],
    ["code" => "ms", "badge" => "MS", "name" => "Bahasa Malaysia", "sub" => "Malay", "bg" => "bg-blue-100", "text" => "text-blue-600", "checked" => false],
    ["code" => "zh", "badge" => "中", "name" => "中文", "sub" => "Chinese (Simplified)", "bg" => "bg-amber-100", "text" => "text-amber-600", "checked" => false],
    ["code" => "ta", "badge" => "தமி", "name" => "தமிழ்", "sub" => "Tamil", "bg" => "bg-purple-100", "text" => "text-purple-600", "checked" => false],
    ["code" => "id", "badge" => "ID", "name" => "Bahasa Indonesia", "sub" => "Indonesian", "bg" => "bg-indigo-100", "text" => "text-indigo-600", "checked" => false],
    ["code" => "ja", "badge" => "日", "name" => "日本語", "sub" => "Japanese", "bg" => "bg-red-100", "text" => "text-red-600", "checked" => false],
    ["code" => "fr", "badge" => "FR", "name" => "Français", "sub" => "French", "bg" => "bg-sky-100", "text" => "text-sky-600", "checked" => false],
    ["code" => "de", "badge" => "DE", "name" => "Deutsch", "sub" => "German", "bg" => "bg-yellow-100", "text" => "text-yellow-700", "checked" => false],
    ["code" => "es", "badge" => "ES", "name" => "Español", "sub" => "Spanish", "bg" => "bg-rose-100", "text" => "text-rose-600", "checked" => false],
    ["code" => "ar", "badge" => "عرب", "name" => "العربية", "sub" => "Arabic", "bg" => "bg-emerald-100", "text" => "text-emerald-700", "checked" => false],
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
    <header class="bg-white shadow-sm px-4 py-3 sticky top-0 z-10 flex items-center justify-between">
        <a href="setting.html" class="w-10 h-10 rounded-full bg-gray-100 flex items-center justify-center text-gray-700 hover:bg-gray-200 transition">
            <i class="fa-solid fa-arrow-left text-lg"></i>
        </a>
        <h1 class="text-lg font-bold text-gray-800">Language</h1>
        <div class="w-10"></div>
    </header>

    <main class="p-4 max-w-md mx-auto space-y-4">

        <!-- Search Bar -->
        <div class="relative">
            <span class="absolute inset-y-0 left-0 flex items-center pl-3.5 pointer-events-none text-gray-400">
                <i class="fa-solid fa-search"></i>
            </span>
            <input type="text" id="langSearchInput" onkeyup="filterLanguages()" placeholder="Search language..." class="w-full bg-white border border-gray-200 rounded-2xl py-3 pl-10 pr-4 text-xs focus:outline-none focus:border-green-600 transition shadow-sm">
        </div>

        <!-- Language Options Group -->
        <div id="languageContainer" class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden divide-y divide-gray-100">
            <?php foreach ($languages as $lang): ?>
                <label class="lang-item flex items-center justify-between p-4 hover:bg-gray-50 cursor-pointer transition">
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 rounded-xl <?php echo $lang['bg'] . ' ' . $lang['text']; ?> flex items-center justify-center font-bold text-sm shrink-0">
                            <?php echo $lang['badge']; ?>
                        </div>
                        <div>
                            <h4 class="font-bold text-xs text-gray-800"><?php echo htmlspecialchars($lang['name']); ?></h4>
                            <p class="text-[10px] text-gray-400"><?php echo htmlspecialchars($lang['sub']); ?></p>
                        </div>
                    </div>
                    <input type="radio" name="language" value="<?php echo $lang['code']; ?>" <?php echo $lang['checked'] ? 'checked' : ''; ?> class="w-4 h-4 text-green-600 border-gray-300 focus:ring-green-500 cursor-pointer">
                </label>
            <?php endforeach; ?>
        </div>

        <!-- Save Button -->
        <div class="pt-2">
            <button type="button" onclick="saveLanguage()" class="w-full bg-green-600 hover:bg-green-700 text-white font-bold py-3 px-4 rounded-2xl shadow-sm transition text-xs cursor-pointer">
                Save Changes
            </button>
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
    <script src="language.js"></script>
</body>
</html>