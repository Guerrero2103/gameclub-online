@extends('layouts.app')

@section('content')
    <h2>Inloggen</h2>

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <label for="email">E-mailadres:</label>
        <input type="email" name="email" required autofocus>

        <label for="password">Wachtwoord:</label>
        <input type="password" name="password" required>

        <button type="submit">Login</button>
    </form>
@endsection
