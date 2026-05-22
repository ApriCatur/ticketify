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
     <div class="max-w-6xl mx-auto">
    <div class="flex items-center gap-4 mb-8">
        <a href="{{ route('pembeli.event') }}" class="bg-[#18181b] hover:bg-white hover:text-black transition-all px-4 py-2 rounded-lg text-xs font-bold border border-white/5 flex items-center">
            <i class="fa-solid fa-arrow-left mr-2"></i> Back
        </a>
        <h1 class="text-2xl font-black tracking-tight italic uppercase">{{ $event->name }}</h1>
    </div>
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
                        <img src="{{ $event->banner ? asset('storage/'.$event->banner) : asset('images/kmipn.jpeg') }}" class="w-full h-full object-cover">
                    </div>
                    <div class="space-y-6">
                        <div class="bg-[#18181b] p-4 rounded-xl border border-white/5 flex items-center gap-4">
                            <i class="fa-solid fa-qrcode text-blue-500"></i>
                            <span class="text-sm font-bold">Our Social Media Event</span>
                        </div>
                        <div class="bg-[#18181b] p-5 rounded-2xl border border-white/5">
                            <h4 class="text-blue-500 font-bold text-sm mb-2"><i class="fa-solid fa-location-dot text-red-500 mr-2"></i>Location</h4>
                            <p class="text-xs text-gray-300 font-bold leading-relaxed">{{ $event->location }}</p>
                            @if($event->maps_link)
                                <p class="text-[10px] text-gray-500 mt-1"><a href="{{ $event->maps_link }}" target="_blank" class="text-blue-400">Open in Google Maps</a></p>
                            @endif
                        </div>
                        <div class="text-sm font-bold text-gray-400">
                            <i class="fa-solid fa-calendar-days text-blue-500 mr-2"></i> {{ \Illuminate\Support\Carbon::parse($event->date)->format('d F Y') }}, {{ \Illuminate\Support\Carbon::parse($event->time_start)->format('H:i') }} - {{ isset($event->time_end) ? \Illuminate\Support\Carbon::parse($event->time_end)->format('H:i') : \Illuminate\Support\Carbon::parse($event->time_start)->addHour()->format('H:i') }} WIB
                        </div>
                        <div class="text-[15px] text-gray-500 space-y-1">
                            <p>#Sharingandnetworking event</p>
                            <p>#SeminarNasionalKMIPN VII</p>
                            <p>#PoliteknikNegeriBatam</p>
                        </div>
                    </div>
                </div>

                <div class="text-center mb-8">
                    <h2 class="text-lg font-bold">Ticket Information</h2>
                    <span class="inline-block mt-2 px-4 py-1 bg-[#18181b] rounded-full text-[10px] border border-white/5 font-bold">
                        <i class="fa-solid fa-calendar-check mr-2"></i> Event Date : {{ \Illuminate\Support\Carbon::parse($event->date)->format('d F Y') }}, {{ \Illuminate\Support\Carbon::parse($event->time_start)->format('H:i') }} WIB
                    </span>
                </div>

                <div class="space-y-4 max-w-4xl mx-auto">
                    @php $tickets = $event->ticket_types ?? [];
                    if(empty($tickets) && ($event->ticket_type || $event->price)){
                        $tickets = [[ 'name' => $event->ticket_type ?? 'Reguler', 'price' => $event->price, 'stock' => $event->stock ]];
                    }
                    @endphp

                    @foreach($tickets as $ticket)
                        <div class="bg-[#18181b] p-6 rounded-2xl border border-white/5 flex items-center justify-between">
                            <div>
                                <h3 class="font-bold"><i class="fa-solid fa-ticket text-blue-500 mr-2"></i>{{ $ticket['name'] }}</h3>
                                <p class="text-[10px] text-gray-500 ml-6">Event Entry</p>
                            </div>
                            <div class="flex items-center gap-6">
                                <div class="text-right">
                                    <span class="text-[10px] text-gray-600 block">Stok: {{ $ticket['stock'] ?? '-' }}</span>
                                    <span class="font-black text-blue-400">IDR {{ number_format($ticket['price'] ?? 0, 0, ',', '.') }}</span>
                                </div>
                                <div class="flex items-center gap-3 bg-[#09090b] px-3 py-1 rounded-lg border border-white/10 font-bold">
                                    <button class="text-gray-500 hover:text-white">-</button>
                                    <span class="text-sm">0</span>
                                    <button class="text-gray-500 hover:text-white">+</button>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                <div class="mt-10 text-center">
                    <button class="w-full md:w-auto px-16 py-4 bg-white text-black font-black rounded-full hover:bg-blue-600 hover:text-white transition-all shadow-xl">
                        Buy Ticket Now
                    </button>
                </div>
            </div>

            <div x-show="tab === 'details'" x-transition style="display: none;">
                <div class="bg-[#18181b] p-8 rounded-3xl border border-white/5 mb-8">
                    <p class="text-sm text-gray-300 leading-relaxed text-justify">{!! nl2br(e($event->description)) !!}</p>
                </div>

                <div class="bg-[#18181b] p-8 rounded-3xl border border-white/5 mb-8">
                    <h3 class="text-center font-bold text-blue-500 mb-6"><i class="fa-solid fa-location-dot text-red-500 mr-2"></i>Location</h3>
                    <div class="h-64 bg-[#09090b] rounded-2xl border border-white/10 mb-4 overflow-hidden">
                        @if($event->maps_link)
                            <iframe class="w-full h-full grayscale invert opacity-70" src="{{ $event->maps_link }}" loading="diligent"></iframe>
                        @else
                            <div class="w-full h-full flex items-center justify-center text-gray-500">No map available</div>
                        @endif
                    </div>
                    <div class="text-center">
                        <p class="font-bold text-sm">{{ $event->location }}</p>
                    </div>
                </div>

                <div class="bg-[#18181b] p-8 rounded-3xl border border-white/5">
                    <h3 class="text-center font-bold text-blue-500 mb-8"><i class="fa-solid fa-file-lines mr-2"></i>Terms and Conditions</h3>
                    <div class="prose prose-invert max-w-none text-sm text-gray-300">
                        {!! nl2br(e($event->terms)) !!}
                    </div>
                </div>
            </div>

            <div x-show="tab === 'organiser'" x-transition style="display: none;">
                <div class="bg-[#18181b] p-10 rounded-3xl border border-white/5 text-center mb-8">
                    <i class="fa-solid fa-users text-blue-500 text-3xl mb-6"></i>
                    <p class="max-w-2xl mx-auto text-sm text-gray-400 leading-relaxed italic">{{ $event->organiser_description }}</p>
                </div>
                <div class="bg-[#18181b] p-8 rounded-3xl border border-white/5 text-center">
                    <h3 class="font-bold mb-6 text-white uppercase tracking-widest text-sm">Organizing Committee</h3>
                    <div class="rounded-2xl overflow-hidden border border-white/10 mb-4">
                        <img src="{{ $event->organiser_photo ? asset('storage/'.$event->organiser_photo) : asset('images/panitia_kmipn.jpeg') }}" class="w-full transition-all">
                    </div>
                    <p class="text-[10px] text-gray-600 font-bold italic">{{ $event->organiser_description ? 'Organiser profile' : '' }}</p>
                </div>
            </div>

        </div>
    </div>

</body>
</html>
