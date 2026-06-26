<footer class="bg-white border-t border-gray-100">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12 lg:py-16">
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-5 gap-10 lg:gap-8">

            <div class="lg:col-span-1 space-y-5">
                <div class="flex items-center gap-2.5">
                    <div class="w-9 h-9 bg-gradient-to-br from-blue-600 to-cyan-500 rounded-xl flex items-center justify-center font-extrabold text-white text-sm shadow-lg shadow-blue-500/20">T</div>
                    <span class="font-extrabold text-xl tracking-tight bg-gradient-to-r from-blue-600 to-cyan-500 bg-clip-text text-transparent">Ticketify</span>
                </div>
                <p class="text-sm text-gray-500 leading-relaxed">
                    Platform tiket digital untuk seluruh kegiatan kemahasiswaan Politeknik Negeri Batam. Mudah, cepat, dan terpercaya.
                </p>
                <div class="flex items-center gap-2">
                    <img src="{{ asset('images/polibatam.png') }}" alt="Polibatam" class="h-14">
                </div>
            </div>

            <div>
                <h4 class="font-bold text-sm text-gray-900 mb-5">Tentang</h4>
                <ul class="space-y-3">
                    @foreach(['Tentang Kami', 'Cara Kerja', 'Blog', 'Karir'] as $link)
                        <li><a href="#" class="text-sm text-gray-500 hover:text-blue-600 transition-colors">{{ $link }}</a></li>
                    @endforeach
                </ul>
            </div>

            <div>
                <h4 class="font-bold text-sm text-gray-900 mb-5">Dukungan</h4>
                <ul class="space-y-3">
                    @foreach(['Pusat Bantuan', 'Syarat & Ketentuan', 'Kebijakan Privasi', 'Hubungi Kami'] as $link)
                        <li><a href="#" class="text-sm text-gray-500 hover:text-blue-600 transition-colors">{{ $link }}</a></li>
                    @endforeach
                </ul>
            </div>

            <div>
                <h4 class="font-bold text-sm text-gray-900 mb-5">Layanan</h4>
                <ul class="space-y-3">
                    @foreach(['Buat Event', 'Kelola Tiket', 'Check-in QR', 'Laporan'] as $link)
                        <li><a href="#" class="text-sm text-gray-500 hover:text-blue-600 transition-colors">{{ $link }}</a></li>
                    @endforeach
                </ul>
            </div>

            <div class="space-y-6">
                <div>
                    <h4 class="font-bold text-sm text-gray-900 mb-4">Pembayaran</h4>
                    <div class="flex items-center">
                        <img src="{{ asset('images/midtranss.jpg') }}" alt="Midtrans" class="h-17">
                    </div>
                </div>
                <div>
                    <h4 class="font-bold text-sm text-gray-900 mb-4">Ikuti Kami</h4>
                    <div class="flex gap-3">
                        <a href="#" class="w-9 h-9 bg-gray-100 hover:bg-blue-100 rounded-xl flex items-center justify-center text-gray-500 hover:text-blue-600 transition-all">
                            <i class="fa-brands fa-instagram"></i>
                        </a>
                        <a href="#" class="w-9 h-9 bg-gray-100 hover:bg-blue-100 rounded-xl flex items-center justify-center text-gray-500 hover:text-blue-600 transition-all">
                            <i class="fa-brands fa-tiktok"></i>
                        </a>
                        <a href="#" class="w-9 h-9 bg-gray-100 hover:bg-blue-100 rounded-xl flex items-center justify-center text-gray-500 hover:text-blue-600 transition-all">
                            <i class="fa-brands fa-youtube"></i>
                        </a>
                        <a href="#" class="w-9 h-9 bg-gray-100 hover:bg-blue-100 rounded-xl flex items-center justify-center text-gray-500 hover:text-blue-600 transition-all">
                            <i class="fa-regular fa-envelope"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <div class="mt-12 pt-6 border-t border-gray-100 flex flex-col md:flex-row items-center justify-between gap-4">
            <p class="text-xs text-gray-400">&copy; {{ date('Y') }} Ticketify. All rights reserved. Developed by Informatics Engineering — Politeknik Negeri Batam.</p>
        </div>
    </div>
</footer>
