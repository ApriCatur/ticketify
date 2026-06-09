<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ticketify | Pending Events</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;600;800&display=swap');
        body { font-family: 'Plus Jakarta Sans', sans-serif; }
        .glass { background: rgba(18, 18, 18, 0.8); backdrop-filter: blur(10px); }
        ::-webkit-scrollbar { width: 6px; }
        ::-webkit-scrollbar-track { background: #0f0f0f; }
        ::-webkit-scrollbar-thumb { background: #333; border-radius: 10px; }
        .swiper-pagination-bullet { background: #fff; opacity: 0.5; }
        .swiper-pagination-bullet-active { background: #3b82f6; opacity: 1; width: 20px; border-radius: 5px; transition: all 0.3s; }
    </style>
</head>
<body class="bg-[#0f0f0f] text-white antialiased">

    <div class="flex w-full min-h-screen border-x border-gray-800 bg-[#121212] shadow-2xl">

        @include('layouts.sidebar-admin')

        <div class="flex-1 flex flex-col min-w-0 border-r border-white/5">
            <nav class="sticky top-0 z-50 glass border-b border-white/5 px-8 py-4 flex justify-between items-center">
                <button id="open-sidebar" class="lg:hidden text-gray-400 hover:text-blue-500 transition-colors">
                    <i class="fa-solid fa-bars-staggered text-2xl"></i>
                </button>

                <div class="hidden lg:block">
                    <span class="text-sm text-gray-400 font-medium italic">Pending Events — Review event yang diajukan panitia</span>
                </div>
            </nav>

            @include('components.event-carousel')

            <div class="px-8 mt-6">
                <x-event-filter :categories="$categories" />
            </div>

            @if(session('success'))
                <div class="mx-8 mt-6 p-4 bg-emerald-500/10 border border-emerald-500/20 text-emerald-400 rounded-2xl text-sm flex items-center gap-3">
                    <i class="fa-solid fa-circle-check text-base"></i>
                    <span>{{ session('success') }}</span>
                </div>
            @endif

            @if(session('error'))
                <div class="mx-8 mt-6 p-4 bg-red-500/10 border border-red-500/20 text-red-400 rounded-2xl text-sm flex items-center gap-3">
                    <i class="fa-solid fa-circle-exclamation text-base"></i>
                    <span>{{ session('error') }}</span>
                </div>
            @endif

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 px-8 pb-8 mt-6">
                @forelse($pendingEvents as $event)
                    <x-event-card
                        :image="$event->banner ? asset('images/events/' . $event->banner) : asset('images/events/banner_1779635248.jpg')"
                        :day="\Carbon\Carbon::parse($event->date)->format('d')"
                        :month="\Carbon\Carbon::parse($event->date)->translatedFormat('M')"
                        :year="\Carbon\Carbon::parse($event->date)->format('Y')"
                        :category="$event->category?->name"
                        :title="$event->name"
                        :location="$event->location"
                        :startTime="\Carbon\Carbon::parse($event->time_start)->format('H:i')"
                        :endTime="\Carbon\Carbon::parse($event->time_end)->format('H:i')"
                        :price="$event->tickets->whereNull('order_id')->min('price') ? 'Rp ' . number_format($event->tickets->whereNull('order_id')->min('price'), 0, ',', '.') : 'Gratis'"
                    >
                        <button type="button"
                            class="px-4 py-2 bg-white/10 hover:bg-white/20 rounded-lg text-xs font-bold transition"
                            data-event='@json($event->load('tickets'))'
                            onclick="openDetailFromElement(this)">
                            Detail
                        </button>
                        <button type="button"
                            class="px-4 py-2 bg-blue-600 hover:bg-blue-500 rounded-lg text-xs font-bold transition"
                            data-event='@json($event)'
                            onclick="openApproveModal(this)">
                            Approve
                        </button>
                        <button type="button"
                            class="px-4 py-2 bg-red-500/10 hover:bg-red-500/20 text-red-400 rounded-lg text-xs font-bold transition"
                            data-event='@json($event)'
                            onclick="openRejectModal(this)">
                            Reject
                        </button>
                    </x-event-card>
                @empty
                    <div class="col-span-full text-center text-gray-400 py-20 bg-[#1e1e1e] border border-white/5 rounded-3xl">
                        <i class="fa-solid fa-calendar-xmark text-3xl text-gray-600 mb-3 block"></i>
                        Belum ada event pending.
                    </div>
                @endforelse
            </div>

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
                            @php $eventDate = \Carbon\Carbon::parse($upEvent->date); @endphp
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

    {{-- ================= DETAIL MODAL ================= --}}
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
                            <img id="detailPoster" src="" alt="Poster Event" class="w-full h-[340px] object-cover">
                        </div>
                    </div>
                    <div class="space-y-5">
                        <div class="flex items-start gap-4">
                            <div id="detailDateBox" class="bg-blue-500/20 text-blue-400 rounded-xl px-4 py-3 text-center">
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
                <button onclick="closeDetail()" class="px-6 py-2 bg-white/10 rounded-xl text-sm hover:bg-white/20 transition">Tutup</button>
            </div>
        </div>
    </div>

    {{-- ================= APPROVE MODAL ================= --}}
    <div id="approveModal" class="fixed inset-0 bg-black/60 hidden items-center justify-center z-50 p-4">
        <div class="bg-[#1e1e1e] rounded-2xl p-6 w-full max-w-md border border-white/10">
            <div class="flex items-center gap-3 mb-4">
                <div class="w-10 h-10 rounded-full bg-blue-500/20 flex items-center justify-center flex-shrink-0">
                    <i class="fa-solid fa-check text-blue-400"></i>
                </div>
                <div>
                    <h2 class="text-base font-bold">Approve Event</h2>
                    <p class="text-xs text-gray-400">Event akan langsung dipublikasikan</p>
                </div>
            </div>

            <p class="text-sm text-gray-300 mb-6">
                Yakin ingin menyetujui <span id="approveEventName" class="text-white font-bold">event ini</span>?
            </p>

            <form id="approveForm" method="POST">
                @csrf
                <div class="flex gap-3">
                    <button type="button" onclick="closeApproveModal()"
                        class="flex-1 py-2.5 border border-white/10 rounded-xl text-sm hover:bg-white/5 transition">Batal</button>
                    <button type="submit"
                        class="flex-1 py-2.5 bg-blue-600 text-white rounded-xl text-sm font-bold hover:bg-blue-500 transition">
                        <i class="fa-solid fa-check mr-1"></i> Approve
                    </button>
                </div>
            </form>
        </div>
    </div>

    {{-- ================= REJECT MODAL ================= --}}
    <div id="rejectModal" class="fixed inset-0 bg-black/60 hidden items-center justify-center z-50 p-4">
        <div class="bg-[#1e1e1e] rounded-2xl p-6 w-full max-w-md border border-white/10">
            <div class="flex items-center gap-3 mb-4">
                <div class="w-10 h-10 rounded-full bg-red-500/20 flex items-center justify-center flex-shrink-0">
                    <i class="fa-solid fa-xmark text-red-400"></i>
                </div>
                <div>
                    <h2 class="text-base font-bold">Reject Event</h2>
                    <p class="text-xs text-gray-400">Event akan dipindahkan ke status
                        <span class="text-red-400 font-bold">Rejected</span>
                    </p>
                </div>
            </div>

            <p class="text-sm text-gray-300 mb-4">
                Tolak <span id="rejectEventName" class="text-white font-bold">event ini</span>?
            </p>

            <form id="rejectForm" method="POST">
                @csrf
                <div class="mb-4">
                    <label class="text-[10px] font-black text-gray-500 uppercase tracking-widest mb-2 block">
                        Alasan Reject <span class="text-red-400">*</span>
                    </label>
                    <textarea name="reason" id="rejectReason" rows="4"
                        placeholder="Jelaskan alasan mengapa event ini ditolak... (min. 10 karakter)"
                        class="w-full bg-white/5 border border-white/10 rounded-xl p-3 text-sm text-gray-200 outline-none focus:border-red-500/50 transition resize-none placeholder:text-gray-600"
                        maxlength="500"></textarea>
                    <div class="flex justify-between mt-1">
                        <p id="rejectReasonError" class="text-xs text-red-400 hidden">Alasan minimal 10 karakter.</p>
                        <p class="text-xs text-gray-600 ml-auto"><span id="rejectReasonCount">0</span>/500</p>
                    </div>
                </div>

                <div class="flex gap-3">
                    <button type="button" onclick="closeRejectModal()"
                        class="flex-1 py-2.5 border border-white/10 rounded-xl text-sm hover:bg-white/5 transition">Batal</button>
                    <button type="submit"
                        class="flex-1 py-2.5 bg-red-500 text-white rounded-xl text-sm font-bold hover:bg-red-600 transition">
                        <i class="fa-solid fa-xmark mr-1"></i> Reject
                    </button>
                </div>
            </form>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const el = document.querySelector('.myHeroSwiper');
            if (el) {
                new Swiper(el, {
                    loop: true,
                    autoplay: { delay: 5000, disableOnInteraction: false },
                    pagination: { el: '.swiper-pagination', clickable: true },
                    effect: 'fade',
                    fadeEffect: { crossFade: true },
                });
            }
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

    <script>
        function openDetailFromElement(btn) {
            const event = JSON.parse(btn.getAttribute('data-event'));
            const date = new Date(event.date);
            const day = String(date.getDate()).padStart(2, '0');
            const months = ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Ags', 'Sep', 'Okt', 'Nov', 'Des'];
            const month = months[date.getMonth()];
            const fullDate = `${day} ${month} ${date.getFullYear()}`;

            document.getElementById('detailPoster').src = event.banner
                ? `{{ asset('images/events') }}/${event.banner}`
                : 'https://via.placeholder.com/600x750';
            document.getElementById('detailDay').textContent = day;
            document.getElementById('detailMonth').textContent = month;
            document.getElementById('detailDate').textContent = fullDate;
            document.getElementById('detailTime').textContent = `${event.time_start.slice(0, 5)} WIB`;
            document.getElementById('detailTitle').textContent = event.name;
            document.getElementById('detailLocation').textContent = event.location || '-';
            document.getElementById('detailCategory').textContent = event.category?.name || event.category || '-';
            document.getElementById('detailDesc').textContent = event.description || 'Tidak ada deskripsi.';

            const ticketContainer = document.getElementById('detailTickets');
            ticketContainer.innerHTML = '';
            if (event.tickets && event.tickets.length > 0) {
                event.tickets.forEach(t => {
                    const div = document.createElement('div');
                    div.className = 'flex justify-between items-center bg-white/5 border border-white/10 rounded-xl p-4';
                    div.innerHTML = `
                        <div>
                            <p class="font-bold text-sm">${t.ticket_type || 'Reguler'}</p>
                            <p class="text-xs text-gray-400 mt-1">Stok: ${t.stock ?? 'Unlimited'}</p>
                        </div>
                        <div class="text-right">
                            <p class="font-black text-blue-400">${t.price ? 'Rp ' + Number(t.price).toLocaleString('id-ID') : 'Gratis'}</p>
                        </div>
                    `;
                    ticketContainer.appendChild(div);
                });
            } else {
                ticketContainer.innerHTML = '<p class="text-gray-500 text-sm">Tidak ada tiket tersedia.</p>';
            }

            document.getElementById('detailModal').classList.remove('hidden');
            document.getElementById('detailModal').classList.add('flex');
        }

        function closeDetail() {
            document.getElementById('detailModal').classList.add('hidden');
            document.getElementById('detailModal').classList.remove('flex');
        }

        function openApproveModal(btn) {
            const event = JSON.parse(btn.getAttribute('data-event'));
            document.getElementById('approveEventName').textContent = event.name;
            const form = document.getElementById('approveForm');
            form.action = `{{ url('admin/events') }}/${event.id}/approve`;
            document.getElementById('approveModal').classList.remove('hidden');
            document.getElementById('approveModal').classList.add('flex');
        }

        function closeApproveModal() {
            document.getElementById('approveModal').classList.add('hidden');
            document.getElementById('approveModal').classList.remove('flex');
        }

        function openRejectModal(btn) {
            const event = JSON.parse(btn.getAttribute('data-event'));
            document.getElementById('rejectEventName').textContent = event.name;
            const form = document.getElementById('rejectForm');
            form.action = `{{ url('admin/events') }}/${event.id}/reject`;
            document.getElementById('rejectReason').value = '';
            document.getElementById('rejectReasonCount').textContent = '0';
            document.getElementById('rejectReasonError').classList.add('hidden');
            document.getElementById('rejectModal').classList.remove('hidden');
            document.getElementById('rejectModal').classList.add('flex');
        }

        function closeRejectModal() {
            document.getElementById('rejectModal').classList.add('hidden');
            document.getElementById('rejectModal').classList.remove('flex');
        }

        document.getElementById('rejectReason')?.addEventListener('input', function() {
            document.getElementById('rejectReasonCount').textContent = this.value.length;
            if (this.value.length >= 10) {
                document.getElementById('rejectReasonError').classList.add('hidden');
            }
        });

        document.getElementById('rejectForm')?.addEventListener('submit', function(e) {
            const reason = document.getElementById('rejectReason').value;
            if (reason.length < 10) {
                e.preventDefault();
                document.getElementById('rejectReasonError').classList.remove('hidden');
            }
        });
    </script>

</body>
</html>