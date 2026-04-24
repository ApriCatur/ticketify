@extends('layouts.admin')

@section('title', 'Published Event')

@section('content')

<!-- Navbar -->
<nav class="glass border-b border-white/5 px-8 py-4 flex justify-between items-center">
    <div>
        <h2 class="text-2xl font-black tracking-tight">Published Event</h2>
        <p class="text-xs text-gray-500 mt-1">Manage your published event</p>
    </div>

    <div class="flex items-center gap-3">
        <span class="text-sm text-gray-400 font-semibold">Admin</span>
        <div class="w-10 h-10 rounded-full bg-blue-600 flex items-center justify-center text-xs font-bold">
            AD
        </div>
    </div>
</nav>

<!-- Search (TIDAK DIUBAH) -->
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

<!-- Content -->
<div class="flex gap-8 px-8 pb-8">

    <!-- Cards -->
    <div class="flex-1">
        <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-6">

            @for ($i = 0; $i < 6; $i++)
            <div class="group bg-[#1e1e1e] border border-white/5 rounded-2xl overflow-hidden transition hover:-translate-y-1 hover:shadow-lg hover:shadow-blue-500/10">

                <!-- IMAGE -->
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

                <!-- CONTENT -->
                <div class="p-5">
                    <span class="text-[10px] font-bold text-blue-500 uppercase tracking-widest">
                        Seminar
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
                            IDR 40.000
                        </div>
                    </div>

                    <!-- BUTTON (DITAMBAHKAN INTERAKSI) -->
                    <div class="flex gap-2 pt-4 border-t border-white/5">

                        <button
                            onclick="openDetail(
                                'Event Seminar KMIPN',
                                'Politeknik Negeri Batam',
                                '25 April 2026',
                                '15:00 WIB',
                                'Event seminar membahas perkembangan teknologi terbaru.'
                            )"
                            class="px-4 py-2 border border-white/10 rounded-xl text-xs hover:bg-white/5 transition">
                            Detail
                        </button>

                        <button
                            onclick="openUnpublish()"
                            class="flex-1 bg-red-500/10 text-red-400 py-2 rounded-xl text-xs hover:bg-red-500/20 transition">
                            Unpublish
                        </button>

                    </div>
                </div>
            </div>
            @endfor

        </div>
    </div>

    <!-- RIGHT PANEL (TIDAK DIUBAH SAMA SEKALI) -->
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
                <h4 class="font-black mb-2">Need New Event?</h4>
                <p class="text-xs text-blue-100 mb-4">
                    Create and publish your next event here.
                </p>

                <button class="w-full py-3 bg-white text-blue-600 rounded-xl text-sm font-bold hover:bg-blue-50 transition">
                    Create Event
                </button>
            </div>

        </div>
    </aside>

</div>

<!-- ================= MODAL DETAIL (ADVANCED) ================= -->
<div id="detailModal" class="fixed inset-0 bg-black/60 hidden items-center justify-center z-50">

    <div class="bg-[#1e1e1e] w-[900px] rounded-2xl border border-white/10 overflow-hidden">

        <!-- HEADER -->
        <div class="bg-green-600 px-6 py-4 flex justify-between items-center">
            <div class="flex items-center gap-2">
                <i class="fa-solid fa-eye text-white"></i>
                <h2 class="text-white font-bold">Detail Agenda</h2>
            </div>
            <button onclick="closeDetail()" class="text-white text-xl">✕</button>
        </div>

        <!-- CONTENT -->
        <div class="p-6 grid grid-cols-1 md:grid-cols-3 gap-6">

            <!-- LEFT SIDE -->
            <div class="md:col-span-2 space-y-4">

                <!-- DATE + TIME -->
                <div class="flex items-start gap-4">
                    <div class="bg-blue-500/20 text-blue-400 rounded-xl px-4 py-3 text-center">
                        <p class="text-lg font-bold">25</p>
                        <p class="text-xs">APR</p>
                    </div>

                        <div>
                            <p class="text-xs text-gray-400 uppercase">Waktu Pelaksanaan</p>
                            <p id="detailTime" class="font-bold text-lg">15:00 WIB</p>
                            <p id="detailDate" class="text-sm text-gray-400">25 April 2026</p>
                        </div>
                </div>

                <!-- TITLE -->
                <div>
                    <p class="text-xs text-gray-400 uppercase">Judul Rapat</p>
                    <h3 id="detailTitle" class="text-blue-400 font-bold text-lg">
                        -
                    </h3>
                </div>

                <!-- LOCATION -->
                <div class="flex gap-6">
                    <div>
                        <p class="text-xs text-gray-400 uppercase">Ruangan</p>
                        <p id="detailLocation" class="text-sm">-</p>
                    </div>

                    <div>
                        <p class="text-xs text-gray-400 uppercase">Unit Penyelenggara</p>
                        <p class="text-sm">Teknik Informatika</p>
                    </div>
                </div>

                <!-- DESCRIPTION -->
                <div>
                    <p class="text-xs text-gray-400 uppercase">Keterangan</p>
                    <div class="bg-white/5 border border-white/10 rounded-xl p-3 text-sm text-gray-300">
                        <span id="detailDesc">-</span>
                    </div>
                </div>

                <!-- FILE -->
                <div>
                    <p class="text-xs text-gray-400 uppercase">Dokumen Notulen</p>
                    <p class="text-sm text-gray-500 italic">
                        Tidak ada berkas notulen yang diunggah.
                    </p>
                </div>

            </div>

            <!-- RIGHT SIDE (PESERTA) -->
            <div class="bg-white/5 border border-white/10 rounded-xl p-4">

                <div class="flex justify-between items-center mb-3">
                    <p class="font-bold text-blue-400">
                        <i class="fa-solid fa-users mr-1"></i> Daftar Peserta
                    </p>
                    <span class="text-xs bg-white/10 px-2 py-1 rounded-full">
                        6 Orang
                    </span>
                </div>

                <div class="space-y-2 max-h-64 overflow-y-auto pr-1 text-sm">

                    <div class="bg-white/5 p-2 rounded-lg">Adrian Septiaji</div>
                    <div class="bg-white/5 p-2 rounded-lg">Syarifah Bisyrah</div>
                    <div class="bg-white/5 p-2 rounded-lg">M. Fauzi Azhari</div>
                    <div class="bg-white/5 p-2 rounded-lg">Ayu Diana</div>
                    <div class="bg-white/5 p-2 rounded-lg">Ardiansyah</div>
                    <div class="bg-white/5 p-2 rounded-lg">Dwi Agung</div>

                </div>

            </div>

        </div>

        <!-- FOOTER -->
        <div class="px-6 py-4 border-t border-white/10 text-right">
            <button onclick="closeDetail()"
                class="px-6 py-2 bg-white/10 rounded-xl text-sm hover:bg-white/20">
                Tutup
            </button>
        </div>

    </div>
</div>

<!-- ================= MODAL UNPUBLISH ================= -->
<div id="unpublishModal" class="fixed inset-0 bg-black/60 hidden items-center justify-center z-50">
    <div class="bg-[#1e1e1e] rounded-2xl p-6 w-[400px] border border-white/10 text-center">

        <div class="w-14 h-14 mx-auto mb-4 rounded-full bg-white/5 flex items-center justify-center">
            <i class="fa-solid fa-exclamation text-white"></i>
        </div>

        <h2 class="text-lg font-bold mb-2">Unpublish Event</h2>
        <p class="text-sm text-gray-400 mb-6">
            Are you sure you want to unpublish this event?
        </p>

        <div class="flex gap-3">
            <button onclick="closeUnpublish()"
                class="flex-1 py-2 border border-white/10 rounded-xl text-sm">
                Cancel
            </button>

            <button onclick="closeUnpublish()"
                class="flex-1 py-2 bg-red-500/20 text-red-400 rounded-xl text-sm">
                Unpublish
            </button>
        </div>

    </div>
</div>

@endsection
