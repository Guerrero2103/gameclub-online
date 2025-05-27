@extends('layouts.app')

@section('content')
<main>
    <h2>{{ $news->title }}</h2>
    <p><small>Gepubliceerd op: {{ \Carbon\Carbon::parse($news->published_at)->format('d-m-Y') }}</small></p>

    @if($news->image)
        <img src="{{ asset('storage/' . $news->image) }}" alt="Afbeelding" style="max-width: 100%; height: auto; margin-bottom: 1rem;">
    @endif

    <p>{{ $news->content }}</p>

    <a href="{{ route('news.index') }}">← Terug naar overzicht</a>
</main>
@endsection
