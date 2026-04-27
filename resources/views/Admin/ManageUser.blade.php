@extends('layouts.admin')

@section('title', 'Users Management')

@section('content')

{{-- ── HEADER ─────────────────────────────────────────────── --}}
<nav class="sticky top-0 z-50 glass border-b border-white/5 px-8 py-5 flex justify-between items-center">
    <div>
        <h2 class="text-2xl font-black tracking-tight">Users</h2>
        <p class="text-sm text-gray-500">Manage all users in the platform</p>
    </div>
</nav>

<div class="p-8">

    {{-- ── STATISTICS --}}
    <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-4 gap-6 mb-8">

        <div class="bg-[#1e1e1e] p-6 rounded-2xl border border-white/5">
            <p class="text-gray-500 text-sm">Total Users</p>
            <h3 class="text-4xl font-black mt-2">67</h3>
        </div>
        <div class="bg-[#1e1e1e] p-6 rounded-2xl border border-white/5">
            <p class="text-gray-500 text-sm">Admins</p>
            <h3 class="text-4xl font-black mt-2 text-blue-400">1</h3>
        </div>
        <div class="bg-[#1e1e1e] p-6 rounded-2xl border border-white/5">
            <p class="text-gray-500 text-sm">Organizers</p>
            <h3 class="text-4xl font-black mt-2 text-indigo-400">3</h3>
        </div>
        <div class="bg-[#1e1e1e] p-6 rounded-2xl border border-white/5">
            <p class="text-gray-500 text-sm">Customers</p>
            <h3 class="text-4xl font-black mt-2 text-gray-300">63</h3>
        </div>

    </div>

    {{-- TABLE CARD --}}
    <div class="bg-[#1e1e1e] rounded-2xl border border-white/5 p-6">

        {{-- Search + Add --}}
        <div class="flex flex-col md:flex-row justify-between gap-4 mb-6">

            <div class="flex items-center gap-3 bg-white/5 border border-transparent rounded-xl px-4 w-full md:w-80 focus-within:border-blue-500 transition-colors">
                <i class="fa-solid fa-magnifying-glass text-blue-500 text-sm"></i>
                <input type="text" placeholder="Search user..."
                    class="w-full py-3 bg-transparent outline-none text-sm text-white placeholder-gray-500 border-none ring-0 focus:ring-0">
            </div>

            <button onclick="openModal('addModal')"
                class="flex items-center gap-2 bg-white text-black px-6 py-3 rounded-xl font-bold hover:bg-blue-500 hover:text-white transition-all active:scale-95">
                <i class="fa-solid fa-plus text-sm"></i>
                Add User
            </button>

        </div>

        {{-- Table --}}
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead>
                    <tr class="border-b border-white/5 text-left text-gray-500 text-sm">
                        <th class="py-4 font-semibold">No</th>
                        <th class="py-4 font-semibold">Name</th>
                        <th class="py-4 font-semibold">Email</th>
                        <th class="py-4 font-semibold">Role</th>
                        <th class="py-4 font-semibold text-center">Actions</th>
                    </tr>
                </thead>

                <tbody class="divide-y divide-white/5">

                    @php
                        $users = [
                            ['Abdul Rizad',     'admin@gmail.com',     'Admin'],
                            ['Samsul Arif',     'customer@gmail.com',  'Customer'],
                            ['Muhammad Aqsan',  'organizer@gmail.com', 'Organizer'],
                            ['M. Fauzi Azhari', 'ari@gmail.com',       'Admin'],
                            ['Apri Catur',      'apri@gmail.com',      'Customer'],
                            ['Syarifah',        'syarah@gmail.com',    'Organizer'],
                            ['Adrian Septiaji', 'adit@gmail.com',      'Organizer'],
                        ];

                        $badgeClass = [
                            'Admin'     => 'bg-blue-500/10 text-blue-400',
                            'Organizer' => 'bg-indigo-500/10 text-indigo-400',
                            'Customer'  => 'bg-gray-500/10 text-gray-300',
                        ];

                        $avatarClass = [
                            'Admin'     => 'bg-blue-500/20 text-blue-400',
                            'Organizer' => 'bg-indigo-500/20 text-indigo-400',
                            'Customer'  => 'bg-gray-500/20 text-gray-300',
                        ];
                    @endphp

                    @foreach ($users as $i => $user)
                        @php
                            $parts    = explode(' ', $user[0]);
                            $initials = strtoupper(substr($parts[0], 0, 1) . (isset($parts[1]) ? substr($parts[1], 0, 1) : ''));
                        @endphp

                        <tr class="hover:bg-white/5 transition-colors">

                            <td class="py-4 text-gray-500 text-sm">{{ $i + 1 }}</td>

                            <td class="py-4">
                                <div class="flex items-center gap-3">
                                    <div class="w-8 h-8 rounded-lg flex items-center justify-center text-xs font-bold {{ $avatarClass[$user[2]] }}">
                                        {{ $initials }}
                                    </div>
                                    <span class="font-medium text-sm">{{ $user[0] }}</span>
                                </div>
                            </td>

                            <td class="py-4 text-gray-400 text-sm">{{ $user[1] }}</td>

                            <td class="py-4">
                                <span class="px-3 py-1 rounded-full text-xs font-semibold {{ $badgeClass[$user[2]] }}">
                                    {{ $user[2] }}
                                </span>
                            </td>

                            <td class="py-4">
                                <div class="flex justify-center gap-2">

                                    <button onclick="openEdit('{{ $user[0] }}', '{{ $user[1] }}', '{{ $user[2] }}')"
                                        class="flex items-center gap-1.5 px-3 py-1.5 rounded-lg bg-blue-500/10 text-blue-400 hover:bg-blue-500/20 transition-colors text-xs font-semibold">
                                        <i class="fa-solid fa-pen-to-square text-[11px]"></i>
                                        Edit
                                    </button>

                                    <button onclick="openDelete('{{ $user[0] }}', '{{ $user[1] }}')"
                                        class="flex items-center gap-1.5 px-3 py-1.5 rounded-lg bg-red-500/10 text-red-400 hover:bg-red-500/20 transition-colors text-xs font-semibold">
                                        <i class="fa-solid fa-trash text-[11px]"></i>
                                        Delete
                                    </button>

                                </div>
                            </td>

                        </tr>
                    @endforeach

                </tbody>
            </table>
        </div>

    </div>
</div>

{{-- MODAL: ADD USER --}}
<div id="addModal" class="fixed inset-0 bg-black/70 backdrop-blur-sm hidden items-center justify-center z-50 p-4">
    <div class="bg-[#1e1e1e] w-full max-w-xl rounded-3xl border border-white/10 overflow-hidden shadow-2xl animate-modal">

        {{-- Header --}}
        <div class="px-6 py-4 flex justify-between items-center bg-gradient-to-r from-blue-700 to-blue-600">
            <div class="flex items-center gap-3">
                <div class="w-8 h-8 rounded-xl bg-white/20 flex items-center justify-center">
                    <i class="fa-solid fa-user-plus text-white text-sm"></i>
                </div>
                <h2 class="text-white font-bold">Add New Users</h2>
            </div>
            <button onclick="closeModal('addModal')"
                class="w-8 h-8 rounded-xl bg-white/15 hover:bg-white/25 text-white flex items-center justify-center transition-colors">
                <i class="fa-solid fa-xmark"></i>
            </button>
        </div>

        {{-- Body --}}
        <div class="p-6">

            {{-- Section label --}}
            <div class="flex items-center gap-3 mb-5">
                <span class="text-[9px] font-black text-blue-500 uppercase tracking-widest whitespace-nowrap">User Information</span>
                <div class="flex-1 h-px bg-blue-500/20"></div>
                <span class="text-[9px] font-black text-blue-500 uppercase tracking-widest whitespace-nowrap">User Details</span>
            </div>

            <div class="grid grid-cols-2 gap-4">

                {{-- Email --}}
                <div class="flex flex-col gap-2">
                    <label class="text-[9px] font-black text-gray-500 uppercase tracking-widest ml-1">Email</label>
                    <div class="flex items-center gap-3 bg-white/5 border border-white/8 rounded-xl px-4 py-3 focus-within:border-blue-500 transition-colors">
                        <i class="fa-solid fa-envelope text-blue-500 text-xs flex-shrink-0"></i>
                        <input type="email" placeholder="contoh@gmail.com"
                            class="bg-transparent w-full outline-none border-none ring-0 text-sm text-gray-200 placeholder-gray-600">
                    </div>
                </div>

                {{-- Nama Lengkap --}}
                <div class="flex flex-col gap-2">
                    <label class="text-[9px] font-black text-gray-500 uppercase tracking-widest ml-1">Full Name</label>
                    <div class="flex items-center gap-3 bg-white/5 border border-white/8 rounded-xl px-4 py-3 focus-within:border-blue-500 transition-colors">
                        <i class="fa-solid fa-user text-blue-500 text-xs flex-shrink-0"></i>
                        <input type="text" placeholder="Full name as per identification..."
                            class="bg-transparent w-full outline-none border-none ring-0 text-sm text-gray-200 placeholder-gray-600">
                    </div>
                </div>

                {{-- Peran --}}
                <div class="flex flex-col gap-2">
                    <label class="text-[9px] font-black text-gray-500 uppercase tracking-widest ml-1">Peran</label>
                    <div class="relative flex items-center gap-3 bg-white/5 border border-white/8 rounded-xl px-4 py-3 focus-within:border-blue-500 transition-colors">
                        <i class="fa-solid fa-shield-halved text-blue-500 text-xs flex-shrink-0"></i>
                        <select class="bg-transparent w-full outline-none border-none ring-0 text-sm text-gray-200 appearance-none cursor-pointer">
                            <option value="" class="bg-[#1e1e1e] text-gray-400">Pilih Peran...</option>
                            <option value="Admin"     class="bg-[#1e1e1e]">Admin</option>
                            <option value="Organizer" class="bg-[#1e1e1e]">Organizer</option>
                            <option value="Customer"  class="bg-[#1e1e1e]">Customer</option>
                        </select>
                        <i class="fa-solid fa-chevron-down text-gray-600 text-[10px] absolute right-4 pointer-events-none"></i>
                    </div>
                </div>

                {{-- Kata Sandi --}}
                <div class="flex flex-col gap-2">
                    <label class="text-[9px] font-black text-gray-500 uppercase tracking-widest ml-1">Password</label>
                    <div class="flex items-center gap-3 bg-white/5 border border-white/8 rounded-xl px-4 py-3 focus-within:border-blue-500 transition-colors">
                        <i class="fa-solid fa-lock text-blue-500 text-xs flex-shrink-0"></i>
                        <input type="password" placeholder="Bawaan: NIK (jika kosong)"
                            class="bg-transparent w-full outline-none border-none ring-0 text-sm text-gray-200 placeholder-gray-600">
                        </div>
                </div>
            </div>
        </div>

        {{-- Footer --}}
        <div class="px-6 py-4 border-t border-white/5 flex justify-end gap-3">
            <button onclick="closeModal('addModal')"
                class="px-5 py-2.5 bg-white/5 border border-white/10 rounded-xl text-sm text-gray-300 font-semibold hover:bg-white/10 transition-colors">
                Batal
            </button>
            <button class="flex items-center gap-2 px-6 py-2.5 bg-blue-600 hover:bg-blue-500 rounded-xl text-sm text-white font-bold transition-colors active:scale-95">
                <i class="fa-solid fa-floppy-disk"></i> Simpan Anggota
            </button>
        </div>

    </div>
</div>


{{-- MODAL: EDIT USER --}}
<div id="editModal" class="fixed inset-0 bg-black/70 backdrop-blur-sm hidden items-center justify-center z-50 p-4">
    <div class="bg-[#1e1e1e] w-full max-w-xl rounded-3xl border border-white/10 overflow-hidden shadow-2xl animate-modal">

        {{-- Header --}}
        <div class="px-6 py-4 flex justify-between items-center bg-gradient-to-r from-blue-950 to-blue-700">
            <div class="flex items-center gap-3">
                <div class="w-8 h-8 rounded-xl bg-white/20 flex items-center justify-center">
                    <i class="fa-solid fa-user-pen text-white text-sm"></i>
                </div>
                <h2 class="text-white font-bold">Edit User Data</h2>
            </div>
            <button onclick="closeModal('editModal')"
                class="w-8 h-8 rounded-xl bg-white/15 hover:bg-white/25 text-white flex items-center justify-center transition-colors">
                <i class="fa-solid fa-xmark"></i>
            </button>
        </div>

        {{-- User preview badge --}}
        <div class="mx-6 mt-5 flex items-center gap-3 px-4 py-3 bg-blue-500/5 border border-blue-500/15 rounded-2xl">
            <div id="editAvatar" class="w-10 h-10 rounded-xl bg-blue-500/20 text-blue-400 flex items-center justify-center text-sm font-bold flex-shrink-0"></div>
            <div class="min-w-0">
                <p id="editBadgeName"  class="font-bold text-sm truncate"></p>
                <p id="editBadgeEmail" class="text-xs text-gray-500 truncate"></p>
            </div>
            <span id="editBadgeRole" class="ml-auto px-3 py-1 rounded-full text-xs font-semibold flex-shrink-0"></span>
        </div>

        {{-- Body --}}
        <div class="p-6 pt-4">

            <div class="flex items-center gap-3 mb-5">
                <span class="text-[9px] font-black text-blue-500 uppercase tracking-widest whitespace-nowrap">Edit Information</span>
                <div class="flex-1 h-px bg-blue-500/20"></div>
            </div>

            <div class="grid grid-cols-2 gap-4">
                {{-- Email --}}
                <div class="flex flex-col gap-2">
                    <label class="text-[9px] font-black text-gray-500 uppercase tracking-widest ml-1">Email</label>
                    <div class="flex items-center gap-3 bg-white/5 border border-white/8 rounded-xl px-4 py-3 focus-within:border-blue-500 transition-colors">
                        <i class="fa-solid fa-envelope text-blue-500 text-xs flex-shrink-0"></i>
                        <input id="editEmail" type="email" placeholder="contoh@gmail.com"
                            class="bg-transparent w-full outline-none border-none ring-0 text-sm text-gray-200 placeholder-gray-600">
                    </div>
                </div>

                {{-- Nama Lengkap --}}
                <div class="flex flex-col gap-2">
                    <label class="text-[9px] font-black text-gray-500 uppercase tracking-widest ml-1">Nama Lengkap</label>
                    <div class="flex items-center gap-3 bg-white/5 border border-white/8 rounded-xl px-4 py-3 focus-within:border-blue-500 transition-colors">
                        <i class="fa-solid fa-user text-blue-500 text-xs flex-shrink-0"></i>
                        <input id="editName" type="text" placeholder="Nama lengkap..."
                            class="bg-transparent w-full outline-none border-none ring-0 text-sm text-gray-200 placeholder-gray-600">
                    </div>
                </div>

                {{-- Peran --}}
                <div class="flex flex-col gap-2">
                    <label class="text-[9px] font-black text-gray-500 uppercase tracking-widest ml-1">Peran</label>
                    <div class="relative flex items-center gap-3 bg-white/5 border border-white/8 rounded-xl px-4 py-3 focus-within:border-blue-500 transition-colors">
                        <i class="fa-solid fa-shield-halved text-blue-500 text-xs flex-shrink-0"></i>
                        <select id="editRole" class="bg-transparent w-full outline-none border-none ring-0 text-sm text-gray-200 appearance-none cursor-pointer">
                            <option value="Admin"     class="bg-[#1e1e1e]">Admin</option>
                            <option value="Organizer" class="bg-[#1e1e1e]">Organizer</option>
                            <option value="Customer"  class="bg-[#1e1e1e]">Customer</option>
                        </select>
                        <i class="fa-solid fa-chevron-down text-gray-600 text-[10px] absolute right-4 pointer-events-none"></i>
                    </div>
                </div>

                {{-- Password Baru --}}
                <div class="flex flex-col gap-2">
                    <label class="text-[9px] font-black text-gray-500 uppercase tracking-widest ml-1">Password Baru</label>
                    <div class="flex items-center gap-3 bg-white/5 border border-white/8 rounded-xl px-4 py-3 focus-within:border-blue-500 transition-colors">
                        <i class="fa-solid fa-lock text-blue-500 text-xs flex-shrink-0"></i>
                        <input type="password" placeholder="Kosongkan jika tidak diubah..."
                            class="bg-transparent w-full outline-none border-none ring-0 text-sm text-gray-200 placeholder-gray-600">
                    </div>
                    <p class="text-[10px] text-gray-600 ml-1">*Biarkan kosong jika tidak ingin mengubah password.</p>
                </div>
            </div>
        </div>

        {{-- Footer --}}
        <div class="px-6 py-4 border-t border-white/5 flex justify-end gap-3">
            <button onclick="closeModal('editModal')"
                class="px-5 py-2.5 bg-white/5 border border-white/10 rounded-xl text-sm text-gray-300 font-semibold hover:bg-white/10 transition-colors">
                Batal
            </button>
            <button class="flex items-center gap-2 px-6 py-2.5 bg-blue-600 hover:bg-blue-500 rounded-xl text-sm text-white font-bold transition-colors active:scale-95">
                <i class="fa-solid fa-floppy-disk"></i> Simpan Perubahan
            </button>
        </div>

    </div>
</div>

     {{-- MODAL: DELETE USER --}}
<div id="deleteModal" class="fixed inset-0 bg-black/70 backdrop-blur-sm hidden items-center justify-center z-50 p-4">
    <div class="bg-[#1e1e1e] w-full max-w-sm rounded-3xl border border-white/10 overflow-hidden shadow-2xl animate-modal">

        {{-- Header --}}
        <div class="px-6 py-4 flex justify-between items-center border-b border-white/5">
            <div class="flex items-center gap-3">
                <div class="w-8 h-8 rounded-xl bg-red-500/20 flex items-center justify-center">
                    <i class="fa-solid fa-trash text-red-400 text-sm"></i>
                </div>
                <h2 class="font-bold">Delete User</h2>
            </div>
            <button onclick="closeModal('deleteModal')"
                class="w-8 h-8 rounded-xl bg-white/5 hover:bg-white/10 text-gray-400 hover:text-white flex items-center justify-center transition-colors">
                <i class="fa-solid fa-xmark"></i>
            </button>
        </div>

        {{-- Body --}}
        <div class="p-6 text-center">

            <div class="w-16 h-16 mx-auto mb-4 rounded-full bg-red-500/10 border border-red-500/20 flex items-center justify-center">
                <i class="fa-solid fa-user-xmark text-red-400 text-2xl"></i>
            </div>

            <h3 class="font-bold text-lg mb-2">Are you sure want to delete this user?</h3>
            <p class="text-sm text-gray-500 leading-relaxed mb-5">
                this action <span class="text-red-400 font-semibold">cannot be undone</span>.
                The following account will be permanently deleted from the system.
            </p>

            {{-- User preview --}}
            <div class="flex items-center gap-3 p-3 bg-white/5 border border-white/8 rounded-2xl mb-4 text-left">
                <div id="deleteAvatar" class="w-10 h-10 rounded-xl bg-red-500/20 text-red-400 flex items-center justify-center text-sm font-bold flex-shrink-0"></div>
                <div class="min-w-0">
                    <p id="deleteUserName"  class="font-semibold text-sm truncate"></p>
                    <p id="deleteUserEmail" class="text-xs text-gray-500 truncate"></p>
                </div>
            </div>
        </div>

        {{-- Footer --}}
        <div class="px-6 pb-6 flex gap-3">
            <button onclick="closeModal('deleteModal')"
                class="flex-1 py-2.5 bg-white/5 border border-white/10 rounded-xl text-sm font-semibold text-gray-300 hover:bg-white/10 transition-colors">
                Cancel
            </button>
            <button onclick="closeModal('deleteModal')"
                class="flex-1 flex items-center justify-center gap-2 py-2.5 bg-red-500/15 border border-red-500/25 rounded-xl text-sm font-bold text-red-400 hover:bg-red-500/25 transition-colors active:scale-95">
                <i class="fa-solid fa-trash"></i> Delete
            </button>
        </div>
    </div>
</div>

@endsection

