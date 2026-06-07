@props(['categories'])
<div class="bg-white/5 border border-white/10 backdrop-blur-xl rounded-2xl p-6 shadow-2xl mb-8">
    @php
        // 1. Tentukan route default untuk Guest
        $route = 'guest.event';

        // 2. Jika user login, baru kita cek role-nya
        if (auth()->check()) {
            $userRole = auth()->user()->role;

            if ($userRole === 'pembeli') {
                $route = 'pembeli.event';
            } elseif ($userRole === 'panitia') {
                $route = 'panitia.event';
            }
        }
    @endphp

    <form action="{{ route($route) }}" method="GET" class="grid grid-cols-1 lg:grid-cols-12 gap-6">
        <div class="lg:col-span-4 flex flex-col gap-2">
            <label class="text-[10px] font-bold text-gray-500 uppercase tracking-widest pl-1">SEARCH EVENT NAME</label>
            <div class="relative">
                <i class="fas fa-search absolute left-4 top-1/2 -translate-y-1/2 text-blue-500"></i>
                <input type="text" name="search" value="{{ request('search') }}"
                       placeholder="Seminar, workshop, konser..."
                       class="w-full pl-12 pr-4 py-3 bg-white/5 border border-white/10 rounded-2xl text-white placeholder-gray-600 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all">
            </div>
        </div>

        <div class="lg:col-span-3 flex flex-col gap-2">
            <label class="text-[10px] font-bold text-gray-500 uppercase tracking-widest pl-1">CATEGORY</label>
            <div class="relative">
                <i class="fas fa-tag absolute left-4 top-1/2 -translate-y-1/2 text-blue-500"></i>
                <select name="category_id"
                class="w-full pl-12 pr-4 py-3 bg-white/5 border border-white/10 rounded-2xl text-white appearance-none focus:ring-2 focus:ring-blue-500 transition-all">
        <option value="" class="bg-[#18181b]">Semua</option>
             @foreach($categories as $category)
        <option
            value="{{ $category->id }}"
            class="bg-[#18181b]"
            {{ request('category_id') == $category->id ? 'selected' : '' }}>
            {{ $category->name }}
        </option>
        @endforeach
                </select>
                <i class="fas fa-chevron-down absolute right-4 top-1/2 -translate-y-1/2 text-gray-400 pointer-events-none"></i>
            </div>
        </div>

        <div class="lg:col-span-3 flex flex-col gap-2">
            <label class="text-[10px] font-bold text-gray-500 uppercase tracking-widest pl-1">SELECT DATE</label>
            <div class="relative">
                <i class="fas fa-calendar-alt absolute left-4 top-1/2 -translate-y-1/2 text-blue-500"></i>
                <input type="date" name="date" value="{{ request('date') }}"
                       class="w-full pl-12 pr-4 py-3 bg-white/5 border border-white/10 rounded-2xl text-white focus:ring-2 focus:ring-blue-500 transition-all">
            </div>
        </div>

        <div class="lg:col-span-2 flex items-end">
            <button type="submit"
                    class="w-full py-3 rounded-2xl bg-white hover:bg-blue-600 text-black font-black uppercase shadow-lg transition-all">
                Cari Event
            </button>
        </div>
    </form>
</div>
