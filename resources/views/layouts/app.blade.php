<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <title>{{ config('app.name') }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="stylesheet" href="{{ asset('css/gameclub.css') }}">
</head>
<body>
    <header>
        <nav>
            <a href="/">Home</a> |
            <a href="/dashboard">Dashboard</a> |
            <a href="/news">Nieuws</a> |
            <a href="/faq">FAQ</a> |
            <a href="/contact">Contact</a> |

            @can('manage-users')
                <a href="{{ route('admin.users.index') }}">Gebruikers Beheren</a> |
            @endcan

            @auth
                @if(Auth::user()->profile_picture)
                    <a href="{{ route('profile.edit') }}" style="display: inline-block; margin-left: 1rem;">
                        <img src="{{ asset('storage/' . Auth::user()->profile_picture) }}?t={{ now()->timestamp }}" 
                             alt="Profiel" 
                             style="width: 40px; height: 40px; border-radius: 50%; object-fit: cover; border: 2px solid cyan;">
                    </a>
                @else
                    <a href="{{ route('profile.edit') }}" style="margin-left: 1rem; color: cyan;">Profiel</a>
                @endif

                <form method="POST" action="{{ route('logout') }}" style="display:inline;">
                    @csrf
                    <button type="submit" style="margin-left: 1rem; color: red; background: none; border: none; cursor: pointer;">
                        Logout
                    </button>
                </form>
            @endauth
        </nav>
    </header>

    <main>
        @if(session('success'))
            <p style="color: green;">{{ session('success') }}</p>
        @endif

        @yield('content')
    </main>
    @stack('scripts')
</body>
</html>
