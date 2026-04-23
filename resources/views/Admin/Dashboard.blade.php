<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ticketify Dashboard</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
</head>

<body class="bg-[#09090b] text-white">
<div class="flex min-h-screen">

    <!-- Sidebar -->
    <x-sidebar/>

    <!-- Main Content -->
    <main class="flex-1 p-10">

        <!-- Header -->
        <div class="flex justify-between items-center mb-10">
            <div>
                <h2 class="text-3xl font-black tracking-tight">Dashboard</h2>
                <p class="text-gray-500 text-sm mt-2">Overview of your event platform</p>
            </div>

            <div class="flex items-center gap-3">
                <span class="text-sm font-bold text-gray-300">Admin</span>
                <div class="w-10 h-10 rounded-full bg-blue-600 flex items-center justify-center text-xs font-bold">
                    AD
                </div>
            </div>
        </div>

        <!-- Stats Cards -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-10">

            <div class="bg-[#121212] border border-white/5 p-6 rounded-[2rem]">
                <div class="flex justify-between items-center">
                    <p class="text-gray-500 text-sm">Published Events</p>
                    <i class="fa-solid fa-arrow-trend-up text-blue-500"></i>
                </div>
                <h3 class="text-4xl font-black mt-4">67</h3>
                <p class="text-xs text-gray-600 mt-2">Updated this month</p>
            </div>

            <div class="bg-[#121212] border border-white/5 p-6 rounded-[2rem]">
                <div class="flex justify-between items-center">
                    <p class="text-gray-500 text-sm">Pending Events</p>
                    <i class="fa-solid fa-hourglass-half text-yellow-500"></i>
                </div>
                <h3 class="text-4xl font-black mt-4">19</h3>
                <p class="text-xs text-gray-600 mt-2">Waiting approval</p>
            </div>

            <div class="bg-[#121212] border border-white/5 p-6 rounded-[2rem]">
                <div class="flex justify-between items-center">
                    <p class="text-gray-500 text-sm">Users</p>
                    <i class="fa-solid fa-user-group text-purple-500"></i>
                </div>
                <h3 class="text-4xl font-black mt-4">4</h3>
                <p class="text-xs text-gray-600 mt-2">Active users</p>
            </div>

        </div>

        <!-- Charts -->
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">

            <!-- Bar Chart -->
            <div class="bg-[#121212] border border-white/5 p-8 rounded-[2.5rem]">
                <h3 class="text-sm font-black uppercase tracking-widest mb-6 flex items-center gap-2">
                    <i class="fa-solid fa-chart-column text-blue-500"></i>
                    Events by Category
                </h3>

                <div class="flex items-end justify-between h-64 gap-5">
                    <div class="w-14 bg-blue-500 rounded-t-xl h-52"></div>
                    <div class="w-14 bg-purple-500 rounded-t-xl h-32"></div>
                    <div class="w-14 bg-yellow-500 rounded-t-xl h-44"></div>
                    <div class="w-14 bg-gray-500 rounded-t-xl h-20"></div>
                </div>

                <div class="flex justify-between mt-4 text-xs text-gray-500">
                    <span>Music</span>
                    <span>Edu</span>
                    <span>Sport</span>
                    <span>Seminar</span>
                </div>
            </div>

            <!-- Pie Chart -->
            <div class="bg-[#121212] border border-white/5 p-8 rounded-[2.5rem] flex flex-col items-center">
                <h3 class="text-sm font-black uppercase tracking-widest mb-6 self-start flex items-center gap-2">
                    <i class="fa-solid fa-chart-pie text-blue-500"></i>
                    Event Ratio
                </h3>

                <div class="w-52 h-52 rounded-full bg-[conic-gradient(#3b82f6_70%,#27272a_30%)]"></div>

                <div class="flex gap-6 mt-6 text-xs">
                    <span class="text-white">
                        <i class="fa-solid fa-circle mr-1 text-blue-500"></i>Published
                    </span>
                    <span class="text-gray-500">
                        <i class="fa-solid fa-circle mr-1 text-gray-500"></i>Pending
                    </span>
                </div>

                <p class="mt-4 text-gray-500 text-xs">Total Events: 86</p>
            </div>

        </div>

    </main>
</div>
</body>
</html>
