@extends('layouts.admin')

@section('title', 'Pending Event')

{{-- Load Swiper CSS --}}
@push('styles')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
@endpush

@section('content')

{{-- NAVBAR --}}
<nav class="glass border-b border-white/5 px-8 py-4">
    <h2 class="text-2xl font-black">Pending Event</h2>
</nav>

{{-- 🔥 HERO CAROUSEL --}}
<header class="px-8 pt-6 pb-12">
    <div class="swiper myHeroSwiper rounded-3xl overflow-hidden shadow-2xl h-[420px] relative">

        <div class="swiper-wrapper h-full">

            @forelse($pendingEvents as $slide)
            <div class="swiper-slide relative h-full">
                <img src="{{ $slide->banner ? asset('images/events/' . $slide->banner) : asset('images/kmipn.jpeg') }}"
                    class="w-full h-full object-cover">
                <div class="absolute inset-0 bg-gradient-to-t from-black via-black/40 to-transparent"></div>
                <div class="absolute bottom-0 left-0 w-full p-8 z-20">
                    <span class="text-xs font-bold text-blue-400 uppercase tracking-widest bg-blue-500/20 px-3 py-1 rounded-full">
                        {{ $slide->category }}
                    </span>
                    <h2 class="text-4xl font-extrabold italic text-white mt-3">
                        {{ $slide->name }}
                    </h2>
                    <p class="text-gray-300 text-sm mt-2 max-w-lg">
                        {{ Str::limit($slide->description, 100) }}
                    </p>
                </div>
            </div>
            @empty
            {{-- Fallback slide kalau belum ada event --}}
            <div class="swiper-slide relative h-full">
                <img src="{{ asset('images/kmipn.jpeg') }}" class="w-full h-full object-cover">
                <div class="absolute inset-0 bg-gradient-to-t from-black via-black/40 to-transparent"></div>
                <div class="absolute bottom-0 left-0 w-full p-8 z-20">
                    <h2 class="text-4xl font-extrabold italic text-white">Belum ada event pending</h2>
                    <p class="text-gray-300 text-sm mt-2">Event yang diajukan panitia akan muncul di sini.</p>
                </div>
            </div>
            @endforelse

        </div>

        <!-- DOTS -->
        <div class="swiper-pagination absolute bottom-4 left-0 right-0 z-50"></div>
        <!-- ARROWS -->
        <div class="swiper-button-prev !text-white !w-10 !h-10 !bg-black/40 !backdrop-blur !rounded-full after:!text-sm"></div>
        <div class="swiper-button-next !text-white !w-10 !h-10 !bg-black/40 !backdrop-blur !rounded-full after:!text-sm"></div>
    </div>
</header>

{{-- SEARCH BAR --}}
<div class="px-8 -mt-10 relative z-30">
    <div class="bg-[#1e1e1e] border border-white/10 rounded-2xl p-4 shadow-2xl flex flex-wrap lg:flex-nowrap items-end gap-4">

        {{-- Search by name --}}
        <div class="flex-[2] min-w-[200px]">
            <label class="text-[9px] font-black text-gray-500 uppercase tracking-widest mb-2 block ml-1">Search Event Name</label>
            <div class="flex items-center gap-3 bg-white/5 rounded-xl px-4 py-3 border border-transparent focus-within:border-blue-500 transition">
                <i class="fa-solid fa-magnifying-glass text-blue-500"></i>
                <input id="searchName" type="text" placeholder="Seminar, workshop, konser..."
                    class="bg-transparent w-full outline-none border-none ring-0 focus:ring-0 text-sm text-gray-200">
            </div>
        </div>

        {{-- Filter by category --}}
        <div class="flex-1 min-w-[150px]">
            <label class="text-[9px] font-black text-gray-500 uppercase tracking-widest mb-2 block ml-1">Category</label>
            <div class="relative group">
                <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                    <i class="fa-solid fa-tags text-blue-500 text-[12px]"></i>
                </div>
                <select id="filterCategory" class="w-full bg-white/5 border border-transparent rounded-xl py-3 pl-10 pr-8 text-xs font-bold text-gray-300 focus:border-blue-500 outline-none transition-all appearance-none cursor-pointer">
                    <option value="" class="bg-[#1e1e1e]">Semua</option>
                    <option value="education" class="bg-[#1e1e1e]">Education</option>
                    <option value="music" class="bg-[#1e1e1e]">Music</option>
                    <option value="technology" class="bg-[#1e1e1e]">Technology</option>
                    <option value="art" class="bg-[#1e1e1e]">Art & Theater</option>
                    <option value="seminar" class="bg-[#1e1e1e]">Seminar</option>
                    <option value="workshop" class="bg-[#1e1e1e]">Workshop</option>
                </select>
                <div class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none text-gray-500">
                    <i class="fa-solid fa-chevron-down text-[10px]"></i>
                </div>
            </div>
        </div>

        {{-- Filter by date --}}
        <div class="flex-1 min-w-[150px]">
            <label class="text-[9px] font-black text-gray-500 uppercase tracking-widest mb-2 block ml-1">Select Date</label>
            <div class="relative group">
                <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                    <i class="fa-solid fa-calendar-day text-blue-500 text-[12px]"></i>
                </div>
                <input id="filterDate" type="date"
                    class="w-full bg-white/5 border border-transparent rounded-xl py-3 pl-10 pr-4 text-xs font-bold text-gray-300 focus:border-blue-500 outline-none transition-all cursor-pointer [color-scheme:dark]">
            </div>
        </div>

        <button id="btnReset" class="w-full lg:w-auto px-8 py-3.5 bg-white/10 text-white rounded-xl font-bold hover:bg-white/20 transition-all active:scale-95 hidden">
            Reset
        </button>

        <button id="btnCari" class="w-full lg:w-auto px-8 py-3.5 bg-white text-black rounded-xl font-bold hover:bg-blue-500 hover:text-white transition-all active:scale-95 shadow-lg">
            Cari Event
        </button>
    </div>
</div>

{{-- CONTENT --}}
<div class="flex gap-8 px-8 py-8">

    {{-- EVENT GRID --}}
    <div class="flex-1">

        {{-- Counter hasil search --}}
        <div id="searchInfo" class="hidden mb-4 text-sm text-gray-400">
            Menampilkan <span id="searchCount" class="text-white font-bold"></span> event
        </div>

        <div id="eventGrid" class="grid grid-cols-1 md:grid-cols-2 gap-6">

            @forelse($pendingEvents as $event)
                {{-- Data attribute untuk filter JS --}}
                <div class="event-card group bg-[#1e1e1e] border border-white/5 rounded-2xl overflow-hidden hover:border-blue-500/40 transition-all duration-300 hover:shadow-lg hover:shadow-blue-500/10"
                    data-name="{{ strtolower($event->name) }}"
                    data-category="{{ strtolower($event->category) }}"
                    data-date="{{ $event->date }}">

                    <div class="relative h-48 overflow-hidden">
                        {{-- ✅ FIX: Path banner sekarang pakai images/events/ --}}
                        <img src="{{ $event->banner ? asset('images/events/' . $event->banner) : asset('images/kmipn.jpeg') }}"
                            class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500"
                            onerror="this.src='{{ asset('images/kmipn.jpeg') }}'">

                        <div class="absolute top-3 right-3 bg-black/60 backdrop-blur-md px-3 py-2 rounded-xl text-center border border-white/10">
                            <span class="block text-[10px] font-bold text-blue-400 uppercase">{{ \Carbon\Carbon::parse($event->date)->format('M') }}</span>
                            <span class="block text-lg font-black">{{ \Carbon\Carbon::parse($event->date)->format('d') }}</span>
                            <span class="text-[10px] text-gray-500">{{ \Carbon\Carbon::parse($event->date)->format('Y') }}</span>
                        </div>
                    </div>

                    <div class="p-5">
                        <span class="text-[10px] font-bold text-yellow-500 uppercase tracking-widest">⏳ Pending</span>

                        <h3 class="font-bold text-lg mt-2 mb-3 group-hover:text-blue-400 transition">
                            {{ $event->name }}
                        </h3>

                        <div class="space-y-2 text-xs text-gray-400 mb-5">
                            <div class="flex items-center gap-2">
                                <i class="fa-solid fa-location-dot text-blue-500"></i>
                                {{ $event->location }}
                            </div>
                            <div class="flex items-center gap-2">
                                <i class="fa-regular fa-clock text-blue-500"></i>
                                {{ \Carbon\Carbon::parse($event->time_start)->format('H:i') }} – {{ \Carbon\Carbon::parse($event->time_end)->format('H:i') }} WIB
                            </div>
                            <div class="flex items-center gap-2">
                                <i class="fa-solid fa-ticket text-blue-500"></i>
                                @php $minPrice = $event->tickets->whereNull('order_id')->min('price'); @endphp
                                From IDR {{ $minPrice ? number_format($minPrice, 0, ',', '.') : 'Gratis' }}
                            </div>
                        </div>

                        <div class="flex gap-2 pt-4 border-t border-white/5">
                            <form action="{{ route('admin.events.approve', $event) }}" method="POST" class="flex-1">
                                @csrf
                                <button type="submit"
                                    class="w-full py-2 bg-blue-600 text-white rounded-xl text-xs font-semibold hover:bg-blue-500 transition">
                                    ✓ Approve
                                </button>
                            </form>

                            <form action="{{ route('admin.events.reject', $event) }}" method="POST" class="flex-1">
                                @csrf
                                <button type="submit"
                                    class="w-full py-2 bg-red-500/10 text-red-400 rounded-xl text-xs hover:bg-red-500/20 transition">
                                    ✕ Reject
                                </button>
                            </form>

                            <button type="button"
                                class="px-4 py-2 border border-white/10 rounded-xl text-xs hover:bg-white/5 transition"
                                data-event='@json($event)'
                                onclick="openDetailFromElement(this)">
                                Detail
                            </button>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-span-2 text-center text-gray-400 py-20 bg-[#1e1e1e] border border-white/5 rounded-3xl">
                    <i class="fa-solid fa-calendar-xmark text-4xl mb-4 text-gray-600"></i>
                    <p>Tidak ada event pending saat ini.</p>
                </div>
            @endforelse

            {{-- Pesan tidak ditemukan saat filter --}}
            <div id="noResult" class="col-span-2 text-center text-gray-400 py-20 bg-[#1e1e1e] border border-white/5 rounded-3xl hidden">
                <i class="fa-solid fa-magnifying-glass text-4xl mb-4 text-gray-600"></i>
                <p>Tidak ada event yang cocok dengan pencarian.</p>
            </div>

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
                    @forelse($pendingEvents->take(3) as $upcoming)
                    <div class="p-4 bg-[#1e1e1e] rounded-2xl border border-white/5 hover:border-blue-500/30 transition">
                        <p class="font-bold text-sm truncate">{{ $upcoming->name }}</p>
                        <p class="text-xs text-gray-500 mt-1">
                            {{ \Carbon\Carbon::parse($upcoming->date)->format('d M Y') }} •
                            {{ \Carbon\Carbon::parse($upcoming->time_start)->format('H:i') }}
                        </p>
                    </div>
                    @empty
                    <p class="text-xs text-gray-500">Belum ada event.</p>
                    @endforelse
                </div>
            </div>

            <div class="p-6 bg-gradient-to-br from-blue-600 to-blue-900 rounded-2xl">
                <h4 class="font-black mb-2">Need Review?</h4>
                <p class="text-xs text-blue-100 mb-4">
                    Check all submitted events before publishing.
                </p>
                <div class="text-2xl font-black text-white">
                    {{ $pendingEvents->count() }} <span class="text-sm font-normal text-blue-200">pending</span>
                </div>
            </div>

        </div>
    </aside>

</div>

{{-- ================= MODAL DETAIL ================= --}}
<div id="detailModal" class="fixed inset-0 bg-black/70 hidden items-center justify-center z-50 p-4">
    <div class="bg-[#18181b] w-full max-w-5xl max-h-[90vh] rounded-3xl border border-white/10 overflow-hidden shadow-2xl">

        <div class="bg-green-600 px-6 py-4 flex justify-between items-center">
            <div class="flex items-center gap-2">
                <i class="fa-solid fa-eye text-white"></i>
                <h2 class="text-white font-bold text-lg">Detail Event</h2>
            </div>
            <button onclick="closeDetail()" class="text-white text-xl hover:opacity-70 transition">
                <i class="fa-solid fa-xmark"></i>
            </button>
        </div>

        <div class="p-6 space-y-6 overflow-y-auto max-h-[calc(90vh-140px)]">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 items-start">

                <div>
                    <div class="rounded-2xl overflow-hidden border border-white/10">
                        <img id="detailPoster" src="" alt="Poster Event"
                            class="w-full h-[340px] object-cover"
                            onerror="this.src='{{ asset('images/kmipn.jpeg') }}'">
                    </div>
                </div>

                <div class="space-y-5">
                    <div class="flex items-start gap-4">
                        <div class="bg-blue-500/20 text-blue-400 rounded-xl px-4 py-3 text-center min-w-[60px]">
                            <p id="detailDay" class="text-xl font-bold">-</p>
                            <p id="detailMonth" class="text-xs uppercase">-</p>
                        </div>
                        <div>
                            <p class="text-xs text-gray-400 uppercase">Waktu Pelaksanaan</p>
                            <p id="detailTime" class="font-bold text-xl">-</p>
                            <p id="detailDate" class="text-sm text-gray-400">-</p>
                        </div>
                    </div>

                    <div>
                        <p class="text-xs text-gray-400 uppercase">Nama Event</p>
                        <h3 id="detailTitle" class="text-blue-400 font-bold text-2xl">-</h3>
                    </div>

                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <p class="text-xs text-gray-400 uppercase">Lokasi</p>
                            <p id="detailLocation" class="text-sm">-</p>
                        </div>
                        <div>
                            <p class="text-xs text-gray-400 uppercase">Kategori</p>
                            <p id="detailCategory" class="text-sm">-</p>
                        </div>
                    </div>

                    <div>
                        <p class="text-xs text-gray-400 uppercase">Deskripsi</p>
                        <div class="bg-white/5 border border-white/10 rounded-xl p-4 text-sm text-gray-300 leading-relaxed max-h-32 overflow-y-auto">
                            <span id="detailDesc">-</span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="space-y-4">
                <h3 class="text-xl font-bold">Available Tickets</h3>
                <div id="detailTickets" class="space-y-3"></div>
            </div>
        </div>

        <div class="px-6 py-4 border-t border-white/10 text-right">
            <button onclick="closeDetail()"
                class="px-6 py-2 bg-white/10 rounded-xl text-sm hover:bg-white/20 transition">
                Tutup
            </button>
        </div>
    </div>
</div>

{{-- ================= APPROVE MODAL ================= --}}
<div id="approveModal" class="fixed inset-0 bg-black/60 hidden items-center justify-center z-50">
    <div class="bg-[#1e1e1e] rounded-2xl p-6 w-[400px] border border-white/10 text-center">
        <div class="w-14 h-14 mx-auto mb-4 rounded-full bg-blue-500/20 flex items-center justify-center">
            <i class="fa-solid fa-check text-blue-400 text-xl"></i>
        </div>
        <h2 class="text-lg font-bold mb-2">Approve Event</h2>
        <p class="text-sm text-gray-400 mb-6">Are you sure you want to approve this event?</p>
        <div class="flex gap-3">
            <button onclick="closeApprove()" class="flex-1 py-2 border border-white/10 rounded-xl hover:bg-white/5 transition">Cancel</button>
            <button onclick="closeApprove()" class="flex-1 py-2 bg-blue-500/20 text-blue-400 rounded-xl hover:bg-blue-500/30 transition">Approve</button>
        </div>
    </div>
</div>

{{-- ================= REJECT MODAL ================= --}}
<div id="rejectModal" class="fixed inset-0 bg-black/60 hidden items-center justify-center z-50">
    <div class="bg-[#1e1e1e] rounded-2xl p-6 w-[400px] border border-white/10 text-center">
        <div class="w-14 h-14 mx-auto mb-4 rounded-full bg-red-500/20 flex items-center justify-center">
            <i class="fa-solid fa-xmark text-red-400 text-xl"></i>
        </div>
        <h2 class="text-lg font-bold mb-2">Reject Event</h2>
        <p class="text-sm text-gray-400 mb-6">Are you sure you want to reject this event?</p>
        <div class="flex gap-3">
            <button onclick="closeReject()" class="flex-1 py-2 border border-white/10 rounded-xl hover:bg-white/5 transition">Cancel</button>
            <button onclick="closeReject()" class="flex-1 py-2 bg-red-500/20 text-red-400 rounded-xl hover:bg-red-500/30 transition">Reject</button>
        </div>
    </div>
</div>

{{-- ================= SWIPER + JS ================= --}}
<script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
<script>
// ── 1. SWIPER CAROUSEL ──────────────────────────────────────────
const swiper = new Swiper('.myHeroSwiper', {
    loop: true,
    autoplay: { delay: 4000, disableOnInteraction: false },
    pagination: { el: '.swiper-pagination', clickable: true },
    navigation: {
        nextEl: '.swiper-button-next',
        prevEl: '.swiper-button-prev',
    },
    effect: 'fade',
    fadeEffect: { crossFade: true },
});

// ── 2. LIVE SEARCH & FILTER ─────────────────────────────────────
const cards      = document.querySelectorAll('.event-card');
const searchName = document.getElementById('searchName');
const filterCat  = document.getElementById('filterCategory');
const filterDate = document.getElementById('filterDate');
const noResult   = document.getElementById('noResult');
const searchInfo = document.getElementById('searchInfo');
const searchCount= document.getElementById('searchCount');
const btnReset   = document.getElementById('btnReset');

function applyFilter() {
    const name = searchName.value.toLowerCase().trim();
    const cat  = filterCat.value.toLowerCase().trim();
    const date = filterDate.value;

    let visible = 0;

    cards.forEach(card => {
        const cardName = card.dataset.name || '';
        const cardCat  = card.dataset.category || '';
        const cardDate = card.dataset.date || '';

        const matchName = !name || cardName.includes(name);
        const matchCat  = !cat  || cardCat.includes(cat);
        const matchDate = !date || cardDate === date;

        if (matchName && matchCat && matchDate) {
            card.classList.remove('hidden');
            visible++;
        } else {
            card.classList.add('hidden');
        }
    });

    // Tampilkan pesan kosong
    noResult.classList.toggle('hidden', visible > 0);

    // Tampilkan info jumlah hasil
    const hasFilter = name || cat || date;
    searchInfo.classList.toggle('hidden', !hasFilter);
    if (hasFilter) searchCount.textContent = visible;

    // Tampilkan tombol reset kalau ada filter aktif
    btnReset.classList.toggle('hidden', !hasFilter);
}

// Live filter saat ketik
searchName.addEventListener('input', applyFilter);
filterCat.addEventListener('change', applyFilter);
filterDate.addEventListener('change', applyFilter);

// Tombol Cari
document.getElementById('btnCari').addEventListener('click', applyFilter);

// Tombol Reset
btnReset.addEventListener('click', () => {
    searchName.value = '';
    filterCat.value  = '';
    filterDate.value = '';
    applyFilter();
});

// ── 3. MODAL DETAIL ─────────────────────────────────────────────
function openDetailFromElement(btn) {
    const data = JSON.parse(btn.getAttribute('data-event'));

    // Banner — pakai path images/events/
    const bannerBase = '{{ asset('images/events/') }}/';
    const fallback   = '{{ asset('images/kmipn.jpeg') }}';
    document.getElementById('detailPoster').src = data.banner ? bannerBase + data.banner : fallback;

    // Tanggal
    if (data.date) {
        const d = new Date(data.date);
        document.getElementById('detailDay').textContent   = d.getDate();
        document.getElementById('detailMonth').textContent = d.toLocaleString('id-ID', { month: 'short' });
        document.getElementById('detailDate').textContent  = d.toLocaleDateString('id-ID', { day: 'numeric', month: 'long', year: 'numeric' });
    }

    // Waktu
    const timeStr = data.time_start ? data.time_start.slice(0,5) : '-';
    const timeEnd = data.time_end   ? data.time_end.slice(0,5)   : '-';
    document.getElementById('detailTime').textContent = timeStr + ' – ' + timeEnd + ' WIB';

    // Info lain
    document.getElementById('detailTitle').textContent    = data.name     || '-';
    document.getElementById('detailLocation').textContent = data.location || '-';
    document.getElementById('detailCategory').textContent = data.category || '-';
    document.getElementById('detailDesc').textContent     = data.description || '-';

    // Tickets
    const ticketBox = document.getElementById('detailTickets');
    ticketBox.innerHTML = '';

    let tickets = [];
    try { tickets = typeof data.ticket_types === 'string' ? JSON.parse(data.ticket_types) : (data.ticket_types || []); }
    catch(e) { tickets = []; }

    if (tickets.length > 0) {
        tickets.forEach(t => {
            const price = parseInt(t.price || 0).toLocaleString('id-ID');
            ticketBox.innerHTML += `
                <div class="flex items-center justify-between p-4 bg-white/5 border border-white/10 rounded-xl">
                    <div>
                        <p class="font-bold text-sm">${t.name || 'Tiket'}</p>
                        <p class="text-xs text-gray-400">Stok: ${t.stock ?? '-'}</p>
                    </div>
                    <div class="text-right">
                        <p class="font-bold text-blue-400">IDR ${price}</p>
                    </div>
                </div>`;
        });
    } else {
        ticketBox.innerHTML = '<p class="text-sm text-gray-500">Tidak ada data tiket.</p>';
    }

    const modal = document.getElementById('detailModal');
    modal.classList.remove('hidden');
    modal.classList.add('flex');
}

function closeDetail() {
    const modal = document.getElementById('detailModal');
    modal.classList.add('hidden');
    modal.classList.remove('flex');
}

function closeApprove() {
    const m = document.getElementById('approveModal');
    m.classList.add('hidden'); m.classList.remove('flex');
}
function closeReject() {
    const m = document.getElementById('rejectModal');
    m.classList.add('hidden'); m.classList.remove('flex');
}

// Tutup modal klik di luar
['detailModal','approveModal','rejectModal'].forEach(id => {
    document.getElementById(id).addEventListener('click', function(e) {
        if (e.target === this) {
            this.classList.add('hidden');
            this.classList.remove('flex');
        }
    });
});
</script>

@endsection
