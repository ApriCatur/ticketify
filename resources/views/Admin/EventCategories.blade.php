<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Event Categories</title>

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

            <a href="#" class="flex items-center gap-3 px-4 py-3 rounded-xl bg-green-500 text-white">
                <i class="fa-solid fa-layer-group"></i>
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
            <h2 class="text-3xl font-bold">Event Categories</h2>

            <div class="flex items-center gap-3">
                <span class="font-medium">Admin</span>
                <div class="w-10 h-10 rounded-full bg-green-500"></div>
            </div>
        </div>


        <!-- Statistics -->
        <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">

            <div class="bg-white p-6 rounded-2xl border border-gray-200 shadow-sm">
                <p class="text-gray-500">Total Categories</p>
                <h3 class="text-4xl font-bold mt-2">5</h3>
            </div>

            <div class="bg-white p-6 rounded-2xl border border-gray-200 shadow-sm">
                <p class="text-gray-500">Active Categories</p>
                <h3 class="text-4xl font-bold mt-2 text-green-600">2</h3>
            </div>

            <div class="bg-white p-6 rounded-2xl border border-gray-200 shadow-sm">
                <p class="text-gray-500">Empty Categories</p>
                <h3 class="text-4xl font-bold mt-2 text-yellow-500">3</h3>
            </div>

            <div class="bg-white p-6 rounded-2xl border border-gray-200 shadow-sm">
                <p class="text-gray-500">Total Events</p>
                <h3 class="text-4xl font-bold mt-2">19</h3>
            </div>

        </div>


        <!-- Table -->
        <div class="bg-white rounded-2xl border border-gray-200 shadow-sm p-6">

            <!-- Search + Button -->
            <div class="flex flex-col md:flex-row justify-between gap-4 mb-6">
                <div class="flex items-center border rounded-xl px-4 w-full md:w-80">
                    <i class="fa-solid fa-magnifying-glass text-gray-400 mr-2"></i>
                    <input type="text" placeholder="Search category..."
                        class="w-full py-3 outline-none">
                </div>

                <button class="bg-green-500 text-white px-6 py-3 rounded-xl hover:bg-green-600">
                    <i class="fa-solid fa-plus mr-2"></i>
                    Add Category
                </button>
            </div>


            <!-- Table -->
            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead>
                        <tr class="border-b text-left text-gray-500">
                            <th class="py-3">No</th>
                            <th class="py-3">Category Name</th>
                            <th class="py-3 text-center">Actions</th>
                        </tr>
                    </thead>

                    <tbody class="divide-y">
                        @php
                            $categories = ['Entertainment', 'Sports', 'Education', 'Business', 'Exhibitions'];
                        @endphp

                        @foreach ($categories as $index => $category)
                        <tr class="hover:bg-green-50">
                            <td class="py-4">{{ $index + 1 }}</td>
                            <td class="py-4">{{ $category }}</td>
                            <td class="py-4">
                                <div class="flex justify-center gap-4">
                                    <button class="text-blue-500 hover:text-blue-700">
                                        <i class="fa-solid fa-pen-to-square"></i>
                                    </button>

                                    <button class="text-red-500 hover:text-red-700">
                                        <i class="fa-solid fa-trash"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

        </div>

    </main>
</div>

</body>
</html>
