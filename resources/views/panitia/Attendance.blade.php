<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Ticketify - Attendance Verification</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body class="bg-[#09090b] text-white flex" x-data="attendanceApp()">

    @include('layouts.sidebar-panitia')

    <main class="flex-1 p-6 lg:p-10 overflow-y-auto">
        <header class="mb-10">
            <button id="open-sidebar" class="lg:hidden text-gray-400 hover:text-blue-500 transition-colors">
                <i class="fa-solid fa-bars-staggered text-2xl"></i>
            </button>
            <h1 class="text-3xl font-black tracking-tight">Attendance Verification</h1>
            <p class="text-gray-500 text-sm mt-2">Masukkan kode tiket untuk verifikasi kehadiran peserta.</p>
        </header>

        @php
            $eventsJson = $userEvents->map(fn($e) => ['id' => $e->id, 'name' => $e->name])->values();
            $recentJson = $recentAttendances->map(fn($t) => [
                'id' => $t->id,
                'event_id' => $t->event_id,
                'name' => $t->user->name ?? 'User Terhapus',
                'ticket_type' => $t->ticket_type,
                'attended_at' => $t->attended_at?->diffForHumans(),
            ]);
        @endphp

        {{-- Select Event --}}
        @if($userEvents->count() > 0)
        <div class="mb-8 flex gap-4">
            <div class="flex-1 max-w-xs">
                <label class="text-[10px] font-black text-gray-500 uppercase tracking-widest ml-1 mb-2 block">Pilih Event</label>
                <select x-model="selectedEventId" @change="onEventChange()" class="w-full bg-[#121212] border border-white/5 rounded-xl px-4 py-3 text-sm focus:border-blue-500 outline-none">
                    <option value="">-- Pilih Event --</option>
                    @foreach($userEvents as $event)
                        <option value="{{ $event->id }}">{{ $event->name }}</option>
                    @endforeach
                </select>
            </div>
        </div>
        @else
        <div class="mb-8 p-4 bg-yellow-500/10 border border-yellow-500/30 rounded-xl">
            <p class="text-yellow-400 text-sm">Belum ada event yang tersedia. Silakan buat event terlebih dahulu.</p>
        </div>
        @endif

        <div class="grid lg:grid-cols-12 gap-10">

            <div class="lg:col-span-5 space-y-6">
                {{-- Manual Input --}}
                <div class="bg-[#121212] p-8 rounded-3xl border border-white/5">
                    <label class="text-[10px] font-black text-gray-500 uppercase tracking-widest ml-1 mb-4 block">Input Kode Tiket</label>
                    <div class="flex gap-3">
                        <input type="text" x-model="manualTicketId" x-ref="ticketInput" placeholder="Masukkan Kode Tiket"
                               @keyup.enter="verifyManualTicket()"
                               class="flex-1 bg-[#18181b] border border-white/5 rounded-xl px-4 py-3 text-sm focus:border-blue-500 outline-none">
                        <button @click="verifyManualTicket()"
                                :disabled="!selectedEventId"
                                :class="!selectedEventId ? 'opacity-40 cursor-not-allowed' : 'hover:bg-white/10'"
                                class="bg-white/5 px-6 rounded-xl text-xs font-bold transition-all border border-white/5">Verifikasi</button>
                    </div>
                    <template x-if="!selectedEventId">
                        <p class="text-[10px] text-gray-600 mt-3"><i class="fa-solid fa-circle-info mr-1"></i> Pilih event terlebih dahulu</p>
                    </template>
                </div>
            </div>

            <div class="lg:col-span-7 space-y-6">

                {{-- Result Alert --}}
                <template x-if="showResult && resultData">
                    <div :class="[
                        'p-8 rounded-[2rem] animate-in fade-in zoom-in duration-300',
                        resultData.type === 'success' ? 'bg-green-500/10 border border-green-500/50' :
                        resultData.type === 'error' ? 'bg-red-500/10 border border-red-500/50' :
                        'bg-yellow-500/10 border border-yellow-500/50'
                    ]">
                        <div class="flex items-start gap-4">
                            <div :class="[
                                'w-12 h-12 rounded-2xl flex items-center justify-center text-white text-xl',
                                resultData.type === 'success' ? 'bg-green-500' :
                                resultData.type === 'error' ? 'bg-red-500' :
                                'bg-yellow-500'
                            ]">
                                <i :class="[
                                    resultData.type === 'success' ? 'fa-solid fa-check-double' :
                                    resultData.type === 'error' ? 'fa-solid fa-xmark' :
                                    'fa-solid fa-exclamation'
                                ]"></i>
                            </div>
                            <div class="flex-1 min-w-0">
                                <h4 :class="[
                                    'font-black uppercase tracking-widest text-xs',
                                    resultData.type === 'success' ? 'text-green-500' :
                                    resultData.type === 'error' ? 'text-red-500' :
                                    'text-yellow-500'
                                ]" x-text="resultData.message"></h4>
                                <p class="text-lg font-black mt-1 truncate" x-text="resultData.data.name || ''"></p>
                                <p class="text-xs text-gray-400" x-text="resultData.data.ticket_type ? `${resultData.data.ticket_type} • ${resultData.data.event}` : ''"></p>
                                <p class="text-xs text-gray-500 mt-2" x-text="resultData.data.email || ''"></p>
                                <button @click="dismissResult()"
                                        class="mt-4 text-[10px] font-bold text-gray-500 hover:text-white uppercase tracking-tighter">Tutup</button>
                            </div>
                        </div>
                    </div>
                </template>

                {{-- Statistics --}}
                <div class="bg-[#121212] p-8 rounded-[2.5rem] border border-white/5">
                    <h3 class="text-sm font-black uppercase tracking-widest mb-6 flex items-center gap-2">
                        <i class="fa-solid fa-chart-simple text-blue-500"></i> Statistik Kehadiran
                    </h3>
                    <template x-if="statistics">
                        <div class="space-y-4">
                            <div class="flex justify-between items-center">
                                <span class="text-xs text-gray-400">Total Tiket</span>
                                <span class="text-lg font-black" x-text="statistics.total_tickets"></span>
                            </div>
                            <div class="flex justify-between items-center">
                                <span class="text-xs text-gray-400">Sudah Checkin</span>
                                <span class="text-lg font-black text-green-500" x-text="statistics.attended_tickets"></span>
                            </div>
                            <div class="h-2 bg-white/5 rounded-full overflow-hidden mt-4">
                                <div class="h-full bg-gradient-to-r from-blue-500 to-green-500 rounded-full transition-all"
                                     :style="{ width: statistics.attendance_rate + '%' }"></div>
                            </div>
                            <div class="text-center">
                                <p class="text-xs text-gray-500">Tingkat Kehadiran</p>
                                <p class="text-2xl font-black" x-text="statistics.attendance_rate + '%'"></p>
                            </div>
                        </div>
                    </template>
                    <template x-if="!selectedEventId">
                        <p class="text-xs text-gray-500 text-center py-8">Pilih event untuk melihat statistik</p>
                    </template>
                </div>

                {{-- Recent Scans --}}
                <div class="bg-[#121212] p-8 rounded-[2.5rem] border border-white/5">
                    <h3 class="text-sm font-black uppercase tracking-widest mb-6 flex items-center gap-2">
                        <i class="fa-solid fa-clock-rotate-left text-blue-500"></i> Recent Checkins
                    </h3>
                    <div class="space-y-4">
                        <template x-if="filteredCheckins.length > 0">
                            <div>
                                <template x-for="item in filteredCheckins" :key="item.id">
                                    <div class="flex items-center gap-4 p-4 bg-white/[0.02] rounded-2xl border border-white/5 mb-3">
                                        <div class="w-10 h-10 rounded-full bg-blue-600/20 text-blue-500 flex items-center justify-center font-bold text-xs uppercase" x-text="item.initials"></div>
                                        <div class="flex-1 overflow-hidden">
                                            <p class="text-xs font-bold truncate text-white" x-text="item.name"></p>
                                            <p class="text-[10px] text-gray-500" x-text="item.attended_at"></p>
                                        </div>
                                        <span class="text-[9px] font-black bg-blue-500/10 text-blue-500 px-2 py-1 rounded-md uppercase" x-text="item.ticket_type"></span>
                                    </div>
                                </template>
                            </div>
                        </template>
                        <template x-if="filteredCheckins.length === 0 && selectedEventId">
                            <p class="text-xs text-gray-500 text-center py-8">Belum ada checkin untuk event ini</p>
                        </template>
                        <template x-if="!selectedEventId">
                            <p class="text-xs text-gray-500 text-center py-8">Pilih event untuk melihat riwayat checkin</p>
                        </template>
                    </div>
                </div>
            </div>
        </div>
    </main>

<script>
    function attendanceApp() {
        return {
            showResult: false,
            resultData: null,
            manualTicketId: '',
            selectedEventId: '',
            statistics: null,
            recentCheckins: @json($recentJson),

            get filteredCheckins() {
                if (!this.selectedEventId) return [];
                return this.recentCheckins.filter(c => c.event_id == this.selectedEventId);
            },

            init() {
                const events = @json($eventsJson);
                if (events.length === 1) {
                    this.selectedEventId = events[0].id;
                    this.loadStatistics();
                }
            },

            onEventChange() {
                this.showResult = false;
                this.resultData = null;
                this.loadStatistics();
            },

            dismissResult() {
                this.showResult = false;
                this.resultData = null;
                this.manualTicketId = '';
                this.$nextTick(() => {
                    if (this.$refs.ticketInput) this.$refs.ticketInput.focus();
                });
            },

            verifyManualTicket() {
                if (!this.manualTicketId || !this.selectedEventId) {
                    this.resultData = {
                        success: false,
                        message: 'Masukkan kode tiket dan pilih event terlebih dahulu',
                        type: 'error',
                        data: { name: '', email: '', event: '', ticket_type: '' }
                    };
                    this.showResult = true;
                    return;
                }

                fetch('{{ route("panitia.verify-ticket") }}', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.content || ''
                    },
                    body: JSON.stringify({
                        ticket_id: this.manualTicketId,
                        event_id: this.selectedEventId
                    })
                })
                .then(response => response.json())
                .then(data => {
                    this.resultData = data;
                    this.showResult = true;

                    if (data.success) {
                        this.manualTicketId = '';
                        this.loadStatistics();

                        setTimeout(() => {
                            this.dismissResult();
                            this.loadStatistics();
                        }, 3000);
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    this.resultData = {
                        success: false,
                        message: 'Terjadi kesalahan: ' + error.message,
                        type: 'error',
                        data: { name: '', email: '', event: '', ticket_type: '' }
                    };
                    this.showResult = true;
                });
            },

            loadStatistics() {
                if (!this.selectedEventId) {
                    this.statistics = null;
                    return;
                }

                fetch(`{{ route("panitia.attendance-stats") }}?event_id=${this.selectedEventId}`)
                    .then(response => {
                        if (!response.ok) throw new Error('Failed to load statistics');
                        return response.json();
                    })
                    .then(data => {
                        this.statistics = data;
                    })
                    .catch(error => {
                        console.error('Error loading statistics:', error);
                        this.statistics = null;
                    });
            }
        }
    }

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

</body>
</html>
