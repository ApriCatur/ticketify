<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ticketify - My Events</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;600;800&display=swap');
        body { font-family: 'Plus Jakarta Sans', sans-serif; }
        .event-row:hover { background: rgba(255, 255, 255, 0.03); transform: scale(1.005); }
    </style>
</head>
<body class="bg-[#09090b] text-white flex min-h-screen">

    @include('layouts.sidebar-panitia')

    <main class="flex-1 p-6 lg:p-10 overflow-y-auto">
        <header class="mb-10 flex flex-col md:flex-row justify-between items-start md:items-end gap-6">
                   <!-- untuk button sidebar -->
             <button id="open-sidebar" class="lg:hidden text-gray-400 hover:text-blue-500 transition-colors">
                <i class="fa-solid fa-bars-staggered text-2xl"></i>
            </button>
            
            <div>
                <h1 class="text-3xl font-black tracking-tight uppercase italic text-blue-500">My Events</h1>
                <p class="text-gray-500 text-sm mt-2 font-medium">Kelola dan pantau seluruh event kamu dalam satu daftar.</p>
            </div>

            <div class="flex gap-3 w-full md:w-auto">
                <a href="{{ route('panitia.create') }}" class="bg-blue-600 hover:bg-blue-500 text-white px-6 py-3 rounded-xl text-[10px] font-black uppercase tracking-widest transition-all flex items-center gap-2 shadow-lg shadow-blue-600/20">
                    <i class="fa-solid fa-plus text-xs"></i> New Event
                </a>
            </div>
        </header>

        <div class="space-y-4">

            <div class="hidden md:grid grid-cols-12 px-8 py-4 text-[10px] font-black uppercase tracking-[0.2em] text-gray-600 border-b border-white/5">
                <div class="col-span-5">Event Information</div>
                <div class="col-span-2 text-center">Status</div>
                <div class="col-span-3">Ticket Sales</div>
                <div class="col-span-2 text-right">Actions</div>
            </div>

            <div class="event-row bg-[#121212] border border-white/5 rounded-2xl p-4 md:px-8 md:py-5 transition-all duration-300">
                <div class="grid grid-cols-1 md:grid-cols-12 items-center gap-6">

                    <div class="md:col-span-5 flex items-center gap-5">
                        <div class="w-16 h-16 rounded-xl overflow-hidden flex-shrink-0 border border-white/10">
                            <img src="{{ asset('images/kmipn.jpeg') }}" class="w-full h-full object-cover">
                        </div>
                        <div class="min-w-0">
                            <h3 class="text-sm font-black text-white truncate uppercase tracking-tight">Seminar Nasional KMIPN VII</h3>
                            <p class="text-[10px] text-gray-500 mt-1 flex items-center gap-2 uppercase font-bold">
                                <i class="fa-solid fa-calendar text-blue-500"></i> 25 April 2026
                            </p>
                        </div>
                    </div>

                    <div class="md:col-span-2 flex justify-start md:justify-center">
                        <div class="flex items-center gap-2 bg-emerald-500/10 border border-emerald-500/30 text-emerald-500 px-4 py-1.5 rounded-full text-[9px] font-black uppercase tracking-widest">
                            <span class="w-1.5 h-1.5 bg-emerald-500 rounded-full animate-pulse"></span>
                            Active
                        </div>
                    </div>

                    <div class="md:col-span-3 space-y-2">
                        <div class="flex justify-between text-[9px] font-black uppercase tracking-widest text-gray-500">
                            <span>Sold: <b class="text-white">45</b></span>
                            <span>Target: 100</span>
                        </div>
                        <div class="w-full h-1.5 bg-white/5 rounded-full overflow-hidden">
                            <div class="h-full bg-blue-500 rounded-full shadow-[0_0_8px_rgba(59,130,246,0.4)]" style="width: 45%"></div>
                        </div>
                    </div>

                    <div class="md:col-span-2 flex justify-end items-center gap-3">

                    <!-- Edit Event -->
                    <a href="{{ route('panitia.create') }}"
                        class="flex items-center justify-center w-11 h-11 bg-white/5 hover:bg-white/10 rounded-xl text-gray-400 hover:text-white transition-all duration-200 border border-white/5 hover:scale-105 active:scale-95"
                        title="Edit Event">
                        <i class="fa-solid fa-pen-to-square text-sm"></i>
                    </a>

                    <!-- Data Peserta -->
                    <a href="{{ route('panitia.customerdata') }}"
                        class="flex items-center justify-center w-11 h-11 bg-blue-600/10 hover:bg-blue-600 text-blue-500 hover:text-white rounded-xl transition-all duration-200 border border-blue-500/20 hover:scale-105 active:scale-95"
                        title="Data Peserta">
                        <i class="fa-solid fa-table text-sm"></i>
                    </a>

                </div>
                </div>
            </div>

            <div class="event-row bg-[#121212]/50 border border-white/5 rounded-2xl p-4 md:px-8 md:py-5 transition-all duration-300 opacity-60">
                <div class="grid grid-cols-1 md:grid-cols-12 items-center gap-6">
                    <div class="md:col-span-5 flex items-center gap-5">
                        <div class="w-16 h-16 rounded-xl overflow-hidden flex-shrink-0 grayscale opacity-50">
                            <img src="https://images.unsplash.com/photo-1540575861501-7cf05a4b125a?q=80&w=2070" class="w-full h-full object-cover">
                        </div>
                        <div>
                            <h3 class="text-sm font-black text-gray-400 truncate uppercase tracking-tight">Workshop UI/UX Design</h3>
                            <p class="text-[10px] text-gray-600 mt-1 uppercase font-bold tracking-widest">Waiting for Admin Approval</p>
                        </div>
                    </div>
                    <div class="md:col-span-2 flex justify-start md:justify-center">
                        <div class="flex items-center gap-2 bg-amber-500/10 border border-amber-500/30 text-amber-500 px-4 py-1.5 rounded-full text-[9px] font-black uppercase tracking-widest">
                            <i class="fa-solid fa-clock-rotate-left"></i> Pending
                        </div>
                    </div>
                    <div class="md:col-span-3">
                        <p class="text-[9px] text-gray-600 font-bold italic">Penjualan belum tersedia.</p>
                    </div>
                    <div class="md:col-span-2 flex justify-end">
                        <span class="text-[9px] font-black text-gray-700 uppercase tracking-widest p-3">Locked</span>
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
