@extends('layouts.app')

@section('content')
<h2>Nieuwsitem bewerken</h2>

<form action="{{ route('game-buzz.update', $item->id) }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')

    <label>Titel:</label>
    <input type="text" name="title" value="{{ $item->title }}" required>

    <label>Afbeelding:</label>
    <input type="file" name="image">
    @if($item->image)
        <img src="{{ asset('storage/' . $item->image) }}" alt="Huidige afbeelding" style="max-width: 200px;">
    @endif

    <label>Publicatiedatum:</label>
    <input type="date" name="published_at" value="{{ $item->published_at->format('Y-m-d') }}" required>

    <label>Inhoud:</label>
    <textarea name="content" rows="5" required>{{ $item->content }}</textarea>

    <button type="submit">Bijwerken</button>
</form>
@endsection
