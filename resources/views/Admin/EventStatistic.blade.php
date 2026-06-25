@extends('layouts.admin')

@section('title', 'Statistik Event')

@section('content')

<div class="px-8 mt-6">

    @php $statuses = [['value' => 'all', 'label' => 'All', 'icon' => 'fa-chart-simple'], ['value' => 'published', 'label' => 'Active', 'icon' => 'fa-play'], ['value' => 'pending', 'label' => 'Pending', 'icon' => 'fa-clock'], ['value' => 'rejected', 'label' => 'Rejected', 'icon' => 'fa-ban']]; @endphp

    <div class="bg-white rounded-2xl border border-gray-200 shadow-sm p-4 mb-8 flex flex-col md:flex-row gap-4 items-center">
        <form method="GET" action="{{ route('admin.event-statistics') }}" class="w-full flex flex-col md:flex-row gap-4 items-center">
            <div class="relative flex-1 w-full">
                <i class="fa-solid fa-magnifying-glass absolute left-4 top-1/2 -translate-y-1/2 text-gray-400 text-xs"></i>
                <input type="text" name="search" placeholder="Cari event atau lokasi..." value="{{ $search ?? '' }}"
                       class="w-full bg-gray-50 border border-gray-200 rounded-xl pl-10 pr-4 py-3 text-xs focus:border-blue-500 outline-none transition-all text-gray-900">
                <input type="hidden" name="status" value="{{ $activeFilter ?? 'all' }}">
            </div>
            <div class="flex gap-2 flex-wrap">
                @foreach($statuses as $s)
                    <button type="submit" name="status" value="{{ $s['value'] }}"
                        class="px-4 py-2 rounded-xl text-[10px] font-black uppercase tracking-widest transition-all flex items-center gap-2 {{ ($activeFilter ?? 'all') === $s['value'] ? 'bg-blue-600 text-white shadow-lg shadow-blue-500/20' : 'bg-gray-100 text-gray-500 hover:bg-gray-200' }}">
                        <i class="fa-solid {{ $s['icon'] }}"></i>
                        {{ $s['label'] }}
                    </button>
                @endforeach
            </div>
            @if(($search ?? '') || ($activeFilter ?? 'all') !== 'all')
                <a href="{{ route('admin.event-statistics') }}" class="text-[10px] text-gray-500 hover:text-blue-600 font-black uppercase tracking-widest transition-all">
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

            <div class="bg-white rounded-[2rem] overflow-hidden border border-gray-200 shadow-sm flex flex-col group hover:shadow-md transition-all duration-300">

                <div class="relative aspect-video overflow-hidden">
                    @if($item->banner)
                        <img src="{{ asset('images/events/' . $item->banner) }}"
                             alt="Poster {{ $item->name }}"
                             class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-700">
                    @endif
                    <div class="absolute inset-0 bg-gradient-to-t from-black/50 via-black/10 to-transparent"></div>

                    @php
                        $displayStatus = $item->getDisplayStatus();
                        $statusConfig = [
                            'published' => ['bg' => 'bg-emerald-50', 'border' => 'border-emerald-200', 'text' => 'text-emerald-600', 'label' => 'Active'],
                            'completed' => ['bg' => 'bg-blue-50', 'border' => 'border-blue-200', 'text' => 'text-blue-600', 'label' => 'Completed'],
                            'pending' => ['bg' => 'bg-amber-50', 'border' => 'border-amber-200', 'text' => 'text-amber-600', 'label' => 'Pending'],
                            'rejected' => ['bg' => 'bg-red-50', 'border' => 'border-red-200', 'text' => 'text-red-600', 'label' => 'Rejected'],
                        ];
                        $config = $statusConfig[$displayStatus] ?? $statusConfig['published'];
                    @endphp

                    <div class="absolute top-4 right-4 backdrop-blur-md border rounded-full px-4 py-1.5 text-[10px] font-black uppercase tracking-widest shadow-lg shadow-black/30 {{ $config['bg'] }} {{ $config['border'] }} {{ $config['text'] }}">
                        {{ $config['label'] }}
                    </div>
                </div>

                <div class="p-8 flex flex-col flex-1 justify-between space-y-6">
                    <div>
                        <h3 class="text-lg font-black text-gray-900 truncate mb-1" title="{{ $item->name }}">
                            {{ $item->name }}
                        </h3>
                        <p class="text-xs text-gray-500 flex items-center gap-2">
                            <i class="fa-solid fa-calendar-day text-blue-500"></i>
                            {{ \Carbon\Carbon::parse($item->date)->format('d F Y') }}, {{ substr($item->time_start, 0, 5) }} - {{ substr($item->time_end, 0, 5) }} WIB
                        </p>
                    </div>

                    <div class="space-y-3">
                        <div class="flex justify-between items-end">
                            <span class="text-[10px] font-black text-gray-400 uppercase tracking-widest">Penjualan Tiket</span>
                            <span class="text-xs font-bold text-gray-900">
                                {{ $terjual }} <span class="text-gray-500">/ {{ $kuota }}</span>
                            </span>
                        </div>
                        <div class="w-full h-2 bg-gray-100 rounded-full overflow-hidden">
                            <div class="h-full bg-blue-500 rounded-full shadow-lg transition-all duration-500"
                                 style="width: {{ $persentase }}%"></div>
                        </div>
                    </div>

                    <div class="flex gap-3">
                        <a href="{{ route('admin.event-statistics.detail', $item->id) }}"
                           class="flex-1 text-center bg-gray-100 hover:bg-blue-600 hover:text-white text-gray-700 font-bold text-xs py-3 px-4 rounded-xl transition-all shadow-sm">
                            STATISTIK
                        </a>
                        <a href="{{ route('admin.event-statistics.attendees', $item->id) }}"
                           class="flex-1 text-center bg-gray-100 hover:bg-purple-600 hover:text-white text-gray-700 font-bold text-xs py-3 px-4 rounded-xl transition-all shadow-sm">
                            PESERTA
                        </a>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-span-full flex flex-col items-center justify-center py-20 text-gray-500">
                <i class="fa-solid fa-chart-pie text-5xl mb-4 text-gray-200"></i>
                <p class="text-sm">Belum ada event untuk melihat statistik.</p>
            </div>
        @endforelse
    </div>
</div>

@endsection
