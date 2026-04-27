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

    @include('layouts.sidebar-panitia')

   <main class="flex-1 p-10 overflow-y-auto">

    <!-- BACK -->
    <div class="mb-6">
        <a href="{{ route('panitia.statistic') }}"
            class="inline-flex items-center gap-2 text-gray-400 hover:text-blue-500 transition-all duration-200 group">
            <i class="fa-solid fa-arrow-left text-sm group-hover:-translate-x-1 transition-transform"></i>
            <span class="text-sm font-semibold">Back</span>
        </a>
    </div>

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
