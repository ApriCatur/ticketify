@extends('layouts.admin')

@section('title', 'Event Categories')

@section('content')

<!-- Header -->
<nav class="sticky top-0 z-50 glass border-b border-white/5 px-8 py-5 flex justify-between items-center">
    <div>
        <h2 class="text-2xl font-black tracking-tight">Event Categories</h2>
        <p class="text-sm text-gray-500">Manage event classifications across the platform</p>
    </div>

</nav>

<div class="p-8">

    <!-- Statistics -->
    <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-4 gap-6 mb-8">

        <div class="bg-[#1e1e1e] p-6 rounded-2xl border border-white/5 card-hover">
            <p class="text-gray-500 text-sm">Total Categories</p>
            <h3 class="text-4xl font-black mt-2">5</h3>
        </div>

        <div class="bg-[#1e1e1e] p-6 rounded-2xl border border-white/5 card-hover">
            <p class="text-gray-500 text-sm">Active Categories</p>
            <h3 class="text-4xl font-black mt-2 text-blue-400">2</h3>
        </div>

        <div class="bg-[#1e1e1e] p-6 rounded-2xl border border-white/5 card-hover">
            <p class="text-gray-500 text-sm">Empty Categories</p>
            <h3 class="text-4xl font-black mt-2 text-gray-400">3</h3>
        </div>

        <div class="bg-[#1e1e1e] p-6 rounded-2xl border border-white/5 card-hover">
            <p class="text-gray-500 text-sm">Total Events</p>
            <h3 class="text-4xl font-black mt-2">19</h3>
        </div>

    </div>

    <!-- Table -->
    <div class="bg-[#1e1e1e] rounded-2xl border border-white/5 p-6">

        <!-- Search + Add -->
        <div class="flex flex-col md:flex-row justify-between gap-4 mb-6">
            <div class="flex items-center bg-white/5 rounded-xl px-4 w-full md:w-80">
                <i class="fa-solid fa-magnifying-glass text-blue-500 mr-3"></i>
                <input type="text" placeholder="Search category..."
                    class="w-full py-3 bg-transparent outline-none text-sm text-white placeholder-gray-500">
            </div>

            <button class="bg-white text-black px-6 py-3 rounded-xl font-bold hover:bg-blue-500 hover:text-white transition">
                <i class="fa-solid fa-plus mr-2"></i>
                Add Category
            </button>
        </div>

        <!-- Table -->
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead>
                    <tr class="border-b border-white/5 text-left text-gray-500 text-sm">
                        <th class="py-4">No</th>
                        <th class="py-4">Category Name</th>
                        <th class="py-4 text-center">Actions</th>
                    </tr>
                </thead>

                <tbody class="divide-y divide-white/5">
                    @php
                        $categories = ['Entertainment', 'Sports', 'Education', 'Business', 'Exhibitions'];
                    @endphp

                    @foreach ($categories as $index => $category)
                    <tr class="hover:bg-white/5 transition">
                        <td class="py-4">{{ $index + 1 }}</td>

                        <td class="py-4 font-medium">
                            {{ $category }}
                        </td>

                        <td class="py-4">
                            <div class="flex justify-center gap-4">
                                <button class="text-gray-400 hover:text-blue-400 transition">
                                    <i class="fa-solid fa-pen-to-square"></i>
                                </button>

                                <button class="text-gray-500 hover:text-red-400 transition">
                                    <i class="fa-solid fa-trash"></i>
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

@endsection
