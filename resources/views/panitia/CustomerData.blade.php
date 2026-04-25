<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ticketify - Customer Data</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body class="bg-[#09090b] text-white flex">
@include('layouts.sidebar-panitia')

    <main class="flex-1 p-10 overflow-y-auto">
        <header class="mb-10">
            <div class="flex items-center gap-2 text-xs text-gray-500 mb-4 font-bold  tracking-widest">
                <a href="{{ route('panitia.myevent') }}" class="hover:text-blue-500">My Events</a>
                <i class="fa-solid fa-chevron-right text-[8px]"></i>
                <span class="text-white">Attendee List</span>
            </div>
            <div class="flex justify-between items-end">
                <div>
                    <h1 class="text-3xl font-black tracking-tight">Seminar Nasional KMIPN VII</h1>
                    <p class="text-gray-500 text-sm mt-2 font-medium">Daftar lengkap peserta yang telah membeli tiket.</p>
                </div>
                <button class="bg-white/5 hover:bg-white/10 text-white px-6 py-3 rounded-xl text-xs font-black uppercase transition-all flex items-center gap-2 border border-white/5">
                    <i class="fa-solid fa-file-export text-blue-500"></i> Export Excel
                </button>
            </div>
        </header>

        <div class="bg-[#121212] p-4 rounded-2xl border border-white/5 mb-8 flex flex-col md:flex-row gap-4">
            <div class="relative flex-1">
                <i class="fa-solid fa-magnifying-glass absolute left-4 top-1/2 -translate-y-1/2 text-gray-600 text-xs"></i>
                <input type="text" placeholder="Cari Nama, Email, atau Code..." class="w-full bg-[#18181b] border border-white/5 rounded-xl pl-10 pr-4 py-3 text-xs focus:border-blue-500 outline-none transition-all">
            </div>
            <select class="bg-[#18181b] border border-white/5 rounded-xl px-4 py-3 text-[10px] font-black uppercase tracking-widest outline-none text-gray-400">
                <option>Semua Kategori</option>
                <option>VIP</option>
                <option>Reguler</option>
            </select>
        </div>

        <div class="bg-[#121212] rounded-[2.5rem] border border-white/5 overflow-hidden">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="border-b border-white/5 bg-white/[0.02]">
                        <th class="p-6 text-[10px] font-black text-gray-500 uppercase tracking-widest">No.</th>
                        <th class="p-6 text-[10px] font-black text-gray-500 uppercase tracking-widest">Peserta</th>
                        <th class="p-6 text-[10px] font-black text-gray-500 uppercase tracking-widest">Kontak</th>
                        <th class="p-6 text-[10px] font-black text-gray-500 uppercase tracking-widest">Kategori</th>
                        <th class="p-6 text-[10px] font-black text-gray-500 uppercase tracking-widest">Unique Code</th>
                        <th class="p-6 text-[10px] font-black text-gray-500 uppercase tracking-widest">Waktu Beli</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-white/5">
                    <tr class="hover:bg-white/[0.02] transition-colors group">
                        <td class="p-6 text-sm font-bold text-gray-600">01</td>
                        <td class="p-6">
                            <div class="flex items-center gap-3">
                                <div class="w-8 h-8 rounded-full bg-blue-600/20 text-blue-500 flex items-center justify-center font-bold text-[10px]">AM</div>
                                <div>
                                    <p class="text-sm font-black text-white">Ari Maverick</p>
                                    <p class="text-[11px] text-gray-500">ari.maverick@email.com</p>
                                </div>
                            </div>
                        </td>
                        <td class="p-6 text-xs text-gray-400 font-medium">0812-3456-7890</td>
                        <td class="p-6">
                            <span class="bg-purple-500/10 text-purple-500 px-3 py-1 rounded-lg text-[9px] font-black uppercase tracking-widest border border-purple-500/20">VIP</span>
                        </td>
                        <td class="p-6">
                            <code class="bg-[#18181b] px-3 py-1 rounded-md text-blue-400 font-mono text-xs border border-white/5 group-hover:border-blue-500/50">TKT-77291X</code>
                        </td>
                        <td class="p-6 text-[11px] text-gray-500">22 Apr 2026, 14:20</td>
                    </tr>

                    <tr class="hover:bg-white/[0.02] transition-colors group">
                        <td class="p-6 text-sm font-bold text-gray-600">02</td>
                        <td class="p-6">
                            <div class="flex items-center gap-3">
                                <div class="w-8 h-8 rounded-full bg-green-600/20 text-green-500 flex items-center justify-center font-bold text-[10px]">JD</div>
                                <div>
                                    <p class="text-sm font-black text-white">John Doe</p>
                                    <p class="text-[11px] text-gray-500">johndoe@email.com</p>
                                </div>
                            </div>
                        </td>
                        <td class="p-6 text-xs text-gray-400 font-medium">0857-9988-1122</td>
                        <td class="p-6">
                            <span class="bg-blue-500/10 text-blue-500 px-3 py-1 rounded-lg text-[9px] font-black uppercase tracking-widest border border-blue-500/20">Reguler</span>
                        </td>
                        <td class="p-6">
                            <code class="bg-[#18181b] px-3 py-1 rounded-md text-blue-400 font-mono text-xs border border-white/5 group-hover:border-blue-500/50">TKT-11029Z</code>
                        </td>
                        <td class="p-6 text-[11px] text-gray-500">22 Apr 2026, 15:05</td>
                    </tr>
                </tbody>
            </table>

            <div class="p-6 bg-white/[0.01] border-t border-white/5 flex justify-between items-center">
                <p class="text-[10px] font-black text-gray-600 uppercase tracking-widest">Showing 2 of 45 Attendees</p>
                <div class="flex gap-2">
                    <button class="w-8 h-8 flex items-center justify-center rounded-lg bg-white/5 text-gray-500 hover:text-white transition"><i class="fa-solid fa-chevron-left text-[10px]"></i></button>
                    <button class="w-8 h-8 flex items-center justify-center rounded-lg bg-blue-500 text-white font-bold text-xs shadow-lg shadow-blue-500/20">1</button>
                    <button class="w-8 h-8 flex items-center justify-center rounded-lg bg-white/5 text-gray-400 hover:text-white transition font-bold text-xs">2</button>
                    <button class="w-8 h-8 flex items-center justify-center rounded-lg bg-white/5 text-gray-500 hover:text-white transition"><i class="fa-solid fa-chevron-right text-[10px]"></i></button>
                </div>
            </div>
        </div>
    </main>

</body>
</html>
