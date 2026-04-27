<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ticketify | Bruce Wayne Ticket</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;600;800&display=swap');
        body { font-family: 'Plus Jakarta Sans', sans-serif; }
    </style>
</head>
<body class="bg-[#0f0f0f] antialiased">

     <nav class="sticky top-0 z-50 glass px-8 py-4 flex justify-between items-center">
            <div class="flex gap-4">
                <a href="{{ route('pembeli.myticket') }}" class="text-sm font-semibold text-gray-400 hover:text-white transition self-center">Back</a>
            </div>
        </nav>
    </br>
    <div class="min-h-screen w-full flex items-center justify-center p-6 bg-[#121212]">

        <div class="relative w-full max-w-md bg-[#1e1e1e] border border-white/10 rounded-[3rem] overflow-hidden shadow-2xl">

            <div class="absolute top-0 left-1/2 -translate-x-1/2 w-64 h-64 bg-blue-500/10 blur-[80px] -z-10"></div>

            <div class="px-8 pt-10 pb-6 text-center">
                <div class="flex justify-center mb-4">
                    <div class="bg-white/5 border border-white/10 p-3 rounded-2xl">
                        <i class="fa-solid fa-star text-blue-500"></i>
                    </div>
                </div>
                <h2 class="text-4xl font-black italic uppercase tracking-tighter text-white">Ticketify</h2>
                <div class="mt-4 inline-flex items-center gap-2 bg-green-500/10 border border-green-500/20 px-3 py-1 rounded-full">
                    <div class="w-1.5 h-1.5 bg-green-500 rounded-full animate-pulse"></div>
                    <span class="text-green-500 text-[9px] font-black uppercase tracking-widest">Active</span>
                </div>
            </div>

            <div class="px-8 pb-6 flex flex-col items-center">
                <div class="bg-white p-5 rounded-[2.5rem] shadow-xl">
                    <img src="https://api.qrserver.com/v1/create-qr-code/?size=150x150&data=A89UHBCXL" class="w-32 h-32">
                </div>
                <p class="mt-4 text-[9px] text-gray-500 font-medium uppercase tracking-[0.2em]">Purchased on April 10, 2026, at 12:43:20</p>
            </div>

            <div class="relative border-t border-dashed border-white/10 my-4">
                <div class="absolute -left-5 -top-4 w-8 h-8 bg-[#121212] rounded-full border-r border-white/10"></div>
                <div class="absolute -right-5 -top-4 w-8 h-8 bg-[#121212] rounded-full border-l border-white/10"></div>
            </div>

            <div class="px-10 py-6">
                <div class="flex items-center gap-3 mb-6">
                    <i class="fa-solid fa-ticket text-blue-500 text-xl -rotate-12"></i>
                    <h3 class="text-2xl font-black italic uppercase text-white tracking-tight">Reguler Ticket</h3>
                </div>

                <div class="grid grid-cols-2 gap-y-6 mb-8">
                    <div>
                        <p class="text-[9px] text-gray-500 font-bold uppercase tracking-widest mb-1">Date</p>
                        <p class="text-sm font-bold text-white uppercase italic">24 April 2026</p>
                    </div>
                    <div class="text-right">
                        <p class="text-[9px] text-gray-500 font-bold uppercase tracking-widest mb-1">Time</p>
                        <p class="text-sm font-bold text-white uppercase italic">15 : 00</p>
                    </div>
                    <div class="col-span-2">
                        <p class="text-[9px] text-gray-500 font-bold uppercase tracking-widest mb-1">Location</p>
                        <div class="flex items-center gap-2">
                            <i class="fa-solid fa-location-dot text-red-500 text-xs"></i>
                            <p class="text-sm font-bold text-white uppercase italic">Politeknik Negeri Batam</p>
                        </div>
                    </div>
                </div>

                <div class="bg-white/5 border border-white/5 rounded-2xl p-4 text-center mb-8">
                    <p class="text-[9px] text-gray-500 font-black uppercase tracking-[0.3em] mb-2">Unique Code</p>
                    <p class="text-2xl font-black text-white tracking-[0.4em]">A89UHBCXL</p>
                </div>

                <div class="border-t border-white/5 pt-6 space-y-1">
                    <p class="text-[9px] text-gray-500 font-bold uppercase tracking-widest">On behalf of</p>
                    <p class="text-lg font-black text-white italic uppercase leading-none">Bruce Wayne</p>
                    <p class="text-[10px] text-gray-500 font-medium">iamnotabatman@gmail.com</p>
                </div>
            </div>

            <div class="grid grid-cols-2 border-t border-white/5 mt-4">
                <button class="py-6 border-r border-white/5 bg-white/[0.02] hover:bg-white/[0.05] transition flex items-center justify-center gap-2 group">
                    <i class="fa-solid fa-download text-gray-500 group-hover:text-blue-500 transition-colors"></i>
                    <span class="text-[10px] font-black uppercase tracking-[0.2em] text-white">Save</span>
                </button>
                <button class="py-6 bg-white/[0.05] hover:bg-white/10 transition">
                    <span class="text-[10px] font-black uppercase tracking-[0.2em] text-white">Close</span>
                </button>
            </div>
        </div>

    </div>

</body>
</html>
