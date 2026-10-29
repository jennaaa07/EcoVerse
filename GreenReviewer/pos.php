<?php
// PHP session or initialization parameters can be handled here
$system_name = "Eco Hub POS Terminal";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quick Points POS - Green Reviewer</title>
    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- FontAwesome Icons -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <!-- Custom External CSS -->
    <link href="posstyle.css" rel="stylesheet">
</head>
<body class="bg-[#e2ebe4] font-sans min-h-screen flex flex-col text-slate-900 selection:bg-emerald-800 selection:text-white">

    <!-- Toast Notification Container -->
    <div id="toast-container" class="fixed top-5 right-5 z-50 flex flex-col gap-3 pointer-events-none"></div>

    <!-- Sticky Header Bar -->
    <header class="bg-white px-10 py-6 flex justify-between items-center shadow-sm sticky top-0 z-20 border-b-2 border-emerald-200">
        <div class="flex items-center gap-4">
            <a href="viewerdashboard.php" class="w-10 h-10 rounded-xl bg-emerald-50 border border-emerald-300 flex items-center justify-center text-emerald-800 hover:bg-emerald-900 hover:text-white hover:border-emerald-900 transition-all duration-300 shadow-xs group" title="Back to Dashboard">
                <i class="fa-solid fa-arrow-left text-base group-hover:-translate-x-0.5 transition-transform"></i>
            </a>
            <div>
                <p class="text-xs font-black text-emerald-700 uppercase tracking-widest flex items-center gap-1.5">
                    <span class="w-2 h-2 rounded-full bg-emerald-500 animate-pulse"></span> Terminal Active
                </p>
                <h1 class="text-2xl font-black tracking-tight text-emerald-950">Quick Points POS</h1>
            </div>
        </div>
        <div class="hidden sm:flex items-center gap-2 bg-emerald-50 border-2 border-emerald-300 text-emerald-900 px-4 py-2.5 rounded-2xl font-bold text-xs shadow-2xs">
            <i class="fa-solid fa-cash-register text-emerald-600"></i> Cashier Station: #04
        </div>
    </header>

    <!-- Main Content Area -->
    <main class="flex-grow flex items-center justify-center p-6">
        
        <!-- POS Terminal Card -->
        <div class="bg-white rounded-3xl card-shadow w-full max-w-lg p-8 border-2 border-emerald-200 relative overflow-hidden">
            
            <!-- Decorative Accent Bar -->
            <div class="absolute top-0 left-0 right-0 h-2 bg-gradient-to-r from-emerald-500 via-teal-500 to-green-600"></div>

            <div class="text-center mb-8 pt-2">
                <div class="w-16 h-16 bg-emerald-100 border-2 border-emerald-300 text-emerald-800 rounded-2xl mx-auto mb-3 flex items-center justify-center text-2xl shadow-inner">
                    <i class="fa-solid fa-bolt"></i>
                </div>
                <h2 class="text-2xl font-black text-emerald-950">Quick Points Terminal</h2>
                <p class="text-xs font-bold text-emerald-700 mt-1 uppercase tracking-wide">Issue instant eco-rewards at checkout</p>
            </div>

            <!-- POS Form -->
            <form id="posForm">
                
                <!-- Input 1: Participant ID -->
                <div class="mb-5">
                    <label class="block text-xs font-black uppercase text-emerald-800 mb-2" for="participant_id">
                        Participant ID (Registered or Guest)
                    </label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 flex items-center pl-4 pointer-events-none text-emerald-600">
                            <i class="fa-solid fa-id-card"></i>
                        </div>
                        <input class="w-full px-4 py-3.5 pl-11 border-2 border-emerald-200 rounded-xl outline-none bg-emerald-50/30 text-sm font-bold shadow-inner focus:border-emerald-600 focus:bg-white transition" id="participant_id" name="participant_id" type="text" placeholder="e.g. PT001" required>
                    </div>
                </div>

                <!-- Input 2: Action Dropdown -->
                <div class="mb-8">
                    <label class="block text-xs font-black uppercase text-emerald-800 mb-2" for="eco_action">
                        Select Eco-Action
                    </label>
                    <div class="relative">
                        <select class="w-full px-4 py-3.5 pr-10 border-2 border-emerald-200 rounded-xl outline-none bg-emerald-50/30 text-sm font-bold shadow-inner focus:border-emerald-600 focus:bg-white transition appearance-none cursor-pointer" id="eco_action" name="points" required>
                            <option value="" disabled selected>-- Choose Action --</option>
                            <option value="50">Brought Own Reusable Cup (+50 Pts)</option>
                            <option value="75">Purchased Upcycled Merchandise (+75 Pts)</option>
                            <option value="10">Opted for Digital Receipt (+10 Pts)</option>
                            <option value="100">Attended Sustainability Seminar (+100 Pts)</option>
                        </select>
                        <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-4 text-emerald-700">
                            <i class="fa-solid fa-chevron-down text-xs"></i>
                        </div>
                    </div>
                </div>

                <!-- Submit Button -->
                <button class="w-full bg-emerald-900 hover:bg-emerald-950 text-white font-black py-4 px-6 rounded-xl shadow-md active:scale-98 transition duration-200 text-sm flex items-center justify-center gap-2 cursor-pointer" type="submit">
                    <i class="fa-solid fa-check-circle text-base"></i> Issue Points Now
                </button>
            </form>
            
        </div>
    </main>

    <!-- External Script -->
    <script src="pos.js"></script>
</body>
</html>
