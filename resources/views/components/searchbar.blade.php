<!-- ini bagian search bar -->
           <div class="px-8 -mt-10 relative z-30">
    <div class="bg-[#1e1e1e] border border-white/10 rounded-2xl p-4 shadow-2xl flex flex-wrap lg:flex-nowrap items-end gap-4">

        <div class="flex-[2] min-w-[200px]">
            <label class="text-[9px] font-black text-gray-500 uppercase tracking-widest mb-2 block ml-1">Search Event Name</label>
            <div class="flex items-center gap-3 bg-white/5 rounded-xl px-4 py-3 border border-transparent focus-within:border-blue-500 transition">
                <i class="fa-solid fa-magnifying-glass text-blue-500"></i>
                <input type="text" placeholder="Seminar, workshop, konser..." class="bg-transparent w-full outline-none text-sm text-gray-200">
            </div>
        </div>

        <div class="flex-1 min-w-[150px]">
            <label class="text-[9px] font-black text-gray-500 uppercase tracking-widest mb-2 block ml-1">Category</label>
            <div class="relative group">
                <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                    <i class="fa-solid fa-tags text-blue-500 text-[12px]"></i>
                </div>
                <select class="w-full bg-white/5 border border-transparent rounded-xl py-3 pl-10 pr-8 text-xs font-bold text-gray-300 focus:border-blue-500 outline-none transition-all appearance-none cursor-pointer">
                    <option value="" class="bg-[#1e1e1e]">Semua</option>
                    <option value="edu" class="bg-[#1e1e1e]">Education</option>
                    <option value="music" class="bg-[#1e1e1e]">Music</option>
                    <option value="tech" class="bg-[#1e1e1e]">Technology</option>
                    <option value="art" class="bg-[#1e1e1e]">Art & Theater</option>
                </select>
                <div class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none text-gray-500">
                    <i class="fa-solid fa-chevron-down text-[10px]"></i>
                </div>
            </div>
        </div>

        <div class="flex-1 min-w-[150px]">
            <label class="text-[9px] font-black text-gray-500 uppercase tracking-widest mb-2 block ml-1">Select Date</label>
            <div class="relative group">
                <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                    <i class="fa-solid fa-calendar-day text-blue-500 text-[12px]"></i>
                </div>
                <input type="date" class="w-full bg-white/5 border border-transparent rounded-xl py-3 pl-10 pr-4 text-xs font-bold text-gray-300 focus:border-blue-500 outline-none transition-all cursor-pointer [color-scheme:dark]">
            </div>
        </div>

        <button class="w-full lg:w-auto px-8 py-3.5 bg-white text-black rounded-xl font-bold hover:bg-blue-500 hover:text-white transition-all active:scale-95 shadow-lg">
            Cari Event
        </button>
    </div>
</div>
