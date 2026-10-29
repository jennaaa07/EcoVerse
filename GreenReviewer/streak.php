<?php
// PHP session or initialization parameters can be handled here
$system_name = "Eco Hub Streak Monitoring";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Active Streaks - Reviewer</title>
    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- FontAwesome for Icons -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <!-- Custom External CSS -->
    <link href="streaksstyle.css" rel="stylesheet">
</head>
<body class="bg-[#f0fdf4] font-sans min-h-screen text-gray-800 selection:bg-green-200">

    <!-- Header -->
    <header class="bg-white px-8 py-5 flex justify-between items-center shadow-sm sticky top-0 z-10 border-b border-green-100">
        <div class="flex items-center gap-5">
            <a href="viewerdashboard.php" class="h-10 w-10 flex items-center justify-center rounded-full bg-green-50 text-green-700 hover:bg-green-600 hover:text-white transition-all shadow-sm border border-green-100">
                <i class="fa-solid fa-arrow-left text-lg"></i>
            </a>
            <div>
                <p class="text-xs font-bold text-green-600 uppercase tracking-widest mb-0.5">Reviewer Dashboard</p>
                <h1 class="text-2xl font-extrabold text-gray-900 tracking-tight">Streak Multipliers</h1>
            </div>
        </div>
        
        <div class="hidden md:flex items-center gap-2 bg-green-50 px-4 py-2 rounded-full border border-green-200">
            <span class="relative flex h-3 w-3">
              <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-green-400 opacity-75"></span>
              <span class="relative inline-flex rounded-full h-3 w-3 bg-green-500"></span>
            </span>
            <span class="text-sm font-semibold text-green-800">System Monitoring Active</span>
        </div>
    </header>

    <main class="px-6 py-10 max-w-7xl mx-auto space-y-8">
        
        <!-- Overview Stats Cards -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <div class="bg-white rounded-2xl p-6 shadow-[0_8px_30px_rgb(0,0,0,0.04)] border border-green-50 relative overflow-hidden group hover:-translate-y-1 transition-transform duration-300">
                <div class="absolute -right-6 -top-6 text-green-50 opacity-50 group-hover:scale-110 transition-transform duration-500"><i class="fa-solid fa-users text-9xl"></i></div>
                <div class="relative z-10">
                    <div class="w-12 h-12 bg-green-100 rounded-xl flex items-center justify-center text-green-600 text-xl mb-4 shadow-sm"><i class="fa-solid fa-chart-line"></i></div>
                    <h3 class="text-sm font-bold text-gray-500 uppercase tracking-wide mb-1">Total Active Streaks</h3>
                    <p class="text-4xl font-extrabold text-gray-900">3,492</p>
                </div>
            </div>

            <div class="bg-white rounded-2xl p-6 shadow-[0_8px_30px_rgb(0,0,0,0.04)] border border-green-50 relative overflow-hidden group hover:-translate-y-1 transition-transform duration-300">
                <div class="absolute -right-6 -top-6 text-orange-50 opacity-50 group-hover:scale-110 transition-transform duration-500"><i class="fa-solid fa-fire text-9xl"></i></div>
                <div class="relative z-10">
                    <div class="w-12 h-12 bg-orange-100 rounded-xl flex items-center justify-center text-orange-500 text-xl mb-4 shadow-sm"><i class="fa-solid fa-trophy"></i></div>
                    <h3 class="text-sm font-bold text-gray-500 uppercase tracking-wide mb-1">Highest Current Streak</h3>
                    <p class="text-4xl font-extrabold text-gray-900">142 <span class="text-lg font-bold text-orange-500 ml-1">Days</span></p>
                </div>
            </div>

            <div class="bg-gradient-to-br from-green-700 to-green-900 rounded-2xl p-6 shadow-lg shadow-green-900/20 relative overflow-hidden group hover:-translate-y-1 transition-transform duration-300 text-white">
                <div class="absolute -right-2 -bottom-2 text-green-600 opacity-30 group-hover:scale-110 transition-transform duration-500"><i class="fa-solid fa-bolt text-8xl"></i></div>
                <div class="relative z-10">
                    <div class="w-12 h-12 bg-white/20 rounded-xl flex items-center justify-center text-white text-xl mb-4 backdrop-blur-sm border border-white/30"><i class="fa-solid fa-leaf"></i></div>
                    <h3 class="text-sm font-bold text-green-200 uppercase tracking-wide mb-1">Avg Bonus Multiplier</h3>
                    <p class="text-4xl font-extrabold text-white flex items-end gap-2">1.4x <i class="fa-solid fa-arrow-trend-up text-green-400 text-xl mb-1.5"></i></p>
                </div>
            </div>
        </div>

        <!-- Leaderboard / Monitor Table Container -->
        <div class="bg-white rounded-3xl shadow-sm border border-green-100 overflow-hidden">
            
            <div class="p-6 border-b border-green-100 flex flex-col md:flex-row justify-between items-center gap-4 bg-white">
                <div>
                    <h2 class="text-xl font-bold text-gray-900">Live Streak Monitoring</h2>
                    <p class="text-sm text-gray-500 mt-1">Real-time data for ongoing sustainability chains.</p>
                </div>
                
                <!-- Search Input with JS ID attached -->
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <i class="fa-solid fa-magnifying-glass text-green-600"></i>
                    </div>
                    <input type="text" id="searchInput" placeholder="Search Student Name or ID..." class="pl-10 pr-4 py-2.5 rounded-full border border-green-200 bg-green-50/50 text-sm outline-none w-full md:w-72 focus:ring-2 focus:ring-green-500 focus:bg-white transition-all text-gray-700 placeholder-green-600/50 shadow-inner">
                </div>
            </div>

            <div class="overflow-x-auto">
                <table class="w-full text-left text-sm whitespace-nowrap">
                    <thead class="bg-green-50/80 text-green-800 uppercase text-xs font-bold tracking-wider border-b border-green-200">
                        <tr>
                            <th class="px-6 py-4">Participant</th>
                            <th class="px-6 py-4">Current Streak</th>
                            <th class="px-6 py-4">Active Multiplier</th>
                            <th class="px-6 py-4">Last Action Logged</th>
                            <th class="px-6 py-4 text-right">Actions</th>
                        </tr>
                    </thead>
                    <tbody id="tableBody" class="divide-y divide-green-50">
                        
                        <!-- Row 1 -->
                        <tr class="hover:bg-green-50/50 transition-colors group">
                            <td class="px-6 py-4">
                                <div class="flex items-center gap-3">
                                    <div class="w-8 h-8 rounded-full bg-green-100 text-green-700 flex items-center justify-center font-bold text-xs">JD</div>
                                    <div>
                                        <div class="font-bold text-gray-900">Jane Doe</div>
                                        <div class="text-xs text-gray-500">P-102934</div>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4 font-bold text-gray-800">
                                <span class="bg-orange-100 text-orange-700 px-3 py-1 rounded-full flex items-center w-fit gap-1.5 shadow-sm border border-orange-200">
                                    <i class="fa-solid fa-fire"></i> 142 Days
                                </span>
                            </td>
                            <td class="px-6 py-4 font-bold">
                                <span class="text-green-600 flex items-center gap-2">2.5x <span class="bg-green-100 text-green-700 text-[10px] uppercase px-2 py-0.5 rounded border border-green-200">Max</span></span>
                            </td>
                            <td class="px-6 py-4 text-gray-500 font-medium">Today, 08:30 AM</td>
                            <td class="px-6 py-4 text-right">
                                <button data-name="Jane Doe" data-id="P-102934" data-streak="142" class="adjust-btn bg-white border border-green-200 text-green-700 px-4 py-2 rounded-lg text-xs font-bold hover:bg-green-600 hover:text-white hover:border-green-600 transition-all shadow-sm cursor-pointer">
                                    <i class="fa-solid fa-sliders mr-1"></i> Adjust
                                </button>
                            </td>
                        </tr>

                        <!-- Row 2 -->
                        <tr class="hover:bg-green-50/50 transition-colors group">
                            <td class="px-6 py-4">
                                <div class="flex items-center gap-3">
                                    <div class="w-8 h-8 rounded-full bg-blue-100 text-blue-700 flex items-center justify-center font-bold text-xs">JS</div>
                                    <div>
                                        <div class="font-bold text-gray-900">John Smith</div>
                                        <div class="text-xs text-gray-500">P-992102</div>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4 font-bold text-gray-800">
                                <span class="bg-orange-50 text-orange-600 px-3 py-1 rounded-full flex items-center w-fit gap-1.5 border border-orange-100">
                                    <i class="fa-solid fa-fire"></i> 14 Days
                                </span>
                            </td>
                            <td class="px-6 py-4 font-bold text-green-600">1.2x</td>
                            <td class="px-6 py-4 text-gray-500 font-medium">Yesterday, 19:45 PM</td>
                            <td class="px-6 py-4 text-right">
                                <button data-name="John Smith" data-id="P-992102" data-streak="14" class="adjust-btn bg-white border border-green-200 text-green-700 px-4 py-2 rounded-lg text-xs font-bold hover:bg-green-600 hover:text-white hover:border-green-600 transition-all shadow-sm cursor-pointer">
                                    <i class="fa-solid fa-sliders mr-1"></i> Adjust
                                </button>
                            </td>
                        </tr>

                    </tbody>
                </table>
            </div>
            
            <!-- Table Footer/Pagination space -->
            <div class="p-4 border-t border-green-100 bg-gray-50 flex justify-between items-center text-xs text-gray-500">
                <span>Showing 1 to 2 of 3,492 entries</span>
                <div class="flex gap-2">
                    <button class="px-3 py-1 rounded bg-white border border-gray-200 hover:bg-gray-100 disabled:opacity-50" disabled>Prev</button>
                    <button id="nextPageBtn" class="px-3 py-1 rounded bg-white border border-gray-200 hover:bg-gray-100 transition-colors cursor-pointer">Next</button>
                </div>
            </div>
        </div>
    </main>

    <!-- Overlay Pop-up Modal (Hidden by default) -->
    <div id="adjustModal" class="hidden fixed inset-0 bg-gray-900/60 backdrop-blur-sm z-50 items-center justify-center p-4">
        <div class="bg-white rounded-2xl shadow-xl w-full max-w-md overflow-hidden transform scale-100 transition-transform">
            <!-- Modal Header -->
            <div class="bg-green-600 px-6 py-4 flex justify-between items-center text-white">
                <h3 class="font-bold text-lg"><i class="fa-solid fa-user-pen mr-2"></i> Adjust User Streak</h3>
                <button id="closeModalBtn" class="text-green-200 hover:text-white transition cursor-pointer"><i class="fa-solid fa-xmark text-xl"></i></button>
            </div>
            
            <!-- Modal Body -->
            <div class="p-6 space-y-4">
                <div>
                    <label class="block text-xs font-bold text-gray-500 uppercase tracking-wide mb-1">Participant Name</label>
                    <p id="modalName" class="text-lg font-bold text-gray-900">Name Here</p>
                    <p id="modalId" class="text-sm text-gray-500">ID Here</p>
                </div>
                
                <div>
                    <label class="block text-xs font-bold text-gray-500 uppercase tracking-wide mb-2">Manual Streak Override (Days)</label>
                    <div class="flex items-center gap-3">
                        <i class="fa-solid fa-fire text-orange-500 text-xl"></i>
                        <input type="number" id="streakInput" class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-green-500 focus:outline-none transition-shadow font-bold text-gray-800">
                    </div>
                    <p class="text-xs text-gray-400 mt-2"><i class="fa-solid fa-circle-info mr-1"></i> Multipliers will recalculate automatically based on the new streak count.</p>
                </div>
            </div>

            <!-- Modal Footer -->
            <div class="bg-gray-50 px-6 py-4 border-t border-gray-100 flex justify-end gap-3">
                <button id="cancelModalBtn" class="px-4 py-2 rounded-lg text-sm font-bold text-gray-600 hover:bg-gray-200 transition-colors cursor-pointer">Cancel</button>
                <button id="saveChangesBtn" class="px-4 py-2 rounded-lg text-sm font-bold bg-green-600 text-white hover:bg-green-700 shadow-md hover:shadow-lg transition-all cursor-pointer">Save Changes</button>
            </div>
        </div>
    </div>

    <!-- External JavaScript File -->
    <script src="streaks.js"></script>
</body>
</html>