<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ticketify - Create Event</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
@php
    $ticketRows = old('ticket_types', [['name' => 'Reguler', 'price' => 0, 'stock' => 100]]);
@endphp
<body class="bg-[#09090b] text-white flex" x-data='{
        activeTab: "ticket",
        bannerName: "",
        orgPhotoName: "",
        ticketRows: @json($ticketRows)
    }'>

    @include('layouts.sidebar-panitia')

    <main class="flex-1 p-10 overflow-y-auto">
        <header class="mb-10">
            <button id="open-sidebar" class="lg:hidden text-gray-400 hover:text-blue-500 transition-colors">
                <i class="fa-solid fa-bars-staggered text-2xl"></i>
            </button>
            <h1 class="text-3xl font-black tracking-tight">Create New Event</h1>
            <p class="text-gray-500 text-sm mt-2 font-medium">Isi formulir di bawah untuk mengajukan event baru ke Admin.</p>
        </header>

        {{-- Menampilkan Error Validasi Jika Ada Inputan yang Kurang/Salah --}}
        @if ($errors->any())
            <div class="mb-6 p-4 bg-red-500/10 border border-red-500/20 rounded-2xl text-red-400 text-sm">
                <ul class="list-disc pl-5 space-y-1">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        {{-- Navigasi Step Menu --}}
        <div class="flex gap-8 mb-8 border-b border-white/5">
            <button type="button" @click="activeTab = 'ticket'" :class="activeTab === 'ticket' ? 'border-b-2 border-blue-500 text-blue-500' : 'text-gray-500'" class="pb-4 font-bold text-sm transition-all flex items-center gap-2">
                <span class="w-6 h-6 rounded-full bg-white/5 flex items-center justify-center text-[10px]">1</span> Ticket
            </button>
            <button type="button" @click="activeTab = 'detail'" :class="activeTab === 'detail' ? 'border-b-2 border-blue-500 text-blue-500' : 'text-gray-500'" class="pb-4 font-bold text-sm transition-all flex items-center gap-2">
                <span class="w-6 h-6 rounded-full bg-white/5 flex items-center justify-center text-[10px]">2</span> Event Detail
            </button>
            <button type="button" @click="activeTab = 'organiser'" :class="activeTab === 'organiser' ? 'border-b-2 border-blue-500 text-blue-500' : 'text-gray-500'" class="pb-4 font-bold text-sm transition-all flex items-center gap-2">
                <span class="w-6 h-6 rounded-full bg-white/5 flex items-center justify-center text-[10px]">3</span> Organiser
            </button>
        </div>

        {{-- TUNGGAL FORM UTAMA UNTUK SUBMIT KE BACKEND --}}
        <form action="{{ route('panitia.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            {{-- ========================================================================= --}}
            {{-- STEP 1: TICKET & INFO UTAMA --}}
            {{-- ========================================================================= --}}
            <div x-show="activeTab === 'ticket'" class="space-y-8">
                <div class="grid md:grid-cols-2 gap-8">
                    {{-- Input Poster --}}
                    <div class="space-y-4">
                        <label class="text-[10px] font-black text-gray-500 uppercase tracking-widest ml-1">Poster Event</label>
                        <div class="border-2 border-dashed border-white/10 rounded-3xl p-[110px] text-center hover:border-blue-500/50 transition-colors bg-[#121212] group relative overflow-hidden">
                            <i class="fa-solid fa-image text-4xl text-gray-700 group-hover:text-blue-500 transition-colors mb-4 block"></i>
                            <p class="text-[11px] text-gray-500 font-medium" x-text="bannerName ? bannerName : 'Klik atau seret file poster di sini'"></p>
                            <input type="file" name="banner" class="hidden" id="poster" accept="image/*" @change="bannerName = $event.target.files[0].name">
                            <button type="button" onclick="document.getElementById('poster').click()" class="mt-4 px-6 py-2 bg-white/5 rounded-full text-[10px] font-bold hover:bg-white/10 transition-all border border-white/5">Pilih File</button>
                        </div>
                    </div>

                    {{-- Form Field Kiri --}}
                    <div class="space-y-6">
                        <div class="space-y-2">
                            <label class="text-[10px] font-black text-gray-500 uppercase tracking-widest ml-1">Nama Event</label>
                            <input type="text" name="name" value="{{ old('name') }}" placeholder="Masukkan nama event" class="w-full bg-[#121212] border border-white/5 rounded-xl px-4 py-3 text-sm focus:border-blue-500 outline-none transition-all" required>
                        </div>

                        <div class="space-y-2">
                            <label class="text-[10px] font-black text-gray-500 uppercase tracking-widest ml-1">Kategori Event</label>
                            <select name="category" class="w-full bg-[#121212] border border-white/5 rounded-xl px-4 py-3 text-sm focus:border-blue-500 outline-none transition-all text-white" required>
                                <option value="" disabled selected class="bg-[#121212]">Pilih kategori event</option>
                                <option class="bg-[#121212]" {{ old('category') == 'Music Concert' ? 'selected' : '' }}>Music Concert</option>
                                <option class="bg-[#121212]" {{ old('category') == 'Seminar' ? 'selected' : '' }}>Seminar</option>
                                <option class="bg-[#121212]" {{ old('category') == 'Workshop' ? 'selected' : '' }}>Workshop</option>
                                <option class="bg-[#121212]" {{ old('category') == 'Festival' ? 'selected' : '' }}>Festival</option>
                                <option class="bg-[#121212]" {{ old('category') == 'Sport' ? 'selected' : '' }}>Sport</option>
                                <option class="bg-[#121212]" {{ old('category') == 'Competition' ? 'selected' : '' }}>Competition</option>
                                <option class="bg-[#121212]" {{ old('category') == 'Exhibition' ? 'selected' : '' }}>Exhibition</option>
                                <option class="bg-[#121212]" {{ old('category') == 'Community' ? 'selected' : '' }}>Community</option>
                                <option class="bg-[#121212]" {{ old('category') == 'Education' ? 'selected' : '' }}>Education</option>
                                <option class="bg-[#121212]" {{ old('category') == 'Entertainment' ? 'selected' : '' }}>Entertainment</option>
                            </select>
                        </div>

                        <div class="space-y-2">
                             <label class="text-[10px] font-black text-gray-500 uppercase tracking-widest ml-1">Event Location</label>
                             <input type="text" name="location" value="{{ old('location') }}" placeholder="Masukkan lokasi event (contoh: Batam, Kepulauan Riau)" class="w-full bg-[#121212] border border-white/5 rounded-xl px-4 py-3 text-sm focus:border-blue-500 outline-none transition-all" required>
                        </div>

                        <div class="space-y-2">
                            <label class="text-[10px] font-black text-gray-500 uppercase tracking-widest ml-1">Social Media Link</label>
                            <input type="url" name="social_link" value="{{ old('social_link') }}" placeholder="https://instagram.com/..." class="w-full bg-[#121212] border border-white/5 rounded-xl px-4 py-3 text-sm focus:border-blue-500 outline-none transition-all">
                        </div>

                        <div class="grid grid-cols-3 gap-4">
                            <div class="space-y-2">
                                <label class="text-[10px] font-black text-gray-500 uppercase tracking-widest ml-1">Tanggal</label>
                                <input type="date" name="date" value="{{ old('date') }}" class="w-full bg-[#121212] border border-white/5 rounded-xl px-4 py-2 text-xs focus:border-blue-500 outline-none transition-all" required>
                            </div>
                            <div class="space-y-2">
                                <label class="text-[10px] font-black text-gray-500 uppercase tracking-widest ml-1">Waktu Mulai</label>
                                <input type="time" name="time_start" value="{{ old('time_start') }}" class="w-full bg-[#121212] border border-white/5 rounded-xl px-4 py-2 text-xs focus:border-blue-500 outline-none transition-all" required>
                            </div>
                            <div class="space-y-2">
                                <label class="text-[10px] font-black text-gray-500 uppercase tracking-widest ml-1">Waktu Selesai</label>
                                <input type="time" name="time_end" value="{{ old('time_end') }}" class="w-full bg-[#121212] border border-white/5 rounded-xl px-4 py-2 text-xs focus:border-blue-500 outline-none transition-all" required>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Skema Tiket Dinamis Alpine JS --}}
                <div class="bg-[#121212] p-8 rounded-3xl border border-white/5">
                    <div class="flex justify-between items-center mb-6">
                        <h3 class="font-bold text-sm flex items-center gap-2">
                            <i class="fa-solid fa-ticket text-blue-500"></i> Ticket Pricing & Stock
                        </h3>
                        <button type="button" @click="ticketRows.push({ name: 'Reguler', price: 0, stock: 100 })" class="px-4 py-2 bg-blue-600 text-white rounded-2xl text-xs font-black uppercase tracking-wide hover:bg-blue-500 transition">Tambah Jenis Tiket</button>
                    </div>

                    <template x-for="(ticket, index) in ticketRows" :key="index">
                        <div class="grid md:grid-cols-12 gap-4 items-end bg-white/[0.02] p-4 rounded-2xl border border-white/5 mb-4">
                            <div class="md:col-span-4 space-y-2">
                                <label class="text-[10px] font-black text-gray-500 uppercase tracking-widest ml-1">Jenis Tiket</label>
                                <input :name="`ticket_types[${index}][name]`" type="text" x-model="ticket.name" placeholder="Contoh: Reguler / VIP" class="w-full bg-[#18181b] border border-white/5 rounded-xl px-4 py-3 text-sm focus:border-blue-500 outline-none" required>
                            </div>
                            <div class="md:col-span-4 space-y-2">
                                <label class="text-[10px] font-black text-gray-500 uppercase tracking-widest ml-1">Harga (IDR)</label>
                                <input :name="`ticket_types[${index}][price]`" type="number" x-model="ticket.price" min="0" placeholder="0" class="w-full bg-[#18181b] border border-white/5 rounded-xl px-4 py-3 text-sm focus:border-blue-500 outline-none" required>
                            </div>
                            <div class="md:col-span-3 space-y-2">
                                <label class="text-[10px] font-black text-gray-500 uppercase tracking-widest ml-1">Stok Tiket</label>
                                <input :name="`ticket_types[${index}][stock]`" type="number" x-model="ticket.stock" min="0" placeholder="100" class="w-full bg-[#18181b] border border-white/5 rounded-xl px-4 py-3 text-sm focus:border-blue-500 outline-none" required>
                            </div>
                            <div class="md:col-span-1 flex items-end justify-end">
                                <button type="button" @click="ticketRows.splice(index, 1)" x-show="ticketRows.length > 1" class="w-full py-3 bg-red-500/10 text-red-400 rounded-xl text-xs font-black uppercase tracking-widest hover:bg-red-500/20 transition">Hapus</button>
                            </div>
                        </div>
                    </template>
                </div>

                <div class="flex justify-end">
                    <button type="button" @click="activeTab = 'detail'" class="px-10 py-4 rounded-2xl bg-blue-600 text-white text-xs font-black uppercase tracking-widest hover:bg-blue-700 transition-all">Lanjut ke Detail</button>
                </div>
            </div>

            {{-- ========================================================================= --}}
            {{-- STEP 2: EVENT DETAIL --}}
            {{-- ========================================================================= --}}
            <div x-show="activeTab === 'detail'" class="space-y-8" style="display: none;">
                <div class="space-y-2">
                    <label class="text-[10px] font-black text-gray-500 uppercase tracking-widest ml-1">Deskripsi Event</label>
                    <textarea name="description" rows="6" class="w-full bg-[#121212] border border-white/5 rounded-2xl p-4 text-sm focus:border-blue-500 outline-none" placeholder="Ceritakan detail acaramu..." required>{{ old('description') }}</textarea>
                </div>
                <div class="space-y-2">
                    <label class="text-[10px] font-black text-gray-500 uppercase tracking-widest ml-1">Link Google Maps</label>
                    <input type="text" name="maps_link" value="{{ old('maps_link') }}" placeholder="Paste link lokasi dari Google Maps" class="w-full bg-[#121212] border border-white/5 rounded-xl px-4 py-3 text-sm focus:border-blue-500 outline-none">
                </div>
                <div class="space-y-2">
                    <label class="text-[10px] font-black text-gray-500 uppercase tracking-widest ml-1">Syarat & Ketentuan</label>
                    <textarea name="terms" rows="4" class="w-full bg-[#121212] border border-white/5 rounded-2xl p-4 text-sm focus:border-blue-500 outline-none" placeholder="1. Peserta wajib..." required>{{ old('terms') }}</textarea>
                </div>

                <div class="flex justify-end gap-4">
                    <button type="button" @click="activeTab = 'ticket'" class="px-8 py-4 rounded-2xl bg-white/5 text-xs font-black uppercase tracking-widest hover:bg-white/10 transition-all">Kembali</button>
                    <button type="button" @click="activeTab = 'organiser'" class="px-10 py-4 rounded-2xl bg-blue-600 text-white text-xs font-black uppercase tracking-widest hover:bg-blue-700 transition-all">Lanjut ke Organiser</button>
                </div>
            </div>

            {{-- ========================================================================= --}}
            {{-- STEP 3: ORGANISER (FINAL TAB) --}}
            {{-- ========================================================================= --}}
            <div x-show="activeTab === 'organiser'" class="space-y-8" style="display: none;">
                <div class="grid md:grid-cols-2 gap-8">
                    <div class="space-y-2">
                        <label class="text-[10px] font-black text-gray-500 uppercase tracking-widest ml-1">Deskripsi Organisasi</label>
                        <textarea name="organiser_description" rows="8" class="w-full bg-[#121212] border border-white/5 rounded-2xl p-4 text-sm focus:border-blue-500 outline-none" placeholder="Profil singkat penyelenggara...">{{ old('organiser_description') }}</textarea>
                    </div>
                    <div class="space-y-4">
                        <label class="text-[10px] font-black text-gray-500 uppercase tracking-widest ml-1">Foto Organisasi / Tim</label>
                        <div class="border-2 border-dashed border-white/10 rounded-3xl p-10 text-center bg-[#121212] group">
                            <i class="fa-solid fa-users text-4xl text-gray-700 group-hover:text-blue-500 transition-colors mb-4 block"></i>
                            <p class="text-[11px] text-gray-500 font-medium mb-2" x-text="orgPhotoName ? orgPhotoName : 'Belum ada foto terpilih'"></p>
                            <input type="file" name="organiser_photo" class="hidden" id="org_photo" accept="image/*" @change="orgPhotoName = $event.target.files[0].name">
                            <button type="button" onclick="document.getElementById('org_photo').click()" class="px-6 py-2 bg-white/5 rounded-full text-[10px] font-bold hover:bg-white/10 transition-all border border-white/5">Upload Photo</button>
                        </div>
                    </div>
                </div>

                {{-- Action Akhir Tombol Submit --}}
                <div class="pt-10 flex justify-end gap-4 border-t border-white/5">
                    <button type="button" @click="activeTab = 'detail'" class="px-8 py-4 rounded-2xl bg-white/5 text-xs font-black uppercase tracking-widest hover:bg-white/10 transition-all text-gray-300">
                        Kembali
                    </button>
                    <button type="submit" class="px-10 py-4 rounded-2xl bg-blue-600 text-white text-xs font-black uppercase tracking-widest hover:bg-blue-700 shadow-lg shadow-blue-600/20 active:scale-95 transition-all">
                        Ajukan Event Sekarang
                    </button>
                </div>
            </div>

        </form>
    </main>

    {{-- Script Handler Sidebar Responsif --}}
    <script>
        const openBtn = document.getElementById('open-sidebar');
        const closeBtn = document.getElementById('close-sidebar');
        const sidebar = document.getElementById('main-sidebar');
        const overlay = document.getElementById('sidebar-overlay');

        if (openBtn && sidebar) {
            function toggleSidebar() {
                sidebar.classList.toggle('-translate-x-full');
                if (overlay) {
                    overlay.classList.toggle('hidden');
                }
                document.body.classList.toggle('overflow-hidden', !sidebar.classList.contains('-translate-x-full'));
            }

            openBtn.addEventListener('click', toggleSidebar);
            if (closeBtn) closeBtn.addEventListener('click', toggleSidebar);
            if (overlay) overlay.addEventListener('click', toggleSidebar);
        }
    </script>
</body>
</html>
