@php $navTitle = 'Statistik Event'; $navSubtitle = 'Pantau status dan penjualan tiket semua event.'; @endphp
@extends('layouts.admin')

@section('title', 'Statistik Event')

@section('content')

<div class="p-8">

    @php $statuses = [['value' => 'all', 'label' => 'All', 'icon' => 'fa-chart-simple'], ['value' => 'published', 'label' => 'Active', 'icon' => 'fa-play'], ['value' => 'pending', 'label' => 'Pending', 'icon' => 'fa-clock'], ['value' => 'rejected', 'label' => 'Rejected', 'icon' => 'fa-ban']]; @endphp

    <div class="bg-[#121212] rounded-2xl border border-white/5 p-4 mb-8 flex flex-col md:flex-row gap-4 items-center">
        <form method="GET" action="{{ route('admin.event-statistics') }}" class="w-full flex flex-col md:flex-row gap-4 items-center">
            <div class="relative flex-1 w-full">
                <i class="fa-solid fa-magnifying-glass absolute left-4 top-1/2 -translate-y-1/2 text-gray-500 text-xs"></i>
                <input type="text" name="search" placeholder="Cari event atau lokasi..." value="{{ $search ?? '' }}"
                       class="w-full bg-[#18181b] border border-white/5 rounded-xl pl-10 pr-4 py-3 text-xs focus:border-blue-500 outline-none transition-all text-white">
                <input type="hidden" name="status" value="{{ $activeFilter ?? 'all' }}">
            </div>
            <div class="flex gap-2 flex-wrap">
                @foreach($statuses as $s)
                    <button type="submit" name="status" value="{{ $s['value'] }}"
                        class="px-4 py-2 rounded-xl text-[10px] font-black uppercase tracking-widest transition-all flex items-center gap-2 {{ ($activeFilter ?? 'all') === $s['value'] ? 'bg-blue-600 text-white shadow-lg shadow-blue-500/20' : 'bg-white/5 text-gray-400 hover:bg-white/10 hover:text-white' }}">
                        <i class="fa-solid {{ $s['icon'] }}"></i>
                        {{ $s['label'] }}
                    </button>
                @endforeach
            </div>
            @if(($search ?? '') || ($activeFilter ?? 'all') !== 'all')
                <a href="{{ route('admin.event-statistics') }}" class="text-[10px] text-gray-500 hover:text-blue-500 font-black uppercase tracking-widest transition-all">
                    <i class="fa-solid fa-rotate-left"></i> Reset
                </a>
            @endif
        </form>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-8">

        @forelse($events as $item)
            @php
                $kuota = $item->tickets->sum('stock');
                $terjual = $item->tickets_sold ?? 0;
                $persentase = $kuota > 0 ? ($terjual / $kuota) * 100 : 0;
            @endphp

            <div class="bg-[#121212] rounded-[2rem] overflow-hidden border border-white/5 flex flex-col group hover:border-white/10 transition-all duration-300">

                <div class="relative aspect-video overflow-hidden">
                    @if($item->banner)
                        <img src="{{ asset('images/events/' . $item->banner) }}"
                             alt="Poster {{ $item->name }}"
                             class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-700">
                    @endif
                    <div class="absolute inset-0 bg-gradient-to-t from-[#121212]/80 via-[#121212]/20 to-transparent"></div>

                    @php
                        $displayStatus = $item->getDisplayStatus();
                        $statusConfig = [
                            'published' => ['bg' => 'bg-emerald-500/20', 'border' => 'border-emerald-500/50', 'text' => 'text-emerald-500', 'label' => 'Active'],
                            'completed' => ['bg' => 'bg-blue-500/20', 'border' => 'border-blue-500/50', 'text' => 'text-blue-500', 'label' => 'Completed'],
                            'pending' => ['bg' => 'bg-amber-500/20', 'border' => 'border-amber-500/50', 'text' => 'text-amber-500', 'label' => 'Pending'],
                            'rejected' => ['bg' => 'bg-red-500/20', 'border' => 'border-red-500/50', 'text' => 'text-red-500', 'label' => 'Rejected'],
                        ];
                        $config = $statusConfig[$displayStatus] ?? $statusConfig['published'];
                    @endphp

                    <div class="absolute top-4 right-4 backdrop-blur-md border rounded-full px-4 py-1.5 text-[10px] font-black uppercase tracking-widest shadow-lg shadow-black/30 {{ $config['bg'] }} {{ $config['border'] }} {{ $config['text'] }}">
                        {{ $config['label'] }}
                    </div>
                </div>

                <div class="p-8 flex flex-col flex-1 justify-between space-y-6">
                    <div>
                        <h3 class="text-lg font-black text-white truncate mb-1" title="{{ $item->name }}">
                            {{ $item->name }}
                        </h3>
                        <p class="text-xs text-gray-500 flex items-center gap-2">
                            <i class="fa-solid fa-calendar-day text-blue-500"></i>
                            {{ \Carbon\Carbon::parse($item->date)->format('d F Y') }}, {{ $item->time_start }} - {{ $item->time_end }} WIB
                        </p>
                    </div>

                    <div class="space-y-3">
                        <div class="flex justify-between items-end">
                            <span class="text-[10px] font-black text-gray-400 uppercase tracking-widest">Penjualan Tiket</span>
                            <span class="text-xs font-bold text-white">
                                {{ $terjual }} <span class="text-gray-500">/ {{ $kuota }}</span>
                            </span>
                        </div>
                        <div class="w-full h-2 bg-white/5 rounded-full overflow-hidden">
                            <div class="h-full bg-blue-500 rounded-full shadow-lg transition-all duration-500"
                                 style="width: {{ $persentase }}%"></div>
                        </div>
                    </div>

                    <div class="flex gap-3">
                        <a href="{{ route('admin.event-statistics.detail', $item->id) }}"
                           class="flex-1 text-center bg-white/5 hover:bg-blue-600 hover:text-white text-white font-bold text-xs py-3 px-4 rounded-xl transition-all shadow-md">
                            STATISTIK
                        </a>
                        <a href="{{ route('admin.event-statistics.attendees', $item->id) }}"
                           class="flex-1 text-center bg-white/5 hover:bg-purple-600 hover:text-white text-white font-bold text-xs py-3 px-4 rounded-xl transition-all shadow-md">
                            PESERTA
                        </a>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-span-full flex flex-col items-center justify-center py-20 text-gray-400">
                <i class="fa-solid fa-chart-pie text-5xl mb-4 text-white/10"></i>
                <p class="text-sm">Belum ada event untuk melihat statistik.</p>
            </div>
        @endforelse
    </div>
</div>

@endsection
