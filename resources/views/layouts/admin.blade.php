<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Ticketify - Admin')</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
    @stack('styles')
</head>
<body class="bg-[#0f0f0f] text-white antialiased">

    <div class="flex w-full min-h-screen border-x border-gray-800 bg-[#121212] shadow-2xl">
        @include('layouts.sidebar-admin')

        <div class="flex-1 flex flex-col min-w-0{{ $hasRightSidebar ?? false ? ' border-r border-white/5' : '' }}">
            @if(($showNav ?? true))
                <x-admin-nav :title="$navTitle ?? $title ?? 'Dashboard'" :subtitle="$navSubtitle ?? null" />
            @endif
            @yield('content')
        </div>

        @hasSection('right-sidebar')
        <aside class="w-80 hidden xl:flex flex-col sticky top-0 h-screen p-8 space-y-8 bg-[#121212] overflow-y-auto">
            @yield('right-sidebar')
        </aside>
        @endif
    </div>

    @stack('scripts')
</body>
</html>