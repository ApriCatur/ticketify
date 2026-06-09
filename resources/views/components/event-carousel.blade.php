<header class="p-8">
    <div class="swiper myHeroSwiper rounded-3xl overflow-hidden shadow-2xl">
        <div class="swiper-wrapper">
            @forelse($events->take(5) as $carouselEvent)
                @php
                    $user = auth()->user();
                    $detailRoute = match(true) {
                        $user && $user->role === 'pembeli' => route('pembeli.detail', $carouselEvent),
                        $user && $user->role === 'admin'   => '#', // admin no click
                        $user && $user->role === 'panitia' => route('panitia.events.show', $carouselEvent->id),
                        default                            => route('guest.event.detail', $carouselEvent->id),
                    };
                @endphp
                <div class="swiper-slide relative h-[350px] group cursor-pointer" onclick="window.location='{{ $detailRoute }}'">
                    <div class="absolute inset-0 bg-gradient-to-t from-black via-black/20 to-transparent z-10"></div>

                    <img src="{{ $carouselEvent->banner ? asset('images/events/' . $carouselEvent->banner) : asset('images/events/banner_1779635248.jpg') }}"
                    class="absolute inset-0 w-full h-full object-cover opacity-60 group-hover:scale-105 transition-transform duration-700"
                    alt="{{ $carouselEvent->name }}">

                    <div class="absolute inset-0 flex flex-col items-start justify-end p-8 z-20">
                        <h2 class="text-4xl font-extrabold mb-2 leading-tight italic tracking-tighter text-white uppercase drop-shadow-lg">
                            {{ $carouselEvent->name }}
                        </h2>
                        <p class="text-blue-100 max-w-lg mb-6 text-sm line-clamp-2 opacity-90">
                            {{ $carouselEvent->description ?? 'Tidak ada deskripsi untuk event ini.' }}
                        </p>
                    </div>
                </div>
            @empty
                <div class="swiper-slide relative h-[350px] bg-[#1e1e1e] flex flex-col items-center justify-center p-8">
                    <i class="fa-solid fa-calendar-xmark text-4xl text-gray-600 mb-3"></i>
                    <p class="text-gray-400 text-sm font-medium">Belum ada event unggulan yang tersedia.</p>
                </div>
            @endforelse
        </div>
        <div class="swiper-pagination"></div>
    </div>
</header>
