<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ticketify | My Tickets</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;600;800&display=swap');
        body { font-family: 'Plus Jakarta Sans', sans-serif; }
        .glass { background: rgba(18, 18, 18, 0.8); backdrop-filter: blur(10px); }
        .ticket-card:hover { border-color: #3b82f6; background: rgba(59, 130, 246, 0.05); }
    </style>
</head>
<body class="bg-[#0f0f0f] text-white antialiased">

    <div class="flex max-w-[1600px] mx-auto min-h-screen border-x border-gray-800 bg-[#121212] shadow-2xl">

    @include('layouts.sidebar-pembeli')
        <div class="flex-1 flex flex-col min-w-0 border-r border-white/5">
            <nav class="sticky top-0 z-50 glass border-b border-white/5 px-8 py-4 flex justify-between items-center">

            <!-- TOMBOL HAMBURGER: Sekarang muncul di mobile (lg:hidden) -->
            <button id="open-sidebar" class="lg:hidden text-gray-400 hover:text-blue-500 transition-colors">
                <i class="fa-solid fa-bars-staggered text-2xl"></i>
            </button>

            <div>
                    <span class="text-sm text-gray-400 font-medium italic">Track your event journeys here.</span>
                </div>
                <div class="flex items-center gap-4">
                </div>
            </nav>

            <header class="p-8 pb-0">
                <h2 class="text-2xl font-black italic tracking-tighter mb-6">Ticket Summary</h2>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                    <div class="bg-[#1e1e1e] border border-white/5 p-6 rounded-2xl relative overflow-hidden group">
                        <i class="fa-solid fa-layer-group absolute -right-2 -bottom-2 text-5xl text-white/5 group-hover:text-blue-500/10 transition-colors"></i>
                        <p class="text-[10px] font-bold  uppercase tracking-widest mb-1 text-blue-600">Total Ticket</p>
                        <p class="text-3xl font-black italic">2</p>
                    </div>
                    <div class="bg-[#1e1e1e] border border-white/5 p-6 rounded-2xl relative overflow-hidden group">
                        <i class="fa-solid fa-circle-check absolute -right-2 -bottom-2 text-5xl text-white/5 group-hover:text-green-500/10 transition-colors"></i>
                        <p class="text-[10px] font-bold text-gray-500 uppercase tracking-widest mb-1 text-green-500">Active</p>
                        <p class="text-3xl font-black italic">1</p>
                    </div>

                    <div class="bg-[#1e1e1e] border border-white/5 p-6 rounded-2xl relative overflow-hidden group">
                        <i class="fa-solid fa-clock-rotate-left absolute -right-2 -bottom-2 text-5xl text-white/5 group-hover:text-gray-500/10 transition-colors"></i>
                        <p class="text-[10px] font-bold text-gray-500 uppercase tracking-widest mb-1 text-red-500">Used</p>
                        <p class="text-3xl font-black italic text-gray-500">1</p>
                    </div>
                </div>
            </header>

            <main class="p-8">
                <div class="flex justify-between items-center mb-6">
                    <h2 class="text-xl font-black italic tracking-tighter uppercase tracking-widest">Purchase History</h2>
                    <div class="flex gap-2">
                        <button class="px-4 py-1.5 bg-white/5 border border-white/10 rounded-lg text-[10px] font-bold hover:bg-white/10 transition">Latest</button>
                        <button class="px-4 py-1.5 bg-white/5 border border-white/10 rounded-lg text-[10px] font-bold hover:bg-white/10 transition">All</button>
                    </div>
                </div>

                <!-- ini untuk purchased History -->
                <div class="space-y-4">
                    <div class="ticket-card flex flex-wrap md:flex-nowrap items-center gap-6 p-5 bg-[#1e1e1e] border border-white/5 rounded-2xl transition-all duration-300">
                        <div class="w-full md:w-32 h-20 bg-blue-500/20 rounded-xl overflow-hidden border border-blue-500/30">
                            <img src="{{ asset('images/kmipn.jpeg') }}" class="w-full h-full object-cover opacity-60" alt="Event">
                        </div>
                        <div class="flex-1">
                            <span class="px-2 py-0.5 bg-green-500 text-[9px] font-black rounded uppercase tracking-tighter">Active</span>
                            <h3 class="text-lg font-black italic tracking-tight mt-1 group-hover:text-blue-400 transition-colors">Seminar KMIPN 2026</h3>
                            <p class="text-xs text-gray-500 mt-1"><i class="fa-solid fa-calendar mr-2"></i>25 April 2026</p>
                        </div>
                        <div class="flex-1">
                            <span class="px-2 py-0.5 bg-yellow-500 text-[9px] font-black rounded uppercase tracking-tighter"><i class="fa-solid fa-crown mr-2"></i>VIP</span>
                            <h3 class="text-lg font-black italic tracking-tight mt-1 group-hover:text-blue-400 transition-colors">Ticket Type</h3>
                            <p class="text-xs text-gray-500 mt-1"><i class="fa-solid  mr-2"></i></p>
                        </div>
                        <div class="text-right">
                            <p class="text-[10px] font-bold text-gray-500 uppercase">Date Purchased</p>
                            <p class="text-xs font-black text-white">21/04/2026</p>
                        </div>
                        <a href="{{ route('pembeli.ticketdigital') }}"
                                 class="w-full md:w-auto px-6 py-2.5 bg-white text-black font-black rounded-xl text-[10px] uppercase hover:bg-blue-500 hover:text-white transition-all inline-block text-center">
                                 View Ticket
                        </a>
                    </div>

                <!-- ini tabel yang kedua -->
                    <div class="ticket-card flex flex-wrap md:flex-nowrap items-center gap-6 p-5 bg-[#1e1e1e] border border-white/5 rounded-2xl transition-all duration-300 opacity-60">
                        <div class="w-full md:w-32 h-20 bg-gray-500/20 rounded-xl overflow-hidden border border-white/10 grayscale">
                            <img src="{{ asset('images/festival musik.jpg') }}" class="w-full h-full object-cover opacity-40" alt="Event">
                        </div>
                        <div class="flex-1">
                            <span class="px-2 py-0.5 bg-red-500 text-[9px] font-black rounded uppercase tracking-tighter">Used</span>
                            <h3 class="text-lg font-black italic tracking-tight mt-1">Tech Expo Batam 2025</h3>
                            <p class="text-xs text-gray-500 mt-1"><i class="fa-solid fa-calendar mr-2"></i>15 Desember 2025</p>
                        </div>
                        <div class="flex-1">
                            <span class="px-2 py-0.5 bg-blue-500 text-[9px] font-black rounded uppercase tracking-tighter"><i class="fa-solid fa-ticket mr-2"></i>Reguler</span>
                            <h3 class="text-lg font-black italic tracking-tight mt-1 group-hover:text-blue-400 transition-colors">Ticket Type</h3>
                            <p class="text-xs text-gray-500 mt-1"><i class="fa-solid  mr-2"></i></p>
                        </div>
                        <div class="text-right">
                            <p class="text-[10px] font-bold text-gray-500 uppercase">Date Purchased</p>
                            <p class="text-xs font-black text-white">15/01/2026</p>
                        </div>
                        <button class="w-full md:w-auto px-6 py-2.5 bg-white/5 border border-white/10 text-gray-500 font-black rounded-xl text-[10px] cursor-not-allowed uppercase">Expired </button>
                    </div>
                </div>
            </main>

            <footer class="mt-auto bg-black/20 border-t border-white/5 p-8 text-center">
                <p class="text-[10px] font-bold text-gray-600 uppercase tracking-[0.3em]">&copy; 2026 Informatics Engineering - Polibatam</p>
            </footer>
        </div>
    </div>

        <script>
    const openBtn = document.getElementById('open-sidebar');
    const closeBtn = document.getElementById('close-sidebar');
    const sidebar = document.getElementById('main-sidebar');
    const overlay = document.getElementById('sidebar-overlay');

    // Cek apakah elemen ada sebelum menjalankan fungsi
    if (openBtn && sidebar) {
        function toggleSidebar() {
            sidebar.classList.toggle('-translate-x-full');
            if (overlay) {
                overlay.classList.toggle('hidden');
            }
            document.body.classList.toggle('overflow-hidden', !sidebar.classList.contains('-translate-x-full'));
        }

        openBtn.addEventListener('click', toggleSidebar);

        if (closeBtn) closeBtn.addEventListener('click', toggleSidebar);
        if (overlay) overlay.addEventListener('click', toggleSidebar);
    }
</script>
</body>
</html>
