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
        .glass { background: rgba(18, 18, 18, 0.8); backdrop-filter: blur(10px); }
        .tab-active { border-bottom: 2px solid #3b82f6; color: white; }
    </style>
</head>
<body class="bg-[#0f0f0f] text-white antialiased">

    <div class="flex max-w-[1600px] mx-auto min-h-screen border-x border-gray-800 bg-[#121212] shadow-2xl">

        <aside class="w-64 hidden lg:flex flex-col sticky top-0 h-screen border-r border-white/5 p-6 space-y-8">
            <div class="flex items-center gap-2 mb-4">
                <div class="w-8 h-8 bg-blue-500 rounded-lg flex items-center justify-center font-bold text-white">T</div>
                <span class="font-extrabold text-xl tracking-tight uppercase">Ticketify</span>
            </div>
            <nav class="space-y-1">
                <p class="text-[10px] font-black text-gray-500 uppercase tracking-widest mb-4 border-b border-white/5 pb-2">Menu</p>
                <a href="{{ route('event.index') }}" class="flex items-center gap-3 p-3 hover:bg-white/5 rounded-xl text-sm text-gray-400 hover:text-white transition">
                    <i class="fa-solid fa-house"></i> Event
                </a>

                <a href="#" class="flex items-center gap-3 p-3 bg-blue-500 rounded-xl font-bold text-sm transition text-white shadow-lg">
                    <i class="fa-solid fa-gear"></i> Settings
                </a>
            </nav>
        </aside>

        <div class="flex-1 flex flex-col min-w-0 border-r border-white/5">
            <nav class="sticky top-0 z-50 glass border-b border-white/5 px-8 py-4 flex justify-between items-center">
                <span class="text-sm text-gray-400 font-medium italic tracking-tight">Personalize your experience.</span>
                <div class="w-10 h-10 rounded-full bg-blue-500 flex items-center justify-center font-black">M</div>
            </nav>

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
                            </div>
                            <div>
                                <label class="block text-xs font-black uppercase tracking-widest text-blue-400 mb-2">Change Avatar</label>
                                <input type="file" name="photo" class="text-xs text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-[10px] file:font-black file:bg-white file:text-black hover:file:bg-blue-500 hover:file:text-white cursor-pointer">
                            </div>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div class="md:col-span-2">
                                <label class="text-[10px] font-bold text-gray-500 uppercase ml-1 mb-2 block">Full Name</label>
                                <input type="text" name="name" value="Maverick Ari" class="w-full bg-white/5 border border-white/10 rounded-xl px-4 py-3 text-sm focus:border-blue-500 outline-none transition">
                            </div>
                            <div>
                                <label class="text-[10px] font-bold text-gray-500 uppercase ml-1 mb-2 block">Email Address</label>
                                <input type="email" name="email" value="maverick@student.polibatam.ac.id" class="w-full bg-white/5 border border-white/10 rounded-xl px-4 py-3 text-sm focus:border-blue-500 outline-none transition">
                            </div>
                            <div>
                                <label class="text-[10px] font-bold text-gray-500 uppercase ml-1 mb-2 block">Phone Number</label>
                                <input type="tel" name="phone" value="08123456789" class="w-full bg-white/5 border border-white/10 rounded-xl px-4 py-3 text-sm focus:border-blue-500 outline-none transition">
                            </div>
                        </div>
                        <button type="submit" class="px-8 py-3 bg-blue-500 text-white rounded-xl font-black uppercase text-xs tracking-widest hover:scale-105 transition-all shadow-lg shadow-blue-500/20">Save Profile</button>
                    </form>
                </div>

                <div id="content-security" class="hidden animate-in fade-in duration-500">
                    <form action="#" method="POST" class="max-w-md space-y-6">
                        @csrf
                        <div>
                            <label class="text-[10px] font-bold text-gray-500 uppercase ml-1 mb-2 block">Old Password</label>
                            <input type="password" name="old_password" placeholder="••••••••" class="w-full bg-white/5 border border-white/10 rounded-xl px-4 py-3 text-sm focus:border-blue-500 outline-none transition">
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
