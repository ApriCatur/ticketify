<aside class="w-64 bg-white border-r border-slate-200 shadow-sm p-6 flex flex-col justify-between">

    <div>
        <h1 class="text-xl font-semibold text-slate-800 mb-8 flex items-center gap-2">
            <div class="w-8 h-8 flex items-center justify-center rounded-lg bg-indigo-100 text-indigo-600">
                <i class="fa-solid fa-ticket"></i>
            </div>
            Ticketify
        </h1>

        <nav class="space-y-2 text-sm">

            <a href="{{ route('admin.dashboard') }}"
               class="flex items-center gap-3 px-4 py-3 rounded-xl transition
               {{ request()->routeIs('admin.dashboard')
               ? 'bg-indigo-50 text-indigo-600 font-medium'
               : 'text-slate-600 hover:bg-slate-100' }}">
                <i class="fa-solid fa-chart-line"></i>
                Dashboard
            </a>

            <a href="{{ route('admin.published') }}"
               class="flex items-center gap-3 px-4 py-3 rounded-xl transition
               {{ request()->routeIs('admin.published')
               ? 'bg-indigo-50 text-indigo-600 font-medium'
               : 'text-slate-600 hover:bg-slate-100' }}">
                <i class="fa-solid fa-calendar-check"></i>
                Published Events
            </a>

            <a href="{{ route('admin.pending') }}"
               class="flex items-center gap-3 px-4 py-3 rounded-xl transition
               {{ request()->routeIs('admin.pending')
               ? 'bg-indigo-50 text-indigo-600 font-medium'
               : 'text-slate-600 hover:bg-slate-100' }}">
                <i class="fa-solid fa-clock"></i>
                Pending Events
            </a>

            <a href="{{ route('admin.users') }}"
               class="flex items-center gap-3 px-4 py-3 rounded-xl transition
               {{ request()->routeIs('admin.users')
               ? 'bg-indigo-50 text-indigo-600 font-medium'
               : 'text-slate-600 hover:bg-slate-100' }}">
                <i class="fa-solid fa-users"></i>
                Manage Users
            </a>

            <a href="{{ route('admin.categories') }}"
               class="flex items-center gap-3 px-4 py-3 rounded-xl transition
               {{ request()->routeIs('admin.categories')
               ? 'bg-indigo-50 text-indigo-600 font-medium'
               : 'text-slate-600 hover:bg-slate-100' }}">
                <i class="fa-solid fa-layer-group"></i>
                Event Categories
            </a>

            <a href="{{ route('admin.settings') }}"
               class="flex items-center gap-3 px-4 py-3 rounded-xl transition
               {{ request()->routeIs('admin.settings')
               ? 'bg-indigo-50 text-indigo-600 font-medium'
               : 'text-slate-600 hover:bg-slate-100' }}">
                <i class="fa-solid fa-gear"></i>
                Settings
            </a>

        </nav>
    </div>

    <a href="#"
       class="flex items-center gap-3 px-4 py-3 rounded-xl text-slate-500 hover:bg-red-50 hover:text-red-500 transition">
        <i class="fa-solid fa-right-from-bracket"></i>
        Logout
    </a>

</aside>
