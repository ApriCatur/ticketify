 <aside class="w-64 hidden lg:flex flex-col sticky top-0 h-screen border-r border-white/5 p-6 space-y-8 bg-[#09090b]">
        <div class="flex items-center gap-2 mb-4">
            <div class="w-8 h-8 bg-blue-500 rounded-lg flex items-center justify-center font-bold text-white shadow-[0_0_15px_rgba(59,130,246,0.5)]">T</div>
            <span class="font-extrabold text-xl tracking-tight uppercase">Ticketify</span>
        </div>

        <div class="space-y-6">
            <div>
                <p class="text-[10px] font-black text-gray-500 uppercase tracking-widest mb-4 border-b border-white/5 pb-2">Organizer Menu</p>
                <nav class="space-y-1">
                    <a href="{{ route('panitia.event') }}" class="flex items-center gap-3 p-3  rounded-xl text-sm text-gray-400 hover:text-white transition @if (Route::is('panitia.event')){{ 'bg-blue-500 text-white font-bold hover:none ' }}@endif">
                        <i class="fa-solid fa-house"></i> Event
                    </a>
                    <a href="{{ route('panitia.create') }}" class="flex items-center gap-3 p-3  rounded-xl text-sm text-gray-400 hover:text-white transition @if (Route::is('panitia.create')){{ 'bg-blue-500 text-white font-bold hover:none ' }}@endif">
                        <i class="fa-solid fa-calendar-plus"></i> Create Event
                    </a>
                    <a href="{{ route('panitia.myevent') }}" class="flex items-center gap-3 p-3  rounded-xl text-sm text-gray-400 hover:text-white transition  @if (Route::is('panitia.myevent')){{ 'bg-blue-500 text-white font-bold hover:none ' }}@endif">
                        <i class="fa-solid fa-layer-group"></i> My Event
                    </a>
                    <a href="{{ route('panitia.attendance') }}" class="flex items-center gap-3 p-3  rounded-xl text-[13px] text-gray-400 hover:text-white transition @if (Route::is('panitia.attendance')){{ 'bg-blue-500 text-white font-bold hover:none ' }}@endif">
                        <i class="fa-solid fa-qrcode"></i> Attendance Verification
                    </a>
                    <a href="{{ route('panitia.statistic') }}" class="flex items-center gap-3 p-3  rounded-xl text-sm text-gray-400 hover:text-white transition @if (Route::is('panitia.statistic')){{ 'bg-blue-500 text-white font-bold hover:none ' }}@endif">
                        <i class="fa-solid fa-chart-line"></i> Statistik
                    </a>
                </nav>
            </div>

            <div>
                <p class="text-[10px] font-black text-gray-500 uppercase tracking-widest mb-4 border-b border-white/5 pb-2">Lainnya</p>
                <nav class="space-y-1">
                    <a href="#" class="flex items-center gap-3 p-3 hover:bg-white/5 rounded-xl text-sm text-gray-400 hover:text-white transition">
                        <i class="fa-solid fa-gear"></i> Settings
                    </a>
                    <a href="{{ route('login') }}" class="flex items-center gap-3 p-3 hover:bg-white/5 rounded-xl text-sm text-red-400 transition mt-4 @if (Route::is('login')){{ 'bg-blue-500 text-white font-bold hover:none ' }}@endif">
                        <i class="fa-solid fa-power-off"></i> Logout
                    </a>
                </nav>
            </div>
        </div>

        <div class="mt-auto pt-6 border-t border-white/5">
            <div class="flex items-center gap-3">
                <div class="w-8 h-8 rounded-full bg-green-600 flex items-center justify-center font-bold text-xs">AM</div>
                <div class="overflow-hidden">
                    <p class="text-xs font-bold text-white truncate">Ari Maverick</p>
                    <p class="text-[10px] text-green-500 font-bold uppercase tracking-wider">Panitia</p>
                </div>
            </div>
        </div>
    </aside>
