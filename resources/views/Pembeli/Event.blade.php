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
        .glass { background: rgba(15, 15, 15, 0.85); backdrop-filter: blur(12px); }

        ::-webkit-scrollbar { width: 6px; }
        ::-webkit-scrollbar-track { background: #0f0f0f; }
        ::-webkit-scrollbar-thumb { background: #333; border-radius: 10px; }

        .swiper-pagination-bullet { background: #555; opacity: 1; }
        .swiper-pagination-bullet-active { background: #3b82f6; width: 24px; border-radius: 4px; transition: all 0.3s; }
    </style>
</head>
<body class="bg-[#0f0f0f] text-white antialiased">

    <div class="flex w-full min-h-screen bg-[#0f0f0f]">

        @include('layouts.sidebar-pembeli')

        <div class="flex-1 flex flex-col min-w-0 border-r border-white/[0.04]">
            <nav class="sticky top-0 z-50 glass border-b border-white/[0.04] px-6 lg:px-10 py-3 flex justify-between items-center">
                <button id="open-sidebar" class="lg:hidden text-gray-400 hover:text-blue-500 transition-colors">
                    <i class="fa-solid fa-bars-staggered text-xl"></i>
                </button>
            </nav>

            @include('components.event-carousel')

            <div class="px-8 mt-6">
                <x-event-filter :categories="$categories" />
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-5 px-8 pb-8 mt-6">
                @forelse($publicEvents as $event)
                    @php
                        $minPrice = $event->tickets->whereNull('order_id')->min('price');
                        $priceLabel = $minPrice ? 'Rp ' . number_format($minPrice, 0, ',', '.') : 'Gratis';
                    @endphp
                    <x-event-card
                        :image="asset('images/events/' . $event->banner)"
                        :day="\Carbon\Carbon::parse($event->date)->format('d')"
                        :month="\Carbon\Carbon::parse($event->date)->translatedFormat('M')"
                        :year="\Carbon\Carbon::parse($event->date)->format('Y')"
                        :category="$event->category?->name"
                        :title="$event->name"
                        :location="$event->location"
                        :startTime="\Carbon\Carbon::parse($event->time_start)->format('H:i')"
                        :endTime="\Carbon\Carbon::parse($event->time_end)->format('H:i')"
                        :price="$priceLabel"
                    >
                        @if(auth()->user() && auth()->user()->role === 'pembeli')
                            <a href="{{ route('pembeli.detail', $event->id) }}"
                               class="inline-flex items-center gap-1.5 bg-gradient-to-r from-blue-500 to-blue-600 hover:from-blue-600 hover:to-blue-700 text-white px-4 py-2 rounded-lg text-[11px] font-bold transition-all duration-300 shadow-lg shadow-blue-500/20 active:scale-[0.97]">
                                Detail <i class="fa-solid fa-arrow-right text-[9px]"></i>
                            </a>
                        @endif
                    </x-event-card>
                @empty
                    <div class="col-span-full text-center py-16">
                        <i class="fa-solid fa-ticket text-3xl text-gray-700 mb-3 block"></i>
                        <p class="text-gray-600 text-sm font-medium">Belum ada event yang dipublikasikan.</p>
                    </div>
                @endforelse
            </div>
        </div>

        <aside class="w-80 hidden xl:flex flex-col sticky top-0 h-screen p-8 space-y-8 border-l border-white/[0.04] overflow-y-auto">
            <div>
                <div class="flex justify-between items-center mb-6">
                    <h2 class="text-lg font-black tracking-tight">Upcoming</h2>
                    <i class="fa-solid fa-calendar-check text-blue-500/60 text-sm"></i>
                </div>

                <div class="space-y-3">
                    @if(isset($upcomingEvents) && $upcomingEvents->count() > 0)
                        @foreach($upcomingEvents as $upEvent)
                            @php
                                $eventDate = \Carbon\Carbon::parse($upEvent->date);
                            @endphp
                            <div class="group p-3.5 bg-[#171717] border border-white/[0.04] rounded-xl hover:border-blue-500/30 transition-all duration-300 cursor-pointer hover:shadow-[0_0_20px_rgba(59,130,246,0.06)]">
                                <div class="flex gap-3 items-center">
                                    <div class="flex-shrink-0 w-11 h-11 bg-blue-500/10 rounded-xl flex flex-col items-center justify-center border border-blue-500/10">
                                        <span class="text-[9px] font-bold text-blue-400 uppercase leading-none">{{ $eventDate->translatedFormat('M') }}</span>
                                        <span class="text-base font-black text-white mt-px leading-none">{{ $eventDate->format('d') }}</span>
                                    </div>
                                    <div class="flex-1 min-w-0">
                                        <h4 class="text-sm font-bold text-white truncate group-hover:text-blue-400 transition-colors">{{ $upEvent->name }}</h4>
                                        <p class="text-[10px] text-gray-600 mt-0.5 flex items-center gap-1">
                                            <i class="fa-regular fa-clock text-[9px]"></i>
                                            {{ \Carbon\Carbon::parse($upEvent->time_start)->format('H:i') }} WIB
                                        </p>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @else
                        <div class="text-center py-10 bg-[#171717] border border-dashed border-white/[0.04] rounded-xl">
                            <i class="fa-solid fa-calendar-xmark text-gray-700 text-xl mb-2 block"></i>
                            <p class="text-[11px] text-gray-600 font-medium">Belum ada event terdekat</p>
                        </div>
                    @endif

                    @if(auth()->user() && auth()->user()->role === 'pembeli')
                        <a href="{{ route('pembeli.buatevent') }}" class="inline-flex items-center justify-center rounded-xl border border-blue-500/40 bg-gradient-to-r from-blue-500/10 to-blue-600/10 hover:from-blue-500/20 hover:to-blue-600/20 px-5 py-3 text-xs font-bold text-blue-400 transition-all w-full">
                            <i class="fa-solid fa-plus mr-2"></i> Ajukan Jadi Panitia
                        </a>
                    @endif
                </div>
            </div>
        </aside>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
    <script>
        new Swiper('.myHeroSwiper', {
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
            const toggle = () => {
                sidebar.classList.toggle('-translate-x-full');
                overlay?.classList.toggle('hidden');
                document.body.classList.toggle('overflow-hidden', !sidebar.classList.contains('-translate-x-full'));
            };
            openBtn.addEventListener('click', toggle);
            closeBtn?.addEventListener('click', toggle);
            overlay?.addEventListener('click', toggle);
        }
    </script>
</body>
</html>
