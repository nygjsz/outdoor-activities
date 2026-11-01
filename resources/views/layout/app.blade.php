<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Adventure &amp; Outdoor Activities</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Barlow:wght@400;500;600;700&family=Big+Shoulders+Display:wght@800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>
<body>

<nav>
    <a class="brand" href="{{ url('/home') }}">Adventure<span>&amp;</span>Outdoor</a>

    <a href="{{ url('/home') }}">Home</a>
    <a href="{{ url('/activities') }}">Activities</a>

    @auth
        <a href="{{ route('bookings.index') }}">
            {{ auth()->user()->role === 'admin' ? 'All Bookings' : 'My Bookings' }}
        </a>

        @if(auth()->user()->role === 'admin')
            <a href="{{ route('activities.create') }}">Add Activity</a>
            <a href="{{ route('guides.index') }}">Guides</a>
            <a href="{{ route('messages.index') }}">Messages</a>
        @endif
    @endauth

    <a href="{{ route('contact') }}">Contact</a>

    <form class="search" action="{{ url('/activities') }}" method="GET">
        <input type="text" name="search" placeholder="Search activities" aria-label="Search activities">
        <button type="submit">Search</button>
    </form>

    @auth
        <span class="nav-user">
            Hi, {{ auth()->user()->name }} ({{ auth()->user()->role }})
        </span>
        <form action="{{ route('logout') }}" method="POST" class="inline">
            @csrf
            <button type="submit">Logout</button>
        </form>
    @else
        <a class="nav-end" href="{{ route('login') }}">Login</a>
        <a href="{{ route('register') }}">Register</a>
    @endauth
</nav>

@yield('hero')

<div class="content">
    @if(session('success'))
        <p class="success">{{ session('success') }}</p>
    @endif
    @yield('content')
</div>

    <footer>
        <p>&copy; 2026 Adventure &amp; Outdoor Activities</p>
    </footer>

    @stack('scripts')
</body>
</html>