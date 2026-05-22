<!-- resources/views/components/event-card.blade.php -->
@props([
    'image',
    'day',
    'month',
    'year',
    'category',
    'title',
    'location',
    'startTime', // Ubah nama dari 'time' jadi 'startTime' agar lebih jelas
    'endTime',   // Tambahan baru
    'price'
])

<div class="group bg-[#1e1e1e] border border-white/5 rounded-2xl overflow-hidden hover:border-blue-500/50 transition-all duration-300 spotify-shadow">
    <div class="relative h-44 overflow-hidden">
        <img src="{{ $image }}" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500" alt="{{ $title }}">
        <div class="absolute top-3 right-3 bg-black/60 backdrop-blur-md px-2 py-1 rounded-lg text-center border border-white/10">
            <span class="block text-[10px] font-bold text-blue-400 uppercase leading-none">{{ $month }}</span>
            <span class="block text-lg font-black leading-none">{{ $day }}</span>
            <span class="text-[10px] font-black text-gray-400 leading-none">{{ $year }}</span>
        </div>
    </div>

    <div class="p-5">
        <span class="text-[10px] font-bold text-blue-500 uppercase tracking-widest">{{ $category }}</span>
        <h3 class="font-bold text-lg mt-1 mb-3 line-clamp-1 group-hover:text-blue-400 transition-colors">{{ $title }}</h3>

        <div class="space-y-2 mb-6 text-xs text-gray-400">
            <div class="flex items-center gap-2">
                <i class="fa-solid fa-location-dot w-4"></i> {{ $location }}
            </div>
            <div class="flex items-center gap-2">
                <i class="fa-solid fa-clock w-4"></i>
                {{ $startTime }} — {{ $endTime }} WIB
            </div>
        </div>

        <div class="flex items-center justify-between pt-4 border-t border-white/5">
            <div class="text-sm font-black">{{ $price }}</div>
            <div class="flex gap-2">
                {{ $slot }}
            </div>
        </div>
    </div>
</div>
