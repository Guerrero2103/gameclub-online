@extends('layouts.app')

@section('content')
<main>
    <h2>Contacteer ons</h2>

    @if(session('success'))
        <p style="color: lightgreen;">{{ session('success') }}</p>
    @endif

    <form action="{{ route('contact.store') }}" method="POST">
        @csrf
        <label>Naam:</label>
        <input type="text" name="name" required><br>

        <label>Email:</label>
        <input type="email" name="email" required><br>

        <label>Bericht:</label>
        <textarea name="message" required></textarea><br>

        <button type="submit">Verzenden</button>
    </form>
</main>
@endsection
