@extends('layouts.app')

@section('content')
    <h2>Registreren</h2>

    <form method="POST" action="{{ route('register') }}">
        @csrf

        <label for="name">Naam:</label>
        <input type="text" name="name" required>

        <label for="email">E-mailadres:</label>
        <input type="email" name="email" required>

        <label for="password">Wachtwoord:</label>
        <input type="password" name="password" required>

        <label for="password_confirmation">Bevestig Wachtwoord:</label>
        <input type="password" name="password_confirmation" required>

        <button type="submit">Registreren</button>
    </form>
@endsection
