<header class="p-8 pb-0">
    <div class="swiper myHeroSwiper rounded-2xl overflow-hidden shadow-2xl border border-white/[0.04]">
        <div class="swiper-wrapper">
            @forelse($events->take(5) as $carouselEvent)
                @php
                    $user = auth()->user();
                    $detailRoute = match(true) {
                        $user && $user->role === 'pembeli' => route('pembeli.detail', $carouselEvent),
                        $user && $user->role === 'admin'   => '#',
                        $user && $user->role === 'panitia' => route('panitia.events.show', $carouselEvent->id),
                        default                            => route('guest.event.detail', $carouselEvent->id),
                    };
                @endphp
                <div class="swiper-slide relative h-[380px] group cursor-pointer" onclick="window.location='{{ $detailRoute }}'">
                    <div class="absolute inset-0 bg-gradient-to-t from-[#0f0f0f] via-[#0f0f0f]/30 to-transparent z-10"></div>

                    <img src="{{ $carouselEvent->banner ? asset('images/events/' . $carouselEvent->banner) : asset('images/events/banner_1779635248.jpg') }}"
                         class="absolute inset-0 w-full h-full object-cover group-hover:scale-105 transition-transform duration-700"
                         alt="{{ $carouselEvent->name }}">

                    <div class="absolute bottom-0 left-0 right-0 z-20 p-8 md:p-12">
                        <span class="inline-block text-[9px] font-bold uppercase tracking-widest text-blue-400 bg-blue-500/10 px-2.5 py-1 rounded-md border border-blue-500/20 mb-3">
                            {{ $carouselEvent->category?->name ?? 'Event' }}
                        </span>
                        <h2 class="text-3xl md:text-4xl font-black mb-2 leading-tight text-white drop-shadow-lg">
                            {{ $carouselEvent->name }}
                        </h2>
                        <p class="text-gray-400 max-w-xl text-sm line-clamp-2">
                            {{ $carouselEvent->description ? Str::limit(strip_tags($carouselEvent->description), 150) : 'Tidak ada deskripsi untuk event ini.' }}
                        </p>
                    </div>
                </div>
            @empty
                <div class="swiper-slide relative h-[380px] bg-[#1a1a1a] flex flex-col items-center justify-center p-8">
                    <i class="fa-solid fa-calendar-xmark text-4xl text-gray-600 mb-3"></i>
                    <p class="text-gray-400 text-sm font-medium">Belum ada event unggulan yang tersedia.</p>
                </div>
            @endforelse
        </div>
        <div class="swiper-pagination"></div>
    </div>
</header>
