<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ticketify - My Statistics Events</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body class="bg-[#09090b] text-white flex">

    @include('layouts.sidebar-panitia')

    <main class="flex-1 p-10 overflow-y-auto">
        <header class="mb-10 flex flex-col md:flex-row justify-between items-start md:items-end gap-4">

          <!-- untuk button sidebar -->
             <button id="open-sidebar" class="lg:hidden text-gray-400 hover:text-blue-500 transition-colors">
                <i class="fa-solid fa-bars-staggered text-2xl"></i>
            </button>

            <div>
                <h1 class="text-3xl font-black tracking-tight">My Statistics Events</h1>
                <p class="text-gray-500 text-sm mt-2">Pantau status dan penjualan tiket event kamu di sini.</p>
            </div>

            <div class="flex gap-3 w-full md:w-auto">
                <div class="relative flex-1 md:flex-none">
                    <i class="fa-solid fa-magnifying-glass absolute left-4 top-1/2 -translate-y-1/2 text-gray-500 text-xs"></i>
                    <input type="text" placeholder="Cari event..." class="w-full md:w-64 bg-[#121212] border border-white/5 rounded-xl pl-10 pr-4 py-3 text-xs focus:border-blue-500 outline-none transition-all">
                </div>
                <select class="bg-[#121212] border border-white/5 rounded-xl px-4 py-3 text-[10px] font-black uppercase tracking-widest outline-none text-gray-400 focus:border-blue-500">
                    <option>Semua Status</option>
                    <option>Active</option>
                    <option>Pending</option>
                </select>
            </div>
        </header>

        <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-8">

                <div class="relative aspect-video overflow-hidden rounded-t-[2rem]">
                        <img src="{{ asset('images/kmipn.jpeg') }}"
                        alt="Poster KMIPN VII"
                        class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700">
                    <div class="absolute inset-0 bg-gradient-to-t from-[#121212]/50 to-transparent"></div>
                <div class="absolute top-4 right-4 bg-green-500/20 backdrop-blur-md border border-green-500/50 text-green-500 px-4 py-1.5 rounded-full text-[10px] font-black uppercase tracking-widest shadow-lg shadow-black/30">
                        Active
                </div>
            </div>

                <div class="p-8 space-y-6">
                    <div>
                        <h3 class="text-lg font-black text-white truncate mb-1">Seminar Nasional KMIPN VII</h3>
                        <p class="text-xs text-gray-500 flex items-center gap-2">
                            <i class="fa-solid fa-calendar-day text-blue-500"></i> 25 April 2026, 15:00 WIB
                        </p>
                    </div>

                    <div class="space-y-3">
                        <div class="flex justify-between items-end">
                            <span class="text-[10px] font-black text-gray-400 uppercase tracking-widest">Penjualan Tiket</span>
                            <span class="text-xs font-bold text-white">45 <span class="text-gray-500">/ 100</span></span>
                        </div>
                        <div class="w-full h-2 bg-white/5 rounded-full overflow-hidden">
                            <div class="h-full bg-blue-500 rounded-full shadow-[0_0_10px_rgba(59,130,246,0.5)]" style="width: 45%"></div>
                        </div>
                    </div>

                    <div class="pt-4 border-t border-white/5 flex gap-3">
                        <a href="{{ route('panitia.statistic2') }}" class="flex-1 bg-white/5 hover:bg-blue-500 text-white py-3 rounded-xl text-[10px] font-black uppercase transition-all flex items-center justify-center gap-2 border border-white/5">
                            <i class="fa-solid fa-statistics"></i> View Statistic
                        </a>

                    </div>
                </div>
            </div>

        </div>
    </main>
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
