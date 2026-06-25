<div id="sidebar-overlay" class="fixed inset-0 bg-black/60 backdrop-blur-sm z-[40] hidden transition-opacity duration-300"></div>

<aside id="main-sidebar" class="fixed inset-y-0 left-0 w-64 -translate-x-full flex flex-col h-screen border-r border-white/5 p-6 bg-[#09090b]/90 backdrop-blur-xl z-[50] transition-transform duration-300 ease-in-out">

    <div class="flex items-center justify-between mb-8">
        <div class="flex items-center gap-2">
            <div class="w-8 h-8 bg-blue-500 rounded-lg flex items-center justify-center font-bold text-white shadow-[0_0_15px_rgba(59,130,246,0.5)]">T</div>
            <span class="font-extrabold text-xl tracking-tight uppercase text-white">Ticketify</span>
        </div>
        <button id="close-sidebar" class="lg:hidden text-gray-400 hover:text-white transition">
            <i class="fa-solid fa-xmark text-xl"></i>
        </button>
    </div>

    <div class="flex-1 space-y-6 overflow-y-auto custom-scrollbar pr-1">
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

                <a href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
                   class="flex items-center gap-3 p-3 rounded-xl text-sm text-red-400 hover:bg-red-500/10 transition">
                    <i class="fa-solid fa-power-off w-5"></i> Logout
                </a>
                <form action="{{ route('logout') }}" method="POST" id="logout-form" class="hidden">
                    @csrf
                </form>
            </nav>
        </div>
    </div>

    <div class="flex items-center gap-3 mt-auto pt-4 border-t border-white/5">
        @if(auth()->check())
            {{-- MODIFIKASI DISINI: Cek apakah user punya foto profil --}}
            @if(auth()->user()->profile_picture)
                <div class="w-10 h-10 rounded-full overflow-hidden border border-white/10">
                    <img src="{{ asset('storage/' . auth()->user()->profile_picture) }}" alt="Profile" class="w-full h-full object-cover">
                </div>
            @else
                {{-- Fallback ke Inisial Nama jika tidak ada foto profil --}}
                <div class="w-10 h-10 bg-blue-600 rounded-full flex items-center justify-center font-black text-white text-xs uppercase tracking-wider">
                    {{ strtoupper(substr(auth()->user()->name, 0, 2)) }}
                </div>
            @endif

            <div class="flex flex-col min-w-0">
                <p class="text-sm font-bold text-white tracking-tight leading-tight truncate">
                    {{ auth()->user()->name }}
                </p>
                <p class="text-[9px] text-blue-400 font-extrabold uppercase tracking-widest mt-0.5">
                    {{ auth()->user()->role ?? 'PEMBELI' }}
                </p>
            </div>
        @else
            <div class="w-10 h-10 bg-gray-600 rounded-full flex items-center justify-center font-black text-white text-xs uppercase">
                G
            </div>
            <div class="flex flex-col min-w-0">
                <p class="text-sm font-bold text-white truncate">Guest User</p>
                <p class="text-[9px] text-gray-400 font-extrabold uppercase">GUEST</p>
            </div>
        @endif
    </div>

</aside>
