@extends('layouts.app')

@section('content')
<h2>Nieuw nieuwsitem</h2>

<form action="{{ route('game-buzz.store') }}" method="POST" enctype="multipart/form-data">
    @csrf
    <label>Titel:</label>
    <input type="text" name="title" required>

    <label>Afbeelding:</label>
    <input type="file" name="image">

    <label>Publicatiedatum:</label>
    <input type="date" name="published_at" required>

    <label>Inhoud:</label>
    <textarea name="content" rows="5" required></textarea>

    <button type="submit">Opslaan</button>
</form>
@endsection
