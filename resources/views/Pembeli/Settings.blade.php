    <!DOCTYPE html>
    <html lang="id">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Ticketify | Account Settings</title>
        <script src="https://cdn.tailwindcss.com"></script>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
        <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
        <style>
            @import url('https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;600;700;800&display=swap');
            body { font-family: 'Plus Jakarta Sans', sans-serif; }
            .glass { background: rgba(15, 15, 15, 0.7); backdrop-filter: blur(12px); }
        </style>
    </head>
    <body class="bg-[#09090b] text-white antialiased">

        <div class="flex max-w-[1600px] mx-auto min-h-screen bg-[#09090b]">

            <!-- SIDEBAR PEMBELI -->
            <aside class="w-64 hidden lg:flex flex-col sticky top-0 h-screen border-r border-white/5 p-6 justify-between bg-[#09090b]">
                <div class="space-y-6 w-full">
                    <div class="flex items-center gap-2 mb-6">
                        <div class="w-8 h-8 bg-blue-600 rounded-lg flex items-center justify-center font-bold text-white shadow-lg shadow-blue-600/30">T</div>
                        <span class="font-extrabold text-xl tracking-tight uppercase text-white">Ticketify</span>
                    </div>

                    <nav class="space-y-1">
                        <p class="text-[10px] font-black text-gray-500 uppercase tracking-widest mb-3 border-b border-white/5 pb-2">Home</p>
                        <a href="{{ route('pembeli.event') }}" class="flex items-center gap-3 p-3 hover:bg-white/5 rounded-xl text-sm text-gray-400 hover:text-white transition">
                            <i class="fa-solid fa-house w-5 text-center"></i> Event
                        </a>
                        <a href="{{ route('pembeli.about') }}" class="flex items-center gap-3 p-3 hover:bg-white/5 rounded-xl text-sm text-gray-400 hover:text-white transition">
                            <i class="fa-solid fa-compass w-5 text-center"></i> About Us
                        </a>
                        <a href="{{ route('pembeli.myticket') }}" class="flex items-center gap-3 p-3 hover:bg-white/5 rounded-xl text-sm text-gray-400 hover:text-white transition">
                            <i class="fa-solid fa-ticket w-5 text-center"></i> My Tickets
                        </a>
                    </nav>

                    <nav class="space-y-1 pt-2">
                        <p class="text-[10px] font-black text-gray-500 uppercase tracking-widest mb-3 border-b border-white/5 pb-2">Lainnya</p>
                        <a href="{{ route('pembeli.settings') }}" class="flex items-center gap-3 p-3 bg-blue-600 rounded-xl font-bold text-sm transition text-white shadow-lg shadow-blue-600/20">
                            <i class="fa-solid fa-gear w-5 text-center"></i> Settings
                        </a>
                        <a href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" class="flex items-center gap-3 p-3 hover:bg-white/5 rounded-xl text-sm text-rose-500 font-medium transition">
                            <i class="fa-solid fa-power-off w-5 text-center"></i> Logout
                        </a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="hidden">@csrf</form>
                    </nav>
                </div>

                <div class="flex items-center gap-3 pt-4 border-t border-white/5 w-full">
                    <div class="w-9 h-9 rounded-full bg-blue-600 flex items-center justify-center font-bold text-white text-sm shrink-0">
                        {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                    </div>
                    <div class="min-w-0 flex-1">
                        <p class="text-xs font-bold text-white truncate">{{ auth()->user()->name }}</p>
                        <p class="text-[10px] font-bold text-blue-400 uppercase tracking-wider mt-0.5">Pembeli</p>
                    </div>
                </div>
            </aside>

            <!-- MAIN CONTENT -->
            <div class="flex-1 flex flex-col min-w-0">
                <nav class="sticky top-0 z-50 glass border-b border-white/5 px-8 py-4 flex justify-between items-center">
                    <span class="text-sm text-gray-400 font-medium italic tracking-tight">Personalize your experience.</span>
                    <div class="w-10 h-10 rounded-full bg-blue-600 flex items-center justify-center font-black text-white">
                        {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                    </div>
                </nav>

                <main class="p-8 max-w-4xl mx-auto w-full" x-data="{ activeTab: 'profile' }">
                    <header class="mb-8">
                        <h1 class="text-3xl font-black tracking-tight">Account Settings</h1>
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

                    @if($errors->any())
                        <div class="mb-6 p-4 bg-red-500/10 border border-red-500/20 text-red-400 rounded-2xl text-sm max-w-4xl">
                            <ul class="list-disc list-inside space-y-1">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <div class="bg-[#121212] p-8 rounded-[2.5rem] border border-white/5 max-w-4xl shadow-2xl">

                        <div x-show="activeTab === 'profile'" x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0 transform scale-95">
                            <form action="{{ route('pembeli.settings.update_profile') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                @method('PUT')

                                <div class="flex items-center gap-6 mb-8">
                                    <div class="relative w-24 h-24 group">
                                        <img id="preview"
                                             src="{{ auth()->user()->profile_picture ? asset('storage/' . auth()->user()->profile_picture) : 'https://ui-avatars.com/api/?name=' . urlencode(auth()->user()->name) . '&background=2563eb&color=fff' }}"
                                             class="w-full h-full object-cover rounded-full border-2 border-white/10 group-hover:border-blue-500/50 transition-all duration-300"
                                             alt="Profile Picture">
                                        <label for="profile_picture" class="absolute bottom-0 right-0 bg-blue-500 hover:bg-blue-600 p-2 rounded-full text-white text-xs cursor-pointer shadow-lg shadow-blue-500/20 transition-all duration-200">
                                            <i class="fa-solid fa-pen"></i>
                                        </label>
                                        <input type="file" id="profile_picture" name="profile_picture" class="hidden" accept="image/*" onchange="previewImage(event)">
                                    </div>
                                    <div>
                                        <h4 class="text-sm font-bold text-gray-200">Profile Picture</h4>
                                        <p class="text-xs text-gray-500 mt-1">Format: JPG, PNG. Max 2MB.</p>
                                        @error('profile_picture')
                                            <span class="text-xs text-red-500 mt-1 block font-medium">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                                    <div>
                                        <label class="block text-[10px] text-gray-500 font-black uppercase tracking-widest mb-2">Full Name</label>
                                        <input type="text" name="name" value="{{ old('name', auth()->user()->name) }}"
                                               placeholder="Enter your full name"
                                               class="w-full bg-[#121212] border border-white/5 rounded-xl px-4 py-3 text-sm text-white focus:outline-none focus:border-blue-500 transition duration-200">
                                        @error('name') <span class="text-xs text-red-500 mt-1 block font-medium">{{ $message }}</span> @enderror
                                    </div>

                                    <div>
                                        <label class="block text-[10px] text-gray-400 font-black uppercase tracking-widest mb-2">NIM</label>
                                        <input type="text" name="nim" value="{{ old('nim', auth()->user()->nim) }}"
                                               placeholder="Enter your NIM"
                                               class="w-full bg-[#1c1c1e] border border-white/5 rounded-xl px-4 py-3 text-sm text-gray-400 opacity-60" readonly>
                                    </div>
                                </div>

                                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                                    <div>
                                        <label class="block text-[10px] text-gray-500 font-black uppercase tracking-widest mb-2">Email Address</label>
                                        <input type="email" name="email" value="{{ old('email', auth()->user()->email) }}"
                                               placeholder="contoh@email.com"
                                               class="w-full bg-[#121212] border border-white/5 rounded-xl px-4 py-3 text-sm text-white focus:outline-none focus:border-blue-500 transition duration-200">
                                        @error('email') <span class="text-xs text-red-500 mt-1 block font-medium">{{ $message }}</span> @enderror
                                    </div>

                                    <div>
                                        <label class="block text-[10px] text-gray-500 font-black uppercase tracking-widest mb-2">Phone Number</label>
                                        <input type="text" name="phone_number" value="{{ old('phone_number', auth()->user()->phone_number) }}"
                                               placeholder="0812345567"
                                               class="w-full bg-[#121212] border border-white/5 rounded-xl px-4 py-3 text-sm text-white focus:outline-none focus:border-blue-500 transition duration-200">
                                        @error('phone_number') <span class="text-xs text-red-500 mt-1 block font-medium">{{ $message }}</span> @enderror
                                    </div>
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

                                <div class="max-w-xl space-y-6">
                                    <div>
                                        <label class="block text-[10px] text-gray-500 font-black uppercase tracking-widest mb-2">Old Password</label>
                                        <input type="password" name="old_password" placeholder="Enter your current password"
                                               class="w-full bg-[#121212] border border-white/5 rounded-xl px-4 py-3 text-sm text-white focus:outline-none focus:border-blue-500 transition duration-200">
                                        @error('old_password') <span class="text-xs text-red-500 mt-1 block font-medium">{{ $message }}</span> @enderror
                                    </div>

                                    <div>
                                        <label class="block text-[10px] text-gray-500 font-black uppercase tracking-widest mb-2">New Password</label>
                                        <input type="password" name="password" placeholder="Minimal 8 characters"
                                               class="w-full bg-[#121212] border border-white/5 rounded-xl px-4 py-3 text-sm text-white focus:outline-none focus:border-blue-500 transition duration-200">
                                        @error('password') <span class="text-xs text-red-500 mt-1 block font-medium">{{ $message }}</span> @enderror
                                    </div>

                                    <div>
                                        <label class="block text-[10px] text-gray-500 font-black uppercase tracking-widest mb-2">Confirm New Password</label>
                                        <input type="password" name="password_confirmation" placeholder="Repeat new password"
                                               class="w-full bg-[#121212] border border-white/5 rounded-xl px-4 py-3 text-sm text-white focus:outline-none focus:border-blue-500 transition duration-200">
                                    </div>

                                    <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-bold text-xs uppercase tracking-widest px-6 py-3.5 rounded-xl shadow-lg shadow-blue-600/10 transition duration-200">
                                        Update Password
                                    </button>
                                </div>
                            </form>
                        </div>

                    </div>
                </main>
            </div>
        </div>

    <script>
        function previewImage(event) {
            const reader = new FileReader();
            reader.onload = function(){
                const output = document.getElementById('preview');
                output.src = reader.result;
            }
            if(event.target.files[0]) {
                reader.readAsDataURL(event.target.files[0]);
            }
        }
    </script>
</body>
</html>
