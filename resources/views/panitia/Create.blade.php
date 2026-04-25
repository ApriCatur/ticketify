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
<body class="bg-[#09090b] text-white flex" x-data="{ activeTab: 'ticket' }">

    @include('layouts.sidebar-panitia')

    <main class="flex-1 p-10 overflow-y-auto">
        <header class="mb-10">
            <h1 class="text-3xl font-black tracking-tight">Create New Event</h1>
            <p class="text-gray-500 text-sm mt-2 font-medium">Isi formulir di bawah untuk mengajukan event baru ke Admin.</p>
        </header>

        <div class="flex gap-8 mb-8 border-b border-white/5">
            <button @click="activeTab = 'ticket'" :class="activeTab === 'ticket' ? 'border-b-2 border-blue-500 text-blue-500' : 'text-gray-500'" class="pb-4 font-bold text-sm transition-all flex items-center gap-2">
                <span class="w-6 h-6 rounded-full bg-white/5 flex items-center justify-center text-[10px]">1</span> Ticket
            </button>
            <button @click="activeTab = 'detail'" :class="activeTab === 'detail' ? 'border-b-2 border-blue-500 text-blue-500' : 'text-gray-500'" class="pb-4 font-bold text-sm transition-all flex items-center gap-2">
                <span class="w-6 h-6 rounded-full bg-white/5 flex items-center justify-center text-[10px]">2</span> Event Detail
            </button>
            <button @click="activeTab = 'organiser'" :class="activeTab === 'organiser' ? 'border-b-2 border-blue-500 text-blue-500' : 'text-gray-500'" class="pb-4 font-bold text-sm transition-all flex items-center gap-2">
                <span class="w-6 h-6 rounded-full bg-white/5 flex items-center justify-center text-[10px]">3</span> Organiser
            </button>
        </div>

        <form action="#" method="POST" enctype="multipart/form-data">

            <div x-show="activeTab === 'ticket'" class="space-y-8">
                <div class="grid md:grid-cols-2 gap-8">
                    <div class="space-y-4">
                        <label class="text-[10px] font-black text-gray-500 uppercase tracking-widest ml-1">Poster Event</label>
                        <div class="border-2 border-dashed border-white/10 rounded-3xl p-[110px] text-center hover:border-blue-500/50 transition-colors bg-[#121212] group relative overflow-hidden">
                            <i class="fa-solid fa-image text-4xl text-gray-700 group-hover:text-blue-500 transition-colors mb-4 block"></i>
                            <p class="text-[11px] text-gray-500 font-medium">Klik atau seret file poster di sini</p>
                            <input type="file" class="hidden" id="poster" accept="image/*">
                            <button type="button" onclick="document.getElementById('poster').click()" class="mt-4 px-6 py-2 bg-white/5 rounded-full text-[10px] font-bold hover:bg-white/10 transition-all border border-white/5">Pilih File</button>
                        </div>
                    </div>

                    <div class="space-y-6">
                        <div class="space-y-2">
                            <label class="text-[10px] font-black text-gray-500 uppercase tracking-widest ml-1">Nama Event</label>
                            <input type="text" placeholder="Masukkan nama event" class="w-full bg-[#121212] border border-white/5 rounded-xl px-4 py-3 text-sm focus:border-blue-500 outline-none transition-all">
                        </div>

                        <div class="space-y-2">
                             <label class="text-[10px] font-black text-gray-500 uppercase tracking-widest ml-1">Event Location</label>
                             <input type="text" placeholder="Masukkan lokasi event (contoh: Batam, Kepulauan Riau)" class="w-full bg-[#121212] border border-white/5 rounded-xl px-4 py-3 text-sm focus:border-blue-500 outline-none transition-all">
                        </div>

                        <div class="space-y-2">
                            <label class="text-[10px] font-black text-gray-500 uppercase tracking-widest ml-1">Social Media Link</label>
                            <input type="url" placeholder="https://instagram.com/..." class="w-full bg-[#121212] border border-white/5 rounded-xl px-4 py-3 text-sm focus:border-blue-500 outline-none transition-all">
                        </div>


                        <div class="grid grid-cols-2 gap-4">
                            <div class="space-y-2">
                                <label class="text-[10px] font-black text-gray-500 uppercase tracking-widest ml-1">Tanggal</label>
                                <input type="date" class="w-full bg-[#121212] border border-white/5 rounded-xl px-4 py-3 text-sm focus:border-blue-500 outline-none transition-all">
                            </div>

                        <div class="space-y-2">
                                <label class="text-[10px] font-black text-gray-500 uppercase tracking-widest ml-1">Waktu</label>
                                <input type="time" class="w-full bg-[#121212] border border-white/5 rounded-xl px-4 py-3 text-sm focus:border-blue-500 outline-none transition-all">
                            </div>


                        </div>
                    </div>
                </div>

                <div class="bg-[#121212] p-8 rounded-3xl border border-white/5" x-data="{ tickets: [{id: Date.now()}] }">
                    <div class="flex justify-between items-center mb-6">
                        <h3 class="font-bold text-sm flex items-center gap-2">
                            <i class="fa-solid fa-ticket text-blue-500"></i> Ticket Pricing & Stock
                        </h3>
                        <button type="button" @click="tickets.push({id: Date.now()})" class="px-4 py-2 bg-blue-600 rounded-xl text-[10px] font-black uppercase hover:bg-blue-700 transition-all flex items-center gap-2">
                            <i class="fa-solid fa-plus"></i> Tambah Kategori
                        </button>
                    </div>

                    <div class="space-y-4">
                        <template x-for="(ticket, index) in tickets" :key="ticket.id">
                            <div class="grid md:grid-cols-12 gap-4 items-end bg-white/[0.02] p-4 rounded-2xl border border-white/5">
                                <div class="md:col-span-4 space-y-2">
                                    <label class="text-[10px] font-black text-gray-500 uppercase tracking-widest ml-1">Jenis Tiket</label>
                                    <input type="text" placeholder="Contoh: Reguler / VIP" class="w-full bg-[#18181b] border border-white/5 rounded-xl px-4 py-3 text-sm focus:border-blue-500 outline-none">
                                </div>
                                <div class="md:col-span-4 space-y-2">
                                    <label class="text-[10px] font-black text-gray-500 uppercase tracking-widest ml-1">Harga (IDR)</label>
                                    <input type="number" placeholder="0" class="w-full bg-[#18181b] border border-white/5 rounded-xl px-4 py-3 text-sm focus:border-blue-500 outline-none">
                                </div>
                                <div class="md:col-span-3 space-y-2">
                                    <label class="text-[10px] font-black text-gray-500 uppercase tracking-widest ml-1">Stok Tiket</label>
                                    <input type="number" placeholder="100" class="w-full bg-[#18181b] border border-white/5 rounded-xl px-4 py-3 text-sm focus:border-blue-500 outline-none">
                                </div>
                                <div class="md:col-span-1 flex justify-center pb-1">
                                    <button type="button" @click="tickets = tickets.filter(t => t.id !== ticket.id)" x-show="tickets.length > 1" class="text-red-500 hover:text-red-400 p-2">
                                        <i class="fa-solid fa-trash-can"></i>
                                    </button>
                                </div>
                            </div>
                        </template>
                    </div>
                </div>
            </div>

            <div x-show="activeTab === 'detail'" class="space-y-8" style="display: none;">
                <div class="space-y-2">
                    <label class="text-[10px] font-black text-gray-500 uppercase tracking-widest ml-1">Deskripsi Event</label>
                    <textarea rows="6" class="w-full bg-[#121212] border border-white/5 rounded-2xl p-4 text-sm focus:border-blue-500 outline-none" placeholder="Ceritakan detail acaramu..."></textarea>
                </div>
                <div class="space-y-2">
                    <label class="text-[10px] font-black text-gray-500 uppercase tracking-widest ml-1">Link Google Maps</label>
                    <input type="text" placeholder="Paste link lokasi dari Google Maps" class="w-full bg-[#121212] border border-white/5 rounded-xl px-4 py-3 text-sm focus:border-blue-500 outline-none">
                </div>
                <div class="space-y-2">
                    <label class="text-[10px] font-black text-gray-500 uppercase tracking-widest ml-1">Syarat & Ketentuan</label>
                    <textarea rows="4" class="w-full bg-[#121212] border border-white/5 rounded-2xl p-4 text-sm focus:border-blue-500 outline-none" placeholder="1. Peserta wajib..."></textarea>
                </div>
            </div>

            <div x-show="activeTab === 'organiser'" class="space-y-8" style="display: none;">
                <div class="grid md:grid-cols-2 gap-8">
                    <div class="space-y-2">
                        <label class="text-[10px] font-black text-gray-500 uppercase tracking-widest ml-1">Deskripsi Organisasi</label>
                        <textarea rows="8" class="w-full bg-[#121212] border border-white/5 rounded-2xl p-4 text-sm focus:border-blue-500 outline-none" placeholder="Profil singkat penyelenggara..."></textarea>
                    </div>
                    <div class="space-y-4">
                        <label class="text-[10px] font-black text-gray-500 uppercase tracking-widest ml-1">Foto Organisasi / Tim</label>
                        <div class="border-2 border-dashed border-white/10 rounded-3xl p-10 text-center bg-[#121212] group">
                            <i class="fa-solid fa-users text-4xl text-gray-700 group-hover:text-blue-500 transition-colors mb-4 block"></i>
                            <input type="file" class="hidden" id="org_photo">
                            <button type="button" onclick="document.getElementById('org_photo').click()" class="px-6 py-2 bg-white/5 rounded-full text-[10px] font-bold hover:bg-white/10 transition-all border border-white/5">Upload Photo</button>
                        </div>
                    </div>
                </div>

                <div class="pt-10 flex justify-end gap-4 border-t border-white/5">
                    <button type="button" @click="activeTab = 'detail'" class="px-8 py-4 rounded-2xl bg-white/5 text-xs font-black uppercase tracking-widest hover:bg-white/10 transition-all">Kembali</button>
                    <button type="submit" class="px-10 py-4 rounded-2xl bg-blue-600 text-white text-xs font-black uppercase tracking-widest hover:bg-blue-700 shadow-lg shadow-blue-600/20 active:scale-95 transition-all">
                        Ajukan Event Sekarang
                    </button>
                </div>
            </div>


        </form>
    </main>

</body>
</html>
