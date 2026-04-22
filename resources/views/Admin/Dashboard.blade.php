<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ticketify Dashboard</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
</head>
<body class="bg-slate-50 text-slate-800">
<div class="flex min-h-screen">

    <!-- Sidebar -->
    <x-sidebar/>

    <!-- Main Content -->
    <main class="flex-1 p-8">

        <!-- Header -->
        <div class="flex justify-between items-center mb-8">
            <div>
                <h2 class="text-3xl font-bold text-slate-900">Dashboard</h2>
                <p class="text-slate-500">Overview of your event platform</p>
            </div>

            <div class="flex items-center gap-3">
                <span class="font-medium text-slate-700">Admin</span>
                <div class="w-10 h-10 rounded-full bg-slate-900"></div>
            </div>
        </div>


        <!-- Stats Cards -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">

            <div class="bg-white rounded-3xl border border-slate-200 p-6 shadow-sm">
                <div class="flex justify-between items-center">
                    <p class="text-slate-500">Published Events</p>
                    <i class="fa-solid fa-arrow-trend-up text-slate-700"></i>
                </div>
                <h3 class="text-4xl font-bold mt-3 text-slate-900">67</h3>
                <p class="text-sm text-slate-400 mt-2">Updated this month</p>
            </div>

            <div class="bg-white rounded-3xl border border-slate-200 p-6 shadow-sm">
                <div class="flex justify-between items-center">
                    <p class="text-slate-500">Pending Events</p>
                    <i class="fa-solid fa-hourglass-half text-slate-700"></i>
                </div>
                <h3 class="text-4xl font-bold mt-3 text-slate-900">19</h3>
                <p class="text-sm text-slate-400 mt-2">Waiting approval</p>
            </div>

            <div class="bg-white rounded-3xl border border-slate-200 p-6 shadow-sm">
                <div class="flex justify-between items-center">
                    <p class="text-slate-500">Users</p>
                    <i class="fa-solid fa-user-group text-slate-700"></i>
                </div>
                <h3 class="text-4xl font-bold mt-3 text-slate-900">4</h3>
                <p class="text-sm text-slate-400 mt-2">Active users</p>
            </div>

        </div>


        <!-- Chart Section -->
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">

            <!-- Bar Chart -->
            <div class="bg-white rounded-3xl border border-slate-200 p-6 shadow-sm">
                <h3 class="font-semibold mb-6 text-slate-800">Events by Category</h3>

                <div class="flex items-end justify-between h-64 gap-5">
                    <div class="w-14 bg-slate-900 rounded-t-xl h-52"></div>
                    <div class="w-14 bg-slate-700 rounded-t-xl h-32"></div>
                    <div class="w-14 bg-slate-800 rounded-t-xl h-44"></div>
                    <div class="w-14 bg-slate-400 rounded-t-xl h-20"></div>
                </div>

                <div class="flex justify-between mt-4 text-sm text-slate-500">
                    <span>Music</span>
                    <span>Edu</span>
                    <span>Sport</span>
                    <span>Seminar</span>
                </div>
            </div>

            <!-- Pie Chart -->
            <div class="bg-white rounded-3xl border border-slate-200 p-6 shadow-sm flex flex-col items-center">
                <h3 class="font-semibold mb-6 self-start text-slate-800">Event Ratio</h3>

                <div class="w-52 h-52 rounded-full bg-[conic-gradient(#0f172a_70%,#e2e8f0_30%)]"></div>

                <div class="flex gap-6 mt-6 text-sm">
                    <span class="text-slate-800">
                        <i class="fa-solid fa-circle mr-1"></i>Published
                    </span>
                    <span class="text-slate-400">
                        <i class="fa-solid fa-circle mr-1"></i>Pending
                    </span>
                </div>

                <p class="mt-4 text-slate-500">Total Events: 86</p>
            </div>

        </div>

    </main>
</div>

</body>
</html>
