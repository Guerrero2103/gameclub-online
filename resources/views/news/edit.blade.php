@extends('layouts.app')

@section('content')
<main>
    <h2>Nieuwsitem bewerken</h2>

    @if ($errors->any())
        <div class="error">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('news.update', $news->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <label for="title">Titel:</label>
        <input type="text" name="title" id="title" value="{{ old('title', $news->title) }}" required>

        <label for="image">Nieuwe afbeelding (optioneel):</label>
        <input type="file" name="image" id="image">
        @if($news->image)
            <p>Huidige afbeelding:</p>
            <img src="{{ asset('storage/' . $news->image) }}" alt="Afbeelding" style="max-width: 200px; height: auto;">
        @endif

        <label for="content">Inhoud:</label>
        <textarea name="content" id="content" rows="5" required>{{ old('content', $news->content) }}</textarea>

        <label for="published_at">Publicatiedatum:</label>
        <input type="date" name="published_at" id="published_at" value="{{ old('published_at', \Carbon\Carbon::parse($news->published_at)->format('Y-m-d')) }}" required>

        <button type="submit">Bijwerken</button>
    </form>
</main>
@endsection
