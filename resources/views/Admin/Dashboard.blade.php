@extends('layouts.admin')

@section('title', 'Dashboard')

@section('content')

<style>
    .card-hover {
        transition: all .3s ease;
    }

    .card-hover:hover {
        transform: translateY(-6px);
        box-shadow: 0 20px 25px rgba(59,130,246,.15);
    }
</style>

<!-- NAVBAR -->
<nav class="glass border-b border-white/5 px-8 py-4 flex justify-between items-center">
    <div>
        <h2 class="text-2xl font-black tracking-tight">Dashboard</h2>
        <p class="text-xs text-gray-500 mt-1">Overview of your platform</p>
    </div>

    <div class="flex items-center gap-3">
        <span class="text-sm text-gray-400 font-semibold">Admin</span>
        <div class="w-10 h-10 rounded-full bg-blue-600 flex items-center justify-center text-xs font-bold">
            AD
        </div>
    </div>
</nav>

<!-- CONTENT -->
<div class="p-8">

    <!-- STATS -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">

        <div class="bg-[#1e1e1e] border border-white/5 rounded-2xl p-6 card-hover">
            <div class="flex justify-between items-center">
                <p class="text-sm text-gray-500">Published Events</p>
                <i class="fa-solid fa-arrow-trend-up text-blue-500"></i>
            </div>
            <h3 class="text-4xl font-black mt-4">67</h3>
            <p class="text-xs text-gray-500 mt-2">Updated this month</p>
        </div>

        <div class="bg-[#1e1e1e] border border-white/5 rounded-2xl p-6 card-hover">
            <div class="flex justify-between items-center">
                <p class="text-sm text-gray-500">Pending Events</p>
                <i class="fa-solid fa-hourglass-half text-yellow-500"></i>
            </div>
            <h3 class="text-4xl font-black mt-4">19</h3>
            <p class="text-xs text-gray-500 mt-2">Waiting approval</p>
        </div>

        <div class="bg-[#1e1e1e] border border-white/5 rounded-2xl p-6 card-hover">
            <div class="flex justify-between items-center">
                <p class="text-sm text-gray-500">Users</p>
                <i class="fa-solid fa-user-group text-purple-500"></i>
            </div>
            <h3 class="text-4xl font-black mt-4">4</h3>
            <p class="text-xs text-gray-500 mt-2">Active users</p>
        </div>

    </div>

    <!-- CHARTS -->
    <div class="grid grid-cols-1 xl:grid-cols-3 gap-8">

        <!-- BAR CHART -->
        <div class="xl:col-span-2 bg-[#1e1e1e] border border-white/5 rounded-2xl p-8">
            <div class="flex justify-between items-center mb-6">
                <h3 class="font-black text-lg">Events by Category</h3>
                <i class="fa-solid fa-chart-column text-blue-500"></i>
            </div>

            <div class="flex items-end justify-between h-64 gap-6">
                <div class="w-16 bg-blue-500 rounded-t-xl h-52"></div>
                <div class="w-16 bg-purple-500 rounded-t-xl h-32"></div>
                <div class="w-16 bg-yellow-500 rounded-t-xl h-44"></div>
                <div class="w-16 bg-gray-500 rounded-t-xl h-24"></div>
            </div>

            <div class="flex justify-between mt-4 text-xs text-gray-500">
                <span>Music</span>
                <span>Edu</span>
                <span>Sport</span>
                <span>Seminar</span>
            </div>
        </div>

        <!-- PIE -->
        <div class="bg-[#1e1e1e] border border-white/5 rounded-2xl p-8 flex flex-col items-center">
            <div class="flex justify-between w-full items-center mb-6">
                <h3 class="font-black text-lg">Event Ratio</h3>
                <i class="fa-solid fa-chart-pie text-blue-500"></i>
            </div>

            <div class="w-44 h-44 rounded-full bg-[conic-gradient(#3b82f6_70%,#27272a_30%)]"></div>

            <div class="flex gap-5 mt-6 text-xs">
                <span>
                    <i class="fa-solid fa-circle text-blue-500 mr-1"></i>Published
                </span>
                <span class="text-gray-500">
                    <i class="fa-solid fa-circle text-gray-500 mr-1"></i>Pending
                </span>
            </div>

            <p class="text-xs text-gray-500 mt-4">Total Events: 86</p>
        </div>

    </div>

</div>

@endsection
