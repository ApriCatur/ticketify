<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ticketify | Settings Restricted</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;600;800&display=swap');
        body { font-family: 'Plus Jakarta Sans', sans-serif; }
        .glass { background: rgba(18, 18, 18, 0.8); backdrop-filter: blur(10px); }
    </style>
</head>
<body class="bg-[#0f0f0f] text-white antialiased">

    <div class="flex max-w-[1600px] mx-auto min-h-screen border-x border-gray-800 bg-[#121212] shadow-2xl">

        @include('layouts.sidebar-registrasi')

        <div class="flex-1 flex flex-col min-w-0 border-r border-white/5">

            <nav class="sticky top-0 z-50 glass border-b border-white/5 px-8 py-4 flex justify-between items-center">
                <img src="{{ asset('images/polibatam.png') }}" alt="Polibatam" class="h-14">
                <span class="text-[10px] font-black text-gray-500 uppercase tracking-[0.3em]">Technical Informatics Project</span>
            </nav>

            <main class="flex-1 flex items-center justify-center p-8 lg:p-16">
                <section class="text-center max-w-2xl mx-auto">

                    <div class="relative inline-block mb-10">
                        <div class="absolute inset-0 bg-red-500/10 blur-[60px] rounded-full"></div>
                        <div class="relative bg-[#1e1e1e] border border-white/10 w-32 h-32 rounded-3xl flex items-center justify-center mx-auto shadow-2xl">
                            <i class="fa-solid fa-gear text-5xl text-gray-600 animate-[spin_8s_linear_infinite]"></i>
                        </div>
                    </div>

                    <h1 class="text-4xl lg:text-5xl font-black italic tracking-tighter mb-4 uppercase">
                        Settings Locked
                    </h1>

                    <p class="text-gray-400 text-sm leading-relaxed mb-10 font-medium italic">
                        "Your account settings are unavailable because you are browsing as a guest. Please register to manage your profile."
                    </p>

                    <div class="grid grid-cols-1 gap-4 max-w-md mx-auto">
                        <div class="bg-[#1e1e1e]/50 border border-white/5 rounded-2xl p-4 flex items-center gap-4 text-left opacity-50">
                            <i class="fa-solid fa-user-pen text-blue-500"></i>
                            <span class="text-xs font-bold uppercase tracking-widest">Edit Profile & Avatar</span>
                        </div>
                        <div class="bg-[#1e1e1e]/50 border border-white/5 rounded-2xl p-4 flex items-center gap-4 text-left opacity-50">
                            <i class="fa-solid fa-lock text-red-500"></i>
                            <span class="text-xs font-bold uppercase tracking-widest">Security & Password</span>
                        </div>
                    </div>

                    <div class="mt-12">
                        <a href="/register" class="bg-[#1DB954] hover:bg-[#1ed760] text-black font-black uppercase text-xs tracking-widest px-12 py-4 rounded-full transition-all duration-300 inline-block transform hover:scale-105">
                            Register to Unlock
                        </a>
                    </div>
                </section>
            </main>

            <footer class="mt-auto bg-black/20 border-t border-white/5 p-8 text-center">
                <p class="text-[10px] font-bold text-gray-600 uppercase tracking-[0.3em]">&copy; 2026 Teknik Informatika - Politeknik Negeri Batam</p>
            </footer>
        </div>
    </div>

</body>
</html>
