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
                        $badgeClass = [
                            'Admin'     => 'bg-blue-500/10 text-blue-400',
                            'Organizer' => 'bg-indigo-500/10 text-indigo-400',
                            'Customer'  => 'bg-gray-500/10 text-gray-300',
                        ];
                    @endphp

                    @foreach ($users as $i => $user)
                        <tr class="hover:bg-white/5 transition-colors">
                            <td class="py-4 text-gray-500 text-sm">{{ $i + 1 }}</td>
                            <td class="py-4">
                                <div class="flex items-center gap-3">
                                    <span class="font-medium text-sm text-white">{{ $user->name }}</span>
                                </div>
                            </td>
                            <td class="py-4 text-gray-400 text-sm">{{ $user->email }}</td>
                            <td class="py-4">
                                <span class="px-2.5 py-1 rounded-md text-xs font-bold {{ $badgeClass[$user->role] ?? 'bg-gray-500/10 text-gray-300' }}">
                                    {{ $user->role }}
                                </span>
                            </td>
                            <td class="py-4">
                                <div class="flex justify-center gap-2">
                                    <button onclick="openEditUser('{{ $user->id }}', '{{ $user->name }}')"
                                        class="flex items-center gap-1.5 px-3 py-1.5 rounded-lg bg-blue-500/10 text-blue-400 hover:bg-blue-500/20 transition-colors text-xs font-semibold">
                                        <i class="fa-solid fa-pen-to-square text-[11px]"></i> Edit
                                    </button>
                                    <button onclick="openDeleteUser('{{ $user->id }}', '{{ $user->name }}')"
                                        class="flex items-center gap-1.5 px-3 py-1.5 rounded-lg bg-red-500/10 text-red-400 hover:bg-red-500/20 transition-colors text-xs font-semibold">
                                        <i class="fa-solid fa-trash text-[11px]"></i> Delete
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
@endsection
