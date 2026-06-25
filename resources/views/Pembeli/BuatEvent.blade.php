<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ticketify — Ajukan Sebagai Panitia</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://unpkg.com/lucide@latest"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap');
        body { font-family: 'Inter', sans-serif; }
    </style>
</head>
<body class="bg-[#F8FAFC] text-gray-900 antialiased">

    <div class="flex flex-col min-h-screen">
        @include('components.pembeli-nav')

        <main class="flex-1 flex items-center justify-center p-4">
            <div class="bg-white border border-gray-200 shadow-sm w-full max-w-md p-8 rounded-2xl transition-all duration-300">

                <div class="flex mb-6">
                    <a href="{{ route('pembeli.event') }}" class="text-sm font-semibold text-gray-500 hover:text-blue-600 transition flex items-center gap-1">
                        <i data-lucide="arrow-left" class="w-4 h-4"></i> Kembali
                    </a>
                </div>

                <div class="text-center mb-8">
                    <div class="bg-blue-50 w-16 h-16 rounded-full flex items-center justify-center mx-auto mb-4">
                        <i data-lucide="shield-check" class="text-blue-600 w-8 h-8"></i>
                    </div>
                    <h2 class="text-2xl font-bold text-gray-900">Ajukan Sebagai Panitia</h2>
                    <p class="text-gray-500 text-sm mt-2">Ubah akunmu menjadi <b>Organiser</b> dan mulai kelola event.</p>
                </div>

                <div class="space-y-3 mb-6">
                    <div class="flex items-start gap-3 bg-gray-50 border border-gray-200 p-3 rounded-xl">
                        <i data-lucide="user-plus" class="text-blue-600 w-5 h-5 mt-0.5 flex-shrink-0"></i>
                        <p class="text-sm text-gray-600">
                            Status akun Anda akan berubah dari <b>Customer</b> menjadi <b>Organiser</b> setelah disetujui Admin.
                        </p>
                    </div>

                    <div class="flex items-start gap-3 bg-gray-50 border border-gray-200 p-3 rounded-xl">
                        <i data-lucide="file-check" class="text-blue-600 w-5 h-5 mt-0.5 flex-shrink-0"></i>
                        <p class="text-sm text-gray-600">
                            Anda wajib membuat event yang <b>edukatif, kreatif, dan tidak melanggar aturan kampus</b>.
                        </p>
                    </div>

                    <div class="flex items-start gap-3 bg-gray-50 border border-gray-200 p-3 rounded-xl">
                        <i data-lucide="alert-triangle" class="text-amber-500 w-5 h-5 mt-0.5 flex-shrink-0"></i>
                        <p class="text-sm text-gray-600">
                            Pengajuan dapat <b>ditolak</b> jika tidak memenuhi syarat atau data tidak valid.
                        </p>
                    </div>

                    <div class="flex items-start gap-3 bg-gray-50 border border-gray-200 p-3 rounded-xl">
                        <i data-lucide="shield-off" class="text-red-500 w-5 h-5 mt-0.5 flex-shrink-0"></i>
                        <p class="text-sm text-gray-600">
                            Hak sebagai Organiser dapat <b>dicabut</b> jika melanggar kebijakan platform.
                        </p>
                    </div>
                </div>

                @if($application)
                    <div class="border-t border-gray-200 my-4"></div>

                    <div class="p-6 bg-blue-50 border border-blue-200 rounded-2xl text-center space-y-4">
                        <div class="bg-blue-100 w-12 h-12 rounded-full flex items-center justify-center mx-auto text-blue-600">
                            <i data-lucide="clock" class="w-6 h-6"></i>
                        </div>
                        <div class="space-y-1">
                            <h3 class="text-base font-semibold text-gray-900">Pengajuan Berhasil Dikirim!</h3>
                            <p class="text-xs text-gray-500 leading-relaxed">
                                Pengajuanmu sebagai <span class="text-blue-600 font-medium">Panitia (Organiser)</span> telah masuk ke sistem. Silakan menunggu Admin memvalidasi data kamu.
                            </p>
                        </div>
                        <div class="pt-2">
                            <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-semibold bg-amber-50 text-amber-600 border border-amber-200">
                                <span class="w-1.5 h-1.5 rounded-full bg-amber-500 animate-pulse"></span>
                                Status: Menunggu Validasi
                            </span>
                        </div>
                    </div>
                @else
                    <form action="{{ route('role.apply') }}" method="POST" class="space-y-6">
                        @csrf

                        <div class="border-t border-gray-200 my-4"></div>

                        <div class="space-y-2">
                            <label for="ukm_id" class="text-xs font-bold uppercase tracking-wider text-gray-500 block">Asal Organisasi / UKM</label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none text-gray-400">
                                    <i data-lucide="users" class="w-5 h-5"></i>
                                </div>
                                <select name="ukm_id" id="ukm_id" required class="w-full bg-white border @error('ukm_id') border-red-500 @else border-gray-200 @enderror rounded-xl pl-10 pr-4 py-3 text-sm text-gray-900 focus:outline-none focus:border-blue-500 appearance-none cursor-pointer">
                                    <option value="" disabled selected hidden>Pilih UKM Politeknik Negeri Batam</option>
                                    @foreach($ukms as $ukm)
                                        <option value="{{ $ukm->id }}" {{ old('ukm_id') == $ukm->id ? 'selected' : '' }}>{{ $ukm->nama_ukm }}</option>
                                    @endforeach
                                </select>
                                <div class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none text-gray-400">
                                    <i data-lucide="chevron-down" class="w-4 h-4"></i>
                                </div>
                            </div>
                            @error('ukm_id')
                                <p class="text-red-600 text-xs mt-1 font-medium flex items-center gap-1"><i data-lucide="alert-circle" class="w-3.5 h-3.5"></i> {{ $message }}</p>
                            @enderror
                        </div>

                        <div class="space-y-2">
                            <label for="nomor_rekening" class="text-xs font-bold uppercase tracking-wider text-gray-500 block">Nomor Rekening</label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none text-gray-400">
                                    <i data-lucide="credit-card" class="w-5 h-5"></i>
                                </div>
                                <input type="text" inputmode="numeric" pattern="[0-9]*" name="nomor_rekening" id="nomor_rekening" value="{{ old('nomor_rekening') }}" placeholder="Masukkan nomor rekening aktif" required class="w-full bg-white border @error('nomor_rekening') border-red-500 @else border-gray-200 @enderror rounded-xl pl-10 pr-4 py-3 text-sm text-gray-900 placeholder-gray-400 focus:outline-none focus:border-blue-500 transition">
                            </div>
                            <p class="text-[10px] text-gray-500 font-medium">Digunakan oleh pihak kampus untuk mencairkan hasil penjualan tiket event.</p>
                            @error('nomor_rekening')
                                <p class="text-red-600 text-xs mt-1 font-medium flex items-center gap-1"><i data-lucide="alert-circle" class="w-3.5 h-3.5"></i> {{ $message }}</p>
                            @enderror
                        </div>

                        <div class="border-t border-gray-200 my-4"></div>

                        <div class="flex items-start">
                            <input type="checkbox" id="agreeCheck" required class="mt-1 rounded border-gray-300 bg-white text-blue-600 focus:ring-blue-500 w-4 h-4 cursor-pointer">
                            <label for="agreeCheck" class="ml-3 text-sm text-gray-600 cursor-pointer select-none leading-relaxed">
                                Saya menyetujui seluruh aturan dan siap bertanggung jawab sebagai Organiser di Ticketify.
                            </label>
                        </div>

                        <div class="flex space-x-3 pt-2">
                            <a href="{{ route('pembeli.event') }}" class="w-1/2 text-center border border-gray-200 hover:bg-gray-50 text-gray-700 font-medium px-4 py-2.5 rounded-xl transition text-sm flex items-center justify-center">
                                Batal
                            </a>

                            <button type="submit" id="submitBtn" class="w-1/2 bg-blue-600 text-white font-medium px-4 py-2.5 rounded-xl transition text-sm opacity-50 cursor-not-allowed">
                                Kirim Pengajuan
                            </button>
                        </div>
                    </form>
                @endif

            </div>
        </main>
    </div>

    <script>
        lucide.createIcons();

        const checkbox = document.getElementById('agreeCheck');
        const button = document.getElementById('submitBtn');

        if (checkbox && button) {
            checkbox.addEventListener('change', () => {
                if (checkbox.checked) {
                    button.classList.remove('opacity-50', 'cursor-not-allowed');
                    button.classList.add('hover:bg-blue-700', 'active:scale-[0.98]');
                } else {
                    button.classList.add('opacity-50', 'cursor-not-allowed');
                    button.classList.remove('hover:bg-blue-700', 'active:scale-[0.98]');
                }
            });

            button.addEventListener('click', (e) => {
                if (!checkbox.checked) {
                    e.preventDefault();
                    alert("Kamu harus menyetujui aturan terlebih dahulu.");
                }
            });
        }
    </script>

    @if(session('success'))
        <script>alert("{{ session('success') }}");</script>
    @endif

    @if(session('error'))
        <script>alert("{{ session('error') }}");</script>
    @endif

</body>
</html>

<script>
    // Inisialisasi Lucide Icons
    lucide.createIcons();

    // Jalankan skrip interaksi tombol hanya jika form render di halaman
    const checkbox = document.getElementById('agreeCheck');
    const button = document.getElementById('submitBtn');

    if (checkbox && button) {
        checkbox.addEventListener('change', () => {
            if (checkbox.checked) {
                button.classList.remove('opacity-50', 'cursor-not-allowed');
                button.classList.add('hover:bg-blue-700', 'active:scale-[0.98]');
            } else {
                button.classList.add('opacity-50', 'cursor-not-allowed');
                button.classList.remove('hover:bg-blue-700', 'active:scale-[0.98]');
            }
        });

        button.addEventListener('click', (e) => {
            if (!checkbox.checked) {
                e.preventDefault();
                alert("Kamu harus menyetujui aturan terlebih dahulu.");
            }
        });
    }
</script>

@if(session('success'))
    <script>
        alert("{{ session('success') }}");
    </script>
@endif

@if(session('error'))
    <script>
        alert("{{ session('error') }}");
    </script>
@endif
