@extends('layouts.app')

@section('content')
    <h2>Profiel van {{ $profile->username ?? 'Gebruiker' }}</h2>
    @if ($profile->profile_picture)
        <img src="{{ asset('storage/' . $profile->profile_picture) }}" alt="Profielfoto" width="100">
    @endif
    <p>Verjaardag: {{ $profile->birthday }}</p>
    <p>Over mij: {{ $profile->about }}</p>
@endsection
