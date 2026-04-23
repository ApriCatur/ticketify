<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Users Management</title>

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
            transform: translateY(-4px);
            box-shadow: 0 15px 25px rgba(59,130,246,.10);
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
                <h2 class="text-2xl font-black tracking-tight">Users</h2>
                <p class="text-sm text-gray-500">Manage all users in the platform</p>
            </div>

            <div class="flex items-center gap-3">
                <span class="text-sm font-semibold text-gray-300">Admin</span>
                <div class="w-10 h-10 rounded-full bg-blue-600 flex items-center justify-center text-xs font-bold">
                    AD
                </div>
            </div>
        </nav>

        <div class="p-8">

            <!-- Statistics -->
            <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-4 gap-6 mb-8">

                <div class="bg-[#1e1e1e] p-6 rounded-2xl border border-white/5 card-hover">
                    <p class="text-gray-500 text-sm">Total Users</p>
                    <h3 class="text-4xl font-black mt-2">67</h3>
                </div>

                <div class="bg-[#1e1e1e] p-6 rounded-2xl border border-white/5 card-hover">
                    <p class="text-gray-500 text-sm">Admins</p>
                    <h3 class="text-4xl font-black mt-2 text-blue-400">1</h3>
                </div>

                <div class="bg-[#1e1e1e] p-6 rounded-2xl border border-white/5 card-hover">
                    <p class="text-gray-500 text-sm">Organizers</p>
                    <h3 class="text-4xl font-black mt-2 text-indigo-400">3</h3>
                </div>

                <div class="bg-[#1e1e1e] p-6 rounded-2xl border border-white/5 card-hover">
                    <p class="text-gray-500 text-sm">Customers</p>
                    <h3 class="text-4xl font-black mt-2 text-gray-300">63</h3>
                </div>

            </div>

            <!-- Table -->
            <div class="bg-[#1e1e1e] rounded-2xl border border-white/5 p-6">

                <!-- Search + Add -->
                <div class="flex flex-col md:flex-row justify-between gap-4 mb-6">
                    <div class="flex items-center bg-white/5 rounded-xl px-4 w-full md:w-80">
                        <i class="fa-solid fa-magnifying-glass text-blue-500 mr-3"></i>
                        <input type="text" placeholder="Search user..."
                            class="w-full py-3 bg-transparent outline-none text-sm text-white placeholder-gray-500">
                    </div>

                    <button class="bg-white text-black px-6 py-3 rounded-xl font-bold hover:bg-blue-500 hover:text-white transition">
                        <i class="fa-solid fa-plus mr-2"></i>
                        Add User
                    </button>
                </div>

                <!-- Table -->
                <div class="overflow-x-auto">
                    <table class="w-full">
                        <thead>
                            <tr class="border-b border-white/5 text-left text-gray-500 text-sm">
                                <th class="py-4">No</th>
                                <th class="py-4">Name</th>
                                <th class="py-4">Email</th>
                                <th class="py-4">Role</th>
                                <th class="py-4 text-center">Actions</th>
                            </tr>
                        </thead>

                        <tbody class="divide-y divide-white/5">
                            @php
                                $users = [
                                    ['Abdul Rizad', 'admin@gmail.com', 'Admin'],
                                    ['Samsul Arif', 'customer@gmail.com', 'Customer'],
                                    ['Muhammad Aqsan', 'organizer@gmail.com', 'Organizer'],
                                    ['M. Fauzi Azhari', 'ari@gmail.com', 'Admin'],
                                    ['Apri Catur', 'apri@gmail.com', 'Customer'],
                                    ['Syarifah', 'syarah@gmail.com', 'Organizer'],
                                    ['Adrian Septiaji', 'adit@gmail.com', 'Organizer'],
                                ];
                            @endphp

                            @foreach ($users as $index => $user)
                            <tr class="hover:bg-white/5 transition">
                                <td class="py-4">{{ $index + 1 }}</td>

                                <td class="py-4 font-medium">
                                    {{ $user[0] }}
                                </td>

                                <td class="py-4 text-gray-400">
                                    {{ $user[1] }}
                                </td>

                                <td class="py-4">
                                    <span class="px-3 py-1 rounded-full text-xs font-semibold
                                        @if($user[2]=='Admin') bg-blue-500/10 text-blue-400
                                        @elseif($user[2]=='Organizer') bg-indigo-500/10 text-indigo-400
                                        @else bg-gray-500/10 text-gray-300
                                        @endif">
                                        {{ $user[2] }}
                                    </span>
                                </td>

                                <td class="py-4">
                                    <div class="flex justify-center gap-4">
                                        <button class="text-gray-400 hover:text-blue-400 transition">
                                            <i class="fa-solid fa-pen-to-square"></i>
                                        </button>

                                        <button class="text-gray-500 hover:text-red-400 transition">
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

        </div>

    </main>
</div>

</body>
</html>
