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
            background: rgba(18,18,18,0.85);
            backdrop-filter: blur(12px);
        }

        .card-hover {
            transition: all .3s ease;
        }

        .card-hover:hover {
            transform: translateY(-5px);
            box-shadow: 0 20px 30px rgba(59,130,246,0.12);
        }
    </style>
</head>
<body class="bg-[#0f0f0f] text-white">

<div class="flex min-h-screen max-w-[1600px] mx-auto border-x border-white/5 bg-[#121212]">

    <!-- Sidebar -->
    <x-sidebar/>

    <!-- Main -->
    <main class="flex-1">

        <!-- Header -->
        <nav class="sticky top-0 z-50 glass border-b border-white/5 px-8 py-5 flex justify-between items-center">
            <div>
                <h2 class="text-2xl font-black tracking-tight">Pending Event</h2>
                <p class="text-gray-500 text-sm">Review and approve incoming event submissions</p>
            </div>

            <div class="flex items-center gap-3">
                <span class="text-sm font-semibold text-gray-300">Admin</span>
                <div class="w-10 h-10 rounded-full bg-blue-600 flex items-center justify-center text-xs font-bold">
                    AD
                </div>
            </div>
        </nav>

        <!-- Search -->
        <div class="px-8 py-8">
            <div class="bg-[#1e1e1e] border border-white/10 rounded-2xl p-4 shadow-xl">
                <div class="grid grid-cols-1 md:grid-cols-5 gap-4">

                    <div class="md:col-span-2 flex items-center bg-white/5 rounded-xl px-4">
                        <i class="fa-solid fa-magnifying-glass text-blue-500 mr-3"></i>
                        <input type="text" placeholder="Search event or keyword"
                            class="w-full py-3 bg-transparent outline-none text-sm text-white placeholder-gray-500">
                    </div>

                    <select class="bg-white/5 rounded-xl px-4 py-3 text-sm text-gray-400 outline-none">
                        <option>Location</option>
                    </select>

                    <input type="date"
                        class="bg-white/5 rounded-xl px-4 py-3 text-sm text-gray-400 outline-none [color-scheme:dark]">

                    <button class="bg-white text-black rounded-xl px-6 py-3 font-bold hover:bg-blue-500 hover:text-white transition">
                        Search
                    </button>
                </div>
            </div>
        </div>

        <div class="grid grid-cols-1 xl:grid-cols-4 gap-8 px-8 pb-8">

            <!-- Event Cards -->
            <div class="xl:col-span-3 grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-6">

                @for ($i = 0; $i < 6; $i++)
                <div class="bg-[#1e1e1e] border border-white/5 rounded-2xl overflow-hidden card-hover group">

                    <div class="h-44 bg-[#18181b] relative flex items-center justify-center">
                        <i class="fa-regular fa-image text-gray-700 text-4xl"></i>

                        <div class="absolute top-3 right-3 bg-black/60 backdrop-blur-md text-xs px-3 py-2 rounded-xl border border-white/10">
                            Apr 25
                        </div>
                    </div>

                    <div class="p-5">
                        <span class="text-[10px] font-bold uppercase tracking-widest text-blue-500">
                            Pending
                        </span>

                        <h3 class="font-bold text-lg mt-2 group-hover:text-blue-400 transition">
                            Event Seminar KMIPN
                        </h3>

                        <p class="text-sm text-gray-500 mb-3">
                            <i class="fa-solid fa-location-dot mr-1"></i>
                            Politeknik Negeri Batam
                        </p>

                        <div class="text-sm text-gray-500 space-y-2 mb-5">
                            <p><i class="fa-regular fa-clock mr-2"></i>15:00</p>
                            <p><i class="fa-solid fa-ticket mr-2"></i>From IDR 40.000</p>
                        </div>

                        <div class="flex gap-2">
                            <button class="flex-1 bg-blue-600 text-white py-2 rounded-xl text-sm font-semibold hover:bg-blue-500 transition">
                                Approve
                            </button>

                            <button class="flex-1 bg-red-500/10 text-red-400 py-2 rounded-xl text-sm hover:bg-red-500/20 transition">
                                Reject
                            </button>

                            <button class="px-4 border border-white/10 rounded-xl text-sm hover:bg-white/5 transition">
                                Detail
                            </button>
                        </div>
                    </div>
                </div>
                @endfor

            </div>

            <!-- Right Panel -->
            <div class="bg-[#1e1e1e] border border-white/5 rounded-2xl p-6 h-fit">
                <h3 class="text-xl font-black mb-6">April 2026</h3>

                <div class="space-y-4 text-sm">

                    <div class="border-l-4 border-blue-500 pl-4">
                        <p class="font-semibold">Sat, 11</p>
                        <p class="text-gray-400">Event Seminar KMIPN</p>
                        <p class="text-gray-600">15:00</p>
                    </div>

                    <div class="border-l-4 border-blue-500 pl-4">
                        <p class="font-semibold">Sat, 25</p>
                        <p class="text-gray-400">Politeknik Negeri Batam</p>
                        <p class="text-gray-600">15:00</p>
                    </div>

                    <div class="border-l-4 border-blue-500 pl-4">
                        <p class="font-semibold">Sun, 26</p>
                        <p class="text-gray-400">Event Schedule</p>
                        <p class="text-gray-600">15:00</p>
                    </div>

                </div>
            </div>

        </div>

    </main>
</div>

</body>
</html>
