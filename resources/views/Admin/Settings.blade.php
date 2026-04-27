@extends('layouts.admin')

@section('title', 'Settings')

@section('content')

<div x-data="{ activeTab: 'profile' }" class="p-8">

    <!-- Header -->
    <header class="mb-8">
        <h1 class="text-3xl font-black tracking-tight">Account Settings</h1>
        <p class="text-gray-500 text-sm mt-2">
            Kelola informasi profil dan keamanan akun kamu.
        </p>
    </header>

    <!-- Tabs -->
    <div class="flex gap-6 mb-8 border-b border-white/5">
        <button @click="activeTab = 'profile'"
            :class="activeTab === 'profile'
                ? 'border-b-2 border-blue-500 text-blue-500'
                : 'text-gray-500 hover:text-white'"
            class="pb-4 px-2 text-sm font-bold transition-all">
            Profile Details
        </button>

        <button @click="activeTab = 'security'"
            :class="activeTab === 'security'
                ? 'border-b-2 border-blue-500 text-blue-500'
                : 'text-gray-500 hover:text-white'"
            class="pb-4 px-2 text-sm font-bold transition-all">
            Security
        </button>
    </div>

    <!-- Card -->
    <div class="bg-[#1e1e1e] rounded-3xl p-8 border border-white/5 shadow-2xl max-w-4xl">

        <!-- PROFILE -->
        <div x-show="activeTab === 'profile'" x-transition>
            <form class="space-y-8">

                <!-- Avatar -->
                <div class="flex items-center gap-6 pb-8 border-b border-white/5">
                    <div class="relative">
                        <div class="w-24 h-24 bg-[#18181b] border border-white/10 rounded-full flex items-center justify-center overflow-hidden">
                            <i class="fa-solid fa-user text-3xl text-gray-700"></i>
                        </div>

                        <label class="absolute bottom-0 right-0 w-8 h-8 bg-blue-600 text-white rounded-full flex items-center justify-center text-xs cursor-pointer hover:bg-blue-700 border-4 border-[#121212]">
                            <i class="fa-solid fa-pen"></i>
                            <input type="file" class="hidden">
                        </label>
                    </div>

                    <div>
                        <h3 class="font-bold">Profile Picture</h3>
                        <p class="text-xs text-gray-500 mt-1">
                            Format: JPG, PNG. Max 2MB.
                        </p>
                    </div>
                </div>

                <!-- Form -->
                <div class="grid md:grid-cols-2 gap-6">

                    <div class="space-y-2">
                        <label class="text-[10px] font-bold text-gray-500 uppercase tracking-widest">
                            Full Name
                        </label>
                        <input type="text" class="w-full bg-[#18181b] border border-white/5 rounded-xl px-4 py-3 text-sm focus:border-blue-500">
                    </div>

                    <div class="space-y-2">
                        <label class="text-[10px] font-bold text-gray-500 uppercase tracking-widest">
                            Email
                        </label>
                        <input type="email" class="w-full bg-[#18181b] border border-white/5 rounded-xl px-4 py-3 text-sm focus:border-blue-500">
                    </div>

                    <div class="space-y-2 md:col-span-2">
                        <label class="text-[10px] font-bold text-gray-500 uppercase tracking-widest">
                            Phone
                        </label>
                        <input type="text" class="w-full bg-[#18181b] border border-white/5 rounded-xl px-4 py-3 text-sm focus:border-blue-500">
                    </div>

                </div>

                <button class="bg-blue-600 hover:bg-blue-700 px-8 py-3 rounded-xl font-bold text-sm shadow-lg">
                    Save Changes
                </button>

            </form>
        </div>

        <!-- SECURITY -->
        <div x-show="activeTab === 'security'" x-transition class="max-w-lg" style="display:none;">
            <form class="space-y-6">

                <div class="space-y-2">
                    <label class="text-[10px] font-bold text-gray-500 uppercase">
                        Old Password
                    </label>
                    <input type="password" class="w-full bg-[#18181b] border border-white/5 rounded-xl px-4 py-3 text-sm focus:border-blue-500">
                </div>

                <div class="space-y-2">
                    <label class="text-[10px] font-bold text-gray-500 uppercase">
                        New Password
                    </label>
                    <input type="password" class="w-full bg-[#18181b] border border-white/5 rounded-xl px-4 py-3 text-sm focus:border-blue-500">
                </div>

                <div class="space-y-2">
                    <label class="text-[10px] font-bold text-gray-500 uppercase">
                        Confirm Password
                    </label>
                    <input type="password" class="w-full bg-[#18181b] border border-white/5 rounded-xl px-4 py-3 text-sm focus:border-blue-500">
                </div>

                <button class="bg-blue-600 hover:bg-blue-700 px-8 py-3 rounded-xl font-bold text-sm shadow-lg">
                    Update Password
                </button>

            </form>
        </div>

    </div>

</div>

@endsection
