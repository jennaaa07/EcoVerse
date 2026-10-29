<?php
// Handle form submission and persistent values here if needed
$co2_rate = $_POST['co2_rate'] ?? '0.25';
$plastic_rate = $_POST['plastic_rate'] ?? '0.10';
$transit_factor = $_POST['transit_factor'] ?? '5.0';
$is_saved = false;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // You can add database saving logic here using your db connection
    $is_saved = true;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Impact Metrics - Reviewer</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
</head>
<body class="bg-emerald-50/50 font-sans min-h-screen text-gray-800 antialiased selection:bg-emerald-500 selection:text-white">

    <!-- Header -->
    <header class="bg-white/85 backdrop-blur-md px-8 py-5 flex justify-between items-center border-b border-emerald-100/60 sticky top-0 z-20 shadow-xs">
        <div class="flex items-center gap-4">
            <a href="viewerdashboard.php" class="h-10 w-10 flex items-center justify-center rounded-xl bg-emerald-50 text-emerald-700 hover:bg-emerald-600 hover:text-white transition-all duration-200 shadow-xs border border-emerald-200/60" title="Back to Dashboard">
                <i class="fa-solid fa-arrow-left text-base"></i>
            </a>
            <div>
                <p class="text-[11px] font-bold text-emerald-600 uppercase tracking-widest">Reviewer Dashboard</p>
                <h1 class="text-2xl font-extrabold text-gray-900 tracking-tight">Impact Metrics</h1>
            </div>
        </div>
    </header>

    <!-- Main Content Container -->
    <main class="px-6 py-10 max-w-4xl mx-auto">
        <div class="bg-white rounded-3xl p-8 sm:p-10 shadow-xl shadow-emerald-900/5 border border-emerald-100">
            
            <!-- Section Title -->
            <div class="mb-8 border-b border-emerald-100/80 pb-6 flex items-start gap-4">
                <div class="w-12 h-12 rounded-2xl bg-emerald-100/80 text-emerald-700 flex items-center justify-center text-xl shrink-0 shadow-inner">
                    <i class="fa-solid fa-sliders"></i>
                </div>
                <div>
                    <h2 class="text-xl font-extrabold text-gray-900">Algorithm Conversion Rates</h2>
                    <p class="text-sm text-gray-500 mt-1 leading-relaxed">Adjust how raw points translate to real-world environmental impact metrics across participant dashboards.</p>
                </div>
            </div>

            <!-- Algorithm Form -->
            <form id="metrics-form" method="POST" action="" class="space-y-6">
                <!-- Group 1 -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 bg-emerald-50/40 p-6 rounded-2xl border border-emerald-100">
                    <div>
                        <label class="block font-bold text-xs uppercase tracking-wider text-gray-700 mb-3 flex items-center gap-2">
                            <i class="fa-solid fa-cloud text-emerald-600"></i> CO₂ Offset Equation
                        </label>
                        <div class="flex items-center gap-3 bg-white p-3 rounded-xl border border-emerald-200/80 shadow-xs focus-within:ring-2 focus-within:ring-emerald-500/30 focus-within:border-emerald-500 transition">
                            <span class="font-bold text-sm text-gray-700">100 Pts =</span>
                            <input type="number" name="co2_rate" step="0.01" value="<?php echo htmlspecialchars($co2_rate); ?>" class="w-full bg-emerald-50/50 border border-emerald-200 rounded-lg px-3 py-1.5 font-mono text-center font-bold text-emerald-900 focus:outline-none focus:bg-white focus:border-emerald-500 transition">
                            <span class="text-xs font-extrabold text-emerald-700 uppercase tracking-wider">kg CO₂</span>
                        </div>
                    </div>

                    <div>
                        <label class="block font-bold text-xs uppercase tracking-wider text-gray-700 mb-3 flex items-center gap-2">
                            <i class="fa-solid fa-bottle-water text-emerald-600"></i> Plastic Saved Equation
                        </label>
                        <div class="flex items-center gap-3 bg-white p-3 rounded-xl border border-emerald-200/80 shadow-xs focus-within:ring-2 focus-within:ring-emerald-500/30 focus-within:border-emerald-500 transition">
                            <span class="font-bold text-sm text-gray-700">100 Pts =</span>
                            <input type="number" name="plastic_rate" step="0.01" value="<?php echo htmlspecialchars($plastic_rate); ?>" class="w-full bg-emerald-50/50 border border-emerald-200 rounded-lg px-3 py-1.5 font-mono text-center font-bold text-emerald-900 focus:outline-none focus:bg-white focus:border-emerald-500 transition">
                            <span class="text-xs font-extrabold text-emerald-700 uppercase tracking-wider">kg Plastic</span>
                        </div>
                    </div>
                </div>

                <!-- Group 2 -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 bg-emerald-50/40 p-6 rounded-2xl border border-emerald-100">
                    <div>
                        <label class="block font-bold text-xs uppercase tracking-wider text-gray-700 mb-3 flex items-center gap-2">
                            <i class="fa-solid fa-bus text-emerald-600"></i> Transit Emissions Factor
                        </label>
                        <div class="flex items-center gap-3 bg-white p-3 rounded-xl border border-emerald-200/80 shadow-xs focus-within:ring-2 focus-within:ring-emerald-500/30 focus-within:border-emerald-500 transition">
                            <span class="font-bold text-sm text-gray-700">1 KM =</span>
                            <input type="number" name="transit_factor" step="0.1" value="<?php echo htmlspecialchars($transit_factor); ?>" class="w-full bg-emerald-50/50 border border-emerald-200 rounded-lg px-3 py-1.5 font-mono text-center font-bold text-emerald-900 focus:outline-none focus:bg-white focus:border-emerald-500 transition">
                            <span class="text-xs font-extrabold text-emerald-700 uppercase tracking-wider">Pts Base</span>
                        </div>
                    </div>

                    <div>
                        <label class="block font-bold text-xs uppercase tracking-wider text-gray-700 mb-3 flex items-center justify-between">
                            <span class="flex items-center gap-2"><i class="fa-solid fa-clock text-emerald-600"></i> Effective Date (Real-Time)</span>
                            <span class="inline-flex items-center gap-1 text-[10px] font-extrabold bg-emerald-100 text-emerald-800 px-2 py-0.5 rounded-full uppercase">
                                <span class="w-1.5 h-1.5 rounded-full bg-emerald-500 animate-pulse"></span> Live
                            </span>
                        </label>
                        <div class="bg-white p-3 rounded-xl border border-emerald-200/80 shadow-xs flex items-center justify-between">
                            <div id="realtime-date" class="font-mono text-sm font-bold text-emerald-900 tracking-wide">--/--/----</div>
                            <div id="realtime-clock" class="font-mono text-xs font-bold text-emerald-600 bg-emerald-50 px-2.5 py-1 rounded-md border border-emerald-200">00:00:00 AM</div>
                        </div>
                    </div>
                </div>

                <!-- Action Buttons -->
                <div class="pt-4 flex justify-end gap-3">
                    <button type="reset" class="px-6 py-3 bg-white border border-gray-200 text-gray-600 font-bold text-sm rounded-xl hover:bg-gray-50 transition shadow-xs">
                        Reset Defaults
                    </button>
                    <button type="submit" class="px-6 py-3 bg-emerald-600 hover:bg-emerald-700 text-white font-bold text-sm rounded-xl transition shadow-lg shadow-emerald-600/20 flex items-center gap-2">
                        <i class="fa-solid fa-floppy-disk"></i> Save & Apply Algorithms
                    </button>
                </div>
            </form>

        </div>
    </main>

    <!-- Pass PHP Save State to JavaScript -->
    <script>
        const phpSaved = <?php echo $is_saved ? 'true' : 'false'; ?>;
    </script>

    <!-- Link to External JavaScript File -->
    <script src="metrics.js"></script>

</body>
</html>