<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Ticketify - Admin Dashboard')</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    @stack('styles')
</head>
<body class="bg-[#09090b] text-white antialiased min-h-screen flex">

    @include('layouts.sidebar-admin')

    <main class="flex-1 min-w-0 p-8">
        @yield('content')
    </main>

    @stack('scripts')
</body>
</html>
