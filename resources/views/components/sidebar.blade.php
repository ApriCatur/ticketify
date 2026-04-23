<aside class="w-64 hidden lg:flex flex-col sticky top-0 h-screen border-r border-white/5 p-6 justify-between bg-[#09090b]">

    <div>
        <!-- Logo -->
        <div class="flex items-center gap-2 mb-8">
            <div class="w-8 h-8 bg-blue-500 rounded-lg flex items-center justify-center font-bold text-white shadow-[0_0_15px_rgba(59,130,246,0.5)]">
                T
            </div>
            <span class="font-extrabold text-xl tracking-tight uppercase text-white">
                Ticketify
            </span>
        </div>

        @php
            $base = "flex items-center gap-3 p-3 rounded-xl text-sm transition";
            $inactive = "text-gray-400 hover:text-white hover:bg-white/5";
            $active = "bg-blue-500 text-white font-bold shadow-lg shadow-blue-500/20";
        @endphp

        <!-- MENU -->
        <div class="space-y-6">

            <!-- MAIN -->
            <div>
                <p class="text-[10px] font-black text-gray-500 uppercase tracking-widest mb-4 border-b border-white/5 pb-2">
                    Main Menu
                </p>

                <nav class="space-y-1">

                    <a href="{{ route('admin.dashboard') }}"
                       class="{{ $base }} {{ request()->routeIs('admin.dashboard') ? $active : $inactive }}">
                        <i class="fa-solid fa-chart-line"></i>
                        Dashboard
                    </a>

                    <a href="{{ route('admin.PublishedEvent') }}"
                       class="{{ $base }} {{ request()->routeIs('admin.PublishedEvent') ? $active : $inactive }}">
                        <i class="fa-solid fa-calendar-check"></i>
                        Published Events
                    </a>

                    <a href="{{ route('admin.PendingEvent') }}"
                       class="{{ $base }} {{ request()->routeIs('admin.PendingEvent') ? $active : $inactive }}">
                        <i class="fa-solid fa-clock"></i>
                        Pending Events
                    </a>

                    <a href="{{ route('admin.ManageUser') }}"
                       class="{{ $base }} {{ request()->routeIs('admin.ManageUser.*') ? $active : $inactive }}">
                        <i class="fa-solid fa-users"></i>
                        Manage Users
                    </a>

                    <a href="{{ route('admin.EventCategories') }}"
                       class="{{ $base }} {{ request()->routeIs('admin.EventCategories') ? $active : $inactive }}">
                        <i class="fa-solid fa-layer-group"></i>
                        Event Categories
                    </a>

                    <a href="{{ route('admin.Settings') }}"
                       class="{{ $base }} {{ request()->routeIs('admin.Settings') ? $active : $inactive }}">
                        <i class="fa-solid fa-gear"></i>
                        Settings
                    </a>

                </nav>
            </div>

        </div>
    </div>

    <!-- LOGOUT -->
    <form method=>
        @csrf
        <button type="submit"
            class="w-full flex items-center gap-3 p-3 rounded-xl text-sm text-red-400 hover:bg-red-500/10 transition">
            <i class="fa-solid fa-power-off"></i>
            Logout
        </button>
    </form>

</aside>
