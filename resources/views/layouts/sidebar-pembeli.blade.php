<aside class="w-64 hidden lg:flex flex-col sticky top-0 h-screen border-r border-white/5 p-6 space-y-8 bg-[#09090b]">
            <div class="flex items-center gap-2 mb-4">
                <div class="w-8 h-8 bg-blue-500 rounded-lg flex items-center justify-center font-bold text-white">T</div>
                <span class="font-extrabold text-xl tracking-tight uppercase">Ticketify</span>
            </div>

            <!-- ini bagian sidebar -->
             <div class="space-y-6">
                <div>
                    <p class="text-[10px] font-black text-gray-500 uppercase tracking-widest mb-4 border-b border-white/5 pb-2">Home</p>
                    <nav class="space-y-1">
                        <a href="{{ route('pembeli.event') }}" class="flex items-center gap-3 p-3 rounded-xl text-sm text-gray-400 hover:text-white transition @if (Route::is('pembeli.event')){{ 'bg-blue-500 text-white font-bold hover:none ' }}@endif">
                            <i class="fa-solid fa-home"></i> Event
                        </a>
                        <a href="{{ route('pembeli.about') }}" class="flex items-center gap-3 p-3 rounded-xl text-sm text-gray-400 hover:text-white transition truncate @if (Route::is('pembeli.about')){{ 'bg-blue-500 text-white font-bold hover:none ' }}@endif">
                            <i class="fa-solid fa-compass"></i> About Us
                        </a>
                        <a href="{{ route('pembeli.myticket') }}" class="flex items-center gap-3 p-3 rounded-xl text-sm text-gray-400 hover:text-white transition truncate @if (Route::is('pembeli.myticket')){{ 'bg-blue-500 text-white font-bold hover:none ' }}@endif">
                            <i class="fa-solid fa-ticket"></i> My Tickets
                        </a>
                    </nav>
                </div>
                <div>
                    <p class="text-[10px] font-black text-gray-500 uppercase tracking-widest mb-4 border-b border-white/5 pb-2">Lainnya</p>
                    <nav class="space-y-1">
                        <a href="{{ route('pembeli.settings') }}" class="flex items-center gap-3 p-3  rounded-xl text-sm text-gray-400 hover:text-white transition @if (Route::is('pembeli.settings')){{ 'bg-blue-500 text-white font-bold hover:none ' }}@endif">
                            <i class="fa-solid fa-gear"></i> Settings
                        </a>
                        <a href="{{ route('login') }}" class="flex items-center gap-3 p-3  rounded-xl text-sm text-red-400 hover:text-red-400 transition @if (Route::is('login')){{ 'bg-blue-500 text-red-500 font-bold hover:none ' }}@endif">
                            <i class="fa-solid fa-power-off"></i> Logout
                        </a>
                    </nav>
                </div>
            </div>

             <div class="mt-auto pt-6 border-t border-white/5">
        <div class="flex items-center gap-3">
            <div class="w-8 h-8 rounded-full bg-blue-600 flex items-center justify-center font-bold text-xs">AM</div>
            <div class="overflow-hidden">
                <p class="text-xs font-bold text-white truncate">M Fauzi Azhari</p>
                <p class="text-[10px] text-blue-500 font-bold uppercase tracking-wider">Customer</p>
            </div>
        </div>
    </div>

        </aside>
