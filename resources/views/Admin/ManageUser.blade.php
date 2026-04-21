<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Users Management</title>

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
                <h2 class="text-3xl font-bold text-slate-900">Users</h2>
                <p class="text-slate-500">Manage all users in the platform</p>
            </div>

            <div class="flex items-center gap-3">
                <span class="font-medium text-slate-700">Admin</span>
                <div class="w-10 h-10 rounded-full bg-slate-900"></div>
            </div>
        </div>


        <!-- Statistics -->
        <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">

            <div class="bg-white p-6 rounded-3xl border border-slate-200 shadow-sm">
                <p class="text-slate-500">Total Users</p>
                <h3 class="text-4xl font-bold mt-2 text-slate-900">67</h3>
            </div>

            <div class="bg-white p-6 rounded-3xl border border-slate-200 shadow-sm">
                <p class="text-slate-500">Admins</p>
                <h3 class="text-4xl font-bold mt-2 text-slate-700">1</h3>
            </div>

            <div class="bg-white p-6 rounded-3xl border border-slate-200 shadow-sm">
                <p class="text-slate-500">Organizers</p>
                <h3 class="text-4xl font-bold mt-2 text-slate-600">3</h3>
            </div>

            <div class="bg-white p-6 rounded-3xl border border-slate-200 shadow-sm">
                <p class="text-slate-500">Customers</p>
                <h3 class="text-4xl font-bold mt-2 text-slate-500">63</h3>
            </div>

        </div>


        <!-- Table Section -->
        <div class="bg-white rounded-3xl border border-slate-200 shadow-sm p-6">

            <!-- Search & Add -->
            <div class="flex flex-col md:flex-row justify-between gap-4 mb-6">
                <div class="flex items-center border border-slate-200 rounded-2xl px-4 w-full md:w-80">
                    <i class="fa-solid fa-magnifying-glass text-slate-400 mr-2"></i>
                    <input type="text" placeholder="Search user..."
                        class="w-full py-3 outline-none bg-transparent">
                </div>

                <button class="bg-slate-900 text-white px-6 py-3 rounded-2xl hover:bg-slate-800 transition">
                    <i class="fa-solid fa-plus mr-2"></i>
                    Add User
                </button>
            </div>


            <!-- Table -->
            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead>
                        <tr class="border-b border-slate-200 text-left text-slate-500">
                            <th class="py-3">No</th>
                            <th class="py-3">Name</th>
                            <th class="py-3">Email</th>
                            <th class="py-3">Role</th>
                            <th class="py-3 text-center">Actions</th>
                        </tr>
                    </thead>

                    <tbody class="divide-y divide-slate-100">
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
                        <tr class="hover:bg-slate-50 transition">
                            <td class="py-4">{{ $index + 1 }}</td>
                            <td class="py-4 font-medium">{{ $user[0] }}</td>
                            <td class="py-4 text-slate-500">{{ $user[1] }}</td>
                            <td class="py-4">{{ $user[2] }}</td>
                            <td class="py-4">
                                <div class="flex justify-center gap-4">
                                    <button class="text-slate-500 hover:text-slate-900 transition">
                                        <i class="fa-solid fa-pen-to-square"></i>
                                    </button>

                                    <button class="text-slate-400 hover:text-red-500 transition">
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
