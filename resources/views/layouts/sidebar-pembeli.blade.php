<!-- Overlay (Muncul saat sidebar mobile dibuka) -->
<div id="sidebar-overlay" class="fixed inset-0 bg-black/60 backdrop-blur-sm z-[40] hidden lg:hidden transition-opacity duration-300"></div>

<!-- Sidebar -->
<aside id="main-sidebar"
    class="fixed inset-y-0 left-0 w-64 -translate-x-full lg:translate-x-0 lg:sticky lg:flex flex-col h-screen border-r border-white/5 p-6 space-y-8 bg-[#09090b]/90 lg:bg-[#09090b] backdrop-blur-xl lg:backdrop-blur-none z-[50] transition-transform duration-300 ease-in-out">

    <!-- Logo Section -->
    <div class="flex items-center justify-between mb-4">
        <div class="flex items-center gap-2">
            <div class="w-8 h-8 bg-blue-500 rounded-lg flex items-center justify-center font-bold text-white shadow-[0_0_15px_rgba(59,130,246,0.5)]">T</div>
            <span class="font-extrabold text-xl tracking-tight uppercase text-white">Ticketify</span>
        </div>
        <!-- Tombol Close (Hanya muncul di Mobile) -->
        <button id="close-sidebar" class="lg:hidden text-gray-400 hover:text-white">
            <i class="fa-solid fa-xmark text-xl"></i>
        </button>
    </div>

    <!-- Navigasi -->
    <div class="space-y-6 overflow-y-auto custom-scrollbar">
        <div>
            <p class="text-[10px] font-black text-gray-500 uppercase tracking-widest mb-4 border-b border-white/5 pb-2">Home</p>
            <nav class="space-y-1">
                <a href="{{ route('pembeli.event') }}" class="flex items-center gap-3 p-3 rounded-xl text-sm transition {{ Route::is('pembeli.event') ? 'bg-blue-600 text-white font-bold shadow-lg shadow-blue-500/20' : 'text-gray-400 hover:text-white hover:bg-white/5' }}">
                    <i class="fa-solid fa-home w-5"></i> Event
                </a>
                <a href="{{ route('pembeli.about') }}" class="flex items-center gap-3 p-3 rounded-xl text-sm transition {{ Route::is('pembeli.about') ? 'bg-blue-600 text-white font-bold' : 'text-gray-400 hover:text-white hover:bg-white/5' }}">
                    <i class="fa-solid fa-compass w-5"></i> About Us
                </a>
                <a href="{{ route('pembeli.myticket') }}" class="flex items-center gap-3 p-3 rounded-xl text-sm transition {{ Route::is('pembeli.myticket') ? 'bg-blue-600 text-white font-bold' : 'text-gray-400 hover:text-white hover:bg-white/5' }}">
                    <i class="fa-solid fa-ticket w-5"></i> My Tickets
                </a>
            </nav>
        </div>

        <div>
            <p class="text-[10px] font-black text-gray-500 uppercase tracking-widest mb-4 border-b border-white/5 pb-2">Lainnya</p>
            <nav class="space-y-1">
                <a href="{{ route('pembeli.settings') }}" class="flex items-center gap-3 p-3 rounded-xl text-sm transition {{ Route::is('pembeli.settings') ? 'bg-blue-600 text-white font-bold' : 'text-gray-400 hover:text-white hover:bg-white/5' }}">
                    <i class="fa-solid fa-gear w-5"></i> Settings
                </a>
                <a href="{{ route('login') }}" class="flex items-center gap-3 p-3 rounded-xl text-sm text-red-400 hover:bg-red-500/10 transition">
                    <i class="fa-solid fa-power-off w-5"></i> Logout
                </a>
            </nav>
        </div>
    </div>

    <!-- User Profile Footer -->
    <div class="mt-auto pt-6 border-t border-white/5">
        <div class="flex items-center gap-3">
            <div class="w-8 h-8 rounded-full bg-blue-600 flex items-center justify-center font-bold text-xs text-white">AM</div>
            <div class="overflow-hidden">
                <p class="text-xs font-bold text-white truncate">M Fauzi Azhari</p>
                <p class="text-[10px] text-blue-500 font-bold uppercase tracking-wider">Customer</p>
            </div>
        </div>
    </div>
</aside>
