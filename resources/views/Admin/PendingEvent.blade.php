@extends('layouts.admin')

@section('title', 'Pending Event')

@section('content')

{{-- NAVBAR --}}
<nav class="glass border-b border-white/5 px-8 py-4">
    <h2 class="text-2xl font-black">Pending Event</h2>
</nav>

{{-- 🔥 HERO CAROUSEL --}}
<header class="px-8 pt-6 pb-12">
    <div class="swiper myHeroSwiper rounded-3xl overflow-hidden shadow-2xl h-[420px] relative">

        <div class="swiper-wrapper h-full">

            <!-- SLIDE -->
            <div class="swiper-slide relative h-full">

                <!-- IMAGE -->
                <img src="{{ asset('images/kmipn.jpeg') }}"
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
                <img src="{{ asset('images/festival musik.jpg') }}"
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

            @for ($i = 0; $i < 6; $i++)
            <div class="group bg-[#1e1e1e] border border-white/5 rounded-2xl overflow-hidden hover:border-blue-500/40 transition-all duration-300 hover:shadow-lg hover:shadow-blue-500/10">

                <div class="relative h-48 overflow-hidden">
                    <img src="{{ asset('images/kmipn.jpeg') }}"
                        class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">

                    <div class="absolute top-3 right-3 bg-black/60 backdrop-blur-md px-3 py-2 rounded-xl text-center border border-white/10">
                        <span class="block text-[10px] font-bold text-blue-400 uppercase">APR</span>
                        <span class="block text-lg font-black">25</span>
                        <span class="text-[10px] text-gray-500">2026</span>
                    </div>
                </div>

                <div class="p-5">
                    <span class="text-[10px] font-bold text-blue-500 uppercase tracking-widest">Pending</span>

                    <h3 class="font-bold text-lg mt-2 mb-3 group-hover:text-blue-400 transition">
                        Event Seminar KMIPN
                    </h3>

                    <div class="space-y-2 text-xs text-gray-400 mb-5">
                        <div class="flex items-center gap-2">
                            <i class="fa-solid fa-location-dot"></i>
                            Politeknik Negeri Batam
                        </div>

                        <div class="flex items-center gap-2">
                            <i class="fa-regular fa-clock"></i>
                            15:00 WIB
                        </div>

                        <div class="flex items-center gap-2">
                            <i class="fa-solid fa-ticket"></i>
                            From IDR 40.000
                        </div>
                    </div>

                    {{-- ADMIN BUTTON --}}
                    <div class="flex gap-2 pt-4 border-t border-white/5">
                        <button onclick="openApprove()"
                            class="flex-1 py-2 bg-blue-600 text-white rounded-xl text-xs font-semibold hover:bg-blue-500 transition">
                            Approve
                        </button>

                        <button onclick="openReject()"
                            class="flex-1 py-2 bg-red-500/10 text-red-400 rounded-xl text-xs hover:bg-red-500/20 transition">
                            Reject
                        </button>

                        <button onclick="openDetail(
                            'Event Seminar KMIPN',
                            'Politeknik Negeri Batam',
                            'Sabtu, 25 April 2026',
                            '15:00 WIB',
                            'Event seminar membahas perkembangan teknologi terbaru.'
                        )"
                            class="px-4 py-2 border border-white/10 rounded-xl text-xs hover:bg-white/5 transition">
                            Detail
                        </button>
                    </div>
                </div>
            </div>
            @endfor

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

            <div class="p-6 bg-gradient-to-br from-blue-600 to-blue-900 rounded-2xl">
                <h4 class="font-black mb-2">Need Review?</h4>
                <p class="text-xs text-blue-100 mb-4">
                    Check all submitted events before publishing.
                </p>

                <button class="w-full py-3 bg-white text-blue-600 rounded-xl text-sm font-bold hover:bg-blue-50 transition">
                    View All
                </button>
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

                <!-- Regular Ticket -->
                <div class="bg-gradient-to-r from-[#111827] to-[#18181b] border border-white/10 rounded-2xl px-5 py-4 flex justify-between items-center">
                    <div>
                        <p class="text-blue-400 font-bold text-lg">
                            <i class="fa-solid fa-ticket mr-2"></i>Regular Ticket
                        </p>
                        <p class="text-xs text-gray-500 mt-1">Event Entry</p>
                    </div>

                    <div class="text-right">
                        <p class="text-xs text-gray-500">Stock: 100</p>
                        <p class="text-blue-400 text-xl font-bold">IDR 20.000</p>
                    </div>
                </div>

                <!-- VIP Ticket -->
                <div class="bg-gradient-to-r from-[#111827] to-[#18181b] border border-yellow-500/40 rounded-2xl px-5 py-4 flex justify-between items-center">
                    <div>
                        <p class="text-yellow-400 font-bold text-lg">
                            <i class="fa-solid fa-crown mr-2"></i>VIP Ticket
                        </p>
                        <p class="text-xs text-gray-500 mt-1">Exclusive Front Row + F&B</p>
                    </div>

                    <div class="text-right">
                        <p class="text-xs text-gray-500">Stock: 50</p>
                        <p class="text-blue-400 text-xl font-bold">IDR 50.000</p>
                    </div>
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

<!-- APPROVE MODAL -->
<div id="approveModal" class="fixed inset-0 bg-black/60 hidden items-center justify-center z-50">
    <div class="bg-[#1e1e1e] rounded-2xl p-6 w-[400px] border border-white/10 text-center">
        <div class="w-14 h-14 mx-auto mb-4 rounded-full bg-blue-500/20 flex items-center justify-center">
            <i class="fa-solid fa-check text-blue-400"></i>
        </div>

        <h2 class="text-lg font-bold mb-2">Approve Event</h2>
        <p class="text-sm text-gray-400 mb-6">
            Are you sure you want to approve this event?
        </p>

        <div class="flex gap-3">
            <button onclick="closeApprove()"
                class="flex-1 py-2 border border-white/10 rounded-xl">
                Cancel
            </button>

            <button onclick="closeApprove()"
                class="flex-1 py-2 bg-blue-500/20 text-blue-400 rounded-xl">
                Approve
            </button>
        </div>
    </div>
</div>

<!-- REJECT MODAL -->
<div id="rejectModal" class="fixed inset-0 bg-black/60 hidden items-center justify-center z-50">
    <div class="bg-[#1e1e1e] rounded-2xl p-6 w-[400px] border border-white/10 text-center">
        <div class="w-14 h-14 mx-auto mb-4 rounded-full bg-red-500/20 flex items-center justify-center">
            <i class="fa-solid fa-xmark text-red-400"></i>
        </div>

        <h2 class="text-lg font-bold mb-2">Reject Event</h2>
        <p class="text-sm text-gray-400 mb-6">
            Are you sure you want to reject this event?
        </p>

        <div class="flex gap-3">
            <button onclick="closeReject()"
                class="flex-1 py-2 border border-white/10 rounded-xl">
                Cancel
            </button>

            <button onclick="closeReject()"
                class="flex-1 py-2 bg-red-500/20 text-red-400 rounded-xl">
                Reject
            </button>
        </div>
    </div>
</div>
</div>


@endsection
