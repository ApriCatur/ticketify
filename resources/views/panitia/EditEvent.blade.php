<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ticketify - Edit Event</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body class="bg-[#09090b] text-white flex min-h-screen"
    x-data="{
        activeTab: 'ticket',
        bannerName: '{{ $event->banner ? $event->banner : '' }}',
        orgPhotoName: '{{ $event->organiser_photo ? $event->organiser_photo : '' }}',
        ticketRows: {{ $event->ticket_types ? json_encode($event->ticket_types) : '[{ name: &quot;Reguler Pass&quot;, price: 0, stock: 100 }]' }}
    }">

    @include('layouts.sidebar-panitia')

    <div id="sidebar-overlay" class="fixed inset-0 bg-black/50 backdrop-blur-sm z-40 hidden lg:hidden"></div>

    <main class="flex-1 p-10 overflow-y-auto">

        @if ($errors->any())
            <div class="mb-6 p-4 bg-red-500/10 border border-red-500/20 text-red-400 rounded-2xl text-sm">
                <strong class="block mb-1 font-black uppercase tracking-wide text-xs text-red-500">Gagal Menyimpan Perubahan:</strong>
                <ul class="list-disc list-inside space-y-1 text-xs">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <header class="mb-10">
            <button id="open-sidebar" class="lg:hidden text-gray-400 hover:text-blue-500 transition-colors mb-4">
                <i class="fa-solid fa-bars-staggered text-2xl"></i>
            </button>
            <h1 class="text-3xl font-black tracking-tight">Edit Event</h1>
            <p class="text-gray-500 text-sm mt-2 font-medium">Perbarui informasi untuk event: <span class="text-blue-400">{{ $event->name }}</span></p>
        </header>

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

        {{-- FIXED: Mengubah route ke panitia.events.update --}}
        <form action="{{ route('panitia.events.update', $event->id) }}" method="POST" enctype="multipart/form-data" id="editEventForm" novalidate>
            @csrf
            @method('PUT')

            <div x-show="activeTab === 'ticket'" class="space-y-8">
                <div class="grid md:grid-cols-2 gap-8">
                    <div class="space-y-4">
                        <label class="text-[10px] font-black text-gray-500 uppercase tracking-widest ml-1">Poster Event</label>
                        <div class="border-2 border-dashed border-white/10 rounded-3xl p-[110px] text-center hover:border-blue-500/50 transition-colors bg-[#121212] group relative overflow-hidden">
                            <i class="fa-solid fa-image text-4xl text-gray-700 group-hover:text-blue-500 transition-colors mb-4 block"></i>
                            <p class="text-[11px] text-gray-500 font-medium" x-text="bannerName ? bannerName : 'Klik atau seret file poster di sini'"></p>
                            <input type="file" name="banner" class="hidden" id="poster" accept="image/*" @change="bannerName = $event.target.files[0].name">
                            <button type="button" onclick="document.getElementById('poster').click()" class="mt-4 px-6 py-2 bg-white/5 rounded-full text-[10px] font-bold hover:bg-white/10 transition-all border border-white/5">Pilih File Baru</button>
                        </div>
                    </div>

                    <div class="space-y-6">
                        <div class="space-y-2">
                            <label class="text-[10px] font-black text-gray-500 uppercase tracking-widest ml-1">Nama Event</label>
                            <input type="text" name="nama_event" value="{{ old('nama_event', $event->name) }}" placeholder="Masukkan nama event" class="w-full bg-[#121212] border border-white/5 rounded-xl px-4 py-3 text-sm focus:border-blue-500 outline-none transition-all" required>
                        </div>

                        <div class="space-y-2">
                            <label class="text-[10px] font-black text-gray-500 uppercase tracking-widest ml-1">Kategori Event</label>
                            <select name="kategori" class="w-full bg-[#121212] border border-white/5 rounded-xl px-4 py-3 text-sm focus:border-blue-500 outline-none transition-all text-white" required>
                                <option value="" disabled class="bg-[#121212]">Pilih kategori event</option>
                                <option value="Music Concert" {{ old('kategori', $event->category) == 'Music Concert' ? 'selected' : '' }} class="bg-[#121212]">Music Concert</option>
                                <option value="Seminar" {{ old('kategori', $event->category) == 'Seminar' ? 'selected' : '' }} class="bg-[#121212]">Seminar</option>
                                <option value="Workshop" {{ old('kategori', $event->category) == 'Workshop' ? 'selected' : '' }} class="bg-[#121212]">Workshop</option>
                                <option value="Festival" {{ old('kategori', $event->category) == 'Festival' ? 'selected' : '' }} class="bg-[#121212]">Festival</option>
                            </select>
                        </div>

                        <div class="space-y-2">
                             <label class="text-[10px] font-black text-gray-500 uppercase tracking-widest ml-1">Event Location</label>
                             <input type="text" name="lokasi" value="{{ old('lokasi', $event->location) }}" placeholder="Masukkan lokasi event" class="w-full bg-[#121212] border border-white/5 rounded-xl px-4 py-3 text-sm focus:border-blue-500 outline-none transition-all" required>
                        </div>

                        <div class="space-y-2">
                            <label class="text-[10px] font-black text-gray-500 uppercase tracking-widest ml-1">Social Media Link</label>
                            <input type="url" name="sosmed_link" value="{{ old('sosmed_link', $event->social_link) }}" placeholder="https://instagram.com/..." class="w-full bg-[#121212] border border-white/5 rounded-xl px-4 py-3 text-sm focus:border-blue-500 outline-none transition-all">
                        </div>

                        <div class="grid grid-cols-3 gap-4">
                            <div class="space-y-2">
                                <label class="text-[10px] font-black text-gray-500 uppercase tracking-widest ml-1">Tanggal</label>
                                <input type="date" name="tanggal" value="{{ old('tanggal', $event->date) }}" class="w-full bg-[#121212] border border-white/5 rounded-xl px-4 py-3 text-sm focus:border-blue-500 outline-none transition-all" required>
                            </div>
                            <div class="space-y-2">
                                <label class="text-[10px] font-black text-gray-500 uppercase tracking-widest ml-1">Waktu Mulai</label>
                                <input type="time" name="waktu_mulai" value="{{ old('waktu_mulai', $event->time_start) }}" class="w-full bg-[#121212] border border-white/5 rounded-xl px-4 py-3 text-sm focus:border-blue-500 outline-none transition-all" required>
                            </div>
                            <div class="space-y-2">
                                <label class="text-[10px] font-black text-gray-500 uppercase tracking-widest ml-1">Waktu Selesai</label>
                                <input type="time" name="waktu_selesai" value="{{ old('waktu_selesai', $event->time_end) }}" class="w-full bg-[#121212] border border-white/5 rounded-xl px-4 py-3 text-sm focus:border-blue-500 outline-none transition-all" required>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="bg-[#121212] p-8 rounded-3xl border border-white/5">
                    <div class="flex justify-between items-center mb-6">
                        <h3 class="font-bold text-sm flex items-center gap-2">
                            <i class="fa-solid fa-ticket text-blue-500"></i> Ticket Pricing & Stock
                        </h3>
                        <button type="button" @click="ticketRows.push({ name: '', price: 0, stock: 100 })" class="px-4 py-2 bg-blue-600 text-white rounded-2xl text-xs font-black uppercase tracking-wide hover:bg-blue-500 transition">Tambah Jenis Tiket</button>
                    </div>

                    <div class="space-y-3">
                        <template x-for="(ticket, index) in ticketRows" :key="index">
                            <div class="grid md:grid-cols-12 gap-4 items-end bg-white/[0.02] p-4 rounded-2xl border border-white/5">
                                <div class="md:col-span-4 space-y-2">
                                    <label class="text-[10px] font-black text-gray-500 uppercase tracking-widest ml-1">Jenis Tiket</label>
                                    <input type="text" :name="'tickets['+index+'][name]'" x-model="ticket.name" placeholder="Contoh: Reguler / VIP" class="w-full bg-[#18181b] border border-white/5 rounded-xl px-4 py-3 text-sm focus:border-blue-500 outline-none" required>
                                </div>
                                <div class="md:col-span-4 space-y-2">
                                    <label class="text-[10px] font-black text-gray-500 uppercase tracking-widest ml-1">Harga (IDR)</label>
                                    <input type="number" :name="'tickets['+index+'][price]'" x-model="ticket.price" min="0" class="w-full bg-[#18181b] border border-white/5 rounded-xl px-4 py-3 text-sm focus:border-blue-500 outline-none" required>
                                </div>
                                <div class="md:col-span-3 space-y-2">
                                    <label class="text-[10px] font-black text-gray-500 uppercase tracking-widest ml-1">Stok Tiket</label>
                                    <input type="number" :name="'tickets['+index+'][stock]'" x-model="ticket.stock" min="0" class="w-full bg-[#18181b] border border-white/5 rounded-xl px-4 py-3 text-sm focus:border-blue-500 outline-none" required>
                                </div>
                                <div class="md:col-span-1 flex items-end justify-end">
                                    <button type="button" @click="ticketRows.splice(index, 1)" x-show="ticketRows.length > 1" class="w-full py-3 bg-red-500/10 text-red-400 rounded-xl text-xs font-black uppercase tracking-widest hover:bg-red-500/20 transition">Hapus</button>
                                </div>
                            </div>
                        </template>
                    </div>
                </div>

                <div class="flex justify-end">
                    <button type="button" @click="activeTab = 'detail'" class="px-10 py-4 rounded-2xl bg-blue-600 text-white text-xs font-black uppercase tracking-widest hover:bg-blue-700 transition-all">Lanjut ke Detail</button>
                </div>
            </div>

            <div x-show="activeTab === 'detail'" class="space-y-8" style="display: none;">
                <div class="space-y-2">
                    <label class="text-[10px] font-black text-gray-500 uppercase tracking-widest ml-1">Deskripsi Event</label>
                    <textarea name="deskripsi" rows="6" class="w-full bg-[#121212] border border-white/5 rounded-2xl p-4 text-sm focus:border-blue-500 outline-none" placeholder="Ceritakan detail acaramu..." required>{{ old('deskripsi', $event->description) }}</textarea>
                </div>
                <div class="space-y-2">
                    <label class="text-[10px] font-black text-gray-500 uppercase tracking-widest ml-1">Link Google Maps</label>
                    <input type="text" name="maps_link" value="{{ old('maps_link', $event->maps_link) }}" placeholder="Paste link lokasi dari Google Maps" class="w-full bg-[#121212] border border-white/5 rounded-xl px-4 py-3 text-sm focus:border-blue-500 outline-none">
                </div>
                <div class="space-y-2">
                    <label class="text-[10px] font-black text-gray-500 uppercase tracking-widest ml-1">Syarat & Ketentuan</label>
                    <textarea name="syarat_ketentuan" rows="4" class="w-full bg-[#121212] border border-white/5 rounded-2xl p-4 text-sm focus:border-blue-500 outline-none" placeholder="1. Peserta wajib..." required>{{ old('syarat_ketentuan', $event->terms) }}</textarea>
                </div>

                <div class="flex justify-end gap-4">
                    <button type="button" @click="activeTab = 'ticket'" class="px-8 py-4 rounded-2xl bg-white/5 text-xs font-black uppercase tracking-widest hover:bg-white/10 transition-all">Kembali</button>
                    <button type="button" @click="activeTab = 'organiser'" class="px-10 py-4 rounded-2xl bg-blue-600 text-white text-xs font-black uppercase tracking-widest hover:bg-blue-700 transition-all">Lanjut ke Organiser</button>
                </div>
            </div>

            <div x-show="activeTab === 'organiser'" class="space-y-8" style="display: none;">
                <div class="grid md:grid-cols-2 gap-8">
                    <div class="space-y-2">
                        <label class="text-[10px] font-black text-gray-500 uppercase tracking-widest ml-1">Deskripsi Organisasi</label>
                        <textarea name="deskripsi_org" rows="8" class="w-full bg-[#121212] border border-white/5 rounded-2xl p-4 text-sm focus:border-blue-500 outline-none" placeholder="Profil singkat penyelenggara...">{{ old('deskripsi_org', $event->organiser_description) }}</textarea>
                    </div>
                    <div class="space-y-4">
                        <label class="text-[10px] font-black text-gray-500 uppercase tracking-widest ml-1">Foto Organisasi / Tim</label>
                        <div class="border-2 border-dashed border-white/10 rounded-3xl p-10 text-center bg-[#121212] group">
                            <i class="fa-solid fa-users text-4xl text-gray-700 group-hover:text-blue-500 transition-colors mb-4 block"></i>
                            <p class="text-[11px] text-gray-500 font-medium mb-2" x-text="orgPhotoName ? orgPhotoName : 'Belum ada foto terpilih'"></p>
                            <input type="file" name="org_photo" class="hidden" id="org_photo" accept="image/*" @change="orgPhotoName = $event.target.files[0].name">
                            <button type="button" onclick="document.getElementById('org_photo').click()" class="px-6 py-2 bg-white/5 rounded-full text-[10px] font-bold hover:bg-white/10 transition-all border border-white/5">Upload Photo Baru</button>
                        </div>
                    </div>
                </div>

                <div class="pt-10 flex justify-end gap-4 border-t border-white/5">
                    <button type="button" @click="activeTab = 'detail'" class="px-8 py-4 rounded-2xl bg-white/5 text-xs font-black uppercase tracking-widest hover:bg-white/10 transition-all text-gray-300">
                        Kembali
                    </button>
                    <button type="button" @click="document.getElementById('editEventForm').submit()" class="px-10 py-4 rounded-2xl bg-blue-600 text-white text-xs font-black uppercase tracking-widest hover:bg-blue-700 shadow-lg shadow-blue-600/20 active:scale-95 transition-all">
                        Simpan Perubahan
                    </button>
                </div>
            </div>

        </form>
    </main>

    <script>
        const openBtn = document.getElementById('open-sidebar');
        const sidebar = document.getElementById('main-sidebar');
        const overlay = document.getElementById('sidebar-overlay');

        if (openBtn && sidebar) {
            function toggleSidebar() {
                sidebar.classList.toggle('hidden');
                sidebar.classList.toggle('fixed');
                sidebar.classList.toggle('z-50');
                if (overlay) overlay.classList.toggle('hidden');
            }
            openBtn.addEventListener('click', toggleSidebar);
            if (overlay) overlay.addEventListener('click', toggleSidebar);
        }
    </script>
</body>
</html>
