<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ticketify - Edit Event</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        [x-cloak] {
            display: none;
        }

        img[x-show] {
            max-height: 300px;
            object-fit: cover;
        }
    </style>
</head>
<body
class="bg-[#09090b] text-white flex min-h-screen"

x-data='{
    activeTab: "ticket",

    bannerName: @json($event->banner ?? ""),
    bannerPreview: @json($event->banner ? asset("images/events/".$event->banner) : ""),

    orgPhotoName: @json($event->organiser_photo ?? ""),
    orgPhotoPreview: @json($event->organiser_photo ? asset("images/organizers/".$event->organiser_photo) : ""),

    ticketRows: @json($ticketTypes),

    handleBannerChange(event) {
        const file = event.target.files[0];

        if (file) {
            this.bannerName = file.name;

            const reader = new FileReader();

            reader.onload = (e) => {
                this.bannerPreview = e.target.result;
            };

            reader.readAsDataURL(file);
        }
    },

    handleOrgPhotoChange(event) {
        const file = event.target.files[0];

        if (file) {
            this.orgPhotoName = file.name;

            const reader = new FileReader();

            reader.onload = (e) => {
                this.orgPhotoPreview = e.target.result;
            };

            reader.readAsDataURL(file);
        }
    }
}'
>
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
                        <div class="border-2 border-dashed border-white/10 rounded-3xl p-[110px] text-center hover:border-blue-500/50 transition-colors bg-[#121212] group relative overflow-hidden" :class="bannerPreview ? 'p-4' : 'p-[110px]'">
                            <template x-if="!bannerPreview">
                                <div class="flex flex-col items-center justify-center">
                                    <i class="fa-solid fa-image text-4xl text-gray-700 group-hover:text-blue-500 transition-colors mb-4 block"></i>
                                    <p class="text-[11px] text-gray-500 font-medium">Klik atau seret file poster baru di sini</p>
                                    <button type="button" onclick="document.getElementById('poster').click()" class="mt-4 px-6 py-2 bg-white/5 rounded-full text-[10px] font-bold hover:bg-white/10 transition-all border border-white/5">Pilih File Baru</button>
                                </div>
                            </template>
                            <template x-if="bannerPreview">
                                <div class="relative">
                                    <img :src="bannerPreview" alt="Banner Preview" class="w-full h-64 object-cover rounded-2xl">
                                    <button type="button" @click="bannerName = ''; bannerPreview = ''; document.getElementById('poster').value = '';" class="absolute top-2 right-2 w-8 h-8 bg-red-500 rounded-full flex items-center justify-center text-white text-xs hover:bg-red-600 transition">
                                        <i class="fa-solid fa-times"></i>
                                    </button>
                                    <p class="text-[11px] text-gray-400 font-medium mt-2" x-text="'File: ' + bannerName"></p>
                                </div>
                            </template>
                            <input type="file" name="banner" class="hidden" id="poster" accept="image/*" @change="handleBannerChange($event)">
                        </div>
                    </div>

                    <div class="space-y-6">
                        <div class="space-y-2">
                            <label class="text-[10px] font-black text-gray-500 uppercase tracking-widest ml-1">Nama Event</label>
                            <input type="text" name="name" value="{{ old('name', $event->name) }}" placeholder="Masukkan nama event" class="w-full bg-[#121212] border border-white/5 rounded-xl px-4 py-3 text-sm focus:border-blue-500 outline-none transition-all" required>
                        </div>

                        <div class="space-y-2">
                            <label class="text-[10px] font-black text-gray-500 uppercase tracking-widest ml-1">Kategori Event</label>
                            <select name="category_id" class="w-full bg-[#121212] border border-white/5 rounded-xl px-4 py-3 text-sm focus:border-blue-500 outline-none transition-all text-white" required>
                                <option value="" disabled class="bg-[#121212]">Pilih kategori event</option>
                                @foreach($categories as $cat)
                                    <option value="{{ $cat->id }}" {{ old('category_id', $event->category_id) == $cat->id ? 'selected' : '' }} class="bg-[#121212]">{{ $cat->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="space-y-2">
                             <label class="text-[10px] font-black text-gray-500 uppercase tracking-widest ml-1">Event Location</label>
                             <input type="text" name="location" value="{{ old('location', $event->location) }}" placeholder="Masukkan lokasi event (contoh: Batam, Kepulauan Riau)" class="w-full bg-[#121212] border border-white/5 rounded-xl px-4 py-3 text-sm focus:border-blue-500 outline-none transition-all" required>
                        </div>

                        <div class="grid grid-cols-3 gap-4">
                            <div class="space-y-2">
                                <label class="text-[10px] font-black text-gray-500 uppercase tracking-widest ml-1">Tanggal</label>
                                <input type="date" name="date" value="{{ old('date', $event->date) }}" class="w-full bg-[#121212] border border-white/5 rounded-xl px-4 py-3 text-sm focus:border-blue-500 outline-none transition-all" required>
                            </div>
                            <div class="space-y-2">
                                <label class="text-[10px] font-black text-gray-500 uppercase tracking-widest ml-1">Waktu Mulai</label>
                                <input type="time" name="time_start" value="{{ old('time_start', $event->time_start) }}" class="w-full bg-[#121212] border border-white/5 rounded-xl px-4 py-3 text-sm focus:border-blue-500 outline-none transition-all" required>
                            </div>
                            <div class="space-y-2">
                                <label class="text-[10px] font-black text-gray-500 uppercase tracking-widest ml-1">Waktu Selesai</label>
                                <input type="time" name="time_end" value="{{ old('time_end', $event->time_end) }}" class="w-full bg-[#121212] border border-white/5 rounded-xl px-4 py-3 text-sm focus:border-blue-500 outline-none transition-all" required>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="bg-[#121212] p-8 rounded-3xl border border-white/5">
                    <div class="flex justify-between items-center mb-6">
                        <h3 class="font-bold text-sm flex items-center gap-2">
                            <i class="fa-solid fa-ticket text-blue-500"></i> Ticket Pricing & Stock
                        </h3>
                        <button type="button" @click="ticketRows.push({ ticket_type: '', price: 0, stock: 100 })" class="px-4 py-2 bg-blue-600 text-white rounded-2xl text-xs font-black uppercase tracking-wide hover:bg-blue-500 transition">Tambah Jenis Tiket</button>
                    </div>

                    <div class="space-y-3">
                        <template x-for="(ticket, index) in ticketRows" :key="index">
                            <div class="grid md:grid-cols-12 gap-4 items-end bg-white/[0.02] p-4 rounded-2xl border border-white/5">
                                <div class="md:col-span-4 space-y-2">
                                    <label class="text-[10px] font-black text-gray-500 uppercase tracking-widest ml-1">Jenis Tiket</label>
                                    <input type="text" :name="'ticket_types['+index+'][ticket_type]'" x-model="ticket.ticket_type" placeholder="Contoh: Reguler / VIP" class="w-full bg-[#18181b] border border-white/5 rounded-xl px-4 py-3 text-sm focus:border-blue-500 outline-none" required>
                                </div>
                                <div class="md:col-span-4 space-y-2">
                                    <label class="text-[10px] font-black text-gray-500 uppercase tracking-widest ml-1">Harga (IDR)</label>
                                    <input type="number" :name="'ticket_types['+index+'][price]'" x-model="ticket.price" min="0" class="w-full bg-[#18181b] border border-white/5 rounded-xl px-4 py-3 text-sm focus:border-blue-500 outline-none" required>
                                </div>
                                <div class="md:col-span-3 space-y-2">
                                    <label class="text-[10px] font-black text-gray-500 uppercase tracking-widest ml-1">Stok Tiket</label>
                                    <input type="number" :name="'ticket_types['+index+'][stock]'" x-model="ticket.stock" min="0" class="w-full bg-[#18181b] border border-white/5 rounded-xl px-4 py-3 text-sm focus:border-blue-500 outline-none" required>
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
                    <textarea name="description" rows="6" class="w-full bg-[#121212] border border-white/5 rounded-2xl p-4 text-sm focus:border-blue-500 outline-none" placeholder="Ceritakan detail acaramu..." required>{{ old('description', $event->description) }}</textarea>
                </div>
                <div class="space-y-2">
                    <label class="text-[10px] font-black text-gray-500 uppercase tracking-widest ml-1">Syarat & Ketentuan</label>
                    <textarea name="terms" rows="4" class="w-full bg-[#121212] border border-white/5 rounded-2xl p-4 text-sm focus:border-blue-500 outline-none" placeholder="1. Peserta wajib..." required>{{ old('terms', $event->terms) }}</textarea>
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
                        <textarea name="organiser_description" rows="8" class="w-full bg-[#121212] border border-white/5 rounded-2xl p-4 text-sm focus:border-blue-500 outline-none" placeholder="Profil singkat penyelenggara...">{{ old('organiser_description', $event->organiser_description) }}</textarea>
                    </div>
                    <div class="space-y-4">
                        <label class="text-[10px] font-black text-gray-500 uppercase tracking-widest ml-1">Foto Organisasi / Tim</label>
                        <div class="border-2 border-dashed border-white/10 rounded-3xl p-10 text-center bg-[#121212] group" :class="orgPhotoPreview ? 'p-4' : 'p-10'">
                            <template x-if="!orgPhotoPreview">
                                <div class="flex flex-col items-center justify-center">
                                    <i class="fa-solid fa-users text-4xl text-gray-700 group-hover:text-blue-500 transition-colors mb-4 block"></i>
                                    <p class="text-[11px] text-gray-500 font-medium mb-2">Belum ada foto terpilih</p>
                                    <button type="button" onclick="document.getElementById('organiser_photo').click()" class="px-6 py-2 bg-white/5 rounded-full text-[10px] font-bold hover:bg-white/10 transition-all border border-white/5">Upload Photo Baru</button>
                                </div>
                            </template>
                            <template x-if="orgPhotoPreview">
                                <div class="relative">
                                    <img :src="orgPhotoPreview" alt="Organiser Photo Preview" class="w-full h-64 object-cover rounded-2xl">
                                    <button type="button" @click="orgPhotoName = ''; orgPhotoPreview = ''; document.getElementById('organiser_photo').value = '';" class="absolute top-2 right-2 w-8 h-8 bg-red-500 rounded-full flex items-center justify-center text-white text-xs hover:bg-red-600 transition">
                                        <i class="fa-solid fa-times"></i>
                                    </button>
                                    <p class="text-[11px] text-gray-400 font-medium mt-2" x-text="'File: ' + orgPhotoName"></p>
                                </div>
                            </template>
                            <input type="file" name="organiser_photo" class="hidden" id="organiser_photo" accept="image/*" @change="handleOrgPhotoChange($event)">
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
