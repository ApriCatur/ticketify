@extends('layouts.admin')

@section('title', 'Role Applications')

@section('content')

<div class="px-8 mt-6">

    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
        <div class="bg-white p-6 rounded-2xl border border-gray-200 shadow-sm">
            <p class="text-gray-500 text-sm">Pending Requests</p>
            <h3 class="text-4xl font-black mt-2 text-amber-500">{{ $applications->where('status', 'pending')->count() }}</h3>
        </div>
        <div class="bg-white p-6 rounded-2xl border border-gray-200 shadow-sm">
            <p class="text-gray-500 text-sm">Approved</p>
            <h3 class="text-4xl font-black mt-2 text-emerald-600">{{ $applications->where('status', 'approved')->count() }}</h3>
        </div>
        <div class="bg-white p-6 rounded-2xl border border-gray-200 shadow-sm">
            <p class="text-gray-500 text-sm">Rejected</p>
            <h3 class="text-4xl font-black mt-2 text-red-600">{{ $applications->where('status', 'rejected')->count() }}</h3>
        </div>
    </div>

    <div class="bg-white rounded-2xl border border-gray-200 shadow-sm p-6">
        <div class="flex items-center gap-3 bg-gray-50 border border-gray-200 rounded-xl px-4 w-full md:w-80 focus-within:border-blue-500 transition-colors mb-6">
            <i class="fa-solid fa-magnifying-glass text-blue-500 text-sm"></i>
            <input type="text" id="searchInput" placeholder="Search applicant by name or NIM..."
                class="w-full py-3 bg-transparent outline-none text-sm text-gray-900 placeholder-gray-400 border-none ring-0 focus:ring-0">
        </div>

        <div class="overflow-x-auto">
            <table class="w-full" id="applicationsTable">
                <thead>
                    <tr class="border-b border-gray-200 text-left text-gray-500 text-sm">
                        <th class="py-4 font-semibold">No</th>
                        <th class="py-4 font-semibold">Applicant Name</th>
                        <th class="py-4 font-semibold">NIM</th>
                        <th class="py-4 font-semibold">Organization / UKM</th>
                        <th class="py-4 font-semibold">Bank Account</th>
                        <th class="py-4 font-semibold">Status</th>
                        <th class="py-4 font-semibold text-center">Actions</th>
                    </tr>
                </thead>

                <tbody class="divide-y divide-gray-200">
                    @php
                        $badgeClass = [
                            'pending'   => 'bg-amber-50 text-amber-600',
                            'approved'  => 'bg-emerald-50 text-emerald-600',
                            'rejected'  => 'bg-red-50 text-red-600',
                        ];
                    @endphp

                    @forelse ($applications as $i => $app)
                        <tr class="hover:bg-gray-50 transition-colors searchable-row">
                            <td class="py-4 text-gray-500 text-sm">{{ $i + 1 }}</td>
                            <td class="py-4">
                                <span class="font-medium text-sm text-gray-900">{{ $app->user->name }}</span>
                            </td>
                            <td class="py-4 text-gray-500 text-sm font-mono">{{ $app->user->nim }}</td>
                            <td class="py-4 text-gray-500 text-sm font-medium text-blue-600">{{ $app->ukm->nama_ukm ?? 'N/A' }}</td>
                            <td class="py-4 text-gray-500 text-sm font-mono">{{ $app->nomor_rekening }}</td>
                            <td class="py-4">
                                <span class="px-2.5 py-1 rounded-md text-xs font-bold {{ $badgeClass[$app->status] ?? 'bg-gray-100 text-gray-500' }}">
                                    {{ ucfirst($app->status) }}
                                </span>
                            </td>
                            <td class="py-4">
                                <div class="flex justify-center gap-2">
                                    @if ($app->status === 'pending')
                                        <form action="{{ route('admin.role-applications.approve', $app->id) }}" method="POST" class="inline">
                                            @csrf
                                            <button type="submit"
                                                class="flex items-center gap-1.5 px-3 py-1.5 rounded-lg bg-emerald-50 text-emerald-600 hover:bg-emerald-100 transition-colors text-xs font-semibold">
                                                <i class="fa-solid fa-check text-[11px]"></i> Approve
                                            </button>
                                        </form>
                                        <form action="{{ route('admin.role-applications.reject', $app->id) }}" method="POST" class="inline">
                                            @csrf
                                            <button type="submit"
                                                class="flex items-center gap-1.5 px-3 py-1.5 rounded-lg bg-red-50 text-red-600 hover:bg-red-100 transition-colors text-xs font-semibold"
                                                onclick="return confirm('Apakah Anda yakin ingin menolak pengajuan ini?')">
                                                <i class="fa-solid fa-times text-[11px]"></i> Reject
                                            </button>
                                        </form>
                                    @else
                                        <span class="text-gray-400 text-xs italic">No actions available</span>
                                    @endif
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="py-8 text-center text-gray-500">
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
