<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pending Event</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
</head>
<body class="bg-slate-50 text-slate-800">

<div class="flex min-h-screen">

    <!-- Sidebar -->
    <x-sidebar/>

    <!-- Main -->
    <main class="flex-1 p-8">

        <!-- Header -->
        <div class="flex justify-between items-center mb-8">
            <div>
                <h2 class="text-3xl font-bold text-slate-900">Pending Event</h2>
                <p class="text-slate-500">Review and approve incoming event submissions</p>
            </div>

            <div class="flex items-center gap-3">
                <span class="font-medium text-slate-700">Admin</span>
                <div class="w-10 h-10 rounded-full bg-slate-900"></div>
            </div>
        </div>


        <!-- Search Bar -->
        <div class="bg-white rounded-3xl border border-slate-200 shadow-sm p-4 mb-8">
            <div class="grid grid-cols-1 md:grid-cols-5 gap-4">
                <div class="md:col-span-2 flex items-center border border-slate-200 rounded-2xl px-4">
                    <i class="fa-solid fa-magnifying-glass text-slate-400 mr-2"></i>
                    <input type="text" placeholder="Search event or keyword"
                        class="w-full py-3 outline-none bg-transparent">
                </div>

                <select class="border border-slate-200 rounded-2xl px-4 py-3 text-slate-600">
                    <option>Location</option>
                </select>

                <input type="date" class="border border-slate-200 rounded-2xl px-4 py-3">

                <button class="bg-slate-900 text-white rounded-2xl px-6 py-3 hover:bg-slate-800 transition">
                    Search
                </button>
            </div>
        </div>


        <div class="grid grid-cols-1 xl:grid-cols-4 gap-8">

            <!-- Event Cards -->
            <div class="xl:col-span-3 grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-6">

                @for ($i = 0; $i < 6; $i++)
                <div class="bg-white rounded-3xl border border-slate-200 shadow-sm overflow-hidden hover:shadow-md transition group">
                    <div class="h-36 bg-slate-100 relative flex items-center justify-center">
                        <i class="fa-regular fa-image text-slate-300 text-4xl"></i>

                        <div class="absolute bottom-3 right-3 bg-white text-xs px-3 py-1 rounded-xl border border-slate-200 shadow-sm">
                            Apr 25
                        </div>
                    </div>

                    <div class="p-5">
                        <h3 class="font-bold text-lg text-slate-800 group-hover:text-slate-900">
                            Event Seminar KMIPN
                        </h3>

                        <p class="text-sm text-slate-500 mb-3">
                            <i class="fa-solid fa-location-dot text-slate-600 mr-1"></i>
                            Politeknik Negeri Batam
                        </p>

                        <div class="text-sm text-slate-500 space-y-2 mb-5">
                            <p><i class="fa-regular fa-clock text-slate-600 mr-2"></i>15:00</p>
                            <p><i class="fa-solid fa-ticket text-slate-600 mr-2"></i>From IDR 40.000</p>
                        </div>

                        <div class="flex gap-2">
                            <button class="flex-1 bg-slate-900 text-white py-2 rounded-xl text-sm hover:bg-slate-800 transition">
                                Approve
                            </button>

                            <button class="flex-1 bg-slate-200 text-slate-700 py-2 rounded-xl text-sm hover:bg-slate-300 transition">
                                Reject
                            </button>

                            <button class="px-4 border border-slate-200 rounded-xl text-sm hover:bg-slate-50 transition">
                                Detail
                            </button>
                        </div>
                    </div>
                </div>
                @endfor

            </div>


            <!-- Calendar -->
            <div class="bg-white rounded-3xl border border-slate-200 shadow-sm p-6 h-fit">
                <h3 class="text-xl font-bold mb-6 text-slate-900">April 2026</h3>

                <div class="space-y-4 text-sm">

                    <div class="border-l-4 border-slate-900 pl-4">
                        <p class="font-semibold">Sat, 11</p>
                        <p class="text-slate-600">Event Seminar KMIPN</p>
                        <p class="text-slate-400">15:00</p>
                    </div>

                    <div class="border-l-4 border-slate-900 pl-4">
                        <p class="font-semibold">Sat, 25</p>
                        <p class="text-slate-600">Politeknik Negeri Batam</p>
                        <p class="text-slate-400">15:00</p>
                    </div>

                    <div class="border-l-4 border-slate-900 pl-4">
                        <p class="font-semibold">Sun, 26</p>
                        <p class="text-slate-600">Event Schedule</p>
                        <p class="text-slate-400">15:00</p>
                    </div>

                </div>
            </div>

        </div>

    </main>
</div>

</body>
</html>
