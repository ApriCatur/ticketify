<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ticketify | Account Settings</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;600;700;800&display=swap');
        body { font-family: 'Plus Jakarta Sans', sans-serif; }
        .glass { background: rgba(15, 15, 15, 0.7); backdrop-filter: blur(12px); }
        .tab-active { border-bottom: 2px solid #2563eb; color: white; font-weight: 700; }
    </style>
</head>
<body class="bg-[#0b0c10] text-[#c5c6c7] antialiased">

    <div class="flex max-w-[1600px] mx-auto min-h-screen bg-[#0b0c10]">

        <!-- SIDEBAR PEMBELI (Sama persis seperti image_873b42.png) -->
        <aside class="w-64 hidden lg:flex flex-col sticky top-0 h-screen border-r border-white/5 p-6 justify-between bg-[#0b0c10]">
            <div class="space-y-6 w-full">
                <!-- LOGO -->
                <div class="flex items-center gap-2 mb-6">
                    <div class="w-8 h-8 bg-blue-600 rounded-lg flex items-center justify-center font-bold text-white shadow-lg shadow-blue-600/30">T</div>
                    <span class="font-extrabold text-xl tracking-tight uppercase text-white">Ticketify</span>
                </div>
                
                <!-- GROUP MENU: HOME -->
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

                <!-- GROUP MENU: LAINNYA -->
                <nav class="space-y-1 pt-2">
                    <p class="text-[10px] font-black text-gray-500 uppercase tracking-widest mb-3 border-b border-white/5 pb-2">Lainnya</p>
                    <!-- Settings Aktif Berwarna Biru -->
                    <a href="{{ route('pembeli.settings') }}" class="flex items-center gap-3 p-3 bg-blue-600 rounded-xl font-bold text-sm transition text-white shadow-lg shadow-blue-600/20">
                        <i class="fa-solid fa-gear w-5 text-center"></i> Settings
                    </a>
                    <!-- Tombol Logout dengan Trigger Form POST -->
                    <a href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" class="flex items-center gap-3 p-3 hover:bg-white/5 rounded-xl text-sm text-rose-500 font-medium transition">
                        <i class="fa-solid fa-power-off w-5 text-center"></i> Logout
                    </a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="hidden">
                        @csrf
                    </form>
                </nav>
            </div>

            <!-- USER PROFILE BADGE -->
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
            <!-- NAVBAR -->
            <nav class="sticky top-0 z-50 glass border-b border-white/5 px-8 py-4 flex justify-between items-center">
                <span class="text-sm text-gray-400 font-medium italic tracking-tight">Personalize your experience.</span>
                <div class="w-10 h-10 rounded-full bg-blue-600 flex items-center justify-center font-black text-white">
                    {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                </div>
            </nav>

            <main class="p-8 max-w-4xl mx-auto w-full">
                <!-- HEADER -->
                <header class="mb-6">
                    <h2 class="text-3xl font-bold tracking-tight text-white">Account Settings</h2>
                    <p class="text-sm text-gray-400 mt-1">Kelola informasi profil dan keamanan akun kamu.</p>
                </header>

                <!-- TABS -->
                <div class="flex gap-6 border-b border-white/5 mb-6">
                    <button onclick="switchTab('profile')" id="tab-profile" class="pb-3 text-sm font-semibold transition tab-active text-white">Profile Details</button>
                    <button onclick="switchTab('security')" id="tab-security" class="pb-3 text-sm font-medium text-gray-400 hover:text-white transition">Security</button>
                </div>

                <!-- ALERTS -->
                @if(session('success'))
                    <div class="mb-6 p-4 bg-emerald-500/10 border border-emerald-500/20 text-emerald-400 rounded-xl text-sm font-semibold">
                        {{ session('success') }}
                    </div>
                @endif

                @if($errors->any())
                    <div class="mb-6 p-4 bg-rose-500/10 border border-rose-500/20 text-rose-400 rounded-xl text-sm list-none space-y-1">
                        @foreach ($errors->all() as $error)
                            <li><i class="fa-solid fa-circle-exclamation mr-2"></i>{{ $error }}</li>
                        @endforeach
                    </div>
                @endif

                <!-- CONTENT PROFILE DETAILS -->
                <div id="content-profile" class="bg-[#1f2833]/40 border border-white/5 rounded-2xl p-8 shadow-xl animate-in fade-in duration-300">
                    <form action="{{ route('pembeli.settings.update_profile') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                        @csrf
                        @method('PUT')
                        
                        <!-- PROFILE PICTURE COMPONENT -->
                        <div class="flex items-center gap-6 mb-8">
                            <div class="relative w-24 h-24 rounded-full bg-gray-800 border border-white/10 flex items-center justify-center group">
                                <img id="preview" src="{{ auth()->user()->photo ? asset('storage/' . auth()->user()->photo) : 'https://ui-avatars.com/api/?name=' . urlencode(auth()->user()->name) . '&background=2563eb&color=fff' }}" class="w-full h-full object-cover rounded-full">
                                <label class="absolute bottom-0 right-0 w-8 h-8 bg-blue-600 rounded-full border-2 border-[#0b0c10] flex items-center justify-center cursor-pointer hover:bg-blue-500 transition shadow-lg">
                                    <i class="fa-solid fa-pencil text-white text-xs"></i>
                                    <input type="file" name="photo" class="hidden" onchange="previewImage(event)">
                                </label>
                            </div>
                            <div>
                                <h4 class="text-sm font-bold text-white mb-1">Profile Picture</h4>
                                <p class="text-xs text-gray-500">Format: JPG, PNG. Max 2MB.</p>
                            </div>
                        </div>

                        <!-- INPUT GRIDS -->
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label class="text-[10px] font-bold text-gray-400 uppercase tracking-wider ml-1 mb-2 block">Full Name</label>
                                <input type="text" name="name" value="{{ old('name', auth()->user()->name) }}" class="w-full bg-[#121212]/60 border border-white/10 rounded-xl px-4 py-3 text-sm text-white focus:border-blue-500 focus:ring-1 focus:ring-blue-500 outline-none transition">
                            </div>
                            
                            <div>
                                <label class="text-[10px] font-bold text-gray-400 uppercase tracking-wider ml-1 mb-2 block">NIM</label>
                                <input type="text" name="nim" value="{{ auth()->user()->nim ?? '-' }}" class="w-full bg-[#121212]/30 border border-white/5 rounded-xl px-4 py-3 text-sm text-gray-500 outline-none cursor-not-allowed" readonly>
                            </div>

                            <div>
                                <label class="text-[10px] font-bold text-gray-400 uppercase tracking-wider ml-1 mb-2 block">Phone Number</label>
                                <input type="text" name="phone_number" value="{{ old('phone_number', auth()->user()->phone_number) }}" class="w-full bg-[#121212]/60 border border-white/10 rounded-xl px-4 py-3 text-sm text-white focus:border-blue-500 focus:ring-1 focus:ring-blue-500 outline-none transition">
                            </div>
                        </div>

                        <div class="pt-4">
                            <button type="submit" class="px-6 py-3 bg-blue-600 hover:bg-blue-500 text-white rounded-xl font-bold text-xs uppercase tracking-wider transition-all shadow-lg shadow-blue-600/20 active:scale-95">
                                Save Changes
                            </button>
                        </div>
                    </form>
                </div>

                <!-- CONTENT SECURITY -->
                <div id="content-security" class="hidden bg-[#1f2833]/40 border border-white/5 rounded-2xl p-8 shadow-xl animate-in fade-in duration-300">
                    <form action="{{ route('pembeli.settings.update-password') }}" method="POST" class="space-y-6">
                        @csrf
                        @method('PUT')
                        
                        <div class="max-w-xl space-y-6">
                            <div>
                                <label class="text-[10px] font-bold text-gray-400 uppercase tracking-wider ml-1 mb-2 block">Old Password</label>
                                <input type="password" name="old_password" placeholder="Enter your current password" class="w-full bg-[#121212]/60 border border-white/10 rounded-xl px-4 py-3 text-sm text-white placeholder-gray-600 focus:border-blue-500 focus:ring-1 focus:ring-blue-500 outline-none transition">
                            </div>

                            <div>
                                <label class="text-[10px] font-bold text-gray-400 uppercase tracking-wider ml-1 mb-2 block">New Password</label>
                                <input type="password" name="password" placeholder="Minimal 8 characters" class="w-full bg-[#121212]/60 border border-white/10 rounded-xl px-4 py-3 text-sm text-white placeholder-gray-600 focus:border-blue-500 focus:ring-1 focus:ring-blue-500 outline-none transition">
                            </div>

                            <div>
                                <label class="text-[10px] font-bold text-gray-400 uppercase tracking-wider ml-1 mb-2 block">Confirm New Password</label>
                                <input type="password" name="password_confirmation" placeholder="Repeat new password" class="w-full bg-[#121212]/60 border border-white/10 rounded-xl px-4 py-3 text-sm text-white placeholder-gray-600 focus:border-blue-500 focus:ring-1 focus:ring-blue-500 outline-none transition">
                            </div>

                            <div class="pt-2">
                                <button type="submit" class="px-6 py-3 bg-blue-600 hover:bg-blue-500 text-white rounded-xl font-bold text-xs uppercase tracking-wider transition-all shadow-lg shadow-blue-600/20 active:scale-95">
                                    Update Password
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </main>
        </div>
    </div>

    <!-- JAVASCRIPT -->
    <script>
        function switchTab(tab) {
            const profileContent = document.getElementById('content-profile');
            const securityContent = document.getElementById('content-security');
            const tabProfile = document.getElementById('tab-profile');
            const tabSecurity = document.getElementById('tab-security');

            if (tab === 'profile') {
                profileContent.classList.remove('hidden');
                securityContent.classList.add('hidden');
                tabProfile.className = 'pb-3 text-sm font-semibold transition tab-active text-white';
                tabSecurity.className = 'pb-3 text-sm font-medium text-gray-400 hover:text-white transition';
            } else {
                profileContent.classList.add('hidden');
                securityContent.classList.remove('hidden');
                tabProfile.className = 'pb-3 text-sm font-medium text-gray-400 hover:text-white transition';
                tabSecurity.className = 'pb-3 text-sm font-semibold transition tab-active text-white';
            }
        }

        function previewImage(event) {
            const reader = new FileReader();
            reader.onload = function() {
                const output = document.getElementById('preview');
                output.src = reader.result;
            }
            reader.readAsDataURL(event.target.files[0]);
        }
    </script>
</body>
</html>