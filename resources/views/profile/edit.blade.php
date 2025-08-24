@extends('layouts.app')

@section('content')
<main>
    @if ($profile->profile_picture)
        <div class="form-group" style="text-align: center; margin-bottom: 2rem;">
            <img src="{{ asset('storage/' . $profile->profile_picture) }}" alt="Profielfoto" style="max-width: 150px; border-radius: 8px;">
        </div>
    @endif

    <h2>Profiel bewerken</h2>

    @if(session('success'))
        <p class="success">{{ session('success') }}</p>
    @endif

    @if ($errors->any())
        <div class="error">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data" class="form-group">
        @csrf
        @method('PATCH')

        <div class="form-group">
            <label for="name">Naam:</label>
            <input type="text" name="name" id="name" value="{{ old('name', $user->name ?? '') }}" required>
        </div>

        <div class="form-group">
            <label for="username">Gebruikersnaam:</label>
            <input type="text" name="username" id="username" value="{{ old('username', $user->username ?? '') }}" required>
        </div>

        <div class="form-group">
            <label for="birthday">Verjaardag:</label>
            <input type="date" name="birthday" id="birthday" value="{{ old('birthday', $profile->birthday ?? '') }}">
        </div>

        <div class="form-group">
            <label for="profile_picture">Profielfoto:</label>
            <input type="file" name="profile_picture" id="profile_picture">
        </div>

        <div class="form-group">
            <label for="about">Over mij:</label>
            <textarea name="about" id="about" rows="4">{{ old('about', $profile->about ?? '') }}</textarea>
        </div>

        <button type="submit">Opslaan</button>
    </form>

    <hr style="margin: 3rem 0; border-top: 1px solid #0ff;">

    <h2>Wachtwoord bijwerken</h2>

    <form method="POST" action="{{ route('password.update') }}" class="form-group">
        @csrf
        @method('PUT')

        <label for="current_password">Huidig wachtwoord:</label>
        <input type="password" name="current_password" id="current_password" required>

        <label for="password">Nieuw wachtwoord:</label>
        <input type="password" name="password" id="password" required>

        <label for="password_confirmation">Bevestig nieuw wachtwoord:</label>
        <input type="password" name="password_confirmation" id="password_confirmation" required>

        <button type="submit">Wachtwoord bijwerken</button>
    </form>

    <hr style="margin: 3rem 0; border-top: 1px solid #0ff;">

    <h2>Account verwijderen</h2>

    <form method="POST" action="{{ route('profile.destroy') }}" class="form-group" onsubmit="return confirm('Weet je zeker dat je je account wilt verwijderen?');">
        @csrf
        @method('DELETE')

        <button type="submit" style="background-color: #ff4444; color: white;">Account verwijderen</button>
    </form>
</main>
@endsection
