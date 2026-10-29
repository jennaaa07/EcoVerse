<?php
// PHP processing state for inventory control can be managed here if needed
$system_name = "EcoRewards Inventory Control";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inventory Control - EcoRewards</title>
    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- FontAwesome Icons -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <!-- Custom External CSS -->
    <link href="inventorystyle.css" rel="stylesheet">
</head>
<body class="bg-[#e2ebe4] font-sans min-h-screen p-8 flex flex-col relative text-slate-900 selection:bg-emerald-200">

    <!-- Toast Notification Container -->
    <div id="toast-container" class="fixed top-5 right-5 z-50 flex flex-col gap-3 pointer-events-none"></div>

    <!-- Add Item Modal -->
    <div id="add-modal" class="fixed inset-0 bg-black/60 backdrop-blur-md z-50 hidden flex items-center justify-center p-4">
        <div class="bg-white rounded-3xl card-shadow border-2 border-emerald-200 max-w-md w-full p-8 relative">
            <div class="absolute top-0 left-0 right-0 h-2 bg-gradient-to-r from-emerald-500 via-teal-500 to-green-600 rounded-t-3xl"></div>
            
            <div class="flex justify-between items-center mb-6 border-b-2 border-emerald-100 pb-4 pt-2">
                <div>
                    <span class="text-[10px] font-black uppercase tracking-widest text-emerald-700">Catalog Extension</span>
                    <h3 class="text-xl font-black text-emerald-950">Add New Reward Item</h3>
                </div>
                <button onclick="closeAddModal()" class="w-10 h-10 rounded-xl bg-emerald-50 border-2 border-emerald-200 flex items-center justify-center text-emerald-800 hover:bg-emerald-900 hover:text-white transition cursor-pointer">
                    <i class="fa-solid fa-xmark text-base"></i>
                </button>
            </div>

            <form id="add-item-form" onsubmit="addNewItem(event)" class="space-y-4">
                <div>
                    <label class="block text-xs font-black text-emerald-800 uppercase tracking-wider mb-1.5">Item Name</label>
                    <input type="text" id="new-name" required placeholder="e.g. Stainless Steel Tumbler" class="w-full bg-emerald-50/30 border-2 border-emerald-200 rounded-2xl px-4 py-3 text-sm font-black text-emerald-950 focus:ring-0 focus:border-emerald-600 focus:bg-white outline-none transition shadow-inner">
                </div>
                <div>
                    <label class="block text-xs font-black text-emerald-800 uppercase tracking-wider mb-1.5">Category / Subtitle</label>
                    <input type="text" id="new-cat" required placeholder="e.g. Physical Item / Eco Ware" class="w-full bg-emerald-50/30 border-2 border-emerald-200 rounded-2xl px-4 py-3 text-sm font-black text-emerald-950 focus:ring-0 focus:border-emerald-600 focus:bg-white outline-none transition shadow-inner">
                </div>
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="block text-xs font-black text-emerald-800 uppercase tracking-wider mb-1.5">Cost (Pts)</label>
                        <input type="number" step="1" min="0" id="new-cost" required value="500" class="integer-only w-full bg-emerald-50/30 border-2 border-emerald-200 rounded-2xl px-4 py-3 text-sm font-black text-emerald-950 focus:ring-0 focus:border-emerald-600 focus:bg-white outline-none transition shadow-inner">
                    </div>
                    <div>
                        <label class="block text-xs font-black text-emerald-800 uppercase tracking-wider mb-1.5">Initial Stock</label>
                        <input type="number" step="1" min="0" id="new-stock" required value="50" class="integer-only w-full bg-emerald-50/30 border-2 border-emerald-200 rounded-2xl px-4 py-3 text-sm font-black text-emerald-950 focus:ring-0 focus:border-emerald-600 focus:bg-white outline-none transition shadow-inner">
                    </div>
                </div>
                <div class="flex justify-end gap-3 pt-6 border-t-2 border-emerald-100 mt-6">
                    <button type="button" onclick="closeAddModal()" class="px-5 py-3 bg-emerald-50 hover:bg-emerald-100 text-emerald-900 rounded-2xl font-black text-xs uppercase tracking-wider border-2 border-emerald-200 transition cursor-pointer">Cancel</button>
                    <button type="submit" class="px-6 py-3 bg-emerald-900 hover:bg-emerald-950 text-white rounded-2xl font-black text-xs uppercase tracking-wider shadow-md transition flex items-center gap-2 cursor-pointer active:scale-98">
                        <i class="fa-solid fa-plus text-sm"></i> Add Item
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- Header -->
    <header class="mb-8 flex justify-between items-center bg-white px-8 py-5 rounded-3xl shadow-sm border-2 border-emerald-200">
        <div class="flex items-center gap-4">
            <!-- Back to Dashboard Arrow -->
            <a href="viewerdashboard.php" class="w-12 h-12 rounded-2xl bg-emerald-50 border-2 border-emerald-300 flex items-center justify-center text-emerald-800 hover:bg-emerald-900 hover:text-white hover:border-emerald-900 transition-all duration-300 shadow-xs group" title="Back to Dashboard">
                <i class="fa-solid fa-arrow-left text-lg group-hover:-translate-x-0.5 transition-transform"></i>
            </a>
            <div>
                <p class="text-xs font-black text-emerald-700 uppercase tracking-widest flex items-center gap-1.5">
                    <span class="w-2 h-2 rounded-full bg-emerald-500 animate-pulse"></span> Marketplace Management
                </p>
                <h1 class="text-2xl font-black text-emerald-950 tracking-tight">Reward Inventory Control</h1>
            </div>
        </div>

        <!-- Right Side Cluster: Live Clock & Action Buttons -->
        <div class="flex items-center gap-4">
            <div class="hidden sm:flex items-center gap-2 bg-emerald-50 border-2 border-emerald-300 px-4 py-2.5 rounded-2xl shadow-2xs text-xs font-bold text-emerald-900">
                <i class="fa-solid fa-clock text-emerald-600"></i>
                <span id="live-clock">--:--:--</span>
            </div>
            <div class="flex gap-3">
                <button onclick="openAddModal()" class="bg-emerald-50 hover:bg-emerald-100 text-emerald-900 font-black text-xs uppercase tracking-wider py-3 px-6 rounded-2xl border-2 border-emerald-300 shadow-2xs transition flex items-center gap-2 cursor-pointer active:scale-98">
                    <i class="fa-solid fa-plus text-sm text-emerald-700"></i> Add New Item
                </button>
                <button id="save-btn" onclick="saveInventory()" class="bg-emerald-900 hover:bg-emerald-950 text-white font-black text-xs uppercase tracking-wider py-3 px-6 rounded-2xl shadow-lg transition flex items-center gap-2 cursor-pointer active:scale-98">
                    <i class="fa-solid fa-floppy-disk text-sm"></i> Save All Changes
                </button>
            </div>
        </div>
    </header>

    <main class="bg-white rounded-3xl card-shadow overflow-hidden flex-grow border-2 border-emerald-200 relative">
        <div class="absolute top-0 left-0 right-0 h-2 bg-gradient-to-r from-emerald-500 via-teal-500 to-green-600"></div>

        <table class="min-w-full leading-normal">
            <thead>
                <tr class="bg-emerald-950 text-emerald-100">
                    <th class="px-6 py-5 border-b-2 border-emerald-900 text-left text-xs font-black uppercase tracking-widest">Reward Item</th>
                    <th class="px-6 py-5 border-b-2 border-emerald-900 text-left text-xs font-black uppercase tracking-widest">Cost (Pts)</th>
                    <th class="px-6 py-5 border-b-2 border-emerald-900 text-left text-xs font-black uppercase tracking-widest">Stock Count</th>
                    <th class="px-6 py-5 border-b-2 border-emerald-900 text-left text-xs font-black uppercase tracking-widest">Marketplace Status</th>
                </tr>
            </thead>
            <tbody id="inventory-table-body">
                <!-- Item 1 -->
                <tr class="inventory-row hover:bg-emerald-50/40 transition-colors">
                    <td class="px-6 py-5 border-b-2 border-emerald-100 bg-white text-sm">
                        <div class="flex items-center">
                            <div class="flex-shrink-0 w-12 h-12 bg-emerald-100 text-emerald-800 rounded-2xl border-2 border-emerald-200 flex items-center justify-center shadow-inner">
                                <i class="fa-solid fa-mug-hot text-base"></i>
                            </div>
                            <div class="ml-4">
                                <p class="text-emerald-950 font-black text-base">RM5 Cafeteria Voucher</p>
                                <p class="text-emerald-700 font-bold text-xs uppercase tracking-wide">Digital / Campus Cafe</p>
                            </div>
                        </div>
                    </td>
                    <td class="px-6 py-5 border-b-2 border-emerald-100 bg-white text-sm font-black">
                        <input type="number" step="1" min="0" value="500" class="cost-input integer-only w-32 border-2 border-emerald-200 bg-emerald-50/30 rounded-xl px-3 py-2 font-black text-emerald-950 focus:border-emerald-600 focus:bg-white outline-none transition shadow-inner">
                    </td>
                    <td class="px-6 py-5 border-b-2 border-emerald-100 bg-white text-sm">
                        <input type="number" step="1" min="0" value="145" class="stock-input integer-only w-28 border-2 border-emerald-200 bg-emerald-50/30 rounded-xl px-3 py-2 font-black text-emerald-950 focus:border-emerald-600 focus:bg-white outline-none transition shadow-inner">
                    </td>
                    <td class="px-6 py-5 border-b-2 border-emerald-100 bg-white text-sm status-cell">
                        <span class="inline-flex items-center gap-1.5 bg-emerald-100 text-emerald-800 py-1.5 px-3.5 rounded-full text-xs font-black uppercase tracking-wider border-2 border-emerald-300 shadow-inner">
                            <i class="fa-solid fa-circle-check text-emerald-600"></i> Visible
                        </span>
                    </td>
                </tr>

                <!-- Item 2 -->
                <tr class="inventory-row hover:bg-emerald-50/40 transition-colors">
                    <td class="px-6 py-5 border-b-2 border-emerald-100 bg-white text-sm">
                        <div class="flex items-center">
                            <div class="flex-shrink-0 w-12 h-12 bg-red-50 text-red-700 rounded-2xl border-2 border-red-200 flex items-center justify-center shadow-inner">
                                <i class="fa-solid fa-shirt text-base"></i>
                            </div>
                            <div class="ml-4">
                                <p class="text-emerald-950 font-black text-base">Exclusive Eco-Tote Bag</p>
                                <p class="text-emerald-700 font-bold text-xs uppercase tracking-wide">Physical Item Pickup</p>
                            </div>
                        </div>
                    </td>
                    <td class="px-6 py-5 border-b-2 border-emerald-100 bg-white text-sm font-black">
                        <input type="number" step="1" min="0" value="1200" class="cost-input integer-only w-32 border-2 border-emerald-200 bg-emerald-50/30 rounded-xl px-3 py-2 font-black text-emerald-950 focus:border-emerald-600 focus:bg-white outline-none transition shadow-inner">
                    </td>
                    <td class="px-6 py-5 border-b-2 border-emerald-100 bg-white text-sm">
                        <input type="number" step="1" min="0" value="0" class="stock-input integer-only w-28 border-2 border-red-300 bg-red-50 rounded-xl px-3 py-2 font-black text-red-700 focus:border-red-500 focus:bg-white outline-none transition shadow-inner">
                    </td>
                    <td class="px-6 py-5 border-b-2 border-emerald-100 bg-white text-sm status-cell">
                        <span class="inline-flex items-center gap-1.5 bg-red-100 text-red-800 py-1.5 px-3.5 rounded-full text-xs font-black uppercase tracking-wider border-2 border-red-300 shadow-inner">
                            <i class="fa-solid fa-triangle-exclamation text-red-600"></i> Hidden (Out of Stock)
                        </span>
                    </td>
                </tr>
            </tbody>
        </table>
    </main>

    <!-- External JavaScript File -->
    <script src="inventory.js"></script>
</body>
</html>