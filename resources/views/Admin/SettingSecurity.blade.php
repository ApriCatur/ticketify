<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Settings</title>

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
                <h2 class="text-3xl font-bold text-slate-900">Settings</h2>
                <p class="text-slate-500">Manage your profile and security</p>
            </div>

            <div class="flex items-center gap-3">
                <span class="font-medium text-slate-700">Your Name</span>
                <div class="w-10 h-10 rounded-full bg-slate-900"></div>
            </div>
        </div>


        <!-- Tabs -->
        <div class="flex gap-4 mb-8">
            <button class="px-6 py-3 rounded-2xl bg-slate-900 text-white font-medium">
                Edit Profile
            </button>

            <button class="px-6 py-3 rounded-2xl bg-white border border-slate-200 text-slate-700 hover:bg-slate-50 transition">
                Security
            </button>
        </div>


        <!-- Content -->
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">

            <!-- Profile Card -->
            <div class="bg-white border border-slate-200 rounded-3xl p-8 shadow-sm">
                <div class="flex flex-col items-center mb-8">
                    <div class="w-36 h-36 rounded-full bg-slate-100 flex items-center justify-center mb-4">
                        <i class="fa-regular fa-user text-5xl text-slate-400"></i>
                    </div>

                    <h3 class="text-2xl font-bold">Your Name</h3>
                </div>

                <div class="space-y-5">
                    <div>
                        <label class="block text-sm text-slate-500 mb-2">Email</label>
                        <input type="email" value="admin@email.com"
                            class="w-full border border-slate-200 rounded-2xl px-4 py-3 outline-none focus:ring-2 focus:ring-slate-300">
                    </div>

                    <div>
                        <label class="block text-sm text-slate-500 mb-2">Phone Number</label>
                        <input type="text" value="+62 812 3456 7890"
                            class="w-full border border-slate-200 rounded-2xl px-4 py-3 outline-none focus:ring-2 focus:ring-slate-300">
                    </div>

                    <div>
                        <label class="block text-sm text-slate-500 mb-2">Password</label>
                        <input type="password" value="********"
                            class="w-full border border-slate-200 rounded-2xl px-4 py-3 outline-none focus:ring-2 focus:ring-slate-300">
                    </div>
                </div>
            </div>


            <!-- Security Form -->
            <div class="bg-white border border-slate-200 rounded-3xl p-8 shadow-sm">
                <h3 class="text-xl font-bold mb-8">Security</h3>

                <div class="space-y-6">

                    <div>
                        <label class="block text-sm text-slate-500 mb-2">Old Password</label>
                        <div class="relative">
                            <input type="password"
                                class="w-full border border-slate-200 rounded-2xl px-4 py-3 pr-12 outline-none focus:ring-2 focus:ring-slate-300">
                            <i class="fa-solid fa-pen absolute right-4 top-1/2 -translate-y-1/2 text-slate-400"></i>
                        </div>
                    </div>

                    <div>
                        <label class="block text-sm text-slate-500 mb-2">New Password</label>
                        <div class="relative">
                            <input type="password"
                                class="w-full border border-slate-200 rounded-2xl px-4 py-3 pr-12 outline-none focus:ring-2 focus:ring-slate-300">
                            <i class="fa-solid fa-pen absolute right-4 top-1/2 -translate-y-1/2 text-slate-400"></i>
                        </div>
                    </div>

                    <div>
                        <label class="block text-sm text-slate-500 mb-2">Confirm Password</label>
                        <div class="relative">
                            <input type="password"
                                class="w-full border border-slate-200 rounded-2xl px-4 py-3 pr-12 outline-none focus:ring-2 focus:ring-slate-300">
                            <i class="fa-solid fa-pen absolute right-4 top-1/2 -translate-y-1/2 text-slate-400"></i>
                        </div>
                    </div>

                    <div class="pt-6 flex justify-end">
                        <button class="bg-slate-900 text-white px-8 py-3 rounded-2xl hover:bg-slate-800 transition">
                            Save
                        </button>
                    </div>

                </div>
            </div>

        </div>

    </main>
</div>

</body>
</html>
