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

            @forelse($events as $event)
                <div class="event-row bg-[#121212] border border-white/5 rounded-2xl p-4 md:px-8 md:py-5 transition-all duration-300">
                    <div class="grid grid-cols-1 md:grid-cols-12 items-center gap-6">

                        <div class="md:col-span-5 flex items-center gap-5">
                            <div class="w-16 h-16 rounded-xl overflow-hidden flex-shrink-0 border border-white/10">
                                <img src="{{ $event->banner ? asset('storage/'.$event->banner) : asset('images/kmipn.jpeg') }}" class="w-full h-full object-cover">
                            </div>
                            <div class="min-w-0">
                                <h3 class="text-sm font-black text-white truncate uppercase tracking-tight">{{ $event->name }}</h3>
                                <p class="text-[10px] text-gray-500 mt-1 flex items-center gap-2 uppercase font-bold">
                                    <i class="fa-solid fa-calendar text-blue-500"></i> {{ \Illuminate\Support\Carbon::parse($event->date)->format('d F Y') }}
                                </p>
                            </div>
                        </div>

                        <div class="md:col-span-2 flex justify-start md:justify-center">
                            @php
                                $displayStatus = $event->getDisplayStatus();
                            @endphp
                            @if($displayStatus === 'published')
                                <div class="flex items-center gap-2 bg-emerald-500/10 border border-emerald-500/30 text-emerald-500 px-4 py-1.5 rounded-full text-[9px] font-black uppercase tracking-widest">
                                    <span class="w-1.5 h-1.5 bg-emerald-500 rounded-full animate-pulse"></span>
                                    Active
                                </div>
                            @elseif($displayStatus === 'completed')
                                <div class="flex items-center gap-2 bg-blue-500/10 border border-blue-500/30 text-blue-500 px-4 py-1.5 rounded-full text-[9px] font-black uppercase tracking-widest">
                                    <i class="fa-solid fa-circle-check"></i> Completed
                                </div>
                            @elseif($displayStatus === 'pending')
                                <div class="flex items-center gap-2 bg-amber-500/10 border border-amber-500/30 text-amber-500 px-4 py-1.5 rounded-full text-[9px] font-black uppercase tracking-widest">
                                    <i class="fa-solid fa-clock-rotate-left"></i> Pending
                                </div>
                            @elseif($displayStatus === 'rejected')
                                <div class="flex items-center gap-2 bg-red-500/10 border border-red-500/30 text-red-500 px-4 py-1.5 rounded-full text-[9px] font-black uppercase tracking-widest">
                                    <i class="fa-solid fa-circle-xmark"></i> Rejected
                                </div>
                            @else
                                <div class="flex items-center gap-2 bg-gray-500/10 border border-gray-500/30 text-gray-400 px-4 py-1.5 rounded-full text-[9px] font-black uppercase tracking-widest">
                                    {{ ucfirst($displayStatus) }}
                                </div>
                            @endif
                        </div>

                        <div class="md:col-span-3 space-y-2">
                            <div class="flex justify-between text-[9px] font-black uppercase tracking-widest text-gray-500">
                                <span>Sold: <b class="text-white">0</b></span>
                                <span>Target: {{ $event->stock ?? '-' }}</span>
                            </div>
                            <div class="w-full h-1.5 bg-white/5 rounded-full overflow-hidden">
                                <div class="h-full bg-blue-500 rounded-full shadow-[0_0_8px_rgba(59,130,246,0.4)]" style="width: 0%"></div>
                            </div>
                        </div>

                        <div class="flex items-center justify-end md:col-span-2 gap-3">
                            @php
                                $canEdit = $event->status !== 'rejected' && $displayStatus !== 'completed';
                            @endphp
                            @if($canEdit)
                                {{-- FIXED: Mengubah nama route ke panitia.events.edit --}}
                                <a href="{{ route('panitia.events.edit', $event->id) }}" class="flex items-center justify-center w-11 h-11 bg-white/5 hover:bg-white/10 text-gray-400 hover:text-white rounded-xl transition-colors border border-white/5">
                                    <i class="fa-solid fa-pen-to-square text-sm"></i>
                                </a>

                                <a href="{{ route('panitia.customerdata', $event->id) }}" class="flex items-center justify-center w-11 h-11 bg-blue-600/10 hover:bg-blue-600/20 text-blue-500 hover:text-blue-400 rounded-xl transition-colors border border-blue-500/10">
                                    <i class="fa-solid fa-table text-sm"></i>
                                </a>
                            @else
                                <div class="flex items-center gap-1.5 text-[10px] text-zinc-600 font-bold uppercase tracking-wider bg-zinc-900/50 border border-zinc-800/50 px-3 py-2 rounded-xl">
                                    <i class="fa-solid fa-lock text-[9px]"></i> Locked
                                </div>
                            @endif
                        </div>

                    </div>
                </div>
            @empty
                <div class="text-center py-8 text-gray-400">Belum ada event. Klik "New Event" untuk menambahkan.</div>
            @endforelse

        </div>
    </main>

    <script>
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
    </script>

</body>
</html>
