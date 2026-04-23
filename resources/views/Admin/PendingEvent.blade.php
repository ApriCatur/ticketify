<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pending Event</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">

    <style>
        @import url('https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;600;800&display=swap');

        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
        }

        .glass {
            background: rgba(18,18,18,0.8);
            backdrop-filter: blur(10px);
        }

        .card-hover {
            transition: all .3s ease;
        }

        .card-hover:hover {
            transform: translateY(-6px);
            box-shadow: 0 20px 25px rgba(59,130,246,.15);
        }
    </style>
</head>
<body class="bg-[#0f0f0f] text-white antialiased">

<div class="flex min-h-screen max-w-[1600px] mx-auto border-x border-white/5 bg-[#121212]">

    <!-- Sidebar -->
    <x-sidebar/>

    <!-- Main -->
    <main class="flex-1">

        <!-- Header -->
        <nav class="sticky top-0 z-50 glass border-b border-white/5 px-8 py-4 flex justify-between items-center">
            <div>
                <h2 class="text-2xl font-black tracking-tight">Pending Event</h2>
                <p class="text-xs text-gray-500 mt-1">Review and approve incoming event submissions</p>
            </div>

            <div class="flex items-center gap-3">
                <span class="text-sm font-semibold text-gray-400">Admin</span>
                <div class="w-10 h-10 rounded-full bg-blue-600 flex items-center justify-center text-xs font-bold">
                    AD
                </div>
            </div>
        </nav>

        <!-- Search -->
        <div class="px-8 py-8">
            <div class="bg-[#1e1e1e] border border-white/10 rounded-2xl p-4 shadow-xl flex flex-wrap lg:flex-nowrap items-end gap-4">

                <div class="flex-[2] min-w-[200px]">
                    <label class="text-[9px] font-black text-gray-500 uppercase tracking-widest mb-2 block">
                        Search Event
                    </label>
                    <div class="flex items-center gap-3 bg-white/5 rounded-xl px-4 py-3">
                        <i class="fa-solid fa-magnifying-glass text-blue-500"></i>
                        <input type="text" placeholder="Search event..."
                            class="bg-transparent w-full outline-none text-sm">
                    </div>
                </div>

                <div class="flex-1 min-w-[150px]">
                    <label class="text-[9px] font-black text-gray-500 uppercase tracking-widest mb-2 block">
                        Location
                    </label>
                    <select class="w-full bg-white/5 rounded-xl py-3 px-4 text-sm outline-none">
                        <option>All Location</option>
                    </select>
                </div>

                <div class="flex-1 min-w-[150px]">
                    <label class="text-[9px] font-black text-gray-500 uppercase tracking-widest mb-2 block">
                        Date
                    </label>
                    <input type="date"
                        class="w-full bg-white/5 rounded-xl py-3 px-4 text-sm outline-none [color-scheme:dark]">
                </div>

                <button class="px-8 py-3 bg-white text-black rounded-xl font-bold hover:bg-blue-500 hover:text-white transition">
                    Search
                </button>
            </div>
        </div>

        <div class="grid grid-cols-1 xl:grid-cols-4 gap-8 px-8 pb-8">
            <!-- Event Cards -->
            <div class="xl:col-span-3 grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-6">

                @for ($i = 0; $i < 6; $i++)
                <div class="bg-[#1e1e1e] border border-white/5 rounded-2xl overflow-hidden card-hover group">

                    <div class="h-44 bg-[#18181b] relative flex items-center justify-center">
                        <i class="fa-regular fa-image text-gray-700 text-4xl"></i>

                        <div class="absolute top-3 right-3 bg-black/60 backdrop-blur-md px-3 py-2 rounded-xl border border-white/10 text-center">
                            <span class="block text-[10px] font-bold text-blue-400 uppercase">APR</span>
                            <span class="block text-lg font-black">25</span>
                            <span class="text-[10px] text-gray-500">2026</span>
                        </div>
                    </div>

                    <div class="p-5">
                        <span class="text-[10px] font-bold uppercase tracking-widest text-blue-500">
                            Pending
                        </span>

                        <h3 class="font-bold text-lg mt-2 mb-3 group-hover:text-blue-400 transition">
                            Event Seminar KMIPN
                        </h3>

                        <div class="space-y-2 text-xs text-gray-400 mb-5">
                            <div class="flex items-center gap-2">
                                <i class="fa-solid fa-location-dot"></i>
                                Politeknik Negeri Batam
                            </div>

                            <div class="flex items-center gap-2">
                                <i class="fa-regular fa-clock"></i>
                                15:00 WIB
                            </div>

                            <div class="flex items-center gap-2">
                                <i class="fa-solid fa-ticket"></i>
                                From IDR 40.000
                            </div>
                        </div>

                        <div class="flex gap-2 pt-4 border-t border-white/5">
                            <button class="flex-1 bg-blue-600 text-white py-2 rounded-xl text-xs font-semibold hover:bg-blue-500 transition">
                                Approve
                            </button>

                            <button class="flex-1 bg-red-500/10 text-red-400 py-2 rounded-xl text-xs hover:bg-red-500/20 transition">
                                Reject
                            </button>

                            <button class="px-4 py-2 border border-white/10 rounded-xl text-xs hover:bg-white/5 transition">
                                Detail
                            </button>
                        </div>
                    </div>
                </div>
                @endfor

            </div>

            <!-- Right Panel -->
            <aside class="w-80 hidden xl:block">
                <div class="space-y-6">

                    <div>
                        <div class="flex justify-between items-center mb-4">
                            <h3 class="text-xl font-black">Upcoming</h3>
                            <i class="fa-solid fa-calendar-check text-blue-500"></i>
                        </div>

                        <div class="space-y-4">
                            <div class="p-4 bg-[#1e1e1e] rounded-2xl border border-white/5">
                                <p class="font-bold text-sm">Seminar KMIPN</p>
                                <p class="text-xs text-gray-500 mt-1">25 Apr 2026 • 15:00</p>
                            </div>

                            <div class="p-4 bg-[#1e1e1e] rounded-2xl border border-white/5">
                                <p class="font-bold text-sm">Workshop AI</p>
                                <p class="text-xs text-gray-500 mt-1">26 Apr 2026 • 10:00</p>
                            </div>
                        </div>
                    </div>

                    <div class="p-6 bg-gradient-to-br from-blue-600 to-blue-900 rounded-2xl">
                        <h4 class="font-black mb-2">Need Review?</h4>
                        <p class="text-xs text-blue-100 mb-4">
                            Check all submitted events before publishing.
                        </p>

                        <button class="w-full py-3 bg-white text-blue-600 rounded-xl text-sm font-bold hover:bg-blue-50 transition">
                            View All
                        </button>
                    </div>

                </div>
            </aside>

        </div>

    </main>
</div>

</body>
</html>
