<script src="https://cdn.tailwindcss.com"></script>
<script src="https://unpkg.com/lucide@latest"></script>


    <a href="{{ route('registrasi.event') }}" class="absolute top-8 left-8 text-gray-500 hover:text-white transition-all group flex items-center gap-2">
    <i data-lucide="arrow-left" class="w-4 h-4 transition-transform group-hover:-translate-x-1"></i>
    <span class="text-[10px] font-black uppercase tracking-[0.2em]">Back</span>
</a>

<div class="min-h-screen bg-[#000000] text-white flex items-center justify-center font-sans p-4">

    <div class="bg-[#121212] border border-white/10 w-full max-w-md p-8 rounded-2xl shadow-2xl transition-all duration-300">

        <div class="text-center mb-8">
            <div class="bg-blue-600/20 w-16 h-16 rounded-full flex items-center justify-center mx-auto mb-4 animate-pulse">
                <i data-lucide="rocket" class="text-blue-500 w-8 h-8"></i>
            </div>
            <h2 class="text-2xl font-bold text-white tracking-tight italic uppercase">Siap Jadi Creator?</h2>
            <p class="text-gray-400 text-sm mt-2 leading-relaxed px-4">
                Bergabunglah di <b>Ticketify</b> untuk mulai membuat event dan mengelola ticketingmu secara profesional.
            </p>
        </div>

        <div class="space-y-4 text-gray-300">

            <div class="flex items-start gap-3 bg-white/5 p-4 rounded-xl border border-white/5 hover:bg-white/10 transition group">
                <i data-lucide="layout-dashboard" class="text-blue-500 w-5 h-5 mt-1 group-hover:scale-110 transition"></i>
                <div>
                    <p class="text-sm font-bold text-white mb-0.5">Akses Dashboard Khusus</p>
                    <p class="text-[11px] text-gray-500 leading-snug italic">Pantau penjualan tiket dan daftar peserta secara real-time.</p>
                </div>
            </div>

            <div class="flex items-start gap-3 bg-white/5 p-4 rounded-xl border border-white/5 hover:bg-white/10 transition group">
                <i data-lucide="zap" class="text-yellow-500 w-5 h-5 mt-1 group-hover:scale-110 transition"></i>
                <div>
                    <p class="text-sm font-bold text-white mb-0.5">Publikasi Event Instan</p>
                    <p class="text-[11px] text-gray-500 leading-snug italic">Buat event hanya dalam hitungan menit dan sebar ke seluruh kampus.</p>
                </div>
            </div>

            <div class="flex items-start gap-3 bg-white/5 p-4 rounded-xl border border-white/5 hover:bg-white/10 transition group">
                <i data-lucide="users-2" class="text-emerald-500 w-5 h-5 mt-1 group-hover:scale-110 transition"></i>
                <div>
                    <p class="text-sm font-bold text-white mb-0.5">Komunitas Polibatam</p>
                    <p class="text-[11px] text-gray-500 leading-snug italic">Terhubung langsung dengan audiens mahasiswa di lingkungan kampus.</p>
                </div>
            </div>

        </div>

        <div class="mt-10">
            <div class="flex flex-col gap-3">
                <a href="{{ route('register') }}"
                    class="w-full py-3.5 rounded-full text-xs font-black bg-white text-black hover:scale-105 active:scale-95 transition-all text-center tracking-[0.2em] uppercase shadow-lg shadow-white/5">
                    Buat Akun Sekarang
                </a>

                <a href="{{ route('login') }}"
                    class="w-full py-3 text-xs font-bold text-gray-500 hover:text-white transition text-center uppercase tracking-widest">
                    Sudah punya akun? <span class="underline underline-offset-4">Masuk</span>
                </a>
            </div>

            <p class="text-[10px] text-gray-600 text-center mt-6 uppercase tracking-widest font-medium">
                Technical Informatics Project &copy; 2026
            </p>
        </div>
    </div>
</div>

<script>
    // Inisialisasi Lucide Icons
    lucide.createIcons();
</script>
