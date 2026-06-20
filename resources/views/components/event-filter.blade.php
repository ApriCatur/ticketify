@props(['categories'])
@php
    $route = 'guest.event';
    if (auth()->check()) {
        $userRole = auth()->user()->role;
        $route = match($userRole) {
            'pembeli' => 'pembeli.event',
            'panitia' => 'panitia.event',
            'admin'   => 'admin.PublishedEvent',
            default   => 'guest.event',
        };
    }
@endphp

<div class="bg-[#161616] border border-white/[0.04] rounded-2xl p-5">
    <form action="{{ route($route) }}" method="GET" class="flex flex-col lg:flex-row gap-3">
        <div class="flex-1 relative">
            <i class="fas fa-search absolute left-4 top-1/2 -translate-y-1/2 text-gray-600 text-xs"></i>
            <input type="text" name="search" value="{{ request('search') }}"
                   placeholder="Cari event..."
                   class="w-full pl-10 pr-4 py-2.5 bg-[#1e1e1e] border border-white/[0.04] rounded-xl text-sm text-gray-200 placeholder:text-gray-700 focus:border-blue-500/40 focus:ring-0 outline-none transition-all">
        </div>

        <div class="relative lg:w-44">
            <i class="fas fa-tag absolute left-4 top-1/2 -translate-y-1/2 text-gray-600 text-xs"></i>
            <select name="category_id"
                    class="w-full pl-10 pr-8 py-2.5 bg-[#1e1e1e] border border-white/[0.04] rounded-xl text-sm text-gray-400 appearance-none focus:border-blue-500/40 outline-none transition-all cursor-pointer">
                <option value="" class="bg-[#1e1e1e]">Semua Kategori</option>
                @foreach($categories as $category)
                    <option value="{{ $category->id }}" class="bg-[#1e1e1e]" {{ request('category_id') == $category->id ? 'selected' : '' }}>
                        {{ $category->name }}
                    </option>
                @endforeach
            </select>
            <i class="fas fa-chevron-down absolute right-4 top-1/2 -translate-y-1/2 text-gray-600 pointer-events-none text-[10px]"></i>
        </div>

        <div class="relative lg:w-44">
            <i class="fas fa-calendar-alt absolute left-4 top-1/2 -translate-y-1/2 text-gray-600 text-xs"></i>
            <input type="date" name="date" value="{{ request('date') }}"
                   class="w-full pl-10 pr-4 py-2.5 bg-[#1e1e1e] border border-white/[0.04] rounded-xl text-sm text-gray-400 focus:border-blue-500/40 outline-none transition-all [color-scheme:dark]">
        </div>

        <button type="submit"
                class="px-6 py-2.5 bg-gradient-to-r from-blue-500 to-blue-600 hover:from-blue-600 hover:to-blue-700 text-white rounded-xl text-xs font-bold uppercase tracking-widest transition-all duration-300 shadow-lg shadow-blue-500/10 active:scale-[0.97] whitespace-nowrap">
            <i class="fa-solid fa-magnifying-glass mr-1.5"></i> Cari
        </button>
    </form>
</div>
