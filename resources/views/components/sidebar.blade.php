@props([
    'navSections' => [],
    'roleLabel' => '',
    'avatarClass' => 'bg-amber-600',
    'roleTextClass' => 'text-amber-500',
    'logoutFormId' => 'logout-form',
])

<div id="sidebar-overlay" class="fixed inset-0 bg-black/60 backdrop-blur-sm z-[40] hidden transition-opacity duration-300"></div>

<aside id="main-sidebar"
    class="fixed inset-y-0 left-0 w-64 -translate-x-full lg:translate-x-0 lg:sticky lg:top-0 flex flex-col h-screen border-r border-white/5 p-6 bg-[#09090b] z-[50] transition-transform duration-300 ease-in-out">

    <div class="flex items-center justify-between mb-8">
        <div class="flex items-center gap-2">
            <div class="w-8 h-8 bg-blue-500 rounded-lg flex items-center justify-center font-bold text-white shadow-[0_0_15px_rgba(59,130,246,0.5)]">T</div>
            <span class="font-extrabold text-xl tracking-tight uppercase text-white">Ticketify</span>
        </div>
        <button id="close-sidebar" class="lg:hidden text-gray-400 hover:text-white transition-colors">
            <i class="fa-solid fa-xmark text-xl"></i>
        </button>
    </div>

    @php
        $base = "flex items-center gap-3 p-3 rounded-xl text-sm transition-all";
        $inactive = "text-gray-400 hover:text-white hover:bg-white/5";
        $active = "bg-blue-600 text-white font-bold shadow-lg shadow-blue-500/20";
    @endphp

    <div class="flex-1 space-y-6 overflow-y-auto custom-scrollbar pr-1">
        @foreach($navSections as $section)
            <div>
                @if($section['title'] ?? false)
                    <p class="text-[10px] font-black text-gray-500 uppercase tracking-widest mb-4 border-b border-white/5 pb-2">{{ $section['title'] }}</p>
                @endif
                <nav class="space-y-1">
                    @foreach($section['items'] as $item)
                        @php
                            $isActive = $item['active'] ?? false;
                            if (is_string($isActive)) {
                                $isActive = request()->routeIs($isActive);
                            }
                        @endphp
                        <a href="{{ $item['route'] }}"
                            class="{{ $base }} {{ $isActive ? $active : $inactive }}">
                            <i class="fa-solid {{ $item['icon'] }} w-5"></i>
                            {{ $item['label'] }}
                        </a>
                    @endforeach
                </nav>
            </div>
        @endforeach

        <div>
            <p class="text-[10px] font-black text-gray-500 uppercase tracking-widest mb-4 border-b border-white/5 pb-2">Menu</p>
            <nav class="space-y-1">
                <a href="#" onclick="event.preventDefault(); document.getElementById('{{ $logoutFormId }}').submit();"
                    class="flex items-center gap-3 p-3 rounded-xl text-sm text-red-400 hover:bg-red-500/10 transition-all mt-4">
                    <i class="fa-solid fa-power-off w-5"></i> Logout
                </a>
                <form action="{{ route('logout') }}" method="POST" id="{{ $logoutFormId }}" class="hidden">
                    @csrf
                </form>
            </nav>
        </div>
    </div>

    <div class="mt-auto pt-6 border-t border-white/5">
        <div class="flex items-center gap-3">
            @auth
                @if(Auth::user()->profile_picture && \Illuminate\Support\Facades\Storage::disk('public')->exists(Auth::user()->profile_picture))
                    <img src="{{ asset('storage/' . Auth::user()->profile_picture) }}"
                        class="w-8 h-8 rounded-full object-cover flex-shrink-0 border border-white/10" alt="Profile">
                @else
                    <div class="w-8 h-8 rounded-full {{ $avatarClass }} flex items-center justify-center font-bold text-xs text-white uppercase tracking-wider flex-shrink-0">
                        {{ strtoupper(substr(Auth::user()->name, 0, 2)) }}
                    </div>
                @endif
                <div class="overflow-hidden min-w-0 flex-1">
                    <p class="text-xs font-bold text-white truncate">{{ Auth::user()->name }}</p>
                    <p class="text-[10px] {{ $roleTextClass }} font-bold uppercase tracking-wider">{{ $roleLabel }}</p>
                </div>
            @endauth
        </div>
    </div>
</aside>

<style>
    .custom-scrollbar::-webkit-scrollbar { width: 3px; }
    .custom-scrollbar::-webkit-scrollbar-thumb { background: rgba(255,255,255,0.1); border-radius: 10px; }
</style>

<script>
(function() {
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
})();
</script>
