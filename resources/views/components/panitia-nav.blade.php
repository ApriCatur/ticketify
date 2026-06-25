<nav class="sticky top-0 z-50 bg-white border-b border-gray-100 shadow-sm">
    <div class="flex items-center justify-between h-16 px-4 sm:px-6 lg:px-8">
        <div class="flex items-center gap-6">
            <a href="{{ route('panitia.event') }}" class="flex items-center gap-2 flex-shrink-0">
                <div class="w-7 h-7 bg-blue-600 rounded-lg flex items-center justify-center font-extrabold text-white text-xs">T</div>
                <span class="font-extrabold text-lg tracking-tight text-gray-900">Ticketify</span>
            </a>

            <div class="hidden md:flex items-center gap-1">
                <a href="{{ route('panitia.event') }}"
                   class="px-3 py-2 text-sm font-medium rounded-lg transition-colors {{ request()->routeIs('panitia.event') ? 'text-blue-600 bg-blue-50' : 'text-gray-600 hover:text-blue-600 hover:bg-gray-50' }}">
                    Event
                </a>
                <a href="{{ route('panitia.create') }}"
                   class="px-3 py-2 text-sm font-medium rounded-lg transition-colors {{ request()->routeIs('panitia.create') ? 'text-blue-600 bg-blue-50' : 'text-gray-600 hover:text-blue-600 hover:bg-gray-50' }}">
                    Buat Event
                </a>
                <a href="{{ route('panitia.myevent') }}"
                   class="px-3 py-2 text-sm font-medium rounded-lg transition-colors {{ request()->routeIs('panitia.myevent') || request()->routeIs('panitia.customerdata') ? 'text-blue-600 bg-blue-50' : 'text-gray-600 hover:text-blue-600 hover:bg-gray-50' }}">
                    My Event
                </a>
                <a href="{{ route('panitia.attendance') }}"
                   class="px-3 py-2 text-sm font-medium rounded-lg transition-colors {{ request()->routeIs('panitia.attendance') ? 'text-blue-600 bg-blue-50' : 'text-gray-600 hover:text-blue-600 hover:bg-gray-50' }}">
                    Attendance
                </a>
                <a href="{{ route('panitia.statistic') }}"
                   class="px-3 py-2 text-sm font-medium rounded-lg transition-colors {{ request()->is('panitia/statistic*') ? 'text-blue-600 bg-blue-50' : 'text-gray-600 hover:text-blue-600 hover:bg-gray-50' }}">
                    Statistik
                </a>
            </div>
        </div>

        <div class="flex items-center gap-1">
            <a href="{{ route('panitia.settings') }}"
               class="p-2 text-gray-500 hover:text-blue-600 hover:bg-gray-50 rounded-lg transition-colors"
               title="Settings">
                <i class="fa-solid fa-gear text-lg"></i>
            </a>
            <a href="#"
               onclick="event.preventDefault(); document.getElementById('logout-form-nav').submit();"
               class="p-2 text-gray-500 hover:text-red-600 hover:bg-red-50 rounded-lg transition-colors"
               title="Logout">
                <i class="fa-solid fa-power-off text-lg"></i>
            </a>
            <form action="{{ route('logout') }}" method="POST" id="logout-form-nav" class="hidden">@csrf</form>
        </div>
    </div>
</nav>
