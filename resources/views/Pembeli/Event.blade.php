<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ticketify — Temukan Event Seru</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap');
        body { font-family: 'Inter', sans-serif; }

        .swiper-button-prev, .swiper-button-next { transform: scale(0.8); }
        .swiper-pagination-bullet { background: white; opacity: 0.5; }
        .swiper-pagination-bullet-active { background: #2563EB; opacity: 1; width: 24px; border-radius: 4px; transition: all 0.3s; }
    </style>
</head>
<body class="bg-[#F8FAFC] text-gray-900 antialiased">

    <div class="flex min-h-screen">
        @include('layouts.sidebar-pembeli')

        <div class="flex-1 flex flex-col min-w-0">
            {{-- NAVBAR --}}
            <nav class="sticky top-0 z-50 bg-white border-b border-gray-100 shadow-sm" x-data="{ searchOpen: false }">
                <div class="flex items-center justify-between h-16 px-4 sm:px-6 lg:px-8 gap-4">
                    <div class="flex items-center gap-3">
                        <button id="open-sidebar" class="lg:hidden text-gray-400 hover:text-blue-600 transition-colors">
                            <i class="fa-solid fa-bars-staggered text-xl"></i>
                        </button>
                        <button onclick="toggleSidebar()" class="flex items-center gap-2 cursor-pointer lg:cursor-default">
                            <div class="w-7 h-7 bg-blue-600 rounded-lg flex items-center justify-center font-extrabold text-white text-xs">T</div>
                            <span class="font-extrabold text-lg tracking-tight hidden sm:inline">Ticketify</span>
                        </button>
                    </div>

                    <form action="{{ route('pembeli.event') }}" method="GET" class="hidden md:flex flex-1 max-w-md relative">
                        <i class="fa-solid fa-search absolute left-3.5 top-1/2 -translate-y-1/2 text-gray-400 text-sm"></i>
                        <input type="text" name="search" value="{{ request('search') }}"
                               placeholder="Cari event..."
                               class="w-full pl-10 pr-4 py-2 bg-gray-50 border border-gray-200 rounded-xl text-sm text-gray-700 placeholder-gray-400 focus:border-blue-500 focus:ring-2 focus:ring-blue-500/20 outline-none transition-all">
                    </form>

                    <button @click="searchOpen = !searchOpen" class="md:hidden text-gray-500 hover:text-blue-600">
                        <i class="fa-solid fa-search text-lg"></i>
                    </button>

                    <a href="{{ route('pembeli.buatevent') }}" class="px-4 py-2 text-xs font-semibold bg-blue-600 hover:bg-blue-700 text-white rounded-xl transition-all shadow-sm shadow-blue-600/20">
                        <i class="fa-solid fa-plus mr-1"></i> Ajukan Event
                    </a>
                </div>

                <div x-show="searchOpen" x-cloak class="px-4 pb-3 md:hidden">
                    <form action="{{ route('pembeli.event') }}" method="GET" class="relative">
                        <i class="fa-solid fa-search absolute left-3.5 top-1/2 -translate-y-1/2 text-gray-400 text-sm"></i>
                        <input type="text" name="search" value="{{ request('search') }}"
                               placeholder="Cari event..."
                               class="w-full pl-10 pr-4 py-2 bg-gray-50 border border-gray-200 rounded-xl text-sm focus:border-blue-500 focus:ring-2 focus:ring-blue-500/20 outline-none transition-all">
                    </form>
                </div>
            </nav>

            {{-- HERO FULL WIDTH --}}
            <div class="w-full">
                @include('components.event-carousel')
            </div>

            {{-- FILTER --}}
            <div class="px-4 sm:px-6 lg:px-8 mt-6">
                <x-event-filter :categories="$categories" />
            </div>

            {{-- GRID EVENT --}}
            <section class="px-4 sm:px-6 lg:px-8 py-8">
                <h2 class="text-2xl font-bold text-gray-900 mb-6">Event Seru Untukmu</h2>

                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-5">
                    @forelse($publicEvents as $event)
                        @php
                            $minPrice = $event->tickets->whereNull('order_id')->min('price');
                            $priceLabel = $minPrice ? 'Rp ' . number_format($minPrice, 0, ',', '.') : 'Gratis';
                        @endphp
                        <x-event-card
                            href="{{ route('pembeli.detail', $event->id) }}"
                            :image="asset('images/events/' . $event->banner)"
                            :day="\Carbon\Carbon::parse($event->date)->format('d')"
                            :month="\Carbon\Carbon::parse($event->date)->translatedFormat('M')"
                            :year="\Carbon\Carbon::parse($event->date)->format('Y')"
                            :title="$event->name"
                            :location="$event->location"
                            :startTime="\Carbon\Carbon::parse($event->time_start)->format('H:i')"
                            :endTime="\Carbon\Carbon::parse($event->time_end)->format('H:i')"
                            :price="$priceLabel"
                        />
                    @empty
                        <div class="col-span-full text-center py-16">
                            <i class="fa-regular fa-calendar-xmark text-4xl text-gray-300 mb-3 block"></i>
                            <p class="text-gray-500 text-sm">Belum ada event yang dipublikasikan.</p>
                        </div>
                    @endforelse
                </div>
            </section>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
    <script>
        new Swiper('.myHeroSwiper', {
            loop: true,
            autoplay: { delay: 5000, disableOnInteraction: false },
            pagination: { el: '.swiper-pagination', clickable: true },
            navigation: {
                nextEl: '.swiper-button-next',
                prevEl: '.swiper-button-prev',
            },
            effect: 'fade',
            fadeEffect: { crossFade: true },
        });
    </script>

    <script>
        const openBtn = document.getElementById('open-sidebar');
        const closeBtn = document.getElementById('close-sidebar');
        const sidebar = document.getElementById('main-sidebar');
        const overlay = document.getElementById('sidebar-overlay');

        window.toggleSidebar = () => {
            sidebar?.classList.toggle('-translate-x-full');
            overlay?.classList.toggle('hidden');
            document.body.classList.toggle('overflow-hidden', !sidebar?.classList.contains('-translate-x-full'));
        };

        if (openBtn && sidebar) {
            openBtn.addEventListener('click', toggleSidebar);
            closeBtn?.addEventListener('click', toggleSidebar);
            overlay?.addEventListener('click', toggleSidebar);
        }
    </script>
</body>
</html>
