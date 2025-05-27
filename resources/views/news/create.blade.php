@extends('layouts.app')

@section('content')
<main>
    <h2>Nieuw nieuwsitem toevoegen</h2>

    @if ($errors->any())
        <div class="error">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('news.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <label for="title">Titel:</label>
        <input type="text" name="title" id="title" value="{{ old('title') }}" required>

        <label for="image">Afbeelding:</label>
        <input type="file" name="image" id="image">

        <label for="content">Inhoud:</label>
        <textarea name="content" id="content" rows="5" required>{{ old('content') }}</textarea>

        <label for="published_at">Publicatiedatum:</label>
        <input type="date" name="published_at" id="published_at" value="{{ old('published_at', now()->format('Y-m-d')) }}" required>

        <button type="submit">Toevoegen</button>
    </form>
</main>
@endsection
