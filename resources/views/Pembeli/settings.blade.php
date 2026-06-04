<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ticketify | Account Settings</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;600;800&display=swap');
        body { font-family: 'Plus Jakarta Sans', sans-serif; }
<<<<<<< HEAD
        .glass { background: rgba(18, 18, 18, 0.8); backdrop-filter: blur(10px); }
        .tab-active { border-bottom: 2px solid #3b82f6; color: white; }
=======
        .glass { background: rgba(11, 12, 16, 0.7); backdrop-filter: blur(12px); }
        .tab-active { border-bottom: 2px solid #2563eb; color: white; font-weight: 700; }
>>>>>>> 3b86639f527e2cfb3db211f1bcdfb9e42f746ab1
    </style>
</head>
<body class="bg-[#0f0f0f] text-white antialiased">

    <div class="flex max-w-[1600px] mx-auto min-h-screen border-x border-gray-800 bg-[#121212] shadow-2xl">

<<<<<<< HEAD
        <aside class="w-64 hidden lg:flex flex-col sticky top-0 h-screen border-r border-white/5 p-6 space-y-8">
            <div class="flex items-center gap-2 mb-4">
                <div class="w-8 h-8 bg-blue-500 rounded-lg flex items-center justify-center font-bold text-white">T</div>
                <span class="font-extrabold text-xl tracking-tight uppercase">Ticketify</span>
=======
        <aside class="w-64 hidden lg:flex flex-col sticky top-0 h-screen border-r border-white/5 p-6 justify-between bg-[#0b0c10]">
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
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="hidden">
                        @csrf
                    </form>
                </nav>
>>>>>>> 3b86639f527e2cfb3db211f1bcdfb9e42f746ab1
            </div>
            <nav class="space-y-1">
                <p class="text-[10px] font-black text-gray-500 uppercase tracking-widest mb-4 border-b border-white/5 pb-2">Menu</p>
                <a href="{{ route('event.index') }}" class="flex items-center gap-3 p-3 hover:bg-white/5 rounded-xl text-sm text-gray-400 hover:text-white transition">
                    <i class="fa-solid fa-house"></i> Event
                </a>

<<<<<<< HEAD
                <a href="#" class="flex items-center gap-3 p-3 bg-blue-500 rounded-xl font-bold text-sm transition text-white shadow-lg">
                    <i class="fa-solid fa-gear"></i> Settings
                </a>
            </nav>
        </aside>

        <div class="flex-1 flex flex-col min-w-0 border-r border-white/5">
=======
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

        <div class="flex-1 flex flex-col min-w-0">
>>>>>>> 3b86639f527e2cfb3db211f1bcdfb9e42f746ab1
            <nav class="sticky top-0 z-50 glass border-b border-white/5 px-8 py-4 flex justify-between items-center">
                <span class="text-sm text-gray-400 font-medium italic tracking-tight">Personalize your experience.</span>
                <div class="w-10 h-10 rounded-full bg-blue-500 flex items-center justify-center font-black">M</div>
            </nav>

<<<<<<< HEAD
            <main class="p-8 max-w-4xl">
                <header class="mb-10">
                    <h2 class="text-3xl font-black italic tracking-tighter uppercase italic">Account Settings</h2>
                    <p class="text-xs text-gray-500 font-bold tracking-widest mt-1">Manage your profile and security</p>
                </header>

                <div class="flex gap-8 border-b border-white/5 mb-8">
                    <button onclick="switchTab('profile')" id="tab-profile" class="pb-4 text-sm font-bold transition tab-active">Edit Profile</button>
                    <button onclick="switchTab('security')" id="tab-security" class="pb-4 text-sm font-bold text-gray-500 hover:text-white transition">Security</button>
                </div>

                <div id="content-profile" class="animate-in fade-in duration-500">
                    <form action="#" method="POST" enctype="multipart/form-data" class="space-y-8">
                        @csrf
                        <div class="flex items-center gap-6 p-6 bg-white/5 rounded-2xl border border-white/5">
                            <div class="w-20 h-20 rounded-full bg-gray-800 flex items-center justify-center border-2 border-blue-500 overflow-hidden">
                                <img id="preview" src="https://ui-avatars.com/api/?name=Maverick+Ari&background=3b82f6&color=fff" class="w-full h-full object-cover">
=======
            <main class="p-8 w-full">
                <header class="mb-6">
                    <h2 class="text-3xl font-bold tracking-tight text-white">Account Settings</h2>
                    <p class="text-sm text-gray-400 mt-1">Kelola informasi profil dan keamanan akun kamu.</p>
                </header>

                <div class="flex gap-6 border-b border-white/5 mb-6">
                    <button onclick="switchTab('profile')" id="tab-profile" class="pb-3 text-sm font-semibold transition tab-active text-white">Profile Details</button>
                    <button onclick="switchTab('security')" id="tab-security" class="pb-3 text-sm font-medium text-gray-400 hover:text-white transition">Security</button>
                </div>

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

                <div id="content-profile" class="bg-[#111214] border border-white/5 rounded-2xl p-8 shadow-xl">
                    <form action="{{ route('pembeli.settings.update_profile') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                        @csrf
                        
                        <div class="flex items-center gap-6 mb-8">
                            <div class="relative w-24 h-24 rounded-full bg-[#17181c] border border-white/10 flex items-center justify-center">
                                <img id="preview" src="{{ auth()->user()->photo ? asset('storage/' . auth()->user()->photo) : 'https://ui-avatars.com/api/?name=' . urlencode(auth()->user()->name) . '&background=2563eb&color=fff' }}" class="w-full h-full object-cover rounded-full">
                                <label class="absolute bottom-0 right-0 w-8 h-8 bg-blue-600 rounded-full border-2 border-[#111214] flex items-center justify-center cursor-pointer hover:bg-blue-500 transition shadow-lg">
                                    <i class="fa-solid fa-pencil text-white text-xs"></i>
                                    <input type="file" name="photo" class="hidden" onchange="previewImage(event)">
                                </label>
>>>>>>> 3b86639f527e2cfb3db211f1bcdfb9e42f746ab1
                            </div>
                            <div>
                                <label class="block text-xs font-black uppercase tracking-widest text-blue-400 mb-2">Change Avatar</label>
                                <input type="file" name="photo" class="text-xs text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-[10px] file:font-black file:bg-white file:text-black hover:file:bg-blue-500 hover:file:text-white cursor-pointer">
                            </div>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
<<<<<<< HEAD
                            <div class="md:col-span-2">
                                <label class="text-[10px] font-bold text-gray-500 uppercase ml-1 mb-2 block">Full Name</label>
                                <input type="text" name="name" value="Maverick Ari" class="w-full bg-white/5 border border-white/10 rounded-xl px-4 py-3 text-sm focus:border-blue-500 outline-none transition">
=======
                            <div>
                                <label class="text-[10px] font-bold text-gray-400 uppercase tracking-wider ml-1 mb-2 block">Full Name</label>
                                <input type="text" name="name" value="{{ old('name', auth()->user()->name) }}" class="w-full bg-[#17181c] border border-white/5 rounded-xl px-4 py-3 text-sm text-white focus:border-blue-500 focus:ring-1 focus:ring-blue-500 outline-none transition">
>>>>>>> 3b86639f527e2cfb3db211f1bcdfb9e42f746ab1
                            </div>
                            <div>
<<<<<<< HEAD
                                <label class="text-[10px] font-bold text-gray-500 uppercase ml-1 mb-2 block">Email Address</label>
                                <input type="email" name="email" value="maverick@student.polibatam.ac.id" class="w-full bg-white/5 border border-white/10 rounded-xl px-4 py-3 text-sm focus:border-blue-500 outline-none transition">
=======
                                <label class="text-[10px] font-bold text-gray-400 uppercase tracking-wider ml-1 mb-2 block">NIM</label>
                                <input type="text" name="nim" value="{{ auth()->user()->nim ?? '-' }}" class="w-full bg-[#17181c]/50 border border-white/5 rounded-xl px-4 py-3 text-sm text-gray-550 outline-none cursor-not-allowed opacity-60" readonly>
>>>>>>> 3b86639f527e2cfb3db211f1bcdfb9e42f746ab1
                            </div>
                            <div>
<<<<<<< HEAD
                                <label class="text-[10px] font-bold text-gray-500 uppercase ml-1 mb-2 block">Phone Number</label>
                                <input type="tel" name="phone" value="08123456789" class="w-full bg-white/5 border border-white/10 rounded-xl px-4 py-3 text-sm focus:border-blue-500 outline-none transition">
=======
                                <label class="text-[10px] font-bold text-gray-400 uppercase tracking-wider ml-1 mb-2 block">Phone Number</label>
                                <input type="text" name="phone" value="{{ old('phone_number', auth()->user()->phone_number) }}" class="w-full bg-[#17181c] border border-white/5 rounded-xl px-4 py-3 text-sm text-white focus:border-blue-500 focus:ring-1 focus:ring-blue-500 outline-none transition">
>>>>>>> 3b86639f527e2cfb3db211f1bcdfb9e42f746ab1
                            </div>
                        </div>
                        <button type="submit" class="px-8 py-3 bg-blue-500 text-white rounded-xl font-black uppercase text-xs tracking-widest hover:scale-105 transition-all shadow-lg shadow-blue-500/20">Save Profile</button>
                    </form>
                </div>

<<<<<<< HEAD
                <div id="content-security" class="hidden animate-in fade-in duration-500">
                    <form action="#" method="POST" class="max-w-md space-y-6">
                        @csrf
                        <div>
                            <label class="text-[10px] font-bold text-gray-500 uppercase ml-1 mb-2 block">Old Password</label>
                            <input type="password" name="old_password" placeholder="••••••••" class="w-full bg-white/5 border border-white/10 rounded-xl px-4 py-3 text-sm focus:border-blue-500 outline-none transition">
=======
                <div id="content-security" class="hidden bg-[#111214] border border-white/5 rounded-2xl p-8 shadow-xl">
                    <form action="{{ route('pembeli.settings.update-password') }}" method="POST" class="space-y-6">
                        @csrf
                        @method('PUT')
                        
                        <div class="space-y-6">
                            <div>
                                <label class="text-[10px] font-bold text-gray-400 uppercase tracking-wider ml-1 mb-2 block">Old Password</label>
                                <div class="relative w-full">
                                    <input type="password" name="old_password" placeholder="Enter your current password" class="w-full bg-[#17181c] border border-white/5 rounded-xl px-4 py-3 text-sm text-white placeholder-gray-600 focus:border-blue-500 focus:ring-1 focus:ring-blue-500 outline-none transition pr-10">
                                    <span class="absolute right-3 top-1/2 -translate-y-1/2 text-gray-500 cursor-pointer hover:text-gray-400"><i class="fa-regular fa-eye"></i></span>
                                </div>
                            </div>

                            <div>
                                <label class="text-[10px] font-bold text-gray-400 uppercase tracking-wider ml-1 mb-2 block">New Password</label>
                                <div class="relative w-full">
                                    <input type="password" name="password" placeholder="Minimal 8 characters" class="w-full bg-[#17181c] border border-white/5 rounded-xl px-4 py-3 text-sm text-white placeholder-gray-600 focus:border-blue-500 focus:ring-1 focus:ring-blue-500 outline-none transition pr-10">
                                    <span class="absolute right-3 top-1/2 -translate-y-1/2 text-gray-500 cursor-pointer hover:text-gray-400"><i class="fa-regular fa-eye"></i></span>
                                </div>
                            </div>

                            <div>
                                <label class="text-[10px] font-bold text-gray-400 uppercase tracking-wider ml-1 mb-2 block">Confirm New Password</label>
                                <div class="relative w-full">
                                    <input type="password" name="password_confirmation" placeholder="Repeat new password" class="w-full bg-[#17181c] border border-white/5 rounded-xl px-4 py-3 text-sm text-white placeholder-gray-600 focus:border-blue-500 focus:ring-1 focus:ring-blue-500 outline-none transition pr-10">
                                    <span class="absolute right-3 top-1/2 -translate-y-1/2 text-gray-500 cursor-pointer hover:text-gray-400"><i class="fa-regular fa-eye"></i></span>
                                </div>
                            </div>

                            <div class="pt-2">
                                <button type="submit" class="px-6 py-3 bg-blue-600 hover:bg-blue-500 text-white rounded-xl font-bold text-xs uppercase tracking-wider transition-all shadow-lg shadow-blue-600/20 active:scale-95">
                                    Update Password
                                </button>
                            </div>
>>>>>>> 3b86639f527e2cfb3db211f1bcdfb9e42f746ab1
                        </div>
                        <div class="pt-4 border-t border-white/5">
                            <label class="text-[10px] font-bold text-gray-500 uppercase ml-1 mb-2 block">New Password</label>
                            <input type="password" name="password" placeholder="••••••••" class="w-full bg-white/5 border border-white/10 rounded-xl px-4 py-3 text-sm focus:border-blue-500 outline-none transition mb-4">
                            <label class="text-[10px] font-bold text-gray-500 uppercase ml-1 mb-2 block">Confirm New Password</label>
                            <input type="password" name="password_confirmation" placeholder="••••••••" class="w-full bg-white/5 border border-white/10 rounded-xl px-4 py-3 text-sm focus:border-blue-500 outline-none transition">
                        </div>
                        <button type="submit" class="w-full py-3 bg-white text-black rounded-xl font-black uppercase text-xs tracking-widest hover:bg-blue-500 hover:text-white transition-all shadow-lg active:scale-95">Update Password</button>
                    </form>
                </div>
            </main>
        </div>
    </div>

    <script>
        function switchTab(tab) {
            const profileContent = document.getElementById('content-profile');
            const securityContent = document.getElementById('content-security');
            const tabProfile = document.getElementById('tab-profile');
            const tabSecurity = document.getElementById('tab-security');

            if (tab === 'profile') {
                profileContent.classList.remove('hidden');
                securityContent.classList.add('hidden');
                tabProfile.classList.add('tab-active');
                tabProfile.classList.remove('text-gray-500');
                tabSecurity.classList.remove('tab-active');
                tabSecurity.classList.add('text-gray-500');
            } else {
                profileContent.classList.add('hidden');
                securityContent.classList.remove('hidden');
                tabProfile.classList.remove('tab-active');
                tabProfile.classList.add('text-gray-500');
                tabSecurity.classList.add('tab-active');
                tabSecurity.classList.remove('text-gray-500');
            }
        }
    </script>
</body>
</html>
