@extends('layouts.admin')

@section('title', 'Users Management')

@section('content')

{{-- HEADER --}}
<nav class="sticky top-0 z-50 glass border-b border-white/5 px-8 py-5 flex justify-between items-center">
    <div>
        <h2 class="text-2xl font-black tracking-tight">Users</h2>
        <p class="text-sm text-gray-500">Manage all users in the platform</p>
    </div>
</nav>

<div class="p-8">

    {{-- NOTIFIKASI --}}
    @if(session('success'))
        <div id="toast" class="fixed bottom-6 right-6 z-50 bg-green-500 text-white px-6 py-3 rounded-xl shadow-lg font-semibold flex items-center gap-2">
            <i class="fa-solid fa-circle-check"></i> {{ session('success') }}
        </div>
    @endif
    @if(session('error'))
        <div id="toast" class="fixed bottom-6 right-6 z-50 bg-red-500 text-white px-6 py-3 rounded-xl shadow-lg font-semibold flex items-center gap-2">
            <i class="fa-solid fa-circle-xmark"></i> {{ session('error') }}
        </div>
    @endif

    {{-- STATISTICS --}}
    <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-4 gap-6 mb-8">
        <div class="bg-[#1e1e1e] p-6 rounded-2xl border border-white/5">
            <p class="text-gray-500 text-sm">Total Users</p>
            <h3 class="text-4xl font-black mt-2">{{ $totalUsers }}</h3>
        </div>
        <div class="bg-[#1e1e1e] p-6 rounded-2xl border border-white/5">
            <p class="text-gray-500 text-sm">Admins</p>
            <h3 class="text-4xl font-black mt-2 text-blue-400">{{ $totalAdmins }}</h3>
        </div>
        <div class="bg-[#1e1e1e] p-6 rounded-2xl border border-white/5">
            <p class="text-gray-500 text-sm">Organizers</p>
            <h3 class="text-4xl font-black mt-2 text-indigo-400">{{ $totalOrganizers }}</h3>
        </div>
        <div class="bg-[#1e1e1e] p-6 rounded-2xl border border-white/5">
            <p class="text-gray-500 text-sm">Customers</p>
            <h3 class="text-4xl font-black mt-2 text-gray-300">{{ $totalCustomers }}</h3>
        </div>
    </div>

    {{-- TABS --}}
    <div class="flex gap-2 mb-6 flex-wrap">
        <button onclick="switchTab('admin')" id="tab-admin"
            class="px-5 py-2.5 rounded-xl text-sm font-bold transition-all bg-white text-black">
            <i class="fa-solid fa-shield-halved mr-1.5"></i> Admin
        </button>
        <button onclick="switchTab('pembeli')" id="tab-pembeli"
            class="px-5 py-2.5 rounded-xl text-sm font-bold transition-all bg-white/5 text-gray-400 hover:bg-white/10">
            <i class="fa-solid fa-users mr-1.5"></i> Pembeli
        </button>
        <button onclick="switchTab('panitia')" id="tab-panitia"
            class="px-5 py-2.5 rounded-xl text-sm font-bold transition-all bg-white/5 text-gray-400 hover:bg-white/10">
            <i class="fa-solid fa-people-group mr-1.5"></i> Panitia
        </button>
        <button onclick="switchTab('deleted')" id="tab-deleted"
            class="px-5 py-2.5 rounded-xl text-sm font-bold transition-all bg-white/5 text-gray-400 hover:bg-white/10">
            <i class="fa-solid fa-trash mr-1.5"></i> Deleted
            @if($deletedUsers->count() > 0)
                <span class="ml-1 bg-red-500 text-white text-xs px-1.5 py-0.5 rounded-full">{{ $deletedUsers->count() }}</span>
            @endif
        </button>
    </div>

    {{-- Search + Add (shared) --}}
    <div class="flex flex-col md:flex-row justify-between gap-4 mb-6" id="toolbar-search">
        <form method="GET" action="{{ route('admin.users') }}" class="w-full md:w-80">
            <div class="flex items-center gap-3 bg-white/5 border border-transparent rounded-xl px-4 focus-within:border-blue-500 transition-colors">
                <i class="fa-solid fa-magnifying-glass text-blue-500 text-sm"></i>
                <input type="text" name="search" value="{{ request('search') }}"
                    placeholder="Search user..."
                    class="w-full py-3 bg-transparent outline-none text-sm text-white placeholder-gray-500 border-none ring-0 focus:ring-0">
            </div>
        </form>
        <button onclick="openModal('addModal')"
            class="flex items-center gap-2 bg-white text-black px-6 py-3 rounded-xl font-bold hover:bg-blue-500 hover:text-white transition-all active:scale-95">
            <i class="fa-solid fa-plus text-sm"></i> Add User
        </button>
    </div>

    {{-- Validasi Error --}}
    @if($errors->any())
        <div class="bg-red-500/10 border border-red-500/30 text-red-400 rounded-xl px-5 py-4 mb-5 text-sm">
            <ul class="list-disc list-inside space-y-1">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    {{-- ═══════════════════════════════════════ --}}
    {{-- TAB: ADMIN                              --}}
    {{-- ═══════════════════════════════════════ --}}
    <div id="panel-admin">
        <div class="bg-[#1e1e1e] rounded-2xl border border-white/5 p-6">
            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead>
                        <tr class="border-b border-white/5 text-left text-gray-500 text-sm">
                            <th class="py-4 font-semibold">No</th>
                            <th class="py-4 font-semibold">Name</th>
                            <th class="py-4 font-semibold">Email</th>
                            <th class="py-4 font-semibold">Phone Number</th>
                            <th class="py-4 font-semibold text-center">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-white/5">
                        @forelse ($admins as $i => $user)
                            <tr class="hover:bg-white/5 transition-colors">
                                <td class="py-4 text-gray-500 text-sm">{{ $i + 1 }}</td>
                                <td class="py-4 font-medium text-sm text-white">{{ $user->name }}</td>
                                <td class="py-4 text-gray-400 text-sm">{{ $user->email }}</td>
                                <td class="py-4 text-gray-400 text-sm">{{ $user->phone_number ?? '-' }}</td>
                                <td class="py-4">
                                    <div class="flex justify-center gap-2">
                                        <button onclick="openEditUser({{ $user->id }}, '{{ addslashes($user->name) }}', '{{ $user->email }}', '{{ $user->phone_number }}', '{{ $user->role }}')"
                                            class="flex items-center gap-1.5 px-3 py-1.5 rounded-lg bg-blue-500/10 text-blue-400 hover:bg-blue-500/20 transition-colors text-xs font-semibold">
                                            <i class="fa-solid fa-pen-to-square text-[11px]"></i> Edit
                                        </button>
                                        <button onclick="openDeleteUser({{ $user->id }}, '{{ addslashes($user->name) }}')"
                                            class="flex items-center gap-1.5 px-3 py-1.5 rounded-lg bg-red-500/10 text-red-400 hover:bg-red-500/20 transition-colors text-xs font-semibold">
                                            <i class="fa-solid fa-trash text-[11px]"></i> Delete
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="py-12 text-center text-gray-500 text-sm">
                                    <i class="fa-solid fa-users-slash text-2xl mb-3 block"></i>
                                    Tidak ada admin ditemukan.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    {{-- ═══════════════════════════════════════ --}}
    {{-- TAB: PEMBELI                            --}}
    {{-- ═══════════════════════════════════════ --}}
    <div id="panel-pembeli" class="hidden">
        <div class="bg-[#1e1e1e] rounded-2xl border border-white/5 p-6">
            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead>
                        <tr class="border-b border-white/5 text-left text-gray-500 text-sm">
                            <th class="py-4 font-semibold">No</th>
                            <th class="py-4 font-semibold">NIM</th>
                            <th class="py-4 font-semibold">Nama</th>
                            <th class="py-4 font-semibold">No Telepon</th>
                            <th class="py-4 font-semibold text-center">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-white/5">
                        @forelse ($pembeli as $i => $user)
                            <tr class="hover:bg-white/5 transition-colors">
                                <td class="py-4 text-gray-500 text-sm">{{ $i + 1 }}</td>
                                <td class="py-4 text-gray-400 text-sm">{{ $user->nim ?? '-' }}</td>
                                <td class="py-4 font-medium text-sm text-white">{{ $user->name }}</td>
                                <td class="py-4 text-gray-400 text-sm">{{ $user->phone_number ?? '-' }}</td>
                                <td class="py-4">
                                    <div class="flex justify-center gap-2">
                                        <button onclick="openEditUser({{ $user->id }}, '{{ addslashes($user->name) }}', '{{ $user->email }}', '{{ $user->phone_number }}', '{{ $user->role }}')"
                                            class="flex items-center gap-1.5 px-3 py-1.5 rounded-lg bg-blue-500/10 text-blue-400 hover:bg-blue-500/20 transition-colors text-xs font-semibold">
                                            <i class="fa-solid fa-pen-to-square text-[11px]"></i> Edit
                                        </button>
                                        <button onclick="openDeleteUser({{ $user->id }}, '{{ addslashes($user->name) }}')"
                                            class="flex items-center gap-1.5 px-3 py-1.5 rounded-lg bg-red-500/10 text-red-400 hover:bg-red-500/20 transition-colors text-xs font-semibold">
                                            <i class="fa-solid fa-trash text-[11px]"></i> Delete
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="py-12 text-center text-gray-500 text-sm">
                                    <i class="fa-solid fa-users-slash text-2xl mb-3 block"></i>
                                    Tidak ada pembeli ditemukan.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    {{-- ═══════════════════════════════════════ --}}
    {{-- TAB: PANITIA                            --}}
    {{-- ═══════════════════════════════════════ --}}
    <div id="panel-panitia" class="hidden">
        <div class="bg-[#1e1e1e] rounded-2xl border border-white/5 p-6">
            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead>
                        <tr class="border-b border-white/5 text-left text-gray-500 text-sm">
                            <th class="py-4 font-semibold">No</th>
                            <th class="py-4 font-semibold">NIM</th>
                            <th class="py-4 font-semibold">Nama</th>
                            <th class="py-4 font-semibold">Asal UKM</th>
                            <th class="py-4 font-semibold">No Telepon</th>
                            <th class="py-4 font-semibold">No Rekening</th>
                            <th class="py-4 font-semibold text-center">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-white/5">
                        @forelse ($panitia as $i => $user)
                            <tr class="hover:bg-white/5 transition-colors">
                                <td class="py-4 text-gray-500 text-sm">{{ $i + 1 }}</td>
                                <td class="py-4 text-gray-400 text-sm">{{ $user->nim ?? '-' }}</td>
                                <td class="py-4 font-medium text-sm text-white">{{ $user->name }}</td>
                                <td class="py-4 text-gray-400 text-sm">{{ $user->panitiaProfile->asal_ukm ?? '-' }}</td>
                                <td class="py-4 text-gray-400 text-sm">{{ $user->phone_number ?? '-' }}</td>
                                <td class="py-4 text-gray-400 text-sm">{{ $user->panitiaProfile->no_rekening ?? '-' }}</td>
                                <td class="py-4">
                                    <div class="flex justify-center gap-2">
                                        <button onclick="openEditUser({{ $user->id }}, '{{ addslashes($user->name) }}', '{{ $user->email }}', '{{ $user->phone_number }}', '{{ $user->role }}')"
                                            class="flex items-center gap-1.5 px-3 py-1.5 rounded-lg bg-blue-500/10 text-blue-400 hover:bg-blue-500/20 transition-colors text-xs font-semibold">
                                            <i class="fa-solid fa-pen-to-square text-[11px]"></i> Edit
                                        </button>
                                        <button onclick="openDeleteUser({{ $user->id }}, '{{ addslashes($user->name) }}')"
                                            class="flex items-center gap-1.5 px-3 py-1.5 rounded-lg bg-red-500/10 text-red-400 hover:bg-red-500/20 transition-colors text-xs font-semibold">
                                            <i class="fa-solid fa-trash text-[11px]"></i> Delete
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="py-12 text-center text-gray-500 text-sm">
                                    <i class="fa-solid fa-users-slash text-2xl mb-3 block"></i>
                                    Tidak ada panitia ditemukan.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    {{-- ═══════════════════════════════════════ --}}
    {{-- TAB: DELETED USERS                      --}}
    {{-- ═══════════════════════════════════════ --}}
    <div id="panel-deleted" class="hidden">
        <div class="bg-[#1e1e1e] rounded-2xl border border-white/5 p-6">
            <p class="text-sm text-gray-500 mb-6">
                <i class="fa-solid fa-circle-info mr-1 text-yellow-400"></i>
                User di bawah ini sudah dihapus tapi datanya masih tersimpan. Kamu bisa pulihkan kapan saja.
            </p>
            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead>
                        <tr class="border-b border-white/5 text-left text-gray-500 text-sm">
                            <th class="py-4 font-semibold">No</th>
                            <th class="py-4 font-semibold">Name</th>
                            <th class="py-4 font-semibold">Email</th>
                            <th class="py-4 font-semibold">Role</th>
                            <th class="py-4 font-semibold">Dihapus Pada</th>
                            <th class="py-4 font-semibold text-center">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-white/5">
                        @forelse ($deletedUsers as $i => $user)
                            <tr class="hover:bg-white/5 transition-colors opacity-70">
                                <td class="py-4 text-gray-500 text-sm">{{ $i + 1 }}</td>
                                <td class="py-4 font-medium text-sm text-white line-through decoration-red-400">{{ $user->name }}</td>
                                <td class="py-4 text-gray-400 text-sm">{{ $user->email }}</td>
                                <td class="py-4">
                                    <span class="px-2.5 py-1 rounded-md text-xs font-bold bg-gray-500/10 text-gray-500">
                                        {{ $user->role }}
                                    </span>
                                </td>
                                <td class="py-4 text-gray-500 text-xs">
                                    {{ $user->deleted_at->format('d M Y, H:i') }}
                                </td>
                                <td class="py-4">
                                    <div class="flex justify-center gap-2">
                                        <form action="{{ route('admin.users.restore', $user->id) }}" method="POST">
                                            @csrf
                                            <button type="submit"
                                                class="flex items-center gap-1.5 px-3 py-1.5 rounded-lg bg-green-500/10 text-green-400 hover:bg-green-500/20 transition-colors text-xs font-semibold">
                                                <i class="fa-solid fa-rotate-left text-[11px]"></i> Pulihkan
                                            </button>
                                        </form>
                                        <form action="{{ route('admin.users.force-delete', $user->id) }}" method="POST"
                                            onsubmit="return confirm('Hapus permanen? Data tidak bisa dikembalikan!')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                class="flex items-center gap-1.5 px-3 py-1.5 rounded-lg bg-red-500/10 text-red-400 hover:bg-red-500/20 transition-colors text-xs font-semibold">
                                                <i class="fa-solid fa-xmark text-[11px]"></i> Hapus Permanen
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="py-12 text-center text-gray-500 text-sm">
                                    <i class="fa-solid fa-trash-can text-2xl mb-3 block"></i>
                                    Tidak ada user yang dihapus.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div>

{{-- ═══════════════════════════════════════════ --}}
{{-- MODAL ADD USER                              --}}
{{-- ═══════════════════════════════════════════ --}}
<div id="addModal" class="hidden fixed inset-0 z-50 flex items-center justify-center bg-black/60 backdrop-blur-sm">
    <div class="bg-[#1e1e1e] border border-white/10 rounded-2xl p-8 w-full max-w-md mx-4">
        <div class="flex items-center justify-between mb-6">
            <h3 class="text-xl font-black">Add New User</h3>
            <button onclick="closeModal('addModal')" class="text-gray-500 hover:text-white transition-colors">
                <i class="fa-solid fa-xmark text-lg"></i>
            </button>
        </div>
        <form action="{{ route('admin.users.store') }}" method="POST" class="space-y-4">
            @csrf
            <div>
                <label class="text-sm text-gray-400 mb-1 block">Name <span class="text-red-400">*</span></label>
                <input type="text" name="name" required placeholder="Nama lengkap"
                    class="w-full bg-white/5 border border-white/10 rounded-xl px-4 py-3 text-sm outline-none focus:border-blue-500 transition-colors placeholder-gray-600">
            </div>
            <div>
                <label class="text-sm text-gray-400 mb-1 block">Email <span class="text-red-400">*</span></label>
                <input type="email" name="email" required placeholder="contoh@email.com"
                    class="w-full bg-white/5 border border-white/10 rounded-xl px-4 py-3 text-sm outline-none focus:border-blue-500 transition-colors placeholder-gray-600">
            </div>
            <div>
                <label class="text-sm text-gray-400 mb-1 block">NIM <span class="text-gray-600 font-normal">(opsional)</span></label>
                <input type="text" name="nim" placeholder="Nomor Induk Mahasiswa"
                    class="w-full bg-white/5 border border-white/10 rounded-xl px-4 py-3 text-sm outline-none focus:border-blue-500 transition-colors placeholder-gray-600">
            </div>
            <div>
                <label class="text-sm text-gray-400 mb-1 block">Phone Number <span class="text-red-400">*</span></label>
                <input type="text" name="phone_number" required placeholder="08xxxxxxxxxx"
                    class="w-full bg-white/5 border border-white/10 rounded-xl px-4 py-3 text-sm outline-none focus:border-blue-500 transition-colors placeholder-gray-600">
            </div>
            <div>
                <label class="text-sm text-gray-400 mb-1 block">Password <span class="text-red-400">*</span></label>
                <input type="password" name="password" required placeholder="Minimal 8 karakter"
                    class="w-full bg-white/5 border border-white/10 rounded-xl px-4 py-3 text-sm outline-none focus:border-blue-500 transition-colors placeholder-gray-600">
            </div>
            <div>
                <label class="text-sm text-gray-400 mb-1 block">Role <span class="text-red-400">*</span></label>
                <select name="role" required id="addRole"
                    onchange="togglePanitiaFields(this.value, 'add')"
                    class="w-full bg-[#2a2a2a] border border-white/10 rounded-xl px-4 py-3 text-sm outline-none focus:border-blue-500 transition-colors">
                    <option value="pembeli">Pembeli</option>
                    <option value="panitia">Panitia</option>
                    <option value="admin">Admin</option>
                </select>
            </div>
            {{-- Field khusus panitia --}}
            <div id="add-panitia-fields" class="hidden space-y-4">
                <div>
                    <label class="text-sm text-gray-400 mb-1 block">Asal UKM</label>
                    <input type="text" name="asal_ukm" placeholder="Nama UKM"
                        class="w-full bg-white/5 border border-white/10 rounded-xl px-4 py-3 text-sm outline-none focus:border-blue-500 transition-colors placeholder-gray-600">
                </div>
                <div>
                    <label class="text-sm text-gray-400 mb-1 block">No Rekening</label>
                    <input type="text" name="no_rekening" placeholder="Nomor rekening bank"
                        class="w-full bg-white/5 border border-white/10 rounded-xl px-4 py-3 text-sm outline-none focus:border-blue-500 transition-colors placeholder-gray-600">
                </div>
            </div>
            <div class="flex gap-3 pt-2">
                <button type="button" onclick="closeModal('addModal')"
                    class="flex-1 py-3 rounded-xl border border-white/10 text-sm font-semibold hover:bg-white/5 transition-colors">
                    Cancel
                </button>
                <button type="submit"
                    class="flex-1 py-3 rounded-xl bg-white text-black text-sm font-bold hover:bg-blue-500 hover:text-white transition-all active:scale-95">
                    Add User
                </button>
            </div>
        </form>
    </div>
</div>

{{-- ═══════════════════════════════════════════ --}}
{{-- MODAL EDIT USER                             --}}
{{-- ═══════════════════════════════════════════ --}}
<div id="editModal" class="hidden fixed inset-0 z-50 flex items-center justify-center bg-black/60 backdrop-blur-sm">
    <div class="bg-[#1e1e1e] border border-white/10 rounded-2xl p-8 w-full max-w-md mx-4">
        <div class="flex items-center justify-between mb-2">
            <h3 class="text-xl font-black">Edit User</h3>
            <button onclick="closeModal('editModal')" class="text-gray-500 hover:text-white transition-colors">
                <i class="fa-solid fa-xmark text-lg"></i>
            </button>
        </div>
        <p class="text-xs text-gray-500 mb-5">Kosongkan field yang tidak ingin diubah.</p>
        <form id="editForm" method="POST" class="space-y-4">
            @csrf
            @method('PUT')
            <div>
                <label class="text-sm text-gray-400 mb-1 block">Name <span class="text-gray-600 font-normal">(opsional)</span></label>
                <input type="text" name="name" id="editName" placeholder="Kosongkan jika tidak ingin mengubah"
                    class="w-full bg-white/5 border border-white/10 rounded-xl px-4 py-3 text-sm outline-none focus:border-blue-500 transition-colors placeholder-gray-600">
            </div>
            <div>
                <label class="text-sm text-gray-400 mb-1 block">Email <span class="text-gray-600 font-normal">(opsional)</span></label>
                <input type="email" name="email" id="editEmail" placeholder="Kosongkan jika tidak ingin mengubah"
                    class="w-full bg-white/5 border border-white/10 rounded-xl px-4 py-3 text-sm outline-none focus:border-blue-500 transition-colors placeholder-gray-600">
            </div>
            <div>
                <label class="text-sm text-gray-400 mb-1 block">NIM <span class="text-gray-600 font-normal">(opsional)</span></label>
                <input type="text" name="nim" id="editNim" placeholder="Kosongkan jika tidak ingin mengubah"
                    class="w-full bg-white/5 border border-white/10 rounded-xl px-4 py-3 text-sm outline-none focus:border-blue-500 transition-colors placeholder-gray-600">
            </div>
            <div>
                <label class="text-sm text-gray-400 mb-1 block">Phone Number <span class="text-gray-600 font-normal">(opsional)</span></label>
                <input type="text" name="phone_number" id="editPhone" placeholder="Kosongkan jika tidak ingin mengubah"
                    class="w-full bg-white/5 border border-white/10 rounded-xl px-4 py-3 text-sm outline-none focus:border-blue-500 transition-colors placeholder-gray-600">
            </div>
            <div>
                <label class="text-sm text-gray-400 mb-1 block">Password <span class="text-gray-600 font-normal">(opsional)</span></label>
                <input type="password" name="password" placeholder="Kosongkan jika tidak ingin mengubah"
                    class="w-full bg-white/5 border border-white/10 rounded-xl px-4 py-3 text-sm outline-none focus:border-blue-500 transition-colors placeholder-gray-600">
            </div>
            <div>
                <label class="text-sm text-gray-400 mb-1 block">Role</label>
                <select name="role" id="editRole"
                    class="w-full bg-[#2a2a2a] border border-white/10 rounded-xl px-4 py-3 text-sm outline-none focus:border-blue-500 transition-colors">
                    <option value="">-- Tidak mengubah role --</option>
                    <option value="pembeli">Pembeli</option>
                    <option value="panitia">Panitia</option>
                    <option value="admin">Admin</option>
                </select>
            </div>
            <div class="flex gap-3 pt-2">
                <button type="button" onclick="closeModal('editModal')"
                    class="flex-1 py-3 rounded-xl border border-white/10 text-sm font-semibold hover:bg-white/5 transition-colors">
                    Cancel
                </button>
                <button type="submit"
                    class="flex-1 py-3 rounded-xl bg-blue-500 text-white text-sm font-bold hover:bg-blue-600 transition-all active:scale-95">
                    Save Changes
                </button>
            </div>
        </form>
    </div>
</div>

{{-- ═══════════════════════════════════════════ --}}
{{-- MODAL DELETE USER                           --}}
{{-- ═══════════════════════════════════════════ --}}
<div id="deleteModal" class="hidden fixed inset-0 z-50 flex items-center justify-center bg-black/60 backdrop-blur-sm">
    <div class="bg-[#1e1e1e] border border-white/10 rounded-2xl p-8 w-full max-w-sm mx-4 text-center">
        <div class="w-16 h-16 bg-red-500/10 rounded-full flex items-center justify-center mx-auto mb-4">
            <i class="fa-solid fa-trash text-red-400 text-2xl"></i>
        </div>
        <h3 class="text-xl font-black mb-2">Hapus User?</h3>
        <p class="text-gray-400 text-sm mb-1">
            User <span id="deleteUserName" class="text-white font-semibold"></span> akan dipindahkan ke Deleted.
        </p>
        <p class="text-gray-600 text-xs mb-6">Data masih tersimpan dan bisa dipulihkan kapan saja.</p>
        <form id="deleteForm" method="POST">
            @csrf
            @method('DELETE')
            <div class="flex gap-3">
                <button type="button" onclick="closeModal('deleteModal')"
                    class="flex-1 py-3 rounded-xl border border-white/10 text-sm font-semibold hover:bg-white/5 transition-colors">
                    Cancel
                </button>
                <button type="submit"
                    class="flex-1 py-3 rounded-xl bg-red-500 text-white text-sm font-bold hover:bg-red-600 transition-all active:scale-95">
                    Ya, Hapus
                </button>
            </div>
        </form>
    </div>
</div>

{{-- ═══════════════════════════════════════════ --}}
{{-- JAVASCRIPT                                  --}}
{{-- ═══════════════════════════════════════════ --}}
<script>
    function openModal(id) {
        document.getElementById(id).classList.remove('hidden');
        document.body.style.overflow = 'hidden';
    }
    function closeModal(id) {
        document.getElementById(id).classList.add('hidden');
        document.body.style.overflow = '';
    }

    ['addModal', 'editModal', 'deleteModal'].forEach(function(id) {
        document.getElementById(id).addEventListener('click', function(e) {
            if (e.target === this) closeModal(id);
        });
    });

    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape') ['addModal', 'editModal', 'deleteModal'].forEach(closeModal);
    });

    // Tampilkan/sembunyikan field panitia di modal Add
    function togglePanitiaFields(role, prefix) {
        const fields = document.getElementById(prefix + '-panitia-fields');
        if (fields) fields.classList.toggle('hidden', role !== 'panitia');
    }

    function openEditUser(id, name, email, phone, role) {
        document.getElementById('editName').value  = '';
        document.getElementById('editEmail').value = '';
        document.getElementById('editNim').value   = '';
        document.getElementById('editPhone').value = '';
        document.getElementById('editRole').value  = '';
        document.getElementById('editForm').action =
            '{{ route("admin.users.update", ":id") }}'.replace(':id', id);
        openModal('editModal');
    }

    function openDeleteUser(id, name) {
        document.getElementById('deleteUserName').textContent = name;
        document.getElementById('deleteForm').action =
            '{{ route("admin.users.destroy", ":id") }}'.replace(':id', id);
        openModal('deleteModal');
    }

    // Switch tab: admin / pembeli / panitia / deleted
    const tabs = ['admin', 'pembeli', 'panitia', 'deleted'];

    function switchTab(active) {
        tabs.forEach(function(tab) {
            const panel = document.getElementById('panel-' + tab);
            const btn   = document.getElementById('tab-' + tab);
            if (tab === active) {
                panel.classList.remove('hidden');
                btn.className = 'px-5 py-2.5 rounded-xl text-sm font-bold transition-all bg-white text-black';
            } else {
                panel.classList.add('hidden');
                btn.className = 'px-5 py-2.5 rounded-xl text-sm font-bold transition-all bg-white/5 text-gray-400 hover:bg-white/10';
            }
        });
        // Sembunyikan toolbar search saat tab deleted
        document.getElementById('toolbar-search').classList.toggle('hidden', active === 'deleted');
    }

    // Auto-hide toast
    const toast = document.getElementById('toast');
    if (toast) {
        setTimeout(function() {
            toast.style.opacity = '0';
            toast.style.transition = 'opacity 0.5s ease';
            setTimeout(function() { toast.remove(); }, 500);
        }, 3000);
    }
</script>

@endsection
