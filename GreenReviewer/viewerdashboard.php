<?php
session_start();

if (!isset($_SESSION['user_id']) || ($_SESSION['role'] ?? '') !== 'Reviewer') {
    header('Location: ../index.php');
    exit();
}

$system_name = "EcoRewards Reviewer Portal";
$user_name = $_SESSION['name'] ?? 'Reviewer';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Green Reviewer Dashboard</title>
    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- FontAwesome for Icons -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <!-- Custom External CSS -->
    <link href="dashboardstyle.css" rel="stylesheet">
</head>
<body class="bg-gradient-to-br from-emerald-50 via-teal-50/40 to-slate-100 font-sans h-screen flex overflow-hidden text-gray-800 antialiased selection:bg-emerald-500 selection:text-white">

    <!-- Ambient Background Glow Effects -->
    <div class="absolute top-0 left-1/4 w-96 h-96 bg-emerald-300/10 rounded-full blur-3xl pointer-events-none"></div>
    <div class="absolute bottom-10 right-10 w-96 h-96 bg-teal-300/10 rounded-full blur-3xl pointer-events-none"></div>

    <!-- Sidebar Navigation (Core Functionalities) -->
    <aside class="w-72 bg-gradient-to-b from-emerald-950 via-emerald-900 to-teal-950 text-white flex flex-col shadow-2xl z-20 border-r border-emerald-800/40">
        <div class="p-6 border-b border-emerald-800/60 flex items-center gap-3 bg-emerald-950/40 backdrop-blur-md">
            <div class="w-10 h-10 rounded-2xl bg-emerald-500/20 border border-emerald-400/30 flex items-center justify-center text-emerald-400 shadow-lg shadow-emerald-950/50">
                <i class="fa-solid fa-leaf text-xl"></i>
            </div>
            <div>
                <h1 class="text-lg font-extrabold tracking-tight text-white">EcoRewards</h1>
                <span class="text-[10px] font-bold text-emerald-400 uppercase tracking-widest">Reviewer Portal</span>
            </div>
        </div>
        
        <div class="px-6 pt-6 pb-2 text-[11px] font-extrabold text-emerald-400/80 uppercase tracking-wider">
            Core Verifier Tasks
        </div>

        <nav class="flex-1 overflow-y-auto px-3 py-2 space-y-1.5 scrollbar-thin scrollbar-thumb-emerald-800">
            <a href="pendingclaims.php" class="sidebar-link flex items-center gap-3.5 hover:bg-emerald-900/50 px-4 py-3.5 rounded-2xl transition-all duration-300 text-emerald-100/70 hover:text-white font-medium group">
                <i class="fa-solid fa-clipboard-check w-5 text-center text-emerald-400 group-hover:scale-110 transition-transform"></i> 
                <span>Review Pending Claims</span>
            </a>
            <a href="quickpos.php" class="sidebar-link flex items-center gap-3.5 hover:bg-emerald-900/50 px-4 py-3.5 rounded-2xl transition-all duration-300 text-emerald-100/70 hover:text-white font-medium group">
                <i class="fa-solid fa-cash-register w-5 text-center text-emerald-400 group-hover:scale-110 transition-transform"></i> 
                <span>Quick Points POS</span>
            </a>
            <a href="rewarddistribution.php" class="sidebar-link flex items-center gap-3.5 hover:bg-emerald-900/50 px-4 py-3.5 rounded-2xl transition-all duration-300 text-emerald-100/70 hover:text-white font-medium group">
                <i class="fa-solid fa-ticket w-5 text-center text-emerald-400 group-hover:scale-110 transition-transform"></i> 
                <span>Reward Distribution</span>
            </a>
            <a href="qrscanner.php" class="sidebar-link flex items-center gap-3.5 hover:bg-emerald-900/50 px-4 py-3.5 rounded-2xl transition-all duration-300 text-emerald-100/70 hover:text-white font-medium group">
                <i class="fa-solid fa-qrcode w-5 text-center text-emerald-400 group-hover:scale-110 transition-transform"></i> 
                <span>QR Check-In Scanner</span>
            </a>
            <a href="frauddesk.php" class="sidebar-link flex items-center gap-3.5 hover:bg-emerald-900/50 px-4 py-3.5 rounded-2xl transition-all duration-300 text-emerald-100/70 hover:text-white font-medium group">
                <i class="fa-solid fa-shield w-5 text-center text-emerald-400 group-hover:scale-110 transition-transform"></i>
                <span>Fraud Investigation Desk</span>
            </a>
            <a href="inventorycontrol.php" class="sidebar-link flex items-center gap-3.5 hover:bg-emerald-900/50 px-4 py-3.5 rounded-2xl transition-all duration-300 text-emerald-100/70 hover:text-white font-medium group">
                <i class="fa-solid fa-boxes-stacked w-5 text-center text-emerald-400 group-hover:scale-110 transition-transform"></i> 
                <span>Inventory Control</span>
            </a>
        </nav>

        <!-- Linked Profile Footer Widget -->
        <a href="profile.php" class="p-4 m-3 rounded-2xl bg-emerald-950/60 border border-emerald-800/40 text-sm flex items-center justify-between cursor-pointer hover:bg-emerald-900/60 transition-all shadow-inner group block">
            <div class="flex items-center gap-3">
                <div class="bg-gradient-to-br from-emerald-500 to-teal-600 rounded-xl h-9 w-9 flex items-center justify-center text-white shadow-md">
                    <i class="fa-solid fa-user text-xs"></i>
                </div>
                <div>
                    <p class="text-xs font-bold text-white"><?php echo htmlspecialchars($user_name); ?></p>
                    <p class="text-[10px] text-emerald-400 font-medium">View Profile</p>
                </div>
            </div>
            <i class="fa-solid fa-arrow-right text-emerald-400 group-hover:translate-x-0.5 transition-transform text-xs"></i>
        </a>
    </aside>

    <!-- Main Content Area -->
    <main class="flex-1 flex flex-col h-full overflow-y-auto relative z-10">
        
        <!-- Top Header -->
        <header class="bg-white/85 backdrop-blur-xl shadow-xs px-8 py-5 flex justify-between items-center border-b border-emerald-100/80 sticky top-0 z-20">
            <div>
                <p class="text-[11px] font-extrabold text-emerald-600 uppercase tracking-widest flex items-center gap-1.5">
                    <span class="w-2 h-2 rounded-full bg-emerald-500 animate-pulse"></span> Executive Control Panel
                </p>
                <h2 class="text-2xl font-extrabold text-gray-900 tracking-tight">Reviewer Dashboard Overview</h2>
            </div>
            <span class="bg-emerald-50 text-emerald-800 text-xs font-extrabold px-4 py-2 rounded-2xl border border-emerald-200/80 shadow-2xs flex items-center gap-2">
                <span class="w-2 h-2 rounded-full bg-emerald-500"></span> System Status: Online
            </span>
        </header>

        <!-- Unique Functionalities Section -->
        <div class="p-8 max-w-7xl mx-auto w-full space-y-6">
            <div class="bg-white/70 backdrop-blur-md p-6 rounded-3xl border border-emerald-100/80 shadow-xl shadow-emerald-950/5 flex flex-col md:flex-row justify-between items-start md:items-center gap-4">
                <div>
                    <h3 class="text-xl font-extrabold text-gray-900 tracking-tight">System Management Modules</h3>
                    <p class="text-xs text-gray-500 mt-1 font-medium">Oversee unique theme functionalities and automated background processes.</p>
                </div>
                <div class="flex items-center gap-2 text-xs font-bold text-emerald-700 bg-emerald-50 px-4 py-2 rounded-2xl border border-emerald-200">
                    <i class="fa-solid fa-shield-halved"></i> 5 Active Subsystems
                </div>
            </div>

            <!-- Grid for Unique Features -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                
                <!-- Unique Feature 1 -->
                <div class="bg-white/90 backdrop-blur-md p-7 rounded-3xl shadow-xl shadow-emerald-950/5 border border-emerald-100/80 hover:shadow-2xl hover:shadow-emerald-950/10 hover:border-emerald-300 transition-all duration-300 flex flex-col h-full group">
                    <div class="flex items-center justify-between mb-4">
                        <div class="w-12 h-12 rounded-2xl bg-amber-50 border border-amber-200/60 flex items-center justify-center text-amber-600 shadow-sm group-hover:scale-110 transition-transform">
                            <i class="fa-solid fa-fire text-xl"></i>
                        </div>
                        <span class="text-[10px] font-extrabold text-amber-700 bg-amber-100/80 px-2.5 py-1 rounded-xl">Multiplier</span>
                    </div>
                    <h4 class="font-extrabold text-gray-900 text-base mb-2">Streak Multipliers</h4>
                    <p class="text-xs text-gray-600 mb-6 flex-grow leading-relaxed font-medium">Monitor the automated point bonus multipliers based on users' consecutive days of sustainable actions.</p>
                    <a href="streaks.php" class="inline-flex items-center gap-2 text-emerald-600 font-extrabold text-xs hover:text-emerald-700 mt-auto group/link">
                        <span>View Active Streaks</span> 
                        <i class="fa-solid fa-arrow-right text-[10px] group-hover/link:translate-x-1 transition-transform"></i>
                    </a>
                </div>

                <!-- Unique Feature 2 -->
                <div class="bg-white/90 backdrop-blur-md p-7 rounded-3xl shadow-xl shadow-emerald-950/5 border border-emerald-100/80 hover:shadow-2xl hover:shadow-emerald-950/10 hover:border-emerald-300 transition-all duration-300 flex flex-col h-full group">
                    <div class="flex items-center justify-between mb-4">
                        <div class="w-12 h-12 rounded-2xl bg-teal-50 border border-teal-200/60 flex items-center justify-center text-teal-600 shadow-sm group-hover:scale-110 transition-transform">
                            <i class="fa-solid fa-chart-line text-xl"></i>
                        </div>
                        <span class="text-[10px] font-extrabold text-teal-700 bg-teal-100/80 px-2.5 py-1 rounded-xl">Metrics</span>
                    </div>
                    <h4 class="font-extrabold text-gray-900 text-base mb-2">Adjust Conversion Rates</h4>
                    <p class="text-xs text-gray-600 mb-6 flex-grow leading-relaxed font-medium">Manage the conversion algorithms translating raw green points into real-world CO2 and plastic saved metrics.</p>
                    <a href="adjustconversionrates.php" class="inline-flex items-center gap-2 text-emerald-600 font-extrabold text-xs hover:text-emerald-700 mt-auto group/link">
                        <span>Adjust Conversion Rates</span> 
                        <i class="fa-solid fa-arrow-right text-[10px] group-hover/link:translate-x-1 transition-transform"></i>
                    </a>
                </div>

                <!-- Unique Feature 3 -->
                <div class="bg-white/90 backdrop-blur-md p-7 rounded-3xl shadow-xl shadow-emerald-950/5 border border-emerald-100/80 hover:shadow-2xl hover:shadow-emerald-950/10 hover:border-emerald-300 transition-all duration-300 flex flex-col h-full group">
                    <div class="flex items-center justify-between mb-4">
                        <div class="w-12 h-12 rounded-2xl bg-blue-50 border border-blue-200/60 flex items-center justify-center text-blue-600 shadow-sm group-hover:scale-110 transition-transform">
                            <i class="fa-solid fa-bolt text-xl"></i>
                        </div>
                        <span class="text-[10px] font-extrabold text-blue-700 bg-blue-100/80 px-2.5 py-1 rounded-xl">Automation</span>
                    </div>
                    <h4 class="font-extrabold text-gray-900 text-base mb-2">Flash-Sale Automation</h4>
                    <p class="text-xs text-gray-600 mb-6 flex-grow leading-relaxed font-medium">Schedule short-term discounted point costs for marketplace rewards with live visual countdown timers.</p>
                    <a href="flashsalesautomation.php" class="inline-flex items-center gap-2 text-emerald-600 font-extrabold text-xs hover:text-emerald-700 mt-auto group/link">
                        <span>Schedule New Sale</span> 
                        <i class="fa-solid fa-arrow-right text-[10px] group-hover/link:translate-x-1 transition-transform"></i>
                    </a>
                </div>

                <!-- Unique Feature 4 -->
                <div class="bg-white/90 backdrop-blur-md p-7 rounded-3xl shadow-xl shadow-emerald-950/5 border border-emerald-100/80 hover:shadow-2xl hover:shadow-emerald-950/10 hover:border-emerald-300 transition-all duration-300 flex flex-col h-full group">
                    <div class="flex items-center justify-between mb-4">
                        <div class="w-12 h-12 rounded-2xl bg-emerald-50 border border-emerald-200/60 flex items-center justify-center text-emerald-600 shadow-sm group-hover:scale-110 transition-transform">
                            <i class="fa-solid fa-hand-holding-heart text-xl"></i>
                        </div>
                        <span class="text-[10px] font-extrabold text-emerald-700 bg-emerald-100/80 px-2.5 py-1 rounded-xl">Community</span>
                    </div>
                    <h4 class="font-extrabold text-gray-900 text-base mb-2">Milestone Crowdfunding</h4>
                    <p class="text-xs text-gray-600 mb-6 flex-grow leading-relaxed font-medium">Track collective point pools and voluntary point donations aimed at large-scale campus improvement projects.</p>
                    <a href="updategoals.php" class="inline-flex items-center gap-2 text-emerald-600 font-extrabold text-xs hover:text-emerald-700 mt-auto group/link">
                        <span>Update Global Goals</span> 
                        <i class="fa-solid fa-arrow-right text-[10px] group-hover/link:translate-x-1 transition-transform"></i>
                    </a>
                </div>

                <!-- Unique Feature 5 -->
                <div class="bg-white/90 backdrop-blur-md p-7 rounded-3xl shadow-xl shadow-emerald-950/5 border border-emerald-100/80 hover:shadow-2xl hover:shadow-emerald-950/10 hover:border-emerald-300 transition-all duration-300 flex flex-col h-full group">
                    <div class="flex items-center justify-between mb-4">
                        <div class="w-12 h-12 rounded-2xl bg-purple-50 border border-purple-200/60 flex items-center justify-center text-purple-600 shadow-sm group-hover:scale-110 transition-transform">
                            <i class="fa-solid fa-gift text-xl"></i>
                        </div>
                        <span class="text-[10px] font-extrabold text-purple-700 bg-purple-100/80 px-2.5 py-1 rounded-xl">Security</span>
                    </div>
                    <h4 class="font-extrabold text-gray-900 text-base mb-2">Eco-Gifting Verification</h4>
                    <p class="text-xs text-gray-600 mb-6 flex-grow leading-relaxed font-medium">Audit secure peer-to-peer point transfers between student accounts to prevent negative balance manipulation.</p>
                    <a href="ecogifting.php" class="inline-flex items-center gap-2 text-emerald-600 font-extrabold text-xs hover:text-emerald-700 mt-auto group/link">
                        <span>View P2P Ledgers</span> 
                        <i class="fa-solid fa-arrow-right text-[10px] group-hover/link:translate-x-1 transition-transform"></i>
                    </a>
                </div>

            </div>
        </div>
    </main>

    <!-- External JavaScript File -->
    <script src="dashboard.js"></script>
</body>
</html>
