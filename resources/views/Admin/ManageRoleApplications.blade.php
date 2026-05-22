@extends('layouts.admin')

@section('title', 'Role Applications')

@section('content')

{{-- ── HEADER ─────────────────────────────────────────────── --}}
<nav class="sticky top-0 z-50 glass border-b border-white/5 px-8 py-5 flex justify-between items-center">
    <div>
        <h2 class="text-2xl font-black tracking-tight">Role Applications</h2>
        <p class="text-sm text-gray-500">Manage user role upgrade requests</p>
    </div>
</nav>

<div class="p-8">

    {{-- ── STATISTICS ─────────────────────────────────────────────── --}}
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
        <div class="bg-[#1e1e1e] p-6 rounded-2xl border border-white/5">
            <p class="text-gray-500 text-sm">Pending Requests</p>
            <h3 class="text-4xl font-black mt-2 text-yellow-400">{{ $applications->where('status', 'pending')->count() }}</h3>
        </div>
        <div class="bg-[#1e1e1e] p-6 rounded-2xl border border-white/5">
            <p class="text-gray-500 text-sm">Approved</p>
            <h3 class="text-4xl font-black mt-2 text-green-400">{{ $applications->where('status', 'approved')->count() }}</h3>
        </div>
        <div class="bg-[#1e1e1e] p-6 rounded-2xl border border-white/5">
            <p class="text-gray-500 text-sm">Rejected</p>
            <h3 class="text-4xl font-black mt-2 text-red-400">{{ $applications->where('status', 'rejected')->count() }}</h3>
        </div>
    </div>

    {{-- TABLE CARD --}}
    <div class="bg-[#1e1e1e] rounded-2xl border border-white/5 p-6">
        {{-- Search --}}
        <div class="flex items-center gap-3 bg-white/5 border border-transparent rounded-xl px-4 w-full md:w-80 focus-within:border-blue-500 transition-colors mb-6">
            <i class="fa-solid fa-magnifying-glass text-blue-500 text-sm"></i>
            <input type="text" id="searchInput" placeholder="Search applicant..."
                class="w-full py-3 bg-transparent outline-none text-sm text-white placeholder-gray-500 border-none ring-0 focus:ring-0">
        </div>

        {{-- Table --}}
        <div class="overflow-x-auto">
            <table class="w-full" id="applicationsTable">
                <thead>
                    <tr class="border-b border-white/5 text-left text-gray-500 text-sm">
                        <th class="py-4 font-semibold">No</th>
                        <th class="py-4 font-semibold">Applicant Name</th>
                        <th class="py-4 font-semibold">Email</th>
                        <th class="py-4 font-semibold">Organization</th>
                        <th class="py-4 font-semibold">Status</th>
                        <th class="py-4 font-semibold text-center">Actions</th>
                    </tr>
                </thead>

                <tbody class="divide-y divide-white/5">
                    @php
                        $badgeClass = [
                            'pending'   => 'bg-yellow-500/10 text-yellow-400',
                            'approved'  => 'bg-green-500/10 text-green-400',
                            'rejected'  => 'bg-red-500/10 text-red-400',
                        ];
                    @endphp

                    @forelse ($applications as $i => $app)
                        <tr class="hover:bg-white/5 transition-colors searchable-row">
                            <td class="py-4 text-gray-500 text-sm">{{ $i + 1 }}</td>
                            <td class="py-4">
                                <span class="font-medium text-sm text-white">{{ $app->user->name }}</span>
                            </td>
                            <td class="py-4 text-gray-400 text-sm">{{ $app->user->email }}</td>
                            <td class="py-4 text-gray-400 text-sm">{{ $app->organization_name }}</td>
                            <td class="py-4">
                                <span class="px-2.5 py-1 rounded-md text-xs font-bold {{ $badgeClass[$app->status] ?? 'bg-gray-500/10 text-gray-300' }}">
                                    {{ ucfirst($app->status) }}
                                </span>
                            </td>
                            <td class="py-4">
                                <div class="flex justify-center gap-2">
                                    @if ($app->status === 'pending')
                                        <form action="{{ route('admin.role-applications.approve', $app->id) }}" method="POST" class="inline">
                                            @csrf
                                            <button type="submit"
                                                class="flex items-center gap-1.5 px-3 py-1.5 rounded-lg bg-green-500/10 text-green-400 hover:bg-green-500/20 transition-colors text-xs font-semibold">
                                                <i class="fa-solid fa-check text-[11px]"></i> Approve
                                            </button>
                                        </form>
                                        <form action="{{ route('admin.role-applications.reject', $app->id) }}" method="POST" class="inline">
                                            @csrf
                                            <button type="submit"
                                                class="flex items-center gap-1.5 px-3 py-1.5 rounded-lg bg-red-500/10 text-red-400 hover:bg-red-500/20 transition-colors text-xs font-semibold"
                                                onclick="return confirm('Are you sure?')">
                                                <i class="fa-solid fa-times text-[11px]"></i> Reject
                                            </button>
                                        </form>
                                    @else
                                        <span class="text-gray-500 text-xs italic">No actions available</span>
                                    @endif
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="py-8 text-center text-gray-500">
                                <i class="fa-solid fa-inbox text-4xl mb-4 block opacity-50"></i>
                                No role applications found
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

<script>
    // Simple search functionality
    document.getElementById('searchInput').addEventListener('keyup', function(e) {
        const searchTerm = e.target.value.toLowerCase();
        const rows = document.querySelectorAll('.searchable-row');

        rows.forEach(row => {
            const text = row.textContent.toLowerCase();
            row.style.display = text.includes(searchTerm) ? '' : 'none';
        });
    });
</script>

@endsection
