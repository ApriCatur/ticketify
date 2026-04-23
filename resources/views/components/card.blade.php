<!-- Cards -->
            <div class="flex-1">
                <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-6">

                    @for ($i = 0; $i < 6; $i++)
                    <div class="group bg-[#1e1e1e] border border-white/5 rounded-2xl overflow-hidden card-hover">

                        <div class="relative h-44 overflow-hidden">
                            <div class="w-full h-full bg-[#18181b] flex items-center justify-center">
                                <i class="fa-regular fa-image text-4xl text-gray-700"></i>
                            </div>

                            <div class="absolute top-3 right-3 bg-black/60 backdrop-blur-md px-3 py-2 rounded-xl text-center border border-white/10">
                                <span class="block text-[10px] font-bold text-blue-400 uppercase">APR</span>
                                <span class="block text-lg font-black">25</span>
                                <span class="text-[10px] text-gray-500">2026</span>
                            </div>
                        </div>

                        <div class="p-5">
                            <span class="text-[10px] font-bold text-blue-500 uppercase tracking-widest">
                                Seminar
                            </span>

                            <h3 class="font-bold text-lg mt-2 mb-3 group-hover:text-blue-400 transition">
                                Event Seminar KMIPN
                            </h3>

                            <div class="space-y-2 text-xs text-gray-400 mb-5">
                                <div class="flex items-center gap-2">
                                    <i class="fa-solid fa-location-dot"></i>
                                    Politeknik Negeri Batam
                                </div>

                                <div class="flex items-center gap-2">
                                    <i class="fa-regular fa-clock"></i>
                                    15:00 WIB
                                </div>

                                <div class="flex items-center gap-2">
                                    <i class="fa-solid fa-ticket"></i>
                                    IDR 40.000
                                </div>
                            </div>

                            <div class="flex gap-2 pt-4 border-t border-white/5">
                                <button class="px-4 py-2 border border-white/10 rounded-xl text-xs hover:bg-white/5 transition">
                                    Detail
                                </button>

                                <button class="flex-1 bg-red-500/10 text-red-400 py-2 rounded-xl text-xs hover:bg-red-500/20 transition">
                                    Unpublish
                                </button>
                            </div>
                        </div>
                    </div>
                    @endfor
