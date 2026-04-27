<script src="https://cdn.tailwindcss.com"></script>
<script src="https://unpkg.com/lucide@latest"></script>

<div class="min-h-screen bg-[#000000] text-white flex items-center justify-center font-sans">

    <div class="bg-[#121212] border border-white/10 w-full max-w-md p-8 rounded-2xl shadow-2xl transition-all duration-300">

        <!-- HEADER -->
        <div class="text-center mb-8">
            <div class="bg-blue-600/20 w-16 h-16 rounded-full flex items-center justify-center mx-auto mb-4 animate-pulse">
                <i data-lucide="shield-check" class="text-blue-500 w-8 h-8"></i>
            </div>
            <h2 class="text-2xl font-bold text-white">Ajukan Sebagai Panitia</h2>
            <p class="text-gray-400 text-sm mt-2">Ubah akunmu menjadi <b>Organiser</b> dan mulai kelola event.</p>
        </div>

        <!-- RULES -->
        <div class="space-y-4 text-gray-300">

            <div class="flex items-start gap-3 bg-white/5 p-3 rounded-lg hover:bg-white/10 transition">
                <i data-lucide="user-plus" class="text-blue-500 w-5 h-5 mt-1"></i>
                <p class="text-sm">
                    Status akun Anda akan berubah dari <b>Customer</b> menjadi <b>Organiser</b> setelah disetujui Admin.
                </p>
            </div>

            <div class="flex items-start gap-3 bg-white/5 p-3 rounded-lg hover:bg-white/10 transition">
                <i data-lucide="file-check" class="text-blue-500 w-5 h-5 mt-1"></i>
                <p class="text-sm">
                    Anda wajib membuat event yang <b>edukatif, kreatif, dan tidak melanggar aturan kampus</b>.
                </p>
            </div>

            <div class="flex items-start gap-3 bg-white/5 p-3 rounded-lg hover:bg-white/10 transition">
                <i data-lucide="alert-triangle" class="text-yellow-500 w-5 h-5 mt-1"></i>
                <p class="text-sm">
                    Pengajuan dapat <b>ditolak</b> jika tidak memenuhi syarat atau data tidak valid.
                </p>
            </div>

            <div class="flex items-start gap-3 bg-white/5 p-3 rounded-lg hover:bg-white/10 transition">
                <i data-lucide="shield-off" class="text-red-500 w-5 h-5 mt-1"></i>
                <p class="text-sm">
                    Hak sebagai Organiser dapat <b>dicabut</b> jika melanggar kebijakan platform.
                </p>
            </div>

        </div>

        <!-- AGREEMENT -->
        <div class="mt-8">
            <label class="flex items-start gap-3 cursor-pointer mb-6 group">
                <input id="agreeCheck" type="checkbox"
                    class="mt-1 w-4 h-4 rounded border-white/10 bg-white/5 text-blue-600 focus:ring-blue-500">
                <span class="text-xs text-gray-400 group-hover:text-gray-300 transition">
                    Saya menyetujui seluruh aturan dan siap bertanggung jawab sebagai Organiser di Ticketify.
                </span>
            </label>

            <!-- BUTTON -->
            <div class="flex gap-3">
                <a href="{{ route('pembeli.event') }}"
                    class="flex-1 py-3 rounded-full text-sm font-semibold border border-white/10 hover:bg-white/5 transition text-center">
                    Batal
                </a>

                <a href="#" id="submitBtn"
                    class="flex-1 py-3 rounded-full text-sm font-bold bg-blue-600 opacity-50 cursor-not-allowed transition text-center">
                    Kirim Pengajuan
                </a>
            </div>
        </div>
    </div>
</div>

<script>
    lucide.createIcons();

    const checkbox = document.getElementById('agreeCheck');
    const button = document.getElementById('submitBtn');

    checkbox.addEventListener('change', () => {
        if (checkbox.checked) {
            button.classList.remove('opacity-50', 'cursor-not-allowed');
            button.classList.add('hover:bg-blue-700');
        } else {
            button.classList.add('opacity-50', 'cursor-not-allowed');
            button.classList.remove('hover:bg-blue-700');
        }
    });

    // Prevent klik kalau belum centang
    button.addEventListener('click', (e) => {
        if (!checkbox.checked) {
            e.preventDefault();
            alert("Kamu harus menyetujui aturan terlebih dahulu.");
        } else {
            alert("Pengajuan berhasil dikirim!");
        }
    });
</script>
