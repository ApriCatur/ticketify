<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ticketify - Settings</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body class="bg-[#09090b] text-white flex" x-data="{ activeTab: 'profile' }">

    @include('layouts.sidebar-pembeli')


    <main class="flex-1 p-10">
        <div class="max-w-4xl">
            <header class="mb-8">
                <h1 class="text-3xl font-black tracking-tight">Account Settings</h1>
                <p class="text-gray-500 text-sm mt-2">Kelola informasi profil dan keamanan akun kamu.</p>
            </header>

            <div class="flex gap-6 mb-8 border-b border-white/5">
                <button @click="activeTab = 'profile'"
                        :class="activeTab === 'profile' ? 'border-b-2 border-blue-500 text-blue-500' : 'text-gray-500 hover:text-white'"
                        class="pb-4 px-2 text-sm font-bold transition-all">
                    Profile Details
                </button>
                <button @click="activeTab = 'security'"
                        :class="activeTab === 'security' ? 'border-b-2 border-blue-500 text-blue-500' : 'text-gray-500 hover:text-white'"
                        class="pb-4 px-2 text-sm font-bold transition-all">
                    Security
                </button>
            </div>

            <div class="bg-[#121212] rounded-3xl p-8 border border-white/5 shadow-2xl">

                <div x-show="activeTab === 'profile'" x-transition>
                    <form class="space-y-8">
                        <div class="flex items-center gap-6 pb-8 border-b border-white/5">
                            <div class="relative">
                                <div class="w-24 h-24 bg-[#18181b] border border-white/10 rounded-full flex items-center justify-center overflow-hidden">
                                    <i class="fa-solid fa-user text-3xl text-gray-700"></i>
                                    </div>
                                <label for="pic-upload" class="absolute bottom-0 right-0 w-8 h-8 bg-blue-600 text-white rounded-full flex items-center justify-center text-xs cursor-pointer hover:bg-blue-700 transition-all border-4 border-[#121212]">
                                    <i class="fa-solid fa-pen"></i>
                                    <input type="file" id="pic-upload" class="hidden">
                                </label>
                            </div>
                            <div>
                                <h3 class="font-bold">Profile Picture</h3>
                                <p class="text-xs text-gray-500 mt-1">Format: JPG, PNG. Max 2MB.</p>
                            </div>
                        </div>

                        <div class="grid md:grid-cols-2 gap-6">
                            <div class="space-y-2">
                                <label class="text-[10px] font-bold text-gray-500 uppercase tracking-widest ml-1">Full Name</label>
                                <input type="text" placeholder="Enter your full name" class="w-full bg-[#18181b] border border-white/5 rounded-xl px-4 py-3 text-sm focus:outline-none focus:border-blue-500 transition-all">
                            </div>
                            <div class="space-y-2">
                                <label class="text-[10px] font-bold text-gray-500 uppercase tracking-widest ml-1">Email Address</label>
                                <input type="email" placeholder="Enter your email address" class="w-full bg-[#18181b] border border-white/5 rounded-xl px-4 py-3 text-sm focus:outline-none focus:border-blue-500 transition-all">
                            </div>
                            <div class="space-y-2 md:col-span-2">
                                <label class="text-[10px] font-bold text-gray-500 uppercase tracking-widest ml-1">Phone Number</label>
                                <input type="text" placeholder="0812345567" class="w-full bg-[#18181b] border border-white/5 rounded-xl px-4 py-3 text-sm focus:outline-none focus:border-blue-500 transition-all">
                            </div>
                        </div>

                        <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-3 px-8 rounded-xl text-sm transition-all shadow-lg shadow-blue-600/20">
                            Save Changes
                        </button>
                    </form>
                </div>

                <div x-show="activeTab === 'security'" x-transition style="display: none;">
                    <form class="space-y-6 max-w-lg">
                        <div class="space-y-2">
                            <label class="text-[10px] font-bold text-gray-500 uppercase tracking-widest ml-1">Old Password</label>
                            <input type="password" class="w-full bg-[#18181b] border border-white/5 rounded-xl px-4 py-3 text-sm focus:outline-none focus:border-blue-500 transition-all">
                        </div>
                        <div class="space-y-2">
                            <label class="text-[10px] font-bold text-gray-500 uppercase tracking-widest ml-1">New Password</label>
                            <input type="password" class="w-full bg-[#18181b] border border-white/5 rounded-xl px-4 py-3 text-sm focus:outline-none focus:border-blue-500 transition-all">
                        </div>
                        <div class="space-y-2">
                            <label class="text-[10px] font-bold text-gray-500 uppercase tracking-widest ml-1">Confirm New Password</label>
                            <input type="password" class="w-full bg-[#18181b] border border-white/5 rounded-xl px-4 py-3 text-sm focus:outline-none focus:border-blue-500 transition-all">
                        </div>

                        <div class="pt-4">
                            <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-3 px-8 rounded-xl text-sm transition-all shadow-lg shadow-blue-600/20">
                                Update Password
                            </button>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </main>

</body>
</html>
