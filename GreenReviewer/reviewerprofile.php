<?php
session_start();
if (!isset($_SESSION['user_id']) || ($_SESSION['role'] ?? '') !== 'Reviewer') {
    header('Location: ../index.php');
    exit();
}
$system_name = "Eco Hub Reviewer Profile";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reviewer Profile - Eco Hub</title>
    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- FontAwesome Icons -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <!-- Custom External CSS -->
    <link href="reviewerglobalstyle.css" rel="stylesheet">
</head>
<body class="bg-[#e2ebe4] font-sans min-h-screen text-gray-900 selection:bg-emerald-800 selection:text-white">

    <!-- Header Section -->
    <header class="bg-white px-10 py-6 flex justify-between items-center shadow-sm sticky top-0 z-20 border-b-2 border-emerald-200">
        <div class="flex items-center gap-4">
            <a href="viewerdashboard.php" class="w-10 h-10 rounded-xl bg-emerald-50 border border-emerald-300 flex items-center justify-center text-emerald-800 hover:bg-emerald-900 hover:text-white hover:border-emerald-900 transition-all duration-300 shadow-xs group">
                <i class="fa-solid fa-arrow-left text-base group-hover:-translate-x-0.5 transition-transform"></i>
            </a>
            <div>
                <p class="text-xs font-black text-emerald-700 uppercase tracking-widest flex items-center gap-1.5">
                    <span class="w-2 h-2 rounded-full bg-emerald-500 animate-pulse"></span> System Admin
                </p>
                <h1 class="text-2xl font-black tracking-tight text-emerald-950">Reviewer Account Profile</h1>
            </div>
        </div>
        <div class="flex items-center gap-3">
            <div class="border-2 border-emerald-300 text-emerald-900 bg-emerald-50/80 backdrop-blur-sm px-4 py-2.5 rounded-2xl font-bold text-xs flex items-center gap-2 shadow-2xs hidden md:flex">
                <i class="fa-solid fa-user-shield text-emerald-600 animate-bounce"></i> Security Status: Secured
            </div>
            <button id="logoutBtn" class="px-4 py-2.5 bg-red-50 border-2 border-red-300 text-red-700 font-black rounded-2xl text-xs shadow-2xs hover:bg-red-600 hover:text-white hover:border-red-600 transition-all duration-200 cursor-pointer flex items-center gap-2">
                <i class="fa-solid fa-right-from-bracket"></i> Logout
            </button>
        </div>
    </header>

    <!-- Main Grid Content -->
    <main class="px-10 py-10 max-w-7xl mx-auto grid grid-cols-1 lg:grid-cols-3 gap-8">
        
        <!-- Left Side: Profile Meta Card & Permissions -->
        <div class="space-y-6 lg:col-span-1">
            
            <!-- Meta Box -->
            <div class="bg-white rounded-3xl p-6 card-shadow border-2 border-emerald-200 text-center relative overflow-hidden">
                <!-- Decorative top accent bar -->
                <div class="absolute top-0 left-0 right-0 h-2 bg-gradient-to-r from-emerald-500 via-teal-500 to-green-600"></div>

                <div id="profileAvatar" class="w-24 h-24 bg-gradient-to-tr from-emerald-800 to-emerald-600 rounded-2xl mx-auto mb-4 border-2 border-emerald-700 flex items-center justify-center text-white text-3xl font-black shadow-inner transform hover:rotate-3 transition-transform">
                    CL
                </div>
                <h2 id="profileName" class="text-xl font-black text-emerald-950">Canny Le</h2>
                <p class="text-xs text-emerald-700 font-mono mt-0.5 font-bold tracking-wide">Staff ID: REV001</p>
                
                <div class="mt-4 inline-block bg-emerald-100 text-emerald-900 border-2 border-emerald-300 text-xs font-black px-3.5 py-1.5 rounded-xl uppercase tracking-wider shadow-2xs">
                    <i class="fa-solid fa-award mr-1"></i> Level 3 Senior Auditor
                </div>

                <hr class="border-emerald-100 my-6">

                <div class="grid grid-cols-2 gap-3 text-left text-xs bg-emerald-50/60 p-3.5 rounded-2xl border-2 border-emerald-200 shadow-inner">
                    <div>
                        <p class="text-emerald-700 font-black uppercase text-[10px]">Audits Completed</p>
                        <p class="text-lg font-black text-emerald-950">1,420</p>
                    </div>
                    <div>
                        <p class="text-emerald-700 font-black uppercase text-[10px]">System Flags</p>
                        <p class="text-lg font-black text-red-600">42</p>
                    </div>
                </div>
            </div>

            <!-- Permissions Gate Badge Tracker -->
            <div class="bg-white rounded-3xl p-6 card-shadow border-2 border-emerald-200">
                <h3 class="font-black text-xs text-emerald-800 uppercase tracking-wider mb-4 flex items-center justify-between">
                    <span>Module Permissions</span>
                    <i class="fa-solid fa-key text-emerald-500"></i>
                </h3>
                <ul class="space-y-2.5 text-xs font-bold">
                    <li class="flex items-center justify-between text-emerald-900 bg-emerald-50/70 p-3 rounded-xl border-2 border-emerald-200 shadow-2xs hover:scale-[1.02] transition-transform">
                        <span><i class="fa-solid fa-chart-line mr-2 text-emerald-600"></i> Streak Management</span>
                        <span class="text-[9px] uppercase font-black bg-emerald-200 text-emerald-900 px-2 py-0.5 rounded-md">Read/Write</span>
                    </li>
                    <li class="flex items-center justify-between text-emerald-900 bg-emerald-50/70 p-3 rounded-xl border-2 border-emerald-200 shadow-2xs hover:scale-[1.02] transition-transform">
                        <span><i class="fa-solid fa-calculator mr-2 text-emerald-600"></i> Impact Algorithms</span>
                        <span class="text-[9px] uppercase font-black bg-emerald-200 text-emerald-900 px-2 py-0.5 rounded-md">Full Access</span>
                    </li>
                    <li class="flex items-center justify-between text-emerald-900 bg-emerald-50/70 p-3 rounded-xl border-2 border-emerald-200 shadow-2xs hover:scale-[1.02] transition-transform">
                        <span><i class="fa-solid fa-shield-halved mr-2 text-emerald-600"></i> P2P Ledger Audit</span>
                        <span class="text-[9px] uppercase font-black bg-emerald-200 text-emerald-900 px-2 py-0.5 rounded-md">Authorizer</span>
                    </li>
                    <li class="flex items-center justify-between text-amber-900 bg-amber-50/70 p-3 rounded-xl border-2 border-amber-300 shadow-2xs hover:scale-[1.02] transition-transform">
                        <span><i class="fa-solid fa-bolt mr-2 text-amber-600"></i> Flash-Sale Automation</span>
                        <span class="text-[9px] uppercase font-black bg-amber-200 text-amber-950 px-2 py-0.5 rounded-md">Scheduler</span>
                    </li>
                </ul>
            </div>
        </div>

        <!-- Right Side: Profile Settings & Admin Action Audit Log -->
        <div class="lg:col-span-2 space-y-6">
            
            <!-- Information Form Card -->
            <div class="bg-white rounded-3xl p-8 card-shadow border-2 border-emerald-200">
                <h3 class="text-xl font-black border-b-2 border-emerald-100 pb-3 mb-6 flex items-center justify-between text-emerald-950">
                    <span>Account Parameters</span>
                    <i class="fa-solid fa-sliders text-emerald-600 text-base"></i>
                </h3>
                
                <form id="profileForm" class="space-y-4">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-xs font-black uppercase text-emerald-800 mb-1.5">First Name</label>
                            <input type="text" id="firstNameInput" value="Canny" class="w-full px-4 py-3 border-2 border-emerald-200 rounded-xl outline-none bg-emerald-50/30 text-sm font-bold shadow-inner focus:border-emerald-600 focus:bg-white transition">
                        </div>
                        <div>
                            <label class="block text-xs font-black uppercase text-emerald-800 mb-1.5">Last Name</label>
                            <input type="text" id="lastNameInput" value="Le" class="w-full px-4 py-3 border-2 border-emerald-200 rounded-xl outline-none bg-emerald-50/30 text-sm font-bold shadow-inner focus:border-emerald-600 focus:bg-white transition">
                        </div>
                    </div>
                    <div>
                        <label class="block text-xs font-black uppercase text-emerald-800 mb-1.5">Administrative Email</label>
                        <input type="email" id="emailInput" value="Cannyle@mail.edu.my" class="w-full px-4 py-3 border-2 border-emerald-200 rounded-xl outline-none bg-emerald-50/30 text-sm font-bold shadow-inner focus:border-emerald-600 focus:bg-white transition">
                    </div>
                    <div>
                        <label class="block text-xs font-black uppercase text-emerald-800 mb-1.5">Assigned Sustainability Branch</label>
                        <input type="text" value="Campus Infrastructure & Resource Optimization" disabled class="w-full px-4 py-3 bg-emerald-100/50 border-2 border-emerald-200 text-emerald-800 rounded-xl text-sm font-bold cursor-not-allowed">
                    </div>

                    <div class="pt-4 flex justify-end gap-3 border-t-2 border-emerald-100 mt-6">
                        <button type="button" id="discardBtn" class="px-6 py-3 bg-white border-2 border-emerald-300 text-emerald-900 font-black rounded-xl text-xs shadow-sm hover:bg-emerald-50 active:scale-95 transition cursor-pointer">Discard Changes</button>
                        <button type="button" id="saveBtn" class="px-6 py-3 bg-emerald-900 text-white font-black rounded-xl text-xs shadow-md hover:bg-emerald-950 active:scale-95 transition cursor-pointer flex items-center gap-2">
                            <i class="fa-solid fa-check"></i> Save Modifications
                        </button>
                    </div>
                </form>
            </div>

            <!-- Security Audit Trail Log -->
            <div class="bg-white rounded-3xl card-shadow border-2 border-emerald-200 overflow-hidden">
                <div class="p-6 border-b-2 border-emerald-100 bg-emerald-50/50 flex justify-between items-center">
                    <h3 class="font-black text-base text-emerald-950 flex items-center gap-2">
                        <i class="fa-solid fa-clock-rotate-left text-emerald-700"></i> Your System Action History
                    </h3>
                    <span class="text-xs font-black text-emerald-700 uppercase tracking-wider bg-emerald-100 px-3 py-1 rounded-lg border border-emerald-200">Showing Last 3 Dispatches</span>
                </div>
                <div class="divide-y-2 divide-emerald-100">
                    
                    <!-- Action Row 1 -->
                    <div class="p-4 px-6 flex items-center justify-between text-xs hover:bg-emerald-50/30 transition-colors">
                        <div class="flex items-center gap-4">
                            <div class="w-10 h-10 rounded-xl bg-red-100 border-2 border-red-300 text-red-700 flex items-center justify-center font-bold text-sm shadow-2xs">
                                <i class="fa-solid fa-flag"></i>
                            </div>
                            <div>
                                <p class="font-black text-emerald-950 text-sm">Flagged Transaction TXN-88392A as High Risk</p>
                                <p class="text-emerald-700 font-semibold mt-0.5">Eco-Gifting Verification Ledger Module</p>
                            </div>
                        </div>
                        <span class="font-mono text-emerald-800 font-black bg-emerald-50 px-2.5 py-1 rounded-lg border border-emerald-200 shadow-2xs">Today, 14:22</span>
                    </div>

                    <!-- Action Row 2 -->
                    <div class="p-4 px-6 flex items-center justify-between text-xs hover:bg-emerald-50/30 transition-colors">
                        <div class="flex items-center gap-4">
                            <div class="w-10 h-10 rounded-xl bg-emerald-100 border-2 border-emerald-300 text-emerald-800 flex items-center justify-center font-bold text-sm shadow-2xs">
                                <i class="fa-solid fa-calculator"></i>
                            </div>
                            <div>
                                <p class="font-black text-emerald-950 text-sm">Updated Carbon Offset Equation Coefficients</p>
                                <p class="text-emerald-700 font-semibold mt-0.5">Impact Metrics Conversion Engine</p>
                            </div>
                        </div>
                        <span class="font-mono text-emerald-800 font-black bg-emerald-50 px-2.5 py-1 rounded-lg border border-emerald-200 shadow-2xs">Yesterday, 11:15</span>
                    </div>

                    <!-- Action Row 3 -->
                    <div class="p-4 px-6 flex items-center justify-between text-xs hover:bg-emerald-50/30 transition-colors">
                        <div class="flex items-center gap-4">
                            <div class="w-10 h-10 rounded-xl bg-amber-100 border-2 border-amber-300 text-amber-800 flex items-center justify-center font-bold text-sm shadow-2xs">
                                <i class="fa-solid fa-bolt"></i>
                            </div>
                            <div>
                                <p class="font-black text-emerald-950 text-sm">Queued New Flash-Sale Countdown Event: V-101</p>
                                <p class="text-emerald-700 font-semibold mt-0.5">Flash-Sale Automation Module</p>
                            </div>
                        </div>
                        <span class="font-mono text-emerald-800 font-black bg-emerald-50 px-2.5 py-1 rounded-lg border border-emerald-200 shadow-2xs">Oct 28, 2026</span>
                    </div>

                </div>
            </div>

        </div>
    </main>

    <!-- External Script -->
    <script src="reviewerprofile.js"></script>
</body>
</html>
