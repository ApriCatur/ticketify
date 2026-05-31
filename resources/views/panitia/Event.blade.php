<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ticketify | Discover Events</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;600;800&display=swap');
        body { font-family: 'Plus Jakarta Sans', sans-serif; }
        .glass { background: rgba(18, 18, 18, 0.8); backdrop-filter: blur(10px); }
        .spotify-shadow { transition: all 0.3s ease; }
        .spotify-shadow:hover { box-shadow: 0 20px 25px -5px rgba(34, 197, 94, 0.2); }

        ::-webkit-scrollbar { width: 6px; }
        ::-webkit-scrollbar-track { background: #0f0f0f; }
        ::-webkit-scrollbar-thumb { background: #333; border-radius: 10px; }

        .swiper-pagination-bullet { background: #fff; opacity: 0.5; }
        .swiper-pagination-bullet-active { background: #3b82f6; opacity: 1; width: 20px; border-radius: 5px; transition: all 0.3s; }
    </style>
</head>
<body class="bg-[#0f0f0f] text-white antialiased">

    <div class="flex w-full min-h-screen border-x border-gray-800 bg-[#121212] shadow-2xl">

        @include('layouts.sidebar-panitia')

        <div class="flex-1 flex flex-col min-w-0 border-r border-white/5">
            <nav class="sticky top-0 z-50 glass border-b border-white/5 px-8 py-4 flex justify-between items-center">
                <button id="open-sidebar" class="lg:hidden text-gray-400 hover:text-blue-500 transition-colors">
                    <i class="fa-solid fa-bars-staggered text-2xl"></i>
                </button>

                <div class="hidden lg:block">
                    <span class="text-sm text-gray-400 font-medium italic">Welcome To Ticketify! Discover something new today.</span>
                </div>
            </nav>

            @include('components.event')
        </div>

        <aside class="w-80 hidden xl:flex flex-col sticky top-0 h-screen p-8 space-y-8 bg-[#121212] overflow-y-auto">
            <div>
                <div class="flex justify-between items-center mb-6">
                    <h2 class="text-xl font-black italic tracking-tighter text-white">Upcoming</h2>
                    <i class="fa-solid fa-calendar-check text-blue-500"></i>
                </div>

                     <div class="space-y-4">
                        @if(isset($upcomingEvents) && $upcomingEvents->count() > 0)
                            @foreach($upcomingEvents as $upEvent)
                                @php
                                    $eventDate = \Carbon\Carbon::parse($upEvent->date);
                                @endphp
                                <div class="group p-4 bg-[#1e1e1e] border border-white/5 rounded-2xl hover:border-blue-500/30 transition-all cursor-pointer">
                                    <div class="flex gap-4 items-center">
                                        <div class="flex-shrink-0 w-12 h-12 bg-blue-500/10 rounded-xl flex flex-col items-center justify-center border border-blue-500/20">
                                            <span class="text-[10px] font-bold text-blue-400 uppercase leading-none">
                                                {{ $eventDate->translatedFormat('M') }}
                                            </span>
                                            <span class="text-lg font-black text-white mt-0.5 leading-none">
                                                {{ $eventDate->format('d') }}
                                            </span>
                                        </div>
                                        <div class="flex-1 min-w-0">
                                            <h4 class="text-sm font-bold text-white tracking-tight truncate group-hover:text-blue-400 transition-colors">
                                                {{ $upEvent->name }}
                                            </h4>
                                            <p class="text-[10px] text-gray-500 mt-1 uppercase flex items-center gap-1">
                                                <i class="fa-regular fa-clock text-[9px]"></i>
                                                {{ \Carbon\Carbon::parse($upEvent->time_start)->format('H:i') }} WIB
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                    @else
                        <div class="text-center py-8 bg-[#1e1e1e] border border-dashed border-white/5 rounded-2xl">
                            <i class="fa-solid fa-calendar-xmark text-gray-700 text-xl mb-2 block"></i>
                            <p class="text-[11px] text-gray-500 font-medium">Belum ada event terdekat</p>
                        </div>
                    @endif
                </div>
            </div>
        </aside>

    </div>

    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
    <script>
        const swiper = new Swiper('.myHeroSwiper', {
            loop: true,
            autoplay: { delay: 5000, disableOnInteraction: false },
            pagination: { el: '.swiper-pagination', clickable: true },
            effect: 'fade',
            fadeEffect: { crossFade: true },
        });
    </script>

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
