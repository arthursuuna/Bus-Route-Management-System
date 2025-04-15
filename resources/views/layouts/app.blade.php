<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>BPRMS - Bus Pass and Route Management System</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    {{-- Bootstrap 5 CSS --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    {{-- Custom Styles --}}
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f8f9fa;
            margin: 0;
            padding: 0;
        }

        .hero {
            background: url('/images/bus-bg.jpg') center center no-repeat;
            background-size: cover;
            min-height: 90vh;
            padding: 100px 0;
            color: white;
        }

        .navbar-brand img {
            height: 30px;
            margin-right: 8px;
        }

        .step-icon {
            height: 80px;
        }

        footer {
            background-color: #343a40;
            color: #fff;
            padding: 20px 0;
            text-align: center;
            font-size: 0.9rem;
        }
    </style>
</head>
<body>

    {{-- Navigation --}}
    <nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm">
        <div class="container">
            <a class="navbar-brand d-flex align-items-center" href="{{ route('home') }}">
                <img src="/logo.png" alt="BTBS Logo">
                <strong>BTBS</strong>
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navContent">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navContent">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item"><a class="nav-link" href="{{ route('home') }}">Home</a></li>
                    {{-- <li class="nav-item"><a class="nav-link" href="{{ route('bookings') }}">Make Bookings</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('tickets') }}">Check Tickets</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('register') }}">Register</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('login') }}">Login</a></li> --}}
                </ul>
            </div>
        </div>
    </nav>

    {{-- Page Content --}}
    <main>
        @yield('content')
    </main>

    {{-- Optional Footer --}}
    <footer class="mt-auto">
        <div class="container">
            <p class="mb-0">© {{ date('Y') }} BPRMS. All rights reserved.</p>
        </div>
    </footer>

    {{-- Bootstrap 5 JS --}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
