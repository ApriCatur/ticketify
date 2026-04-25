<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Ticketify Admin')</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <link rel="stylesheet"
          href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
</head>
<body class="bg-[#0f0f0f] text-white antialiased">

<div class="flex max-w-[1600px] mx-auto min-h-screen border-x border-white/5 bg-[#121212]">

    <x-sidebar />

    <div class="flex-1 flex flex-col min-w-0">
        @yield('content')
    </div>

</div>

</body>
</html>
