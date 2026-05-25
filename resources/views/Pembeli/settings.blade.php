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
<body class="bg-[#09090b] text-white flex">

    @include('layouts.sidebar-pembeli')

    <main class="flex-1 p-10 overflow-y-auto" x-data="{ activeTab: 'profile' }">
        <header class="mb-10">
            <div class="flex items-center gap-3">
                <button id="open-sidebar" class="lg:hidden text-gray-400 hover:text-blue-500 transition-colors mr-2">
                    <i class="fa-solid fa-bars-staggered text-2xl"></i>
                </button>
                <h1 class="text-3xl font-black tracking-tight">Account Settings</h1>
            </div>
            <p class="text-gray-500 text-sm mt-2">Kelola informasi profil dan keamanan akun kamu.</p>
        </header>

        <div class="flex gap-6 mb-6 border-b border-white/5 text-sm font-medium">
            <button @click="activeTab = 'profile'"
                    :class="activeTab === 'profile' ? 'text-blue-500 border-b-2 border-blue-500 pb-3 font-bold' : 'text-gray-400 hover:text-white pb-3'"
                    class="transition-all duration-200">
                Profile Details
            </button>
            <button @click="activeTab = 'security'"
                    :class="activeTab === 'security' ? 'text-blue-500 border-b-2 border-blue-500 pb-3 font-bold' : 'text-gray-400 hover:text-white pb-3'"
                    class="transition-all duration-200">
                Security
            </button>
        </div>

        @if(session('success'))
            <div class="mb-6 p-4 bg-emerald-500/10 border border-emerald-500/20 text-emerald-400 rounded-2xl text-sm flex items-center gap-3 max-w-4xl">
                <i class="fa-solid fa-circle-check text-base"></i>
                <span>{{ session('success') }}</span>
            </div>
        @endif

        <div class="bg-[#121212] p-8 rounded-[2.5rem] border border-white/5 max-w-4xl shadow-2xl">

            <div x-show="activeTab === 'profile'" x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0 transform scale-95">
                <form action="{{ route('pembeli.settings.update_profile') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="flex items-center gap-6 mb-8">
                        <div class="relative w-24 h-24 group">
                            <img id="avatar-preview"
                                 src="{{ auth()->user()->profile_picture ? asset('storage/' . auth()->user()->profile_picture) : 'https://cdn-icons-png.flaticon.com/512/149/149071.png' }}"
                                 class="w-full h-full object-cover rounded-full border-2 border-white/10 group-hover:border-blue-500/50 transition-all duration-300"
                                 alt="Profile Picture">

                            <label for="pic-upload" class="absolute bottom-0 right-0 bg-blue-500 hover:bg-blue-600 p-2 rounded-full text-white text-xs cursor-pointer shadow-lg shadow-blue-500/20 transition-all duration-200">
                                <i class="fa-solid fa-pen"></i>
                            </label>
                            <input type="file" id="pic-upload" name="profile_picture" class="hidden" accept="image/*" onchange="previewImage(event)">
                        </div>
                        <div>
                            <h4 class="text-sm font-bold text-gray-200">Profile Picture</h4>
                            <p class="text-xs text-gray-500 mt-1">Format: JPG, PNG. Max 2MB.</p>
                            @error('update_profile')
                                <span class="text-xs text-red-500 mt-1 block font-medium">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                        <div>
                            <label class="block text-[10px] text-gray-500 font-black uppercase tracking-widest mb-2">Full Name</label>
                            <input type="text" name="name" value="{{ old('name', auth()->user()->name) }}"
                                   placeholder="Enter your full name"
                                   class="w-full bg-[#121212] border border-white/5 rounded-xl px-4 py-3 text-sm text-white focus:outline-none focus:border-blue-500 transition duration-200" required>
                            @error('name') <span class="text-xs text-red-500 mt-1 block font-medium">{{ $message }}</span> @enderror
                        </div>

                        <div>
                            <label class="block text-[10px] text-gray-500 font-black uppercase tracking-widest mb-2">Email Address</label>
                            <input type="email" name="email" value="{{ old('email', auth()->user()->email) }}"
                                   placeholder="Enter your email address"
                                   class="w-full bg-[#121212] border border-white/5 rounded-xl px-4 py-3 text-sm text-white focus:outline-none focus:border-blue-500 transition duration-200" required>
                            @error('email') <span class="text-xs text-red-500 mt-1 block font-medium">{{ $message }}</span> @enderror
                        </div>
                    </div>

                    <div class="mb-8">
                        <label class="block text-[10px] text-gray-500 font-black uppercase tracking-widest mb-2">Phone Number</label>
                        <input type="text" name="phone_number" value="{{ old('phone_number', auth()->user()->phone_number) }}"
                               placeholder="0812345567"
                               class="w-full bg-[#121212] border border-white/5 rounded-xl px-4 py-3 text-sm text-white focus:outline-none focus:border-blue-500 transition duration-200">
                        @error('phone_number') <span class="text-xs text-red-500 mt-1 block font-medium">{{ $message }}</span> @enderror
                    </div>

                    <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-bold text-xs uppercase tracking-widest px-6 py-3.5 rounded-xl shadow-lg shadow-blue-600/10 transition duration-200">
                        Save Changes
                    </button>
                </form>
            </div>

            <div x-show="activeTab === 'security'" x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0 transform scale-95" style="display: none;">
                <form action="{{ route('pembeli.settings.update-password') }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="mb-6">
                        <label class="block text-[10px] text-gray-500 font-black uppercase tracking-widest mb-2">Old Password</label>
                        <input type="password" name="old_password" placeholder="Enter your current password"
                               class="w-full bg-[#121212] border border-white/5 rounded-xl px-4 py-3 text-sm text-white focus:outline-none focus:border-blue-500 transition duration-200" required>
                        @error('old_password') <span class="text-xs text-red-500 mt-1 block font-medium">{{ $message }}</span> @enderror
                    </div>

                    <div class="mb-6">
                        <label class="block text-[10px] text-gray-500 font-black uppercase tracking-widest mb-2">New Password</label>
                        <input type="password" name="password" placeholder="Minimal 8 characters"
                               class="w-full bg-[#121212] border border-white/5 rounded-xl px-4 py-3 text-sm text-white focus:outline-none focus:border-blue-500 transition duration-200" required>
                        @error('password') <span class="text-xs text-red-500 mt-1 block font-medium">{{ $message }}</span> @enderror
                    </div>

                    <div class="mb-8">
                        <label class="block text-[10px] text-gray-500 font-black uppercase tracking-widest mb-2">Confirm New Password</label>
                        <input type="password" name="password_confirmation" placeholder="Repeat new password"
                               class="w-full bg-[#121212] border border-white/5 rounded-xl px-4 py-3 text-sm text-white focus:outline-none focus:border-blue-500 transition duration-200" required>
                    </div>

                    <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-bold text-xs uppercase tracking-widest px-6 py-3.5 rounded-xl shadow-lg shadow-blue-600/10 transition duration-200">
                        Update Password
                    </button>
                </form>
            </div>

        </div>
    </main>

    <script>
        const openBtn = document.getElementById('open-sidebar');
        const closeBtn = document.getElementById('close-sidebar');
        const sidebar = document.getElementById('main-sidebar');
        const overlay = document.getElementById('sidebar-overlay');

        if (openBtn && sidebar) {
            function toggleSidebar() {
                sidebar.classList.toggle('-translate-x-full');
                if (overlay) overlay.classList.toggle('hidden');
                document.body.classList.toggle('overflow-hidden', !sidebar.classList.contains('-translate-x-full'));
            }
            openBtn.addEventListener('click', toggleSidebar);
            if (closeBtn) closeBtn.addEventListener('click', toggleSidebar);
            if (overlay) overlay.addEventListener('click', toggleSidebar);
        }

        function previewImage(event) {
            const reader = new FileReader();
            reader.onload = function(){
                const output = document.getElementById('avatar-preview');
                if (output) output.src = reader.result;
            }
            if(event.target.files[0]) {
                reader.readAsDataURL(event.target.files[0]);
            }
        }
    </script>
</body>
</html>
