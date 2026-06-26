@props([
    'image', 'day', 'month', 'year', 'category',
    'title', 'location', 'startTime', 'endTime', 'price',
    'dark' => false,
])

@php
    $bg = $dark ? 'bg-[#1e1e1e]' : 'bg-white';
    $border = $dark ? 'border-white/5' : 'border-gray-100';
    $text = $dark ? 'text-white' : 'text-gray-900';
    $muted = $dark ? 'text-gray-400' : 'text-gray-500';
    $hover = $dark ? 'hover:border-blue-500/50' : 'hover:shadow-lg hover:-translate-y-1';
    $shadow = $dark ? '' : 'shadow-sm';
@endphp

<a href="{{ $attributes->get('href', '#') }}"
   class="group block {{ $bg }} {{ $shadow }} rounded-l {{ $hover }} transition-all duration-300 overflow-hidden border {{ $border }}">

    <div class="relative aspect-[16/9] overflow-hidden bg-gray-100">
        <img src="{{ $image }}"
             class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500"
             alt="{{ $title }}"
             loading="lazy"
             onerror="this.parentElement.innerHTML='<div class=\'w-full h-full flex items-center justify-center bg-gray-100\'><i class=\'fa-solid fa-image text-3xl text-gray-300\'></i></div>'">

        <div class="absolute bottom-0 left-0 right-0 bg-gradient-to-t from-black/50 to-transparent h-20"></div>
    </div>

    <div class="p-4 space-y-2">
        <h3 class="font-semibold text-[15px] {{ $text }} leading-snug line-clamp-2 group-hover:text-blue-600 transition-colors">
            {{ $title }}
        </h3>

        <div class="flex items-center gap-1.5 text-xs {{ $muted }}">
            <i class="fa-regular fa-calendar text-[10px]"></i>
            <span>{{ $day }} {{ $month }} {{ $year }}</span>
        </div>

        <div class="flex items-center gap-1.5 text-xs {{ $muted }}">
            <i class="fa-regular fa-clock text-[10px]"></i>
            <span>{{ $startTime }} — {{ $endTime }} WIB</span>
        </div>

        <div class="flex items-center gap-1.5 text-xs {{ $muted }}">
            <i class="fa-solid fa-location-dot text-[10px]"></i>
            <span class="truncate">{{ $location }}</span>
        </div>

        <div class="pt-2 border-t {{ $dark ? 'border-white/5' : 'border-gray-50' }}">
            <div class="flex items-center justify-between gap-2">
                <span class="text-xs font-bold text-blue-600">{{ $price }}</span>
                <div class="flex items-center gap-2 flex-shrink-0">
                    {{ $slot ?? '' }}
                </div>
            </div>
        </div>
    </div>
</a>
