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

        @php
            $eventsJson = $userEvents->map(fn($e) => ['id' => $e->id, 'name' => $e->name])->values();
            $recentJson = $recentAttendances->map(fn($t) => [
                'id' => $t->id,
                'event_id' => $t->event_id,
                'name' => $t->user->name ?? 'User Terhapus',
                'ticket_type' => $t->ticket_type,
                'email' => $t->user->email ?? '',
                'attended_at' => $t->attended_at?->diffForHumans(),
            ]);
        @endphp

        {{-- HEADER --}}
        <div class="flex items-center justify-between mb-10">
            <div>
                <button id="open-sidebar" class="lg:hidden text-gray-400 hover:text-blue-500 transition-colors mb-3">
                    <i class="fa-solid fa-bars-staggered text-2xl"></i>
                </button>
                <h1 class="text-3xl font-black tracking-tight">Attendance</h1>
                <p class="text-gray-500 text-sm mt-2">Verifikasi kehadiran peserta event.</p>
            </div>
        </div>

        @if($userEvents->count() > 0)

        {{-- EVENT SELECTOR + STATS SNAPSHOT --}}
        <div class="bg-[#121212] border border-white/5 rounded-[2rem] p-6 mb-8">
            <div class="flex flex-col lg:flex-row lg:items-center gap-6">
                <div class="flex-1">
                    <label class="text-[10px] font-black text-gray-500 uppercase tracking-widest mb-2 block">Pilih Event</label>
                    <select x-model="selectedEventId" @change="onEventChange()"
                        class="w-full lg:max-w-md bg-[#1e1e1e] border border-white/5 rounded-xl px-5 py-3.5 text-sm focus:border-blue-500 outline-none appearance-none cursor-pointer">
                        <option value="">— Pilih Event —</option>
                        @foreach($userEvents as $event)
                            <option value="{{ $event->id }}">{{ $event->name }}</option>
                        @endforeach
                    </select>
                </div>
                <template x-if="statistics && selectedEventId">
                    <div class="flex gap-6 lg:gap-10 flex-wrap">
                        <div class="text-center">
                            <p class="text-2xl font-black" x-text="statistics.total_tickets"></p>
                            <p class="text-[10px] text-gray-500 uppercase tracking-widest mt-1">Total</p>
                        </div>
                        <div class="text-center">
                            <p class="text-2xl font-black text-green-500" x-text="statistics.attended_tickets"></p>
                            <p class="text-[10px] text-gray-500 uppercase tracking-widest mt-1">Hadir</p>
                        </div>
                        <div class="text-center">
                            <p class="text-2xl font-black text-blue-500" x-text="statistics.attendance_rate + '%'"></p>
                            <p class="text-[10px] text-gray-500 uppercase tracking-widest mt-1">Rate</p>
                        </div>
                    </div>
                </template>
            </div>
        </div>

        {{-- MAIN GRID --}}
        <div class="grid lg:grid-cols-12 gap-8">

            {{-- LEFT: VERIFY PANEL --}}
            <div class="lg:col-span-5 space-y-6">

                {{-- INPUT TICKET --}}
                <div class="bg-[#121212] border border-white/5 rounded-[2rem] p-8">
                    <div class="flex items-center gap-3 mb-6">
                        <div class="w-10 h-10 rounded-xl bg-blue-500/10 flex items-center justify-center">
                            <i class="fa-solid fa-ticket text-blue-500"></i>
                        </div>
                        <div>
                            <h3 class="text-sm font-bold">Verifikasi Tiket</h3>
                            <p class="text-[10px] text-gray-500">Masukkan kode tiket peserta</p>
                        </div>
                    </div>

                    <div class="flex gap-3">
                        <div class="flex-1 relative">
                            <i class="fa-solid fa-hashtag absolute left-4 top-1/2 -translate-y-1/2 text-gray-600 text-sm"></i>
                            <input type="text" x-model="manualTicketId" x-ref="ticketInput"
                                   placeholder="Kode Tiket"
                                   @keyup.enter="verifyManualTicket()"
                                   class="w-full bg-[#1e1e1e] border border-white/5 rounded-xl pl-11 pr-4 py-3.5 text-sm focus:border-blue-500 outline-none transition-all"
                                   :class="{'border-green-500/50': showResult && resultData?.type === 'success', 'border-red-500/50': showResult && resultData?.type === 'error'}">
                        </div>
                        <button @click="verifyManualTicket()"
                                :disabled="!selectedEventId || !manualTicketId"
                                :class="!selectedEventId || !manualTicketId ? 'opacity-40 cursor-not-allowed' : 'hover:bg-blue-700 active:scale-95'"
                                class="bg-blue-600 px-6 rounded-xl text-sm font-bold transition-all shadow-lg shadow-blue-600/20 whitespace-nowrap">
                            <i class="fa-solid fa-check mr-1.5"></i> Cek
                        </button>
                    </div>

                    <template x-if="!selectedEventId">
                        <div class="flex items-center gap-2 mt-4 text-[10px] text-gray-600">
                            <i class="fa-solid fa-circle-info"></i>
                            <span>Pilih event terlebih dahulu</span>
                        </div>
                    </template>
                    <template x-if="selectedEventId && !manualTicketId">
                        <div class="flex items-center gap-2 mt-4 text-[10px] text-gray-600">
                            <i class="fa-solid fa-keyboard"></i>
                            <span>Ketik kode tiket lalu tekan Enter atau tombol Cek</span>
                        </div>
                    </template>
                </div>

                {{-- RECENT CHECKINS (mobile) --}}
                <div class="bg-[#121212] border border-white/5 rounded-[2rem] p-8 lg:hidden">
                    <div class="flex items-center gap-3 mb-6">
                        <div class="w-10 h-10 rounded-xl bg-blue-500/10 flex items-center justify-center">
                            <i class="fa-solid fa-clock-rotate-left text-blue-500"></i>
                        </div>
                        <div>
                            <h3 class="text-sm font-bold">Checkin Terbaru</h3>
                            <p class="text-[10px] text-gray-500">Peserta yang sudah terverifikasi</p>
                        </div>
                    </div>
                    <template x-if="filteredCheckins.length > 0">
                        <div class="space-y-3">
                            <template x-for="item in filteredCheckins" :key="item.id">
                                <div class="flex items-center gap-3 p-3 bg-[#1e1e1e] rounded-xl">
                                    <div class="w-9 h-9 rounded-full bg-green-500/20 text-green-500 flex items-center justify-center font-bold text-xs uppercase flex-shrink-0" x-text="item.initials"></div>
                                    <div class="flex-1 min-w-0">
                                        <p class="text-xs font-bold truncate" x-text="item.name"></p>
                                        <div class="flex items-center gap-2 text-[10px] text-gray-500">
                                            <span x-text="item.ticket_type"></span>
                                            <span>•</span>
                                            <span x-text="item.attended_at"></span>
                                        </div>
                                    </div>
                                    <i class="fa-solid fa-check-circle text-green-500/60 text-xs"></i>
                                </div>
                            </template>
                        </div>
                    </template>
                    <template x-if="filteredCheckins.length === 0 && selectedEventId">
                        <div class="text-center py-12">
                            <i class="fa-solid fa-user-check text-4xl text-gray-700 mb-4"></i>
                            <p class="text-xs text-gray-500">Belum ada checkin</p>
                            <p class="text-[10px] text-gray-600 mt-1">Verifikasi tiket pertama akan muncul di sini</p>
                        </div>
                    </template>
                    <template x-if="!selectedEventId">
                        <div class="text-center py-12">
                            <i class="fa-solid fa-hand-pointer text-4xl text-gray-700 mb-4"></i>
                            <p class="text-xs text-gray-500">Pilih event untuk melihat checkin</p>
                        </div>
                    </template>
                </div>

            </div>

            {{-- RIGHT: RESULT + STATS + CHECKINS --}}
            <div class="lg:col-span-7 space-y-6">

                {{-- RESULT CARD --}}
                <template x-if="showResult && resultData">
                    <div x-cloak x-show="showResult" x-transition:enter="transition ease-out duration-300"
                         x-transition:enter-start="opacity-0 translate-y-4 scale-95"
                         x-transition:enter-end="opacity-100 translate-y-0 scale-100"
                         :class="resultData.type === 'success' ? 'bg-green-500/5 border-green-500/30' : resultData.type === 'error' ? 'bg-red-500/5 border-red-500/30' : 'bg-yellow-500/5 border-yellow-500/30'"
                         class="border rounded-[2rem] p-6 relative overflow-hidden">

                        {{-- Decorative top bar --}}
                        <div :class="resultData.type === 'success' ? 'bg-green-500' : resultData.type === 'error' ? 'bg-red-500' : 'bg-yellow-500'"
                             class="absolute top-0 left-0 right-0 h-1"></div>

                        <div class="flex items-start gap-5 mt-2">
                            <div :class="resultData.type === 'success' ? 'bg-green-500 shadow-lg shadow-green-500/30' : resultData.type === 'error' ? 'bg-red-500 shadow-lg shadow-red-500/30' : 'bg-yellow-500 shadow-lg shadow-yellow-500/30'"
                                 class="w-14 h-14 rounded-2xl flex items-center justify-center text-white text-2xl flex-shrink-0">
                                <i :class="resultData.type === 'success' ? 'fa-solid fa-check-double' : resultData.type === 'error' ? 'fa-solid fa-xmark' : 'fa-solid fa-exclamation'"></i>
                            </div>
                            <div class="flex-1 min-w-0">
                                <h4 :class="resultData.type === 'success' ? 'text-green-500' : resultData.type === 'error' ? 'text-red-500' : 'text-yellow-500'"
                                    class="font-black uppercase tracking-widest text-xs mb-1" x-text="resultData.message"></h4>

                                <template x-if="resultData.data?.name">
                                    <div class="mt-4 bg-white/[0.03] rounded-2xl p-5 border border-white/5">
                                        <div class="flex items-center gap-4">
                                            <div class="w-12 h-12 rounded-full bg-blue-600/20 text-blue-500 flex items-center justify-center font-bold text-lg uppercase flex-shrink-0" x-text="(resultData.data.name || '?').charAt(0)"></div>
                                            <div>
                                                <p class="text-lg font-black" x-text="resultData.data.name"></p>
                                                <div class="flex items-center gap-3 text-xs text-gray-400 mt-1">
                                                    <span x-text="resultData.data.ticket_type"></span>
                                                    <template x-if="resultData.data.email">
                                                        <span class="flex items-center gap-1"><i class="fa-regular fa-envelope"></i> <span x-text="resultData.data.email"></span></span>
                                                    </template>
                                                </div>
                                                <template x-if="resultData.data.event">
                                                    <p class="text-[10px] text-gray-600 mt-1.5 flex items-center gap-1">
                                                        <i class="fa-regular fa-calendar"></i> <span x-text="resultData.data.event"></span>
                                                    </p>
                                                </template>
                                            </div>
                                        </div>
                                    </div>
                                </template>

                                <button @click="dismissResult()"
                                        class="mt-4 text-[10px] font-bold text-gray-500 hover:text-white uppercase tracking-widest transition-all flex items-center gap-1.5">
                                    <i class="fa-solid fa-rotate-right text-[8px]"></i> Verifikasi Lagi
                                </button>
                            </div>
                        </div>
                    </div>
                </template>

                {{-- STATS CARDS --}}
                <div class="grid grid-cols-3 gap-4">
                    <div class="bg-[#121212] border border-white/5 rounded-2xl p-6 text-center">
                        <i class="fa-solid fa-ticket text-blue-500/60 text-xl mb-3"></i>
                        <p class="text-3xl font-black" x-text="statistics?.total_tickets ?? '-'"></p>
                        <p class="text-[10px] text-gray-500 uppercase tracking-widest mt-1">Total Tiket</p>
                    </div>
                    <div class="bg-[#121212] border border-white/5 rounded-2xl p-6 text-center">
                        <i class="fa-solid fa-user-check text-green-500/60 text-xl mb-3"></i>
                        <p class="text-3xl font-black text-green-500" x-text="statistics?.attended_tickets ?? '-'"></p>
                        <p class="text-[10px] text-gray-500 uppercase tracking-widest mt-1">Hadir</p>
                    </div>
                    <div class="bg-[#121212] border border-white/5 rounded-2xl p-6 text-center">
                        <i class="fa-solid fa-chart-line text-blue-500/60 text-xl mb-3"></i>
                        <p class="text-3xl font-black text-blue-500" x-text="statistics?.attendance_rate != null ? statistics.attendance_rate + '%' : '-'"></p>
                        <p class="text-[10px] text-gray-500 uppercase tracking-widest mt-1">Rate</p>
                    </div>
                </div>

                {{-- PROGRESS BAR --}}
                <template x-if="statistics && selectedEventId">
                    <div class="bg-[#121212] border border-white/5 rounded-2xl p-6">
                        <div class="flex justify-between items-center mb-3">
                            <span class="text-[10px] text-gray-500 uppercase tracking-widest">Progress Kehadiran</span>
                            <span class="text-xs font-bold" x-text="statistics.attended_tickets + ' / ' + statistics.total_tickets"></span>
                        </div>
                        <div class="h-3 bg-[#1e1e1e] rounded-full overflow-hidden">
                            <div class="h-full bg-gradient-to-r from-blue-500 to-green-500 rounded-full transition-all duration-700 ease-out"
                                 :style="{ width: statistics.attendance_rate + '%' }"></div>
                        </div>
                    </div>
                </template>

                {{-- RECENT CHECKINS (desktop) --}}
                <div class="bg-[#121212] border border-white/5 rounded-[2rem] p-8 hidden lg:block">
                    <div class="flex items-center justify-between mb-6">
                        <div class="flex items-center gap-3">
                            <div class="w-10 h-10 rounded-xl bg-blue-500/10 flex items-center justify-center">
                                <i class="fa-solid fa-clock-rotate-left text-blue-500"></i>
                            </div>
                            <div>
                                <h3 class="text-sm font-bold">Checkin Terbaru</h3>
                                <p class="text-[10px] text-gray-500">Peserta yang sudah terverifikasi</p>
                            </div>
                        </div>
                        <template x-if="filteredCheckins.length > 0">
                            <span class="text-[10px] text-gray-500 font-bold uppercase tracking-widest" x-text="filteredCheckins.length + ' peserta'"></span>
                        </template>
                    </div>

                    <template x-if="filteredCheckins.length > 0">
                        <div class="space-y-2">
                            <template x-for="item in filteredCheckins" :key="item.id">
                                <div class="flex items-center gap-4 p-4 rounded-xl hover:bg-white/[0.02] transition-all border border-transparent hover:border-white/5 group">
                                    <div class="w-10 h-10 rounded-full bg-gradient-to-br from-blue-500 to-purple-600 text-white flex items-center justify-center font-bold text-sm uppercase flex-shrink-0" x-text="item.initials"></div>
                                    <div class="flex-1 min-w-0">
                                        <p class="text-sm font-bold truncate group-hover:text-blue-400 transition-colors" x-text="item.name"></p>
                                        <div class="flex items-center gap-3 text-[10px] text-gray-500 mt-0.5">
                                            <span class="flex items-center gap-1"><i class="fa-solid fa-tag text-[8px]"></i> <span x-text="item.ticket_type"></span></span>
                                            <span>•</span>
                                            <span class="flex items-center gap-1"><i class="fa-regular fa-clock text-[8px]"></i> <span x-text="item.attended_at"></span></span>
                                        </div>
                                    </div>
                                    <div class="flex items-center gap-2">
                                        <span class="text-[9px] font-black px-2.5 py-1 rounded-full bg-green-500/10 text-green-500 uppercase tracking-wider">Hadir</span>
                                        <i class="fa-solid fa-check-circle text-green-500/40 group-hover:text-green-500 transition-colors"></i>
                                    </div>
                                </div>
                            </template>
                        </div>
                    </template>

                    <template x-if="filteredCheckins.length === 0 && selectedEventId">
                        <div class="text-center py-16">
                            <div class="w-20 h-20 mx-auto rounded-full bg-[#1e1e1e] flex items-center justify-center mb-6">
                                <i class="fa-solid fa-user-check text-3xl text-gray-600"></i>
                            </div>
                            <p class="text-sm text-gray-400 font-medium">Belum Ada Checkin</p>
                            <p class="text-xs text-gray-600 mt-2 max-w-xs mx-auto">Verifikasi tiket peserta dengan memasukkan kode tiket di panel sebelah kiri.</p>
                        </div>
                    </template>
                    <template x-if="!selectedEventId">
                        <div class="text-center py-16">
                            <div class="w-20 h-20 mx-auto rounded-full bg-[#1e1e1e] flex items-center justify-center mb-6">
                                <i class="fa-solid fa-hand-pointer text-3xl text-gray-600"></i>
                            </div>
                            <p class="text-sm text-gray-400 font-medium">Pilih Event</p>
                            <p class="text-xs text-gray-600 mt-2">Pilih event terlebih dahulu untuk melihat daftar checkin.</p>
                        </div>
                    </template>
                </div>

            </div>
        </div>

        @else
        <div class="flex flex-col items-center justify-center py-20">
            <div class="w-24 h-24 rounded-full bg-[#1e1e1e] flex items-center justify-center mb-8">
                <i class="fa-solid fa-calendar-xmark text-4xl text-gray-600"></i>
            </div>
            <h2 class="text-xl font-black mb-2">Belum Ada Event</h2>
            <p class="text-gray-500 text-sm mb-8 text-center max-w-md">Buat event terlebih dahulu untuk mulai melakukan verifikasi kehadiran peserta.</p>
            <a href="{{ route('panitia.create') }}" class="inline-flex items-center gap-2 bg-blue-600 hover:bg-blue-700 text-white px-6 py-3 rounded-xl font-bold text-sm transition-all shadow-lg shadow-blue-600/20">
                <i class="fa-solid fa-plus"></i> Buat Event Baru
            </a>
        </div>
        @endif

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
                let items = this.recentCheckins.filter(c => c.event_id == this.selectedEventId);
                return items.map(item => ({
                    ...item,
                    initials: item.name ? item.name.split(' ').map(n => n[0]).join('').toUpperCase().slice(0, 2) : '??'
                }));
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
                        message: 'Lengkapi data terlebih dahulu',
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
                    if (data.data && data.data.name) {
                        data.data.initials = data.data.name.split(' ').map(n => n[0]).join('').toUpperCase().slice(0, 2);
                    }
                    this.resultData = data;
                    this.showResult = true;
                    this.manualTicketId = '';

                    if (data.success) {
                        this.loadStatistics();
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
</script>

<style>
    [x-cloak] { display: none !important; }
</style>

<script>
    const openBtn = document.getElementById('open-sidebar');
    const closeBtn = document.getElementById('close-sidebar');
    const sidebar = document.getElementById('main-sidebar');
    const overlay = document.getElementById('sidebar-overlay');

    if (openBtn && sidebar) {
        function toggleSidebar() {
            sidebar.classList.toggle('-translate-x-full');
            if (overlay) overlay.classList.toggle('hidden');
            document.body.classList.toggle('overflow-hidden', !sidebar.classList.contains('-translate-x-full'));
        }
        openBtn.addEventListener('click', toggleSidebar);
        if (closeBtn) closeBtn.addEventListener('click', toggleSidebar);
        if (overlay) overlay.addEventListener('click', toggleSidebar);
    }
</script>

</body>
</html>