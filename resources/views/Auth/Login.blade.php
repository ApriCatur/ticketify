<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ticketify | Login Access</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;600;800&display=swap');
        body { font-family: 'Plus Jakarta Sans', sans-serif; }
        .glass { background: rgba(18, 18, 18, 0.8); backdrop-filter: blur(10px); }

        /* Animasi halus khas Spotify */
        @keyframes fadeInUp {
            from { opacity: 0; transform: translateY(10px); }
            to { opacity: 1; transform: translateY(0); }
        }
        .animate-login { animation: fadeInUp 0.6s ease-out; }
    </style>
</head>
<body class="bg-[#0f0f0f] text-white antialiased">

    <div class="flex max-w-[1600px] mx-auto min-h-screen border-x border-gray-800 bg-[#121212] shadow-2xl">
        <div class="flex-1 flex flex-col min-w-0 border-r border-white/5">
            <nav class="sticky top-0 z-50 glass border-b border-white/5 px-8 py-4 flex justify-between items-center">
                <div>
                    <span class="text-sm text-gray-400 font-medium italic">Welcome back! Please login to your account.</span>
                </div>
                <div class="flex gap-4">
                    <a href="{{ route('event.index') }}" class="text-sm font-semibold text-gray-400 hover:text-white transition self-center">Back to Home</a>
                </div>
            </nav>

            <main class="flex-1 flex items-center justify-center p-8">
                <div class="w-full max-w-md bg-[#1e1e1e] border border-white/10 rounded-3xl p-10 shadow-2xl animate-login">
                    <div class="text-center mb-8">
                        <h2 class="text-3xl font-black italic tracking-tighter mb-2">Sign In</h2>
                        <p class="text-xs text-gray-500 uppercase tracking-[0.2em]">Enter your credentials</p>
                    </div>

                    <form action="{{ route('login') }}" method="POST" class="space-y-5">
                        @csrf
                        <div>
                            <label class="text-[10px] font-bold text-gray-500 uppercase ml-1 mb-2 block">Email / Username</label>
                            <div class="flex items-center gap-3 bg-white/5 rounded-xl px-4 py-3 border border-transparent focus-within:border-blue-500 transition">
                                <i class="fa-solid fa-envelope text-blue-500 text-sm"></i>
                                <input type="email" name="email" placeholder="maverick@student.polibatam.ac.id"
                                    class="bg-transparent w-full outline-none text-sm text-gray-200 placeholder:text-gray-700">
                            </div>
                        </div>

                        <div>
                            <label class="text-[10px] font-bold text-gray-500 uppercase ml-1 mb-2 block">Password</label>
                            <div class="flex items-center gap-3 bg-white/5 rounded-xl px-4 py-3 border border-transparent focus-within:border-blue-500 transition">
                                <i class="fa-solid fa-lock text-blue-500 text-sm"></i>
                                <input type="password" name="password" placeholder="••••••••"
                                    class="bg-transparent w-full outline-none text-sm text-gray-200 placeholder:text-gray-700">
                            </div>
                        </div>

                        <button type="submit" class="w-full py-4 bg-white text-black rounded-xl font-black uppercase text-xs tracking-widest hover:bg-blue-500 hover:text-white transition-all shadow-lg active:scale-95">
                            Login Now
                        </button>

                        <div class="text-center mt-6">
                            <a href="#" class="text-[10px] text-gray-500 hover:text-blue-400 transition uppercase font-bold tracking-widest">Forgot Password?</a>
                        </div>
                    </form>

                    <div class="mt-10 pt-8 border-t border-white/5 text-center">
                        <p class="text-xs text-gray-500">Don't have an account?</p>
                        <a href="{{ route('register') }}" class="inline-block mt-2 text-sm font-black text-blue-400 hover:underline">Register for Ticketify</a>
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
