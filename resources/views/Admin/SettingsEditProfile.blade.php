<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Settings - Ticketify</title>

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
                <h2 class="text-3xl font-bold text-slate-900">Settings</h2>
                <p class="text-slate-500">Manage your profile and account</p>
            </div>

            <div class="flex items-center gap-3">
                <span class="font-medium text-slate-700">Admin</span>
                <div class="w-10 h-10 rounded-full bg-slate-900"></div>
            </div>
        </div>

        <!-- Tabs -->
        <div class="flex gap-3 mb-6">
            <button class="px-5 py-2 rounded-xl bg-slate-900 text-white text-sm font-medium">
                Edit Profile
            </button>
            <button class="px-5 py-2 rounded-xl bg-white border border-slate-200 text-slate-600 text-sm hover:bg-slate-100">
                Security
            </button>
        </div>

        <!-- Content -->
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">

            <!-- LEFT PROFILE -->
            <div class="bg-white rounded-3xl border border-slate-200 p-8 shadow-sm text-center">

                <div class="w-40 h-40 mx-auto rounded-full bg-slate-200 flex items-center justify-center mb-6">
                    <i class="fa-solid fa-user text-5xl text-slate-500"></i>
                </div>

                <h3 class="text-2xl font-bold text-slate-900 mb-6">Your Name</h3>

                <div class="text-left space-y-4">
                    <div>
                        <label class="text-sm text-slate-500">Email</label>
                        <input type="text" class="w-full mt-1 px-4 py-2 rounded-xl border border-slate-200 bg-slate-50">
                    </div>

                    <div>
                        <label class="text-sm text-slate-500">Phone Number</label>
                        <input type="text" class="w-full mt-1 px-4 py-2 rounded-xl border border-slate-200 bg-slate-50">
                    </div>

                    <div>
                        <label class="text-sm text-slate-500">Password</label>
                        <input type="password" value="********" class="w-full mt-1 px-4 py-2 rounded-xl border border-slate-200 bg-slate-50">
                    </div>
                </div>
            </div>

            <!-- RIGHT FORM -->
            <div class="bg-white rounded-3xl border border-slate-200 p-8 shadow-sm">

                <form action="#" method="POST">
                    @csrf

                    <div class="space-y-5">

                        <div>
                            <label class="text-sm text-slate-500">Your Name</label>
                            <div class="flex items-center gap-2">
                                <input type="text" name="name" class="w-full mt-1 px-4 py-2 rounded-xl border border-slate-200">
                                <i class="fa-solid fa-pen text-slate-400"></i>
                            </div>
                        </div>

                        <div>
                            <label class="text-sm text-slate-500">Email</label>
                            <div class="flex items-center gap-2">
                                <input type="email" name="email" class="w-full mt-1 px-4 py-2 rounded-xl border border-slate-200">
                                <i class="fa-solid fa-pen text-slate-400"></i>
                            </div>
                        </div>

                        <div>
                            <label class="text-sm text-slate-500">Phone Number</label>
                            <div class="flex items-center gap-2">
                                <input type="text" name="phone" class="w-full mt-1 px-4 py-2 rounded-xl border border-slate-200">
                                <i class="fa-solid fa-pen text-slate-400"></i>
                            </div>
                        </div>

                        <!-- Upload -->
                        <div class="flex items-center gap-4 mt-4">
                            <div class="w-14 h-14 rounded-full bg-slate-200 flex items-center justify-center">
                                <i class="fa-solid fa-user text-slate-500"></i>
                            </div>

                            <input type="file" name="photo" class="text-sm">
                        </div>

                        <!-- Save -->
                        <div class="flex justify-end pt-6">
                            <button type="submit" class="px-6 py-2 rounded-xl bg-slate-900 text-white hover:bg-slate-800">
                                Save
                            </button>
                        </div>

                    </div>
                </form>

            </div>

        </div>

    </main>
</div>
</body>
</html>
