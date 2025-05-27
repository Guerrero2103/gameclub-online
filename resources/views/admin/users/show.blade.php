@extends('layouts.app')

@section('content')
<main class="container" style="padding: 20px;">
    <h2>Gebruiker Details</h2>

    <div style="max-width: 500px; margin-top: 20px;">
        <div style="margin-bottom: 15px;">
            <strong style="display: block; margin-bottom: 5px;">Naam:</strong>
            <span>{{ $user->name }}</span>
        </div>

        <div style="margin-bottom: 15px;">
            <strong style="display: block; margin-bottom: 5px;">E-mail:</strong>
            <span>{{ $user->email }}</span>
        </div>

        <div style="margin-bottom: 15px;">
            <strong style="display: block; margin-bottom: 5px;">Rol:</strong>
            <span>{{ ucfirst($user->role) }}</span>
        </div>

        <div style="margin-bottom: 15px;">
            <strong style="display: block; margin-bottom: 5px;">Aangemaakt op:</strong>
            <span>{{ $user->created_at->format('d/m/Y H:i') }}</span>
        </div>

        <div style="margin-bottom: 15px;">
            <strong style="display: block; margin-bottom: 5px;">Laatst bijgewerkt op:</strong>
            <span>{{ $user->updated_at->format('d/m/Y H:i') }}</span>
        </div>

        <div style="margin-top: 20px;">
            <a href="{{ route('admin.users.edit', $user->id) }}" style="background-color: #0ff; color: #000; font-weight: bold; padding: 10px 20px; border-radius: 5px; text-decoration: none;">Bewerken</a>
            <a href="{{ route('admin.users.index') }}" style="background-color: #1a1a2e; color: #0ff; font-weight: bold; padding: 10px 20px; border-radius: 5px; text-decoration: none; margin-left: 10px;">Terug naar Overzicht</a>
        </div>
    </div>
</main>
@endsection 