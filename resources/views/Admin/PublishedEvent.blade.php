@extends('layouts.admin')

@section('title', 'Published Event')

@section('content')

{{-- NAVBAR --}}
<nav class="glass border-b border-white/5 px-8 py-4">
    <h2 class="text-2xl font-black">Published Event</h2>
</nav>

{{-- 🔥 HERO CAROUSEL --}}
<header class="px-8 pt-6 pb-12">
    <div class="swiper myHeroSwiper rounded-3xl overflow-hidden shadow-2xl h-[420px] relative">
        <div class="swiper-wrapper">

        <div class="swiper-wrapper h-full">

            <!-- SLIDE -->
            <div class="swiper-slide relative h-full">

                <!-- IMAGE -->
                <img src="{{ asset('images/events/banner_1779635248.jpg') }}"
                    class="w-full h-full object-cover">

                <!-- OVERLAY -->
                <div class="absolute inset-0 bg-gradient-to-t from-black via-black/40 to-transparent"></div>

                <!-- CONTENT -->
                <div class="absolute bottom-0 left-0 w-full p-8 z-20">
                    <h2 class="text-4xl font-extrabold italic text-white">
                        Seminar KMIPN 2026
                    </h2>

                    <p class="text-gray-300 text-sm mt-2 max-w-lg">
                        Sharing bersama para juara nasional untuk persiapan kompetisi informatika terbesar.
                    </p>
                </div>
            </div>

            <!-- DUPLICATE SLIDE -->
            <div class="swiper-slide relative h-full">
                <img src="{{ asset('images/events/banner_1780050795.jpg') }}"
                    class="w-full h-full object-cover">

                <div class="absolute inset-0 bg-gradient-to-t from-black via-black/40 to-transparent"></div>

                <div class="absolute bottom-0 left-0 w-full p-8 z-20">
                    <h2 class="text-4xl font-extrabold italic text-white">
                        Pergelaran Vokasi 2026
                    </h2>

                    <p class="text-gray-300 text-sm mt-2 max-w-lg">
                        Semarakkan perayaan vokasi tahun ini!
                    </p>
                </div>
            </div>

        </div>

        <!-- DOTS -->
        <div class="swiper-pagination absolute bottom-4 left-0 right-0 z-50"></div>
    </div>
</header>

        <!-- ini bagian search bar -->
           <div class="px-8 -mt-10 relative z-30">
    <div class="bg-[#1e1e1e] border border-white/10 rounded-2xl p-4 shadow-2xl flex flex-wrap lg:flex-nowrap items-end gap-4">

        <div class="flex-[2] min-w-[200px]">
            <label class="text-[9px] font-black text-gray-500 uppercase tracking-widest mb-2 block ml-1">Search Event Name</label>
            <div class="flex items-center gap-3 bg-white/5 rounded-xl px-4 py-3 border border-transparent focus-within:border-blue-500 transition">
                <i class="fa-solid fa-magnifying-glass text-blue-500"></i>
                <input type="text" placeholder="Seminar, workshop, konser..." class="bg-transparent w-full outline-none border-none ring-0 focus:ring-0 text-sm text-gray-200">
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

{{-- CONTENT --}}
<div class="flex gap-8 px-8 py-8">

    {{-- EVENT GRID --}}
    <div class="flex-1">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

            @forelse($publishedEvents as $event)
                <div class="group bg-[#1e1e1e] border border-white/5 rounded-2xl overflow-hidden hover:border-blue-500/40 transition-all duration-300 hover:shadow-lg hover:shadow-blue-500/10">

                    <div class="relative h-48 overflow-hidden">
                        <img src="{{ $event->banner
                            ? asset('images/events/' . $event->banner)
                            : asset('images/events/banner_1779635248.jpg') }}"
                            class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">

                        <div class="absolute top-3 right-3 bg-black/60 backdrop-blur-md px-3 py-2 rounded-xl text-center border border-white/10">
                            <span class="block text-[10px] font-bold text-blue-400 uppercase">{{ \Illuminate\Support\Carbon::parse($event->date)->format('M') }}</span>
                            <span class="block text-lg font-black">{{ \Illuminate\Support\Carbon::parse($event->date)->format('d') }}</span>
                            <span class="text-[10px] text-gray-500">{{ \Illuminate\Support\Carbon::parse($event->date)->format('Y') }}</span>
                        </div>
                    </div>

                    <div class="p-5">
                        <span class="text-[10px] font-bold text-blue-500 uppercase tracking-widest">{{ $event->category }}</span>

                        <h3 class="font-bold text-lg mt-2 mb-3 group-hover:text-blue-400 transition">
                            {{ $event->name }}
                        </h3>

                        <div class="space-y-2 text-xs text-gray-400 mb-5">
                            <div class="flex items-center gap-2">
                                <i class="fa-solid fa-location-dot"></i>
                                {{ $event->location }}
                            </div>

                            <div class="flex items-center gap-2">
                                <i class="fa-regular fa-clock"></i>
                                {{ \Illuminate\Support\Carbon::parse($event->time_start)->format('H:i') }} WIB
                            </div>

                            <div class="flex items-center gap-2">
                                <i class="fa-solid fa-ticket"></i>
                                From IDR {{ number_format($event->price, 0, ',', '.') }}
                            </div>
                        </div>

                        <div class="flex gap-2 pt-4 border-t border-white/5">
                            <button type="button" class="px-4 py-2 border border-white/10 rounded-xl text-xs hover:bg-white/5 transition"
                                data-event='@json($event)'
                                onclick="openDetailFromElement(this)">Detail</button>
                            <form action="{{ route('admin.events.unpublish', $event) }}" method="POST" class="flex-1">
                                @csrf
                                <button type="submit" class="w-full py-2 bg-red-500/10 text-red-400 rounded-xl text-xs hover:bg-red-500/20 transition">Unpublish</button>
                            </form>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-span-2 text-center text-gray-400 py-20 bg-[#1e1e1e] border border-white/5 rounded-3xl">
                    Belum ada event terpublikasi.
                </div>
            @endforelse

        </div>
    </div>

    {{-- RIGHT SIDEBAR --}}
    <aside class="w-80 hidden xl:block">
        <div class="space-y-6">

            <div>
                <div class="flex justify-between items-center mb-4">
                    <h3 class="text-xl font-black">Upcoming</h3>
                    <i class="fa-solid fa-calendar-check text-blue-500"></i>
                </div>

                <div class="space-y-4">
                    <div class="p-4 bg-[#1e1e1e] rounded-2xl border border-white/5">
                        <p class="font-bold text-sm">Seminar KMIPN</p>
                        <p class="text-xs text-gray-500 mt-1">25 Apr 2026 • 15:00</p>
                    </div>

                    <div class="p-4 bg-[#1e1e1e] rounded-2xl border border-white/5">
                        <p class="font-bold text-sm">Workshop AI</p>
                        <p class="text-xs text-gray-500 mt-1">26 Apr 2026 • 10:00</p>
                    </div>
                </div>
            </div>
        </div>
    </aside>


    <!-- ================= MODAL DETAIL FINAL ================= -->
<div id="detailModal" class="fixed inset-0 bg-black/70 hidden items-center justify-center z-50 p-4">

    <div class="bg-[#18181b] w-full max-w-5xl max-h-[90vh] rounded-3xl border border-white/10 overflow-hidden shadow-2xl">

        <!-- HEADER -->
        <div class="bg-green-600 px-6 py-4 flex justify-between items-center">
            <div class="flex items-center gap-2">
                <i class="fa-solid fa-eye text-white"></i>
                <h2 class="text-white font-bold text-lg">Detail Event</h2>
            </div>

            <button onclick="closeDetail()" class="text-white text-xl hover:opacity-70 transition">
                <i class="fa-solid fa-xmark"></i>
            </button>
        </div>

        <!-- BODY -->
        <div class="p-6 space-y-6 overflow-y-auto max-h-[calc(90vh-140px)]">

            <!-- TOP SECTION -->
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 items-start">

                <!-- LEFT : POSTER -->
                <div>
                    <div class="rounded-2xl overflow-hidden border border-white/10">
                        <img
                            id="detailPoster"
                            src="https://via.placeholder.com/600x750"
                            alt="Poster Event"
                            class="w-full h-[340px] object-cover">
                    </div>
                </div>

                <!-- RIGHT : DETAIL -->
                <div class="space-y-5">

                    <!-- Date -->
                    <div class="flex items-start gap-4">
                        <div class="bg-blue-500/20 text-blue-400 rounded-xl px-4 py-3 text-center">
                            <p class="text-xl font-bold">25</p>
                            <p class="text-xs uppercase">APR</p>
                        </div>

                        <div>
                            <p class="text-xs text-gray-400 uppercase">Waktu Pelaksanaan</p>
                            <p id="detailTime" class="font-bold text-xl">15:00 WIB</p>
                            <p id="detailDate" class="text-sm text-gray-400">25 April 2026</p>
                        </div>
                    </div>

                    <!-- Title -->
                    <div>
                        <p class="text-xs text-gray-400 uppercase">Nama Event</p>
                        <h3 id="detailTitle" class="text-blue-400 font-bold text-2xl">
                            Event Seminar KMIPN
                        </h3>
                    </div>

                    <!-- Location -->
                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <p class="text-xs text-gray-400 uppercase">Lokasi</p>
                            <p id="detailLocation" class="text-sm">Politeknik Negeri Batam</p>
                        </div>

                        <div>
                            <p class="text-xs text-gray-400 uppercase">Organizer</p>
                            <p class="text-sm">Teknik Informatika</p>
                        </div>
                    </div>

                    <!-- Description -->
                    <div>
                        <p class="text-xs text-gray-400 uppercase">Deskripsi</p>
                        <div class="bg-white/5 border border-white/10 rounded-xl p-4 text-sm text-gray-300 leading-relaxed">
                            <span id="detailDesc">
                                Event seminar membahas perkembangan teknologi terbaru.
                            </span>
                        </div>
                    </div>

                </div>
            </div>

            <!-- TICKET SECTION -->
            <div class="space-y-4">
                <h3 class="text-xl font-bold">Available Tickets</h3>

                <div id="detailTickets" class="space-y-4">
                    <!-- tickets rendered here by JS -->
                </div>
            </div>

        </div>

        <!-- FOOTER -->
        <div class="px-6 py-4 border-t border-white/10 text-right">
            <button onclick="closeDetail()"
                class="px-6 py-2 bg-white/10 rounded-xl text-sm hover:bg-white/20 transition">
                Tutup
            </button>
        </div>

    </div>
</div>

<!-- UNPUBLISH MODAL WITH REASON -->
<div id="unpublishModal" class="fixed inset-0 bg-black/60 hidden items-center justify-center z-50">
    <div class="bg-[#1e1e1e] rounded-2xl p-6 w-[460px] border border-white/10">

        <div class="flex items-center gap-3 mb-4">
            <div class="w-10 h-10 rounded-full bg-red-500/20 flex items-center justify-center flex-shrink-0">
                <i class="fa-solid fa-triangle-exclamation text-red-400"></i>
            </div>
            <div>
                <h2 class="text-base font-bold">Unpublish Event</h2>
                <p class="text-xs text-gray-400">Event akan dipindahkan ke status
                    <span class="text-red-400 font-bold">Rejected</span>
                </p>
            </div>
        </div>

        <form id="unpublishForm" method="POST">
            @csrf
            <div class="mb-4">
                <label class="text-[10px] font-black text-gray-500 uppercase tracking-widest mb-2 block">
                    Alasan Unpublish <span class="text-red-400">*</span>
                </label>
                <textarea name="reason" id="unpublishReason" rows="4"
                    placeholder="Jelaskan alasan mengapa event ini di-unpublish... (min. 10 karakter)"
                    class="w-full bg-white/5 border border-white/10 rounded-xl p-3 text-sm text-gray-200 outline-none focus:border-red-500/50 transition resize-none placeholder:text-gray-600"
                    maxlength="500"></textarea>
                <div class="flex justify-between mt-1">
                    <p id="unpublishReasonError" class="text-xs text-red-400 hidden">
                        Alasan minimal 10 karakter.
                    </p>
                    <p class="text-xs text-gray-600 ml-auto">
                        <span id="reasonCount">0</span>/500
                    </p>
                </div>
            </div>

            <div class="flex gap-3">
                <button type="button" onclick="closeUnpublishModal()"
                    class="flex-1 py-2.5 border border-white/10 rounded-xl text-sm hover:bg-white/5 transition">
                    Batal
                </button>
                <button type="submit"
                    class="flex-1 py-2.5 bg-red-500 text-white rounded-xl text-sm font-bold hover:bg-red-600 transition">
                    <i class="fa-solid fa-xmark mr-1"></i> Unpublish
                </button>
            </div>
        </form>
    </div>
</div>
git add .
@endsection
