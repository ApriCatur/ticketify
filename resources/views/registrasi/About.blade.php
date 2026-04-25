<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ticketify | About Us</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;600;800&display=swap');
        body { font-family: 'Plus Jakarta Sans', sans-serif; }
        .glass { background: rgba(18, 18, 18, 0.8); backdrop-filter: blur(10px); }
        .team-card:hover { transform: translateY(-10px); border-color: #3b82f6; }
    </style>
</head>
<body class="bg-[#0f0f0f] text-white antialiased">

    <div class="flex max-w-[1600px] mx-auto min-h-screen border-x border-gray-800 bg-[#121212] shadow-2xl">

      @include('layouts.sidebar-registrasi')

        <div class="flex-1 flex flex-col min-w-0 border-r border-white/5">
            <nav class="sticky top-0 z-50 glass border-b border-white/5 px-8 py-4 flex justify-between items-center">
                <img src="{{ asset('images/polibatam.png') }}" alt="Polibatam" class="h-14 transition duration-500">
                <span class="text-[10px] font-black text-gray-500 uppercase tracking-[0.3em]">Technical Informatics Project</span>
            </nav>

            <main class="p-8 lg:p-16">
                <section class="text-center max-w-3xl mx-auto mb-20">
                    <h1 class="text-4xl lg:text-6xl font-black italic tracking-tighter mb-6 uppercase">Behind the Code</h1>
                    <p class="text-gray-400 text-sm leading-relaxed">
                        Ticketify is an event management and ticketing platform designed by Computer Science students at Batam State Polytechnic. This project is part of this semester's <span class="text-blue-500 font-bold">Project Based Learning (PBL)</span>program and aims to provide an efficient digital solution for campus organizations.
                    </p>
                </section>

                <section class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3  gap-8 mb-20">


                    <div class="team-card bg-[#1e1e1e] border border-white/5 rounded-3xl p-6 text-center transition-all duration-500">
                        <div class="w-24 h-24 bg-gray-800 rounded-full mx-auto mb-4 border border-white/10 overflow-hidden">
                             <img src="https://ui-avatars.com/api/?name=Syarifah+B&background=8b5cf6&color=fff" class="w-full h-full object-cover">
                        </div>
                        <h3 class="font-black italic text-lg tracking-tight">Syarifah B. S.</h3>
                        <p class="text-[10px] font-bold text-gray-500 uppercase tracking-widest mb-4">Fullstack Developer</p>
                        <p class="text-[10px] text-gray-500 mb-4">syarifah@student.polibatam.ac.id</p>
                        <div class="flex justify-center gap-3">
                            <a href="#" class="text-gray-600 hover:text-white transition"><i class="fa-brands fa-github"></i></a>
                        </div>
                    </div>

                    <div class="team-card bg-[#1e1e1e] border border-white/5 rounded-3xl p-6 text-center transition-all duration-500">
                        <div class="w-24 h-24 bg-gray-800 rounded-full mx-auto mb-4 border border-white/10 overflow-hidden">
                             <img src="https://ui-avatars.com/api/?name=Fauzi+A&background=10b981&color=fff" class="w-full h-full object-cover">
                        </div>
                        <h3 class="font-black italic text-lg tracking-tight">M. Fauzi Azhari</h3>
                        <p class="text-[10px] font-bold text-gray-500 uppercase tracking-widest mb-4">Fullstack Developer</p>
                        <p class="text-[10px] text-gray-500 mb-4">fauzi@student.polibatam.ac.id</p>
                        <div class="flex justify-center gap-3">
                            <a href="#" class="text-gray-600 hover:text-white transition"><i class="fa-brands fa-github"></i></a>
                        </div>
                    </div>

                    <div class="team-card bg-[#1e1e1e] border border-white/5 rounded-3xl p-6 text-center transition-all duration-500">
                        <div class="w-24 h-24 bg-gray-800 rounded-full mx-auto mb-4 border border-white/10 overflow-hidden">
                             <img src="https://ui-avatars.com/api/?name=Apri+C&background=f59e0b&color=fff" class="w-full h-full object-cover">
                        </div>
                        <h3 class="font-black italic text-lg tracking-tight">Apri Catur P.</h3>
                        <p class="text-[10px] font-bold text-gray-500 uppercase tracking-widest mb-4">Fullstack Developer</p>
                        <p class="text-[10px] text-gray-500 mb-4">apri@student.polibatam.ac.id</p>
                        <div class="flex justify-center gap-3">
                            <a href="#" class="text-gray-600 hover:text-white transition"><i class="fa-brands fa-github"></i></a>
                        </div>
                    </div>
                </section>

                <section class="bg-white/5 rounded-3xl p-8 border border-white/5">
                    <div class="flex flex-wrap items-center justify-between gap-8">
                        <div class="max-w-md">
                            <h4 class="text-lg font-black italic uppercase mb-2 italic">Our Purpose</h4>
                            <p class="text-xs text-gray-400 leading-relaxed font-medium">
                               This project was developed as a requirement for course credit in the Associate of Science in Computer Science program. We are committed to applying the highest standards in web development using the Laravel framework.
                            </p>
                        </div>
                        <div class="flex gap-6 items-center">
                            <i class="fa-brands fa-laravel text-4xl text-[#FF2D20]"></i>
                            <i class="fa-brands fa-php text-4xl text-[#777BB4]"></i>
                            <i class="fa-brands fa-js text-4xl text-[#F7DF1E]"></i>
                            <i class="fa-solid fa-database text-4xl text-gray-500"></i>
                        </div>
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
