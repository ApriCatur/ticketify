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
    <script src="https://cdn.jsdelivr.net/npm/jsqr@1.4.0/dist/jsQR.js"></script>
</head>
<body class="bg-[#09090b] text-white flex" x-data="attendanceApp()">

    @include('layouts.sidebar-panitia')

    <main class="flex-1 p-10 overflow-y-auto">
        <header class="mb-10">
            <button id="open-sidebar" class="lg:hidden text-gray-400 hover:text-blue-500 transition-colors">
                <i class="fa-solid fa-bars-staggered text-2xl"></i>
            </button>
            <h1 class="text-3xl font-black tracking-tight">Attendance Verification</h1>
            <p class="text-gray-500 text-sm mt-2">Scan QR Code pada tiket peserta atau masukkan Ticket ID manual untuk verifikasi kehadiran.</p>
        </header>

        {{-- Select Event --}}
        @if(isset($userEvents) && $userEvents->count() > 0)
        <div class="mb-8 flex gap-4">
            <div class="flex-1 max-w-xs">
                <label class="text-[10px] font-black text-gray-500 uppercase tracking-widest ml-1 mb-2 block">Pilih Event</label>
                <select x-model="selectedEventId" @change="loadStatistics()" class="w-full bg-[#121212] border border-white/5 rounded-xl px-4 py-3 text-sm focus:border-blue-500 outline-none">
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

            <div class="lg:col-span-7 space-y-6">
                {{-- Camera Scanner --}}
                <div class="relative bg-[#121212] rounded-[2.5rem] border border-white/5 overflow-hidden aspect-square md:aspect-video flex items-center justify-center">
                    <video id="camera" style="width: 100%; height: 100%; object-fit: cover;"
                           class="absolute inset-0" x-show="showCamera"></video>

                    <canvas id="canvas" style="display: none;"></canvas>

                    <div class="absolute inset-0 z-10 pointer-events-none" x-show="showCamera">
                        <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-64 h-64 border-2 border-blue-500/50 rounded-3xl">
                            <div class="absolute top-0 left-0 w-full h-1 bg-blue-500 shadow-[0_0_15px_rgba(59,130,246,1)] animate-pulse mt-32"></div>
                        </div>
                        <div class="absolute inset-0 bg-black/40"></div>
                    </div>

                    <div class="text-center space-y-4 z-20" x-show="!showCamera">
                        <i class="fa-solid fa-camera text-5xl text-gray-700"></i>
                        <p class="text-xs text-gray-500 font-bold uppercase tracking-widest">Kamera</p>
                        <button @click="startCamera()" x-show="!showCamera"
                                class="mt-4 px-6 py-2 bg-blue-600 hover:bg-blue-700 rounded-full text-[10px] font-black uppercase tracking-widest transition">
                            Aktifkan Kamera
                        </button>
                    </div>

                    <button @click="stopCamera()" x-show="showCamera"
                            class="absolute top-4 right-4 z-30 px-4 py-2 bg-red-600 hover:bg-red-700 rounded-full text-[10px] font-black uppercase tracking-widest transition">
                        Stop Scan
                    </button>
                </div>

                {{-- Manual Input --}}
                <div class="bg-[#121212] p-8 rounded-3xl border border-white/5">
                    <label class="text-[10px] font-black text-gray-500 uppercase tracking-widest ml-1 mb-4 block">Input Ticket ID Manual</label>
                    <div class="flex gap-3">
                        <input type="text" x-model="manualTicketId" placeholder="Contoh: 1 (atau scan QR code)"
                               @keyup.enter="verifyManualTicket()"
                               class="flex-1 bg-[#18181b] border border-white/5 rounded-xl px-4 py-3 text-sm focus:border-blue-500 outline-none">
                        <button @click="verifyManualTicket()"
                                class="bg-white/5 hover:bg-white/10 px-6 rounded-xl text-xs font-bold transition-all border border-white/5">Verifikasi</button>
                    </div>
                </div>
            </div>

            <div class="lg:col-span-5 space-y-6">

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
                            <div class="flex-1">
                                <h4 :class="[
                                    'font-black uppercase tracking-widest text-xs',
                                    resultData.type === 'success' ? 'text-green-500' :
                                    resultData.type === 'error' ? 'text-red-500' :
                                    'text-yellow-500'
                                ]" x-text="resultData.message"></h4>
                                <p class="text-lg font-black mt-1" x-text="resultData.data.name"></p>
                                <p class="text-xs text-gray-400" x-text="`${resultData.data.ticket_type} • ${resultData.data.event}`"></p>
                                <p class="text-xs text-gray-500 mt-2" x-text="`${resultData.data.email}`"></p>
                                <button @click="showResult = false; manualTicketId = ''"
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
                        @forelse($recentAttendances ?? [] as $attendance)
                            <div class="flex items-center gap-4 p-4 bg-white/[0.02] rounded-2xl border border-white/5">
                                <div class="w-10 h-10 rounded-full bg-blue-600/20 text-blue-500 flex items-center justify-center font-bold text-xs">
                                    @php
                                        $names = explode(' ', $attendance->user->name);
                                        $initials = strtoupper(substr($names[0], 0, 1)) . strtoupper(substr($names[1] ?? '', 0, 1));
                                    @endphp
                                    {{ $initials }}
                                </div>
                                <div class="flex-1 overflow-hidden">
                                    <p class="text-xs font-bold truncate text-white">{{ $attendance->user->name }}</p>
                                    <p class="text-[10px] text-gray-500">{{ $attendance->attended_at ? $attendance->attended_at->diffForHumans() : 'N/A' }}</p>
                                </div>
                                <span class="text-[9px] font-black bg-blue-500/10 text-blue-500 px-2 py-1 rounded-md uppercase">{{ $attendance->ticket_type }}</span>
                            </div>
                        @empty
                            <p class="text-xs text-gray-500 text-center py-8">Belum ada checkin</p>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </main>

<script>
    function attendanceApp() {
        return {
            showCamera: false,
            showResult: false,
            resultData: null,
            manualTicketId: '',
            selectedEventId: '',
            statistics: null,
            video: null,
            canvas: null,
            canvasContext: null,
            scanning: false,

            init() {
                this.video = document.getElementById('camera');
                this.canvas = document.getElementById('canvas');
                this.canvasContext = this.canvas.getContext('2d');
            },

            startCamera() {
                this.showCamera = true;
                navigator.mediaDevices.getUserMedia({
                    video: { facingMode: 'environment' }
                }).then(stream => {
                    this.video.srcObject = stream;
                    this.scanning = true;
                    this.scanQRCode();
                }).catch(err => {
                    alert('Tidak dapat mengakses kamera: ' + err.message);
                    this.showCamera = false;
                });
            },

            stopCamera() {
                this.showCamera = false;
                this.scanning = false;
                if (this.video.srcObject) {
                    this.video.srcObject.getTracks().forEach(track => track.stop());
                }
            },

            scanQRCode() {
                if (!this.scanning) return;

                if (this.video.readyState === this.video.HAVE_ENOUGH_DATA) {
                    this.canvas.hidden = false;
                    this.canvas.width = this.video.videoWidth;
                    this.canvas.height = this.video.videoHeight;
                    this.canvasContext.drawImage(this.video, 0, 0, this.canvas.width, this.canvas.height);

                    const imageData = this.canvasContext.getImageData(0, 0, this.canvas.width, this.canvas.height);
                    const code = jsQR(imageData.data, imageData.width, imageData.height);

                    if (code) {
                        this.manualTicketId = code.data;
                        this.stopCamera();
                        this.verifyManualTicket();
                        return;
                    }
                }

                requestAnimationFrame(() => this.scanQRCode());
            },

            verifyManualTicket() {
                if (!this.manualTicketId || !this.selectedEventId) {
                    this.resultData = {
                        success: false,
                        message: 'Masukkan Ticket ID dan pilih Event terlebih dahulu',
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
                        setTimeout(() => {
                            this.manualTicketId = '';
                            this.loadStatistics();
                        }, 2000);
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    this.resultData = {
                        success: false,
                        message: 'Terjadi kesalahan saat verifikasi: ' + error.message,
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
