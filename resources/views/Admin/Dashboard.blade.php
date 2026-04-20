<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ticketify Dashboard</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- Font Awesome -->
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
            <a href="#" class="flex items-center gap-3 px-4 py-3 rounded-xl bg-green-500 text-white font-medium">
                <i class="fa-solid fa-chart-line"></i>
                Dashboard
            </a>

            <a href="#" class="flex items-center gap-3 px-4 py-3 rounded-xl hover:bg-green-50 transition">
                <i class="fa-solid fa-calendar-check text-green-600"></i>
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


    <!-- Main Content -->
    <main class="flex-1 p-8">

        <!-- Header -->
        <div class="flex justify-between items-center mb-8">
            <div>
                <h2 class="text-3xl font-bold">Dashboard</h2>
                <p class="text-gray-500">Overview of your event platform</p>
            </div>

            <div class="flex items-center gap-3">
                <span class="font-medium">Admin</span>
                <div class="w-10 h-10 rounded-full bg-green-500"></div>
            </div>
        </div>


        <!-- Stats Cards -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">

            <div class="bg-white rounded-2xl border border-gray-200 p-6 shadow-sm">
                <div class="flex justify-between">
                    <p class="text-gray-500">Published Events</p>
                    <i class="fa-solid fa-arrow-trend-up text-green-500"></i>
                </div>
                <h3 class="text-4xl font-bold mt-2">67</h3>
                <p class="text-sm text-gray-400 mt-2">Updated this month</p>
            </div>

            <div class="bg-white rounded-2xl border border-gray-200 p-6 shadow-sm">
                <div class="flex justify-between">
                    <p class="text-gray-500">Pending Events</p>
                    <i class="fa-solid fa-hourglass-half text-yellow-500"></i>
                </div>
                <h3 class="text-4xl font-bold mt-2">19</h3>
                <p class="text-sm text-gray-400 mt-2">Waiting approval</p>
            </div>

            <div class="bg-white rounded-2xl border border-gray-200 p-6 shadow-sm">
                <div class="flex justify-between">
                    <p class="text-gray-500">Users</p>
                    <i class="fa-solid fa-user-group text-green-500"></i>
                </div>
                <h3 class="text-4xl font-bold mt-2">4</h3>
                <p class="text-sm text-gray-400 mt-2">Active users</p>
            </div>

        </div>


        <!-- Chart Section -->
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">

            <!-- Bar Chart -->
            <div class="bg-white rounded-2xl border border-gray-200 p-6 shadow-sm">
                <h3 class="font-semibold mb-6">Events by Category</h3>

                <div class="flex items-end justify-between h-64 gap-5">
                    <div class="w-14 bg-green-500 rounded-t-lg h-52"></div>
                    <div class="w-14 bg-green-400 rounded-t-lg h-32"></div>
                    <div class="w-14 bg-green-500 rounded-t-lg h-44"></div>
                    <div class="w-14 bg-green-300 rounded-t-lg h-20"></div>
                </div>

                <div class="flex justify-between mt-4 text-sm text-gray-500">
                    <span>Music</span>
                    <span>Edu</span>
                    <span>Sport</span>
                    <span>Seminar</span>
                </div>
            </div>

            <!-- Pie Chart -->
            <div class="bg-white rounded-2xl border border-gray-200 p-6 shadow-sm flex flex-col items-center">
                <h3 class="font-semibold mb-6 self-start">Event Ratio</h3>

                <div class="w-52 h-52 rounded-full bg-[conic-gradient(#22c55e_70%,#d1d5db_30%)]"></div>

                <div class="flex gap-6 mt-6 text-sm">
                    <span class="text-green-600">
                        <i class="fa-solid fa-circle mr-1"></i>Published
                    </span>
                    <span class="text-gray-500">
                        <i class="fa-solid fa-circle mr-1"></i>Pending
                    </span>
                </div>

                <p class="mt-4 text-gray-500">Total Events: 86</p>
            </div>

        </div>

    </main>
</div>

</body>
</html>
