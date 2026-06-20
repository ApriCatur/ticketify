<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ticketify - Customer Data</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;600;800&display=swap');
        body { font-family: 'Plus Jakarta Sans', sans-serif; }
    </style>
</head>
<body class="bg-[#09090b] text-white flex min-h-screen">
@include('layouts.sidebar-panitia')

    <main class="flex-1 p-10 overflow-y-auto">
        <header class="mb-10">
            <div class="flex items-center gap-2 text-xs text-gray-500 mb-4 font-bold tracking-widest">
                <a href="{{ route('panitia.myevent') }}" class="hover:text-blue-500">MY EVENTS</a>
                <i class="fa-solid fa-chevron-right text-[8px]"></i>
                <span class="text-white">ATTENDEE LIST</span>
            </div>
            <div class="flex justify-between items-end">
                <div>
                    <h1 class="text-3xl font-black tracking-tight uppercase italic text-blue-500">{{ $event->name }}</h1>
                    <p class="text-gray-500 text-sm mt-2 font-medium">Daftar lengkap peserta yang telah membeli tiket.</p>
                </div>
                <a href="{{ route('panitia.customerdata.export', $event->id) }}" class="bg-white/5 hover:bg-white/10 text-white px-6 py-3 rounded-xl text-xs font-black uppercase transition-all flex items-center gap-2 border border-white/5">
                    <i class="fa-solid fa-file-export text-blue-500"></i> Export Excel
                </a>
            </div>
        </header>

        <div class="bg-[#121212] rounded-[2.5rem] border border-white/5 overflow-hidden">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="border-b border-white/5 bg-white/[0.02]">
                        <th class="p-6 text-[10px] font-black text-gray-500 uppercase tracking-widest">No.</th>
                        <th class="p-6 text-[10px] font-black text-gray-500 uppercase tracking-widest">Peserta</th>
                        <th class="p-6 text-[10px] font-black text-gray-500 uppercase tracking-widest">Kontak</th>
                        <th class="p-6 text-[10px] font-black text-gray-500 uppercase tracking-widest">Kategori</th>
                        <th class="p-6 text-[10px] font-black text-gray-500 uppercase tracking-widest">Unique Code</th>
                        <th class="p-6 text-[10px] font-black text-gray-500 uppercase tracking-widest">Waktu Beli</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-white/5">
                    @forelse($attendees as $index => $ticket)
                        <tr class="hover:bg-white/[0.02] transition-colors group">
                            <td class="p-6 text-sm font-bold text-gray-600">
                                {{ sprintf('%02d', $attendees->firstItem() + $index) }}
                            </td>
                            <td class="p-6">
                                <div class="flex items-center gap-3">
                                    <div class="w-8 h-8 rounded-full bg-blue-600/20 text-blue-500 flex items-center justify-center font-bold text-[10px] uppercase">
                                        {{ substr($ticket->user->name ?? '??', 0, 2) }}
                                    </div>
                                    <div>
                                        <p class="text-sm font-black text-white">{{ $ticket->user->name ?? 'User Terhapus' }}</p>
                                        <p class="text-[11px] text-gray-500">{{ $ticket->user->email ?? '-' }}</p>
                                    </div>
                                </div>
                            </td>
                            <td class="p-6 text-xs text-gray-400 font-medium">
                                {{ $ticket->user->phone_number ?? '-' }}
                            </td>
                            <td class="p-6">
                                @if(strtoupper($ticket->ticket_type ?? '') === 'VIP')
                                    <span class="bg-purple-500/10 text-purple-500 px-3 py-1 rounded-lg text-[9px] font-black uppercase tracking-widest border border-purple-500/20">VIP</span>
                                @else
                                    <span class="bg-blue-500/10 text-blue-500 px-3 py-1 rounded-lg text-[9px] font-black uppercase tracking-widest border border-blue-500/20">{{ $ticket->ticket_type ?? 'REGULER' }}</span>
                                @endif
                            </td>
                            <td class="p-6">
                                <code class="bg-[#18181b] px-3 py-1 rounded-md text-blue-400 font-mono text-xs border border-white/5 group-hover:border-blue-500/50">
                                    {{ $ticket->qr_code ?? '-' }}
                                </code>
                            </td>
                            <td class="p-6 text-[11px] text-gray-500">
                                {{ $ticket->created_at ? $ticket->created_at->format('d M Y, H:i') : '-' }}
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="p-10 text-center text-sm font-medium text-gray-500 uppercase tracking-wider">
                                Belum ada peserta yang membeli tiket untuk event ini.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>

            <div class="p-6 bg-white/[0.01] border-t border-white/5 flex flex-col sm:flex-row gap-4 justify-between items-center">
                <p class="text-[10px] font-black text-gray-600 uppercase tracking-widest">
                    Showing {{ $attendees->firstItem() ?? 0 }} to {{ $attendees->lastItem() ?? 0 }} of {{ $attendees->total() }} Attendees
                </p>
                <div class="flex items-center shadow-lg shadow-blue-500/5 rounded-lg overflow-hidden border border-white/5">
                    {{ $attendees->links('pagination::tailwind') }}
                </div>
            </div>
        </div>
    </main>
</body>
</html>
