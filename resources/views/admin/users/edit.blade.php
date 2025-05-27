@extends('layouts.app')

@section('content')
<main class="container" style="padding: 20px;">
    <h2>Gebruiker Bewerken</h2>

    @if($errors->any())
        <div style="color: #ff4444; margin-bottom: 15px;">
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('admin.users.update', $user->id) }}" method="POST" style="max-width: 500px;">
        @csrf
        @method('PUT')
        
        <div style="margin-bottom: 15px;">
            <label for="name" style="display: block; margin-bottom: 5px;">Naam:</label>
            <input type="text" name="name" id="name" value="{{ old('name', $user->name) }}" required style="width: 100%; padding: 8px; border: 1px solid #0ff; background: #1a1a2e; color: white;">
        </div>

        <div style="margin-bottom: 15px;">
            <label for="email" style="display: block; margin-bottom: 5px;">E-mail:</label>
            <input type="email" name="email" id="email" value="{{ old('email', $user->email) }}" required style="width: 100%; padding: 8px; border: 1px solid #0ff; background: #1a1a2e; color: white;">
        </div>

        <div style="margin-bottom: 15px;">
            <label for="password" style="display: block; margin-bottom: 5px;">Nieuw Wachtwoord (laat leeg om niet te wijzigen):</label>
            <input type="password" name="password" id="password" style="width: 100%; padding: 8px; border: 1px solid #0ff; background: #1a1a2e; color: white;">
        </div>

        <div style="margin-bottom: 15px;">
            <label for="role" style="display: block; margin-bottom: 5px;">Rol:</label>
            <select name="role" id="role" required style="width: 100%; padding: 8px; border: 1px solid #0ff; background: #1a1a2e; color: white;">
                @foreach($roles as $role)
                    <option value="{{ $role }}" {{ old('role', $user->role) == $role ? 'selected' : '' }}>{{ ucfirst($role) }}</option>
                @endforeach
            </select>
        </div>

        <div style="margin-top: 20px;">
            <button type="submit" style="background-color: #0ff; color: #000; font-weight: bold; padding: 10px 20px; border-radius: 5px; border: none; cursor: pointer;">Wijzigingen Opslaan</button>
            <a href="{{ route('admin.users.index') }}" style="background-color: #1a1a2e; color: #0ff; font-weight: bold; padding: 10px 20px; border-radius: 5px; text-decoration: none; margin-left: 10px;">Annuleren</a>
        </div>
    </form>
</main>
@endsection 