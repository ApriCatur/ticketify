<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ticketify | My Tickets</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;600;800&display=swap');
        body { font-family: 'Plus Jakarta Sans', sans-serif; }
        .glass { background: rgba(18, 18, 18, 0.8); backdrop-filter: blur(10px); }
        .ticket-card:hover { border-color: #3b82f6; background: rgba(59, 130, 246, 0.05); }
    </style>
</head>
<body class="bg-[#0f0f0f] text-white antialiased">

<div class="flex w-full min-h-screen border-x border-gray-800 bg-[#121212] shadow-2xl">
    @include('layouts.sidebar-pembeli')
        <div class="flex-1 flex flex-col min-w-0 border-r border-white/5">
            <nav class="sticky top-0 z-50 glass border-b border-white/5 px-8 py-4 flex justify-between items-center">

            <!-- TOMBOL HAMBURGER: Sekarang muncul di mobile (lg:hidden) -->
            <button id="open-sidebar" class="lg:hidden text-gray-400 hover:text-blue-500 transition-colors">
                <i class="fa-solid fa-bars-staggered text-2xl"></i>
            </button>

            <div>
                    <span class="text-sm text-gray-400 font-medium italic">Track your event journeys here.</span>
                </div>
                <div class="flex items-center gap-4">
                </div>
            </nav>

            <header class="p-8 pb-0">
                <h2 class="text-2xl font-black italic tracking-tighter mb-6">Ticket Summary</h2>
                <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
                    <div class="bg-[#1e1e1e] border border-white/5 p-6 rounded-2xl relative overflow-hidden group">
                        <i class="fa-solid fa-layer-group absolute -right-2 -bottom-2 text-5xl text-white/5 group-hover:text-blue-500/10 transition-colors"></i>
                        <p class="text-[10px] font-bold  uppercase tracking-widest mb-1 text-blue-600">Total Ticket</p>
                        <p class="text-3xl font-black italic">{{ $totalTickets }}</p>
                    </div>
                    <div class="bg-[#1e1e1e] border border-white/5 p-6 rounded-2xl relative overflow-hidden group">
                        <i class="fa-solid fa-circle-check absolute -right-2 -bottom-2 text-5xl text-white/5 group-hover:text-green-500/10 transition-colors"></i>
                        <p class="text-[10px] font-bold uppercase tracking-widest mb-1 text-green-500">Active</p>
                        <p class="text-3xl font-black italic">{{ $activeTickets }}</p>
                    </div>

                    <div class="bg-[#1e1e1e] border border-white/5 p-6 rounded-2xl relative overflow-hidden group">
                        <i class="fa-solid fa-clock-rotate-left absolute -right-2 -bottom-2 text-5xl text-white/5 group-hover:text-gray-500/10 transition-colors"></i>
                        <p class="text-[10px] font-bold uppercase tracking-widest mb-1 text-red-500">Used</p>
                        <p class="text-3xl font-black italic text-gray-500">{{ $usedTickets }}</p>
                    </div>

                    <div class="bg-[#1e1e1e] border border-white/5 p-6 rounded-2xl relative overflow-hidden group">
                        <i class="fa-solid fa-ban absolute -right-2 -bottom-2 text-5xl text-white/5 group-hover:text-red-500/10 transition-colors"></i>
                        <p class="text-[10px] font-bold uppercase tracking-widest mb-1 text-red-400">Canceled</p>
                        <p class="text-3xl font-black italic text-red-400">{{ $canceledTickets }}</p>
                    </div>
                </div>
            </header>

            <main class="p-8">
                <div class="flex justify-between items-center mb-6">
                    <h2 class="text-xl font-black italic uppercase tracking-widest">Purchase History</h2>
                    <div class="flex gap-2">
                        <button class="px-4 py-1.5 bg-white/5 border border-white/10 rounded-lg text-[10px] font-bold hover:bg-white/10 transition">Latest</button>
                        <button class="px-4 py-1.5 bg-white/5 border border-white/10 rounded-lg text-[10px] font-bold hover:bg-white/10 transition">All</button>
                    </div>
                </div>

                <!-- Daftar Tickets dari Database -->
                <div class="space-y-4">
                    @forelse($tickets as $ticket)
                        <div class="ticket-card flex flex-wrap md:flex-nowrap items-center gap-6 p-5 bg-[#1e1e1e] border border-white/5 rounded-2xl transition-all duration-300 {{ in_array($ticket->status, ['Used', 'Canceled']) ? 'opacity-60' : '' }}">
                            <!-- Event Banner -->
                            <div class="w-full md:w-32 h-20 bg-blue-500/20 rounded-xl overflow-hidden border border-blue-500/30 {{ in_array($ticket->status, ['Used', 'Canceled']) ? 'grayscale' : '' }}">
                                @if($ticket->event && $ticket->event->banner)
                                    <img src="{{ asset('images/events/' . $ticket->event->banner) }}" class="w-full h-full object-cover {{ in_array($ticket->status, ['Used', 'Canceled']) ? 'opacity-40' : 'opacity-60' }}" alt="Event">
                                @else
                                    <div class="w-full h-full bg-gradient-to-br from-blue-600 to-blue-800 flex items-center justify-center">
                                        <i class="fa-solid fa-ticket text-2xl text-white/50"></i>
                                    </div>
                                @endif
                            </div>

                            <!-- Event Info -->
                            <div class="flex-1">
                                @php
                                    $badgeColor = match($ticket->status) {
                                        'Active' => 'green',
                                        'Used' => 'red',
                                        'Canceled' => 'gray',
                                        default => 'gray',
                                    };
                                @endphp
                                <span class="px-2 py-0.5 bg-{{ $badgeColor }}-500 text-[9px] font-black rounded uppercase tracking-tighter">{{ $ticket->status }}</span>
                                <h3 class="text-lg font-black italic tracking-tight mt-1">{{ $ticket->event->name ?? 'Event Tidak Ditemukan' }}</h3>
                                <p class="text-xs text-gray-500 mt-1"><i class="fa-solid fa-calendar mr-2"></i>{{ $ticket->event->date ? \Carbon\Carbon::parse($ticket->event->date)->format('d M Y') : 'TBA' }}</p>
                            </div>

                            <!-- Ticket Type -->
                            <div class="flex-1">
                                <span class="px-2 py-0.5 bg-blue-500 text-[9px] font-black rounded uppercase tracking-tighter"><i class="fa-solid mr-2"></i>{{ $ticket->ticket_type }}</span>
                                <h3 class="text-lg font-black italic tracking-tight mt-1">Ticket Type</h3>
                                <p class="text-xs text-gray-500 mt-1"></p>
                            </div>

                            <!-- Purchase Date -->
                            <div class="text-right">
                                <p class="text-[10px] font-bold text-gray-500 uppercase">Date Purchased</p>
                                <p class="text-xs font-black text-white">{{ $ticket->created_at->format('d/m/Y H:i') }}</p>
                            </div>

                            <!-- Action Button -->
                            @if($ticket->status === 'Active')
                                <a href="{{ route('pembeli.ticketdigital', $ticket->id) }}" class="w-full md:w-auto px-6 py-2.5 bg-white text-black font-black rounded-xl text-[10px] uppercase hover:bg-blue-500 hover:text-white transition-all inline-block text-center">
                                    View Ticket
                                </a>
                            @elseif($ticket->status === 'Canceled')
                                <button type="button" onclick="openRefundModal({{ $ticket->id }})" class="w-full md:w-auto px-6 py-2.5 bg-red-500/10 border border-red-500/30 text-red-400 font-black rounded-xl text-[10px] hover:bg-red-500/20 transition-all uppercase">
                                    <i class="fa-solid fa-circle-info mr-1"></i> Refund Info
                                </button>
                            @else
                                <button class="w-full md:w-auto px-6 py-2.5 bg-white/5 border border-white/10 text-gray-500 font-black rounded-xl text-[10px] cursor-not-allowed uppercase">
                                    {{ $ticket->status === 'Used' ? 'Used' : 'Expired' }}
                                </button>
                            @endif
                        </div>
                    @empty
                        <div class="flex flex-col items-center justify-center py-12 text-center">
                            <i class="fa-solid fa-ticket text-6xl text-white/10 mb-4"></i>
                            <p class="text-gray-400 font-semibold mb-2">Belum Ada Tiket Pembelian</p>
                            <p class="text-gray-600 text-sm mb-4">Mulai cari event menarik dan beli tiket sekarang!</p>
                            <a href="{{ route('pembeli.event') }}" class="px-6 py-2.5 bg-blue-600 hover:bg-blue-700 text-white font-black rounded-xl text-sm transition">
                                Jelajahi Event
                            </a>
                        </div>
                    @endforelse
                </div>
            </main>

            <footer class="mt-auto bg-black/20 border-t border-white/5 p-8 text-center">
                <p class="text-[10px] font-bold text-gray-600 uppercase tracking-[0.3em]">&copy; 2026 Informatics Engineering - Polibatam</p>
            </footer>
        </div>
    </div>

    @php
        $refundData = [];
        foreach ($tickets as $t) {
            if ($t->status === 'Canceled' && $t->event) {
                $refundData[$t->id] = [
                    'name' => $t->event->name,
                    'unpublish_reason' => $t->event->unpublish_reason,
                    'refund_date' => $t->event->refund_date,
                    'refund_location' => $t->event->refund_location,
                    'refund_info' => $t->event->refund_info,
                ];
            }
        }
    @endphp

    {{-- ================= REFUND INFO MODAL ================= --}}
    <div id="refundModal" class="fixed inset-0 bg-black/60 hidden items-center justify-center z-50 p-4">
        <div class="bg-[#1e1e1e] rounded-2xl p-6 w-full max-w-md border border-white/10">
            <div class="flex items-center gap-3 mb-4">
                <div class="w-10 h-10 rounded-full bg-red-500/20 flex items-center justify-center flex-shrink-0">
                    <i class="fa-solid fa-circle-exclamation text-red-400"></i>
                </div>
                <div>
                    <h2 class="text-base font-bold">Event Dibatalkan</h2>
                    <p class="text-xs text-gray-400">Informasi refund tiket kamu</p>
                </div>
            </div>

            <div class="space-y-4">
                <div>
                    <p class="text-[10px] font-black text-gray-500 uppercase tracking-widest mb-1">Nama Event</p>
                    <p id="refundEventName" class="text-sm font-bold text-white">-</p>
                </div>

                <div>
                    <p class="text-[10px] font-black text-gray-500 uppercase tracking-widest mb-1">Alasan Pembatalan</p>
                    <p id="refundReason" class="text-sm text-gray-300 bg-white/5 rounded-xl p-3 border border-white/5">-</p>
                </div>

                <div class="grid grid-cols-2 gap-3">
                    <div>
                        <p class="text-[10px] font-black text-gray-500 uppercase tracking-widest mb-1">Tanggal Refund</p>
                        <p id="refundDate" class="text-sm font-bold text-white">-</p>
                    </div>
                    <div>
                        <p class="text-[10px] font-black text-gray-500 uppercase tracking-widest mb-1">Lokasi Refund</p>
                        <p id="refundLocation" class="text-sm font-bold text-white">-</p>
                    </div>
                </div>

                <div>
                    <p class="text-[10px] font-black text-gray-500 uppercase tracking-widest mb-1">Info Tambahan</p>
                    <p id="refundInfo" class="text-sm text-gray-300 bg-white/5 rounded-xl p-3 border border-white/5">-</p>
                </div>
            </div>

            <button type="button" onclick="closeRefundModal()" class="w-full mt-6 py-2.5 bg-white/10 rounded-xl text-sm font-bold hover:bg-white/20 transition">
                Tutup
            </button>
        </div>
    </div>

    <script>
        const refundData = @json($refundData);

        function openRefundModal(ticketId) {
            const data = refundData[ticketId] || {};

            document.getElementById('refundEventName').textContent = data.name || '-';
            document.getElementById('refundReason').textContent = data.unpublish_reason || '-';
            document.getElementById('refundDate').textContent = data.refund_date
                ? new Date(data.refund_date).toLocaleString('id-ID', { dateStyle: 'long', timeStyle: 'short' })
                : 'Belum ditentukan';
            document.getElementById('refundLocation').textContent = data.refund_location || 'Belum ditentukan';
            document.getElementById('refundInfo').textContent = data.refund_info || 'Tidak ada info tambahan';

            document.getElementById('refundModal').classList.remove('hidden');
            document.getElementById('refundModal').classList.add('flex');
        }

        function closeRefundModal() {
            document.getElementById('refundModal').classList.add('hidden');
            document.getElementById('refundModal').classList.remove('flex');
        }
    </script>

    <script>
    const openBtn = document.getElementById('open-sidebar');
    const closeBtn = document.getElementById('close-sidebar');
    const sidebar = document.getElementById('main-sidebar');
    const overlay = document.getElementById('sidebar-overlay');

    // Cek apakah elemen ada sebelum menjalankan fungsi
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
</body>
</html>
