<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Bus Pass and Route Management system</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite('resources/css/app.css') {{-- if using Vite + Tailwind --}}
</head>
<body class="bg-gray-100 text-gray-800">
    @include('partials.navbar')
    <main>
        @yield('content')
    </main>
</body>
</html>
