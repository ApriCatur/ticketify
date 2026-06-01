<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ticketify - Detail Event</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body class="bg-[#09090b] text-white p-6 md:p-10" x-data="{ tab: 'ticket' }">

    <div class="max-w-6xl mx-auto">
        <div class="flex items-center justify-between mb-8">
            <div class="flex items-center gap-4">
                <a href="{{ route('panitia.myevent') }}"
                   class="bg-[#18181b] hover:bg-white hover:text-black transition-all px-4 py-2 rounded-lg text-xs font-bold border border-white/5 flex items-center">
                    <i class="fa-solid fa-arrow-left mr-2"></i>
                    Back
                </a>
                <div>
                    <h1 class="text-2xl font-black uppercase">
                        {{ $event->name }}
                    </h1>
                    <p class="text-xs text-gray-500 mt-1">
                        {{ $event->category }}
                    </p>
                </div>
            </div>

            <form action="{{ route('panitia.events.destroy', $event->id) }}"
                  method="POST"
                  onsubmit="return confirm('Yakin ingin menghapus event ini?')">
                @csrf
                @method('DELETE')
                <button type="submit"
                        class="bg-red-600 hover:bg-red-700 px-4 py-2 rounded-lg text-xs font-bold">
                    Hapus Event
                </button>
            </form>
        </div>

        <div class="flex justify-center mb-8 border-b border-white/5">
            <div class="flex gap-8">
                <button @click="tab = 'ticket'" :class="tab === 'ticket' ? 'border-b-2 border-blue-500 text-blue-500' : 'text-gray-500'" class="pb-4 px-4 font-bold text-sm transition-all flex items-center gap-2">
                    <i class="fa-solid fa-ticket"></i> Ticket
                </button>
                <button @click="tab = 'details'" :class="tab === 'details' ? 'border-b-2 border-blue-500 text-blue-500' : 'text-gray-500'" class="pb-4 px-4 font-bold text-sm transition-all flex items-center gap-2">
                    <i class="fa-solid fa-circle-info"></i> Details
                </button>
                <button @click="tab = 'organiser'" :class="tab === 'organiser' ? 'border-b-2 border-blue-500 text-blue-500' : 'text-gray-500'" class="pb-4 px-4 font-bold text-sm transition-all flex items-center gap-2">
                    <i class="fa-solid fa-users"></i> Organiser
                </button>
            </div>
        </div>

        <div class="bg-[#121212] rounded-3xl p-8 border border-white/5 shadow-2xl">

            <div x-show="tab === 'ticket'" x-transition>
                <div class="grid md:grid-cols-2 gap-10 mb-10 pb-10 border-b border-white/5">
                    <div class="rounded-2xl overflow-hidden border border-white/10 shadow-lg">
                        <img src="{{ $event->banner ? asset('images/events/'.$event->banner) : asset('images/kmipn.jpeg') }}"
                             class="w-full h-full object-cover">
                    </div>
                    <div class="space-y-6">
                        <div class="bg-[#18181b] p-4 rounded-xl border border-white/5 flex items-center gap-4">
                            <i class="fa-solid fa-qrcode text-blue-500"></i>
                            @if($event->social_link)
                                <a href="{{ $event->social_link }}"
                                   target="_blank"
                                   class="text-sm font-bold text-blue-400 hover:text-blue-300">
                                    Open Event Social Media
                                </a>
                            @else
                                <span class="text-sm font-bold text-gray-500">
                                    Social media not available
                                </span>
                            @endif
                        </div>
                        <div class="bg-[#18181b] p-5 rounded-2xl border border-white/5">
                            <h4 class="text-blue-500 font-bold text-sm mb-2"><i class="fa-solid fa-location-dot text-red-500 mr-2"></i>Location</h4>
                            <p class="text-xs text-gray-300 font-bold leading-relaxed">
                                {{ $event->location }}
                            </p>
                        </div>
                        <div class="text-sm font-bold text-gray-400">
                            {{ \Carbon\Carbon::parse($event->date)->format('d F Y') }},
                            {{ substr($event->time_start,0,5) }} WIB
                        </div>
                    </div>
                </div>

                <div class="text-center mb-8">
                    <h2 class="text-lg font-bold">Ticket Information</h2>
                    <span class="inline-block mt-2 px-4 py-1 bg-[#18181b] rounded-full text-[10px] border border-white/5 font-bold">
                        <i class="fa-solid fa-calendar-check mr-2"></i>{{ \Carbon\Carbon::parse($event->date)->format('d F Y') }},
                        {{ \Carbon\Carbon::parse($event->time_start)->format('H:i') }} WIB
                    </span>
                </div>

                <div class="space-y-4 max-w-4xl mx-auto">
                    @forelse($event->ticket_types ?? [] as $ticket)
                        <div class="bg-[#18181b] p-6 rounded-2xl border border-white/5 flex items-center justify-between">
                            <div>
                                <h3 class="font-bold">
                                    <i class="fa-solid fa-ticket text-blue-500 mr-2"></i>
                                    {{ $ticket['name'] }}
                                </h3>
                            </div>
                            <div class="text-right">
                                <span class="text-[10px] text-gray-600 block">
                                    Stock: {{ $ticket['stock'] }}
                                </span>
                                <span class="font-black text-blue-400">
                                    IDR {{ number_format($ticket['price'],0,',','.') }}
                                </span>
                            </div>
                        </div>
                    @empty
                        <p class="text-center text-gray-500">Tidak ada tipe tiket yang tersedia.</p>
                    @endforelse
                </div>

                <div class="mt-10 text-center">
                    <span class="text-xs text-gray-500 uppercase tracking-widest">Event Preview</span>
                </div>
            </div>

            <div x-show="tab === 'details'" x-transition style="display: none;">
                <div class="bg-[#18181b] p-8 rounded-3xl border border-white/5 mb-8">
                    <p class="text-sm text-gray-300 leading-relaxed text-justify">
                        {!! nl2br(e($event->description)) !!}
                    </p>
                </div>

                
                </div>

                <div class="bg-[#18181b] p-8 rounded-3xl border border-white/5">
                    <h3 class="text-center font-bold text-blue-500 mb-8"><i class="fa-solid fa-file-lines mr-2"></i>Terms and Conditions</h3>
                    <div class="grid md:grid-cols-2 gap-10 text-xs">
                        <div class="space-y-6">
                            <div class="text-sm text-gray-300 leading-relaxed whitespace-pre-line">
                                {{ $event->terms }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div x-show="tab === 'organiser'" x-transition style="display: none;">
                <div class="bg-[#18181b] p-10 rounded-3xl border border-white/5 text-center mb-8">
                    <i class="fa-solid fa-users text-blue-500 text-3xl mb-6"></i>
                    <p class="max-w-2xl mx-auto text-sm text-gray-400 leading-relaxed italic">
                        {{ $event->organiser_description ?? 'Belum ada deskripsi organiser.' }}
                    </p>
                </div>
                <div class="bg-[#18181b] p-8 rounded-3xl border border-white/5 text-center">
                    <h3 class="font-bold mb-6 text-white uppercase tracking-widest text-sm">Organizing Committee</h3>
                    <div class="rounded-2xl overflow-hidden border border-white/10 mb-4">
                        <img src="{{ $event->organiser_photo ? asset('images/organizers/'.$event->organiser_photo) : asset('images/panitia_kmipn.jpeg') }}"
                             class="w-full transition-all">
                        <p class="text-[10px] text-gray-600 font-bold italic py-2">This is a photo of the KMIPN Organizing Committee</p>
                    </div>
                </div>
            </div>

        </div> </div> </body>
</html>
