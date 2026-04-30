<div id="sidebar-overlay" class="fixed inset-0 bg-black/60 backdrop-blur-sm z-[40] hidden lg:hidden transition-opacity duration-300"></div>

<!-- Sidebar -->
<aside id="main-sidebar"
    class="fixed inset-y-0 left-0 w-64 -translate-x-full lg:translate-x-0 lg:sticky lg:flex flex-col h-screen border-r border-white/5 p-6 space-y-8 bg-[#09090b]/90 lg:bg-[#09090b] backdrop-blur-xl lg:backdrop-blur-none z-[50] transition-transform duration-300 ease-in-out">

            <div class="flex items-center gap-2 mb-4">
                <div class="w-8 h-8 bg-blue-500 rounded-lg flex items-center justify-center font-bold text-white">T</div>
                <span class="font-extrabold text-xl tracking-tight uppercase">Ticketify</span>
            </div>

            <!-- ini bagian sidebar -->
             <div class="space-y-6">
                <div>
                    <p class="text-[10px] font-black text-gray-500 uppercase tracking-widest mb-4 border-b border-white/5 pb-2">Home</p>
                    <nav class="space-y-1">
                        <a href="{{ route('registrasi.event') }}" class="flex items-center gap-3 p-3 rounded-xl text-sm text-gray-400 hover:text-white transition @if (Route::is('registrasi.event')){{ 'bg-blue-500 text-white font-bold hover:none ' }}@endif">
                            <i class="fa-solid fa-home"></i> Event
                        </a>
                        <a href="{{ route('registrasi.about') }}" class="flex items-center gap-3 p-3 rounded-xl text-sm text-gray-400 hover:text-white transition truncate @if (Route::is('registrasi.about')){{ 'bg-blue-500 text-white font-bold hover:none ' }}@endif">
                            <i class="fa-solid fa-compass"></i> About Us
                        </a>
                        <a href="{{ route('registrasi.myticket') }}" class="flex items-center gap-3 p-3 rounded-xl text-sm text-gray-400 hover:text-white transition truncate @if (Route::is('registrasi.myticket')){{ 'bg-blue-500 text-white font-bold hover:none ' }}@endif">
                            <i class="fa-solid fa-ticket"></i> My Tickets
                        </a>
                    </nav>
                </div>
                <div>
                    <p class="text-[10px] font-black text-gray-500 uppercase tracking-widest mb-4 border-b border-white/5 pb-2">Lainnya</p>
                    <nav class="space-y-1">
                        <a href="{{ route('registrasi.settings') }}" class="flex items-center gap-3 p-3  rounded-xl text-sm text-gray-400 hover:text-white transition @if (Route::is('registrasi.settings')){{ 'bg-blue-500 text-white font-bold hover:none ' }}@endif">
                            <i class="fa-solid fa-gear"></i> Settings
                        </a>

                    </nav>
                </div>
            </div>

        </aside>
