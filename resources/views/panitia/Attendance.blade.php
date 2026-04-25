<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ticketify - Attendance Verification</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body class="bg-[#09090b] text-white flex" x-data="{ isScanning: true, showResult: false }">

    @include('layouts.sidebar-panitia')
    
    <main class="flex-1 p-10 overflow-y-auto">
        <header class="mb-10">
            <h1 class="text-3xl font-black tracking-tight">Attendance Verification</h1>
            <p class="text-gray-500 text-sm mt-2">Scan QR Code pada tiket peserta untuk melakukan verifikasi kehadiran.</p>
        </header>

        <div class="grid lg:grid-cols-12 gap-10">

            <div class="lg:col-span-7 space-y-6">
                <div class="relative bg-[#121212] rounded-[2.5rem] border border-white/5 overflow-hidden aspect-square md:aspect-video flex items-center justify-center border-2">

                    <div class="absolute inset-0 z-10 pointer-events-none">
                        <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-64 h-64 border-2 border-blue-500/50 rounded-3xl">
                            <div class="absolute top-0 left-0 w-full h-1 bg-blue-500 shadow-[0_0_15px_rgba(59,130,246,1)] animate-bounce mt-32"></div>
                        </div>
                        <div class="absolute inset-0 bg-black/40"></div>
                    </div>

                    <div class="text-center space-y-4">
                        <i class="fa-solid fa-camera text-5xl text-gray-700"></i>
                        <p class="text-xs text-gray-500 font-bold uppercase tracking-widest">Kamera sedang aktif...</p>
                        <button @click="showResult = true" class="mt-4 px-6 py-2 bg-blue-600 rounded-full text-[10px] font-black uppercase tracking-widest">Simulasi Scan Berhasil</button>
                    </div>
                </div>

                <div class="bg-[#121212] p-8 rounded-3xl border border-white/5">
                    <label class="text-[10px] font-black text-gray-500 uppercase tracking-widest ml-1 mb-4 block">Input Ticket ID Manual</label>
                    <div class="flex gap-3">
                        <input type="text" placeholder="Contoh: TCK-992812" class="flex-1 bg-[#18181b] border border-white/5 rounded-xl px-4 py-3 text-sm focus:border-blue-500 outline-none">
                        <button class="bg-white/5 hover:bg-white/10 px-6 rounded-xl text-xs font-bold transition-all border border-white/5">Verifikasi</button>
                    </div>
                </div>
            </div>

            <div class="lg:col-span-5 space-y-6">

                <template x-if="showResult">
                    <div class="bg-green-500/10 border border-green-500/50 p-8 rounded-[2rem] animate-in fade-in zoom-in duration-300">
                        <div class="flex items-start gap-4">
                            <div class="w-12 h-12 bg-green-500 rounded-2xl flex items-center justify-center text-white text-xl">
                                <i class="fa-solid fa-check-double"></i>
                            </div>
                            <div class="flex-1">
                                <h4 class="font-black text-green-500 uppercase tracking-widest text-xs">Tiket Valid</h4>
                                <p class="text-lg font-black mt-1">Ari Maverick</p>
                                <p class="text-xs text-gray-400">Reguler Ticket • KMIPN VII</p>
                                <button @click="showResult = false" class="mt-4 text-[10px] font-bold text-gray-500 hover:text-white uppercase tracking-tighter">Tutup</button>
                            </div>
                        </div>
                    </div>
                </template>

                <div class="bg-[#121212] p-8 rounded-[2.5rem] border border-white/5">
                    <h3 class="text-sm font-black uppercase tracking-widest mb-6 flex items-center gap-2">
                        <i class="fa-solid fa-clock-rotate-left text-blue-500"></i> Recent Scans
                    </h3>
                    <div class="space-y-4">
                        <div class="flex items-center gap-4 p-4 bg-white/[0.02] rounded-2xl border border-white/5">
                            <div class="w-10 h-10 rounded-full bg-blue-600/20 text-blue-500 flex items-center justify-center font-bold text-xs">AM</div>
                            <div class="flex-1 overflow-hidden">
                                <p class="text-xs font-bold truncate text-white">Ari Maverick</p>
                                <p class="text-[10px] text-gray-500">2 Menit yang lalu</p>
                            </div>
                            <span class="text-[9px] font-black bg-blue-500/10 text-blue-500 px-2 py-1 rounded-md uppercase">Reguler</span>
                        </div>
                        <div class="flex items-center gap-4 p-4 bg-white/[0.02] rounded-2xl border border-white/5">
                            <div class="w-10 h-10 rounded-full bg-purple-600/20 text-purple-500 flex items-center justify-center font-bold text-xs">JD</div>
                            <div class="flex-1 overflow-hidden">
                                <p class="text-xs font-bold truncate text-white">John Doe</p>
                                <p class="text-[10px] text-gray-500">5 Menit yang lalu</p>
                            </div>
                            <span class="text-[9px] font-black bg-yellow-500/10 text-yellow-500 px-2 py-1 rounded-md uppercase">VIP</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

</body>
</html>
