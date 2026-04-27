@extends('layouts.admin')

@section('title', 'Event Categories')

@section('content')

{{-- ── HEADER ─────────────────────────────────────────────── --}}
<nav class="sticky top-0 z-50 glass border-b border-white/5 px-8 py-5 flex justify-between items-center">
    <div>
        <h2 class="text-2xl font-black tracking-tight">Event Categories</h2>
        <p class="text-sm text-gray-500">Manage event classifications across the platform</p>
    </div>
</nav>

<div class="p-8">

    {{-- ── STATISTICS --}}
    <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-4 gap-6 mb-8">
        <div class="bg-[#1e1e1e] p-6 rounded-2xl border border-white/5">
            <p class="text-gray-500 text-sm">Total Categories</p>
            <h3 class="text-4xl font-black mt-2">5</h3>
        </div>
        <div class="bg-[#1e1e1e] p-6 rounded-2xl border border-white/5">
            <p class="text-gray-500 text-sm">Active Categories</p>
            <h3 class="text-4xl font-black mt-2 text-blue-400">2</h3>
        </div>
        <div class="bg-[#1e1e1e] p-6 rounded-2xl border border-white/5">
            <p class="text-gray-500 text-sm">Empty Categories</p>
            <h3 class="text-4xl font-black mt-2 text-gray-400">3</h3>
        </div>
        <div class="bg-[#1e1e1e] p-6 rounded-2xl border border-white/5">
            <p class="text-gray-500 text-sm">Total Events</p>
            <h3 class="text-4xl font-black mt-2">19</h3>
        </div>
    </div>

    {{-- TABLE CARD --}}
    <div class="bg-[#1e1e1e] rounded-2xl border border-white/5 p-6">

        {{-- Search + Add --}}
        <div class="flex flex-col md:flex-row justify-between gap-4 mb-6">
            <div class="flex items-center gap-3 bg-white/5 border border-transparent rounded-xl px-4 w-full md:w-80 focus-within:border-blue-500 transition-colors">
                <i class="fa-solid fa-magnifying-glass text-blue-500 text-sm"></i>
                <input type="text" placeholder="Search category..."
                    class="w-full py-3 bg-transparent outline-none text-sm text-white placeholder-gray-500 border-none ring-0 focus:ring-0">
            </div>
            <button onclick="openModal('addModal')"
                class="flex items-center gap-2 bg-white text-black px-6 py-3 rounded-xl font-bold hover:bg-blue-500 hover:text-white transition-all active:scale-95">
                <i class="fa-solid fa-plus text-sm"></i>
                Add Category
            </button>
        </div>

        {{-- Table --}}
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead>
                    <tr class="border-b border-white/5 text-left text-gray-500 text-sm">
                        <th class="py-4 font-semibold">No</th>
                        <th class="py-4 font-semibold">Category Name</th>
                        <th class="py-4 font-semibold text-center">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-white/5">

                    @php
                        $categories = ['Entertainment', 'Sports', 'Education', 'Business', 'Exhibitions'];
                        $categoryColors = [
                            'Entertainment' => 'bg-purple-500/20 text-purple-400',
                            'Sports'        => 'bg-green-500/20 text-green-400',
                            'Education'     => 'bg-yellow-500/20 text-yellow-400',
                            'Business'      => 'bg-blue-500/20 text-blue-400',
                            'Exhibitions'   => 'bg-pink-500/20 text-pink-400',
                        ];
                        $categoryIcons = [
                            'Entertainment' => 'fa-star',
                            'Sports'        => 'fa-trophy',
                            'Education'     => 'fa-graduation-cap',
                            'Business'      => 'fa-briefcase',
                            'Exhibitions'   => 'fa-image',
                        ];
                    @endphp

                    @foreach ($categories as $i => $category)
                        @php
                            $color = $categoryColors[$category] ?? 'bg-gray-500/20 text-gray-300';
                            $icon  = $categoryIcons[$category] ?? 'fa-tag';
                        @endphp
                        <tr class="hover:bg-white/5 transition-colors">
                            <td class="py-4 text-gray-500 text-sm">{{ $i + 1 }}</td>
                            <td class="py-4">
                                <div class="flex items-center gap-3">
                                    <div class="w-8 h-8 rounded-lg flex items-center justify-center text-xs {{ $color }}">
                                        <i class="fa-solid {{ $icon }}"></i>
                                    </div>
                                    <span class="font-medium text-sm">{{ $category }}</span>
                                </div>
                            </td>
                            <td class="py-4">
                                <div class="flex justify-center gap-2">
                                    <button onclick="openEditCategory('{{ $category }}')"
                                        class="flex items-center gap-1.5 px-3 py-1.5 rounded-lg bg-blue-500/10 text-blue-400 hover:bg-blue-500/20 transition-colors text-xs font-semibold">
                                        <i class="fa-solid fa-pen-to-square text-[11px]"></i> Edit
                                    </button>
                                    <button onclick="openDeleteCategory('{{ $category }}')"
                                        class="flex items-center gap-1.5 px-3 py-1.5 rounded-lg bg-red-500/10 text-red-400 hover:bg-red-500/20 transition-colors text-xs font-semibold">
                                        <i class="fa-solid fa-trash text-[11px]"></i> Delete
                                    </button>
                                </div>
                            </td>
                        </tr>
                    @endforeach

                </tbody>
            </table>
        </div>
    </div>
</div>

{{-- MODAL: ADD CATEGORY --}}
<div id="addModal" class="fixed inset-0 bg-black/70 backdrop-blur-sm hidden items-center justify-center z-50 p-4">
    <div class="bg-[#1e1e1e] w-full max-w-md rounded-3xl border border-white/10 overflow-hidden shadow-2xl">
        <div class="px-6 py-4 flex justify-between items-center bg-gradient-to-r from-blue-700 to-blue-600">
            <div class="flex items-center gap-3">
                <div class="w-8 h-8 rounded-xl bg-white/20 flex items-center justify-center">
                    <i class="fa-solid fa-plus text-white text-sm"></i>
                </div>
                <h2 class="text-white font-bold">Add New Category</h2>
            </div>
            <button onclick="closeModal('addModal')"
                class="w-8 h-8 rounded-xl bg-white/15 hover:bg-white/25 text-white flex items-center justify-center transition-colors">
                <i class="fa-solid fa-xmark"></i>
            </button>
        </div>
        <div class="p-6">
            <div class="flex items-center gap-3 mb-5">
                <span class="text-[9px] font-black text-blue-500 uppercase tracking-widest whitespace-nowrap">Category Information</span>
                <div class="flex-1 h-px bg-blue-500/20"></div>
            </div>
            <div class="flex flex-col gap-2">
                <label class="text-[9px] font-black text-gray-500 uppercase tracking-widest ml-1">Category Name</label>
                <div class="flex items-center gap-3 bg-white/5 border border-white/8 rounded-xl px-4 py-3 focus-within:border-blue-500 transition-colors">
                    <i class="fa-solid fa-tag text-blue-500 text-xs flex-shrink-0"></i>
                    <input type="text" placeholder="Enter category name..."
                        class="bg-transparent w-full outline-none border-none ring-0 text-sm text-gray-200 placeholder-gray-600">
                </div>
            </div>
        </div>
        <div class="px-6 py-4 border-t border-white/5 flex justify-end gap-3">
            <button onclick="closeModal('addModal')"
                class="px-5 py-2.5 bg-white/5 border border-white/10 rounded-xl text-sm text-gray-300 font-semibold hover:bg-white/10 transition-colors">
                Cancel
            </button>
            <button class="flex items-center gap-2 px-6 py-2.5 bg-blue-600 hover:bg-blue-500 rounded-xl text-sm text-white font-bold transition-colors active:scale-95">
                <i class="fa-solid fa-floppy-disk"></i> Save Category
            </button>
        </div>
    </div>
</div>

{{-- MODAL: EDIT CATEGORY --}}
<div id="editModal" class="fixed inset-0 bg-black/70 backdrop-blur-sm hidden items-center justify-center z-50 p-4">
    <div class="bg-[#1e1e1e] w-full max-w-md rounded-3xl border border-white/10 overflow-hidden shadow-2xl">
        <div class="px-6 py-4 flex justify-between items-center bg-gradient-to-r from-blue-950 to-blue-700">
            <div class="flex items-center gap-3">
                <div class="w-8 h-8 rounded-xl bg-white/20 flex items-center justify-center">
                    <i class="fa-solid fa-pen-to-square text-white text-sm"></i>
                </div>
                <h2 class="text-white font-bold">Edit Category</h2>
            </div>
            <button onclick="closeModal('editModal')"
                class="w-8 h-8 rounded-xl bg-white/15 hover:bg-white/25 text-white flex items-center justify-center transition-colors">
                <i class="fa-solid fa-xmark"></i>
            </button>
        </div>
        <div class="mx-6 mt-5 flex items-center gap-3 px-4 py-3 bg-blue-500/5 border border-blue-500/15 rounded-2xl">
            <div class="w-10 h-10 rounded-xl bg-blue-500/20 text-blue-400 flex items-center justify-center text-sm flex-shrink-0">
                <i class="fa-solid fa-tag"></i>
            </div>
            <div class="min-w-0">
                <p class="text-xs text-gray-500">Editing category</p>
                <p id="editBadgeName" class="font-bold text-sm truncate"></p>
            </div>
        </div>
        <div class="p-6 pt-4">
            <div class="flex items-center gap-3 mb-5">
                <span class="text-[9px] font-black text-blue-500 uppercase tracking-widest whitespace-nowrap">Edit Information</span>
                <div class="flex-1 h-px bg-blue-500/20"></div>
            </div>
            <div class="flex flex-col gap-2">
                <label class="text-[9px] font-black text-gray-500 uppercase tracking-widest ml-1">Category Name</label>
                <div class="flex items-center gap-3 bg-white/5 border border-white/8 rounded-xl px-4 py-3 focus-within:border-blue-500 transition-colors">
                    <i class="fa-solid fa-tag text-blue-500 text-xs flex-shrink-0"></i>
                    <input id="editCategoryName" type="text" placeholder="Category name..."
                        class="bg-transparent w-full outline-none border-none ring-0 text-sm text-gray-200 placeholder-gray-600">
                </div>
            </div>
        </div>
        <div class="px-6 py-4 border-t border-white/5 flex justify-end gap-3">
            <button onclick="closeModal('editModal')"
                class="px-5 py-2.5 bg-white/5 border border-white/10 rounded-xl text-sm text-gray-300 font-semibold hover:bg-white/10 transition-colors">
                Cancel
            </button>
            <button class="flex items-center gap-2 px-6 py-2.5 bg-blue-600 hover:bg-blue-500 rounded-xl text-sm text-white font-bold transition-colors active:scale-95">
                <i class="fa-solid fa-floppy-disk"></i> Save Changes
            </button>
        </div>
    </div>
</div>

{{-- MODAL: DELETE CATEGORY --}}
<div id="deleteModal" class="fixed inset-0 bg-black/70 backdrop-blur-sm hidden items-center justify-center z-50 p-4">
    <div class="bg-[#1e1e1e] w-full max-w-sm rounded-3xl border border-white/10 overflow-hidden shadow-2xl">
        <div class="px-6 py-4 flex justify-between items-center border-b border-white/5">
            <div class="flex items-center gap-3">
                <div class="w-8 h-8 rounded-xl bg-red-500/20 flex items-center justify-center">
                    <i class="fa-solid fa-trash text-red-400 text-sm"></i>
                </div>
                <h2 class="font-bold">Delete Category</h2>
            </div>
            <button onclick="closeModal('deleteModal')"
                class="w-8 h-8 rounded-xl bg-white/5 hover:bg-white/10 text-gray-400 hover:text-white flex items-center justify-center transition-colors">
                <i class="fa-solid fa-xmark"></i>
            </button>
        </div>
        <div class="p-6 text-center">
            <div class="w-16 h-16 mx-auto mb-4 rounded-full bg-red-500/10 border border-red-500/20 flex items-center justify-center">
                <i class="fa-solid fa-folder-minus text-red-400 text-2xl"></i>
            </div>
            <h3 class="font-bold text-lg mb-2">Are you sure want to delete this category?</h3>
            <p class="text-sm text-gray-500 leading-relaxed mb-5">
                This action <span class="text-red-400 font-semibold">cannot be undone</span>.
                All events under this category may be affected.
            </p>
            <div class="flex items-center gap-3 p-3 bg-white/5 border border-white/8 rounded-2xl mb-4 text-left">
                <div class="w-10 h-10 rounded-xl bg-red-500/20 text-red-400 flex items-center justify-center text-sm flex-shrink-0">
                    <i class="fa-solid fa-tag"></i>
                </div>
                <div class="min-w-0">
                    <p class="text-xs text-gray-500">Category</p>
                    <p id="deleteCategoryName" class="font-semibold text-sm truncate"></p>
                </div>
            </div>
        </div>
        <div class="px-6 pb-6 flex gap-3">
            <button onclick="closeModal('deleteModal')"
                class="flex-1 py-2.5 bg-white/5 border border-white/10 rounded-xl text-sm font-semibold text-gray-300 hover:bg-white/10 transition-colors">
                Cancel
            </button>
            <button onclick="closeModal('deleteModal')"
                class="flex-1 flex items-center justify-center gap-2 py-2.5 bg-red-500/15 border border-red-500/25 rounded-xl text-sm font-bold text-red-400 hover:bg-red-500/25 transition-colors active:scale-95">
                <i class="fa-solid fa-trash"></i> Delete
            </button>
        </div>
    </div>
</div>

@endsection
