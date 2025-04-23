<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>BPRMS - Bus Pass and Route Management System</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    {{-- Bootstrap 5 CSS --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link
    href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css"
    rel="stylesheet"
    integrity="sha384‑ENjdO4Dr2bkBIFxQpeoYz1KfQ775nqEpHbU6fI1GOLcb7x3q4uO33B+18ifwk5y"
    crossorigin="anonymous"
  >

  <!-- DataTables CSS -->
  <link
    rel="stylesheet"
    href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css"
  >
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
    <nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm sticky-top">
        <div class="container">
            <a class="navbar-brand d-flex align-items-center" href="{{ route('home') }}">
                <img src="/logo.png" alt="BPRMS Logo" height="30" class="me-2">
                <strong>BPRMS</strong>
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navContent">
                <span class="navbar-toggler-icon"></span>
            </button>
    
            <div class="collapse navbar-collapse" id="navContent">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item"><a class="nav-link text-dark fw-bold" href="{{ route('home') }}">Home</a></li>
                    {{-- <li class="nav-item"><a class="nav-link" href="{{ route('bookings') }}">Make Bookings</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('tickets') }}">Check Tickets</a></li> --}}
                    <li class="nav-item"><a class="nav-link text-dark fw-bold" href="{{ route('register') }}">Register</a></li>
                    <li class="nav-item"><a class="nav-link text-dark fw-bold" href="{{ route('login') }}">Login</a></li>
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
  <!-- jQuery (required by DataTables) -->
  <script
    src="https://code.jquery.com/jquery-3.6.1.min.js"
    integrity="sha256‑Q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4="
    crossorigin="anonymous">
  </script>

  <!-- Bootstrap Bundle (includes Popper) -->
  <script
    src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"
    integrity="sha384‑QFjHSCiCtzBPY/zUEYbJeYt4AhJJrdX2OBOY4Jv36GTU4VBrfQ5p6WVk/GeV4Hr9"
    crossorigin="anonymous">
  </script>

  <!-- DataTables JS -->
  <script
    src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js">
  </script>

  <!-- Page‑specific scripts -->
  @stack('scripts')
</body>
</html>

</body>
</html>
