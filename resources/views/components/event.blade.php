<header class="p-8">
            <div class="swiper myHeroSwiper rounded-3xl overflow-hidden shadow-2xl">
                <div class="swiper-wrapper">
                    <div class="swiper-slide relative h-[350px] group">
                        <div class="absolute inset-0 bg-gradient-to-t from-black via-transparent to-transparent z-10"></div>
                        <img src="{{ asset('images/kmipn.jpeg') }}" class="absolute inset-0 w-full h-full object-cover opacity-60 group-hover:scale-105 transition-transform duration-700" alt="Hero">
                        <div class="absolute inset-0 flex flex-col items-start justify-end p-8 z-20">
                            <h2 class="text-4xl font-extrabold mb-2 leading-tight italic tracking-tighter">Seminar KMIPN 2026</h2>
                            <p class="text-blue-100 max-w-lg mb-6 text-sm">Sharing bersama para juara nasional untuk persiapan kompetisi informatika terbesar.</p>
                        </div>
                    </div>
                    <div class="swiper-slide relative h-[350px] group">
                        <div class="absolute inset-0 bg-gradient-to-t from-black via-transparent to-transparent z-10"></div>
                        <img src="{{ asset('images/festival musik.jpg') }}" class="absolute inset-0 w-full h-full object-cover opacity-60 group-hover:scale-105 transition-transform duration-700" alt="Tech">
                        <div class="absolute inset-0 flex flex-col items-start justify-end p-8 z-20">
                            <h2 class="text-4xl font-extrabold mb-2 leading-tight italic tracking-tighter">Pergelaran Vokasi 2026</h2>
                            <p class="text-purple-100 max-w-lg mb-6 text-sm">Semarakkan perayaan vokasi tahun ini!</p>
                        </div>
                    </div>
                    <div class="swiper-slide relative h-[350px] group">
                        <div class="absolute inset-0 bg-gradient-to-t from-black via-transparent to-transparent z-10"></div>
                        <img src="{{ asset('images/robotika1.jpg') }}" class="absolute inset-0 w-full h-full object-cover opacity-60 group-hover:scale-105 transition-transform duration-700" alt="Tech">
                        <div class="absolute inset-0 flex flex-col items-start justify-end p-8 z-20">
                            <h2 class="text-4xl font-extrabold mb-2 leading-tight italic tracking-tighter">AI & Future Tech</h2>
                            <p class="text-green-100 max-w-lg mb-6 text-sm">Jelajahi masa depan teknologi bersama para ahli di bidangnya.</p>
                        </div>
                    </div>
                    <div class="swiper-slide relative h-[350px] group">
                        <div class="absolute inset-0 bg-gradient-to-t from-black via-transparent to-transparent z-10"></div>
                        <img src="{{ asset('images/seni.jpg') }}" class="absolute inset-0 w-full h-full object-cover opacity-60 group-hover:scale-105 transition-transform duration-700" alt="Tech">
                        <div class="absolute inset-0 flex flex-col items-start justify-end p-8 z-20">
                            <h2 class="text-4xl font-extrabold mb-2 leading-tight italic tracking-tighter">Inovasi Teknologi 2026</h2>
                            <p class="text-yellow-100 max-w-lg mb-6 text-sm">Temukan inovasi terbaru di dunia teknologi.</p>
                        </div>
                    </div>
                    <div class="swiper-slide relative h-[350px] group">
                        <div class="absolute inset-0 bg-gradient-to-t from-black via-transparent to-transparent z-10"></div>
                        <img src="{{ asset('images/pec.jpg') }}" class="absolute inset-0 w-full h-full object-cover opacity-60 group-hover:scale-105 transition-transform duration-700" alt="Tech">
                        <div class="absolute inset-0 flex flex-col items-start justify-end p-8 z-20">
                            <h2 class="text-4xl font-extrabold mb-2 leading-tight italic tracking-tighter">Pergelaran Vokasi 2026</h2>
                            <p class="text-purple-100 max-w-lg mb-6 text-sm">Semarakkan perayaan vokasi tahun ini!</p>
                        </div>
                    </div>
                    <div class="swiper-slide relative h-[350px] group">
                        <div class="absolute inset-0 bg-gradient-to-t from-black via-transparent to-transparent z-10"></div>
                        <img src="{{ asset('images/bisnis.jpg') }}" class="absolute inset-0 w-full h-full object-cover opacity-60 group-hover:scale-105 transition-transform duration-700" alt="Tech">
                        <div class="absolute inset-0 flex flex-col items-start justify-end p-8 z-20">
                            <h2 class="text-4xl font-extrabold mb-2 leading-tight italic tracking-tighter">AI & Future Tech</h2>
                            <p class="text-green-100 max-w-lg mb-6 text-sm">Jelajahi masa depan teknologi bersama para ahli di bidangnya.</p>
                        </div>
                    </div>
                </div>
                <div class="swiper-pagination"></div>
            </div>
        </header>

        <div class="px-8 -mt-10 relative z-30">
            <div class="bg-[#1e1e1e] border border-white/10 rounded-2xl p-4 shadow-2xl flex flex-wrap lg:flex-nowrap items-end gap-4">
                <div class="flex-[2] min-w-[200px]">
                    <label class="text-[9px] font-black text-gray-500 uppercase tracking-widest mb-2 block ml-1">Search Event Name</label>
                    <div class="flex items-center gap-3 bg-white/5 rounded-xl px-4 py-3 border border-transparent focus-within:border-blue-500 transition">
                        <i class="fa-solid fa-magnifying-glass text-blue-500"></i>
                        <input type="text" placeholder="Seminar, workshop, konser..." class="bg-transparent w-full outline-none text-sm text-gray-200">
                    </div>
                </div>

                <div class="flex-1 min-w-[150px]">
                    <label class="text-[9px] font-black text-gray-500 uppercase tracking-widest mb-2 block ml-1">Category</label>
                    <div class="relative group">
                        <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                            <i class="fa-solid fa-tags text-blue-500 text-[12px]"></i>
                        </div>
                        <select class="w-full bg-white/5 border border-transparent rounded-xl py-3 pl-10 pr-8 text-xs font-bold text-gray-300 focus:border-blue-500 outline-none transition-all appearance-none cursor-pointer">
                            <option value="" class="bg-[#1e1e1e]">Semua</option>
                            <option value="edu" class="bg-[#1e1e1e]">Education</option>
                            <option value="music" class="bg-[#1e1e1e]">Music</option>
                            <option value="tech" class="bg-[#1e1e1e]">Technology</option>
                            <option value="art" class="bg-[#1e1e1e]">Art & Theater</option>
                        </select>
                        <div class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none text-gray-500">
                            <i class="fa-solid fa-chevron-down text-[10px]"></i>
                        </div>
                    </div>
                </div>

                <div class="flex-1 min-w-[150px]">
                    <label class="text-[9px] font-black text-gray-500 uppercase tracking-widest mb-2 block ml-1">Select Date</label>
                    <div class="relative group">
                        <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                            <i class="fa-solid fa-calendar-day text-blue-500 text-[12px]"></i>
                        </div>
                        <input type="date" class="w-full bg-white/5 border border-transparent rounded-xl py-3 pl-10 pr-4 text-xs font-bold text-gray-300 focus:border-blue-500 outline-none transition-all cursor-pointer [color-scheme:dark]">
                    </div>
                </div>

                <button class="w-full lg:w-auto px-8 py-3.5 bg-white text-black rounded-xl font-bold hover:bg-blue-500 hover:text-white transition-all active:scale-95 shadow-lg">
                    Cari Event
                </button>
            </div>
        </div>

        <main class="p-8">
            <div class="flex justify-between items-center mb-8">
                <h2 class="text-2xl font-black italic tracking-tighter">Popular Event</h2>
                <a href="#" class="text-sm text-blue-400 hover:underline">See All</a>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 pb-12">
                @if(!empty($events) && count($events))
                    @foreach($events as $event)
                        <x-event-card
                            image="{{ $event->banner ? asset('storage/' . $event->banner) : asset('images/kmipn.jpeg') }}"
                            day="{{ \Illuminate\Support\Carbon::parse($event->date)->format('d') }}"
                            month="{{ \Illuminate\Support\Carbon::parse($event->date)->format('M') }}"
                            year="{{ \Illuminate\Support\Carbon::parse($event->date)->format('Y') }}"
                            category="{{ $event->category }}"
                            title="{{ $event->name }}"
                            location="{{ $event->location }}"
                            startTime="{{ \Illuminate\Support\Carbon::parse($event->time_start)->format('H:i') }}"
                            endTime="{{ isset($event->time_end) ? \Illuminate\Support\Carbon::parse($event->time_end)->format('H:i') : \Illuminate\Support\Carbon::parse($event->time_start)->addHour()->format('H:i') }}"
                            price="IDR {{ number_format($event->price, 0, ',', '.') }}"
                        >
                            <a href="{{ route('pembeli.detail', $event) }}" class="rounded-full border border-white/10 px-3 py-1 text-[11px] uppercase tracking-[0.2em] font-bold hover:bg-white/5 transition">View</a>
                        </x-event-card>
                    @endforeach
                @else
                    <p class="text-gray-400 text-center col-span-2">Belum ada event yang tersedia saat ini.</p>
                @endif
            </div>
        </main>

        <footer class="mt-auto bg-black/20 border-t border-white/5 p-8 text-center">
            <p class="text-[10px] font-bold text-gray-600 uppercase tracking-[0.3em]">&copy; 2026 Informatics Engineering - Polibatam</p>
        </footer>
    </div>
