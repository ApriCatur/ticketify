<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ticketify | Masuk</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;600;800&display=swap');
        * { font-family: 'Plus Jakarta Sans', sans-serif; }

        @keyframes float {
            0%, 100% { transform: translateY(0px); }
            50% { transform: translateY(-20px); }
        }
        @keyframes fadeSlide {
            from { opacity: 0; transform: translateX(30px); }
            to { opacity: 1; transform: translateX(0); }
        }
        @keyframes pulseGlow {
            0%, 100% { box-shadow: 0 0 20px rgba(59,130,246,0.15); }
            50% { box-shadow: 0 0 40px rgba(59,130,246,0.3); }
        }
        .animate-float { animation: float 6s ease-in-out infinite; }
        .animate-form { animation: fadeSlide 0.6s ease-out; }
        .glow-card { animation: pulseGlow 4s ease-in-out infinite; }
        .bg-grid {
            background-image:
                linear-gradient(rgba(255,255,255,0.03) 1px, transparent 1px),
                linear-gradient(90deg, rgba(255,255,255,0.03) 1px, transparent 1px);
            background-size: 40px 40px;
        }
        .brand-gradient {
            background: linear-gradient(135deg, #3b82f6, #8b5cf6);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }
    </style>
</head>
<body class="bg-[#0a0a0a] text-white antialiased overflow-hidden">
    <div class="flex w-full min-h-screen">
        {{-- LEFT: Branding Side --}}
        <div class="hidden lg:flex w-1/2 relative items-center justify-center overflow-hidden bg-[#0d0d0d]">
            <div class="absolute inset-0 bg-grid opacity-50"></div>
            <div class="absolute top-20 left-20 w-72 h-72 bg-blue-500/10 rounded-full blur-3xl"></div>
            <div class="absolute bottom-20 right-20 w-96 h-96 bg-purple-500/10 rounded-full blur-3xl"></div>

            <div class="relative z-10 text-center px-12">
                <div class="w-20 h-20 mx-auto mb-6 bg-gradient-to-br from-blue-500 to-cyan-400 rounded-2xl flex items-center justify-center shadow-2xl shadow-blue-500/20 animate-float">
                    <i class="fa-solid fa-ticket text-3xl text-white"></i>
                </div>
                <h1 class="text-4xl font-black tracking-tight mb-3">
                    <span class="brand-gradient">Ticketify</span>
                </h1>
                <p class="text-gray-500 text-sm max-w-md leading-relaxed">
                    Platform manajemen event dan tiket digital untuk mahasiswa Politeknik Negeri Batam.
                </p>
                <div class="mt-10 flex justify-center gap-6 text-gray-600 text-xs">
                    <span class="flex items-center gap-2"><i class="fa-solid fa-circle-check text-blue-500"></i> Event Digital</span>
                    <span class="flex items-center gap-2"><i class="fa-solid fa-circle-check text-blue-500"></i> Tiket QR</span>
                    <span class="flex items-center gap-2"><i class="fa-solid fa-circle-check text-blue-500"></i> Check-in Cepat</span>
                </div>
            </div>
        </div>

        {{-- RIGHT: Form Side --}}
        <div class="w-full lg:w-1/2 flex items-center justify-center p-6 bg-[#0a0a0a] relative">
            <div class="absolute inset-0 bg-[radial-gradient(ellipse_at_center,_rgba(59,130,246,0.05)_0%,_transparent_70%)]"></div>

            <div class="w-full max-w-md relative z-10 animate-form">
                {{-- Logo Mobile --}}
               <div class="flex lg:hidden items-center gap-3 mb-8">
                     <div class="w-10 h-10 bg-gradient-to-br from-blue-400 to-cyan-400 rounded-xl flex items-center justify-center shadow-lg shadow-cyan-500/20">
                        <i class="fa-solid fa-ticket text-white text-sm"></i>
                </div>
                    <span class="font-extrabold text-lg tracking-tight bg-gradient-to-r from-blue-400 to-cyan-400 bg-clip-text text-transparent"> Ticketify </span>
                </div>

                <div class="bg-[#141414] border border-white/[0.06] rounded-3xl p-8 md:p-10 glow-card">
                    <div class="mb-8">
                        <h2 class="text-2xl font-black tracking-tight mb-1">Selamat Datang</h2>
                        <p class="text-sm text-gray-500">Login akun Ticketify kamu</p>
                    </div>

                    {{-- Error --}}
                    @if ($errors->has('nim'))
                        <div class="mb-6 p-4 bg-red-500/10 border border-red-500/20 rounded-2xl flex items-start gap-3">
                            <i class="fa-solid fa-circle-exclamation text-red-400 text-lg mt-0.5 flex-shrink-0"></i>
                            <div>
                                <p class="text-red-400 text-sm font-bold">Login Gagal</p>
                                <p class="text-red-300/60 text-xs mt-1">{{ $errors->first('nim') }}</p>
                            </div>
                        </div>
                    @endif

                    {{-- Success --}}
                    @if (session('success'))
                        <div class="mb-6 p-4 bg-green-500/10 border border-green-500/20 rounded-2xl flex items-start gap-3">
                            <i class="fa-solid fa-circle-check text-green-400 text-lg mt-0.5 flex-shrink-0"></i>
                            <div>
                                <p class="text-green-400 text-sm font-bold">Berhasil</p>
                                <p class="text-green-300/60 text-xs mt-1">{{ session('success') }}</p>
                            </div>
                        </div>
                    @endif

                    <form action="{{ route('login') }}" method="POST" class="space-y-5">
                        @csrf
                        <div>
                            <label class="text-[10px] font-bold text-gray-500 uppercase tracking-widest ml-1 mb-2 block">NIM</label>
                            <div class="flex items-center gap-3 bg-white/[0.04] border border-white/[0.06] rounded-xl px-4 py-3 transition-all duration-300 focus-within:border-blue-500/50 focus-within:bg-blue-500/5 @error('nim') border-red-500/50 @enderror">
                                <i class="fa-solid fa-id-card text-blue-500 text-sm w-5 text-center"></i>
                                <input type="text" name="nim" value="{{ old('nim') }}" placeholder="Nomor Induk Mahasiswa" required
                                    class="bg-transparent w-full outline-none text-sm text-gray-200 placeholder:text-gray-700">
                            </div>
                        </div>

                        <div>
                            <label class="text-[10px] font-bold text-gray-500 uppercase tracking-widest ml-1 mb-2 block">Password</label>
                            <div class="flex items-center gap-3 bg-white/[0.04] border border-white/[0.06] rounded-xl px-4 py-3 transition-all duration-300 focus-within:border-blue-500/50 focus-within:bg-blue-500/5">
                                <i class="fa-solid fa-lock text-blue-500 text-sm w-5 text-center"></i>
                                <input type="password" id="password" name="password" placeholder="••••••••" required
                                    class="bg-transparent w-full outline-none text-sm text-gray-200 placeholder:text-gray-700">
                                <button type="button" onclick="togglePassword()" class="text-gray-500 hover:text-white transition">
                                    <i id="eyeIcon" class="fa-solid fa-eye"></i>
                                </button>
                            </div>
                        </div>

                        <div class="flex justify-end">
                            <a href="#" class="text-[10px] font-bold text-gray-600 hover:text-blue-400 transition uppercase tracking-widest">Lupa Password?</a>
                        </div>

                        <button type="submit" class="w-full py-3.5 bg-gradient-to-r from-blue-500 to-cyan-600 text-white rounded-xl font-black uppercase text-xs tracking-widest hover:from-blue-600 hover:to-cyan-700 transition-all duration-300 shadow-lg shadow-blue-500/20 active:scale-[0.98]">
                            <i class="fa-solid fa-right-to-bracket mr-2"></i> Login
                        </button>
                    </form>

                    <div class="mt-8 pt-6 border-t border-white/[0.04] text-center">
                        <p class="text-xs text-gray-600">Belum punya akun?</p>
                        <a href="{{ route('register') }}" class="inline-block mt-2 text-sm font-bold text-blue-400 hover:text-blue-300 transition">
                            Register <i class="fa-solid fa-arrow-right ml-1 text-xs"></i>
                        </a>
                    </div>
                </div>

                <p class="text-center mt-6 text-[10px] text-gray-700 font-bold uppercase tracking-[0.3em]">
                    &copy; 2026 Informatics Engineering - Polibatam
                </p>
            </div>
        </div>
    </div>

    <script>
        function togglePassword() {
            const input = document.getElementById('password');
            const icon = document.getElementById('eyeIcon');
            if (input.type === 'password') {
                input.type = 'text';
                icon.classList.replace('fa-eye', 'fa-eye-slash');
            } else {
                input.type = 'password';
                icon.classList.replace('fa-eye-slash', 'fa-eye');
            }
        }
    </script>
</body>
</html>
