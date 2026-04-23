<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ticketify | Discover Events</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;600;800&display=swap');
        body { font-family: 'Plus Jakarta Sans', sans-serif; }
        .glass { background: rgba(18, 18, 18, 0.8); backdrop-filter: blur(10px); }
        .spotify-shadow { transition: all 0.3s ease; }
        .spotify-shadow:hover { box-shadow: 0 20px 25px -5px rgba(34, 197, 94, 0.2); }

        ::-webkit-scrollbar { width: 6px; }
        ::-webkit-scrollbar-track { background: #0f0f0f; }
        ::-webkit-scrollbar-thumb { background: #333; border-radius: 10px; }

        /* Custom Swiper Pagination */
        .swiper-pagination-bullet { background: #fff; opacity: 0.5; }
        .swiper-pagination-bullet-active { background: #3b82f6; opacity: 1; width: 20px; border-radius: 5px; transition: all 0.3s; }
    </style>
</head>
<body class="bg-[#0f0f0f] text-white antialiased">

    <div class="flex max-w-[1600px] mx-auto min-h-screen border-x border-gray-800 bg-[#121212] shadow-2xl">

       <aside class="w-64 hidden lg:flex flex-col sticky top-0 h-screen border-r border-white/5 p-6 space-y-8 bg-[#09090b]">
    <div class="flex items-center gap-2 mb-4">
        <div class="w-8 h-8 bg-blue-500 rounded-lg flex items-center justify-center font-bold text-white shadow-[0_0_15px_rgba(59,130,246,0.5)]">T</div>
        <span class="font-extrabold text-xl tracking-tight uppercase">Ticketify</span>
    </div>


    <div class="space-y-6">
        <div>
            <p class="text-[10px] font-black text-gray-500 uppercase tracking-widest mb-4 border-b border-white/5 pb-2">Organizer Menu</p>
            <nav class="space-y-1">
                <a href="#" class="flex items-center gap-3 p-3 bg-blue-500 rounded-xl font-bold text-sm transition text-white shadow-lg shadow-blue-500/20">
                    <i class="fa-solid fa-house"></i> Event
                </a>

                <a href="{{ route('panitia.create') }}" class="flex items-center gap-3 p-3 hover:bg-white/5 rounded-xl text-sm text-gray-400 hover:text-white transition">
                    <i class="fa-solid fa-calendar-plus"></i> Create Event
                </a>

                <a href="{{ route('panitia.myevent') }}" class="flex items-center gap-3 p-3 hover:bg-white/5 rounded-xl text-sm text-gray-400 hover:text-white transition">
                    <i class="fa-solid fa-layer-group"></i> My Event
                </a>

                <a href="{{ route('panitia.attendance') }}" class="flex items-center gap-3 p-3 hover:bg-white/5 rounded-xl text-[13px] text-gray-400 hover:text-white transition">
                    <i class="fa-solid fa-qrcode"></i> Attendance Verification
                </a>

                <a href="{{ route('panitia.statistic') }}" class="flex items-center gap-3 p-3 hover:bg-white/5 rounded-xl text-sm text-gray-400 hover:text-white transition">
                    <i class="fa-solid fa-chart-line"></i> Statistik
                </a>
            </nav>
        </div>

        <div>
            <p class="text-[10px] font-black text-gray-500 uppercase tracking-widest mb-4 border-b border-white/5 pb-2">Lainnya</p>
            <nav class="space-y-1">
                <a href="#" class="flex items-center gap-3 p-3 hover:bg-white/5 rounded-xl text-sm text-gray-400 hover:text-white transition">
                    <i class="fa-solid fa-gear"></i> Settings
                </a>
                <a href="#" class="flex items-center gap-3 p-3 hover:bg-white/5 rounded-xl text-sm text-red-400 transition mt-4">
                    <i class="fa-solid fa-power-off"></i> Logout
                </a>
            </nav>
        </div>
    </div>

    <div class="mt-auto pt-6 border-t border-white/5">
        <div class="flex items-center gap-3">
            <div class="w-8 h-8 rounded-full bg-green-600 flex items-center justify-center font-bold text-xs">AM</div>
            <div class="overflow-hidden">
                <p class="text-xs font-bold text-white truncate">Ari Maverick</p>
                <p class="text-[10px] text-green-500 font-bold uppercase tracking-wider">Organizer</p>
            </div>
        </div>
    </div>
</aside>

        <!-- ini bagian navbar -->
        <div class="flex-1 flex flex-col min-w-0 border-r border-white/5">
            <nav class="sticky top-0 z-50 glass border-b border-white/5 px-8 py-4 flex justify-between items-center">
                <div class="hidden lg:block">
                    <span class="text-sm text-gray-400 font-medium italic"> Welcome To Ticketify! Discover something new today.</span>
            </nav>

            <!-- ini bagian poster slider -->
            <!-- Poster 1 -->
            <header class="p-8">
                <div class="swiper myHeroSwiper rounded-3xl overflow-hidden shadow-2xl">
                    <div class="swiper-wrapper">
                        <div class="swiper-slide relative h-[350px] group">
                            <div class="absolute inset-0 bg-gradient-to-t from-black via-transparent to-transparent z-10"></div>
                            <img src="{{ asset('images/kmipn.jpeg') }}" class="absolute inset-0 w-full h-full object-cover opacity-60 group-hover:scale-105 transition-transform duration-700" alt="Hero">
                            <div class="absolute inset-0 flex flex-col items-start justify-end p-8 z-20">
                                <h2 class="text-4xl font-extrabold mb-2 leading-tight italic tracking-tighter">Seminar KMIPN 2026</h2>
                                <p class="text-blue-100 max-w-lg mb-6 text-sm">Sharing bersama para juara nasional untuk persiapan kompetisi informatika terbesar.</p>
                            </div>
                        </div>
            <!-- Poster 2 -->
                        <div class="swiper-slide relative h-[350px] group">
                            <div class="absolute inset-0 bg-gradient-to-t from-black via-transparent to-transparent z-10"></div>
                            <img src="{{ asset('images/festival musik.jpg') }}" class="absolute inset-0 w-full h-full object-cover opacity-60 group-hover:scale-105 transition-transform duration-700" alt="Tech">
                            <div class="absolute inset-0 flex flex-col items-start justify-end p-8 z-20">
                                <h2 class="text-4xl font-extrabold mb-2 leading-tight italic tracking-tighter">Pergelaran Vokasi 2026</h2>
                                <p class="text-purple-100 max-w-lg mb-6 text-sm">Semarakkan perayaan vokasi tahun ini!</p>
                            </div>
                        </div>
            <!-- Poster 3 -->
                        <div class="swiper-slide relative h-[350px] group">
                            <div class="absolute inset-0 bg-gradient-to-t from-black via-transparent to-transparent z-10"></div>
                            <img src="{{ asset('images/robotika1.jpg') }}" class="absolute inset-0 w-full h-full object-cover opacity-60 group-hover:scale-105 transition-transform duration-700" alt="Tech">
                            <div class="absolute inset-0 flex flex-col items-start justify-end p-8 z-20">
                                <h2 class="text-4xl font-extrabold mb-2 leading-tight italic tracking-tighter">AI & Future Tech</h2>
                                <p class="text-green-100 max-w-lg mb-6 text-sm">Jelajahi masa depan teknologi bersama para ahli di bidangnya.</p>
                            </div>
                        </div>
            <!-- Poster 4 -->
                        <div class="swiper-slide relative h-[350px] group">
                            <div class="absolute inset-0 bg-gradient-to-t from-black via-transparent to-transparent z-10"></div>
                            <img src="{{ asset('images/seni.jpg') }}" class="absolute inset-0 w-full h-full object-cover opacity-60 group-hover:scale-105 transition-transform duration-700" alt="Tech">
                            <div class="absolute inset-0 flex flex-col items-start justify-end p-8 z-20">
                                <h2 class="text-4xl font-extrabold mb-2 leading-tight italic tracking-tighter">Inovasi Teknologi 2026</h2>
                                <p class="text-yellow-100 max-w-lg mb-6 text-sm">Temukan inovasi terbaru di dunia teknologi.</p>
                            </div>
                        </div>
            <!-- Poster 5 -->
                        <div class="swiper-slide relative h-[350px] group">
                            <div class="absolute inset-0 bg-gradient-to-t from-black via-transparent to-transparent z-10"></div>
                            <img src="{{ asset('images/pec.jpg') }}" class="absolute inset-0 w-full h-full object-cover opacity-60 group-hover:scale-105 transition-transform duration-700" alt="Tech">
                            <div class="absolute inset-0 flex flex-col items-start justify-end p-8 z-20">
                                <h2 class="text-4xl font-extrabold mb-2 leading-tight italic tracking-tighter">Pergelaran Vokasi 2026</h2>
                                <p class="text-purple-100 max-w-lg mb-6 text-sm">Semarakkan perayaan vokasi tahun ini!</p>
                            </div>
                        </div>
            <!-- Poster 6 -->
                        <div class="swiper-slide relative h-[350px] group">
                            <div class="absolute inset-0 bg-gradient-to-t from-black via-transparent to-transparent z-10"></div>
                            <img src="{{ asset('images/bisnis.jpg') }}" class="absolute inset-0 w-full h-full object-cover opacity-60 group-hover:scale-105 transition-transform duration-700" alt="Tech">
                            <div class="absolute inset-0 flex flex-col items-start justify-end p-8 z-20">
                                <h2 class="text-4xl font-extrabold mb-2 leading-tight italic tracking-tighter">AI & Future Tech</h2>
                                <p class="text-green-100 max-w-lg mb-6 text-sm">Jelajahi masa depan teknologi bersama para ahli di bidangnya.</p>
                            </div>
                        </div>

                    </div>
                    <div class="swiper-pagination"></div>
                </div>
            </header>

            <!-- ini bagian search bar -->
           <div class="px-8 -mt-10 relative z-30">
    <div class="bg-[#1e1e1e] border border-white/10 rounded-2xl p-4 shadow-2xl flex flex-wrap lg:flex-nowrap items-end gap-4">

        <div class="flex-[2] min-w-[200px]">
            <label class="text-[9px] font-black text-gray-500 uppercase tracking-widest mb-2 block ml-1">Search Event Name</label>
            <div class="flex items-center gap-3 bg-white/5 rounded-xl px-4 py-3 border border-transparent focus-within:border-blue-500 transition">
                <i class="fa-solid fa-magnifying-glass text-blue-500"></i>
                <input type="text" placeholder="Seminar, workshop, konser..." class="bg-transparent w-full outline-none text-sm text-gray-200">
            </div>
        </div>

        <div class="flex-1 min-w-[150px]">
            <label class="text-[9px] font-black text-gray-500 uppercase tracking-widest mb-2 block ml-1">Category</label>
            <div class="relative group">
                <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                    <i class="fa-solid fa-tags text-blue-500 text-[12px]"></i>
                </div>
                <select class="w-full bg-white/5 border border-transparent rounded-xl py-3 pl-10 pr-8 text-xs font-bold text-gray-300 focus:border-blue-500 outline-none transition-all appearance-none cursor-pointer">
                    <option value="" class="bg-[#1e1e1e]">Semua</option>
                    <option value="edu" class="bg-[#1e1e1e]">Education</option>
                    <option value="music" class="bg-[#1e1e1e]">Music</option>
                    <option value="tech" class="bg-[#1e1e1e]">Technology</option>
                    <option value="art" class="bg-[#1e1e1e]">Art & Theater</option>
                </select>
                <div class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none text-gray-500">
                    <i class="fa-solid fa-chevron-down text-[10px]"></i>
                </div>
            </div>
        </div>

        <div class="flex-1 min-w-[150px]">
            <label class="text-[9px] font-black text-gray-500 uppercase tracking-widest mb-2 block ml-1">Select Date</label>
            <div class="relative group">
                <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                    <i class="fa-solid fa-calendar-day text-blue-500 text-[12px]"></i>
                </div>
                <input type="date" class="w-full bg-white/5 border border-transparent rounded-xl py-3 pl-10 pr-4 text-xs font-bold text-gray-300 focus:border-blue-500 outline-none transition-all cursor-pointer [color-scheme:dark]">
            </div>
        </div>

        <button class="w-full lg:w-auto px-8 py-3.5 bg-white text-black rounded-xl font-bold hover:bg-blue-500 hover:text-white transition-all active:scale-95 shadow-lg">
            Cari Event
        </button>
    </div>
</div>

            <!-- ini Judul Bagian Event Terpopuler -->
            <main class="p-8">
                <div class="flex justify-between items-center mb-8">
                    <h2 class="text-2xl font-black italic tracking-tighter">Popular Event</h2>
                    <a href="#" class="text-sm text-blue-400 hover:underline">See All</a>
                </div>

                <!-- Event Cards 1 -->
                 <a href="{{ route('pembeli.detail') }}" class="cursor-pointer">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 pb-12">
                    <div class="group bg-[#1e1e1e] border border-white/5 rounded-2xl overflow-hidden hover:border-blue-500/50 transition-all duration-300 spotify-shadow">
                        <div class="relative h-44 overflow-hidden">
                            <img src="{{ asset('images/kmipn.jpeg') }}" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500" alt="Event">
                            <div class="absolute top-3 right-3 bg-black/60 backdrop-blur-md px-2 py-1 rounded-lg text-center border border-white/10">
                                <span class="block text-[10px] font-bold text-blue-400 uppercase leading-none">Apr</span>
                                <span class="block text-lg font-black leading-none">25</span>
                                <span class="text-[10px] font-black text-gray-400 leading-none">2026</span>
                            </div>
                        </div>
                        <div class="p-5">
                            <span class="text-[10px] font-bold text-blue-500 uppercase tracking-widest">Education</span>
                            <h3 class="font-bold text-lg mt-1 mb-3 line-clamp-1 group-hover:text-blue-400 transition-colors">Event Seminar KMIPN 2026</h3>
                            <div class="space-y-2 mb-6 text-xs text-gray-400"><div class="flex items-center gap-2"><i class="fa-solid fa-location-dot w-4"></i> Polibatam, Gedung Utama</div><div class="flex items-center gap-2"><i class="fa-solid fa-clock w-4"></i> 13:00 WIB</div></div>
                            <div class="flex items-center justify-between pt-4 border-t border-white/5"><div class="text-sm font-black">IDR 45.000</div><button class="px-4 py-2 bg-white text-black text-xs font-black rounded-lg hover:bg-blue-500 hover:text-white transition-colors">Beli Tiket</button></div>
                        </div>
                    </div>
                    </a>

                    <!-- event 2 -->
                    <div class="group bg-[#1e1e1e] border border-white/5 rounded-2xl overflow-hidden hover:border-blue-500/50 transition-all duration-300 spotify-shadow">
                        <div class="relative h-44 overflow-hidden">
                            <img src="{{ asset('images/festival musik.jpg') }}" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500" alt="Event">
                            <div class="absolute top-3 right-3 bg-black/60 backdrop-blur-md px-2 py-1 rounded-lg text-center border border-white/10">
                                <span class="block text-[10px] font-bold text-blue-400 uppercase leading-none">Mei</span>
                                <span class="block text-lg font-black leading-none">05</span>
                                <span class="text-[10px] font-black text-gray-400 leading-none">2026</span>
                            </div>
                        </div>

                        <div class="p-5">
                            <span class="text-[10px] font-bold text-blue-500 uppercase tracking-widest">Music Event</span>
                            <h3 class="font-bold text-lg mt-1 mb-3 line-clamp-1 group-hover:text-blue-400 transition-colors">Pergelaran Vokasi 2026</h3>
                            <div class="space-y-2 mb-6 text-xs text-gray-400"><div class="flex items-center gap-2"><i class="fa-solid fa-location-dot w-4"></i> Depan Technopreneur</div><div class="flex items-center gap-2"><i class="fa-solid fa-clock w-4"></i> 09:00 WIB</div></div>
                            <div class="flex items-center justify-between pt-4 border-t border-white/5"><div class="text-sm font-black">IDR 25.000</div><button class="px-4 py-2 bg-white text-black text-xs font-black rounded-lg hover:bg-blue-500 hover:text-white transition-colors">Beli Tiket</button></div>
                        </div>
                    </div>

                    <!-- Event 3 -->
                    <div class="group bg-[#1e1e1e] border border-white/5 rounded-2xl overflow-hidden hover:border-blue-500/50 transition-all duration-300 spotify-shadow">
                        <div class="relative h-44 overflow-hidden">
                            <img src="{{ asset('images/robotika1.jpg') }}" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500" alt="Event">
                            <div class="absolute top-3 right-3 bg-black/60 backdrop-blur-md px-2 py-1 rounded-lg text-center border border-white/10">
                                <span class="block text-[10px] font-bold text-blue-400 uppercase leading-none">Mei</span>
                                <span class="block text-lg font-black leading-none">12</span>
                                <span class="text-[10px] font-black text-gray-400 leading-none">2026</span>
                            </div>
                        </div>
                        <div class="p-5">
                            <span class="text-[10px] font-bold text-blue-500 uppercase tracking-widest">Education</span>
                            <h3 class="font-bold text-lg mt-1 mb-3 line-clamp-1 group-hover:text-blue-400 transition-colors">Robotika oleh Barelang FC</h3>
                            <div class="space-y-2 mb-6 text-xs text-gray-400"><div class="flex items-center gap-2"><i class="fa-solid fa-location-dot w-4"></i> Auditorium Polibatam</div><div class="flex items-center gap-2"><i class="fa-solid fa-clock w-4"></i> 14:00 WIB</div></div>
                            <div class="flex items-center justify-between pt-4 border-t border-white/5"><div class="text-sm font-black">FREE</div><button class="px-4 py-2 bg-white text-black text-xs font-black rounded-lg hover:bg-blue-500 hover:text-white transition-colors">Daftar</button></div>
                        </div>
                    </div>

                    <!-- Event 4 -->
                    <div class="group bg-[#1e1e1e] border border-white/5 rounded-2xl overflow-hidden hover:border-blue-500/50 transition-all duration-300 spotify-shadow">
                        <div class="relative h-44 overflow-hidden">
                            <img src="{{ asset('images/seni.jpg') }}" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500" alt="Event">
                            <div class="absolute top-3 right-3 bg-black/60 backdrop-blur-md px-2 py-1 rounded-lg text-center border border-white/10">
                                <span class="block text-[10px] font-bold text-blue-400 uppercase leading-none">Jun</span>
                                <span class="block text-lg font-black leading-none">01</span>
                            </div>
                        </div>
                        <div class="p-5">
                            <span class="text-[10px] font-bold text-blue-500 uppercase tracking-widest">Teater</span>
                            <h3 class="font-bold text-lg mt-1 mb-3 line-clamp-1 group-hover:text-blue-400 transition-colors">Polibatam Night Festival</h3>
                            <div class="space-y-2 mb-6 text-xs text-gray-400"><div class="flex items-center gap-2"><i class="fa-solid fa-location-dot w-4"></i> Lapangan Parkir</div><div class="flex items-center gap-2"><i class="fa-solid fa-clock w-4"></i> 19:00 WIB</div></div>
                            <div class="flex items-center justify-between pt-4 border-t border-white/5"><div class="text-sm font-black">IDR 75.000</div><button class="px-4 py-2 bg-white text-black text-xs font-black rounded-lg hover:bg-blue-500 hover:text-white transition-colors">Beli Tiket</button></div>
                        </div>
                    </div>

                    <!-- Event 5 -->
                    <div class="group bg-[#1e1e1e] border border-white/5 rounded-2xl overflow-hidden hover:border-blue-500/50 transition-all duration-300 spotify-shadow">
                        <div class="relative h-44 overflow-hidden">
                            <img src="{{ asset('images/pec.jpg') }}" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500" alt="Event">
                            <div class="absolute top-3 right-3 bg-black/60 backdrop-blur-md px-2 py-1 rounded-lg text-center border border-white/10">
                                <span class="block text-[10px] font-bold text-blue-400 uppercase leading-none">Jun</span>
                                <span class="block text-lg font-black leading-none">10</span>
                            </div>
                        </div>
                        <div class="p-5">
                            <span class="text-[10px] font-bold text-blue-500 uppercase tracking-widest">WorkShop</span>
                            <h3 class="font-bold text-lg mt-1 mb-3 line-clamp-1 group-hover:text-blue-400 transition-colors">How to be confident speak english</h3>
                            <div class="space-y-2 mb-6 text-xs text-gray-400"><div class="flex items-center gap-2"><i class="fa-solid fa-location-dot w-4"></i> Technopreneur Lt.2 Sekupang</div><div class="flex items-center gap-2"><i class="fa-solid fa-clock w-4"></i> 10:00 WIB</div></div>
                            <div class="flex items-center justify-between pt-4 border-t border-white/5"><div class="text-sm font-black">IDR 15.000</div><button class="px-4 py-2 bg-white text-black text-xs font-black rounded-lg hover:bg-blue-500 hover:text-white transition-colors">Beli Tiket</button></div>
                        </div>
                    </div>

                    <!-- Event 6 -->
                    <div class="group bg-[#1e1e1e] border border-white/5 rounded-2xl overflow-hidden hover:border-blue-500/50 transition-all duration-300 spotify-shadow">
                        <div class="relative h-44 overflow-hidden">
                            <img src="{{ asset('images/bisnis.jpg') }}" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500" alt="Event">
                            <div class="absolute top-3 right-3 bg-black/60 backdrop-blur-md px-2 py-1 rounded-lg text-center border border-white/10">
                                <span class="block text-[10px] font-bold text-blue-400 uppercase leading-none">Jul</span>
                                <span class="block text-lg font-black leading-none">20</span>
                            </div>
                        </div>
                        <div class="p-5">
                            <span class="text-[10px] font-bold text-blue-500 uppercase tracking-widest">WorkShop</span>
                            <h3 class="font-bold text-lg mt-1 mb-3 line-clamp-1 group-hover:text-blue-400 transition-colors">How to Start Your Own Business</h3>
                            <div class="space-y-2 mb-6 text-xs text-gray-400"><div class="flex items-center gap-2"><i class="fa-solid fa-location-dot w-4"></i> Technopreneur Lt.3 Bt Aji</div><div class="flex items-center gap-2"><i class="fa-solid fa-clock w-4"></i> 13:00 WIB</div></div>
                            <div class="flex items-center justify-between pt-4 border-t border-white/5"><div class="text-sm font-black">IDR 20.000</div><button class="px-4 py-2 bg-white text-black text-xs font-black rounded-lg hover:bg-blue-500 hover:text-white transition-colors">Beli Tiket</button></div>
                        </div>
                    </div>
                </div>
            </main>

            <footer class="mt-auto bg-black/20 border-t border-white/5 p-8 text-center">
                <p class="text-[10px] font-bold text-gray-600 uppercase tracking-[0.3em]">&copy; 2026 Informatics Engineering - Polibatam</p>
            </footer>
        </div>

        <aside class="w-80 hidden xl:flex flex-col sticky top-0 h-screen p-8 space-y-8">
            <div>
                <div class="flex justify-between items-center mb-6">
                    <h2 class="text-xl font-black italic tracking-tighter text-white">Upcoming</h2>
                    <i class="fa-solid fa-calendar-check text-blue-500"></i>
                </div>
                <div class="space-y-4">
                    <div class="group p-4 bg-[#1e1e1e] border border-white/5 rounded-2xl hover:border-blue-500/30 transition-all cursor-pointer">
                        <div class="flex gap-4">
                            <div class="flex-shrink-0 w-12 h-12 bg-blue-500/10 rounded-xl flex flex-col items-center justify-center border border-blue-500/20">
                                <span class="text-[10px] font-bold text-blue-400 uppercase leading-none">Mei</span>
                                <span class="text-lg font-black text-white">02</span>
                            </div>
                            <div>
                                <h4 class="text-sm font-bold group-hover:text-blue-400 transition-colors">Workshop Laravel</h4>
                                <p class="text-[10px] text-gray-500 mt-1 uppercase">09:00 WIB</p>
                            </div>
                        </div>
                    </div>
                    <div class="mt-8 p-6 bg-gradient-to-br from-blue-600 to-blue-900 rounded-2xl shadow-xl relative overflow-hidden group">
                        <i class="fa-solid fa-ticket absolute -right-4 -bottom-4 text-white/10 text-8xl -rotate-12 group-hover:rotate-0 transition-all duration-500"></i>
                        <h4 class="font-black text-white mb-2 relative z-10">Buka Event?</h4>
                        <p class="text-xs text-blue-100 mb-4 relative z-10">Kelola tiket organisasimu di sini.</p>
                        <button class="w-full py-2 bg-white text-blue-600 text-[10px] font-black rounded-lg uppercase hover:bg-blue-50 relative z-10 transition-colors">Buat Sekarang</button>
                    </div>
                </div>
            </div>
        </aside>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
    <script>
        const swiper = new Swiper('.myHeroSwiper', {
            loop: true,
            autoplay: { delay: 5000, disableOnInteraction: false },
            pagination: { el: '.swiper-pagination', clickable: true },
            effect: 'fade',
            fadeEffect: { crossFade: true },
        });
    </script>
</body>
</html>
