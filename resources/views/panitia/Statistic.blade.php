<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ticketify - Statistik Event</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body class="bg-[#09090b] text-white flex">

    <aside class="w-64 hidden lg:flex flex-col sticky top-0 h-screen border-r border-white/5 p-6 space-y-8 bg-[#09090b]">
        <div class="flex items-center gap-2 mb-4">
            <div class="w-8 h-8 bg-blue-500 rounded-lg flex items-center justify-center font-bold text-white shadow-[0_0_15px_rgba(59,130,246,0.5)]">T</div>
            <span class="font-extrabold text-xl tracking-tight uppercase">Ticketify</span>
        </div>

        <div class="space-y-6">
            <div>
                <p class="text-[10px] font-black text-gray-500 uppercase tracking-widest mb-4 border-b border-white/5 pb-2">Organizer Menu</p>
                <nav class="space-y-1">
                    <a href="{{ route('panitia.event') }}" class="flex items-center gap-3 p-3 hover:bg-white/5 rounded-xl text-sm text-gray-400 hover:text-white transition">
                        <i class="fa-solid fa-house"></i> Event
                    </a>
                    <a href="{{ route('panitia.create') }}" class="flex items-center gap-3 p-3 hover:bg-white/5 rounded-xl text-sm text-gray-400 hover:text-white transition">
                        <i class="fa-solid fa-calendar-plus"></i> Create Event
                    </a>
                    <a href="{{ route('panitia.myevent') }}" class="flex items-center gap-3 p-3 hover:bg-white/5 rounded-xl font-bold text-sm transition  hover:text-white transition">
                        <i class="fa-solid fa-layer-group"></i> My Event
                    </a>
                    <a href="{{ route('panitia.attendance') }}" class="flex items-center gap-3 p-3 hover:bg-white/5 rounded-xl text-[13px] text-gray-400 hover:text-white transition">
                        <i class="fa-solid fa-qrcode"></i> Attendance Verification
                    </a>
                    <a href="{{ route('panitia.statistic') }}" class="flex items-center gap-3 p-3 bg-blue-500 rounded-xl font-bold text-sm transition text-white shadow-lg shadow-blue-500/20">
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
                <div class="w-8 h-8 rounded-full bg-blue-600 flex items-center justify-center font-bold text-xs">AM</div>
                <div class="overflow-hidden">
                    <p class="text-xs font-bold text-white truncate">Ari Maverick</p>
                    <p class="text-[10px] text-blue-500 font-bold uppercase tracking-wider">Panitia</p>
                </div>
            </div>
        </div>
    </aside>

    <main class="flex-1 p-10 overflow-y-auto">
        <header class="mb-10 flex justify-between items-end">
            <div>
                <h1 class="text-3xl font-black tracking-tight">Statistik Penjualan</h1>
                <p class="text-gray-500 text-sm mt-2">Pantau pendapatan dan pertumbuhan peserta secara real-time.</p>
            </div>
            <select class="bg-[#121212] border border-white/5 rounded-xl px-4 py-3 text-[10px] font-black uppercase tracking-widest outline-none text-gray-400">
                <option>KMIPN VII (April 2026)</option>
                <option>Seminar Digital Literacy</option>
            </select>
        </header>

        <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-10">
            <div class="bg-[#121212] p-6 rounded-3xl border border-white/5">
                <p class="text-[10px] font-black text-gray-500 uppercase tracking-widest mb-1">Total Pendapatan</p>
                <h2 class="text-2xl font-black text-blue-500">Rp 4.500.000</h2>
                <p class="text-[10px] text-green-500 mt-2"><i class="fa-solid fa-arrow-up"></i> 12% dari target</p>
            </div>
            <div class="bg-[#121212] p-6 rounded-3xl border border-white/5">
                <p class="text-[10px] font-black text-gray-500 uppercase tracking-widest mb-1">Tiket Terjual</p>
                <h2 class="text-2xl font-black text-white">45 <span class="text-gray-600 text-lg">/ 100</span></h2>
                <p class="text-[10px] text-gray-500 mt-2">Sisa stok: 55 tiket</p>
            </div>
            <div class="bg-[#121212] p-6 rounded-3xl border border-white/5">
                <p class="text-[10px] font-black text-gray-500 uppercase tracking-widest mb-1">Kehadiran (Scan)</p>
                <h2 class="text-2xl font-black text-purple-500">32 <span class="text-gray-600 text-lg">Hadir</span></h2>
                <p class="text-[10px] text-gray-500 mt-2">71% tingkat kehadiran</p>
            </div>
            <div class="bg-[#121212] p-6 rounded-3xl border border-white/5">
                <p class="text-[10px] font-black text-gray-500 uppercase tracking-widest mb-1">Dilihat</p>
                <h2 class="text-2xl font-black text-white">1.284</h2>
                <p class="text-[10px] text-gray-500 mt-2">Klik pada landing page</p>
            </div>
        </div>

        <div class="grid lg:grid-cols-3 gap-8">
            <div class="lg:col-span-2 bg-[#121212] p-8 rounded-[2.5rem] border border-white/5">
                <h3 class="text-sm font-black uppercase tracking-widest mb-6">Tren Penjualan (7 Hari Terakhir)</h3>
                <canvas id="salesChart" height="150"></canvas>
            </div>

            <div class="bg-[#121212] p-8 rounded-[2.5rem] border border-white/5">
                <h3 class="text-sm font-black uppercase tracking-widest mb-6">Kategori Tiket</h3>
                <canvas id="categoryChart"></canvas>
            </div>
        </div>
    </main>

    <script>
        // Data Dummy untuk Grafik Penjualan
        const salesCtx = document.getElementById('salesChart').getContext('2d');
        new Chart(salesCtx, {
            type: 'line',
            data: {
                labels: ['Sen', 'Sel', 'Rab', 'Kam', 'Jum', 'Sab', 'Min'],
                datasets: [{
                    label: 'Tiket Terjual',
                    data: [5, 8, 4, 12, 10, 15, 45],
                    borderColor: '#3b82f6',
                    backgroundColor: 'rgba(59, 130, 246, 0.1)',
                    borderWidth: 3,
                    fill: true,
                    tension: 0.4,
                    pointBackgroundColor: '#3b82f6'
                }]
            },
            options: {
                plugins: { legend: { display: false } },
                scales: {
                    y: { grid: { color: 'rgba(255,255,255,0.05)' }, ticks: { color: '#666' } },
                    x: { grid: { display: false }, ticks: { color: '#666' } }
                }
            }
        });

        // Data Dummy untuk Grafik Kategori
        const catCtx = document.getElementById('categoryChart').getContext('2d');
        new Chart(catCtx, {
            type: 'doughnut',
            data: {
                labels: ['Reguler', 'VIP', 'Early Bird'],
                datasets: [{
                    data: [30, 10, 5],
                    backgroundColor: ['#3b82f6', '#8b5cf6', '#34d399'],
                    borderWidth: 0,
                    hoverOffset: 10
                }]
            },
            options: {
                plugins: {
                    legend: { position: 'bottom', labels: { color: '#fff', padding: 20, font: { size: 10, weight: 'bold' } } }
                }
            }
        });
    </script>
</body>
</html>
