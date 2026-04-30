<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ticketify | My Tickets</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;600;800&display=swap');
        body { font-family: 'Plus Jakarta Sans', sans-serif; }
        .glass { background: rgba(18, 18, 18, 0.8); backdrop-filter: blur(10px); }
        .btn-primary {
            background: #1DB954;
            transition: all 0.3s ease;
        }
        .btn-primary:hover {
            background: #1ed760;
            transform: scale(1.05);
            box-shadow: 0 0 20px rgba(29, 185, 84, 0.4);
        }
    </style>
</head>
<body class="bg-[#0f0f0f] text-white antialiased">

    <div class="flex max-w-[1600px] mx-auto min-h-screen border-x border-gray-800 bg-[#121212] shadow-2xl">

        @include('layouts.sidebar-registrasi')

        <div class="flex-1 flex flex-col min-w-0 border-r border-white/5">
            <nav class="sticky top-0 z-50 glass border-b border-white/5 px-8 py-4 flex justify-between items-center">
            <div class="flex items-center gap-4">
             <!-- TOMBOL HAMBURGER: Sekarang muncul di mobile (lg:hidden) -->
            <button id="open-sidebar" class="lg:hidden text-gray-400 hover:text-blue-500 transition-colors">
                <i class="fa-solid fa-bars-staggered text-2xl"></i>
            </button>

                <img src="{{ asset('images/polibatam.png') }}" alt="Polibatam" class="h-14">
                <span class="text-[10px] font-black text-gray-500 uppercase tracking-[0.3em]">Technical Informatics Project</span>
            </nav>

            <main class="flex-1 flex items-center justify-center p-8 lg:p-16">
                <section class="text-center max-w-2xl mx-auto">
                    <div class="relative inline-block mb-10">
                        <div class="absolute inset-0 bg-blue-500/20 blur-[60px] rounded-full"></div>
                        <div class="relative bg-[#1e1e1e] border border-white/10 w-32 h-32 rounded-3xl flex items-center justify-center mx-auto shadow-2xl">
                            <i class="fa-solid fa-ticket-simple text-5xl text-gray-600 rotate-12"></i>
                        </div>
                    </div>

                    <h1 class="text-4xl lg:text-5xl font-black italic tracking-tighter mb-4 uppercase">
                        No Tickets Found
                    </h1>

                    <p class="text-gray-400 text-sm leading-relaxed mb-10 font-medium italic">
                        "Sorry, you don't have a registration account, so you do not have any tickets to show."
                    </p>

                    <div class="bg-[#1e1e1e] border border-white/5 rounded-3xl p-8 shadow-xl relative overflow-hidden">
                        <div class="absolute top-0 right-0 p-4 opacity-10">
                            <i class="fa-solid fa-shield-halved text-6xl"></i>
                        </div>

                        <h4 class="text-sm font-black uppercase tracking-widest mb-4 text-blue-500">Access Restricted</h4>
                        <p class="text-xs text-gray-400 mb-8 leading-relaxed">
                            Your personal dashboard and event history are only available for registered members of Batam State Polytechnic. Register now to claim your first event ticket.
                        </p>

                        <div class="flex flex-col sm:flex-row gap-4 justify-center">
                            <a href="/register" class="btn-primary text-black font-black uppercase text-xs tracking-widest px-10 py-4 rounded-full">
                                Create Account
                            </a>
                            <a href="/login" class="bg-white/5 hover:bg-white/10 border border-white/10 text-white font-black uppercase text-xs tracking-widest px-10 py-4 rounded-full transition">
                                Sign In
                            </a>
                        </div>
                    </div>
                </section>
            </main>

            <footer class="bg-black/20 border-t border-white/5 p-8 text-center">
                <p class="text-[10px] font-bold text-gray-600 uppercase tracking-[0.3em]">&copy; 2026 Teknik Informatika - Politeknik Negeri Batam</p>
            </footer>
        </div>
    </div>

    <script>
    const openBtn = document.getElementById('open-sidebar');
    const closeBtn = document.getElementById('close-sidebar');
    const sidebar = document.getElementById('main-sidebar');
    const overlay = document.getElementById('sidebar-overlay');

    // Cek apakah elemen ada sebelum menjalankan fungsi
    if (openBtn && sidebar) {
        function toggleSidebar() {
            sidebar.classList.toggle('-translate-x-full');
            if (overlay) {
                overlay.classList.toggle('hidden');
            }
            document.body.classList.toggle('overflow-hidden', !sidebar.classList.contains('-translate-x-full'));
        }

        openBtn.addEventListener('click', toggleSidebar);

        if (closeBtn) closeBtn.addEventListener('click', toggleSidebar);
        if (overlay) overlay.addEventListener('click', toggleSidebar);
    }
</script>

</body>
</html>
