<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ticketify | Create Account</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;600;800&display=swap');
        body { font-family: 'Plus Jakarta Sans', sans-serif; }
        .glass { background: rgba(18, 18, 18, 0.8); backdrop-filter: blur(10px); }

        @keyframes fadeInUp {
            from { opacity: 0; transform: translateY(10px); }
            to { opacity: 1; transform: translateY(0); }
        }
        .animate-regis { animation: fadeInUp 0.5s ease-out; }
    </style>
</head>
<body class="bg-[#0f0f0f] text-white antialiased">

    <div class="flex max-w-[1600px] mx-auto min-h-screen border-x border-gray-800 bg-[#121212] shadow-2xl">

        <aside class="w-64 hidden lg:flex flex-col sticky top-0 h-screen border-r border-white/5 p-6 space-y-8">
            <div class="flex items-center gap-2 mb-4">
                <div class="w-8 h-8 bg-blue-500 rounded-lg flex items-center justify-center font-bold text-white">T</div>
                <span class="font-extrabold text-xl tracking-tight uppercase">Ticketify</span>
            </div>
            <div class="space-y-6">
                <div>
                    <p class="text-[10px] font-black text-gray-500 uppercase tracking-widest mb-4 border-b border-white/5 pb-2">Navigasi</p>
                    <nav class="space-y-1">
                        <a href="{{ route('event.index') }}" class="flex items-center gap-3 p-3 hover:bg-white/5 rounded-xl text-sm text-gray-400 hover:text-white transition">
                            <i class="fa-solid fa-house"></i> Event
                        </a>
                        <a href="{{ route('login') }}" class="flex items-center gap-3 p-3 hover:bg-white/5 rounded-xl text-sm text-gray-400 hover:text-white transition">
                            <i class="fa-solid fa-right-to-bracket"></i> Sign In
                        </a>
                    </nav>
                </div>
            </div>
        </aside>

        <div class="flex-1 flex flex-col min-w-0 border-r border-white/5">
            <nav class="sticky top-0 z-50 glass border-b border-white/5 px-8 py-4 flex justify-between items-center">
                <span class="text-sm text-gray-400 font-medium italic tracking-tight">Join our community today!</span>
                <a href="{{ route('event.index') }}" class="text-[10px] font-black text-gray-500 hover:text-white uppercase tracking-widest transition">Cancel</a>
            </nav>

            <main class="flex-1 flex items-center justify-center p-8">
                <div class="w-full max-w-xl bg-[#1e1e1e] border border-white/10 rounded-3xl p-8 md:p-12 shadow-2xl animate-regis">
                    <div class="mb-10 text-center">
                        <h2 class="text-3xl font-black italic tracking-tighter mb-2 italic">Get Started</h2>
                        <p class="text-xs text-gray-500 uppercase tracking-[0.2em] font-bold">Create your Ticketify account</p>
                    </div>

                    <form action="#" method="POST" class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        @csrf

                        <div class="md:col-span-2">
                            <label class="text-[10px] font-bold text-gray-500 uppercase ml-1 mb-2 block">Full Name</label>
                            <div class="flex items-center gap-3 bg-white/5 rounded-xl px-4 py-3 border border-transparent focus-within:border-blue-500 transition">
                                <i class="fa-solid fa-user text-blue-500 text-sm w-5 text-center"></i>
                                <input type="text" name="name" placeholder="Maverick Ari" class="bg-transparent w-full outline-none text-sm text-gray-200">
                            </div>
                        </div>

                        <div>
                            <label class="text-[10px] font-bold text-gray-500 uppercase ml-1 mb-2 block">Email Address</label>
                            <div class="flex items-center gap-3 bg-white/5 rounded-xl px-4 py-3 border border-transparent focus-within:border-blue-500 transition">
                                <i class="fa-solid fa-envelope text-blue-500 text-sm w-5 text-center"></i>
                                <input type="email" name="email" placeholder="example@gmail.com" class="bg-transparent w-full outline-none text-sm text-gray-200">
                            </div>
                        </div>

                        <div>
                            <label class="text-[10px] font-bold text-gray-500 uppercase ml-1 mb-2 block">Phone Number</label>
                            <div class="flex items-center gap-3 bg-white/5 rounded-xl px-4 py-3 border border-transparent focus-within:border-blue-500 transition">
                                <i class="fa-solid fa-phone text-blue-500 text-sm w-5 text-center"></i>
                                <input type="tel" name="phone" placeholder="0812345678" class="bg-transparent w-full outline-none text-sm text-gray-200">
                            </div>
                        </div>

                        <div>
                            <label class="text-[10px] font-bold text-gray-500 uppercase ml-1 mb-2 block">Password</label>
                            <div class="flex items-center gap-3 bg-white/5 rounded-xl px-4 py-3 border border-transparent focus-within:border-blue-500 transition">
                                <i class="fa-solid fa-lock text-blue-500 text-sm w-5 text-center"></i>
                                <input type="password" name="password" placeholder="••••••••" class="bg-transparent w-full outline-none text-sm text-gray-200">
                            </div>
                        </div>

                        <div>
                            <label class="text-[10px] font-bold text-gray-500 uppercase ml-1 mb-2 block">Confirm Password</label>
                            <div class="flex items-center gap-3 bg-white/5 rounded-xl px-4 py-3 border border-transparent focus-within:border-blue-500 transition">
                                <i class="fa-solid fa-shield-check text-blue-500 text-sm w-5 text-center"></i>
                                <input type="password" name="password_confirmation" placeholder="••••••••" class="bg-transparent w-full outline-none text-sm text-gray-200">
                            </div>
                        </div>

                        <div class="md:col-span-2 mt-4">
                            <button type="submit" class="w-full py-4 bg-white text-black rounded-xl font-black uppercase text-xs tracking-widest hover:bg-blue-500 hover:text-white transition-all shadow-lg active:scale-95">
                                Register Account
                            </button>
                        </div>
                    </form>

                    <div class="mt-10 pt-8 border-t border-white/5 text-center">
                        <p class="text-[10px] font-bold text-gray-600 tracking-widest mb-3">Need help with registration?</p>
                        <div class="inline-flex items-center gap-3 bg-blue-500/10 px-6 py-3 rounded-2xl border border-blue-500/20">
                            <i class="fa-brands fa-whatsapp text-green-500 text-lg"></i>
                            <div>
                                <p class="text-[9px] font-bold text-green-500 text-left uppercase">Admin Support</p>
                                <p class="text-sm font-black text-green-400">0812-3445-5469</p>
                            </div>
                        </div>
                    </div>
                </div>
            </main>

            <footer class="bg-black/20 border-t border-white/5 p-8 text-center">
                <p class="text-[10px] font-bold text-gray-600 uppercase tracking-[0.3em]">&copy; 2026 Informatics Engineering - Polibatam</p>
            </footer>
        </div>
    </div>

</body>
</html>
