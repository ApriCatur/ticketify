<script src="https://cdn.tailwindcss.com"></script>
<script src="https://unpkg.com/lucide@latest"></script>

<div class="min-h-screen bg-[#000000] text-white flex items-center justify-center font-sans p-4">

    <!-- CARD CONTAINER -->
    <div class="bg-[#121212] border border-white/10 w-full max-w-md p-8 rounded-2xl shadow-2xl transition-all duration-300">

        <!-- BACK BUTTON -->
        <div class="flex mb-6">
            <a href="{{ route('pembeli.event') }}" class="text-sm font-semibold text-gray-400 hover:text-blue-500 transition flex items-center gap-1">
                <i data-lucide="arrow-left" class="w-4 h-4"></i> Kembali
            </a>
        </div>

        <!-- HEADER -->
        <div class="text-center mb-8">
            <div class="bg-blue-600/20 w-16 h-16 rounded-full flex items-center justify-center mx-auto mb-4 animate-pulse">
                <i data-lucide="shield-check" class="text-blue-500 w-8 h-8"></i>
            </div>
            <h2 class="text-2xl font-bold text-white">Ajukan Sebagai Panitia</h2>
            <p class="text-gray-400 text-sm mt-2">Ubah akunmu menjadi <b>Organiser</b> dan mulai kelola event.</p>
        </div>

        <!-- RULES / PERSYARATAN -->
        <div class="space-y-4 text-gray-300 mb-8">
            <div class="flex items-start gap-3 bg-white/5 p-3 rounded-lg hover:bg-white/10 transition">
                <i data-lucide="user-plus" class="text-blue-500 w-5 h-5 mt-1 flex-shrink-0"></i>
                <p class="text-sm">
                    Status akun Anda akan berubah dari <b>Customer</b> menjadi <b>Organiser</b> setelah disetujui Admin.
                </p>
            </div>

            <div class="flex items-start gap-3 bg-white/5 p-3 rounded-lg hover:bg-white/10 transition">
                <i data-lucide="file-check" class="text-blue-500 w-5 h-5 mt-1 flex-shrink-0"></i>
                <p class="text-sm">
                    Anda wajib membuat event yang <b>edukatif, kreatif, dan tidak melanggar aturan kampus</b>.
                </p>
            </div>

            <div class="flex items-start gap-3 bg-white/5 p-3 rounded-lg hover:bg-white/10 transition">
                <i data-lucide="alert-triangle" class="text-yellow-500 w-5 h-5 mt-1 flex-shrink-0"></i>
                <p class="text-sm">
                    Pengajuan dapat <b>ditolak</b> jika tidak memenuhi syarat atau data tidak valid.
                </p>
            </div>

            <div class="flex items-start gap-3 bg-white/5 p-3 rounded-lg hover:bg-white/10 transition">
                <i data-lucide="shield-off" class="text-red-500 w-5 h-5 mt-1 flex-shrink-0"></i>
                <p class="text-sm">
                    Hak sebagai Organiser dapat <b>dicabut</b> jika melanggar kebijakan platform.
                </p>
            </div>
        </div>

        <!-- FORM AGREEMENT -->
        <form action="{{ route('role.apply') }}" method="POST" class="space-y-6">
            @csrf

            <!-- CHECKBOX -->
            <div class="flex items-start">
                <input type="checkbox" id="agreeCheck" required class="mt-1 rounded border-white/20 bg-transparent text-blue-600 focus:ring-blue-500 focus:ring-offset-[#121212] w-4 h-4 cursor-pointer">
                <label for="agreeCheck" class="ml-3 text-sm text-gray-400 cursor-pointer select-none leading-relaxed">
                    Saya menyetujui seluruh aturan dan siap bertanggung jawab sebagai Organiser di Ticketify.
                </label>
            </div>

            <!-- BUTTON ACTIONS -->
            <div class="flex space-x-3 pt-2">
                <a href="{{ route('pembeli.event') }}" class="w-1/2 text-center bg-white/5 hover:bg-white/10 text-gray-300 font-medium px-4 py-2.5 rounded-xl transition text-sm flex items-center justify-center">
                    Batal
                </a>

                <button type="submit" id="submitBtn" class="w-1/2 bg-blue-600 text-white font-medium px-4 py-2.5 rounded-xl transition text-sm opacity-50 cursor-not-allowed">
                    Kirim Pengajuan
                </button>
            </div>
        </form>

    </div>
</div>

<script>
    // Inisialisasi Lucide Icons
    lucide.createIcons();

    const checkbox = document.getElementById('agreeCheck');
    const button = document.getElementById('submitBtn');

    // Handle Perubahan State Checkbox (Real-time visual feedback)
    checkbox.addEventListener('change', () => {
        if (checkbox.checked) {
            button.classList.remove('opacity-50', 'cursor-not-allowed');
            button.classList.add('hover:bg-blue-700', 'active:scale-[0.98]');
        } else {
            button.classList.add('opacity-50', 'cursor-not-allowed');
            button.classList.remove('hover:bg-blue-700', 'active:scale-[0.98]');
        }
    });

  // Validasi saat tombol diklik (Interseptor jika HTML required dilewati)
    button.addEventListener('click', (e) => {
        if (!checkbox.checked) {
            e.preventDefault();
            alert("Kamu harus menyetujui aturan terlebih dahulu.");
        }
    });

    // PERBAIKAN DI SINI: Langsung panggil alert tanpa bungkus tag <script> lagi
</script> @if(session('success'))
    <script>
        alert("{{ session('success') }}");
    </script>
@endif

@if(session('error'))
    <script>
        alert("{{ session('error') }}");
    </script>
@endif

