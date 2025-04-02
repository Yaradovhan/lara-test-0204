<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>SampleName</title>
    <!-- Bootstrap CSS (via CDN) -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        /* Sticky footer: wrapper min-height and footer pushed to bottom */
        html, body {
            height: 100%;
        }
        #page-content {
            flex: 1 0 auto;
        }
        #sticky-footer {
            flex-shrink: 0;
        }
        .d-flex-wrapper {
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }
    </style>
</head>
<body class="d-flex-wrapper">
<header class="container py-3">
    <div class="d-flex justify-content-between align-items-center">
        <!-- Left: Logo and SampleName -->
        <a href="{{ route('dashboard') }}" class="d-flex align-items-center text-decoration-none">
            <img src="{{ url('img/logo-1.webp') }}" alt="Logo" style="height:40px;" class="me-2">
            <span class="fs-4">SampleName</span>
        </a>

        <!-- Center: Menu -->
        <nav>
            <a href="{{ route('dashboard') }}" class="me-3">Dashboard</a>
            <a href="{{ route('plans') }}" class="me-3">Plans</a>
            @if(Auth::check() && Auth::user()->is_admin)
                <a href="{{ route('users') }}" class="me-3">Users</a>
            @endif
        </nav>

        <!-- Right: Auth Buttons -->
        <div>
            @if(Auth::check())
                <span class="me-2">{{ Auth::user()->name }}</span>
                <form action="{{ route('logout') }}" method="POST" class="d-inline">
                    @csrf
                    <button type="submit" class="btn btn-outline-secondary btn-sm">Sign out</button>
                </form>
            @else
                <a href="{{ route('register') }}" class="btn btn-primary btn-sm me-2">Register</a>
                <a href="{{ route('login') }}" class="btn btn-secondary btn-sm">Login</a>
            @endif
        </div>
    </div>
</header>

<div id="page-content" class="container">
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    @yield('content')
</div>

<footer id="sticky-footer" class="bg-light py-3 mt-auto">
    <div class="container text-center">
        <small>Copyright {{ date('Y') }} SampleName</small>
    </div>
</footer>

<!-- Bootstrap JS (via CDN) -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
