@extends('layouts.app')

@section('content')
    <h2>Inloggen</h2>

    @if ($errors->any())
        <div class="error" style="color: #ff4444; margin-bottom: 15px;">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <label for="email">E-mailadres:</label>
        <input type="email" name="email" required autofocus>

        <label for="password">Wachtwoord:</label>
        <input type="password" name="password" required>

        <div class="remember-me">
            <input type="checkbox" name="remember" id="remember">
            <label for="remember">Onthoud mij</label>
        </div>

        <button type="submit">Login</button>
    </form>
@endsection
