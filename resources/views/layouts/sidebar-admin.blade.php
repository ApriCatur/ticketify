<div id="sidebar-overlay" class="fixed inset-0 bg-black/60 backdrop-blur-sm z-[40] hidden lg:hidden transition-opacity duration-300"></div>

<aside id="main-sidebar" class="fixed inset-y-0 left-0 w-64 -translate-x-full lg:translate-x-0 lg:sticky lg:top-0 flex flex-col h-screen border-r border-white/5 p-6 bg-[#09090b] z-[50] transition-transform duration-300 ease-in-out">

    <div class="flex items-center justify-between mb-8">
        <div class="flex items-center gap-2">
            <div class="w-8 h-8 bg-blue-500 rounded-lg flex items-center justify-center font-bold text-white shadow-[0_0_15px_rgba(59,130,246,0.5)]">T</div>
            <span class="font-extrabold text-xl tracking-tight uppercase text-white">Ticketify</span>
        </div>
        <button id="close-sidebar" class="lg:hidden text-gray-400 hover:text-white transition">
            <i class="fa-solid fa-xmark text-xl"></i>
        </button>
    </div>

    @php
        $base = "flex items-center gap-3 p-3 rounded-xl text-sm transition-all";
        $inactive = "text-gray-400 hover:text-white hover:bg-white/5";
        $active = "bg-blue-600 text-white font-bold shadow-lg shadow-blue-500/20";
    @endphp

    <div class="flex-1 space-y-6 overflow-y-auto custom-scrollbar pr-1">
        <div>
            <nav class="space-y-1">
                <a href="{{ route('admin.dashboard') }}" class="{{ $base }} {{ request()->routeIs('admin.dashboard') ? $active : $inactive }}">
                    <i class="fa-solid fa-chart-line w-5"></i> Dashboard
                </a>
                <a href="{{ route('admin.PublishedEvent') }}" class="{{ $base }} {{ request()->routeIs('admin.PublishedEvent') ? $active : $inactive }}">
                    <i class="fa-solid fa-calendar-check w-5"></i> Published Events
                </a>
                <a href="{{ route('admin.PendingEvent') }}" class="{{ $base }} {{ request()->routeIs('admin.PendingEvent') ? $active : $inactive }}">
                    <i class="fa-solid fa-clock w-5"></i> Pending Events
                </a>
                <a href="{{ route('admin.users') }}" class="{{ $base }} {{ request()->routeIs('admin.users') ? $active : $inactive }}">
                    <i class="fa-solid fa-users w-5"></i> Manage Users
                </a>
                <a href="{{ route('admin.role-applications') }}" class="{{ $base }} {{ request()->routeIs('admin.role-applications') ? $active : $inactive }}">
                    <i class="fa-solid fa-user-tie w-5"></i> Role Applications
                </a>
                <a href="{{ route('admin.categories') }}" class="{{ $base }} {{ request()->routeIs('admin.categories') ? $active : $inactive }}">
                    <i class="fa-solid fa-layer-group w-5"></i> Event Categories
                </a>
            </nav>
        </div>

        <div>
            <p class="text-[10px] font-black text-gray-500 uppercase tracking-widest mb-4 border-b border-white/5 pb-2">Other</p>
            <nav class="space-y-1">
                <a href="{{ route('admin.event-statistics') }}" class="{{ $base }} {{ request()->routeIs('admin.event-statistics*') ? $active : $inactive }}">
                    <i class="fa-solid fa-chart-pie w-5"></i> Statistik Event
                </a>
                <a href="{{ route('admin.Settings') }}" class="{{ $base }} {{ request()->routeIs('admin.Settings') ? $active : $inactive }}">
                    <i class="fa-solid fa-gear w-5"></i> Settings
                </a>

                <a href="#" onclick="event.preventDefault(); document.getElementById('logout-form-admin').submit();"
                   class="flex items-center gap-3 p-3 rounded-xl text-sm text-red-400 hover:bg-red-500/10 transition-all mt-4">
                    <i class="fa-solid fa-power-off w-5"></i> Logout
                </a>
                <form action="{{ route('logout') }}" method="POST" id="logout-form-admin" class="hidden">
                    @csrf
                </form>
            </nav>
        </div>
    </div>

    <div class="mt-auto pt-6 border-t border-white/5">
        <div class="flex items-center gap-3">
            <div class="w-8 h-8 rounded-full bg-amber-600 flex items-center justify-center font-bold text-xs text-white uppercase tracking-wider flex-shrink-0">
                {{ strtoupper(substr(Auth::user()->name, 0, 2)) }}
            </div>
            <div class="overflow-hidden min-w-0 flex-1">
                <p class="text-xs font-bold text-white truncate">{{ Auth::user()->name }}</p>
                <p class="text-[10px] text-amber-500 font-bold uppercase tracking-wider">{{ Auth::user()->role ?? 'ADMINISTRATOR' }}</p>
            </div>
        </div>
    </div>
</aside>

<style>
    .custom-scrollbar::-webkit-scrollbar { width: 3px; }
    .custom-scrollbar::-webkit-scrollbar-thumb { background: rgba(255,255,255,0.1); border-radius: 10px; }
</style>
