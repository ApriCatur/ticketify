<div class="swiper myHeroSwiper relative">
    <div class="swiper-wrapper">
        @forelse($events->take(5) as $carouselEvent)
            @php
                $user = auth()->user();
                $detailRoute = match(true) {
                    $user && $user->role === 'pembeli' => route('pembeli.detail', $carouselEvent),
                    $user && $user->role === 'panitia' => route('panitia.events.show', $carouselEvent->id),
                    default => route('guest.event.detail', $carouselEvent->id),
                };
            @endphp
            <div class="swiper-slide relative h-[400px] md:h-[440px] cursor-pointer" onclick="window.location='{{ $detailRoute }}'">
                <div class="absolute inset-0 bg-gradient-to-t from-black/60 via-black/10 to-transparent z-10"></div>

                <img src="{{ $carouselEvent->banner ? asset('images/events/' . $carouselEvent->banner) : 'https://placehold.co/1280x440/1e293b/ffffff?text=Ticketify' }}"
                     class="absolute inset-0 w-full h-full object-cover"
                     alt="{{ $carouselEvent->name }}">

                <div class="absolute bottom-0 left-0 right-0 z-20 p-8 md:p-12">
                    <h2 class="text-2xl md:text-4xl font-bold leading-tight text-white drop-shadow-lg">
                        {{ $carouselEvent->name }}
                    </h2>
                </div>
            </div>
        @empty
            <div class="swiper-slide relative h-[440px] bg-gray-100 flex flex-col items-center justify-center">
                <i class="fa-solid fa-calendar-xmark text-4xl text-gray-300 mb-3"></i>
                <p class="text-gray-400 text-sm">Belum ada event unggulan.</p>
            </div>
        @endforelse
    </div>

    <div class="swiper-button-prev !text-white !w-10 !h-10 !bg-black/20 hover:!bg-black/40 !rounded-full !backdrop-blur-sm after:!text-sm"></div>
    <div class="swiper-button-next !text-white !w-10 !h-10 !bg-black/20 hover:!bg-black/40 !rounded-full !backdrop-blur-sm after:!text-sm"></div>

    <div class="swiper-pagination !bottom-4"></div>
</div>
