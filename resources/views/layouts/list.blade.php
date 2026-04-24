<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'My App')</title>
</head>
<body>

    <header>
        @include('components.header')
    </header>

    <div class="container">
        <h1>List Produk</h1>
        <main>
            @yield('content')
        </main>
    </div>

    <footer>
        @include('components.footer') 
    </footer>

</body>
</html>
