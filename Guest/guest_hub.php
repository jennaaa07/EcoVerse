<?php
session_start();
require_once '../includes/db_connect.php';

$pageTitle = "Guest Session Hub - Eco Hub";
if (!isset($_SESSION['guest_session_id'])) {
    $_SESSION['guest_session_id'] = bin2hex(random_bytes(16));
}
$guestSessionId = $_SESSION['guest_session_id'];
$stmt = mysqli_prepare($conn, "INSERT INTO guest_sessions (guest_session_id, points) VALUES (?, 0) ON DUPLICATE KEY UPDATE updated_at = NOW()");
mysqli_stmt_bind_param($stmt, 's', $guestSessionId);
mysqli_stmt_execute($stmt);
$stmt = mysqli_prepare($conn, 'SELECT points FROM guest_sessions WHERE guest_session_id = ?');
mysqli_stmt_bind_param($stmt, 's', $guestSessionId);
mysqli_stmt_execute($stmt);
$initialPoints = (int)(mysqli_fetch_assoc(mysqli_stmt_get_result($stmt))['points'] ?? 0);
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
<body class="bg-gray-100 font-sans min-h-screen text-gray-800 pb-28" data-initial-points="<?php echo $initialPoints; ?>">

    <!-- FEATURE 1: Guest Session Lifecycle Management Header -->
    <div class="bg-gradient-to-r from-amber-500 to-orange-600 text-white px-4 py-2.5 text-xs font-bold sticky top-0 z-30 shadow-md flex justify-between items-center">
        <div class="flex items-center gap-2">
            <i class="fa-solid fa-hourglass-half animate-pulse text-sm"></i>
            <span>Temporary Guest Session Expires In: <span id="sessionTimer" class="font-mono bg-black/20 px-1.5 py-0.5 rounded">59:42</span></span>
        </div>
        <button onclick="saveGuestProgress()" class="bg-white text-orange-700 px-2.5 py-1 rounded-md shadow hover:bg-orange-50 transition uppercase text-[10px] tracking-wider font-extrabold cursor-pointer">
            Save My Points
        </button>
    </div>

    <!-- Main Navigation Bar -->
    <header class="bg-white shadow-sm px-6 py-4 flex justify-between items-center z-20 relative">
        <div class="flex items-center gap-2">
            <div class="w-8 h-8 bg-gray-200 text-gray-600 rounded-full flex items-center justify-center font-bold text-xs">
                GT
            </div>
            <div>
                <p class="text-[10px] text-gray-400 font-bold uppercase tracking-wide">Session Mode</p>
                <p class="font-bold text-xs text-gray-700">Anonymous Guest</p>
            </div>
        </div>
        
        <!-- Live Counter of Temporary/Unclaimed Points -->
        <div class="bg-green-50 border border-green-200 px-3 py-1 rounded-xl text-right">
            <p class="text-[9px] font-bold text-gray-400 uppercase tracking-wider">Unclaimed</p>
            <p id="pointLedgerDisplay" class="text-sm font-extrabold text-green-600">+<?php echo $initialPoints; ?> Pts</p>
        </div>
    </header>

    <main class="p-4 max-w-md mx-auto space-y-6">

        <!-- FEATURE 2: Instant On-Site Action Submission -->
        <section class="bg-white rounded-2xl p-5 shadow-sm border border-gray-200/80">
            <div class="flex items-center gap-2.5 mb-3">
                <div class="w-8 h-8 bg-green-100 text-green-700 rounded-lg flex items-center justify-center text-sm">
                    <i class="fa-solid fa-bolt"></i>
                </div>
                <div>
                    <h2 class="font-bold text-base text-gray-800">Instant On-Site Logging</h2>
                    <p class="text-[11px] text-gray-400">Scan physical bin QR codes directly on campus</p>
                </div>
            </div>

            <!-- Active Scan / Detection Target Box -->
            <div class="border-2 border-dashed border-gray-200 rounded-xl bg-gray-50/50 p-4 mb-4 text-center">
                <div class="bg-white border border-gray-200 rounded-xl p-3 shadow-sm inline-flex items-center gap-3 mb-3 max-w-full">
                    <i class="fa-solid fa-qrcode text-green-600 text-lg"></i>
                    <div class="text-left overflow-hidden">
                        <p class="text-xs font-bold text-gray-800 truncate">South Campus Bin #04 detected</p>
                        <p class="text-[10px] text-gray-400">Location verified via proximity tags</p>
                    </div>
                </div>

                <!-- Instant Quick Upload Form Component -->
                <button onclick="handleDepositClaim()" class="w-full bg-green-600 hover:bg-green-700 text-white font-bold py-3 px-4 rounded-xl shadow transition flex items-center justify-center gap-2 text-sm cursor-pointer">
                    <i class="fa-solid fa-camera"></i> Snap & Claim +50 Pts Instantly
                </button>
            </div>
            
            <p class="text-[11px] text-gray-400 text-center italic">No registration required to log your first drop-off!</p>
        </section>

        <!-- FEATURE 3: Event Voucher Marketplace Access (Browse-Only View) -->
        <section class="space-y-3">
            <div class="flex justify-between items-end px-1">
                <div>
                    <h2 class="font-bold text-base text-gray-800">Live Event Voucher Marketplace</h2>
                    <p class="text-[11px] text-gray-400">Trade points for campus & community perks</p>
                </div>
                <span class="text-[10px] font-bold text-blue-600 bg-blue-50 px-2 py-0.5 rounded border border-blue-100">Browse Mode</span>
            </div>

            <!-- Voucher Grid -->
            <div class="grid grid-cols-1 gap-3">
                
                <!-- Voucher Item 1 -->
                <div class="bg-white rounded-xl border border-gray-200 shadow-sm overflow-hidden flex relative">
                    <div class="w-24 bg-purple-600 relative flex items-center justify-center text-white text-xl">
                        <i class="fa-solid fa-ticket-simple opacity-30 absolute text-4xl"></i>
                        <span class="font-black text-xs tracking-wider uppercase rotate-[-90deg]">CAMPUS</span>
                    </div>
                    <div class="p-3 flex-grow flex flex-col justify-between">
                        <div>
                            <h3 class="font-bold text-sm text-gray-800">Green Campus Fest Ticket</h3>
                            <p class="text-[11px] text-gray-400">Priority Entry + Free Eco-Goodie Bag</p>
                        </div>
                        <div class="flex justify-between items-end mt-2">
                            <span class="text-xs font-extrabold text-purple-700 bg-purple-50 px-2 py-0.5 rounded">400 Pts</span>
                            <button onclick="triggerLockedAction()" class="bg-gray-100 text-gray-400 hover:text-gray-600 font-bold text-[10px] py-1 px-3 rounded-lg flex items-center gap-1 cursor-pointer transition">
                                <i class="fa-solid fa-lock text-[9px]"></i> Unlock
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Voucher Item 2 -->
                <div class="bg-white rounded-xl border border-gray-200 shadow-sm overflow-hidden flex relative">
                    <div class="w-24 bg-orange-500 relative flex items-center justify-center text-white text-xl">
                        <i class="fa-solid fa-utensils opacity-30 absolute text-4xl"></i>
                        <span class="font-black text-xs tracking-wider uppercase rotate-[-90deg]">FOOD</span>
                    </div>
                    <div class="p-3 flex-grow flex flex-col justify-between">
                        <div>
                            <h3 class="font-bold text-sm text-gray-800">RM5 Eco-Café Voucher</h3>
                            <p class="text-[11px] text-gray-400">Applicable for all sustainable vendors</p>
                        </div>
                        <div class="flex justify-between items-end mt-2">
                            <span class="text-xs font-extrabold text-orange-700 bg-orange-50 px-2 py-0.5 rounded">250 Pts</span>
                            <button onclick="triggerLockedAction()" class="bg-gray-100 text-gray-400 hover:text-gray-600 font-bold text-[10px] py-1 px-3 rounded-lg flex items-center gap-1 cursor-pointer transition">
                                <i class="fa-solid fa-lock text-[9px]"></i> Unlock
                            </button>
                        </div>
                    </div>
                </div>

            </div>

            <!-- Interstitial Wall for Marketplace Actions -->
            <div class="bg-gradient-to-br from-gray-900 to-slate-800 text-white rounded-2xl p-5 text-center shadow-lg mt-4">
                <p class="text-xs font-bold text-amber-400 uppercase tracking-widest mb-1">Want to claim these rewards?</p>
                <h3 class="font-extrabold text-sm mb-3">Convert your temporary session into a permanent profile</h3>
                <button onclick="saveGuestProgress()" class="w-full bg-green-500 hover:bg-green-600 text-white font-bold py-2.5 rounded-xl text-xs shadow transition cursor-pointer">
                    Secure Account & Save Points
                </button>
            </div>
        </section>

    </main>

    <!-- Guest Sticky Bottom Navigation HUD -->
    <nav class="fixed bottom-0 w-full bg-white border-t border-gray-200 flex justify-around p-2 pb-6 max-w-md left-1/2 transform -translate-x-1/2 z-30 shadow-lg">
        <button onclick="window.scrollTo({top: 0, behavior: 'smooth'})" class="flex flex-col items-center justify-center w-16 text-green-600 cursor-pointer">
            <i class="fa-solid fa-qrcode text-xl mb-1"></i>
            <span class="text-[10px] font-bold">On-Site Log</span>
        </button>
        <button onclick="alert('Feature available in full account mode.')" class="flex flex-col items-center justify-center w-16 text-gray-400 hover:text-green-600 transition cursor-pointer">
            <i class="fa-solid fa-map-location-dot text-xl mb-1"></i>
            <span class="text-[10px] font-bold">Bins Map</span>
        </button>
        <button onclick="window.scrollTo({top: 400, behavior: 'smooth'})" class="flex flex-col items-center justify-center w-16 text-gray-400 hover:text-green-600 transition cursor-pointer">
            <i class="fa-solid fa-store text-xl mb-1"></i>
            <span class="text-[10px] font-bold">Marketplace</span>
        </button>
        <button onclick="saveGuestProgress()" class="flex flex-col items-center justify-center w-16 text-gray-400 hover:text-green-600 transition cursor-pointer">
            <i class="fa-solid fa-user-plus text-xl mb-1"></i>
            <span class="text-[10px] font-bold">Join Hub</span>
        </button>
    </nav>

    <!-- External JavaScript Integration -->
    <script src="guest_hub.js"></script>
</body>
</html>
