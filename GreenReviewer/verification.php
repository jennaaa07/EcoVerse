<?php
// Handle optional backend variables or form processing states here
$audit_mode_active = true;
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Eco-Gifting Verification - Reviewer Dashboard</title>
    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- FontAwesome Icons -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <!-- Custom External CSS -->
    <link href="style.css" rel="stylesheet">
</head>
<body class="bg-gradient-to-br from-emerald-50 via-teal-50/30 to-white font-sans min-h-screen text-gray-800 antialiased selection:bg-emerald-500 selection:text-white relative overflow-x-hidden">

    <!-- Ambient Background Glow Effects -->
    <div class="absolute top-0 left-1/4 w-96 h-96 bg-emerald-300/15 rounded-full blur-3xl pointer-events-none"></div>
    <div class="absolute bottom-10 right-10 w-96 h-96 bg-teal-300/15 rounded-full blur-3xl pointer-events-none"></div>

    <!-- Toast Notification Container -->
    <div id="toast-container" class="fixed top-20 right-6 z-50 flex flex-col gap-3 pointer-events-none"></div>

    <!-- Header -->
    <header class="bg-white/80 backdrop-blur-xl px-8 py-5 flex justify-between items-center border-b border-emerald-100/80 sticky top-0 z-30 shadow-xs">
        <div class="flex items-center gap-4">
            <a href="viewerdashboard.php" class="h-10 w-10 flex items-center justify-center rounded-2xl bg-emerald-50 text-emerald-700 hover:bg-emerald-600 hover:text-white transition-all duration-300 shadow-xs border border-emerald-200/60 group" title="Back to Dashboard">
                <i class="fa-solid fa-arrow-left text-base group-hover:-translate-x-0.5 transition-transform"></i>
            </a>
            <div>
                <p class="text-[11px] font-extrabold text-emerald-600 uppercase tracking-widest flex items-center gap-1.5">
                    <span class="w-2 h-2 rounded-full bg-emerald-500 animate-pulse"></span> Reviewer Dashboard
                </p>
                <h1 class="text-2xl font-extrabold text-gray-900 tracking-tight">Eco-Gifting Verification</h1>
            </div>
        </div>
        <div class="border border-emerald-200/80 text-emerald-800 bg-emerald-50/80 backdrop-blur-md px-4 py-2 rounded-2xl font-bold text-xs flex items-center gap-2 shadow-xs">
            <i class="fa-solid fa-shield-halved text-emerald-600"></i> Audit Mode: <?php echo $audit_mode_active ? 'Active' : 'Inactive'; ?>
        </div>
    </header>

    <!-- Main Content Container -->
    <main class="px-6 py-10 max-w-7xl mx-auto space-y-8 relative z-10">
        
        <!-- Top Metrics Cards -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <div class="bg-white/90 backdrop-blur-md rounded-3xl p-6 shadow-xl shadow-emerald-950/5 border border-emerald-100/80 transition-all hover:shadow-2xl hover:shadow-emerald-950/10">
                <h3 class="text-xs font-extrabold text-gray-400 uppercase tracking-wider mb-2">24h Transfer Volume</h3>
                <p class="text-4xl font-extrabold text-gray-900 tracking-tight">18,920 <span class="text-base font-bold text-emerald-600">pts</span></p>
            </div>
            <div class="bg-white/90 backdrop-blur-md rounded-3xl p-6 shadow-xl shadow-emerald-950/5 border border-emerald-100/80 transition-all hover:shadow-2xl hover:shadow-emerald-950/10">
                <h3 class="text-xs font-extrabold text-gray-400 uppercase tracking-wider mb-2">Pending Audits</h3>
                <p id="pendingCount" class="text-4xl font-extrabold text-amber-600 tracking-tight">31</p>
            </div>
            <div class="bg-gray-900 rounded-3xl p-6 shadow-xl shadow-gray-950/20 border border-gray-800 text-white relative overflow-hidden">
                <div class="absolute -right-6 -bottom-6 w-24 h-24 bg-red-500/10 rounded-full blur-2xl pointer-events-none"></div>
                <h3 class="text-xs font-extrabold text-gray-400 uppercase tracking-wider mb-2">Suspicious Flags</h3>
                <div class="flex items-center gap-3">
                    <i class="fa-solid fa-triangle-exclamation text-red-500 text-2xl"></i>
                    <p id="flagCount" class="text-4xl font-extrabold text-red-500 tracking-tight">5</p>
                </div>
            </div>
        </div>

        <!-- Ledger Table Section -->
        <div class="bg-white/90 backdrop-blur-md rounded-3xl shadow-xl shadow-emerald-950/5 border border-emerald-100/80 overflow-hidden flex flex-col">
            
            <!-- Table Header & Controls -->
            <div class="p-6 border-b border-emerald-100/80 flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 bg-emerald-50/30">
                <h2 class="text-lg font-extrabold text-gray-900">P2P Transfer Ledger</h2>
                <div class="flex flex-wrap gap-3 w-full sm:w-auto">
                    <div class="relative flex-1 sm:flex-initial">
                        <i class="fa-solid fa-magnifying-glass absolute left-3.5 top-3 text-gray-400 text-xs"></i>
                        <input type="text" id="searchInput" placeholder="Search ID or Name..." class="w-full sm:w-64 pl-9 pr-4 py-2.5 rounded-2xl border border-emerald-200/80 bg-white/80 backdrop-blur-sm text-xs font-medium focus:outline-none focus:ring-2 focus:ring-emerald-500 transition">
                    </div>
                    <button onclick="showToast('Filter options: Showing all active ledger transactions.', 'info')" class="bg-white border border-emerald-200/80 px-4 py-2.5 rounded-2xl text-xs font-bold text-gray-700 hover:bg-emerald-50 transition flex items-center gap-2 cursor-pointer shadow-xs">
                        <i class="fa-solid fa-filter text-emerald-600"></i> Filter
                    </button>
                </div>
            </div>

            <!-- Data Table -->
            <div class="overflow-x-auto">
                <table class="w-full text-left text-xs whitespace-nowrap">
                    <thead class="bg-emerald-50/50 text-gray-600 uppercase text-[10px] font-extrabold tracking-wider border-b border-emerald-100">
                        <tr>
                            <th class="px-6 py-4">Transaction ID</th>
                            <th class="px-6 py-4">Sender (Student ID)</th>
                            <th class="px-6 py-4">Receiver (Student ID)</th>
                            <th class="px-6 py-4">Amount</th>
                            <th class="px-6 py-4">Date & Time</th>
                            <th class="px-6 py-4">Status / Risk</th>
                            <th class="px-6 py-4 text-right">Action</th>
                        </tr>
                    </thead>
                    <tbody id="tableBody" class="divide-y divide-gray-100 font-medium">
                        
                        <!-- Row 1: Flagged -->
                        <tr class="hover:bg-emerald-50/30 transition bg-red-50/40" data-id="TXN-88392A">
                            <td class="px-6 py-4 font-mono text-gray-500">TXN-88392A</td>
                            <td class="px-6 py-4 font-bold text-gray-900">P-102934 (Jane Doe)</td>
                            <td class="px-6 py-4 font-bold text-gray-900">P-992102 (John Smith)</td>
                            <td class="px-6 py-4 font-mono font-extrabold text-gray-900">5,000 pts</td>
                            <td class="px-6 py-4 text-gray-500">Today, 14:22</td>
                            <td class="px-6 py-4 status-cell">
                                <span class="bg-red-100 text-red-700 px-2.5 py-1 rounded-xl text-[10px] font-extrabold border border-red-200/80 inline-flex items-center gap-1 shadow-2xs">
                                    <i class="fa-solid fa-flag text-xs"></i> High Risk
                                </span>
                            </td>
                            <td class="px-6 py-4 text-right">
                                <button onclick="openModal('TXN-88392A', 'P-102934 (Jane Doe)', '5,000 pts', 'High Risk')" class="bg-red-600 text-white px-3.5 py-2 rounded-xl text-xs font-bold hover:bg-red-700 shadow-sm transition mr-1 cursor-pointer">Review</button>
                                <button onclick="toggleFreeze(this)" class="bg-white border border-gray-200 text-gray-700 px-3.5 py-2 rounded-xl text-xs font-bold hover:bg-gray-100 shadow-sm transition cursor-pointer">Freeze</button>
                            </td>
                        </tr>

                        <!-- Row 2: Standard -->
                        <tr class="hover:bg-emerald-50/30 transition" data-id="TXN-88391B">
                            <td class="px-6 py-4 font-mono text-gray-500">TXN-88391B</td>
                            <td class="px-6 py-4 font-bold text-gray-900">P-443211 (Alice W.)</td>
                            <td class="px-6 py-4 font-bold text-gray-900">P-112093 (Bob M.)</td>
                            <td class="px-6 py-4 font-mono font-extrabold text-gray-900">150 pts</td>
                            <td class="px-6 py-4 text-gray-500">Today, 13:05</td>
                            <td class="px-6 py-4 status-cell">
                                <span class="bg-emerald-100 text-emerald-800 px-2.5 py-1 rounded-xl text-[10px] font-extrabold border border-emerald-200/80 shadow-2xs">
                                    Verified
                                </span>
                            </td>
                            <td class="px-6 py-4 text-right">
                                <button onclick="showToast('Transaction TXN-88391B: Verified eco-transfer standard exchange between Alice W. and Bob M.', 'info')" class="text-emerald-600 hover:text-emerald-700 font-bold text-xs underline cursor-pointer">Details</button>
                            </td>
                        </tr>

                        <!-- Row 3: Pending -->
                        <tr class="hover:bg-emerald-50/30 transition" data-id="TXN-88390C">
                            <td class="px-6 py-4 font-mono text-gray-500">TXN-88390C</td>
                            <td class="px-6 py-4 font-bold text-gray-900">P-559122 (Charlie D.)</td>
                            <td class="px-6 py-4 font-bold text-gray-900">P-884390 (Eve S.)</td>
                            <td class="px-6 py-4 font-mono font-extrabold text-gray-900">800 pts</td>
                            <td class="px-6 py-4 text-gray-500">Today, 11:45</td>
                            <td class="px-6 py-4 status-cell">
                                <span class="bg-amber-100 text-amber-800 px-2.5 py-1 rounded-xl text-[10px] font-extrabold border border-amber-200/80 shadow-2xs">
                                    Pending Audit
                                </span>
                            </td>
                            <td class="px-6 py-4 text-right">
                                <button onclick="openModal('TXN-88390C', 'P-559122 (Charlie D.)', '800 pts', 'Pending Audit')" class="bg-emerald-600 text-white px-3.5 py-2 rounded-xl text-xs font-bold hover:bg-emerald-700 shadow-sm transition cursor-pointer">Audit</button>
                            </td>
                        </tr>

                        <!-- Row 4: Additional Detailed Entry -->
                        <tr class="hover:bg-emerald-50/30 transition" data-id="TXN-88389D">
                            <td class="px-6 py-4 font-mono text-gray-500">TXN-88389D</td>
                            <td class="px-6 py-4 font-bold text-gray-900">P-332910 (Liam K.)</td>
                            <td class="px-6 py-4 font-bold text-gray-900">P-776122 (Sophia L.)</td>
                            <td class="px-6 py-4 font-mono font-extrabold text-gray-900">1,200 pts</td>
                            <td class="px-6 py-4 text-gray-500">Today, 10:12</td>
                            <td class="px-6 py-4 status-cell">
                                <span class="bg-emerald-100 text-emerald-800 px-2.5 py-1 rounded-xl text-[10px] font-extrabold border border-emerald-200/80 shadow-2xs">
                                    Verified
                                </span>
                            </td>
                            <td class="px-6 py-4 text-right">
                                <button onclick="showToast('Transaction TXN-88389D: Verified bulk recycling reward transfer.', 'info')" class="text-emerald-600 hover:text-emerald-700 font-bold text-xs underline cursor-pointer">Details</button>
                            </td>
                        </tr>

                        <!-- Row 5: Additional Flagged Entry -->
                        <tr class="hover:bg-emerald-50/30 transition bg-red-50/40" data-id="TXN-88388E">
                            <td class="px-6 py-4 font-mono text-gray-500">TXN-88388E</td>
                            <td class="px-6 py-4 font-bold text-gray-900">P-901234 (Marcus T.)</td>
                            <td class="px-6 py-4 font-bold text-gray-900">P-901235 (Marcus Alt)</td>
                            <td class="px-6 py-4 font-mono font-extrabold text-gray-900">3,500 pts</td>
                            <td class="px-6 py-4 text-gray-500">Yesterday, 22:15</td>
                            <td class="px-6 py-4 status-cell">
                                <span class="bg-red-100 text-red-700 px-2.5 py-1 rounded-xl text-[10px] font-extrabold border border-red-200/80 inline-flex items-center gap-1 shadow-2xs">
                                    <i class="fa-solid fa-flag text-xs"></i> High Risk
                                </span>
                            </td>
                            <td class="px-6 py-4 text-right">
                                <button onclick="openModal('TXN-88388E', 'P-901234 (Marcus T.)', '3,500 pts', 'High Risk')" class="bg-red-600 text-white px-3.5 py-2 rounded-xl text-xs font-bold hover:bg-red-700 shadow-sm transition mr-1 cursor-pointer">Review</button>
                                <button onclick="toggleFreeze(this)" class="bg-white border border-gray-200 text-gray-700 px-3.5 py-2 rounded-xl text-xs font-bold hover:bg-gray-100 shadow-sm transition cursor-pointer">Freeze</button>
                            </td>
                        </tr>

                    </tbody>
                </table>
            </div>
            
            <!-- Pagination -->
            <div class="p-4 border-t border-emerald-100/80 flex justify-between items-center text-xs text-gray-500 bg-emerald-50/20">
                <span class="font-medium">Showing 1 to 5 of 1,245 entries</span>
                <div class="flex gap-1.5 font-medium">
                    <button class="px-3 py-1.5 border border-gray-200 rounded-xl bg-white hover:bg-gray-50 disabled:opacity-50 transition cursor-pointer" disabled>Prev</button>
                    <button class="px-3 py-1.5 border border-emerald-500 rounded-xl bg-emerald-50 text-emerald-800 font-bold">1</button>
                    <button onclick="showToast('Navigating to page 2...', 'info')" class="px-3 py-1.5 border border-gray-200 rounded-xl bg-white hover:bg-gray-50 transition cursor-pointer">2</button>
                    <button onclick="showToast('Navigating to next page...', 'info')" class="px-3 py-1.5 border border-gray-200 rounded-xl bg-white hover:bg-gray-50 transition cursor-pointer">Next</button>
                </div>
            </div>

        </div>
    </main>

    <!-- Interactive Audit / Review Modal -->
    <div id="auditModal" class="hidden fixed inset-0 bg-gray-900/40 backdrop-blur-sm z-50 flex items-center justify-center p-4 opacity-0 transition-opacity duration-300">
        <div class="bg-white rounded-3xl shadow-2xl w-full max-w-lg overflow-hidden border border-emerald-100 transform scale-95 transition-transform duration-300" id="auditModalContent">
            <div class="bg-emerald-900 px-6 py-5 flex justify-between items-center text-white">
                <h3 class="font-extrabold text-base flex items-center gap-2">
                    <i class="fa-solid fa-file-shield text-emerald-400"></i> Audit Transaction Details
                </h3>
                <button onclick="closeModal()" class="w-8 h-8 rounded-full bg-emerald-800/60 text-emerald-200 hover:bg-emerald-800 flex items-center justify-center transition cursor-pointer">
                    <i class="fa-solid fa-xmark"></i>
                </button>
            </div>
            <div class="p-6 space-y-4">
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="block text-[10px] font-extrabold text-gray-400 uppercase tracking-wider mb-1">Transaction ID</label>
                        <p id="modalTxId" class="text-xs font-mono font-bold text-gray-900 bg-gray-50 px-3 py-2 rounded-xl border border-gray-100"></p>
                    </div>
                    <div>
                        <label class="block text-[10px] font-extrabold text-gray-400 uppercase tracking-wider mb-1">Sender Eco-Rating</label>
                        <p class="text-xs font-bold text-emerald-700 bg-emerald-50 px-3 py-2 rounded-xl border border-emerald-100">Level 4 (Sustainable)</p>
                    </div>
                </div>
                <div>
                    <label class="block text-[10px] font-extrabold text-gray-400 uppercase tracking-wider mb-1">Transfer Overview</label>
                    <p id="modalTxDetails" class="text-xs font-bold text-gray-800 bg-gray-50 px-3 py-2 rounded-xl border border-gray-100"></p>
                </div>
                <div class="bg-amber-50 border border-amber-200 rounded-2xl p-3 flex items-start gap-3">
                    <i class="fa-solid fa-circle-exclamation text-amber-600 text-sm mt-0.5"></i>
                    <div class="text-[11px] text-amber-900">
                        <span class="font-bold">Automated Heuristic Flag:</span> High volume movement detected within a 10-minute window between related accounts.
                    </div>
                </div>
                <div>
                    <label class="block text-[10px] font-extrabold text-gray-700 uppercase tracking-wider mb-1.5">Update Status Action</label>
                    <select id="modalStatusSelect" class="w-full border border-emerald-200/80 rounded-2xl p-3 text-xs bg-emerald-50/50 font-medium focus:ring-2 focus:ring-emerald-500 focus:outline-none transition">
                        <option value="Verified">Approve & Verify</option>
                        <option value="High Risk">Flag as High Risk</option>
                        <option value="Pending Audit">Keep Pending</option>
                    </select>
                </div>
                <div>
                    <label class="block text-[10px] font-extrabold text-gray-700 uppercase tracking-wider mb-1.5">Review Notes & Remarks</label>
                    <textarea id="modalNotes" rows="2" placeholder="Enter auditor remarks..." class="w-full border border-emerald-200/80 rounded-2xl p-3 text-xs focus:ring-2 focus:ring-emerald-500 focus:outline-none transition resize-none bg-emerald-50/50"></textarea>
                </div>
            </div>
            <div class="bg-gray-50 px-6 py-4 border-t border-gray-100 flex justify-end gap-3">
                <button onclick="closeModal()" class="px-4 py-2.5 rounded-xl text-xs font-bold text-gray-600 hover:bg-gray-200/60 transition cursor-pointer">Cancel</button>
                <button onclick="saveAudit()" class="px-5 py-2.5 rounded-xl text-xs font-bold bg-emerald-600 text-white hover:bg-emerald-700 shadow-lg shadow-emerald-600/20 transition cursor-pointer">Confirm Decision</button>
            </div>
        </div>
    </div>

    <!-- External JavaScript Link -->
    <script src="verification.js"></script>
</body>
</html>