@extends('layouts.app')

@section('content')
<main class="container" style="padding: 20px;">
    <h2>Gebruikers Beheren</h2>

    @if(session('success'))
        <p style="color: #0ff; margin-bottom: 15px;">{{ session('success') }}</p>
    @endif

    <div style="margin-bottom: 20px;">
        <a href="{{ route('admin.users.create') }}" style="background-color: #0ff; color: #000; font-weight: bold; padding: 10px 20px; border-radius: 5px; text-decoration: none;">Nieuwe Gebruiker Aanmaken</a>
    </div>

    <table style="width: 100%; border-collapse: collapse; margin-top: 20px;">
        <thead>
            <tr style="background-color: #1a1a2e;">
                <th style="padding: 10px; text-align: left; border-bottom: 1px solid #0ff;">ID</th>
                <th style="padding: 10px; text-align: left; border-bottom: 1px solid #0ff;">Naam</th>
                <th style="padding: 10px; text-align: left; border-bottom: 1px solid #0ff;">E-mail</th>
                <th style="padding: 10px; text-align: left; border-bottom: 1px solid #0ff;">Rol</th>
                <th style="padding: 10px; text-align: left; border-bottom: 1px solid #0ff;">Acties</th>
            </tr>
        </thead>
        <tbody>
            @foreach($users as $user)
            <tr style="border-bottom: 1px solid #1a1a2e;">
                <td style="padding: 10px;">{{ $user->id }}</td>
                <td style="padding: 10px;">{{ $user->name }}</td>
                <td style="padding: 10px;">{{ $user->email }}</td>
                <td style="padding: 10px;">{{ $user->role }}</td>
                <td style="padding: 10px;">
                    <a href="{{ route('admin.users.edit', $user->id) }}" style="background-color: #0ff; color: #000; font-weight: bold; padding: 5px 10px; border-radius: 5px; text-decoration: none; margin-right: 5px;">Bewerken</a>
                    <form action="{{ route('admin.users.destroy', $user->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" style="background-color: #ff4444; color: white; font-weight: bold; padding: 5px 10px; border-radius: 5px; border: none; cursor: pointer;" onclick="return confirm('Weet je zeker dat je deze gebruiker wilt verwijderen?')">Verwijderen</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</main>
@endsection 