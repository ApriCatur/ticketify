<!-- Overlay: Menaikkan z-index agar di atas konten tapi di bawah sidebar -->
<div id="sidebar-overlay"
     class="fixed inset-0 bg-black/60 backdrop-blur-sm z-[60] hidden transition-opacity duration-300">
</div>

<!-- Sidebar -->
<aside id="main-sidebar"
    class="fixed inset-y-0 left-0 w-64 -translate-x-full z-[70]
           lg:translate-x-0 lg:sticky lg:top-0 lg:z-0
           flex flex-col h-screen border-r border-white/5 p-6 bg-[#09090b]
           backdrop-blur-xl lg:backdrop-blur-none transition-transform duration-300 ease-in-out">

    <!-- Header Sidebar & Tombol Close Mobile -->
    <div class="flex items-center justify-between mb-8">
        <div class="flex items-center gap-2">
            <div class="w-8 h-8 bg-blue-500 rounded-lg flex items-center justify-center font-bold text-white shadow-[0_0_15px_rgba(59,130,246,0.5)]">T</div>
            <span class="font-extrabold text-xl tracking-tight uppercase text-white">Ticketify</span>
        </div>

        <!-- Tombol Close: Muncul hanya di mobile -->
        <button id="close-sidebar" class="lg:hidden text-gray-400 hover:text-white transition-colors">
            <i class="fa-solid fa-xmark text-2xl"></i>
        </button>
    </div>

    <!-- Navigasi dengan Scrollbar Otomatis jika menu penuh -->
    <div class="flex-1 overflow-y-auto space-y-8 custom-scrollbar">
        <!-- Organizer Menu -->
        <div>
            <p class="text-[10px] font-black text-gray-500 uppercase tracking-widest mb-4 border-b border-white/5 pb-2">Organizer Menu</p>
            <nav class="space-y-1">
                <a href="{{ route('panitia.event') }}" class="flex items-center gap-3 p-3 rounded-xl text-sm transition-all {{ Route::is('panitia.event') ? 'bg-blue-500 text-white font-bold' : 'text-gray-400 hover:text-white hover:bg-white/5' }}">
                    <i class="fa-solid fa-house w-5"></i> Event
                </a>
                <a href="{{ route('panitia.create') }}" class="flex items-center gap-3 p-3 rounded-xl text-sm transition-all {{ Route::is('panitia.create') ? 'bg-blue-500 text-white font-bold' : 'text-gray-400 hover:text-white hover:bg-white/5' }}">
                    <i class="fa-solid fa-calendar-plus w-5"></i> Create Event
                </a>
                <a href="{{ route('panitia.myevent') }}" class="flex items-center gap-3 p-3 rounded-xl text-sm transition-all {{ Route::is(['panitia.myevent', 'panitia.customerdata']) ? 'bg-blue-500 text-white font-bold' : 'text-gray-400 hover:text-white hover:bg-white/5' }}">
                    <i class="fa-solid fa-layer-group w-5"></i> My Event
                </a>
                <a href="{{ route('panitia.attendance') }}" class="flex items-center gap-3 p-3 rounded-xl text-[13px] transition-all {{ Route::is('panitia.attendance') ? 'bg-blue-500 text-white font-bold' : 'text-gray-400 hover:text-white hover:bg-white/5' }}">
                    <i class="fa-solid fa-qrcode w-5"></i> Attendance
                </a>
                <a href="{{ route('panitia.statistic') }}" class="flex items-center gap-3 p-3 rounded-xl text-sm transition-all {{ Route::is(['panitia.statistic', 'panitia.statistic2']) ? 'bg-blue-500 text-white font-bold' : 'text-gray-400 hover:text-white hover:bg-white/5' }}">
                    <i class="fa-solid fa-chart-line w-5"></i> Statistik
                </a>
            </nav>
        </div>

        <!-- Lainnya -->
        <div>
            <p class="text-[10px] font-black text-gray-500 uppercase tracking-widest mb-4 border-b border-white/5 pb-2">Lainnya</p>
            <nav class="space-y-1">
                <a href="{{ route('panitia.settings') }}" class="flex items-center gap-3 p-3 rounded-xl text-sm transition-all {{ Route::is('panitia.settings') ? 'bg-blue-500 text-white font-bold' : 'text-gray-400 hover:text-white hover:bg-white/5' }}">
                    <i class="fa-solid fa-gear w-5"></i> Settings
                </a>
                <a href="{{ route('login') }}" class="flex items-center gap-3 p-3 rounded-xl text-sm text-red-400 hover:bg-red-500/10 transition mt-4">
                    <i class="fa-solid fa-power-off w-5"></i> Logout
                </a>
            </nav>
        </div>
    </div>

    <!-- Profil Section (Bottom) -->
    <div class="mt-auto pt-6 border-t border-white/5">
        <div class="flex items-center gap-3 bg-white/5 p-3 rounded-2xl">
            <div class="w-9 h-9 rounded-full bg-green-600 flex items-center justify-center font-bold text-xs text-white">AM</div>
            <div class="overflow-hidden">
                <p class="text-xs font-bold text-white truncate">Ari Maverick</p>
                <p class="text-[10px] text-green-500 font-bold uppercase tracking-wider flex items-center gap-1">
                    <span class="w-1.5 h-1.5 bg-green-500 rounded-full animate-pulse"></span> Online
                </p>
            </div>
        </div>
    </div>
</aside>

<style>
    /* Agar scrollbar navigasi terlihat tipis dan modern */
    .custom-scrollbar::-webkit-scrollbar { width: 3px; }
    .custom-scrollbar::-webkit-scrollbar-thumb { background: rgba(255,255,255,0.1); border-radius: 10px; }
</style>
