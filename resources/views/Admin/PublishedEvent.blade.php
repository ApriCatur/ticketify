<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Published Event</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
</head>
<body class="bg-[#f4f7f5] text-gray-800">

<div class="flex min-h-screen">

    <!-- Sidebar -->
    <aside class="w-64 bg-white border-r border-gray-200 shadow-sm p-6">
        <h1 class="text-2xl font-bold text-green-600 mb-10">
            <i class="fa-solid fa-ticket mr-2"></i>Ticketify
        </h1>

        <nav class="space-y-3 text-sm">
            <a href="#" class="flex items-center gap-3 px-4 py-3 rounded-xl hover:bg-green-50">
                <i class="fa-solid fa-chart-line text-green-600"></i>
                Dashboard
            </a>

            <a href="#" class="flex items-center gap-3 px-4 py-3 rounded-xl bg-green-500 text-white">
                <i class="fa-solid fa-calendar-check"></i>
                Published Events
            </a>

            <a href="#" class="flex items-center gap-3 px-4 py-3 rounded-xl hover:bg-green-50">
                <i class="fa-solid fa-clock text-green-600"></i>
                Pending Events
            </a>


            <a href="#" class="flex items-center gap-3 px-4 py-3 rounded-xl hover:bg-green-50 transition">
                <i class="fa-solid fa-users text-green-600"></i>
                Manage Users
            </a>

            <a href="#" class="flex items-center gap-3 px-4 py-3 rounded-xl hover:bg-green-50 transition">
                <i class="fa-solid fa-layer-group text-green-600"></i>
                Event Categories
            </a>

            <a href="#" class="flex items-center gap-3 px-4 py-3 rounded-xl hover:bg-green-50 transition">
                <i class="fa-solid fa-gear text-green-600"></i>
                Settings
            </a>
            <a href="#" class="flex items-center gap-3 px-4 py-3 rounded-xl hover:bg-green-50 transition">
                <i class="fa-solid fa-right-from-bracket mr-2 text-green-600"></i>
                Logout
            </a>
        </nav>
    </aside>


    <!-- Main -->
    <main class="flex-1 p-8">

        <!-- Header -->
        <div class="flex justify-between items-center mb-8">
            <h2 class="text-3xl font-bold">Published Event</h2>

            <div class="flex items-center gap-3">
                <span class="font-medium">Admin</span>
                <div class="w-10 h-10 rounded-full bg-green-500"></div>
            </div>
        </div>


        <!-- Search -->
        <div class="bg-white rounded-2xl border border-gray-200 shadow-sm p-4 mb-8">
            <div class="grid grid-cols-1 md:grid-cols-5 gap-4">
                <div class="md:col-span-2 flex items-center border rounded-xl px-4">
                    <i class="fa-solid fa-magnifying-glass text-gray-400 mr-2"></i>
                    <input type="text" placeholder="Search event or keyword"
                        class="w-full py-3 outline-none">
                </div>

                <select class="border rounded-xl px-4 py-3">
                    <option>Location</option>
                </select>

                <input type="date" class="border rounded-xl px-4 py-3">

                <button class="bg-green-500 text-white rounded-xl px-6 py-3 hover:bg-green-600">
                    Search
                </button>
            </div>
        </div>


        <div class="grid grid-cols-1 xl:grid-cols-4 gap-8">

            <!-- Event Cards -->
            <div class="xl:col-span-3 grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-6">

                @for ($i = 0; $i < 6; $i++)
                <div class="bg-white rounded-2xl border border-gray-200 shadow-sm overflow-hidden">
                    <div class="h-36 bg-gray-200 relative">
                        <div class="absolute bottom-3 right-3 bg-white text-xs px-2 py-1 rounded shadow">
                            Apr 25
                        </div>
                    </div>

                    <div class="p-4">
                        <h3 class="font-bold text-lg">Event Seminar KMIPN</h3>

                        <p class="text-sm text-gray-500 mb-3">
                            <i class="fa-solid fa-location-dot text-green-500 mr-1"></i>
                            Politeknik Negeri Batam
                        </p>

                        <div class="text-sm text-gray-500 space-y-2 mb-4">
                            <p><i class="fa-regular fa-clock text-green-500 mr-2"></i>15:00</p>
                            <p><i class="fa-solid fa-ticket text-green-500 mr-2"></i>From IDR 40.000</p>
                        </div>

                        <div class="flex gap-2">
                            <button class="px-4 py-2 border border-gray-300 rounded-lg text-sm hover:bg-gray-50">
                                Detail
                            </button>

                            <button class="flex-1 bg-yellow-500 text-white py-2 rounded-lg text-sm hover:bg-yellow-600">
                                Unpublish
                            </button>

                            <button class="flex-1 bg-green-500 text-white py-2 rounded-lg text-sm hover:bg-green-600">
                                Buy Now
                            </button>
                        </div>
                    </div>
                </div>
                @endfor

            </div>


            <!-- Calendar -->
            <div class="bg-white rounded-2xl border border-gray-200 shadow-sm p-6 h-fit">
                <h3 class="text-xl font-bold mb-6 text-green-600">April 2026</h3>

                <div class="space-y-4 text-sm">

                    <div class="border-l-4 border-green-500 pl-4">
                        <p class="font-semibold">Sat, 11</p>
                        <p class="text-gray-600">Event Seminar KMIPN</p>
                        <p class="text-gray-400">15:00</p>
                    </div>

                    <div class="border-l-4 border-green-500 pl-4">
                        <p class="font-semibold">Sat, 25</p>
                        <p class="text-gray-600">Politeknik Negeri Batam</p>
                        <p class="text-gray-400">15:00</p>
                    </div>

                    <div class="border-l-4 border-green-500 pl-4">
                        <p class="font-semibold">Sun, 26</p>
                        <p class="text-gray-600">Event Schedule</p>
                        <p class="text-gray-400">15:00</p>
                    </div>

                </div>
            </div>

        </div>

    </main>
</div>

</body>
</html>
