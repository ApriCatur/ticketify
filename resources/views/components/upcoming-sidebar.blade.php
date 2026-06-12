@props(['events' => null])

<div>
    <div class="flex justify-between items-center mb-6">
        <h2 class="text-xl font-black italic tracking-tighter text-white">Upcoming</h2>
        <i class="fa-solid fa-calendar-check text-blue-500"></i>
    </div>
    <div class="space-y-4">
        @if($events && $events->count() > 0)
            @foreach($events as $upEvent)
                @php $eventDate = \Carbon\Carbon::parse($upEvent->date); @endphp
                <div class="group p-4 bg-[#1e1e1e] border border-white/5 rounded-2xl hover:border-blue-500/30 transition-all cursor-pointer">
                    <div class="flex gap-4 items-center">
                        <div class="flex-shrink-0 w-12 h-12 bg-blue-500/10 rounded-xl flex flex-col items-center justify-center border border-blue-500/20">
                            <span class="text-[10px] font-bold text-blue-400 uppercase leading-none">{{ $eventDate->translatedFormat('M') }}</span>
                            <span class="text-lg font-black text-white mt-0.5 leading-none">{{ $eventDate->format('d') }}</span>
                        </div>
                        <div class="flex-1 min-w-0">
                            <h4 class="text-sm font-bold text-white tracking-tight truncate group-hover:text-blue-400 transition-colors">{{ $upEvent->name }}</h4>
                            <p class="text-[10px] text-gray-500 mt-1 uppercase flex items-center gap-1">
                                <i class="fa-regular fa-clock text-[9px]"></i>
                                {{ \Carbon\Carbon::parse($upEvent->time_start)->format('H:i') }} WIB
                            </p>
                        </div>
                    </div>
                </div>
            @endforeach
        @else
            <div class="text-center py-8 bg-[#1e1e1e] border border-dashed border-white/5 rounded-2xl">
                <i class="fa-solid fa-calendar-xmark text-gray-700 text-xl mb-2 block"></i>
                <p class="text-[11px] text-gray-500 font-medium">Belum ada event terdekat</p>
            </div>
        @endif
    </div>
</div>