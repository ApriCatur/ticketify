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
                 <button id="open-sidebar" class="lg:hidden text-gray-400 hover:text-blue-500 transition-colors">
                <i class="fa-solid fa-bars-staggered text-2xl"></i>
            </button>
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

    <!-- Notifikasi Sukses -->
    @if(session('success'))
        <div class="mb-6 p-4 bg-emerald-500/10 border border-emerald-500/20 text-emerald-400 rounded-xl text-sm flex items-center gap-3">
            <i class="fa-solid fa-circle-check"></i>
            <span>{{ session('success') }}</span>
        </div>
    @endif

    <!-- Notifikasi Error/Validasi Gagal -->
    @if($errors->any())
        <div class="mb-6 p-4 bg-rose-500/10 border border-rose-500/20 text-rose-400 rounded-xl text-sm space-y-1">
            @foreach($errors->all() as $error)
                <div class="flex items-center gap-3">
                    <i class="fa-solid fa-circle-xmark"></i>
                    <span>{{ $error }}</span>
                </div>
            @endforeach
        </div>
    @endif

    <!-- TAB PROFILE DETAILS -->
    <div x-show="activeTab === 'profile'" x-transition>
        <form action="{{ route('pembeli.settings.update-profile') }}" method="POST" enctype="multipart/form-data" class="space-y-8">
            @csrf
            @method('PUT')

            <div class="flex items-center gap-6 pb-8 border-b border-white/5">
                <div class="relative">
                    <div class="w-24 h-24 bg-[#18181b] border border-white/10 rounded-full flex items-center justify-center overflow-hidden">
                        @if(auth()->user()->profile_picture)
                            <img src="{{ \Illuminate\Support\Facades\Storage::url(auth()->user()->profile_picture) }}" alt="Profile Picture" class="w-full h-full object-cover">
                        @else
                            <i class="fa-solid fa-user text-3xl text-gray-700"></i>
                        @endif
                    </div>
                    <label for="pic-upload" class="absolute bottom-0 right-0 w-8 h-8 bg-blue-600 text-white rounded-full flex items-center justify-center text-xs cursor-pointer hover:bg-blue-700 transition-all border-4 border-[#121212]">
                        <i class="fa-solid fa-pen"></i>
                        <input type="file" id="pic-upload" name="profile_picture" class="hidden">
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
                    <input type="text" name="name" value="{{ old('name', auth()->user()->name) }}" placeholder="Enter your full name" class="w-full bg-[#18181b] border border-white/5 rounded-xl px-4 py-3 text-sm focus:outline-none focus:border-blue-500 transition-all" required>
                </div>
                <div class="space-y-2">
                    <label class="text-[10px] font-bold text-gray-500 uppercase tracking-widest ml-1">Email Address</label>
                    <input type="email" name="email" value="{{ old('email', auth()->user()->email) }}" placeholder="Enter your email address" class="w-full bg-[#18181b] border border-white/5 rounded-xl px-4 py-3 text-sm focus:outline-none focus:border-blue-500 transition-all" required>
                </div>
                <div class="space-y-2 md:col-span-2">
                    <label class="text-[10px] font-bold text-gray-500 uppercase tracking-widest ml-1">Phone Number</label>
                    <input type="text" name="phone_number" value="{{ old('phone_number', auth()->user()->phone_number) }}" placeholder="0812345567" class="w-full bg-[#18181b] border border-white/5 rounded-xl px-4 py-3 text-sm focus:outline-none focus:border-blue-500 transition-all">
                </div>
            </div>

            <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-3 px-8 rounded-xl text-sm transition-all shadow-lg shadow-blue-600/20">
                Save Changes
            </button>
        </form>
    </div>

    <!-- TAB SECURITY -->
    <div x-show="activeTab === 'security'" x-transition style="display: none;">
        <form action="{{ route('pembeli.settings.update-password') }}" method="POST" class="space-y-6 max-w-lg">
            @csrf
            @method('PUT')

            <div class="space-y-2">
                <label class="text-[10px] font-bold text-gray-500 uppercase tracking-widest ml-1">Old Password</label>
                <input type="password" name="old_password" class="w-full bg-[#18181b] border border-white/5 rounded-xl px-4 py-3 text-sm focus:outline-none focus:border-blue-500 transition-all" required>
            </div>
            <div class="space-y-2">
                <label class="text-[10px] font-bold text-gray-500 uppercase tracking-widest ml-1">New Password</label>
                <input type="password" name="password" class="w-full bg-[#18181b] border border-white/5 rounded-xl px-4 py-3 text-sm focus:outline-none focus:border-blue-500 transition-all" required>
            </div>
            <div class="space-y-2">
                <label class="text-[10px] font-bold text-gray-500 uppercase tracking-widest ml-1">Confirm New Password</label>
                <input type="password" name="password_confirmation" class="w-full bg-[#18181b] border border-white/5 rounded-xl px-4 py-3 text-sm focus:outline-none focus:border-blue-500 transition-all" required>
            </div>

            <div class="pt-4">
                <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-3 px-8 rounded-xl text-sm transition-all shadow-lg shadow-blue-600/20">
                    Update Password
                </button>
            </div>
        </form>
    </div>

</div>
    </main>

    <script>
    const openBtn = document.getElementById('open-sidebar');
    const closeBtn = document.getElementById('close-sidebar');
    const sidebar = document.getElementById('main-sidebar');
    const overlay = document.getElementById('sidebar-overlay');

    // Cek apakah elemen ada sebelum menjalankan fungsi
    if (openBtn && sidebar) {
        function toggleSidebar() {
            sidebar.classList.toggle('-translate-x-full');
            if (overlay) {
                overlay.classList.toggle('hidden');
            }
            document.body.classList.toggle('overflow-hidden', !sidebar.classList.contains('-translate-x-full'));
        }

        openBtn.addEventListener('click', toggleSidebar);

        if (closeBtn) closeBtn.addEventListener('click', toggleSidebar);
        if (overlay) overlay.addEventListener('click', toggleSidebar);
    }

    // Preview foto profil sebelum upload
    const picUpload = document.getElementById('pic-upload');
    if (picUpload) {
        picUpload.addEventListener('change', function(e) {
            const file = e.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(event) {
                    const profilePictureDiv = document.querySelector('.w-24.h-24');
                    if (profilePictureDiv) {
                        // Hapus icon atau image lama
                        profilePictureDiv.innerHTML = '';
                        // Tambahkan preview image
                        const img = document.createElement('img');
                        img.src = event.target.result;
                        img.className = 'w-full h-full object-cover';
                        profilePictureDiv.appendChild(img);
                    }
                };
                reader.readAsDataURL(file);
            }
        });
    }
</script>

</body>
</html>
