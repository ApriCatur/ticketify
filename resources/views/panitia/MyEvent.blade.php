<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ticketify - My Events</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body class="bg-[#09090b] text-white flex">

    @include('layouts.sidebar-panitia')

    <main class="flex-1 p-10 overflow-y-auto">
        <header class="mb-10 flex flex-col md:flex-row justify-between items-start md:items-end gap-4">
            <div>
                <h1 class="text-3xl font-black tracking-tight">My Events</h1>
                <p class="text-gray-500 text-sm mt-2">Pantau status dan penjualan tiket event kamu di sini.</p>
            </div>

            <div class="flex gap-3 w-full md:w-auto">
                <div class="relative flex-1 md:flex-none">
                    <i class="fa-solid fa-magnifying-glass absolute left-4 top-1/2 -translate-y-1/2 text-gray-500 text-xs"></i>
                    <input type="text" placeholder="Cari event..." class="w-full md:w-64 bg-[#121212] border border-white/5 rounded-xl pl-10 pr-4 py-3 text-xs focus:border-blue-500 outline-none transition-all">
                </div>
                <select class="bg-[#121212] border border-white/5 rounded-xl px-4 py-3 text-[10px] font-black uppercase tracking-widest outline-none text-gray-400 focus:border-blue-500">
                    <option>Semua Status</option>
                    <option>Active</option>
                    <option>Pending</option>
                </select>
            </div>
        </header>

        <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-8">

                <div class="relative aspect-video overflow-hidden rounded-t-[2rem]">
                        <img src="{{ asset('images/kmipn.jpeg') }}"
                        alt="Poster KMIPN VII"
                        class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700">
                    <div class="absolute inset-0 bg-gradient-to-t from-[#121212]/50 to-transparent"></div>
                <div class="absolute top-4 right-4 bg-green-500/20 backdrop-blur-md border border-green-500/50 text-green-500 px-4 py-1.5 rounded-full text-[10px] font-black uppercase tracking-widest shadow-lg shadow-black/30">
                        Active
                </div>
            </div>

                <div class="p-8 space-y-6">
                    <div>
                        <h3 class="text-lg font-black text-white truncate mb-1">Seminar Nasional KMIPN VII</h3>
                        <p class="text-xs text-gray-500 flex items-center gap-2">
                            <i class="fa-solid fa-calendar-day text-blue-500"></i> 25 April 2026, 15:00 WIB
                        </p>
                    </div>

                    <div class="space-y-3">
                        <div class="flex justify-between items-end">
                            <span class="text-[10px] font-black text-gray-400 uppercase tracking-widest">Penjualan Tiket</span>
                            <span class="text-xs font-bold text-white">45 <span class="text-gray-500">/ 100</span></span>
                        </div>
                        <div class="w-full h-2 bg-white/5 rounded-full overflow-hidden">
                            <div class="h-full bg-blue-500 rounded-full shadow-[0_0_10px_rgba(59,130,246,0.5)]" style="width: 45%"></div>
                        </div>
                    </div>

                    <div class="pt-4 border-t border-white/5 flex gap-3">
                        <a href="{{ route('panitia.create') }}" class="flex-1 bg-white/5 hover:bg-white/10 text-white py-3 rounded-xl text-[10px] font-black uppercase transition-all flex items-center justify-center gap-2 border border-white/5">
                            <i class="fa-solid fa-pen-to-square"></i> Edit
                        </a>

                     <a href="{{ route('panitia.customerdata') }}"
                             class="w-12 h-12 bg-blue-600 hover:bg-blue-700 text-white rounded-xl flex items-center justify-center transition-all shadow-lg shadow-blue-600/20 active:scale-95">
                             <i class="fa-solid fa-table"></i>
                         </a>
                    </div>
                </div>
            </div>

            <a href="#" class="border-2 border-dashed border-white/5 rounded-[2.5rem] flex flex-col items-center justify-center gap-4 text-gray-600 hover:text-blue-500 hover:border-blue-500/50 hover:bg-blue-500/5 transition-all min-h-[350px] group">
                <div class="w-14 h-14 rounded-full bg-white/5 flex items-center justify-center group-hover:bg-blue-500 group-hover:text-white transition-all duration-500">
                    <i class="fa-solid fa-plus text-xl"></i>
                </div>
                <span class="font-black uppercase tracking-widest text-[10px]">Tambah Event Baru</span>
            </a>

        </div>
    </main>

</body>
</html>
