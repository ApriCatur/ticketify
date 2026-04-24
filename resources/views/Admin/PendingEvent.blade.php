@extends('layouts.admin')

@section('title', 'Pending Event')

@section('content')

{{-- Navbar --}}
<nav class="glass border-b border-white/5 px-8 py-4 flex justify-between items-center">
    <div>
        <h2 class="text-2xl font-black tracking-tight">Pending Event</h2>
        <p class="text-xs text-gray-500 mt-1">Review and approve incoming event submissions</p>
    </div>

    <div class="flex items-center gap-3">
        <span class="text-sm font-semibold text-gray-400">Admin</span>
        <div class="w-10 h-10 rounded-full bg-blue-600 flex items-center justify-center text-xs font-bold">
            AD
        </div>
    </div>
</nav>

{{-- Search --}}
<div class="px-8 py-8">
    <div class="bg-[#1e1e1e] border border-white/10 rounded-2xl p-4 shadow-xl flex flex-wrap lg:flex-nowrap items-end gap-4">

        <div class="flex-[2] min-w-[200px]">
            <label class="text-[9px] font-black text-gray-500 uppercase tracking-widest mb-2 block">
                Search Event
            </label>
            <div class="flex items-center gap-3 bg-white/5 rounded-xl px-4 py-3">
                <i class="fa-solid fa-magnifying-glass text-blue-500"></i>
                <input type="text" placeholder="Search event..."
                    class="bg-transparent w-full outline-none text-sm">
            </div>
        </div>

        <div class="flex-1 min-w-[150px]">
            <label class="text-[9px] font-black text-gray-500 uppercase tracking-widest mb-2 block">
                Location
            </label>
            <select class="w-full bg-white/5 rounded-xl py-3 px-4 text-sm outline-none">
                <option>All Location</option>
            </select>
        </div>

        <div class="flex-1 min-w-[150px]">
            <label class="text-[9px] font-black text-gray-500 uppercase tracking-widest mb-2 block">
                Date
            </label>
            <input type="date"
                class="w-full bg-white/5 rounded-xl py-3 px-4 text-sm outline-none [color-scheme:dark]">
        </div>

        <button class="px-8 py-3 bg-white text-black rounded-xl font-bold hover:bg-blue-500 hover:text-white transition">
            Search
        </button>
    </div>
</div>

{{-- Content --}}
<div class="flex gap-8 px-8 pb-8">

    {{-- Cards --}}
    <div class="flex-1">
        <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-6">

            @for ($i = 0; $i < 6; $i++)
            <div class="group bg-[#1e1e1e] border border-white/5 rounded-2xl overflow-hidden transition hover:-translate-y-1 hover:shadow-lg hover:shadow-blue-500/10">

                <div class="relative h-44 overflow-hidden">
                    <div class="w-full h-full bg-[#18181b] flex items-center justify-center">
                        <i class="fa-regular fa-image text-4xl text-gray-700"></i>
                    </div>

                    <div class="absolute top-3 right-3 bg-black/60 backdrop-blur-md px-3 py-2 rounded-xl text-center border border-white/10">
                        <span class="block text-[10px] font-bold text-blue-400 uppercase">APR</span>
                        <span class="block text-lg font-black">25</span>
                        <span class="text-[10px] text-gray-500">2026</span>
                    </div>
                </div>

                <div class="p-5">
                    <span class="text-[10px] font-bold text-blue-500 uppercase tracking-widest">
                        Pending
                    </span>

                    <h3 class="font-bold text-lg mt-2 mb-3 group-hover:text-blue-400 transition">
                        Event Seminar KMIPN
                    </h3>

                    <div class="space-y-2 text-xs text-gray-400 mb-5">
                        <div class="flex items-center gap-2">
                            <i class="fa-solid fa-location-dot"></i>
                            Politeknik Negeri Batam
                        </div>

                        <div class="flex items-center gap-2">
                            <i class="fa-regular fa-clock"></i>
                            15:00 WIB
                        </div>

                        <div class="flex items-center gap-2">
                            <i class="fa-solid fa-ticket"></i>
                            From IDR 40.000
                        </div>
                    </div>

                    <div class="flex gap-2 pt-4 border-t border-white/5">

                        <!-- APPROVE -->
                        <button
                            onclick="openApprove()"
                            class="flex-1 bg-blue-600 text-white py-2 rounded-xl text-xs font-semibold hover:bg-blue-500 transition">
                            Approve
                        </button>

                        <!-- REJECT -->
                        <button
                            onclick="openReject()"
                            class="flex-1 bg-red-500/10 text-red-400 py-2 rounded-xl text-xs hover:bg-red-500/20 transition">
                            Reject
                        </button>

                        <!-- DETAIL -->
                        <button
                            onclick="openDetail(
                                'Event Seminar KMIPN',
                                'Politeknik Negeri Batam',
                                'Sabtu, 7 Feb 2026',
                                '15:00 WIB',
                                'Event seminar membahas perkembangan teknologi terbaru.'
                            )"
                            class="px-4 py-2 border border-white/10 rounded-xl text-xs hover:bg-white/5 transition">
                            Detail
                        </button>

                    </div>
                </div>
            </div>
            @endfor

        </div>
    </div>

    {{-- Right Panel --}}
    <aside class="w-80 hidden xl:block">
        <div class="space-y-6">

            <div>
                <div class="flex justify-between items-center mb-4">
                    <h3 class="text-xl font-black">Upcoming</h3>
                    <i class="fa-solid fa-calendar-check text-blue-500"></i>
                </div>

                <div class="space-y-4">
                    <div class="p-4 bg-[#1e1e1e] rounded-2xl border border-white/5">
                        <p class="font-bold text-sm">Seminar KMIPN</p>
                        <p class="text-xs text-gray-500 mt-1">25 Apr 2026 • 15:00</p>
                    </div>

                    <div class="p-4 bg-[#1e1e1e] rounded-2xl border border-white/5">
                        <p class="font-bold text-sm">Workshop AI</p>
                        <p class="text-xs text-gray-500 mt-1">26 Apr 2026 • 10:00</p>
                    </div>
                </div>
            </div>

            <div class="p-6 bg-gradient-to-br from-blue-600 to-blue-900 rounded-2xl">
                <h4 class="font-black mb-2">Need Review?</h4>
                <p class="text-xs text-blue-100 mb-4">
                    Check all submitted events before publishing.
                </p>

                <button class="w-full py-3 bg-white text-blue-600 rounded-xl text-sm font-bold hover:bg-blue-50 transition">
                    View All
                </button>
            </div>

        </div>
    </aside>

</div>

@endsection
