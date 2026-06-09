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

    <main class="flex-1 p-10 overflow-y-auto h-screen">

        <button id="open-sidebar" class="lg:hidden text-gray-400 hover:text-blue-500 transition-colors mb-4">
            <i class="fa-solid fa-bars-staggered text-2xl"></i>
        </button>

        <header class="mb-10 flex flex-col md:flex-row justify-between items-start md:items-end gap-4">
            <div>
                <h1 class="text-3xl font-black tracking-tight">My Statistics Events</h1>
                <p class="text-gray-500 text-sm mt-2">Pantau status dan penjualan tiket event kamu di sini.</p>
            </div>

            <div class="flex gap-3 w-full md:w-auto">
                <div class="relative flex-1 md:flex-none">
                    <i class="fa-solid fa-magnifying-glass absolute left-4 top-1/2 -translate-y-1/2 text-gray-500 text-xs"></i>
                    <input type="text" placeholder="Cari event..." class="w-full md:w-64 bg-[#121212] border border-white/5 rounded-xl pl-10 pr-4 py-3 text-xs focus:border-blue-500 outline-none transition-all">
                </div>

            </div>
        </header>

        <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-8">

            @forelse($events as $item)
    @php
        $kuota = $item->tickets->sum('stock');
        $terjual = $item->tickets_sold ?? 0;
        $persentase = $kuota > 0 ? ($terjual / $kuota) * 100 : 0;
    @endphp

    <div class="bg-[#121212] rounded-[2rem] overflow-hidden border border-white/5 flex flex-col group hover:border-white/10 transition-all duration-300">

        <div class="relative aspect-video overflow-hidden">
           @if($item->banner)
                <img src="{{ asset('images/events/' . $item->banner) }}"
                alt="Poster {{ $item->name }}"
                class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-700">
            @else
            @endif
            <div class="absolute inset-0 bg-gradient-to-t from-[#121212]/80 via-[#121212]/20 to-transparent"></div>

            @php
                $displayStatus = $item->getDisplayStatus();
                $statusConfig = [
                    'published' => ['bg' => 'bg-emerald-500/20', 'border' => 'border-emerald-500/50', 'text' => 'text-emerald-500', 'label' => 'Active'],
                    'completed' => ['bg' => 'bg-blue-500/20', 'border' => 'border-blue-500/50', 'text' => 'text-blue-500', 'label' => 'Completed'],
                    'pending' => ['bg' => 'bg-amber-500/20', 'border' => 'border-amber-500/50', 'text' => 'text-amber-500', 'label' => 'Pending'],
                    'rejected' => ['bg' => 'bg-red-500/20', 'border' => 'border-red-500/50', 'text' => 'text-red-500', 'label' => 'Rejected'],
                ];
                $config = $statusConfig[$displayStatus] ?? $statusConfig['published'];
            @endphp

            <div class="absolute top-4 right-4 backdrop-blur-md border rounded-full px-4 py-1.5 text-[10px] font-black uppercase tracking-widest shadow-lg shadow-black/30 {{ $config['bg'] }} {{ $config['border'] }} {{ $config['text'] }}">
                {{ $config['label'] }}
            </div>
        </div>

        <div class="p-8 flex flex-col flex-1 justify-between space-y-6">
            <div>
                <h3 class="text-lg font-black text-white truncate mb-1" title="{{ $item->name }}">
                    {{ $item->name }}
                </h3>
                <p class="text-xs text-gray-500 flex items-center gap-2">
                    <i class="fa-solid fa-calendar-day text-blue-500"></i>
                    {{ \Carbon\Carbon::parse($item->date)->format('d F Y, H:i') }} WIB
                </p>
            </div>

            <div class="space-y-3">
                <div class="flex justify-between items-end">
                    <span class="text-[10px] font-black text-gray-400 uppercase tracking-widest">Penjualan Tiket</span>
                    <span class="text-xs font-bold text-white">
                        {{ $terjual }} <span class="text-gray-500">/ {{ $kuota }}</span>
                    </span>
                </div>
                <div class="w-full h-2 bg-white/5 rounded-full overflow-hidden">
                   <div class="h-full bg-blue-500 rounded-full shadow-lg transition-all duration-500"
                         style="width: {{ $persentase }}%"></div>
                </div>
            </div>

            <a href="{{ route('panitia.statistic.detail', $item->id) }}"
               class="inline-block text-center w-full bg-white/5 hover:bg-blue-600 hover:text-white text-white font-bold text-xs py-3 px-4 rounded-xl transition-all shadow-md">
                VIEW STATISTIC
            </a>
        </div>
    </div>
@empty
    <div class="col-span-full flex flex-col items-center justify-center py-20 text-gray-400">
        <i class="fa-solid fa-chart-pie text-5xl mb-4 text-white/10"></i>
        <p class="text-sm">Belum ada event yang terdaftar untuk melihat statistik.</p>
    </div>
@endforelse
        </div>
    </main>

    <script>
        // Membungkus kode ke dalam scope lokal agar aman dan rapi
        (function() {
            const openBtn = document.getElementById('open-sidebar');
            const closeBtn = document.getElementById('close-sidebar');
            const sidebar = document.getElementById('main-sidebar');
            const overlay = document.getElementById('sidebar-overlay');

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
        })();
    </script>
</body>
</html>
