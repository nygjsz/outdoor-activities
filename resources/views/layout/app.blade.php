<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Adventure &amp; Outdoor Activities</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>
<body>

<div class="adv">
    <img src="{{ asset('image/banner.jpg') }}" alt="Adventure banner">
    <div class="adv-text">
        <h2>Adventure &amp; Outdoor Activities</h2>
        <p>Hike. Paddle. Camp. Explore.</p>
    </div>
</div>

<nav>
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
        <input type="text" name="search" placeholder="Search...">
        <button type="submit">Search</button>
    </form>

    @auth
        <span style="margin-left:auto; color:#ddd;">
            Hi, {{ auth()->user()->name }} ({{ auth()->user()->role }})
        </span>
        <form action="{{ route('logout') }}" method="POST" class="inline">
            @csrf
            <button type="submit">Logout</button>
        </form>
    @else
        <a style="margin-left:auto;" href="{{ route('login') }}">Login</a>
        <a href="{{ route('register') }}">Register</a>
    @endauth
</nav>

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
