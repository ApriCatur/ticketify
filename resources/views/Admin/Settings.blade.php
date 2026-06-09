@extends('layouts.admin')

@section('title', 'Settings')

@section('content')

<script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

<div x-data="{ activeTab: 'profile' }" class="p-8">

    <header class="mb-8">
        <h1 class="text-3xl font-black tracking-tight">Account Settings</h1>
        <p class="text-gray-500 text-sm mt-2">
            Kelola informasi profil dan keamanan akun kamu.
        </p>
    </header>

    <div class="flex gap-6 mb-8 border-b border-white/5">
        <button @click="activeTab = 'profile'"
            :class="activeTab === 'profile'
                ? 'border-b-2 border-blue-500 text-blue-500 font-bold'
                : 'text-gray-500 hover:text-white'"
            class="pb-4 px-2 text-sm font-bold transition-all">
            Profile Details
        </button>

        <button @click="activeTab = 'security'"
            :class="activeTab === 'security'
                ? 'border-b-2 border-blue-500 text-blue-500 font-bold'
                : 'text-gray-500 hover:text-white'"
            class="pb-4 px-2 text-sm font-bold transition-all">
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

    <div class="bg-[#121212] rounded-[2.5rem] p-8 border border-white/5 shadow-2xl max-w-4xl">

        <div x-show="activeTab === 'profile'" x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0 transform scale-95">
            <form action="{{ route('admin.settings.update-profile') }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="flex items-center gap-6 mb-8">
                    <div class="relative w-24 h-24 group">
                        <div class="w-24 h-24 rounded-full border-2 border-white/10 overflow-hidden flex items-center justify-center bg-[#18181b] group-hover:border-blue-500/50 transition-all duration-300">
                            <img id="admin-preview"
                                 src="{{ $user->profile_picture ? asset('storage/' . $user->profile_picture) : 'https://ui-avatars.com/api/?name=' . urlencode($user->name) . '&background=2563eb&color=fff' }}"
                                 class="w-full h-full object-cover" alt="Profile">
                        </div>
                        <label for="admin-profile-picture" class="absolute bottom-0 right-0 bg-blue-500 hover:bg-blue-600 p-2 rounded-full text-white text-xs cursor-pointer shadow-lg shadow-blue-500/20 transition-all duration-200">
                            <i class="fa-solid fa-pen"></i>
                        </label>
                        <input type="file" id="admin-profile-picture" name="profile_picture" class="hidden" accept="image/*" onchange="previewAdminImage(event)">
                    </div>
                    <div>
                        <h3 class="text-sm font-bold text-gray-200">Profile Picture</h3>
                        <p class="text-xs text-gray-500 mt-1">Format: JPG, PNG. Max 2MB.</p>
                        @error('profile_picture')
                            <span class="text-xs text-red-500 mt-1 block font-medium">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <div class="grid md:grid-cols-2 gap-6 mb-6">
                    <div class="space-y-2">
                        <label class="text-[10px] font-bold text-gray-500 uppercase tracking-widest">Full Name</label>
                        <input type="text" name="name" value="{{ old('name', $user->name) }}"
                               placeholder="Enter your full name"
                               class="w-full bg-[#121212] border border-white/5 rounded-xl px-4 py-3 text-sm text-white focus:outline-none focus:border-blue-500 transition duration-200">
                        @error('name') <span class="text-xs text-red-500 mt-1 block font-medium">{{ $message }}</span> @enderror
                    </div>

                    <div class="space-y-2">
                        <label class="text-[10px] font-bold text-gray-500 uppercase tracking-widest">NIM</label>
                        <input type="text" name="nim" value="{{ old('nim', $user->nim) }}"
                               placeholder="NIM"
                               class="w-full bg-[#1c1c1e] border border-white/5 rounded-xl px-4 py-3 text-sm text-gray-400 opacity-60" readonly>
                    </div>
                </div>

                <div class="grid md:grid-cols-2 gap-6 mb-8">
                    <div class="space-y-2">
                        <label class="text-[10px] font-bold text-gray-500 uppercase tracking-widest">Email Address</label>
                        <input type="email" name="email" value="{{ old('email', $user->email) }}"
                               placeholder="contoh@email.com"
                               class="w-full bg-[#121212] border border-white/5 rounded-xl px-4 py-3 text-sm text-white focus:outline-none focus:border-blue-500 transition duration-200">
                        @error('email') <span class="text-xs text-red-500 mt-1 block font-medium">{{ $message }}</span> @enderror
                    </div>

                    <div class="space-y-2">
                        <label class="text-[10px] font-bold text-gray-500 uppercase tracking-widest">Phone Number</label>
                        <input type="text" name="phone_number" value="{{ old('phone_number', $user->phone_number) }}"
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

        <div x-show="activeTab === 'security'" x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0 transform scale-95" style="display:none;">
            <form action="{{ route('admin.settings.update-password') }}" method="POST">
                @csrf
                @method('PUT')

                <div class="max-w-lg space-y-6">
                    <div class="space-y-2">
                        <label class="text-[10px] font-bold text-gray-500 uppercase tracking-widest">Old Password</label>
                        <input type="password" name="current_password" placeholder="Enter your current password"
                               class="w-full bg-[#121212] border border-white/5 rounded-xl px-4 py-3 text-sm text-white focus:outline-none focus:border-blue-500 transition duration-200">
                        @error('current_password') <span class="text-xs text-red-500 mt-1 block font-medium">{{ $message }}</span> @enderror
                    </div>

                    <div class="space-y-2">
                        <label class="text-[10px] font-bold text-gray-500 uppercase tracking-widest">New Password</label>
                        <input type="password" name="password" placeholder="Minimal 8 characters"
                               class="w-full bg-[#121212] border border-white/5 rounded-xl px-4 py-3 text-sm text-white focus:outline-none focus:border-blue-500 transition duration-200">
                        @error('password') <span class="text-xs text-red-500 mt-1 block font-medium">{{ $message }}</span> @enderror
                    </div>

                    <div class="space-y-2">
                        <label class="text-[10px] font-bold text-gray-500 uppercase tracking-widest">Confirm New Password</label>
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

</div>

<script>
    function previewAdminImage(event) {
        const reader = new FileReader();
        reader.onload = function(){
            const output = document.getElementById('admin-preview');
            if (output) output.src = reader.result;
        }
        if(event.target.files[0]) {
            reader.readAsDataURL(event.target.files[0]);
        }
    }
</script>

@endsection
