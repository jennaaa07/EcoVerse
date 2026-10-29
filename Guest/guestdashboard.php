<?php
// index.php
$pageTitle = "Guest Dashboard - Eco Hub";
$initialPoints = 150;
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
<body class="bg-gray-50 font-sans min-h-screen text-gray-800 pb-24 relative selection:bg-green-100" data-initial-points="<?php echo $initialPoints; ?>">

    <!-- Top Navigation (Guest Mode) -->
    <header class="bg-white shadow-sm px-6 py-4 flex justify-between items-center sticky top-0 z-20">
        <div class="flex items-center gap-2">
            <i class="fa-solid fa-leaf text-green-600 text-2xl"></i>
            <h1 class="font-extrabold text-lg text-gray-800">Eco Hub</h1>
        </div>
        <button onclick="openModal('loginModal')" class="text-sm font-bold text-green-600 border border-green-600 px-4 py-1.5 rounded-full hover:bg-green-50 transition cursor-pointer">
            Log In
        </button>
    </header>

    <main class="p-4 max-w-md mx-auto space-y-6">
        
        <!-- Welcome / CTA Banner -->
        <div class="bg-gradient-to-br from-green-600 to-green-800 rounded-2xl p-6 text-white shadow-lg relative overflow-hidden text-center">
            <i class="fa-solid fa-seedling absolute -bottom-4 -left-4 text-8xl text-white opacity-10"></i>
            <h2 class="text-2xl font-extrabold mb-2">Make an Impact.</h2>
            <p class="text-green-100 text-sm mb-6">Join the campus community to track your carbon footprint, earn green points, and redeem exclusive rewards.</p>
            <button onclick="openModal('registerModal')" class="bg-white text-green-700 font-bold w-full py-3 rounded-xl shadow-md flex justify-center items-center gap-2 hover:bg-gray-50 transition cursor-pointer active:scale-98">
                <i class="fa-solid fa-user-plus"></i> Create an Account
            </button>
        </div>

        <!-- Public Tools Grid -->
        <div>
            <h3 class="text-lg font-bold mb-3 px-1 text-gray-800">Public Tools</h3>
            <div class="grid grid-cols-2 gap-3">
                
                <!-- Waste Segregation Guide (Public) -->
                <button onclick="openModal('guideModal')" class="bg-white p-4 rounded-xl shadow-sm border border-gray-100 flex flex-col items-start gap-3 hover:shadow-md transition text-left cursor-pointer group">
                    <div class="w-10 h-10 bg-blue-50 text-blue-600 rounded-lg flex items-center justify-center text-lg group-hover:scale-105 transition">
                        <i class="fa-solid fa-book"></i>
                    </div>
                    <div>
                        <h4 class="font-bold text-sm text-gray-800">Waste Guide</h4>
                        <p class="text-[10px] text-gray-500 mt-0.5">Learn how to sort waste</p>
                    </div>
                </button>

                <!-- Recycling Centre Locator (Public) -->
                <button onclick="openModal('locatorModal')" class="bg-white p-4 rounded-xl shadow-sm border border-gray-100 flex flex-col items-start gap-3 hover:shadow-md transition text-left cursor-pointer group">
                    <div class="w-10 h-10 bg-orange-50 text-orange-600 rounded-lg flex items-center justify-center text-lg group-hover:scale-105 transition">
                        <i class="fa-solid fa-map-location-dot"></i>
                    </div>
                    <div>
                        <h4 class="font-bold text-sm text-gray-800">Centre Locator</h4>
                        <p class="text-[10px] text-gray-500 mt-0.5">Find nearby eco-bins</p>
                    </div>
                </button>

            </div>
        </div>

        <!-- Interactive Features Section (Includes Instant Scanner) -->
        <div>
            <h3 class="text-lg font-bold mb-3 px-1 text-gray-800">Guest Features</h3>
            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden divide-y divide-gray-50">
                
                <!-- Instant Scanner Trigger -->
                <div onclick="openModal('scannerModal')" class="p-4 flex items-center gap-4 hover:bg-slate-50 transition cursor-pointer group">
                    <div class="w-10 h-10 bg-slate-900 text-amber-400 rounded-full flex items-center justify-center shadow-md group-hover:scale-105 transition">
                        <i class="fa-solid fa-camera"></i>
                    </div>
                    <div class="flex-grow">
                        <div class="flex items-center gap-2">
                            <h4 class="font-bold text-sm text-gray-800">Instant AI Scanner</h4>
                            <span class="text-[9px] bg-amber-100 text-amber-800 font-extrabold px-1.5 py-0.5 rounded">Active Guest Tool</span>
                        </div>
                        <p class="text-xs text-gray-500">Scan drop-offs & stack unclaimed points.</p>
                    </div>
                    <i class="fa-solid fa-chevron-right text-gray-300 text-sm"></i>
                </div>
                
                <div onclick="openModal('lockedModal')" class="p-4 flex items-center gap-4 opacity-75 hover:opacity-100 hover:bg-gray-50 transition cursor-pointer">
                    <div class="w-10 h-10 bg-purple-50 text-purple-600 rounded-full flex items-center justify-center">
                        <i class="fa-solid fa-store"></i>
                    </div>
                    <div class="flex-grow">
                        <h4 class="font-bold text-sm text-gray-800">Reward Store</h4>
                        <p class="text-xs text-gray-500">Redeem vouchers & gifts.</p>
                    </div>
                    <i class="fa-solid fa-lock text-gray-400"></i>
                </div>

                <div onclick="openModal('lockedModal')" class="p-4 flex items-center gap-4 opacity-75 hover:opacity-100 hover:bg-gray-50 transition cursor-pointer">
                    <div class="w-10 h-10 bg-teal-50 text-teal-600 rounded-full flex items-center justify-center">
                        <i class="fa-solid fa-users"></i>
                    </div>
                    <div class="flex-grow">
                        <h4 class="font-bold text-sm text-gray-800">Community Campaigns</h4>
                        <p class="text-xs text-gray-500">Join events and challenges.</p>
                    </div>
                    <i class="fa-solid fa-lock text-gray-400"></i>
                </div>

            </div>
        </div>

        <!-- Global Milestone Preview (Read-Only) -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-5 mt-6">
            <div class="flex justify-between items-center mb-3">
                <h3 class="font-bold text-sm text-gray-800">Campus Global Goal</h3>
                <span class="text-[10px] font-bold text-green-600 bg-green-50 px-2 py-1 rounded">Live</span>
            </div>
            <h4 class="font-extrabold text-lg mb-1">Library Solar Array</h4>
            <p class="text-xs text-gray-500 mb-4">Students are pooling points to fund solar panels!</p>
            
            <div class="w-full bg-gray-200 rounded-full h-3 mb-2 overflow-hidden">
                <div class="bg-green-500 h-3 rounded-full transition-all duration-1000" style="width: 75%"></div>
            </div>
            <p class="text-xs font-bold text-gray-600 text-right">75% Funded</p>
        </div>

    </main>

    <!-- Mobile Bottom Navigation (Guest Version) -->
    <nav class="fixed bottom-0 w-full bg-white border-t border-gray-200 flex justify-around p-2 pb-6 max-w-md left-1/2 transform -translate-x-1/2 z-30 shadow-lg">
        <button onclick="window.scrollTo({top: 0, behavior: 'smooth'})" class="flex flex-col items-center justify-center w-16 text-green-600 cursor-pointer">
            <i class="fa-solid fa-house text-xl mb-1"></i>
            <span class="text-[10px] font-bold">Home</span>
        </button>
        <button onclick="openModal('locatorModal')" class="flex flex-col items-center justify-center w-16 text-gray-400 hover:text-green-600 transition cursor-pointer">
            <i class="fa-solid fa-map-location-dot text-xl mb-1"></i>
            <span class="text-[10px] font-bold">Locate</span>
        </button>
        <button onclick="openModal('scannerModal')" class="flex flex-col items-center justify-center w-16 text-gray-400 hover:text-amber-500 transition cursor-pointer">
            <i class="fa-solid fa-camera text-xl mb-1"></i>
            <span class="text-[10px] font-bold">Scanner</span>
        </button>
        <button onclick="openModal('loginModal')" class="flex flex-col items-center justify-center w-16 text-gray-400 hover:text-green-600 transition cursor-pointer">
            <i class="fa-solid fa-arrow-right-to-bracket text-xl mb-1"></i>
            <span class="text-[10px] font-bold">Log In</span>
        </button>
    </nav>

    <!-- MODAL SYSTEM -->

    <!-- Instant Scanner Modal View -->
    <div id="scannerModal" class="fixed inset-0 bg-black/80 backdrop-blur-sm z-50 hidden flex flex-col items-center justify-start overflow-y-auto">
        <div class="w-full max-w-md bg-slate-900 min-h-screen text-slate-100 pb-12 relative flex flex-col shadow-2xl">
            
            <!-- Close Modal Bar -->
            <div class="bg-slate-800 px-4 py-2 flex justify-end items-center border-b border-slate-700">
                <button onclick="closeModal('scannerModal')" class="text-slate-400 hover:text-white text-xs font-bold uppercase tracking-wider flex items-center gap-1.5 cursor-pointer py-1 px-2.5 rounded bg-slate-700/50">
                    <i class="fa-solid fa-xmark text-sm"></i> Close Scanner
                </button>
            </div>

            <!-- Guest Session Lifecycle Alert Banner -->
            <div class="bg-gradient-to-r from-amber-500 to-orange-600 text-slate-900 px-4 py-3 text-xs font-bold shadow-md flex justify-between items-center">
                <span class="flex items-center gap-1.5 text-black">
                    <i class="fa-solid fa-clock animate-pulse text-sm"></i> 
                    Guest Session Window: <span id="sessionTimer" class="font-mono bg-black/10 px-1 rounded ml-1">59:42 remaining</span>
                </span>
                <button onclick="openModal('registerModal'); closeModal('scannerModal');" class="bg-slate-900 text-white px-3 py-1 rounded-md text-[10px] font-extrabold uppercase tracking-wider hover:bg-black transition shadow-sm cursor-pointer">
                    Save Progress
                </button>
            </div>

            <!-- Live Session Counter Header -->
            <header class="p-4 flex justify-between items-center bg-slate-800/60 backdrop-blur border-b border-slate-700/50">
                <div>
                    <span class="text-[10px] uppercase font-bold tracking-wider text-slate-400">Current Session Ledger</span>
                    <h1 id="pointLedgerDisplay" class="text-lg font-black text-amber-400">+<?php echo $initialPoints; ?> Unclaimed Pts</h1>
                </div>
                <div class="text-right">
                    <span class="text-xs font-bold text-slate-300 block bg-slate-700 px-2.5 py-1 rounded-full border border-slate-600">Guest Mode</span>
                </div>
            </header>

            <main class="p-4 space-y-4 flex-grow">
                
                <!-- On-Site Action Camera Viewfinder Component -->
                <div class="bg-slate-800 rounded-2xl border border-slate-700 p-4 shadow-xl space-y-4">
                    <div>
                        <h2 class="font-bold text-base text-white">Instant Drop-off Verification</h2>
                        <p class="text-xs text-slate-400">Snap a quick photo of your deposit item against the bin open-gate</p>
                    </div>

                    <!-- Simulated Live Camera View Finder -->
                    <div class="relative aspect-square w-full rounded-xl bg-black border border-slate-600 flex flex-col items-center justify-center overflow-hidden group">
                        <!-- Camera Crosshair Grid Lines -->
                        <div class="absolute inset-0 border border-white/5 pointer-events-none grid grid-cols-3 grid-rows-3">
                            <div class="border-r border-b border-white/10"></div><div class="border-r border-b border-white/10"></div><div class="border-b border-white/10"></div>
                            <div class="border-r border-b border-white/10"></div><div class="border-r border-b border-white/10"></div><div class="border-b border-white/10"></div>
                        </div>

                        <!-- QR Tag Detected Overlay Notification -->
                        <div class="absolute top-4 bg-green-500 text-black font-extrabold text-xs px-3 py-1.5 rounded-lg shadow-lg flex items-center gap-2">
                            <i class="fa-solid fa-circle-check animate-bounce"></i> Connected: Smart Bin #04 (South Campus)
                        </div>

                        <!-- Central Target Reticle -->
                        <div class="w-20 h-20 border-2 border-dashed border-slate-400/50 rounded-full flex items-center justify-center opacity-60">
                            <i class="fa-solid fa-camera text-2xl text-slate-400"></i>
                        </div>

                        <p class="absolute bottom-4 text-[11px] text-slate-400 tracking-wide font-medium bg-black/60 px-3 py-1 rounded-full">Proximity verified via hardware tags</p>
                    </div>

                    <!-- Trigger Submission Action -->
                    <button onclick="handleDepositClaim()" class="w-full bg-green-500 hover:bg-green-600 text-slate-900 font-black py-4 rounded-xl shadow-lg shadow-green-500/10 transition text-sm flex items-center justify-center gap-2 cursor-pointer">
                        <i class="fa-solid fa-circle-check text-sm"></i> Log Deposit & Claim +50 Points
                    </button>
                </div>

                <!-- Anti-Spam Rate Limiter Security Notice Footer -->
                <div class="bg-slate-800/40 border border-slate-700/60 rounded-xl p-3 flex gap-3 items-start">
                    <i class="fa-solid fa-shield-halved text-amber-500 text-base mt-0.5"></i>
                    <div>
                        <h4 class="text-xs font-bold text-slate-300">Guest Throttling Protection Policy</h4>
                        <p class="text-[11px] text-slate-500 leading-relaxed mt-0.5">Anonymous guest uploads are capped at 2 per hour based on system fingerprinting thresholds to mitigate script attacks.</p>
                    </div>
                </div>

            </main>
        </div>
    </div>

    <!-- Login Modal -->
    <div id="loginModal" class="fixed inset-0 bg-black/60 backdrop-blur-xs z-50 hidden flex items-center justify-center p-4">
        <div class="bg-white rounded-2xl max-w-sm w-full p-6 shadow-2xl relative animate-in fade-in zoom-in-95 duration-200">
            <div class="flex justify-between items-center mb-4">
                <h3 class="text-lg font-extrabold text-gray-900">Welcome Back</h3>
                <button onclick="closeModal('loginModal')" class="text-gray-400 hover:text-gray-600 cursor-pointer p-1"><i class="fa-solid fa-xmark text-lg"></i></button>
            </div>
            <form onsubmit="handleAuth(event, 'Logging in...')" class="space-y-4">
                <div>
                    <label class="block text-xs font-bold text-gray-600 uppercase mb-1">Campus Email</label>
                    <input type="email" required placeholder="student@university.edu" class="w-full border border-gray-200 rounded-xl px-3.5 py-2.5 text-sm focus:ring-2 focus:ring-green-500 outline-none">
                </div>
                <div>
                    <label class="block text-xs font-bold text-gray-600 uppercase mb-1">Password</label>
                    <input type="password" required placeholder="••••••••" class="w-full border border-gray-200 rounded-xl px-3.5 py-2.5 text-sm focus:ring-2 focus:ring-green-500 outline-none">
                </div>
                <button type="submit" class="w-full bg-green-600 hover:bg-green-700 text-white font-bold py-3 rounded-xl shadow-md transition cursor-pointer">Sign In</button>
            </form>
            <p class="text-xs text-center text-gray-500 mt-4">Don't have an account? <button onclick="switchModal('loginModal', 'registerModal')" class="text-green-600 font-bold hover:underline cursor-pointer">Sign Up</button></p>
        </div>
    </div>

    <!-- Register Modal -->
    <div id="registerModal" class="fixed inset-0 bg-black/60 backdrop-blur-xs z-50 hidden flex items-center justify-center p-4">
        <div class="bg-white rounded-2xl max-w-sm w-full p-6 shadow-2xl relative animate-in fade-in zoom-in-95 duration-200">
            <div class="flex justify-between items-center mb-4">
                <h3 class="text-lg font-extrabold text-gray-900">Create Eco Account</h3>
                <button onclick="closeModal('registerModal')" class="text-gray-400 hover:text-gray-600 cursor-pointer p-1"><i class="fa-solid fa-xmark text-lg"></i></button>
            </div>
            <form onsubmit="handleAuth(event, 'Account created successfully!')" class="space-y-3">
                <div>
                    <label class="block text-xs font-bold text-gray-600 uppercase mb-1">Full Name</label>
                    <input type="text" required placeholder="Jane Doe" class="w-full border border-gray-200 rounded-xl px-3.5 py-2 text-sm focus:ring-2 focus:ring-green-500 outline-none">
                </div>
                <div>
                    <label class="block text-xs font-bold text-gray-600 uppercase mb-1">Campus Email</label>
                    <input type="email" required placeholder="student@university.edu" class="w-full border border-gray-200 rounded-xl px-3.5 py-2 text-sm focus:ring-2 focus:ring-green-500 outline-none">
                </div>
                <div>
                    <label class="block text-xs font-bold text-gray-600 uppercase mb-1">Password</label>
                    <input type="password" required placeholder="••••••••" class="w-full border border-gray-200 rounded-xl px-3.5 py-2 text-sm focus:ring-2 focus:ring-green-500 outline-none">
                </div>
                <button type="submit" class="w-full bg-green-600 hover:bg-green-700 text-white font-bold py-3 rounded-xl shadow-md transition cursor-pointer mt-2">Register & Start Earning</button>
            </form>
            <p class="text-xs text-center text-gray-500 mt-4">Already registered? <button onclick="switchModal('registerModal', 'loginModal')" class="text-green-600 font-bold hover:underline cursor-pointer">Log In</button></p>
        </div>
    </div>

    <!-- Waste Guide Modal -->
    <div id="guideModal" class="fixed inset-0 bg-black/60 backdrop-blur-xs z-50 hidden flex items-center justify-center p-4">
        <div class="bg-white rounded-2xl max-w-md w-full p-6 shadow-2xl relative max-h-[85vh] overflow-y-auto">
            <div class="flex justify-between items-center mb-4 border-b pb-3">
                <div class="flex items-center gap-2">
                    <i class="fa-solid fa-book text-blue-600 text-lg"></i>
                    <h3 class="text-base font-extrabold text-gray-900">Waste Segregation Guide</h3>
                </div>
                <button onclick="closeModal('guideModal')" class="text-gray-400 hover:text-gray-600 cursor-pointer p-1"><i class="fa-solid fa-xmark text-lg"></i></button>
            </div>
            <div class="space-y-3 text-xs text-gray-600">
                <div class="p-3 bg-blue-50 rounded-xl border border-blue-100">
                    <h4 class="font-bold text-blue-900 mb-1">Blue Bin: Paper & Cardboard</h4>
                    <p>Clean newspapers, cardboard boxes, office paper, and brochures.</p>
                </div>
                <div class="p-3 bg-amber-50 rounded-xl border border-amber-100">
                    <h4 class="font-bold text-amber-900 mb-1">Orange Bin: Plastics & Cans</h4>
                    <p>PET bottles, aluminum beverage cans, clean plastic containers.</p>
                </div>
                <div class="p-3 bg-green-50 rounded-xl border border-green-100">
                    <h4 class="font-bold text-green-900 mb-1">Green Bin: Organic Waste</h4>
                    <p>Food scraps, fruit peels, coffee grounds, and biodegradable plates.</p>
                </div>
            </div>
            <button onclick="closeModal('guideModal')" class="w-full mt-5 bg-gray-100 hover:bg-gray-200 text-gray-800 font-bold py-2.5 rounded-xl transition cursor-pointer">Got It</button>
        </div>
    </div>

    <!-- Centre Locator Modal -->
    <div id="locatorModal" class="fixed inset-0 bg-black/60 backdrop-blur-xs z-50 hidden flex items-center justify-center p-4">
        <div class="bg-white rounded-2xl max-w-md w-full p-6 shadow-2xl relative max-h-[85vh] overflow-y-auto">
            <div class="flex justify-between items-center mb-4 border-b pb-3">
                <div class="flex items-center gap-2">
                    <i class="fa-solid fa-map-location-dot text-orange-600 text-lg"></i>
                    <h3 class="text-base font-extrabold text-gray-900">Campus Eco-Bins & Centres</h3>
                </div>
                <button onclick="closeModal('locatorModal')" class="text-gray-400 hover:text-gray-600 cursor-pointer p-1"><i class="fa-solid fa-xmark text-lg"></i></button>
            </div>
            <div class="space-y-3 text-xs text-gray-600">
                <div class="p-3 bg-gray-50 rounded-xl border border-gray-100 flex justify-between items-center">
                    <div>
                        <h4 class="font-bold text-gray-900 text-sm">Central Library Bin Hub</h4>
                        <p class="text-gray-500">Ground floor near main entrance</p>
                    </div>
                    <span class="text-[10px] bg-green-100 text-green-700 font-bold px-2 py-1 rounded-full">Open 24/7</span>
                </div>
                <div class="p-3 bg-gray-50 rounded-xl border border-gray-100 flex justify-between items-center">
                    <div>
                        <h4 class="font-bold text-gray-900 text-sm">Science Complex Drop-off</h4>
                        <p class="text-gray-500">Block B loading bay</p>
                    </div>
                    <span class="text-[10px] bg-green-100 text-green-700 font-bold px-2 py-1 rounded-full">Open 8 AM - 8 PM</span>
                </div>
                <div class="p-3 bg-gray-50 rounded-xl border border-gray-100 flex justify-between items-center">
                    <div>
                        <h4 class="font-bold text-gray-900 text-sm">Student Union Recycler</h4>
                        <p class="text-gray-500">Beside cafeteria exit</p>
                    </div>
                    <span class="text-[10px] bg-green-100 text-green-700 font-bold px-2 py-1 rounded-full">Open 24/7</span>
                </div>
            </div>
            <button onclick="closeModal('locatorModal')" class="w-full mt-5 bg-gray-100 hover:bg-gray-200 text-gray-800 font-bold py-2.5 rounded-xl transition cursor-pointer">Close</button>
        </div>
    </div>

    <!-- Locked Feature Notice Modal -->
    <div id="lockedModal" class="fixed inset-0 bg-black/60 backdrop-blur-xs z-50 hidden flex items-center justify-center p-4">
        <div class="bg-white rounded-2xl max-w-sm w-full p-6 shadow-2xl relative text-center">
            <div class="w-12 h-12 bg-amber-50 text-amber-600 rounded-full flex items-center justify-center mx-auto mb-3 text-xl">
                <i class="fa-solid fa-lock"></i>
            </div>
            <h3 class="text-lg font-extrabold text-gray-900 mb-1">Member-Only Feature</h3>
            <p class="text-xs text-gray-500 mb-5">Please log in or create an account to redeem rewards from the store and join community campaigns.</p>
            <div class="space-y-2">
                <button onclick="closeModal('lockedModal'); openModal('loginModal');" class="w-full bg-green-600 hover:bg-green-700 text-white font-bold py-2.5 rounded-xl transition cursor-pointer text-sm">Log In Now</button>
                <button onclick="closeModal('lockedModal'); openModal('registerModal');" class="w-full bg-gray-100 hover:bg-gray-200 text-gray-800 font-bold py-2.5 rounded-xl transition cursor-pointer text-sm">Create Account</button>
            </div>
        </div>
    </div>

    <!-- External JavaScript Integration -->
    <script src="script.js"></script>
</body>
</html>