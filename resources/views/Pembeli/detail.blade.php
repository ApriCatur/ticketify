<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ticketify - {{ $event->name }}</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

    {{-- Midtrans Snap JS (Sandbox) --}}
    <script type="text/javascript"
        src="https://app.sandbox.midtrans.com/snap/snap.js"
        data-client-key="{{ config('midtrans.client_key') }}">
    </script>

    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>

<body class="bg-[#09090b] text-white min-h-screen p-6 md:p-10" x-data="{ tab: 'ticket' }">
<div class="max-w-6xl mx-auto space-y-8">

    {{-- ===== HEADER ===== --}}
    <header class="flex items-center justify-between">
        <div class="flex items-center gap-4">
            <button onclick="window.history.back()"
                class="bg-[#18181b] hover:bg-white hover:text-black transition-all px-4 py-2 rounded-lg text-xs font-bold border border-white/5 flex items-center gap-2 cursor-pointer">
                <i class="fa-solid fa-arrow-left"></i> Kembali
            </button>
            <div>
                <h1 class="text-2xl font-black uppercase">{{ $event->name }}</h1>
                <p class="text-xs text-gray-500 mt-1">{{ $event->category?->name }}</p>
            </div>
        </div>

        <div class="bg-blue-500/10 border border-blue-500/20 px-4 py-2 rounded-lg">
            <span class="text-blue-400 text-xs font-bold uppercase tracking-wider">
                <i class="fa-solid fa-check-circle mr-1"></i> Tersedia
            </span>
        </div>
    </header>

    {{-- ===== TAB NAVIGATION ===== --}}
    <nav class="border-b border-white/5 flex justify-center">
        <div class="flex gap-2">
            @php
                $tabs = [
                    'ticket'    => ['icon' => 'fa-ticket',       'label' => 'Ticket'],
                    'details'   => ['icon' => 'fa-circle-info',  'label' => 'Details'],
                    'organiser' => ['icon' => 'fa-users',        'label' => 'Organiser'],
                ];
            @endphp

            @foreach ($tabs as $key => $item)
                <button @click="tab = '{{ $key }}'"
                        :class="tab === '{{ $key }}'
                            ? 'border-b-2 border-blue-500 text-blue-500'
                            : 'text-gray-500 hover:text-gray-300'"
                        class="pb-4 px-4 font-bold text-sm transition-all flex items-center gap-2">
                    <i class="fa-solid {{ $item['icon'] }}"></i>
                    {{ $item['label'] }}
                </button>
            @endforeach
        </div>
    </nav>

    {{-- ===== TAB CONTENT ===== --}}
    <main class="bg-[#121212] rounded-3xl p-8 border border-white/5 shadow-2xl">

        {{-- TAB: TICKET --}}
        <div x-show="tab === 'ticket'" x-transition>
            <div class="grid md:grid-cols-2 gap-10 mb-10 pb-10 border-b border-white/5">
                <div class="rounded-2xl overflow-hidden border border-white/10 shadow-lg aspect-video">
                    <img src="{{ $event->banner ? asset('images/events/' . $event->banner) : asset('images/kmipn.jpeg') }}"
                         alt="Banner {{ $event->name }}"
                         class="w-full h-full object-cover">
                </div>

                <div class="space-y-4">
                    <div class="bg-[#18181b] p-4 rounded-xl border border-white/5 flex items-center gap-3">
                        <i class="fa-solid fa-qrcode text-blue-500"></i>
                        @if ($event->social_link)
                            <a href="{{ $event->social_link }}" target="_blank" rel="noopener"
                               class="text-sm font-bold text-blue-400 hover:text-blue-300 truncate">
                               Open Event Social Media
                            </a>
                        @else
                            <span class="text-sm font-bold text-gray-500">Social media not available</span>
                        @endif
                    </div>

                    <div class="bg-[#18181b] p-5 rounded-2xl border border-white/5">
                        <h4 class="text-blue-500 font-bold text-sm mb-2">
                            <i class="fa-solid fa-location-dot text-red-500 mr-2"></i>Location
                        </h4>
                        <p class="text-xs text-gray-300 font-bold leading-relaxed">{{ $event->location }}</p>
                    </div>

                    <p class="text-sm font-bold text-gray-400">
                        <i class="fa-solid fa-calendar-days mr-2 text-blue-500"></i>
                        {{ \Carbon\Carbon::parse($event->date)->format('d F Y') }},
                        {{ substr($event->time_start, 0, 5) }} WIB
                    </p>
                </div>
            </div>

            {{-- ===== FORM PILIH TIKET ===== --}}
            <div class="space-y-4 max-w-4xl mx-auto" x-data="ticketApp()">
                <h3 class="font-bold text-lg mb-4">Pilih Tipe Tiket</h3>

                @forelse ($event->tickets->whereNull('order_id') as $index => $ticket)
                    <div class="bg-[#18181b] p-6 rounded-2xl border border-white/5 flex items-center justify-between hover:border-blue-500/30 transition-all">
                        <div>
                            <h3 class="font-bold"><i class="fa-solid fa-ticket text-blue-500 mr-2"></i> {{ $ticket->ticket_type }}</h3>
                            <span class="text-[10px] text-gray-500">Stok tersedia: {{ $ticket->stock ?? 0 }}</span>
                        </div>
                        <div class="flex items-center gap-6">
                            <span class="font-black text-blue-400">
                                @if(($ticket->price ?? 0) == 0)
                                    GRATIS
                                @else
                                    IDR {{ number_format($ticket->price, 0, ',', '.') }}
                                @endif
                            </span>

                            {{-- Counter Plus/Minus --}}
                            <div class="flex items-center bg-[#09090b] rounded-lg border border-white/10">
                                <button type="button"
                                        @click="decrement({{ $index }})"
                                        class="px-3 py-1 hover:text-blue-400">-</button>
                                <span class="px-3 font-bold text-sm" x-text="quantities[{{ $index }}]">0</span>
                                <button type="button"
                                        @click="increment({{ $index }}, {{ $ticket->stock ?? 0 }})"
                                        class="px-3 py-1 hover:text-blue-400">+</button>
                            </div>
                        </div>
                    </div>
                @empty
                    <p class="text-center text-gray-500 py-6">Tidak ada tipe tiket yang tersedia.</p>
                @endforelse

                {{-- Summary total --}}
                <div class="bg-[#18181b] p-4 rounded-xl border border-white/5 flex justify-between items-center" x-show="totalQty > 0">
                    <span class="text-sm text-gray-400">Total (<span x-text="totalQty"></span> tiket)</span>
                    <span class="font-black text-blue-400 text-lg">IDR <span x-text="formatRupiah(totalAmount)"></span></span>
                </div>

                <div class="pt-6 border-t border-white/5 flex justify-center">
                    <button
                        @click="bayar()"
                        :disabled="totalQty === 0 || isLoading"
                        :class="totalQty === 0 || isLoading
                            ? 'bg-gray-700 cursor-not-allowed opacity-50'
                            : 'bg-blue-600 hover:bg-blue-700 cursor-pointer'"
                        class="px-8 py-3 rounded-xl font-bold transition flex items-center gap-2 text-white">
                        <i class="fa-solid fa-cart-shopping"></i>
                        <span x-text="isLoading ? 'Memproses...' : 'Beli Tiket'"></span>
                    </button>
                </div>
            </div>
        </div>

        {{-- TAB: DETAILS --}}
        <div x-show="tab === 'details'" x-transition style="display:none">
            <div class="space-y-6">
                <div class="bg-[#18181b] p-8 rounded-3xl border border-white/5">
                    <h3 class="text-center font-bold text-blue-500 mb-4 text-sm">
                        <i class="fa-solid fa-align-left mr-2"></i>Description
                    </h3>
                    <p class="text-sm text-gray-300 leading-relaxed text-justify">
                        {!! nl2br(e($event->description)) !!}
                    </p>
                </div>

                <div class="bg-[#18181b] p-8 rounded-3xl border border-white/5">
                    <h3 class="text-center font-bold text-blue-500 mb-6 text-sm">
                        <i class="fa-solid fa-file-lines mr-2"></i>Terms and Conditions
                    </h3>
                    <div class="text-xs text-gray-300 leading-relaxed whitespace-pre-line">
                        {{ $event->terms }}
                    </div>
                </div>
            </div>
        </div>

        {{-- TAB: ORGANISER --}}
        <div x-show="tab === 'organiser'" x-transition style="display:none">
            <div class="space-y-6">
                <div class="bg-[#18181b] p-10 rounded-3xl border border-white/5 text-center">
                    <i class="fa-solid fa-users text-blue-500 text-3xl mb-6"></i>
                    <p class="max-w-2xl mx-auto text-sm text-gray-400 leading-relaxed italic">
                        {{ $event->organiser_description ?? 'Belum ada deskripsi organiser.' }}
                    </p>
                </div>

                <div class="bg-[#18181b] p-8 rounded-3xl border border-white/5 text-center">
                    <h3 class="font-bold mb-6 text-white uppercase tracking-widest text-sm">
                        Organizing Committee
                    </h3>
                    <img src="{{ $event->organiser_photo ? asset('images/organizers/' . $event->organiser_photo) : asset('images/panitia_kmipn.jpeg') }}"
                         alt="Organizing Committee"
                         class="w-full rounded-2xl border border-white/10">
                </div>
            </div>
        </div>

    </main>
</div>

{{-- ===== MODAL PEMBAYARAN BERHASIL ===== --}}
<div id="success-modal" class="fixed inset-0 z-50 hidden items-center justify-center bg-black/70 backdrop-blur-sm">
    <div class="bg-[#121212] border border-white/10 rounded-3xl p-10 max-w-md w-full mx-4 text-center shadow-2xl">
        {{-- Animasi centang --}}
        <div class="w-20 h-20 rounded-full bg-green-500/10 border-2 border-green-500 flex items-center justify-center mx-auto mb-6">
            <i class="fa-solid fa-check text-green-400 text-3xl"></i>
        </div>

        <h2 class="text-2xl font-black mb-2">Pembayaran Berhasil!</h2>
        <p class="text-gray-400 text-sm mb-2">Tiket digital kamu sudah digenerate.</p>
        <p class="text-blue-400 font-bold text-sm mb-6" id="modal-order-code"></p>

        {{-- Info tiket --}}
        <div class="bg-[#18181b] rounded-2xl p-4 mb-6 border border-white/5 text-left space-y-2">
            <div class="flex justify-between text-sm">
                <span class="text-gray-500">Event</span>
                <span class="font-bold text-right max-w-[180px]">{{ $event->name }}</span>
            </div>
            <div class="flex justify-between text-sm">
                <span class="text-gray-500">Tanggal</span>
                <span class="font-bold">{{ \Carbon\Carbon::parse($event->date)->format('d F Y') }}</span>
            </div>
            <div class="flex justify-between text-sm">
                <span class="text-gray-500">Tipe Tiket</span>
                <span class="font-bold" id="modal-ticket-type">-</span>
            </div>
            <div class="flex justify-between text-sm">
                <span class="text-gray-500">Jumlah</span>
                <span class="font-bold" id="modal-quantity">-</span>
            </div>
        </div>

        <div class="flex gap-3">
            <a href="{{ route('pembeli.myticket') }}"
               class="flex-1 bg-blue-600 hover:bg-blue-700 px-6 py-3 rounded-xl font-bold text-sm transition">
                <i class="fa-solid fa-ticket mr-2"></i>Lihat Tiket Saya
            </a>
            <button onclick="closeSuccessModal()"
                    class="flex-1 bg-white/5 hover:bg-white/10 border border-white/10 px-6 py-3 rounded-xl font-bold text-sm transition">
                Tutup
            </button>
        </div>
    </div>
</div>

{{-- ===== ALPINE.JS DATA + MIDTRANS LOGIC ===== --}}
@php
    $ticketData = $event->tickets->whereNull('order_id')->map(function($t) {
        return [
            'id'    => $t->id,
            'name'  => $t->ticket_type,
            'price' => $t->price ?? 0,
            'stock' => $t->stock ?? 0,
        ];
    })->values()->toArray();
@endphp
<script>
    // Data tiket dari relasi tickets (database baru)
    const ticketTypes = @json($ticketData);
    const snapTokenUrl = "{{ route('payment.snap-token', $event->id) }}";
    const handleSuccessUrl = "{{ route('payment.handle-success') }}";
    const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

    function ticketApp() {
        return {
            quantities: ticketTypes.map(() => 0),
            isLoading: false,

            get totalQty() {
                return this.quantities.reduce((sum, q) => sum + q, 0);
            },

            get totalAmount() {
                return this.quantities.reduce((sum, q, i) => {
                    return sum + (q * (ticketTypes[i]?.price ?? 0));
                }, 0);
            },

            get selectedTicket() {
                // Ambil tiket pertama yang qty > 0
                const idx = this.quantities.findIndex(q => q > 0);
                if (idx === -1) return null;
                return {
                    index: idx,
                    name: ticketTypes[idx].name,
                    price: ticketTypes[idx].price,
                    qty: this.quantities[idx],
                };
            },

            increment(index, stock) {
                // Hanya boleh 1 tipe tiket aktif sekaligus (simple flow)
                const current = this.quantities[index];
                if (current < stock) {
                    this.quantities = this.quantities.map((q, i) => i === index ? q + 1 : 0);
                }
            },

            decrement(index) {
                if (this.quantities[index] > 0) {
                    this.quantities[index]--;
                }
            },

            formatRupiah(num) {
                return num.toLocaleString('id-ID');
            },

            async bayar() {
                if (this.totalQty === 0 || this.isLoading) return;

                const ticket = this.selectedTicket;
                if (!ticket) return;

                this.isLoading = true;

                try {
                    // 1. Minta snap token ke Laravel
                    const res = await fetch(snapTokenUrl, {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': csrfToken,
                        },
                        body: JSON.stringify({
                            ticket_type: ticket.name,
                            quantity: ticket.qty,
                            price: ticket.price,
                        }),
                    });

                    const data = await res.json();

                    if (!res.ok || data.error) {
                        alert('Gagal membuat transaksi: ' + (data.error ?? 'Unknown error'));
                        this.isLoading = false;
                        return;
                    }

                    const orderId   = data.order_id;
                    const snapToken = data.snap_token;

                    // 2. Buka Snap popup Midtrans
                    window.snap.pay(snapToken, {
                        onSuccess: async (result) => {
                            // 3. Kirim ke Laravel untuk generate tiket
                            const successRes = await fetch(handleSuccessUrl, {
                                method: 'POST',
                                headers: {
                                    'Content-Type': 'application/json',
                                    'X-CSRF-TOKEN': csrfToken,
                                },
                                body: JSON.stringify({
                                    order_id:       orderId,
                                    transaction_id: result.transaction_id,
                                    payment_type:   result.payment_type,
                                }),
                            });

                            const successData = await successRes.json();

                            if (successData.success) {
                                // 4. Tampilkan modal sukses
                                showSuccessModal(successData.order_code, ticket.name, ticket.qty);
                            }
                        },
                        onPending: (result) => {
                            alert('Pembayaran pending. Silakan selesaikan pembayaran kamu.');
                        },
                        onError: (result) => {
                            alert('Pembayaran gagal. Silakan coba lagi.');
                        },
                        onClose: () => {
                            // User menutup popup tanpa bayar
                        },
                    });

                } catch (err) {
                    alert('Terjadi kesalahan: ' + err.message);
                } finally {
                    this.isLoading = false;
                }
            },
        };
    }

    function showSuccessModal(orderCode, ticketType, quantity) {
        document.getElementById('modal-order-code').textContent = 'Order: ' + orderCode;
        document.getElementById('modal-ticket-type').textContent = ticketType;
        document.getElementById('modal-quantity').textContent = quantity + ' tiket';

        const modal = document.getElementById('success-modal');
        modal.classList.remove('hidden');
        modal.classList.add('flex');
    }

    function closeSuccessModal() {
        const modal = document.getElementById('success-modal');
        modal.classList.add('hidden');
        modal.classList.remove('flex');
    }
</script>

</body>
</html>
