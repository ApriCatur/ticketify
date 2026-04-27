<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ticketify - Detail Event</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body class="bg-[#09090b] text-white p-6 md:p-10" x-data="{ tab: 'ticket' }">

     <div class="max-w-6xl mx-auto">
     <div class="max-w-6xl mx-auto">
    <div class="flex items-center gap-4 mb-8">
        <a href="{{ route('registrasi.event') }}" class="bg-[#18181b] hover:bg-white hover:text-black transition-all px-4 py-2 rounded-lg text-xs font-bold border border-white/5 flex items-center">
            <i class="fa-solid fa-arrow-left mr-2"></i> Back
        </a>
        <h1 class="text-2xl font-black tracking-tight italic uppercase">Event Seminar KMIPN VII</h1>
    </div>
</div>

        <div class="flex justify-center mb-8 border-b border-white/5">
            <div class="flex gap-8">
                <button @click="tab = 'ticket'" :class="tab === 'ticket' ? 'border-b-2 border-blue-500 text-blue-500' : 'text-gray-500'" class="pb-4 px-4 font-bold text-sm transition-all flex items-center gap-2">
                    <i class="fa-solid fa-ticket"></i> Ticket
                </button>
                <button @click="tab = 'details'" :class="tab === 'details' ? 'border-b-2 border-blue-500 text-blue-500' : 'text-gray-500'" class="pb-4 px-4 font-bold text-sm transition-all flex items-center gap-2">
                    <i class="fa-solid fa-circle-info"></i> Details
                </button>
                <button @click="tab = 'organiser'" :class="tab === 'organiser' ? 'border-b-2 border-blue-500 text-blue-500' : 'text-gray-500'" class="pb-4 px-4 font-bold text-sm transition-all flex items-center gap-2">
                    <i class="fa-solid fa-users"></i> Organiser
                </button>
            </div>
        </div>

        <div class="bg-[#121212] rounded-3xl p-8 border border-white/5 shadow-2xl">

            <div x-show="tab === 'ticket'" x-transition>
                <div class="grid md:grid-cols-2 gap-10 mb-10 pb-10 border-b border-white/5">
                    <div class="rounded-2xl overflow-hidden border border-white/10 shadow-lg">
                        <img src="{{ asset('images/kmipn.jpeg') }}" class="w-full h-full object-cover">
                    </div>
                    <div class="space-y-6">
                        <div class="bg-[#18181b] p-4 rounded-xl border border-white/5 flex items-center gap-4">
                            <i class="fa-solid fa-qrcode text-blue-500"></i>
                            <span class="text-sm font-bold">Our Social Media Event</span>
                        </div>
                        <div class="bg-[#18181b] p-5 rounded-2xl border border-white/5">
                            <h4 class="text-blue-500 font-bold text-sm mb-2"><i class="fa-solid fa-location-dot text-red-500 mr-2"></i>Location</h4>
                            <p class="text-xs text-gray-300 font-bold leading-relaxed">Politeknik Negeri Batam, Technopreneur Pintu Sekupang, Lt 2</p>
                            <p class="text-[10px] text-gray-500 mt-1">Jl. Ahmad Yani, Batam Kota, Batam, Riau Islands 29461</p>
                        </div>
                        <div class="text-sm font-bold text-gray-400">
                            <i class="fa-solid fa-calendar-days text-blue-500 mr-2"></i> 25 April 2026, 15:00 WIB
                        </div>
                        <div class="text-[15px] text-gray-500 space-y-1">
                            <p>#Sharingandnetworking event</p>
                            <p>#SeminarNasionalKMIPN VII</p>
                            <p>#PoliteknikNegeriBatam</p>
                        </div>
                    </div>
                </div>

                <div class="text-center mb-8">
                    <h2 class="text-lg font-bold">Ticket Information</h2>
                    <span class="inline-block mt-2 px-4 py-1 bg-[#18181b] rounded-full text-[10px] border border-white/5 font-bold">
                        <i class="fa-solid fa-calendar-check mr-2"></i> Event Date : 25 April 2026, 15:00 WIB
                    </span>
                </div>

                <div class="space-y-4 max-w-4xl mx-auto">
                    <div class="bg-[#18181b] p-6 rounded-2xl border border-white/5 flex items-center justify-between">
                        <div>
                            <h3 class="font-bold"><i class="fa-solid fa-ticket text-blue-500 mr-2"></i>Reguler Ticket</h3>
                            <p class="text-[10px] text-gray-500 ml-6">Event Entry</p>
                        </div>
                        <div class="flex items-center gap-6">
                            <div class="text-right">
                                <span class="text-[10px] text-gray-600 block">Stok: 100</span>
                                <span class="font-black text-blue-400">IDR 20.000</span>
                            </div>
                            <div class="flex items-center gap-3 bg-[#09090b] px-3 py-1 rounded-lg border border-white/10 font-bold">
                                <button class="text-gray-500 hover:text-white">-</button>
                                <span class="text-sm">0</span>
                                <button class="text-gray-500 hover:text-white">+</button>
                            </div>
                        </div>
                    </div>

                    <div class="bg-[#18181b] p-6 rounded-2xl border border-white/5 flex items-center justify-between border-l-4 border-l-yellow-600">
                        <div>
                            <h3 class="font-bold text-yellow-600"><i class="fa-solid fa-crown mr-2"></i>VIP Ticket (Gold)</h3>
                            <p class="text-[10px] text-gray-500 ml-6">Exclusive Front Row + F&B</p>
                        </div>
                        <div class="flex items-center gap-6">
                            <div class="text-right">
                                <span class="text-[10px] text-gray-600 block">Stok: 100</span>
                                <span class="font-black text-blue-400">IDR 50.000</span>
                            </div>
                            <div class="flex items-center gap-3 bg-[#09090b] px-3 py-1 rounded-lg border border-white/10 font-bold">
                                <button class="text-gray-500 hover:text-white">-</button>
                                <span class="text-sm">0</span>
                                <button class="text-gray-500 hover:text-white">+</button>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="mt-10 text-center">
                    <button class="w-full md:w-auto px-16 py-4 bg-white text-black font-black rounded-full hover:bg-blue-600 hover:text-white transition-all shadow-xl">
                        Buy Ticket Now
                    </button>
                </div>
            </div>

            <div x-show="tab === 'details'" x-transition style="display: none;">
                <div class="bg-[#18181b] p-8 rounded-3xl border border-white/5 mb-8">
                    <p class="text-sm text-gray-300 leading-relaxed text-justify">
                         Seminar Nasional KMIPN VII (Kompetisi Mahasiswa Informatika Politeknik Nasional
                                    ke-7)
                                    merupakan sebuah forum intelektual strategis yang diselenggarakan sebagai rangkaian
                                    utama dari ajang kompetisi informatika terbesar bagi mahasiswa vokasi di Indonesia,
                                    di
                                    mana acara ini bertujuan untuk mengintegrasikan visi akademis dengan kebutuhan riil
                                    industri teknologi masa kini.

                                    Melalui kehadiran para pakar teknologi, praktisi dari perusahaan multinasional,
                                    serta
                                    birokrat pendidikan, seminar ini mengupas tuntas tantangan global seperti
                                    pemanfaatan
                                    Artificial Intelligence, keamanan siber, dan pengembangan ekosistem digital
                                    berkelanjutan guna membekali para peserta dengan wawasan yang melampaui kurikulum
                                    kelas.

                                    Selain menjadi wadah pertukaran ide yang inspiratif, seminar ini juga berfungsi
                                    sebagai
                                    katalisator bagi mahasiswa untuk memperluas jaringan profesional mereka,
                                    menyelaraskan
                                    inovasi hasil kompetisi dengan standar industri, serta memperkuat posisi Politeknik
                                    sebagai institusi pencetak sumber daya manusia unggul yang siap memimpin
                                    transformasi
                                    digital di era kedaulatan teknologi nasional.
                    </p>
                </div>

                <div class="bg-[#18181b] p-8 rounded-3xl border border-white/5 mb-8">
                    <h3 class="text-center font-bold text-blue-500 mb-6"><i class="fa-solid fa-location-dot text-red-500 mr-2"></i>Location</h3>
                    <div class="h-64 bg-[#09090b] rounded-2xl border border-white/10 mb-4 overflow-hidden">
                         <iframe class="w-full h-full grayscale invert opacity-70" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3989.0579344403!2d104.0458603!3d1.1187428!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x31d98921856cc357%3A0x75d691ad266946f7!2sPoliteknik%20Negeri%20Batam!5e0!3m2!1sid!2sid!4v1713500000000!5m2!1sid!2sid" loading="diligent"></iframe>
                    </div>
                    <div class="text-center">
                        <p class="font-bold text-sm">Politeknik Negeri Batam, Technopreneur Pintu Sekupang, Lt 2</p>
                        <p class="text-[10px] text-gray-500 uppercase mt-1">Jl. Ahmad Yani, Teluk Tering, Batam Kota, Batam, Riau Islands 29461</p>
                    </div>
                </div>

                <div class="bg-[#18181b] p-8 rounded-3xl border border-white/5">
                    <h3 class="text-center font-bold text-blue-500 mb-8"><i class="fa-solid fa-file-lines mr-2"></i>Terms and Conditions</h3>
                    <div class="grid md:grid-cols-2 gap-10 text-xs">
                        <div class="space-y-6">
                            <div>
                                <h4 class="font-bold mb-3 text-white">1. Ketentuan Umum Peserta</h4>
                                <ul class="list-disc list-inside text-gray-400 space-y-2">
                                    <li>Status Mahasiswa: Peserta wajib mahasiswa/i aktif Politeknik NegeriBatam.</li>
                                    <li>Pendaftaran: Wajib mendaftarkan diri melalui tautan resmi sebelum batas waktu.</li>
                                    <li>Kuota: Pendaftaran akan ditutup otomatis jika kuota peserta telah terpenuhi. </li>
                                </ul>
                            </div>
                        </div>

                        <div class="space-y-6">
                            <div>
                                <h4 class="font-bold mb-3 text-white">2. Administrasi dan Kehadiran</h4>
                                <ul class="list-disc list-inside text-gray-400 space-y-2">
                                    <li>Identitas: Peserta wajib membawa KTM atau menunjukkan KRS aktif.</li>
                                    <li>Waktu Kedatangan: Peserta diharapkan hadir di lokasi 15-30 menit sebelum acara.</li>
                                    <li>Dress Code: Menggunakan pakaian bebas pantas, rapi, dan menggunakan almamater.</li>
                                </ul>
                            </div>
                        </div>

                        <div class="space-y-6">
                            <div>
                                <h4 class="font-bold mb-3 text-white">3. Hak Peserta</h4>
                                <ul class="list-disc list-inside text-gray-400 space-y-2">
                                    <li>E-Sertifikat diberikan kepada peserta yang mengisi daftar hadir dan evaluasi.</li>
                                    <li>Materi Seminar: Peserta berhak mendapatkan soft-copy materi.</li>
                                    <li>Konsumsi: (Opsional) Snack/makan siang hanya disediakan bagi peserta terdaftar.</li>
                                </ul>
                            </div>
                        </div>

                        <div class="space-y-6">
                            <div>
                                <h4 class="font-bold mb-3 text-white">4. Hak Peserta</h4>
                                <ul class="list-disc list-inside text-gray-400 space-y-2">
                                    <li>Keputusan Panitia: Keputusan panitia terkait kepesertaan bersifat mutlak.</li>
                                    <li>Kebersihan: Dilarang meninggalkan sampah di area kursi atau dalam ruangan.</li>
                                </ul>
                            </div>
                        </div>

                    </div>
                </div>
            </div>

            <div x-show="tab === 'organiser'" x-transition style="display: none;">
                <div class="bg-[#18181b] p-10 rounded-3xl border border-white/5 text-center mb-8">
                    <i class="fa-solid fa-users text-blue-500 text-3xl mb-6"></i>
                    <p class="max-w-2xl mx-auto text-sm text-gray-400 leading-relaxed italic">
                        HMTI, atau Himpunan Mahasiswa Teknik Informatika, berperan sebagai wadah utama bagi
                                    mahasiswa untuk mengembangkan potensi diri di luar kegiatan akademik formal.
                                    Organisasi
                                    ini berfungsi sebagai jembatan antara aspirasi mahasiswa dengan pihak program studi,
                                    sekaligus menjadi motor penggerak kreativitas di lingkungan kampus.
                    </p>
                </div>
                <div class="bg-[#18181b] p-8 rounded-3xl border border-white/5 text-center">
                    <h3 class="font-bold mb-6 text-white uppercase tracking-widest text-sm">Organizing Committee</h3>
                    <div class="rounded-2xl overflow-hidden border border-white/10 mb-4">
                        <img src="{{ asset('images/panitia_kmipn.jpeg') }}" class="w-full transition-all">
                    </div>
                    <p class="text-[10px] text-gray-600 font-bold italic">This is a photo of the KMIPN Organizing Committee</p>
                </div>
            </div>

        </div>
    </div>

</body>
</html>
